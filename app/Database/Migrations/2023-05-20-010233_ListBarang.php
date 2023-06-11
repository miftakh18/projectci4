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
            'hari' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null' => true
            ],
            'tanggal' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null' => true
            ],
            'jam' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null' => true
            ],
            'menit' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null' => true
            ],

            'dari' => [
                'type'       => 'TEXT',
                'constraint' => '100',
                'null' => true
            ],
            'untuk' => [
                'type'       => 'TEXT',
                'constraint' => '100',
                'null' => true
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
            'penerima_waktu' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null' => true
            ],
            'pemberi_waktu' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null' => true
            ],
            'penyedia_waktu' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null' => true
            ],
            'no_penerima' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null' => true
            ],
            'no_pemberi' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null' => true
            ],
            'no_penyedia' => [
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
