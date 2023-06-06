<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\Pagarme;
use App\Models\GatewayModel;

class GatewayController extends BaseController
{
    protected $gatewayModel;

    public function __construct()
    {
        $this->gatewayModel = new GatewayModel();
    }

    public function index()
    {
        $filtros = $this->request->getVar();
        $filtros["sistema"] = get_sistema_admin();

        $data = [
            "page" => "gateways",
            "page_title" => "Gateways de Pagamento",
            "gateways" => $this->gatewayModel->getAll($filtros),
            "search" => !empty($filtros["search"]) ? $filtros["search"] : ""
        ];

        return view("page/" . $data["page"], $data);
    }

    public function cadastrar()
    {
        $dados = $this->request->getVar();
        $dados["sistema_id"] = get_sistema_admin();
        $dados["status"] = INATIVO;

        $resultado = $this->gatewayModel->add($dados);

        toast_new($resultado["toast"]);

        return redirect()->to("admin/gateways");
    }

    public function status(int $gateway_id)
    {
        $gateway = $this->gatewayModel->find($gateway_id);
        $novo_status = $gateway["status"] == ATIVO ? INATIVO : ATIVO;

        if ($novo_status === ATIVO) {
            $gateways = $this->gatewayModel
                ->where([
                    "sistema_id" => get_sistema_admin(),
                    "status" => ATIVO
                ])
                ->findAll();

            for ($i = 0; $i < count($gateways); $i++) {
                $this->gatewayModel->edit($gateways[$i]["id"], ["status" => INATIVO]);
            }
        }

        $resultado = $this->gatewayModel->edit($gateway["id"], ["status" => $novo_status]);

        toast_new($resultado["toast"]);

        return redirect()->to("admin/gateways");
    }

    public function editar(int $gateway_id)
    {
        $dados = $this->request->getVar();
        $gateway = $this->gatewayModel->find($gateway_id);

        $resultado = $this->gatewayModel->edit($gateway["id"], $dados);

        toast_new($resultado["toast"]);

        return redirect()->to("admin/gateways");
    }

    public function setDadosGateway()
    {
    }
}
