<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsuariosSistemasTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'usuario_id' => [
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

        $this->forge->addForeignKey('usuario_id', 'usuarios', 'id');
        $this->forge->addForeignKey('sistema_id', 'sistemas', 'id');

        $this->forge->createTable('usuarios_sistemas');
    }

    public function down()
    {
        $this->forge->dropTable('usuarios_sistemas', true);
    }
}
