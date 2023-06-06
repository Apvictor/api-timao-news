<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Models\SistemaModel;

class LoginController extends BaseController
{
    protected $sistemaModel;

    public function __construct()
    {
        $this->sistemaModel = new SistemaModel();
    }

    public function index()
    {
        $data = [
            "page" => "login",
            "page_title" => "Login"
        ];

        if (session()->get("isLoggedIn") && session()->get("connected") == "on") {
            return redirect()->to(base_url("admin/dashboard"));
        }

        return view('page/auth/' . $data["page"], $data);
    }

    public function login()
    {
        $data = $this->request->getVar();

        $existeSistema = $this->sistemaModel->getByEmail($data["email"]);

        if (!$existeSistema) {
            toast(TOAST_ERROR, "Revisar credenciais!", "Credenciais incorretas. Verifique e tente novamente.");
            return redirect()->to("/");
        }

        $hashSenha = $existeSistema['senha'];

        if ($data["senha"] !== $hashSenha) {
            toast(TOAST_ERROR, "Revisar credenciais!", "Credenciais incorretas. Verifique e tente novamente.");
            return redirect()->to("/");
        }

        session()->set('isLoggedIn', true);
        session()->set('connected', isset($data["conectado"]));
        session()->set('sistema', $existeSistema);

        toast(TOAST_SUCCESS, "Bem-vindo", $existeSistema["nome_fantasia"]);

        return redirect()->to("admin/dashboard");
    }

    /* Realiza logout do usuário */
    public function logout()
    {
        session()->destroy();
        return redirect()->to("/");
    }
}
