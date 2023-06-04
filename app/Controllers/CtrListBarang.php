<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ListBarang;
use App\Models\DListBarang;

class CtrListBarang extends BaseController
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
    public function show($id = null)
    {
    }

    public function new()
    {
        $data  = $this->ListB->findAll();
        foreach ($data as $key => $as) {
            $data[$key]['nomor'] = $key + 1;
            $data[$key]['tanggal'] = date('d-m-Y', strtotime($as['tanggal']));
        }

        return $this->response->setJSON(['data' => $data]);
    }
    public function create()
    {
        $input  = $this->request->getPost();
        $arr  =
            [
                'hari' => $input['harilb'],
                'tanggal' => $input['tgllb'],
                'jam' => $input['jamlb'],
                'menit' => $input['menitlb'],
                'dari' => $input['darilb'],
                'untuk' => $input['untuklb']

            ];

        $sql =   $this->ListB->insert($arr);
        if ($sql == false) {
            $output["msg"] = "Data gagal Di Simpan";
            $output["icon"] = "error";
            $output['indikasi'] = $this->ListB->errors();
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
            $edit = $this->ListB->find($id);
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

        $arr  =
            [
                'hari' => $update['harilb'],
                'tanggal' => $update['tgllb'],
                'jam' => $update['jamlb'],
                'menit' => $update['menitlb'],
                'dari' => $update['darilb'],
                'untuk' => $update['untuklb']

            ];
        $sql =   $this->ListB->update($id, $arr);
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
        $sql1 =   $this->dListB->where(['mbid' => $id])->delete();
        if ($sql1 == true) {

            $sql =   $this->ListB->delete($id);
            if ($sql == false) {
                $output["msg"] = "Data gagal Di Delete";
                $output["icon"] = "error";
                $output['indikasi'] = $this->ListB->errors();
                // return  $this->response->setStatusCode(422)
                //     ->setJSON([$hmenu->errors()]);
            } else {
                $output["msg"] = "Data berhasil di Delete";
                $output["icon"] = "success";
                $output['indikasi'] = "";
            }
        } else {
            $output["msg"] = "Data gagal Di Delete";
            $output["icon"] = "error";
            $output['indikasi'] = $this->dListB->errors();
        }


        return $this->response->setJSON($output);
    }

    public function approve($id = null, $approve = null, $no_approve = null, $status = null)
    {
        $cek = $this->ListB->find($id);

        if (!empty($id) && !empty($approve) && !empty($status)) {
            switch ($status) {
                case 'pemberi':
                    $benar = (empty($cek['pemberi'])) ? 'benar' : 'salah';
                    break;
                case 'penerima':
                    if (!empty($cek['pemberi'])) {
                        $benar = (empty($cek['penerima'])) ? 'benar' : 'salah';
                    } else {
                        $benar  = 'salah';
                        $s = '';
                    }

                    break;
                case 'penyedia':
                    if (!empty($cek['penerima'])) {
                        $benar = (empty($cek['penyedia'])) ? 'benar' : 'salah';
                    } else {
                        $benar  = 'salah';
                        $s = '';
                    }
                    break;
                default:
                    $benar = 'salah';
                    $s = 'Bukan Approved';

                    break;
            }
            if ($benar == 'benar') {

                $time_f =   $status . '_waktu';
                $nohp = 'no_' . $status;
                $arr =    [$status => $approve, $nohp => $no_approve, $time_f => date('Y-m-d H:i:s')];
                // var_dump($arr);            // exit;
                $sql =  $this->ListB->update($id, $arr);
                if ($sql == true) {
                    $output["msg"] = "Data berhasil di Approve" . ucfirst($status);
                    $output["icon"] = "success";
                    $output['indikasi'] = "";
                } else {
                    $output["msg"] = "Data gagal Di Approve";
                    $output["icon"] = "error";
                    $output['indikasi'] = $this->dListB->errors();
                }
            } else {
                $output["msg"] = ($s == '') ? "Data Sudah Di Approve Sebelumnya" : $s;
                $output["icon"] = "error";
                $output['indikasi'] = $this->dListB->errors();
            }
            return $this->response->setJSON($output);
        }
    }

    public function showApprove()
    {
        $data  = $this->ListB->where('penerima IS NOT NULL')->findAll();
        foreach ($data as $key => $as) {
            $data[$key]['nomor'] = $key + 1;
            $data[$key]['tanggal'] = date('d-m-Y', strtotime($as['tanggal']));
        }

        return $this->response->setJSON(['data' => $data]);
    }
}
