<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ListBarang;
use App\Models\DListBarang;

class CtrDlb extends BaseController
{
    private $ListB, $dListB;

    public function __construct()
    {
        $this->dListB  = new DListBarang();
        $this->ListB = new ListBarang();
    }
    public function index()
    {
        //
    }
    public function show($id = null)
    {

        $detail  = $this->dListB->where(['mbid' => $id])->findAll();
        $html = '';
        foreach ($detail as $key => $detail) {
            $html .= '<tr>';
            $html .= '<td>' . $key + 1 . '</td>';
            $html .= '<td id="satu' . $detail['dbid'] . '">' . $detail['nama_barang'] . '</td>';
            $html .= '<td id="dua' . $detail['dbid'] . '">' . $detail['jumlah'] . '</td>';
            $html .= '<td id="tiga' . $detail['dbid'] . '" class="hd">
            <center><button type="button" id="deditlb" data-edit="' . $detail['dbid'] . '" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></button>
            <button id="dhapuslb" type="button" data-idmid="' . $detail['mbid'] . '" data-hapus="' . $detail['dbid'] . '" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button></center></td>';
            $html .= '</tr>';
        }

        return $this->response->setJSON(['html' => $html]);
    }

    public function new()
    {
        $data['title'] = 'List Barang |Formulir';
        return view('pages/p_lb/form', $data);
    }
    public function create()
    {
        $input  = $this->request->getPost();

        $sql =   $this->dListB->insert($input);
        if ($sql == false) {
            $output["msg"] = "Data gagal Di Simpan";
            $output["icon"] = "error";
            $output['indikasi'] = $this->dListB->errors();
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
            $edit = $this->dListB->find($id);
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
    public function update($id = null)
    {
        $update  = $this->request->getRawInput();

        $arr = [
            'nama_barang' => $update['nama_barang'],
            'jumlah' => $update['jumlah']
        ];
        $sql =   $this->dListB->update($id, $arr);
        if ($sql == false) {
            $output["msg"] = "Data gagal Di Update";
            $output["icon"] = "error";
            $output['indikasi'] = $this->dListB->errors();
            // return  $this->response->setStatusCode(422)
            //     ->setJSON([$hmenu->errors()]);
        } else {
            $output["msg"] = "Data berhasil di Update";
            $output["icon"] = "success";
            $output['indikasi'] = "";
        }
        return $this->response->setJSON($output);
    }


    public function delete($id = null)
    {
        $sql =   $this->dListB->delete($id);
        if ($sql == false) {
            $output["msg"] = "Data gagal Di Delete";
            $output["icon"] = "error";
            $output['indikasi'] = $this->dListB->errors();
            // return  $this->response->setStatusCode(422)
            //     ->setJSON([$hmenu->errors()]);
        } else {
            $output["msg"] = "Data berhasil di Delete";
            $output["icon"] = "success";
            $output['indikasi'] = "";
        }
        return $this->response->setJSON($output);
    }

    public function createMaster()
    {
    }
}
