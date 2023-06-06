<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Models\UsuarioModel;
use App\Models\UsuarioSistemaModel;

use Exception;

class UsuarioController extends BaseController
{
    protected $usuarioModel;
    protected $usuarioSistemaModel;

    public function __construct()
    {
        $this->usuarioModel = new UsuarioModel();
        $this->usuarioSistemaModel = new UsuarioSistemaModel();
    }

    public function index()
    {
        $filtros = $this->request->getVar();

        $data = [
            "page" => "usuarios",
            "page_title" => "Usuários",
            "usuarios" => $this->usuarioModel->getAll($filtros),
            "filtros" => $filtros
        ];

        return view('page/' . $data["page"], $data);
    }

    public function status(int $id)
    {
        $usuario = $this->usuarioModel->getById($id);
        $novo_status = $usuario["status"] == ATIVO ? INATIVO : ATIVO;

        try {
            $this->usuarioSistemaModel->setStatus($usuario["usuarios_sistemas_id"], $novo_status);
            toast(TOAST_SUCCESS, "Sucesso", "Usuário salvo com sucesso!");
            return redirect()->to("admin/usuarios");
        } catch (Exception $e) {
            toast(TOAST_ERROR, "Erro", $e->getMessage());
            return redirect()->to("admin/usuarios");
        }
    }
}
