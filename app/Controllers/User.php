<?php

namespace App\Controllers;

use App\Models\KelasModel;
use App\Models\UserModel;
use App\Models\LoginAdminModel;
use CodeIgniter\HTTP\RequestInterface;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class User extends BaseController
{
    protected $KelasModel;
    protected $UserModel;
    protected $LoginAdminModel;

    public function __construct()
    {
        // $this->loginModel = new LoginModel;
        helper(['form', 'url']);
        $this->KelasModel = new KelasModel;
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
                'title' => 'Manajemen User',
                'user' => $this->UserModel->findAll()
            ];

            echo view('admin/v_user', $data);
        }
    }

    public function addUser()
    {
        $user = $this->LoginAdminModel->where(['username' => session()->get('username')])->first();
        if ($user == NULL) {
            return redirect()->to('/admin');
        } else {
            $data = [
                'title' => 'Tambah User',
                'kelas' => $this->KelasModel->findAll(),
                'validation' => \Config\Services::validation()
            ];
            echo view('admin/v_addUser', $data);
        }
    }

    public function editUser($id)
    {
        $user = $this->LoginAdminModel->where(['username' => session()->get('username')])->first();
        if ($user == NULL) {
            return redirect()->to('/admin');
        } else {
            $data = [
                'title' => 'Edit User',
                'kelas' => $this->KelasModel->findAll(),
                'user' => $this->UserModel->editUser($id),
                'validation' => \Config\Services::validation()
            ];
            echo view('admin/v_edit_user', $data);
        }
    }

    public function editPassword($id)
    {
        $data = [
            'title' => 'Edit User',
            'kelas' => $this->KelasModel->findAll(),
            'user' => $this->UserModel->editUser($id),
            'validation' => \Config\Services::validation()
        ];
        echo view('admin/v_edit_user', $data);
    }

    public function detailUser($id)
    {
        $user = $this->LoginAdminModel->where(['username' => session()->get('username')])->first();
        if ($user == NULL) {
            return redirect()->to('/admin');
        } else {
            $data = [
                'title' => 'Detail User',
                'kelas' => $this->KelasModel->findAll(),
                'user' => $this->UserModel->editUser($id)
            ];
            echo view('admin/v_detail_user', $data);
        }
    }

    public function insert()
    {

        /**
         * ===========================================================
         * Validasi Form
         * ===========================================================
         */
        // konfigurasi validasi (membuat rules)
        $validation =  \Config\Services::validation();
        $validation->setRules([
            'nis' => [
                'rules' => 'required|is_unique[user.nis]',
                'errors' => [
                    'required' => 'Field NIS harus diisi.',
                    'is_unique' => 'NIS telah terdaftar'
                ]
            ],
            'nama_usr' => [
                'rules' => 'trim|required',
                'errors' => [
                    'required' => 'Field Nama Siswa harus diisi.'
                ]
            ],
            'id_kelas' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Field Kelas harus diisi.'
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Field Password harus diisi.'
                ]
            ]
        ]);
        $isDataValid = $validation->withRequest($this->request)->run();

        /**
         * ===========================================================
         * Query builder save data 
         * ===========================================================
         */
        // Jika data lolos validasi
        if ($isDataValid) {
            // menyimpan data yang diinputkan
            $nis = $this->request->getVar('nis');
            $nama = $this->request->getVar('nama_usr');
            $kelas = $this->request->getVar('id_kelas');
            $jk = $this->request->getVar('jk');
            $password = password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);
            $insert = [
                'nis' => $nis,
                'nama_usr' => $nama,
                'id_kelas' => $kelas,
                'jk' => $jk,
                'password' => $password,
                'st_pemilih' => '0',
                'st_kandidat' => '0'
            ];
            $this->UserModel->insert($insert);
            /**
             * ===========================================================
             * Mengirim flashdata
             * ===========================================================
             */
            session()->setFlashdata('message', 'save');
            return redirect()->to('/user');
            /**
             * ===========================================================
             * Kembali ke view data user
             * ===========================================================
             */
            return redirect()->to('/user');
        } else {
            //Jika data tidak lolos validasi
            /**
             * ===========================================================
             * Mengirim flashdata
             * ===========================================================
             */
            session()->setFlashdata('message', 'notsave');
            return redirect()->to("/user")->withInput()->with('validation', $validation);
        }
    }

    public function edit($id)
    {
        /**
         * ===========================================================
         * Validasi Form
         * ===========================================================
         */
        $psw1 = $this->request->getVar('psw_usr1');
        $psw2 = $this->request->getVar('psw_usr2');
        if ($psw1 != null || $psw2 != null) {
            if (!$this->validate([
                'nama_usr' => [
                    'rules' => 'trim|required',
                    'errors' => [
                        'required' => 'Field Nama Siswa harus diisi.'
                    ]
                ],
                'id_kelas' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Field Kelas harus diisi.'
                    ]
                ],
                'psw_usr1' => [
                    'rules' => 'required|min_length[8]|matches[psw_usr2]',
                    'errors' => [
                        'required' => 'Field Password harus diisi.',
                        'min_length' => 'Password teralalu pendek, minimal 8 karakter',
                        'matches' => ''
                    ]
                ],
                'psw_usr2' => [
                    'rules' => 'required|min_length[8]|matches[psw_usr1]',
                    'errors' => [
                        'required' => 'Field Password harus diisi.',
                        'min_length' => 'Password teralalu pendek, minimal 8 karakter',
                        'matches' => 'Password tidak sama'
                    ]
                ],

            ])) {
                return redirect()->to('/user/editUser/' . $this->request->getVar('nis'))->withInput();
            }
        } else {
            if (!$this->validate([
                'nama_usr' => [
                    'rules' => 'trim|required',
                    'errors' => [
                        'required' => 'Field Nama Siswa harus diisi.'
                    ]
                ],
                'id_kelas' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Field Kelas harus diisi.'
                    ]
                ]

            ])) {
                return redirect()->to('/user/editUser/' . $this->request->getVar('nis'))->withInput();
            }
        }

        if ($psw1 == null && $psw2 == null) {
            $this->UserModel->save([
                'nis' => $id,
                'nama_usr' => $this->request->getVar('nama_usr'),
                'id_kelas' => $this->request->getVar('id_kelas'),
                'jk' => $this->request->getVar('jk'),
            ]);
        } else {
            $this->UserModel->save([
                'nis' => $id,
                'nama_usr' => $this->request->getVar('nama_usr'),
                'id_kelas' => $this->request->getVar('id_kelas'),
                'jk' => $this->request->getVar('jk'),
                'password' => password_hash($psw2, PASSWORD_DEFAULT)
            ]);
        }

        session()->setFlashdata('message', 'edit');
        return redirect()->to('/user');
    }

    public function prosesExcel()
    {
        $file = $this->request->getFile('file_excel');
        $ext = $file->getClientExtension();
        if ('csv' == $ext) {
            $excelreader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
        } else if ('xlsx' == $ext) {
            $excelreader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        } else {
            $excelreader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        }
        //baca file
        $spreadsheet = $excelreader->load($file);
        //ambil sheet active
        $sheet    = $spreadsheet->getActiveSheet()->toArray();

        $i = 0;
        //looping untuk mengambil data
        foreach ($sheet as $data) {
            //skip index 6 karena title excel
            if ($i >= 10) {
                // continue;
                $insert = [
                    'nama_usr' => $data['0'],
                    'nis' => $data['1'],
                    'id_kelas' => $data['2'],
                    'jk' => $data['3'],
                    'password' => password_hash($this->request->getVar($data['4']), PASSWORD_DEFAULT),
                    'st_pemilih' => '0',
                    'st_kandidat' => '0',
                    'created_at' => date('Y-m-d H:i:s')
                ];
                // dd($data);
                $this->UserModel->add($insert);
            }
            $i++;
        }

        session()->setFlashdata('message', 'save');
        return redirect()->back();
    }

    public function export_template()
    {
        $prodi = $this->KelasModel->findAll();

        // require(APPPATH . 'third_party/PHPExcel/PHPExcel.php');
        // require(APPPATH . 'third_party/PHPExcel/PHPExcel/Writer/Excel2007.php');
        // PHPExcel_Shared_Font::setAutoSizeMethod(PHPExcel_Shared_Font::AUTOSIZE_METHOD_EXACT);
        $object = new Spreadsheet();

        $object->getProperties()->setCreator("Duxeos Software House");
        $object->getProperties()->setLastModifiedBy("Duxeos");
        $object->getProperties()->setTitle("Template Import Siswa");

        $object->setActiveSheetIndex(0);

        foreach (range('A', 'K') as $columnID) {
            $object->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
        }

        $object->getActiveSheet()->mergeCells('A1:K1');
        $object->getActiveSheet()->mergeCells('A2:K2');

        $styleBoldCenter16 = array(
            'font' => array(
                'color' => array('rgb' => 'FF0000'),
                'size' => 12
            ),
            'alignment' => array(
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            )
        );

        $styleBoldCenter = array(
            'font' => array(
                'bold' => true,
                'size' => 11
            ),
            'alignment' => array(
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            )
        );

        // Memberikan border dan text center
        $borderArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                    'color' => array('rgb' => '000000'),
                )
            ),
            'alignment' => array(
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            )
        );

        $backgroound['fill'] = array();
        $backgroound['fill']['type'] = \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID;
        $backgroound['fill']['color'] = array();
        $backgroound['fill']['color']['rgb'] = 'DCDCDC';

        $object->getActiveSheet()->getStyle('A1')->applyFromArray($styleBoldCenter16);

        $object->getActiveSheet()->setCellValue('A1', 'Perhatian! Mohon jangan merubah posisi atau susunan Template ini, Inputkan kode Program Studi dan Golongan pada kolom yang tersedia');

        // Tulis excel prodi
        $object->getActiveSheet()->setCellValue('A3', 'Kode Kelas');
        $object->getActiveSheet()->setCellValue('A4', 'Nama Kelas');

        $indexCol = 2;
        $numBatas = count($prodi) + 1;
        for ($i = $indexCol; $i <= $numBatas; $i++) {
            $col = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($indexCol);
            $kode_prodi = $prodi[$i - 2]['id_kelas'];
            $nama_prodi = $prodi[$i - 2]['nama_kelas'];

            $object->getActiveSheet()->setCellValue($col . '3', $kode_prodi);
            $object->getActiveSheet()->setCellValue($col . '4', $nama_prodi);

            $indexCol++;
        }

        $object->getActiveSheet()->getStyle('B3:' . $col . '3')->applyFromArray($borderArray);
        $object->getActiveSheet()->getStyle('B4:' . $col . '4')->applyFromArray($borderArray);

        $object->getActiveSheet()->getStyle('B3')->applyFromArray($backgroound);
        $object->getActiveSheet()->getStyle('B4')->applyFromArray($backgroound);

        $object->getActiveSheet()->setCellValue('C9', 'ket: Isi kolom Kelas dengan kode kelas yang ada pada tabel kelas di atas');

        $object->getActiveSheet()->setCellValue('A10', 'Nama Mahasiswa');
        $object->getActiveSheet()->setCellValue('B10', 'NIS');
        $object->getActiveSheet()->setCellValue('C10', 'Kelas');
        $object->getActiveSheet()->setCellValue('D10', 'Jenis Kelamin');
        $object->getActiveSheet()->setCellValue('E10', 'Password');

        $object->getActiveSheet()->getStyle('A10:E10')->applyFromArray($borderArray);
        $object->getActiveSheet()->getStyle('A10:E10')->applyFromArray($styleBoldCenter);

        // Setting format penamaan output
        $today = date('Y-m-d (H.i.s)');
        $filename = "Template Import Siswa $today" . '.xlsx';

        $object->getActiveSheet()->setTitle("Template Import Siswa");

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        ob_clean();

        $writer = new Xlsx($object);
        $writer->save('php://output');

        exit;
    }

    public function delete($nis)
    {
        $data = [
            'title' => 'Manajemen User',
            'train' => $this->UserModel->findAll()
        ];
        $hapus = $this->UserModel->deleteData($nis);
        // mengirim pesan berhasil dihapus
        if ($hapus) {
            /**
             * ===========================================================
             * Mengirim flashdata
             * ===========================================================
             */
            session()->setFlashdata('message', 'delete');

            return redirect()->to('/user');
        } else {
            /**
             * ===========================================================
             * Mengirim flashdata
             * ===========================================================
             */
            session()->setFlashdata('message', 'notdelete');
            return redirect()->to('/kandidat');
        }
    }
}
