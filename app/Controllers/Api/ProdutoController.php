<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

use App\Models\ProdutoModel;

class ProdutoController extends ResourceController
{
    use ResponseTrait;

    protected $produtoModel;

    public function __construct()
    {
        $this->produtoModel = new ProdutoModel();
    }

    public function index()
    {
        $data = $this->produtoModel
            ->select("produtos.*")
            ->join("categorias", "categorias.id = produtos.categoria_id")
            ->where("categorias.sistema_id", get_sistema_api())
            ->where("produtos.status", ATIVO)
            ->orderBy('produtos.nome')
            ->findAll();

        return $this->respond($data);
    }
}
