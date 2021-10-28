<?php

namespace App\Controllers;

use App\Models\LoginModel;
use App\Models\UserModel;

class Profile extends BaseController
{
    protected $LoginModel;
    public function __construct()
    {
        $this->LoginModel = new LoginModel;
        $this->UserModel = new UserModel;
    }

    public function index()
    {
        $user = $this->LoginModel->where(['nis' => session()->get('nis')])->first();
        if ($user == NULL) {
            return redirect()->to('/login');
        } else {
            $data = [
                'title' => 'Profile Siswa',
                'nis' => $user['nis'],
                'nama' => $user['nama_usr'],
            ];
            echo view('v_profile_user', $data);
        }
    }

    public function change_psswd()
    {
        $nis = $this->request->getVar('nis');
        $password = $this->request->getVar('password');
        $password2 = $this->request->getVar('password2');

        $login = $this->LoginModel->where(['nis' => $nis])->first();

        if ($login) {
            if (password_verify($password, $login['password'])) {
                $this->LoginModel->save([
                    'nis' => $nis,
                    'password' => password_hash($password2, PASSWORD_DEFAULT)
                ]);
                session()->setFlashdata('message', 'change_passwd');
                return redirect()->to('/profile');
            } else {
                session()->setFlashdata('message', 'wrong_passwd');
                return redirect()->to('/profile');
            }
        }
    }
}
