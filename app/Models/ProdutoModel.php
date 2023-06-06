<?php

namespace App\Models;

use App\Libraries\AwsS3;
use CodeIgniter\Model;

class ProdutoModel extends Model
{
  protected $table = 'produtos';
  protected $primaryKey = 'id';
  protected $allowedFields = ['nome', 'foto', 'descricao', 'preco', 'categoria_id', 'quantidade', 'status'];
  protected $validationRules    = [
    'nome' => 'required',
    'preco' => 'required',
    'quantidade' => 'required',
    'categoria_id' => 'required',
    'foto' => [
      'required',
      'uploaded[foto]',
      'mime_in[foto,image/jpg,image/jpeg,image/png]',
      'max_size[foto,1024]',
    ]
  ];

  public function getAll($filtros = [])
  {
    $resultado = $this
      ->select("produtos.*, categorias.nome AS categoria_nome")
      ->join("categorias", "categorias.id = produtos.categoria_id")
      ->orderBy("produtos.nome");

    if (!empty($filtros["search"])) {
      $resultado->like(["produtos.nome" => $filtros["search"]]);
      $resultado->orLike(["produtos.descricao" => $filtros["search"]]);
    }

    if (!empty($filtros["categoria_id"])) {
      $resultado->where(["categorias.id" => $filtros["categoria_id"]]);
    }

    if (!empty($filtros["status"])) {
      $resultado->where(["produtos.status" => $filtros["status"]]);
    }

    if (!empty($filtros["sistema"])) {
      $resultado->where("sistema_id", $filtros["sistema"]);
    }

    return $resultado->findAll();
  }

  public function add(array $dados, $imagem)
  {
    $s3 = new AwsS3();

    if (!$this->validate($dados)) {
      $resultado = [
        "error" => false,
        "toast" => ["type" => TOAST_ERROR, "title" => "Falha", "message" => "Falha ao salvar!"]
      ];
    } else {
      if (!$imagem->isValid()) {
        $resultado = [
          "error" => false,
          "toast" => ["type" => TOAST_WARNING, "title" => "Falha", "message" => "Tipo de arquivo não permitido!"]
        ];
      } else {
        $dados["preco"] = format_number($dados["preco"]);
        $dados["foto"] = $s3->store($_FILES['foto']);

        $this->insert($dados);

        $resultado = [
          "error" => true,
          "toast" => ["type" => TOAST_SUCCESS, "title" => "Sucesso", "message" => "Sucesso ao salvar!"]
        ];
      }
    }

    return $resultado;
  }

  public function edit(int $id, array $dados, $imagem = null)
  {
    $s3 = new AwsS3();

    if (!$this->validate($dados)) {
      $resultado = [
        "error" => false,
        "toast" => ["type" => TOAST_ERROR, "title" => "Falha", "message" => "Falha ao salvar!"]
      ];
    } else {
      if (isset($imagem) && $imagem->isValid()) {
        $dados["foto"] = $s3->store($_FILES['foto']);
      }

      if (isset($dados["preco"])) {
        $dados["preco"] = format_number($dados["preco"]);
      }

      $this->update($id, $dados);

      $resultado = [
        "error" => true,
        "toast" => ["type" => TOAST_SUCCESS, "title" => "Sucesso", "message" => "Sucesso ao salvar!"]
      ];
    }

    return $resultado;
  }

  public function getStockProducts($stockLimit = 10, $limit = 5)
  {
    $resultado = $this
      ->select("produtos.*, categorias.nome AS categoria_nome")
      ->join("categorias", "categorias.id = produtos.categoria_id")
      ->where([
        "sistema_id" => get_sistema_admin(),
        "quantidade <=" => $stockLimit
      ])
      ->orderBy("quantidade", "ASC")
      ->findAll($limit);

    return $resultado;
  }
}
