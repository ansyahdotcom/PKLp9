<?php

namespace App\Controllers;

use App\Models\PeriodeModel;
use App\Models\UserModel;
use App\Models\LoginAdminModel;

class Periode extends BaseController
{
    protected $PeriodeModel;
    protected $UserModel;
    protected $LoginAdminModel;

    public function __construct()
    {
        $this->PeriodeModel = new PeriodeModel;
        $this->UserModel = new UserModel;
        $this->LoginAdminModel = new LoginAdminModel;
    }

    public function index()
    {
        $user = $this->LoginAdminModel->where(['username' => session()->get('username')])->first();
        if ($user == NULL) {
            return redirect()->to('/admin');
        } else {
            $data = [
                'title' => 'Data Periode',
                'periode' => $this->PeriodeModel->getPeriode(),
            ];
            echo view('admin/v_periode', $data);
        }
    }

    public function nonactive($id)
    {
        $this->PeriodeModel
            ->save([
                'id_periode' => $id,
                'st_buka' => 0
            ]);

        $this->UserModel
            ->set('st_pemilih', 0)
            ->where('st_pemilih', 1)
            ->update();

        $this->UserModel
            ->set('st_kandidat', 0)
            ->where('st_kandidat', 1)
            ->update();

        $this->PeriodeModel->save([
            'id_periode' => $id,
            'st_periode' => 0
        ]);

        session()->setFlashdata('message', 'nonactive');
        return redirect()->to('/periode');
    }

    public function active($id)
    {
        $this->PeriodeModel
            ->set('st_buka', 0)
            ->where('st_buka', 1)
            ->update();

        $this->PeriodeModel
            ->set('st_periode', 0)
            ->where('st_periode', 1)
            ->update();

        $this->UserModel
            ->set('st_pemilih', 0)
            ->where('st_pemilih', 1)
            ->update();

        $this->UserModel
            ->set('st_kandidat', 0)
            ->where('st_kandidat', 1)
            ->update();

        $this->PeriodeModel->save([
            'id_periode' => $id,
            'st_periode' => 1
        ]);

        session()->setFlashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                Periode telah diaktifkan.
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>');
        session()->setFlashdata('message', 'active');
        return redirect()->to('/periode');
    }

    public function open($id)
    {
        $this->PeriodeModel
            ->save([
                'id_periode' => $id,
                'st_buka' => '1'
            ]);

        session()->setFlashdata('message', 'open');
        return redirect()->to('/periode');
    }

    public function close($id)
    {
        $this->PeriodeModel
            ->save([
                'id_periode' => $id,
                'st_buka' => '0'
            ]);

        session()->setFlashdata('message', 'close');
        return redirect()->to('/periode');
    }

    public function addPeriode()
    {
        $user = $this->LoginAdminModel->where(['username' => session()->get('username')])->first();
        if ($user == NULL) {
            return redirect()->to('/admin');
        } else {
            $data = [
                'title' => 'Tambah Periode',
                'validation' => \Config\Services::validation()
            ];
            echo view('admin/v_addPeriode', $data);
        }
    }

    public function save()
    {
        if (!$this->validate([
            'periode' => [
                'rules' => 'required|is_unique[periode.periode]|valid_date[Y/Y]',
                'errors' => [
                    'required' => 'field periode harus diisi.',
                    'is_unique' => 'periode yang dimasukkan sudah ada',
                    'valid_date' => 'format periode salah'
                ]
            ]
        ])) {
            return redirect()->to('/periode/addPeriode')->withInput();
        }

        $this->PeriodeModel->save([
            'periode' => $this->request->getVar('periode'),
            'st_periode' => '0',
            'st_buka' => '0'
        ]);

        session()->setFlashdata('message', 'save');
        return redirect()->to('/periode');
    }

    public function editPeriode($id)
    {
        $user = $this->LoginAdminModel->where(['username' => session()->get('username')])->first();
        if ($user == NULL) {
            return redirect()->to('/admin');
        } else {
            $data = [
                'title' => 'Edit Periode',
                'validation' => \Config\Services::validation(),
                'periode' => $this->PeriodeModel->editPeriode($id)
            ];

            echo view('admin/v_editPeriode', $data);
        }
    }

    public function update($id)
    {
        $old_periode = $this->request->getVar('old_periode');
        $periode = $this->request->getVar('periode');

        if ($periode != $old_periode) {
            if (!$this->validate([
                'periode' => [
                    'rules' => 'required|is_unique[periode.periode]|valid_date[Y/Y]',
                    'errors' => [
                        'required' => 'field periode harus diisi.',
                        'is_unique' => 'periode yang dimasukkan sudah ada',
                        'valid_date' => 'format periode salah'
                    ]
                ]
            ])) {
                return redirect()->to('/periode/addPeriode')->withInput();
            }
        } else {
            if (!$this->validate([
                'periode' => [
                    'rules' => 'required|valid_date[Y/Y]',
                    'errors' => [
                        'required' => 'field periode harus diisi.',
                        'valid_date' => 'format periode salah'
                    ]
                ]
            ])) {
                return redirect()->to('/periode/addPeriode')->withInput();
            }
        }

        $this->PeriodeModel->save([
            'id_periode' => $id,
            'periode' => $periode
        ]);

        session()->setFlashdata('message', 'edit');
        return redirect()->to('/periode');
    }

    public function delete($id)
    {
        $this->PeriodeModel->delete($id);

        session()->setFlashdata('message', 'delete');

        return redirect()->to('/periode');
    }
}
