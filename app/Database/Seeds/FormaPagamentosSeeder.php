<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

use App\Models\FormaPagamentoModel;

class FormaPagamentosSeeder extends Seeder
{
    public function run()
    {
        $formaPagamentoModel = new FormaPagamentoModel();

        $formaPagamentoModel->insert(["id" => 1, "descricao" => "Cartão (Pagamento online)"]);
        $formaPagamentoModel->insert(["id" => 2, "descricao" => "Pix"]);
        $formaPagamentoModel->insert(["id" => 3, "descricao" => "Dinheiro"]);
        $formaPagamentoModel->insert(["id" => 4, "descricao" => "Cartão (Pagamento entrega)"]);
    }
}
