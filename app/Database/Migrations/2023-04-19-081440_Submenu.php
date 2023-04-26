<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Submenu extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'smid' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'mid' => [
                'type'           => 'INT',
                'null' => true,
            ],
            'hid' => [
                'type'           => 'INT',
                'null' => true,
            ],
            'nama_submenu' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null' => true,

            ], 'href' => [
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
        $this->forge->addKey('smid', true);
        $this->forge->createTable('submenu');
    }

    public function down()
    {
        $this->forge->dropTable('submenu');
    }
}
