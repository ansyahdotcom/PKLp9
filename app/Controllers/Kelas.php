<?php

namespace App\Controllers;

use App\Models\KelasModel;

class Kelas extends BaseController
{
    protected $KelasModel;

    public function __construct()
    {
        $this->KelasModel = new KelasModel;
    }

    public function index()
    {
        $data = [
            'title'     => 'Data Kelas',
            'kelas'     => $this->KelasModel->getKelas()->getResultArray(),
            'jm_siswa'  => $this->KelasModel->getJumlahSiswa()
        ];
        echo view('admin/v_kelas', $data);
    }

    public function addKelas()
    {
        $data = [
            'title' => 'Tambah Kelas',
            'kelas' => $this->KelasModel->findAll(),
            'validation' => \Config\Services::validation()
        ];
        echo view('admin/v_addKelas', $data);
    }

    public function insertKelas()
    {

        /**
         * ===========================================================
         * Validasi Form
         * ===========================================================
         */
        if (!$this->validate([
            'nama_kelas' => [
                'rules' => 'trim|required',
                'errors' => [
                    'required' => 'Field Nama Kelas harus diisi.'
                ]
            ]
        ])) {
            $validation = \Config\Services::validate();
            return redirect()->to('/kelas/addKelas')->withInput()->with('validation', $validation);
        }

        /**
         * ===========================================================
         * Query builder save data 
         * ===========================================================
         */
        $this->KelasModel->save([
            'nama_kelas' => $this->request->getVar('nama_kelas')
        ]);

        // dd($this->request->getVar());
        /**
         * ===========================================================
         * Mengirim flashdata
         * ===========================================================
         */
        session()->setFlashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                                Data berhasil ditambahkan.
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>');

        /**
         * ===========================================================
         * Kembali ke view data kelas
         * ===========================================================
         */
        return redirect()->to('/kelas');
    }

    public function delete($id)
    {
        $this->KelasModel->delete($id);
        return redirect()->to('/kelas');
    }
}
