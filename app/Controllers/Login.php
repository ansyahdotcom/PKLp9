<?php

namespace App\Controllers;

use App\Models\LoginModel;
use App\Models\LoginAdminModel;

class Login extends BaseController
{
    protected $LoginModel;
    protected $LoginAdminModel;
    public function __construct()
    {
        $this->LoginModel = new LoginModel;
        $this->LoginAdminModel = new LoginAdminModel;
    }

    public function index()
    {
        $user = $this->LoginModel->where(['nis' => session()->get('nis')])->first();
        if ($user != NULL) {
            return redirect()->to("/dashboard_user");
        } else if (session()->get('username') != NULL) {
            return redirect()->to("/admin");
        }
        $data = [
            'title' => 'Login',
            'validation' => \Config\Services::validation()
        ];
        echo view('v_login_user', $data);
    }

    public function login_user()
    {
        if (!$this->validate([
            'nis' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'NIS harus diisi!',
                    'numeric' => 'NIS harus angka!'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[8]',
                'errors' => [
                    'required' => 'Password harus diisi!',
                    'min_length[8]' => 'Password terlalu pendek!'
                ]
            ]
        ])) {
            // $validation = \Config\Services::validate();
            return redirect()->to('/login')->withInput();
        }
        $nis = $this->request->getVar('nis');
        $password = $this->request->getVar('password');

        $login = $this->LoginModel->where(['nis' => $nis])->first();

        if ($login) {
            if (password_verify($password, $login['password'])) {
                $data = [
                    'nis' => $login['nis'],
                    'st_pemilih' => $login['st_pemilih']
                ];
                session()->set($data);
                session()->setFlashdata('message', 'login');
                return redirect()->to('/dashboard_user');
            } else {
                session()->setFlashdata('message', 'wrong_passwd');
                return redirect()->to('/login');
            }
        } else {
            session()->setFlashdata('message', 'belum_terdaftar');
            return redirect()->to('/login');
        }
    }

    public function admin()
    {
        if (session()->get('nis') != NULL) {
            return redirect()->to('/login');
        } else if (session()->get('username') != NULL) {
            return redirect()->to('/dashboard');
        } else {
            $data = [
                'title' => 'Login',
            ];
            echo view('v_login_admin', $data);
        }
    }

    public function login_admin()
    {
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $login = $this->LoginAdminModel->where(['username' => $username])->first();

        if ($login) {
            if (password_verify($password, $login['password'])) {
                $data = [
                    'username' => $login['username']
                ];
                session()->set($data);
                session()->setFlashdata('message', 'login');
                return redirect()->to('/dashboard');
            } else {
                session()->setFlashdata('message', 'wrong_passwd');
                return redirect()->to('/admin');
            }
        } else {
            session()->setFlashdata('message', 'belum_terdaftar');
            return redirect()->to('/admin');
        }
    }

    public function logout()
    {
        session()->destroy(TRUE);
        session()->setFlashdata('message', 'logout');
        return redirect()->to('/login');
    }

    public function logout_admin()
    {
        session()->destroy(TRUE);
        session()->setFlashdata('message', 'logout');
        return redirect()->to('/login/admin');
    }

    public function forgot_password()
    {
        echo view('forgot_password');
    }
}
