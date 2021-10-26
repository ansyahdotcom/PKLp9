<?php

namespace App\Controllers;

use App\Models\DashboardModel;
use App\Models\KandidatModel;

class Dashboard extends BaseController
{
    // protected $loginModel;
    protected $DashboardModel;
    protected $KandidatModel;
    public function __construct()
    {
        // $this->loginModel = new LoginModel;
        $this->DashboardModel = new DashboardModel();
        $this->KandidatModel = new KandidatModel();
    }
    public function index()
    {
        $data = [
            'title'         => 'Dashboard Admin',
            'siswa'         => $this->DashboardModel->findAll(),
            'vote'          => $this->DashboardModel->getVoting()->getResultArray(),
            'user'          => $this->DashboardModel->getJumlahUser()->getResultArray(),
            'kandidat'      => $this->DashboardModel->getJumlahKandidat()->getResultArray(),
            'periode'       => $this->DashboardModel->getPeriode()->getResultArray(),
            'ketua'      => $this->KandidatModel->pemilihan()->getResultArray()
        ];
        echo view('admin/v_dashboard', $data);
    }
}
