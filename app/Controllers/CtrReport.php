<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Dompdf\Dompdf;
// use Dompdf\Options;
// use Mpdf\Mpdf;
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
        // $options = new Options();
        // $options->set('chroot', 'realpath');

        $data['utama'] =  $this->ListB->find($id);
        $data['detail'] =  $this->dListB->where('mbid', $id)->findAll();
        $data['gambar_apr'] = $this->imgtoBs64(ROOTPATH . '/public/assets/img/approve.svg');
        $dompdf = new Dompdf();

        // // $html  = view('reports/report_barang');
        $filename = date('y-m-d-H-i-s') . '-report';
        $data['title'] = 'TANDA TERIMA BARANG';
        $html  = view('reports/report_barang', $data);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'potrait');
        $dompdf->render();
        $dompdf->stream($filename . '.pdf', ["Attachment" => false]);
        // require_once base_url() . 'vendor/autoload.php';
        // $mpdf = new Mpdf();
        // // $html = view('html_to_pdf', []);
        // $mpdf->WriteHTML($html);
        // $this->response->setHeader('Content-Type', 'application/pdf');
        // $mpdf->Output('arjun.pdf', 'I'); // opens in browser
    }

    //    gagal
    private function imageToBase64($path)
    {

        $path  = $path;
        $type  = pathinfo($path, PATHINFO_EXTENSION);
        $data  = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64' . base64_encode($data);
        return $base64;
    }

    private function imgtoBs64($iamge_path = false, $image_type = 'png')
    {
        if ($iamge_path) {
            $img_data = fopen($iamge_path, 'rb');
            $img_size = filesize($iamge_path);
            $binary_image = fread($img_data, $img_size);
            fclose($img_data);
            $img_src = "data:image/" . $image_type . ";base64," . str_replace("\n", "", base64_encode($binary_image));
            return $img_src;
        }
        return false;
    }
}
