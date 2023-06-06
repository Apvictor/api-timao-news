<?php

namespace App\Models;

use CodeIgniter\Model;

class CupomModel extends Model
{
  protected $table = 'cupons';
  protected $primaryKey = 'id';
  protected $allowedFields = ['sistema_id', 'nome', 'codigo', 'desconto', 'status'];
  protected $validationRules = [
    'nome'  => 'required',
    'codigo'  => 'required',
    'desconto'  => 'required',
  ];

  public function getAll(array $filtros = [])
  {
    $resultado = $this->orderBy('nome');

    if (!empty($filtros["search"])) {
      $resultado->like(["nome" => $filtros["search"]]);
    }

    if (!empty($filtros["status"])) {
      $resultado->where("status", $filtros["status"]);
    }

    if (!empty($filtros["sistema"])) {
      $resultado->where("sistema_id", $filtros["sistema"]);
    }

    return $resultado->findAll();
  }

  public function getByCodigo(array $filtros = [])
  {
    $resultado = $this->where($filtros)->first();

    return $resultado;
  }

  public function add(array $dados)
  {
    if (!$this->validate($dados)) {
      $resultado = [
        "error" => true,
        "toast" => ["type" => TOAST_ERROR, "title" => "Falha", "message" => "Falha ao salvar!"]
      ];
    } else {
      $this->insert($dados);

      $resultado = [
        "error" => false,
        "toast" => ["type" => TOAST_SUCCESS, "title" => "Sucesso", "message" => "Sucesso ao salvar!"]
      ];
    }

    return $resultado;
  }

  public function edit(int $id, array $dados)
  {

    if (!$this->validate($dados)) {
      $resultado = [
        "error" => true,
        "toast" => ["type" => TOAST_ERROR, "title" => "Falha", "message" => "Falha ao salvar!"]
      ];
    } else {
      $dados["desconto"] = format_number($dados["desconto"]);
      $this->update($id, $dados);

      $resultado = [
        "error" => false,
        "toast" => ["type" => TOAST_SUCCESS, "title" => "Sucesso", "message" => "Sucesso ao salvar!"]
      ];
    }

    return $resultado;
  }
}
