<?php

namespace App\Models;

use CodeIgniter\Model;

class GatewayModel extends Model
{
  protected $table = 'gateways';
  protected $primaryKey = 'id';
  protected $allowedFields = ['nome', 'sistema_id', 'status', 'secret_key', 'api_key'];
  protected $validationRules = [
    'nome'  => 'required',
    'secret_key'  => 'required',
    'api_key'  => 'required',
  ];

  public function getAll(array $filtros = [])
  {
    $resultado = $this->orderBy('status');

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
      $this->update($id, $dados);

      $resultado = [
        "error" => false,
        "toast" => ["type" => TOAST_SUCCESS, "title" => "Sucesso", "message" => "Sucesso ao salvar!"]
      ];
    }

    return $resultado;
  }
}
