<?php

namespace App\Controllers;

use App\Models\KandidatModel;

class Dashboard_user extends BaseController
{
    protected $KandidatModel;
    public function __construct()
    {
        $this->KandidatModel = new KandidatModel;
    }

    public function index()
    {
        $data = [
            'title' => 'Dashboard User',
            'kandidat' => $this->KandidatModel->pemilihan()->getResultArray()
        ];
        echo view('v_dashboard_user', $data);
    }
}
