<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ListBarang extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'lbid' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
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
            'penerima' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null' => true
            ],
            'pemberi' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null' => true
            ],
            'penyedia' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null' => true
            ],

        ]);
        $this->forge->addKey('lbid', true);
        $this->forge->createTable('list_barang');
    }

    public function down()
    {
        $this->forge->dropTable('list_barang');
    }
}
