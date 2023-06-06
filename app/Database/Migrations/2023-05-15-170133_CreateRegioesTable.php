<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreateRegioesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'sistema_id' => [
                'type' => 'INT',
            ],
            'cep' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
            'frete' => [
                'type' => 'DOUBLE(10,2)',
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

        $this->forge->addForeignKey('sistema_id', 'sistemas', 'id');

        $this->forge->createTable('regioes');
    }

    public function down()
    {
        $this->forge->dropTable('regioes', true);
    }
}
