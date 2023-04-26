<?php

namespace App\Cells;

use CodeIgniter\View\Cells\Cell;

class CellModal extends Cell
{

    public $idhtml;
    public $nama_modal;
    public $idform;
    public $tipeKiriman;

    public function TarikModal()
    {
        return $this->view('view_cell/cell_modal_cell', [
            "idhtml" => $this->idhtml,
            "nama_modal" => $this->nama_modal,
            "idform" => $this->idform,
            "tipe" => $this->tipeKiriman
        ]);
    }
}
