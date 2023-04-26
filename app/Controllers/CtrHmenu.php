<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Hmenus;

class CtrHmenu extends BaseController
{
    private $hmenu;
    public function __construct()
    {
        $this->hmenu  = new Hmenus();
    }
    public function index()
    {
        $data["data"] = $this->hmenu->findAll();
        foreach ($data["data"] as $key => $a) {
            $data["data"][$key]["nomor"] = $key + 1;
        }
        return $this->response->setJSON($data);
    }

    public function tambahHeader()
    {
        $input  = $this->request->getPost();

        $sql =   $this->hmenu->insert([
            'nama_head' => $input['nmheader'],
            'deskripsi' => $input['deskheader'],
            'urutan' => $input['urutanheader']
        ]);
        if ($sql == false) {
            $output["msg"] = "Data gagal Di Simpan";
            $output["icon"] = "error";
            $output['indikasi'] = $this->hmenu->errors();
            // return  $this->response->setStatusCode(422)
            //     ->setJSON([$hmenu->errors()]);
        } else {
            $output["msg"] = "Data berhasil di Simpan";
            $output["icon"] = "success";
            $output['indikasi'] = "";
        }
        return $this->response->setJSON($output);
    }
}
