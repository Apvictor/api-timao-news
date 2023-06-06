<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

use App\Libraries\Pagarme;

use App\Models\SistemaModel;
use App\Models\UsuarioModel;

use Exception;

class PagamentoController extends ResourceController
{
  use ResponseTrait;

  protected $usuarioModel;
  protected $sistemaModel;
  protected $pagarme;

  public function __construct()
  {
    $this->usuarioModel = new UsuarioModel();
    $this->sistemaModel = new SistemaModel();
    $this->pagarme = new Pagarme();
  }

  public function cartaoCredito($usuario_id, $dados)
  {
    try {
      $usuario = $this->usuarioModel->getUserCompleteById($usuario_id);

      // CRIAR PAGAMENTO NO PAGARME
      $responsePagamento = $this->pagarme->criarPagamentoCartaoCredito($usuario, $dados);

      if (!$responsePagamento["success"])
        throw new Exception("Falha ao criar pedido");

      return $responsePagamento;
    } catch (Exception $e) {
      return ["success" => false, "message" => $e->getMessage()];
    }
  }
}
