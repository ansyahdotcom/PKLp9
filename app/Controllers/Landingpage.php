<?php

namespace App\Controllers;

use App\Models\KandidatModel;
use App\Models\LoginModel;
use App\Models\VotingModel;
use App\Models\UserModel;
use App\Models\DashboardModel;

class Landingpage extends BaseController
{
    protected $KandidatModel;
    protected $LoginModel;
    protected $VotingModel;
    protected $UserModel;
    protected $DashboardModel;

    public function __construct()
    {
        $this->DashboardModel = new DashboardModel;
        $this->KandidatModel = new KandidatModel;
        $this->LoginModel = new LoginModel;
        $this->VotingModel = new VotingModel;
        $this->UserModel = new UserModel;
    }

    public function index()
    {
        $data = [
            'title'         => 'Landing Page',
            'siswa'         => $this->DashboardModel->findAll(),
            'vote'          => $this->DashboardModel->getVoting()->getResultArray(),
            'user'          => $this->DashboardModel->getJumlahUser()->getResultArray(),
            'kandidat'      => $this->DashboardModel->getJumlahKandidat()->getResultArray(),
            'periode'       => $this->DashboardModel->getPeriode()->getResultArray(),
            'ketua'         => $this->KandidatModel->pemilihan()->getResultArray(),
            'user'          => $this->LoginModel->where(['nis' => session()->get('nis')])->first()
        ];
        echo view('user/v_landing', $data);
    }

    public function vote()
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
                'user'          => $this->LoginModel->where(['nis' => session()->get('nis')])->first()
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
            return redirect()->to('/landingpage/vote');
        }
    }
}
