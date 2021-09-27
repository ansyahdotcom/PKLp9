<?php

namespace App\Controllers;

use App\Models\KandidatModel;

class Kandidat extends BaseController
{
    protected $KandidatModel;

    public function __construct()
    {
        $this->KandidatModel = new KandidatModel;
    }

    public function index()
    {
        $data = [
            'title' => 'Data Kandidat',
            'kandidat' => $this->KandidatModel->getKandidat()->getResultArray()
        ];
        echo view('admin/v_kandidat', $data);
    }
}
