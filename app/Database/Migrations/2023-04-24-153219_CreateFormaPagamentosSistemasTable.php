<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateFormaPagamentosSistemasTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'forma_pagamento_id' => [
                'type' => 'INT',
            ],
            'sistema_id' => [
                'type' => 'INT',
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ["A", "I"],
                "comment" => "A: ATIVO | I: INATIVO",
                "default" => "A",
            ],
        ]);

        $this->forge->addKey('id', true);

        $this->forge->addForeignKey('forma_pagamento_id', 'forma_pagamentos', 'id');
        $this->forge->addForeignKey('sistema_id', 'sistemas', 'id');

        $this->forge->createTable('forma_pagamentos_sistemas');
    }

    public function down()
    {
        $this->forge->dropTable('forma_pagamentos_sistemas', true);
    }
}
