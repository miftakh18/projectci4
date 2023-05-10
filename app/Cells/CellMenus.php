<?php

namespace App\Cells;

use CodeIgniter\View\Cells\Cell;

class CellMenus extends Cell
{


    public function viewMenus()
    {
        return $this->view('view_cell/cell_menus_cell');
    }

    protected function Header()
    {
        return model('Hmenus')->where('active', 1)->findAll();
    }
    protected  function Menu($id)
    {
        return model('menu')->where(['hid' => $id, 'active' => 1])->orderBy('urutan', 'ASC')->findAll();
    }

    protected function SubM($hid, $mid)
    {
        return  model('Smenu')->where(['mid' => $mid, 'hid' => $hid, 'active' => 1])->orderBy('urutan', 'ASC')->findAll();
    }
}
