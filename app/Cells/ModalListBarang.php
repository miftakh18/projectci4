<?php

namespace App\Cells;

use CodeIgniter\View\Cells\Cell;

class ModalListBarang extends Cell
{

    public function Modaladd()
    {

        return $this->view('view_cell/modal_list_barang');
    }
    public function  getAIid($nmdb = 'inventori', $tb = 'list_barang')
    {
        // return model('ListBarang')->insertID();
        $db = db_connect();
        $sqll = "SELECT `AUTO_INCREMENT` as id FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$nmdb' AND   TABLE_NAME   = '$tb';";
        $query = $db->query($sqll);
        return $query->getFirstRow()->id;
    }

    public function viewModal()
    {
        $data
            = ['views' => 'readonly'];
        return $this->view('view_cell/modal_list_barang', $data);
    }
}
