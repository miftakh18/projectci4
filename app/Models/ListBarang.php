<?php

namespace App\Models;

use CodeIgniter\Model;

class ListBarang extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'list_barang';
    protected $primaryKey       = 'lbid';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'hari', 'tanggal', 'jam', 'menit', 'dari', 'untuk', 'penerima', 'pemberi', 'penyedia', 'pemberi_waktu', 'penerima_waktu',
        'penyedia_waktu', 'no_pemberi', 'no_penerima', 'no_penyedia', 'simpan', 'keluar'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
