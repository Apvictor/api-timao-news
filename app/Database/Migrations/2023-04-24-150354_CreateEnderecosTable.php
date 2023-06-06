<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreateEnderecosTable extends Migration
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
            'principal' => [
                'type' => 'INT',
                'default' => 0
            ],
            'cep' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
            'endereco' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
            'bairro' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
            'numero' => [
                'type' => 'INT',
            ],
            'cidade' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
            'estado' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
            'complemento' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => true,
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

        $this->forge->createTable('enderecos');
    }

    public function down()
    {
        $this->forge->dropTable('enderecos', true);
    }
}
