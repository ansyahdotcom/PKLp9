<?php

namespace App\Controllers;

use App\Models\KelasModel;

class Kelas extends BaseController
{
    protected $KelasModel;

    public function __construct()
    {
        $this->KelasModel = new KelasModel;
    }
    
    public function index()
    {
        $data = [
            'title'     => 'Data Kelas',
            'kelas'     => $this->KelasModel->getKelas()->getResultArray(),
            'jm_siswa'  => $this->KelasModel->getJumlahSiswa()
        ];
        echo view('admin/v_kelas', $data);
    }
}
