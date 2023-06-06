<?php

namespace App\Models;

use CodeIgniter\Model;

class FormaPagamentoSistemaModel extends Model
{
  protected $table = 'forma_pagamentos_sistemas';
  protected $primaryKey = 'id';
  protected $allowedFields = ['status', 'sistema_id', 'forma_pagamento_id'];
  protected $validationRules = [];

  public function setStatus($id, $status)
  {
    $resultado = $this->update($id, ["status" => $status]);

    return $resultado;
  }

  public function add($dados)
  {
    $resultado = $this->insert($dados);

    return $resultado;
  }

  public function getByFormaPagamentoId($formaPagamentoId)
  {
    $resultado = $this->where([
      "sistema_id" => session()->get("sistema")["id"],
      "forma_pagamento_id" => $formaPagamentoId,
    ])->first();

    return $resultado;
  }
}
