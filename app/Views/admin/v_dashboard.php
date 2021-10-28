<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="flash-data" data-flashdata="<?= session()->get('message') ?>"></div>

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i>
            Generate Report
        </a> -->
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Info Cards -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="font-weight-bold text-primary text-uppercase mb-1">
                                Vote Masuk</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php foreach ($vote as $vot) {
                                    echo $vot['voting'];
                                } ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="font-weight-bold text-success text-uppercase mb-1">
                                Jumlah User
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php foreach ($user as $us) {
                                    echo $us['nis'];
                                } ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="font-weight-bold text-info text-uppercase mb-1">
                                Jumlah Kandidat
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php foreach ($kandidat as $kan) {
                                    echo $kan['kandidat'];
                                } ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-tie fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="font-weight-bold text-warning text-uppercase mb-1">
                                Periode
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php foreach ($periode as $per) {
                                    echo $per['periode'];
                                } ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Reset Vote Row -->
    <div class="row">

        <!-- Info Cards -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="font-weight-bold text-danger text-uppercase mb-1">
                                Reset Hasil Vote
                            </div>
                            <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#resetModal">
                                <span class="text">Reset</span>
                            </a>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-trash fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Content Row -->

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Perolehan Suara Kandidat</h6>
                    <div class="dropdown no-arrow">
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="col">
                        <?php foreach ($ketua as $ket) :
                            $id_kandidat = $ket['id_kandidat']; ?>
                            <?php
                            $db = \Config\Database::connect();
                            $sql = $db->query("SELECT kandidat.wakil, user.nama_usr as wnama, kelas.nama_kelas as wkelas 
                                                                FROM kandidat, user, kelas WHERE kandidat.wakil = user.nis 
                                                                AND user.id_kelas = kelas.id_kelas AND kandidat.id_kandidat = $id_kandidat");
                            foreach ($sql->getResultArray() as $wakil) :
                            ?>
                                <div class="font-weight-bold mb-1">
                                    <?= $ket['nama_pasangan'] . ' | ' . $ket['nama_usr'] . ' & ' . $wakil['wnama']; ?>
                                </div>
                            <?php endforeach; ?>
                            <?php
                            $db = \Config\Database::connect();
                            $sqll = $db->query("SELECT COUNT(id_kandidat) AS pembilang FROM voting WHERE id_kandidat = $id_kandidat");
                            foreach ($sqll->getResultArray() as $pemb) {
                                foreach ($vote as $vot) {
                                    $penyebut = $vot['voting'];
                                    $pembilang = $pemb['pembilang'];
                                    if ($pembilang == 0 && $penyebut == 0) {
                                        $hasil = 0;
                                    } else {
                                        $hasil = $pembilang / $penyebut * 100 + 0;
                                    }
                                    echo $hasil . '%';
                                }
                            } ?>
                            <div class="progress progress-sm mr-2">
                                <div class="progress-bar bg-success" role="progressbar" style="width: <?= $hasil ?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <hr>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
<?= $this->endSection(); ?>