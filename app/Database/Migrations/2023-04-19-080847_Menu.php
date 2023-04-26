<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Menu extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'mid' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'hid' => [
                'type'           => 'INT',
                'null' => true,
            ],
            'nama_menu' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null' => true,

            ], 'href' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'icon' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'deskripsi' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'urutan' => [
                'type' => 'INT',
                'null' => true,
            ]

        ]);
        $this->forge->addKey('mid', true);
        $this->forge->createTable('menu');
    }

    public function down()
    {
        $this->forge->dropTable('menu');
    }
}
