<?php

namespace App\Controllers;

use App\Models\DashboardModel;

class Dashboard extends BaseController
{
    // protected $loginModel;
    protected $DashboardModel;
    public function __construct()
    {
        // $this->loginModel = new LoginModel;
        $this->DashboardModel = new DashboardModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Dashboard Admin',
            'siswa' => $this->DashboardModel->findAll(),
            'jm_kandidat'  => $this->DashboardModel->getJumlahKandidat()
        ];
        echo view('admin/v_dashboard', $data);
    }
}
