<?php

namespace App\Controllers;

use App\Models\DashboardModel;
use App\Models\KandidatModel;
use App\Models\VotingModel;
use App\Models\LoginAdminModel;
use App\Models\CekvoteModel;

class Dashboard extends BaseController
{
    // protected $loginModel;
    protected $DashboardModel;
    protected $KandidatModel;
    protected $VotingModel;
    protected $LoginAdminModel;
    protected $CekvoteModel;
    public function __construct()
    {
        // $this->loginModel = new LoginModel;
        $this->DashboardModel = new DashboardModel();
        $this->KandidatModel = new KandidatModel();
        $this->VotingModel = new VotingModel();
        $this->LoginAdminModel = new LoginAdminModel();
        $this->CekvoteModel = new CekvoteModel();
    }

    public function index()
    {
        $user = $this->LoginAdminModel->where(['username' => session()->get('username')])->first();
        if ($user == NULL) {
            return redirect()->to('/admin');
        } else {
            $data = [
                'title'         => 'Dashboard Admin',
                'siswa'         => $this->DashboardModel->findAll(),
                'vote'          => $this->DashboardModel->getVoting()->getResultArray(),
                'user'          => $this->DashboardModel->getJumlahUser()->getResultArray(),
                'kandidat'      => $this->DashboardModel->getJumlahKandidat()->getResultArray(),
                'periode'       => $this->DashboardModel->getPeriode()->getResultArray(),
                'ketua'         => $this->KandidatModel->pemilihan()->getResultArray()
            ];
            echo view('admin/v_dashboard', $data);
        }
    }

    public function resett()
    {
        $this->VotingModel->like('created_at', '' . date('Y') . '%')->delete();
        $this->CekvoteModel->emptyTable('cekvote');
        session()->setFlashdata('message', 'reset');
        return redirect()->to('dashboard');
    }
}
