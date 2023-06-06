<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePedidosProdutosTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'pedido_id' => [
                'type' => 'INT',
            ],
            'produto_id' => [
                'type' => 'INT',
            ],
            'quantidade' => [
                'type' => 'INT',
            ]
        ]);

        $this->forge->addKey('id', true);

        $this->forge->addForeignKey('pedido_id', 'pedidos', 'id');
        $this->forge->addForeignKey('produto_id', 'produtos', 'id');

        $this->forge->createTable('pedidos_produtos');
    }

    public function down()
    {
        $this->forge->dropTable('pedidos_produtos', true);
    }
}
