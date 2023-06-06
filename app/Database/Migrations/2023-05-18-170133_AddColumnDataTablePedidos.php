<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnDataTablePedidos extends Migration
{
    public function up()
    {
        $fields = [
            'data' => ['type' => 'TEXT']
        ];

        $this->forge->addColumn('pedidos', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('pedidos', "data");
    }
}
