<?php

namespace App\Cells;

use CodeIgniter\View\Cells\Cell;

class PanggilPluginAll extends Cell
{
    public function  pluginCss()
    {
        return $this->view('view_cell/panggil_css_cell');
    }
    public function  pluginJs()
    {
        return $this->view('view_cell/panggil_js_cell');
    }
}
