<?php

namespace App\Controllers;

use App\Models\KandidatModel;
use App\Models\LoginModel;
use App\Models\VotingModel;
use App\Models\UserModel;

class Dashboard_user extends BaseController
{
    protected $KandidatModel;
    protected $LoginModel;
    protected $VotingModel;
    protected $UserModel;
    public function __construct()
    {
        $this->KandidatModel = new KandidatModel;
        $this->LoginModel = new LoginModel;
        $this->VotingModel = new VotingModel;
        $this->UserModel = new UserModel;
    }

    public function index()
    {
        $user = $this->LoginModel->where(['nis' => session()->get('nis')])->first();
        if ($user == NULL) {
            return redirect()->to('/login');
        } else {
            $data = [
                'title' => 'Dashboard User',
                'nis' => $user['nis'],
                'nama' => $user['nama_usr'],
                'st_pemilih' => $user['st_pemilih'],
                'periode' => $this->KandidatModel->periode()->getResultArray(),
                'kandidat' => $this->KandidatModel->pemilihan()->getResultArray(),
                // 'dt_kandidat' => $this->KandidatModel->detail_pemilihan()->getResultArray()
            ];
            echo view('v_dashboard_user', $data);
        }
    }

    public function submit()
    {
        $user = $this->LoginModel->where(['nis' => session()->get('nis')])->first();
        if ($user == NULL) {
            return redirect()->to('/login');
        } else {
            $nis = $user['nis'];
            $this->VotingModel->save([
                'nis' => $this->request->getVar('nis'),
                'id_kandidat' => $this->request->getVar('vote')
            ]);
            $db = \Config\Database::connect();
            $db->query("UPDATE user SET st_pemilih = '1' WHERE nis = $nis");
            session()->setFlashdata('message', 'vote');
            return redirect()->to('/dashboard_user');
        }
    }
}
