<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

use App\Libraries\AwsS3;

use App\Models\PedidoModel;
use App\Models\PedidoProdutoModel;
use App\Models\ProdutoModel;
use App\Models\UsuarioModel;
use Exception;

class PedidoController extends ResourceController
{
    use ResponseTrait;

    protected $pedidoModel;
    protected $produtoModel;
    protected $usuarioModel;
    protected $pedidoProdutoModel;

    public function __construct()
    {
        $this->pedidoModel = new PedidoModel();
        $this->usuarioModel = new UsuarioModel();
        $this->produtoModel = new ProdutoModel();
        $this->pedidoProdutoModel = new PedidoProdutoModel();
    }

    public function index()
    {
        $usuario_id = $this->request->getPost()["id"];

        $data = $this->pedidoModel->where([
            "sistema_id" => get_sistema_api(),
            "usuario_id" => $usuario_id
        ])
            ->orderBy("created_at", "DESC")
            ->findAll();

        return $this->respond($data);
    }

    public function detalhes($pedidoId)
    {
        $data = $this->pedidoModel->find($pedidoId);

        $data["produtos"] = $this->pedidoProdutoModel
            ->select("produtos.*, pedidos_produtos.quantidade")
            ->join("produtos", "produtos.id = pedidos_produtos.produto_id")
            ->where("pedido_id", $pedidoId)
            ->findAll();

        for ($i = 0; $i < count($data["produtos"]); $i++) {
            $data["produtos"][$i]["total"] = $data["produtos"][$i]["quantidade"] * $data["produtos"][$i]["preco"];
        }

        return $this->respond($data);
    }

    public function cadastrar()
    {
        $data = $this->request->getVar();

        $usuario_id = $this->request->getPost()["id"];

        $pagamento = new PagamentoController();

        switch ($data->forma_pagamento->id) {
            case CARTAO_ONLINE:
                $responsePagamento = $pagamento->cartaoCredito($usuario_id, $data);

                if (isset($responsePagamento["data"]) && $responsePagamento["data"]["response"]->status === PAGO) {
                    $data->codigo = $responsePagamento["data"]["response"]->id;
                    $data = $this->pedidoModel->cadastrar($usuario_id, $data);
                } else {
                    $data = $this->statusPagamentoOnline($responsePagamento["data"]["response"]->status);
                }
                break;
            case PIX:
                if (!$data->comprovante == NULL) {
                    $s3 = new AwsS3();
                    $data->comprovante = $s3->store($data->comprovante, true);
                }

                $data = $this->pedidoModel->cadastrar($usuario_id, $data);

                break;
            case DINHEIRO:
                $data = $this->pedidoModel->cadastrar($usuario_id, $data);
                break;
            case CARTAO_ENTREGA:
                $data = $this->pedidoModel->cadastrar($usuario_id, $data);
                break;
            default:
                throw new Exception("Não foi possivel encontrar esse status");
                break;
        }

        return $this->respond($data);
    }

    private function statusPagamentoOnline($status)
    {
        switch ($status) {
            case PAGO:
                $data["message"] = PAGO_MESSAGE;
                break;
            case RECUSOU:
                $data["message"] = RECUSOU_MESSAGE;
                $data["status"] = false;
                break;
            case ESTORNADA:
                $data["message"] = ESTORNADA_MESSAGE;
                $data["status"] = false;
                break;
            case AUTORIZADA:
                $data["message"] = AUTORIZADA_MESSAGE;
                $data["status"] = false;
                break;
            case PROCESSANDO:
                $data["message"] = PROCESSANDO_MESSAGE;
                $data["status"] = false;
                break;
            case REVISAO_PENDENTE:
                $data["message"] = REVISAO_PENDENTE_MESSAGE;
                $data["status"] = false;
                break;
            default:
                throw new Exception("Não foi possivel encontrar esse status");
                break;
        }

        return $data;
    }
}
