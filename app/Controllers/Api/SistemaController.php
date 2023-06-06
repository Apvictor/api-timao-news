<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

use App\Models\SistemaModel;
use App\Models\FormaPagamentoModel;
use App\Models\RegiaoModel;

class SistemaController extends ResourceController
{
    use ResponseTrait;

    protected $regiaoModel;
    protected $sistemaModel;
    protected $formaPagamentoModel;

    public function __construct()
    {
        $this->regiaoModel = new RegiaoModel();
        $this->sistemaModel = new SistemaModel();
        $this->formaPagamentoModel = new FormaPagamentoModel();
    }

    public function index()
    {
        $data = $this->sistemaModel->select("
        id, codigo, telefone, status, pix,
        tempo_entrega_max, tempo_entrega_min,
        razao_social, nome_fantasia,
        foto, aberto, fechado, ramo_sistema,
        cor_primaria, cor_texto
        ")->find(get_sistema_api());

        $data["aberto"] = get_status_sistema($data["aberto"], $data["fechado"]);

        return $this->respond($data);
    }

    public function formaPagamentos()
    {
        $data = $this->formaPagamentoModel
            ->select("forma_pagamentos.*")
            ->join("forma_pagamentos_sistemas", "forma_pagamentos_sistemas.forma_pagamento_id = forma_pagamentos.id")
            ->where("sistema_id", get_sistema_api())
            ->where("status", ATIVO)
            ->orderBy("forma_pagamentos.id")
            ->findAll();

        return $this->respond($data);
    }

    public function regioes($cep)
    {
        $data = $this->regiaoModel->where("sistema_id", get_sistema_api())
            ->where("cep", $cep)
            ->orderBy('cep', "ASC")
            ->first();

        if ($data) {
            return $this->respond([
                "frete" => $data["frete"],
                "message" => "Que legal, entregamos em seu endereço!"
            ], 200);
        }
        return $this->respond([
            "message" => "Desculpe, ainda não entregamos em seu endereço!"
        ], 400);
    }
}
