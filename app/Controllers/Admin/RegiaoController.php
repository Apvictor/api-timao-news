<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Models\RegiaoModel;

class RegiaoController extends BaseController
{
    protected $regiaoModel;

    public function __construct()
    {
        $this->regiaoModel = new RegiaoModel();
    }

    public function index()
    {
        $filtros = $this->request->getVar();
        $filtros["sistema"] = get_sistema_admin();

        $data = [
            "page" => "regioes",
            "page_title" => "Regiões",
            "regioes" => $this->regiaoModel->getAll($filtros),
            "search" => !empty($filtros["search"]) ? $filtros["search"] : ""
        ];

        return view('page/' . $data["page"], $data);
    }

    public function cadastrar()
    {
        $dados = $this->request->getVar();
        $dados["sistema_id"] = get_sistema_admin();
        $dados["cep"] = only_numbers($dados["cep"]);

        $resultado = $this->regiaoModel->add($dados);

        toast_new($resultado["toast"]);

        if (!$resultado["error"]) return redirect()->to("admin/regioes");

        return redirect()->to("admin/regioes");
    }

    public function status(int $regiao_id)
    {
        $regiao = $this->regiaoModel->find($regiao_id);
        $novo_status = $regiao["status"] == ATIVO ? INATIVO : ATIVO;

        $resultado = $this->regiaoModel->edit($regiao["id"], ["status" => $novo_status]);

        toast_new($resultado["toast"]);

        if (!$resultado["error"]) return redirect()->to("admin/regioes");

        return redirect()->to("admin/regioes");
    }

    public function editar(int $regiao_id)
    {   
        $dados = $this->request->getVar();
        $regiao = $this->regiaoModel->find($regiao_id);

        $resultado = $this->regiaoModel->edit($regiao["id"], $dados);

        toast_new($resultado["toast"]);

        if (!$resultado["error"]) return redirect()->to("admin/regioes");

        return redirect()->to("admin/regioes");
    }
}
