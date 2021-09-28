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
            'title' => 'data siswa',
            'siswa' => $this->DashboardModel->getDashboard()
        ];
        echo view('admin/v_dashboard', $data);
    }
}
