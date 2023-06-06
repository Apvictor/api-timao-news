<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

use App\Models\SistemaModel;

class SistemaSeeder extends Seeder
{
    public function run()
    {
        $sistemaModel = new SistemaModel();

        $sistemaModel->insert([
            "id" => 1,
            "codigo" => "1",
            "razao_social" => "Fox Software LTDA",
            "nome_fantasia" => "Fox Software",
            "cnpj" => "48.760.810/0001-72",
            "telefone" => "(11) 9950-5237",
            "email" => "foxsoftware@gmail.com",
            "senha" => "123456",
            "foto" => "http://localhost:8080/assets/uploads/2023-05-15_21-30-37_download.png",
        ]);
    }
}
