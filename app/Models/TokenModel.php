<?php

namespace App\Models;

use CodeIgniter\Model;

class TokenModel extends Model
{
  protected $table = 'tokens';
  protected $primaryKey = 'id';
  protected $allowedFields = ['usuario_id', 'authorization', 'expiracao'];
  protected $validationRules = [];

  public function getByToken($authorization)
  {
    $token = $this->where("authorization", $authorization)->first();

    return $token;
  }

  public function add(array $dados)
  {
    $token = $this->where("usuario_id", $dados["usuario_id"])->first();

    if ($token) {
      $this->update($token["id"], $dados);
    } else {
      $this->insert($dados);
    }

    $resultado = [
      "error" => false,
      "message" => "Sucesso", "message" => "Sucesso ao salvar!"
    ];

    return $resultado;
  }
}
