<?php

namespace App\Models;

use CodeIgniter\Model;

class EnderecoModel extends Model
{
  protected $table = 'enderecos';
  protected $primaryKey = 'id';
  protected $allowedFields = ['usuario_id', 'principal', 'cep', 'endereco', 'numero', 'bairro', 'cidade', 'estado', 'complemento', 'status'];
  protected $validationRules = [];

  public function getByUserId($usuario_id)
  {
    $resultado = $this->where([
      "status" => ATIVO,
      "usuario_id" => $usuario_id
    ])
      ->orderBy("principal", "DESC")
      ->orderBy("updated_at", "DESC")
      ->findAll();

    return $resultado;
  }

  public function getByCep($cep)
  {
    $resultado = $this->where([
      "status" => ATIVO,
      "cep" => $cep
    ]);

    return $resultado->first();
  }

  public function cadastrar($usuario_id, $data)
  {
    $data->usuario_id = $usuario_id;

    $resultado = $this->insert($data);

    if (!$resultado) {
      return [
        "status" => $resultado,
        "message" => "Ocorreu uma falha ao salvar!"
      ];
    }

    return [
      "status" => $resultado,
      "message" => "Endereço salvo com sucesso!"
    ];
  }

  public function editar($usuario_id, $data)
  {
    $endereco_id = $this->where("usuario_id", $usuario_id)->first()["id"];

    $resultado = $this->update($endereco_id, $data);

    if (!$resultado) {
      return [
        "status" => $resultado,
        "message" => "Ocorreu uma falha ao salvar!"
      ];
    }

    return [
      "status" => $resultado,
      "message" => "Endereço salvo com sucesso!"
    ];
  }

  public function setStatus($enderecoId)
  {
    $resultado = $this->update($enderecoId, ["status" => INATIVO, "principal" => 0]);

    if (!$resultado) {
      return [
        "status" => $resultado,
        "message" => "Ocorreu uma falha ao remover!"
      ];
    }

    return [
      "status" => $resultado,
      "message" => "Endereço removido com sucesso!"
    ];
  }

  public function setPrincipal($usuario_id, $enderecoId)
  {
    $enderecos = $this->where([
      "usuario_id" => $usuario_id,
      "principal" => 1
    ])->findAll();


    if (count($enderecos) > 0) {
      for ($i = 0; $i < count($enderecos); $i++) {
        $this->update($enderecos[$i]["id"], ["principal" => 0]);
      }
    }

    $resultado = $this->update($enderecoId, ["principal" => 1]);

    if (!$resultado) {
      return [
        "status" => $resultado,
        "message" => "Ocorreu uma falha ao salvar!"
      ];
    }

    return [
      "status" => $resultado,
      "message" => "Endereço principal salvo com sucesso!"
    ];
  }
}
