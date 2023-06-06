<?php

namespace App\Models;

use CodeIgniter\Model;

class FormaPagamentoModel extends Model
{
  protected $table = 'forma_pagamentos';
  protected $primaryKey = 'id';
  protected $allowedFields = ['descricao', 'status'];
  protected $validationRules = [];

  public function getAll()
  {
    $formaPagamentoSistemaModel = new FormaPagamentoSistemaModel();

    $pagamentos = $this->findAll();

    for ($i = 0; $i < count($pagamentos); $i++) {
      $pagamentosSistema = $formaPagamentoSistemaModel->getByFormaPagamentoId($pagamentos[$i]["id"]);

      $pagamentos[$i]["status"] = empty($pagamentosSistema) ? "" : $pagamentosSistema["status"];
    }

    return $pagamentos;
  }

  public function getById($id)
  {
    $resultado = $this
      ->select("forma_pagamentos.*, forma_pagamentos_sistemas.status, forma_pagamentos_sistemas.id AS forma_pagamentos_sistemas_id")
      ->join("forma_pagamentos_sistemas", "forma_pagamento_id = forma_pagamentos.id")
      ->where("forma_pagamentos_sistemas.sistema_id", session()->get("sistema")["id"])
      ->where("forma_pagamentos.id", $id)
      ->first();

    return $resultado;
  }
}
