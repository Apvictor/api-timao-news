<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreateUsuariosTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'nome' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
            'sobrenome' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
            'cpf' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => true,
            ],
            'telefone' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
            'senha' => [
                'type' => 'TEXT',
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
        
        $this->forge->addUniqueKey('email');
        $this->forge->addUniqueKey('cpf');
        $this->forge->addUniqueKey('telefone');

        $this->forge->createTable('usuarios');
    }

    public function down()
    {
        $this->forge->dropTable('usuarios', true);
    }
}
