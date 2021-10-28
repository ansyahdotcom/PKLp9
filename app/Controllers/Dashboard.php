<?php

namespace App\Controllers;

use App\Models\DashboardModel;
use App\Models\KandidatModel;
use App\Models\VotingModel;

class Dashboard extends BaseController
{
    // protected $loginModel;
    protected $DashboardModel;
    protected $KandidatModel;
    protected $VotingModel;
    public function __construct()
    {
        // $this->loginModel = new LoginModel;
        $this->DashboardModel = new DashboardModel();
        $this->KandidatModel = new KandidatModel();
        $this->VotingModel = new VotingModel();
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

    public function resett()
    {
        $this->VotingModel->like('created_at', '2021%')->delete();
        return redirect()->to('dashboard');
    }
}
