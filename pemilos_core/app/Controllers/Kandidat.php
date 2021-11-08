<?php

namespace App\Controllers;

use App\Models\KandidatModel;
use App\Models\LoginAdminModel;
use App\Models\UserModel;
use App\Models\PeriodeModel;

class Kandidat extends BaseController
{
    protected $KandidatModel;
    protected $UserModel;
    protected $PeriodeModel;
    protected $LoginAdminModel;

    public function __construct()
    {
        $this->KandidatModel = new KandidatModel;
        $this->UserModel = new UserModel;
        $this->PeriodeModel = new PeriodeModel;
        $this->LoginAdminModel = new LoginAdminModel;
    }

    /**
     * ===========================================================
     * Fungsi menampilkan data kandidat
     * ===========================================================
     */
    public function index()
    {
        $user = $this->LoginAdminModel->where(['username' => session()->get('username')])->first();
        if ($user == NULL) {
            return redirect()->to('/admin');
        } else {
            if ($this->PeriodeModel->activePeriode() == "") {
                $data = [
                    'title' => 'Periode Belum Aktif'
                ];
                echo view('admin/v_noSetPeriode', $data);
            } else {
                $data = [
                    'title' => 'Data Kandidat',
                    'periode' => $this->PeriodeModel->getPeriode(),
                    'activePeriode' => $this->PeriodeModel->activePeriode(),
                    'kandidat' => $this->KandidatModel->getKandidat()
                ];
                echo view('admin/v_kandidat', $data);
            }
        }
    }


    /**
     * ===========================================================
     * Fungsi mencari data kandidat berdasarkan periode
     * ===========================================================
     */
    public function searchKandidat()
    {
        $periode = $this->request->getVar('periode1');
        $data = [
            'title' => 'Data Kandidat',
            'periode' => $this->PeriodeModel->getPeriode(),
            'activePeriode' => $this->PeriodeModel->activePeriode(),
            'tahunPeriode' => $this->PeriodeModel->tahunPeriode($periode),
            'kandidat' => $this->KandidatModel->kandidatPeriode($periode),
            'kandidatPeriode' => $periode
        ];

        session()->setFlashdata('message', 'search');
        echo view('admin/v_kandidat', $data);
    }

    /**
     * ===========================================================
     * Fungsi menampilkan form tambah kandidat
     * ===========================================================
     */
    public function addKandidat()
    {
        $user = $this->LoginAdminModel->where(['username' => session()->get('username')])->first();
        if ($user == NULL) {
            return redirect()->to('/admin');
        } else {
            $data = [
                'title' => 'Tambah Kandidat',
                'user' => $this->UserModel->getUser()->getResultArray(),
                'validation' => \Config\Services::validation(),
                'periode' => $this->PeriodeModel->activePeriode()
            ];
            echo view('admin/v_addKandidat', $data);
        }
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
                'rules' => 'required',
                'errors' => [
                    'required' => 'field nama pasangan harus diisi.'
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
            'foto' =>  [
                'rules' => 'max_size[foto,1024]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png,image/gif]',
                'errors' => [
                    'max_size' => 'ukuran gambar terlalu besar, maks 1Mb.',
                    'is_image' => 'format file yang diupload tidak dizinkan.',
                    'mime_in' => 'format file yang diupload tidak dizinkan.'
                ]
            ]
        ])) {
            return redirect()->to('/kandidat/addKandidat')->withInput();
        }

        /**
         * ===========================================================
         * Ambil gambar
         * ===========================================================
         */
        $fotoKandidat = $this->request->getFile('foto');

        if ($fotoKandidat != "") {
            /**
             * ===========================================================
             * Ambil nama gambar untuk disave di database
             * ===========================================================
             */
            $fotoName = $fotoKandidat->getRandomName();

            /**
             * ===========================================================
             * upload gambar
             * ===========================================================
             */
            $fotoKandidat->move('assets/img/fotokandidat', $fotoName);
        } else {
            $fotoName = "default.jpg";
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
            'foto' => $fotoName,
            'visi' => $this->request->getVar('visi'),
            'misi' => $this->request->getVar('misi'),
            'periode' => $this->request->getVar('periode')
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
        session()->setFlashdata('message', 'save');
        /**
         * ===========================================================
         * Kembali ke view data kandidat
         * ===========================================================
         */
        return redirect()->to('/kandidat');
    }

    /**
     * ===========================================================
     * Fungsi delete data kandidat
     * ===========================================================
     */
    public function delete($id)
    {
        /**
         * ===========================================================
         * Cari gambar berdasarkan id
         * ===========================================================
         */
        $kandidat = $this->KandidatModel->editKandidat($id);

        /**
         * ===========================================================
         * Cek jika gambarnya default
         * ===========================================================
         */
        if ($kandidat['foto'] != 'default.jpg') {
            /**
             * ===========================================================
             * Hapus gambar di folder
             * ===========================================================
             */
            unlink('assets/img/fotokandidat/' . $kandidat['foto']);
        }

        /**
         * ===========================================================
         * Query builder delete kandidat
         * ===========================================================
         */
        $this->KandidatModel->delete($id);

        /**
         * ===========================================================
         * Query builder update user
         * ===========================================================
         */
        $dataUser = [
            [
                'nis' => $this->request->getVar('ketua'),
                'st_kandidat' => '0'
            ],
            [
                'nis' => $this->request->getVar('wakil'),
                'st_kandidat' => '0'
            ]
        ];

        $this->UserModel->updateBatch($dataUser, 'nis');

        /**
         * ===========================================================
         * Mengirim flashdata
         * ===========================================================
         */
        session()->setFlashdata('message', 'delete');
        return redirect()->to('/kandidat');
    }

    /**
     * ===========================================================
     * Fungsi menampikan form edit data kandidat
     * ===========================================================
     */
    public function editKandidat($id)
    {
        $user = $this->LoginAdminModel->where(['username' => session()->get('username')])->first();
        if ($user == NULL) {
            return redirect()->to('/admin');
        } else {
            $data = [
                'title'         => 'Edit Kandidat',
                'user'          => $this->UserModel->getUser2(),
                'validation'    => \Config\Services::validation(),
                'kandidat'      => $this->KandidatModel->editKandidat($id),
                'periode'       => $this->PeriodeModel->activePeriode()
            ];
            echo view('admin/v_editKandidat', $data);
        }
    }

    /**
     * ===========================================================
     * Fungsi update data kandidat
     * ===========================================================
     */
    public function update($id)
    {
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
                'rules' => 'required',
                'errors' => [
                    'required' => 'field nama pasangan harus diisi.'
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
            'foto' =>  [
                'rules' => 'max_size[foto,1024]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png,image/gif]',
                'errors' => [
                    'max_size' => 'ukuran gambar terlalu besar, maks 1Mb.',
                    'is_image' => 'format file yang diupload tidak dizinkan.',
                    'mime_in' => 'format file yang diupload tidak dizinkan.'
                ]
            ]
        ])) {
            return redirect()->to('/kandidat/editKandidat/' . $this->request->getVar('id'))->withInput();
        }

        $fotoKandidat = $this->request->getFile('foto');

        /**
         * ===========================================================
         * Cek old foto
         * ===========================================================
         */
        if ($fotoKandidat == "") {
            /**
             * ===========================================================
             * Jika field foto kosong biarkan foto lama
             * ===========================================================
             */
            $fotoName = $this->request->getVar('old_foto');
        } else {
            /**
             * ===========================================================
             * Jika field foto terisi upload foto baru
             * ===========================================================
             */
            $fotoName = $fotoKandidat->getRandomName();
            $fotoKandidat->move('assets/img/fotokandidat', $fotoName);

            if ($fotoKandidat != "default.jpg") {
                unlink('assets/img/fotokandidat/' . $this->request->getVar('old_foto'));
            } else {
                $fotoName = "default.jpg";
            }
        }

        $this->KandidatModel->save([
            'id_kandidat' => $id,
            'ketua' => $this->request->getVar('ketua'),
            'wakil' => $this->request->getVar('wakil'),
            'nama_pasangan' => $this->request->getVar('nama_psg'),
            'foto' => $fotoName,
            'visi' => $this->request->getVar('visi'),
            'misi' => $this->request->getVar('misi'),
            'periode' => $this->request->getVar('periode')
        ]);

        if ($this->request->getVar('ketua') != $this->request->getVar('old_ketua')) {
            $dataUser = [
                [
                    'nis' => $this->request->getVar('ketua'),
                    'st_kandidat' => '1'
                ],
                [
                    'nis' => $this->request->getVar('old_ketua'),
                    'st_kandidat' => '0'
                ]
            ];

            $this->UserModel->updateBatch($dataUser, 'nis');
        }

        if ($this->request->getVar('wakil') != $this->request->getVar('old_wakil')) {
            $dataUser = [
                [
                    'nis' => $this->request->getVar('wakil'),
                    'st_kandidat' => '1'
                ],
                [
                    'nis' => $this->request->getVar('old_wakil'),
                    'st_kandidat' => '0'
                ]
            ];

            $this->UserModel->updateBatch($dataUser, 'nis');
        }

        session()->setFlashdata('message', 'edit');
        return redirect()->to('/kandidat');
    }
}
