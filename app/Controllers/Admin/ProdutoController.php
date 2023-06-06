<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Models\CategoriaModel;
use App\Models\ProdutoModel;

class ProdutoController extends BaseController
{
    protected $produtoModel;
    protected $categoriaModel;

    public function __construct()
    {
        $this->produtoModel = new ProdutoModel();
        $this->categoriaModel = new CategoriaModel();
    }

    public function index()
    {
        $filtros = $this->request->getVar();
        $filtros["sistema"] = get_sistema_admin();

        $categorias = $this->categoriaModel->getAll(["status" => ATIVO, "sistema" => get_sistema_admin()]);

        $produtos = $this->produtoModel->getAll($filtros);

        $data = [
            "page" => "produtos",
            "page_title" => "Produtos",
            "categorias" => $categorias,
            "produtos" => $produtos,
            "filtros" => $filtros
        ];

        return view('page/' . $data["page"], $data);
    }

    public function cadastrar()
    {
        $dados = $this->request->getVar();
        $img = $this->request->getFile('foto');

        $resultado = $this->produtoModel->add($dados, $img);

        toast_new($resultado["toast"]);

        return redirect()->to("admin/produtos");
    }

    public function status(int $id)
    {
        $produto = $this->produtoModel->find($id);
        $novo_status = $produto["status"] == ATIVO ? INATIVO : ATIVO;

        $resultado = $this->produtoModel->edit($produto["id"], ["status" => $novo_status]);

        toast_new($resultado["toast"]);

        return redirect()->to("admin/produtos");
    }

    public function editar(int $id)
    {
        $dados = $this->request->getVar();
        $img = $this->request->getFile('foto');
        $produto = $this->produtoModel->find($id);

        $resultado = $this->produtoModel->edit($produto["id"], $dados, $img);

        toast_new($resultado["toast"]);

        return redirect()->to("admin/produtos");
    }
}
