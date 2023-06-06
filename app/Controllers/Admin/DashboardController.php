<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Models\CategoriaModel;
use App\Models\PedidoModel;
use App\Models\ProdutoModel;
use App\Models\UsuarioModel;

class DashboardController extends BaseController
{
    protected $usuarioModel;
    protected $categoriaModel;
    protected $produtoModel;
    protected $pedidoModel;

    public function __construct()
    {
        $this->usuarioModel = new UsuarioModel();
        $this->categoriaModel = new CategoriaModel();
        $this->produtoModel = new ProdutoModel();
        $this->pedidoModel = new PedidoModel();
    }

    public function index()
    {
        $data = [
            "page" => "dashboard",
            "page_title" => "Dashboard",
            "total_usuarios" => count($this->usuarioModel->getAll(["status" => ATIVO])),
            "total_categorias" => count($this->categoriaModel->getAll(["status" => ATIVO])),
            "total_produtos" => count($this->produtoModel->getAll(["status" => ATIVO])),
            "total_pedidos" => count($this->pedidoModel->getAll(["status" => RECEBIDO])),
            "estoque_produtos" => $this->produtoModel->getStockProducts(),
        ];

        return view('page/' . $data["page"], $data);
    }

    public function graphic($ano)
    {
        $data = [
            "chart" => [
                "chart_clientes" => $this->usuarioModel->getAllForChart($ano),
                "chart_pedidos" => $this->pedidoModel->getAllForChart($ano),
                "chart_faturamentos" => $this->pedidoModel->getFaturamentoForChart($ano),
            ],
            "soma_total_pedidos" => $this->pedidoModel->getTotal($ano),
            "porcentagem_pedidos" => $this->pedidoModel->getPorcentagem($ano),
        ];

        return $this->response->setJSON($data);
    }
}
