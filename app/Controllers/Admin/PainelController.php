<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Models\PedidoModel;

class PainelController extends BaseController
{
    protected $pedidoModel;

    public function __construct()
    {
        $this->pedidoModel = new PedidoModel();
    }

    public function index()
    {
        $filtro_data = date("Y-m-d");

        $data = [
            "page" => "painel",
            "page_title" => "Painel",
            "filtros" => [
                "data" => $filtro_data
            ]
        ];

        return view('page/' . $data["page"], $data);
    }

    public function kanban()
    {
        $filtro_data = $this->request->getVar();

        $fazer = $this->pedidoModel->kanban(PENDENTE, $filtro_data);
        $fazendo = $this->pedidoModel->kanban(ENTREGA, $filtro_data);
        $feito = $this->pedidoModel->kanban(RECEBIDO, $filtro_data);

        $data = [
            "fazer" => $fazer,
            "fazendo" => $fazendo,
            "feito" => $feito
        ];

        return $this->response->setJSON($data);
    }

    public function status($pedidoId, $status)
    {
        $resultado = $this->pedidoModel->setStatus($pedidoId, $status);

        return $resultado;
    }
}
