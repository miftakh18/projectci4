<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DListBk extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'dbid' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],

            'mbid' => [
                'type' => 'INT',
                'null' => true,
            ],
            'nama_barang' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null' => true
            ],
            'jumlah' => [
                'type' => 'INT',
                'null' => true,
            ],
            'status' => [
                'type' => 'INT',
                'default' => 0
            ]

        ]);
        $this->forge->addKey('dbid', true);
        $this->forge->createTable('detail_list_barang_keluar');
    }

    public function down()
    {
        $this->forge->dropTable('detail_list_barang_keluar');
    }
}
