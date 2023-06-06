<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioSistemaModel extends Model
{
  protected $table = 'usuarios_sistemas';
  protected $primaryKey = 'id';
  protected $allowedFields = ['id', 'usuario_id', 'sistema_id', 'status'];
  protected $validationRules = [];

  public function cadastrar($usuario_id)
  {
    $resultado = $this->insert([
      "sistema_id" => get_sistema_api(),
      "usuario_id" => $usuario_id,
    ]);

    return $resultado;
  }
  public function setStatus($id, $status)
  {
    $resultado = $this->update($id, ["status" => $status]);

    return $resultado;
  }
}
