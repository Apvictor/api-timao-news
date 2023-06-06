<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ManageSeeder extends Seeder
{
    public function run()
    {
        $this->call('FormaPagamentosSeeder');
        $this->call('SistemaSeeder');
    }
}
