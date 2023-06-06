<?php

namespace App\Models;

use CodeIgniter\Model;

class PedidoProdutoModel extends Model
{
  protected $table = 'pedidos_produtos';
  protected $primaryKey = 'id';
  protected $allowedFields = ['pedido_id', 'produto_id', 'quantidade'];
  protected $validationRules = [];

  public function cadastrar($pedido_id, $carrinho)
  {
    for ($i = 0; $i < count($carrinho); $i++) {
      $carrinho[$i]->pedido_id = $pedido_id;

      $this->save($carrinho[$i]);
    }
  }
}
