<?php

namespace App\Controllers;

use App\Models\KelasModel;
use App\Models\LoginAdminModel;

class Kelas extends BaseController
{
    protected $KelasModel;
    protected $LoginAdminModel;

    public function __construct()
    {
        $this->KelasModel = new KelasModel;
        $this->LoginAdminModel = new LoginAdminModel;
    }

    public function index()
    {
        $user = $this->LoginAdminModel->where(['username' => session()->get('username')])->first();
        if ($user == NULL) {
            return redirect()->to('/admin');
        } else {
            $data = [
                'title'     => 'Data Kelas',
                'kelas'     => $this->KelasModel->getKelas()->getResultArray()
            ];
            echo view('admin/v_kelas', $data);
        }
    }

    public function detailKelas($id)
    {
        $user = $this->LoginAdminModel->where(['username' => session()->get('username')])->first();
        if ($user == NULL) {
            return redirect()->to('/admin');
        } else {
            $data = [
                'title'         => 'Detail Kelas',
                'kelas'         =>  $this->KelasModel->getKelas($id)->getRowArray()
            ];
            echo view('admin/v_detailKelas', $data);
        }
    }

    public function addKelas()
    {
        $user = $this->LoginAdminModel->where(['username' => session()->get('username')])->first();
        if ($user == NULL) {
            return redirect()->to('/admin');
        } else {
            $data = [
                'title' => 'Tambah Kelas',
                'kelas' => $this->KelasModel->findAll(),
                'validation' => \Config\Services::validation()
            ];
            echo view('admin/v_addKelas', $data);
        }
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
            return redirect()->to('/kelas/addKelas')->withInput();
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
        session()->setFlashdata('message', 'save');

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
        session()->setFlashdata('message', 'delete');
        return redirect()->to('/kelas');
    }

    public function editKelas($id)
    {
        $user = $this->LoginAdminModel->where(['username' => session()->get('username')])->first();
        if ($user == NULL) {
            return redirect()->to('/admin');
        } else {
            $data = [
                'title' => 'Edit Kelas',
                'validation' => \Config\Services::validation(),
                'kelas' => $this->KelasModel->editKelas($id)
            ];
            echo view('admin/v_editKelas', $data);
        }
    }

    public function update($id)
    {
        if (!$this->validate([
            'nama_kelas' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Field Nama Kelas harus diisi.'
                ]
            ]
        ])) {
            return redirect()->to('/kelas/editKelas/' . $id)->withInput();
        }

        $this->KelasModel->save([
            'id_kelas' => $id,
            'nama_kelas' => $this->request->getVar('nama_kelas')
        ]);

        session()->setFlashdata('message', 'edit');
        return redirect()->to('/kelas');
    }
}
