<?php

namespace App\Controllers;

use App\Models\DashboardModel;
use App\Models\KandidatModel;
use App\Models\VotingModel;
use App\Models\LoginAdminModel;
use App\Models\CekvoteModel;
use App\Models\UserModel;
use App\Models\PeriodeModel;
// eksel
use CodeIgniter\HTTP\RequestInterface;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Dashboard extends BaseController
{
    // protected $loginModel;
    protected $DashboardModel;
    protected $KandidatModel;
    protected $VotingModel;
    protected $LoginAdminModel;
    protected $CekvoteModel;
    protected $UserModel;
    protected $PeriodeModel;
    public function __construct()
    {
        // $this->loginModel = new LoginModel;
        $this->DashboardModel = new DashboardModel();
        $this->KandidatModel = new KandidatModel();
        $this->VotingModel = new VotingModel();
        $this->LoginAdminModel = new LoginAdminModel();
        $this->CekvoteModel = new CekvoteModel();
        $this->UserModel = new UserModel();
        $this->PeriodeModel = new PeriodeModel();
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

    public function laporan()
    {
        // $periode = $this->PeriodeModel->select('periode')->where(['st_periode' => 1])->first();
        $kandidat = $this->KandidatModel->select('nama_pasangan')->join('periode', 'periode.id_periode=kandidat.periode')->where(['st_periode' => 1])->findAll();
        dd($kandidat);
        // echo $periode['periode'];
        // $object = new Spreadsheet();

        // $object->getProperties()->setCreator("Duxeos Software House");
        // $object->getProperties()->setLastModifiedBy("Duxeos");
        // $object->getProperties()->setTitle("Hasil Rekapitulasi Suara");

        // $object->setActiveSheetIndex(0);

        // foreach (range('A', 'H') as $columnID) {
        //     $object->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
        // }

        // $object->getActiveSheet()->mergeCells('A1:H1');
        // $object->getActiveSheet()->mergeCells('A2:H2');

        // $styleBoldCenter16 = array(
        //     'font' => array(
        //         'color' => array('rgb' => '000000'),
        //         'size' => 13
        //     ),
        //     'alignment' => array(
        //         'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
        //     )
        // );

        // $styleBoldCenter = array(
        //     'font' => array(
        //         'bold' => true,
        //         'size' => 12
        //     ),
        //     'alignment' => array(
        //         'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
        //     )
        // );

        // // Memberikan border dan text center
        // $borderArray = array(
        //     'borders' => array(
        //         'allborders' => array(
        //             'style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
        //             'color' => array('rgb' => '000000'),
        //         )
        //     ),
        //     'alignment' => array(
        //         'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
        //     )
        // );

        // // $backgroound['fill'] = array();
        // // $backgroound['fill']['type'] = \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID;
        // // $backgroound['fill']['color'] = array();
        // // $backgroound['fill']['color']['rgb'] = 'DCDCDC';

        // $object->getActiveSheet()->getStyle('A1')->applyFromArray($styleBoldCenter16);
        // $object->getActiveSheet()->getStyle('A2')->applyFromArray($styleBoldCenter16);

        // $object->getActiveSheet()->setCellValue('A1', 'LAPORAN HASIL REKAPITULASI PEMILIHAN KETUA DAN WAKIL KETUA OSIS');
        // $object->getActiveSheet()->setCellValue('A2', 'SMA N 8 SURAKARTA PERIODE');

        // // Tulis excel
        // $object->getActiveSheet()->setCellValue('B5', 'NO');
        // $object->getActiveSheet()->setCellValue('C5', 'NAMA PASLON');
        // $object->getActiveSheet()->setCellValue('D5', 'KETUA');
        // $object->getActiveSheet()->setCellValue('E5', 'WAKIL');
        // $object->getActiveSheet()->setCellValue('F5', 'JUMLAH SUARA');
        // $object->getActiveSheet()->setCellValue('G5', '%');

        // // $indexCol = 2;
        // // $numBatas = count($prodi) + 1;
        // // for ($i = $indexCol; $i <= $numBatas; $i++) {
        // //     $col = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($indexCol);
        // //     $kode_prodi = $prodi[$i - 2]['id_kelas'];
        // //     $nama_prodi = $prodi[$i - 2]['nama_kelas'];

        // //     $object->getActiveSheet()->setCellValue($col . '3', $kode_prodi);
        // //     $object->getActiveSheet()->setCellValue($col . '4', $nama_prodi);

        // //     $indexCol++;
        // // }

        // // $object->getActiveSheet()->getStyle('B3:' . $col . '3')->applyFromArray($borderArray);
        // // $object->getActiveSheet()->getStyle('B4:' . $col . '4')->applyFromArray($borderArray);

        // // $object->getActiveSheet()->getStyle('B3')->applyFromArray($backgroound);
        // // $object->getActiveSheet()->getStyle('B4')->applyFromArray($backgroound);

        // // $object->getActiveSheet()->setCellValue('C9', 'ket: Isi kolom Kelas dengan kode kelas yang ada pada tabel kelas di atas');

        // // $object->getActiveSheet()->setCellValue('A10', 'Nama Mahasiswa');
        // // $object->getActiveSheet()->setCellValue('B10', 'NIS');
        // // $object->getActiveSheet()->setCellValue('C10', 'Kelas');
        // // $object->getActiveSheet()->setCellValue('D10', 'Jenis Kelamin');
        // // $object->getActiveSheet()->setCellValue('E10', 'Password');

        // // $object->getActiveSheet()->getStyle('A10:E10')->applyFromArray($borderArray);
        // // $object->getActiveSheet()->getStyle('A10:E10')->applyFromArray($styleBoldCenter);

        // // Setting nama file

        // $filename = "Hasil Rekapitulasi Suara Periode $periode" . '.xlsx';

        // $object->getActiveSheet()->setTitle("Hasil Rekapitulasi Suara");

        // header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        // header('Content-Disposition: attachment; filename="' . $filename . '"');
        // header('Cache-Control: max-age=0');

        // ob_clean();

        // $writer = new Xlsx($object);
        // $writer->save('php://output');

        // exit;
    }
}
