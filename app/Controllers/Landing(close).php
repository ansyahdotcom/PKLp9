<?php

namespace App\Controllers;

use App\Models\DashboardModel;
use App\Models\KandidatModel;

class Landing extends BaseController
{
    // protected $loginModel;
    protected $DashboardModel;
    protected $KandidatModel;

    public function __construct()
    {
        // $this->loginModel = new LoginModel;
        $this->DashboardModel   = new DashboardModel;
        $this->KandidatModel    = new KandidatModel;
    }

    public function index()
    {
        $data = [
            'title'         => 'Landing Page User',
            'siswa'         => $this->DashboardModel->findAll(),
            'vote'          => $this->DashboardModel->getVoting()->getResultArray(),
            'user'          => $this->DashboardModel->getJumlahUser()->getResultArray(),
            'kandidat'      => $this->DashboardModel->getJumlahKandidat()->getResultArray(),
            'periode'       => $this->DashboardModel->getPeriode()->getResultArray(),
            'ketua'         => $this->KandidatModel->pemilihan()->getResultArray()
        ];
        echo view('user/v_landing', $data);
    }

    public function pilih()
    {
        $data = [
            'title'         => 'Pilih Kandidat',
            'siswa'         => $this->DashboardModel->findAll(),
            'kandidat'      => $this->KandidatModel->findAll(),
            'ketua'         => $this->KandidatModel->pemilihan()->getResultArray()
        ];
        echo view('user/v_pilih', $data);
    }
}
