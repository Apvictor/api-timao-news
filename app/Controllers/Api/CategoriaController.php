<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

use App\Models\CategoriaModel;

class CategoriaController extends ResourceController
{
    use ResponseTrait;

    protected $categoriaModel;

    public function __construct()
    {
        $this->categoriaModel = new CategoriaModel();
    }

    public function index()
    {
        $filtros = [
            "sistema" => get_sistema_api(),
            "status" => ATIVO
        ];

        $data = $this->categoriaModel->getAll($filtros);

        return $this->respond($data, 200);
    }
}
