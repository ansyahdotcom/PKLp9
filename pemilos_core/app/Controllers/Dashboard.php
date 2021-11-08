<?php

namespace App\Controllers;

use App\Models\DashboardModel;
use App\Models\KandidatModel;
use App\Models\VotingModel;
use App\Models\LoginAdminModel;
<<<<<<< Updated upstream:pemilos_core/app/Controllers/Dashboard.php
use App\Models\CekvoteModel;
=======
use App\Models\UserModel;
>>>>>>> Stashed changes:app/Controllers/Dashboard.php

class Dashboard extends BaseController
{
    // protected $loginModel;
    protected $DashboardModel;
    protected $KandidatModel;
    protected $VotingModel;
    protected $LoginAdminModel;
<<<<<<< Updated upstream:pemilos_core/app/Controllers/Dashboard.php
    protected $CekvoteModel;
=======
    protected $UserModel;
>>>>>>> Stashed changes:app/Controllers/Dashboard.php
    public function __construct()
    {
        // $this->loginModel = new LoginModel;
        $this->DashboardModel = new DashboardModel();
        $this->KandidatModel = new KandidatModel();
        $this->VotingModel = new VotingModel();
        $this->LoginAdminModel = new LoginAdminModel();
<<<<<<< Updated upstream:pemilos_core/app/Controllers/Dashboard.php
        $this->CekvoteModel = new CekvoteModel();
=======
        $this->UserModel = new UserModel();
>>>>>>> Stashed changes:app/Controllers/Dashboard.php
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
        $this->UserModel
            ->set('st_pemilih', '0')
            ->where('st_pemilih', '1')
            ->update();

        $this->VotingModel->like('created_at', '' . date('Y') . '%')->delete();
        $this->CekvoteModel->emptyTable('cekvote');
        session()->setFlashdata('message', 'reset');
        return redirect()->to('dashboard');
    }
}
