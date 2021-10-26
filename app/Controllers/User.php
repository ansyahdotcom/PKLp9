<?php

namespace App\Controllers;

use App\Models\KelasModel;
use App\Models\UserModel;

class User extends BaseController
{
    protected $UserModel;
    protected $KelasModel;

    public function __construct()
    {
        // $this->loginModel = new LoginModel;
        helper(['form']);
        $this->UserModel = new UserModel;
        $this->KelasModel = new KelasModel;
    }

    public function index()
    {
        // $username = $this->loginModel->where(['nama_user' => session()->get('username')])->first();
        // if ($username == NULL) {
        //     session()->setFlashdata('pesan', $this->notify('Peringatan!', 'Untuk mengakses halaman admin, login terlebih dahulu!', 'warning', 'error'));
        //     return redirect()->to("/auth");
        // }

        $data = [
            'title' => 'Manajemen User',
            'user' => $this->UserModel->findAll()
        ];

        echo view('admin/v_user', $data);
    }

    public function addUser()
    {
        $data = [
            'title' => 'Tambah User',
            'kelas' => $this->KelasModel->findAll(),
            'validation' => \Config\Services::validation()
        ];
        echo view('admin/v_addUser', $data);
    }

    public function editUser($id)
    {
        $data = [
            'title' => 'Edit User',
            'kelas' => $this->KelasModel->findAll(),
            'user' => $this->UserModel->editUser($id),
            'validation' => \Config\Services::validation()
        ];
        echo view('admin/v_edit_user', $data);
    }

    public function detailUser()
    {
        $data = [
            'title' => 'Detail User',
            'user' => $this->KelasModel->findAll(),
            'validation' => \Config\Services::validation()
        ];
        echo view('admin/v_detail_user', $data);
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
            ],
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
            session()->setFlashdata('pesan', $this->notify('Selamat!', 'Berhasil menambah data.', 'success', 'success'));
            return redirect()->back();
        /**
         * ===========================================================
         * Kembali ke view data user
         * ===========================================================
         */
        return redirect()->to('/user');
        } else {
            //Jika data tidak lolos validasi
            session()->setFlashdata('pesan', $this->notify('Perhatian!', 'Gagal menambah data. Harap cek kembali masukkan Anda', 'danger', 'error'));
            return redirect()->to('/user')->withInput()->with('validation', $validation);
        }
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
            if ($i >= 6) {
                // continue;
                $insert = [
                    'nis' => $data['0'],
                    'nama_usr' => $data['1'],
                    'id_kelas' => $data['2'],
                    'jk' => $data['3'],
                    'password' => $data['4'],
                    'created_at' => date('Y-m-d H:i:s')
                ];
                // dd($data);
                $this->UserModel->add($insert);
            }
            $i++;
        }

        session()->setFlashdata('pesan', $this->notify('Selamat!', 'Berhasil mengimport data.', 'success', 'success'));
        return redirect()->back();
    }

    public function export_template()
    {
        $prodi = $this->m_crud->getAll('prodi')->result_array();
        $golongan = $this->m_crud->getAll('golongan')->result_array();

        require(APPPATH . 'third_party/PHPExcel/PHPExcel.php');
        require(APPPATH . 'third_party/PHPExcel/PHPExcel/Writer/Excel2007.php');
        // PHPExcel_Shared_Font::setAutoSizeMethod(PHPExcel_Shared_Font::AUTOSIZE_METHOD_EXACT);
        $object = new PHPExcel();

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
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )
        );

        $styleBoldCenter = array(
            'font' => array(
                'bold' => true,
                'size' => 11
            ),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )
        );

        // Memberikan border dan text center
        $borderArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            ),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )
        );

        $backgroound['fill'] = array();
        $backgroound['fill']['type'] = PHPExcel_Style_Fill::FILL_SOLID;
        $backgroound['fill']['color'] = array();
        $backgroound['fill']['color']['rgb'] = 'DCDCDC';

        $object->getActiveSheet()->getStyle('A1')->applyFromArray($styleBoldCenter16);

        $object->getActiveSheet()->setCellValue('A1', 'Perhatian! Mohon jangan merubah posisi atau susunan Template ini, Inputkan kode Program Studi dan Golongan pada kolom yang tersedia');

        // Tulis excel prodi
        $object->getActiveSheet()->setCellValue('B3', 'Kode Prodi');
        $object->getActiveSheet()->setCellValue('B4', 'Nama Prodi');

        $indexCol = 2;
        $numBatas = count($prodi) + 1;
        for ($i = $indexCol; $i <= $numBatas; $i++) {
            $col = PHPExcel_Cell::stringFromColumnIndex($indexCol);
            $kode_prodi = $prodi[$i - 2]['kode_prodi'];
            $nama_prodi = $prodi[$i - 2]['prodi'];

            $object->getActiveSheet()->setCellValue($col . '3', $kode_prodi);
            $object->getActiveSheet()->setCellValue($col . '4', $nama_prodi);

            $indexCol++;
        }

        $object->getActiveSheet()->getStyle('B3:' . $col . '3')->applyFromArray($borderArray);
        $object->getActiveSheet()->getStyle('B4:' . $col . '4')->applyFromArray($borderArray);

        $object->getActiveSheet()->getStyle('B3')->applyFromArray($backgroound);
        $object->getActiveSheet()->getStyle('B4')->applyFromArray($backgroound);

        // Tulis excel golongan
        $object->getActiveSheet()->setCellValue('B6', 'Kode Golongan');
        $object->getActiveSheet()->setCellValue('B7', 'Nama Golongan');

        $indexCol = 2;
        $numBatas = count($golongan) + 1;
        for ($i = $indexCol; $i <= $numBatas; $i++) {
            $col = PHPExcel_Cell::stringFromColumnIndex($indexCol);
            $kode_golongan = $golongan[$i - 2]['kode_golongan'];
            $nama_golongan = $golongan[$i - 2]['golongan'];

            $object->getActiveSheet()->setCellValue($col . '6', $kode_golongan);
            $object->getActiveSheet()->setCellValue($col . '7', $nama_golongan);

            $indexCol++;
        }

        $object->getActiveSheet()->getStyle('B6:' . $col . '6')->applyFromArray($borderArray);
        $object->getActiveSheet()->getStyle('B7:' . $col . '7')->applyFromArray($borderArray);

        $object->getActiveSheet()->getStyle('B6')->applyFromArray($backgroound);
        $object->getActiveSheet()->getStyle('B7')->applyFromArray($backgroound);

        $object->getActiveSheet()->setCellValue('B9', 'ket: NIM tidak boleh duplikat');
        $object->getActiveSheet()->setCellValue('C9', 'ket: email tidak boleh duplikat');
        $object->getActiveSheet()->setCellValue('D9', 'ket: min 8 karakter');
        $object->getActiveSheet()->setCellValue('G9', 'cth: 3');
        $object->getActiveSheet()->setCellValue('H9', 'cth: 2000-11-30');
        $object->getActiveSheet()->setCellValue('I9', 'cth: 085816352xxx');
        $object->getActiveSheet()->setCellValue('K9', 'cth: 2018/2019');

        $object->getActiveSheet()->setCellValue('A10', 'Nama Mahasiswa');
        $object->getActiveSheet()->setCellValue('B10', 'NIM');
        $object->getActiveSheet()->setCellValue('C10', 'Email');
        $object->getActiveSheet()->setCellValue('D10', 'Password');
        $object->getActiveSheet()->setCellValue('E10', 'Prodi');
        $object->getActiveSheet()->setCellValue('F10', 'Golongan');
        $object->getActiveSheet()->setCellValue('G10', 'Semester Tempuh');
        $object->getActiveSheet()->setCellValue('H10', 'Tanggal Lahir');
        $object->getActiveSheet()->setCellValue('I10', 'No. HP');
        $object->getActiveSheet()->setCellValue('J10', 'Alamat');
        $object->getActiveSheet()->setCellValue('K10', 'Tahun angkatan');

        $object->getActiveSheet()->getStyle('A10:K10')->applyFromArray($borderArray);
        $object->getActiveSheet()->getStyle('A10:K10')->applyFromArray($styleBoldCenter);

        // Setting format penamaan output
        $today = date('Y-m-d (H.i.s)');
        $filename = "Template Import Mahasiswa $today" . '.xlsx';

        $object->getActiveSheet()->setTitle("Template Import Mahasiswa");

        header('Content-Type: application/
            vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        ob_clean();

        $writer = PHPExcel_IOFactory::createwriter($object, 'Excel2007');
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
            session()->setFlashdata('pesan', $this->notify('Selamat!', 'Berhasil menghapus data.', 'success', 'success'));
            return redirect()->back();
        } else {
            session()->setFlashdata('pesan', $this->notify('Perhatian!', 'Gagal menghapus data.', 'danger', 'error'));
            return redirect()->back();
        }
    }

    function notify($title, $message, $type, $icon)
    {
        $pesan = "$.notify({
            icon: 'flaticon-$icon',
            title: '$title',
            message: '$message',
        },{
            type: '$type',
            placement: {
                from: 'top',
                align: 'center'
            },
            time: 1000,
        });";
        return $pesan;
    }
}
