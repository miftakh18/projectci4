<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Hmenu extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'hid' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_head' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null' => true,

            ],
            'deskripsi' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'urutan' => [
                'type' => 'INT',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('hid', true);
        $this->forge->createTable('hmenu');
    }

    public function down()
    {
        $this->forge->dropTable('hmenu');
    }
}
