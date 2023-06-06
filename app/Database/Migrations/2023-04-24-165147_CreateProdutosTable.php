<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreateProdutosTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'categoria_id' => [
                'type' => 'INT',
            ],
            'nome' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
            'descricao' => [
                'type' => 'TEXT',
            ],
            'foto' => [
                'type' => 'TEXT',
            ],
            'preco' => [
                'type' => 'DOUBLE(10,2)',
            ],
            'quantidade' => [
                'type' => 'INT',
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

        $this->forge->addForeignKey('categoria_id', 'categorias', 'id');

        $this->forge->createTable('produtos');
    }

    public function down()
    {
        $this->forge->dropTable('produtos', true);
    }
}
