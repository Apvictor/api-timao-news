<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreateCartoesTable extends Migration
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
            'nome' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
            'principal' => [
                'type' => 'INT',
                'default' => 0
            ],
            'numero' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
            'titular' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
            'cpf' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
            'validade' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
            'cvv' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ["A", "I"],
                "comment" => "A: ATIVO | I: INATIVO",
                "default" => "A",
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'default' => new RawSql('CURRENT_TIMESTAMP')
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'default' => new RawSql('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')
            ]
        ]);

        $this->forge->addKey('id', true);

        $this->forge->addForeignKey('usuario_id', 'usuarios', 'id');

        $this->forge->createTable('cartoes');
    }

    public function down()
    {
        $this->forge->dropTable('cartoes', true);
    }
}
