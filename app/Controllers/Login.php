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
        if (session()->get('username') != NULL) {
            session()->setFlashdata('pesan', $this->notify('Peringatan!', 'Anda sudah login!', 'warning', 'error'));
            return redirect()->to("/dashboard_user");
        }
        $data = [
            'title' => 'Login',
        ];
        echo view('v_login_user', $data);
    }

    public function login_user()
    {
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
                return redirect()->to('/dashboard_user');
            } else {
                session()->setFlashdata('password', '<small class="form-text text-danger">
                Password salah
                </small>');
                session()->setFlashdata('pesan', $this->notify('Perhatian!', 'Kata sandi salah. Harap cek kembali kata sandi Anda', 'danger', 'error'));
                return redirect()->to('/login');
            }
        } else {
            session()->setFlashdata('pesan', $this->notify('Perhatian!', 'Nama pengguna belum terdaftar', 'danger', 'error'));
            return redirect()->to('/login');
        }
    }

    public function admin()
    {
        if (session()->get('username') != NULL) {
            // session()->setFlashdata('pesan', $this->notify('Peringatan!', 'Anda sudah login!', 'warning', 'error'));
            // return redirect()->to("/dashboard");
            echo 'anda sudah login';
        }
        $data = [
            'title' => 'Login',
        ];
        echo view('v_login_admin', $data);
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
                return redirect()->to('/user');
            } else {
                session()->setFlashdata('password', '<small class="form-text text-danger">
                Password salah
                </small>');
                session()->setFlashdata('pesan', $this->notify('Perhatian!', 'Kata sandi salah. Harap cek kembali kata sandi Anda', 'danger', 'error'));
                return redirect()->to('/login/admin');
            }
        } else {
            session()->setFlashdata('pesan', $this->notify('Perhatian!', 'Nama pengguna belum terdaftar', 'danger', 'error'));
            return redirect()->to('/login/admin');
        }
    }

    public function logout()
    {
        session()->destroy(true);
        return redirect()->to('/login');
    }

    public function logout_admin()
    {
        session()->destroy(true);
        return redirect()->to('/login/admin');
    }

    function notify($title, $message, $type, $icon)
    {
        $pesan = "$.notify({
            icon: 'flaticon-$icon',
            title: '$title',
            message: '$message',
        },{
            type: '$type',
            placement: {
                from: 'top',
                align: 'center'
            },
            time: 1000,
        });";
        return $pesan;
    }
}
