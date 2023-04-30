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

    public function add()
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

    public function edit($id = null)
    {
        if (!empty($id != null)) {
            $edit = $this->hmenu->find($id);
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

        // if (!empty($id)) {
        //     return  $id;
        // } else {
        //     return 'kosong';
        // }

        $update  = $this->request->getPost();
        $arr = [
            'nama_head' => $update['nmheader'],
            'deskripsi' => $update['deskheader'],
            'urutan' => $update['urutanheader'],
            'active' => $update['aktif']
        ];
        $sql =   $this->hmenu->update($id, $arr);
        // var_dump($sql);

        if ($sql == false) {
            $output["msg"] = "Data gagal Di Update";
            $output["icon"] = "error";
            $output['indikasi'] = $this->hmenu->errors();
            // return  $this->response->setStatusCode(422)
            //     ->setJSON([$hmenu->errors()]);
        } else {
            $output["msg"] = "Data berhasil di Update";
            $output["icon"] = "success";
            $output['indikasi'] = "";
        }
        return $this->response->setJSON($output);
    }
}
