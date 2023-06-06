<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CupomModel;

class CupomController extends BaseController
{
    protected $cupomModel;

    public function __construct()
    {
        $this->cupomModel = new CupomModel();
    }

    public function index()
    {
        $filtros = $this->request->getVar();
        $filtros["sistema"] = get_sistema_admin();

        $data = [
            "page" => "cupons",
            "page_title" => "Cupons",
            "cupons" => $this->cupomModel->getAll($filtros),
            "search" => !empty($filtros["search"]) ? $filtros["search"] : ""
        ];

        return view("page/" . $data["page"], $data);
    }

    public function cadastrar()
    {
        $dados = $this->request->getVar();
        $dados["sistema_id"] = get_sistema_admin();

        $resultado = $this->cupomModel->add($dados);

        toast_new($resultado["toast"]);

        return redirect()->to("admin/cupons");
    }

    public function status(int $cupom_id)
    {
        $cupom = $this->cupomModel->find($cupom_id);
        $novo_status = $cupom["status"] == ATIVO ? INATIVO : ATIVO;

        $resultado = $this->cupomModel->edit($cupom["id"], ["status" => $novo_status]);

        toast_new($resultado["toast"]);

        return redirect()->to("admin/cupons");
    }

    public function editar(int $cupom_id)
    {
        $dados = $this->request->getVar();

        $cupom = $this->cupomModel->find($cupom_id);

        $resultado = $this->cupomModel->edit($cupom["id"], $dados);

        toast_new($resultado["toast"]);

        return redirect()->to("admin/cupons");
    }
}
