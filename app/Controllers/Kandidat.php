<?php

namespace App\Controllers;

use App\Models\KandidatModel;
use App\Models\UserModel;
use App\Models\PeriodeModel;

class Kandidat extends BaseController
{
    protected $KandidatModel;
    protected $UserModel;
    protected $PeriodeModel;

    public function __construct()
    {
        $this->KandidatModel = new KandidatModel;
        $this->UserModel = new UserModel;
        $this->PeriodeModel = new PeriodeModel;
    }

    /**
     * ===========================================================
     * Fungsi menampilkan data kandidat
     * ===========================================================
     */
    public function index()
    {
        $data = [
            'title' => 'Data Kandidat',
            'periode' => $this->PeriodeModel->getPeriode(),
            'kandidat' => $this->KandidatModel->getKandidat()
        ];
        echo view('admin/v_kandidat', $data);
    }

    /**
     * ===========================================================
     * Fungsi menampilkan form tambah kandidat
     * ===========================================================
     */
    public function addKandidat()
    {
        $data = [
            'title' => 'Tambah Kandidat',
            'user' => $this->UserModel->getUser()->getResultArray(),
            'validation' => \Config\Services::validation()
        ];
        echo view('admin/v_addKandidat', $data);
    }

    /**
     * ===========================================================
     * Fungsi menyimpan data kandidat
     * ===========================================================
     */
    public function save()
    {
        /**
         * ===========================================================
         * Validasi Form
         * ===========================================================
         */
        if (!$this->validate([
            'ketua' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'field ketua harus diisi.'
                ]
            ],
            'wakil' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'field wakil harus diisi.'
                ]
            ],
            'nama_psg' => [
                'rules' => 'required|alpha_space',
                'errors' => [
                    'required' => 'field nama pasangan harus diisi.',
                    'alpha_space' => 'field harus berisi huruf abjad.'
                ]
            ],
            'visi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'field visi harus diisi.'
                ]
            ],
            'misi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'field misi harus diisi.'
                ]
            ],
            
        ])) {
            $validation = \Config\Services::validate();
            return redirect()->to('/kandidat/addKandidat')->withInput()->with('validation', $validation);
        }

        /**
         * ===========================================================
         * Query builder save data kandidat
         * ===========================================================
         */
        $this->KandidatModel->save([
            'ketua' => $this->request->getVar('ketua'),
            'wakil' => $this->request->getVar('wakil'),
            'nama_pasangan' => $this->request->getVar('nama_psg'),
            'foto' => $this->request->getVar('foto'),
            'visi' => $this->request->getVar('visi'),
            'misi' => $this->request->getVar('misi'),
            'periode' => '1'
        ]);

        /**
         * ===========================================================
         * Query builder update user
         * ===========================================================
         */
        $dataUser = [
            [
                'nis' => $this->request->getVar('ketua'),
                'st_kandidat' => '1'
            ],
            [
                'nis' => $this->request->getVar('wakil'),
                'st_kandidat' => '1'
            ]
        ];

        $this->UserModel->updateBatch($dataUser, 'nis');

        /**
         * ===========================================================
         * Mengirim flashdata
         * ===========================================================
         */
        session()->setFlashdata('message', 'Data berhasil ditambahkan.');

        /**
         * ===========================================================
         * Kembali ke view data kandidat
         * ===========================================================
         */
        return redirect()->to('/kandidat');
    }
}
