<?php

namespace App\Models;

use CodeIgniter\Model;

class CartaoModel extends Model
{
  protected $table = 'cartoes';
  protected $primaryKey = 'id';
  protected $allowedFields = ['id', 'principal', 'usuario_id', 'nome', 'titular', 'validade', 'cpf', 'cvv', 'numero', 'status'];
  protected $validationRules = [];

  public function getByUserId($usuario_id)
  {
    $resultado = $this
      ->select("*")
      ->where([
        "status" => ATIVO,
        "usuario_id" => $usuario_id
      ])
      ->orderBy("principal", "DESC")
      ->orderBy("updated_at", "DESC")
      ->findAll();

    return $resultado;
  }

  public function cadastrar($data)
  {
    $resultado = $this->insert($data);

    if (!$resultado) {
      return [
        "status" => $resultado,
        "message" => "Ocorreu uma falha ao salvar!"
      ];
    }

    return [
      "status" => $resultado,
      "message" => "Cartão salvo com sucesso!"
    ];
  }

  public function editar($data)
  {
    $resultado = $this->update($data->id, $data);

    if (!$resultado) {
      return [
        "status" => $resultado,
        "message" => "Ocorreu uma falha ao salvar!"
      ];
    }

    return [
      "status" => $resultado,
      "message" => "Cartão salvo com sucesso!"
    ];
  }

  public function setStatus($cartaoId)
  {
    $resultado = $this->update($cartaoId, ["status" => INATIVO, "principal" => 0]);

    if (!$resultado) {
      return [
        "status" => $resultado,
        "message" => "Ocorreu uma falha ao remover!"
      ];
    }

    return [
      "status" => $resultado,
      "message" => "Cartão removido com sucesso!"
    ];
  }

  public function setPrincipal($usuario_id, $cartaoId)
  {
    $cartoes = $this->where([
      "usuario_id" => $usuario_id,
      "principal" => 1
    ])->findAll();

    if (count($cartoes) > 0) {
      for ($i = 0; $i < count($cartoes); $i++) {
        $this->update($cartoes[$i]["id"], ["principal" => 0]);
      }
    }

    $resultado = $this->update($cartaoId, ["principal" => 1]);

    if (!$resultado) {
      return [
        "status" => $resultado,
        "message" => "Ocorreu uma falha ao salvar!"
      ];
    }

    return [
      "status" => $resultado,
      "message" => "Cartão principal salvo com sucesso!"
    ];
  }
}
