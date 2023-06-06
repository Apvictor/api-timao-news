<?php

namespace App\Models;

use CodeIgniter\Model;

class RegiaoModel extends Model
{
  protected $table = 'regioes';
  protected $primaryKey = 'id';
  protected $allowedFields = ['cep', 'frete', 'sistema_id', 'status'];
  protected $validationRules = [
    'cep'  => 'required',
    'frete'  => 'required',
  ];

  public function getAll($filtros = [])
  {
    $resultado = $this->orderBy("cep");

    if (!empty($filtros["search"])) {
      $resultado->like(["cep" => $filtros["search"]]);
    }

    if (!empty($filtros["status"])) {
      $resultado->where("status", $filtros["status"]);
    }

    if (!empty($filtros["sistema"])) {
      $resultado->where("sistema_id", $filtros["sistema"]);
    }

    return $resultado->findAll();
  }

  public function add(array $dados)
  {
    if (!$this->validate($dados)) {
      $resultado = [
        "error" => false,
        "toast" => ["type" => TOAST_ERROR, "title" => "Falha", "message" => "Falha ao salvar!"]
      ];
    } else {
      if ($dados["cep"] && $dados["frete"]) {
        $dados["cep"] = only_numbers($dados["cep"]);
        $dados["frete"] = format_number($dados["frete"]);
      }

      $this->insert($dados);

      $resultado = [
        "error" => true,
        "toast" => ["type" => TOAST_SUCCESS, "title" => "Sucesso", "message" => "Sucesso ao salvar!"]
      ];
    }

    return $resultado;
  }

  public function edit(int $id, array $dados)
  {
    if (!$this->validate($dados)) {
      $resultado = [
        "error" => false,
        "toast" => ["type" => TOAST_ERROR, "title" => "Falha", "message" => "Falha ao salvar!"]
      ];
    } else {
      if (isset($dados["cep"]) && isset($dados["frete"])) {
        $dados["cep"] = only_numbers($dados["cep"]);
        $dados["frete"] = format_number($dados["frete"]);
      }

      $this->update($id, $dados);

      $resultado = [
        "error" => true,
        "toast" => ["type" => TOAST_SUCCESS, "title" => "Sucesso", "message" => "Sucesso ao salvar!"]
      ];
    }

    return $resultado;
  }
}
