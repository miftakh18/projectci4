<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Menu;
use App\Models\Hmenus;

class CtrMenu extends BaseController
{
    private $menu, $header;
    public function __construct()
    {
        $this->menu  = new Menu();
        $this->header  = new Hmenus();
    }
    public function index()
    {
        $data["data"] = $this->menu->findAll();
        foreach ($data["data"] as $key => $a) {
            $head  = $this->header->find($a['hid']);
            $data['data'][$key]['header'] = isset($head['nama_head']) ? $head['nama_head'] : '';
            $data["data"][$key]["nomor"] = $key + 1;
        }
        // var_dump($data);
        return $this->response->setJSON($data);
    }

    public function add()
    {

        $input  = $this->request->getPost();

        $sql =   $this->menu->insert($input);
        if ($sql == false) {
            $output["msg"] = "Data gagal Di Simpan";
            $output["icon"] = "error";
            $output['indikasi'] = $this->menu->errors();
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
