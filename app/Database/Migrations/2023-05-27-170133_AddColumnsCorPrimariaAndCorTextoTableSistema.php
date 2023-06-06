<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnsCorPrimariaAndCorTextoTableSistema extends Migration
{
    public function up()
    {
        $fields = [
            'cor_primaria' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => true,
                "default" => "#F8D849",
            ],
            'cor_texto' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => true,
                "default" => "#000000",
            ]
        ];

        $this->forge->addColumn('sistemas', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('sistemas', [
            "cor_primaria",
            "cor_texto"
        ]);
    }
}
