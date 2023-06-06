<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Libraries\AwsS3;

use App\Models\SistemaModel;

class ConfiguracaoController extends BaseController
{
    protected $sistemaModel;

    public function __construct()
    {
        $this->sistemaModel = new SistemaModel();
    }

    public function index()
    {
        $sistema = $this->sistemaModel->find(session()->get("sistema")["id"]);

        $data = [
            "page" => "configuracoes",
            "page_title" => "Configurações",
            "sistema" => $sistema
        ];

        return view('page/' . $data["page"], $data);
    }

    public function editar(int $id)
    {
        ini_set('memory_limit', '512M');

        $dados = $this->request->getVar();

        $validate = $this->validate([
            'foto' => [
                'uploaded[foto]',
                'mime_in[foto,image/jpg,image/jpeg,image/png]',
                'max_size[foto,1024]',
            ]
        ]);

        $img = $this->request->getFile('foto');

        if (isset($img) && $img->isValid()) {
            if (!$validate) {
                toast(TOAST_ERROR, "Falha", 'Tipo de arquivo não permitido!');
                return redirect()->to("admin/configuracoes");
            } else {
                $s3 = new AwsS3();
                $dados["foto"] = $s3->store($_FILES['foto']);
            }
        }

        try {
            $this->sistemaModel->update($id, $dados);

            $sistema = $this->sistemaModel->find($id);

            session()->set('sistema', $sistema);

            toast(TOAST_SUCCESS, "Sucesso", "Configuração salva com sucesso!");

            return redirect()->to('admin/configuracoes');
        } catch (\Exception $e) {
            toast(TOAST_ERROR, "Erro", $e->getMessage());
            return redirect()->to('admin/configuracoes');
        }
    }
}
