<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreateSistemasTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'codigo' => [
                'type' => 'TEXT',
            ],
            'razao_social' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
            'nome_fantasia' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
            'ramo_sistema' => [
                'type' => 'ENUM',
                'constraint' => [
                    "adega",
                    "açaiteria",
                    "confeitaria",
                    "hortifruti",
                    "hamburgueria",
                    "pizzaria",
                    "restaurante"
                ],
                "default" => "adega",
            ],
            'cnpj' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
            'telefone' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
            'senha' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
            'foto' => [
                'type' => 'TEXT',
            ],
            'cep' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
            'endereco' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
            'numero' => [
                'type' => 'INT',
            ],
            'estado' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
            'cidade' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
            'tempo_entrega_min' => [
                'type' => 'INT',
            ],
            'tempo_entrega_max' => [
                'type' => 'INT',
            ],
            'pix' => [
                'type' => 'TEXT',
            ],
            'aberto' => [
                'type' => 'TIME',
            ],
            'fechado' => [
                'type' => 'TIME',
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

        $this->forge->createTable('sistemas');
    }

    public function down()
    {
        $this->forge->dropTable('sistemas', true);
    }
}
