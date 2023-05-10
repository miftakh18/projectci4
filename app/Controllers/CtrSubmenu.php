<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Menu;
use App\Models\Hmenus;
use App\Models\Smenu;

class CtrSubmenu extends BaseController
{
    private $menu, $header, $submenu;

    public function __construct()
    {
        $this->menu  = new Menu();
        $this->header  = new Hmenus();
        $this->submenu  = new Smenu();
    }
    public function index()
    {
        $data["data"] = $this->submenu->findAll();
        foreach ($data["data"] as $key => $a) {
            $head  = $this->header->find($a['hid']);
            $menu  = $this->menu->find($a['mid']);
            $data['data'][$key]['header'] = isset($head['nama_head']) ? $head['nama_head'] : '';
            $data['data'][$key]['menu'] = isset($menu['nama_menu']) ? $menu['nama_menu'] : '';
            $data["data"][$key]["nomor"] = $key + 1;
        }
        // var_dump($data);
        return $this->response->setJSON($data);
    }

    public function menus($id = null)
    {

        if (!empty($id)) {
            $menu  = $this->menu->where(['hid' => $id, 'active' => 1])->findAll();
            $opt['html']   = '<option value="">Pilih Menu</option>';
            foreach ($menu as $key => $menu) {
                $opt['html']  .= '<option value="' . $menu['mid'] . '">' . $menu['nama_menu'] . '</option>';
            }
            return $this->response->setJSON($opt);
        } else {
            $opt['html']   = '<option value="">Pilih Menu</option>';
            return $this->response->setJSON($opt);
        }
    }

    public function add()
    {

        $input  = $this->request->getPost();

        $sql =   $this->submenu->insert($input);
        if ($sql == false) {
            $output["msg"] = "Data gagal Di Simpan";
            $output["icon"] = "error";
            $output['indikasi'] = $this->menu->errors();
        } else {
            $output["msg"] = "Data berhasil di Simpan";
            $output["icon"] = "success";
            $output['indikasi'] = "";
        }
        return $this->response->setJSON($output);
    }

    public function edit($id = null)
    {
        if (!empty($id != null)) {
            $edit = $this->submenu->find($id);
            // $edit = $this->hmenu->table('hmenu')->getWhere(['hid'=>$id]); //bisa menggunakan kondisi error nums_row >0
            if (isset($edit)) {
                $output["data"] = $edit;
            } else {
                $output["data"] = "Data belum ada";
            }
        } else {
            $output["data"] = "Data belum ada";
        }
        return $this->response->setJSON($output);
    }

    public function update($id  = null)
    {
        $update  = $this->request->getPost();
        $sql =   $this->submenu->update($id, $update);
        if ($sql == false) {
            $output["msg"] = "Data gagal Di Update";
            $output["icon"] = "error";
            $output['indikasi'] = $this->submenu->errors();
            // return  $this->response->setStatusCode(422)
            //     ->setJSON([$hmenu->errors()]);
        } elseif ($sql == true) {
            $output["msg"] = "Data berhasil di Update";
            $output["icon"] = "success";
            $output['indikasi'] = "";
        } else {

            $output["msg"] = "Data gagal Di Update";
            $output["icon"] = "error";
            $output['indikasi'] = $sql;
        }
        return $this->response->setJSON($output);
    }
}
