<?php

namespace App\Controllers;

use App\Models\UserModel;

class User extends BaseController
{
    // protected $loginModel;
    protected $UserModel;
    public function __construct()
    {
        // $this->loginModel = new LoginModel;
        $this->UserModel = new UserModel;
    }
    public function index()
    {
        $data = [
            'title' => 'data siswa',
            'siswa' => $this->UserModel->findAll()
        ];
        echo view('v_user', $data);
    }
}
