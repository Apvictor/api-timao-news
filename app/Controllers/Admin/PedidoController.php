<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Models\PedidoModel;

class PedidoController extends BaseController
{
    protected $pedidoModel;
    protected $usuarioSistemaModel;

    public function __construct()
    {
        $this->pedidoModel = new PedidoModel();
    }

    public function index()
    {
        $filtros = $this->request->getVar();

        $data = [
            "page" => "pedidos",
            "page_title" => "Pedidos",
            "pedidos" => $this->pedidoModel->getAll($filtros),
            "filtros" => $filtros
        ];

        return view('page/' . $data["page"], $data);
    }
}
