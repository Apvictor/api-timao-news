<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreateTokensTable extends Migration
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
            'authorization' => [
                'type' => 'TEXT',
            ],
            'expiracao' => [
                'type' => 'TEXT',
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'default' => new RawSql('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')
            ]
        ]);

        $this->forge->addKey('id', true);

        $this->forge->addForeignKey('usuario_id', 'usuarios', 'id');

        $this->forge->createTable('tokens');
    }

    public function down()
    {
        $this->forge->dropTable('tokens', true);
    }
}
