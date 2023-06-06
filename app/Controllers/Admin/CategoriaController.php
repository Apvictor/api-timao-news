<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CategoriaModel;

class CategoriaController extends BaseController
{
    protected $categoriaModel;

    public function __construct()
    {
        $this->categoriaModel = new CategoriaModel();
    }

    public function index()
    {
        $filtros = $this->request->getVar();
        $filtros["sistema"] = get_sistema_admin();

        $data = [
            "page" => "categorias",
            "page_title" => "Categorias",
            "categorias" => $this->categoriaModel->getAll($filtros),
            "search" => !empty($filtros["search"]) ? $filtros["search"] : ""
        ];

        return view("page/" . $data["page"], $data);
    }

    public function cadastrar()
    {
        $dados = $this->request->getVar();
        $dados["sistema_id"] = get_sistema_admin();

        $resultado = $this->categoriaModel->add($dados);

        toast_new($resultado["toast"]);

        if ($resultado["error"]) return redirect()->to("admin/categorias");

        return redirect()->to("admin/categorias");
    }

    public function status(int $categoria_id)
    {
        $categoria = $this->categoriaModel->find($categoria_id);
        $novo_status = $categoria["status"] == ATIVO ? INATIVO : ATIVO;

        $resultado = $this->categoriaModel->edit($categoria["id"], ["status" => $novo_status]);

        toast_new($resultado["toast"]);

        if ($resultado["error"]) return redirect()->to("admin/categorias");

        return redirect()->to("admin/categorias");
    }

    public function editar(int $categoria_id)
    {
        $dados = $this->request->getVar();
        $categoria = $this->categoriaModel->find($categoria_id);

        $resultado = $this->categoriaModel->edit($categoria["id"], $dados);

        toast_new($resultado["toast"]);

        if (!$resultado["error"]) return redirect()->to("admin/categorias");

        return redirect()->to("admin/categorias");
    }
}
