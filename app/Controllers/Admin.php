<?php

namespace App\Controllers;

use App\Models\AdminModel;

class Admin extends BaseController
{
    // protected $loginModel;
    protected $AdminModel;
    public function __construct()
    {
        // $this->loginModel = new LoginModel;
        $this->AdminModel = new AdminModel;
    }
    public function index()
    {
        $data = [
            'title' => 'Dashboard Admin',
            'siswa' => $this->AdminModel->findAll()
        ];
        echo view('admin/v_dashboard', $data);
    }
}
