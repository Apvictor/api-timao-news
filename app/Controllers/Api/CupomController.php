<?php

namespace App\Controllers\Api;

use App\Models\CupomModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;


class CupomController extends ResourceController
{
    use ResponseTrait;

    protected $cupomModel;

    public function __construct()
    {
        $this->cupomModel = new CupomModel();
    }

    public function validarCupom($codigoCupom)
    {
        $filtros = [
            "sistema_id" => get_sistema_api(),
            "status" => ATIVO,
            "codigo" => $codigoCupom
        ];

        $data = $this->cupomModel->getByCodigo($filtros);

        if (empty($data))
            return $this->respond(["error" => true, "message" => "Não foi possivel localizar este cupom"], 200);

        return $this->respond([
            "error" => false,
            "message" => "Cupom aplicado com sucesso!",
            "cupom" => $data
        ], 200);
    }
}
