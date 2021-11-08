<?php

namespace App\Controllers;

use App\Models\KandidatModel;
use App\Models\LoginModel;
use App\Models\VotingModel;
use App\Models\UserModel;
use App\Models\DashboardModel;
use App\Models\CekvoteModel;

class Landingpage extends BaseController
{
    protected $KandidatModel;
    protected $LoginModel;
    protected $VotingModel;
    protected $UserModel;
    protected $DashboardModel;
    protected $CekvoteModel;

    public function __construct()
    {
        $this->DashboardModel = new DashboardModel;
        $this->KandidatModel = new KandidatModel;
        $this->LoginModel = new LoginModel;
        $this->VotingModel = new VotingModel;
        $this->UserModel = new UserModel;
        $this->CekvoteModel = new CekvoteModel;
    }

    public function index()
    {
        $data = [
            'title'         => 'Pemilihan OSIS',
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

        // Cek nis di tabel cekvote
        $cek = $this->CekvoteModel->where(['nis' => session()->get('nis')])->first();
        if ($user == NULL) {
            return redirect()->to('/login');
        } else {
            $nis = $user['nis'];

            // Insert nis di tabel cekvote
            $data = [
                'nis' => $nis
            ];
            $this->CekvoteModel->cek($data);

            // Cek nis sesudah di insert
            $cekk = $this->CekvoteModel->where(['nis' => $nis])->first();

            // Cek kondisi
            if ($cek != $cekk) {
                $this->VotingModel->save([
                    'nis' => $nis,
                    'id_kandidat' => $this->request->getVar('vote')
                ]);

                // Update status pemilih
                $db = \Config\Database::connect();
                $db->query("UPDATE user SET st_pemilih = '1' WHERE nis = $nis");
                session()->setFlashdata('message', 'vote');
                return redirect()->to('/landingpage/vote');
            } else {
                session()->setFlashdata('message', 'donevote');
                return redirect()->to('/landingpage/vote');
            }
        }
    }
}
