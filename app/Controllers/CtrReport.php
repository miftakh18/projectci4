<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Dompdf\Dompdf;
use App\Models\ListBarang;
use App\Models\DListBarang;

class CtrReport extends BaseController
{
    private $ListB, $dListB;
    public function __construct()
    {
        $this->dListB  = new DListBarang();
        $this->ListB = new ListBarang();
    }

    public function index()
    {
    }
    public function barang_masuk($id = null)
    {

        $data['utama'] =  $this->ListB->find($id);
        $data['detail'] =  $this->dListB->where('mbid', $id)->findAll();

        $dompdf = new Dompdf();

        // $html  = view('reports/report_barang');
        $filename = date('y-m-d-H-i-s') . '-qadr-labs-report';
        $data['title'] = 'TANDA TERIMA BARANG';
        $html  = view('reports/report_barang', $data);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'potrait');
        $dompdf->render();
        $dompdf->stream($filename . '.pdf', ["Attachment" => false]);
    }
}
