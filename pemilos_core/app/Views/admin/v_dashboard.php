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
                    <div class="row">
                        <?php foreach ($ketua as $ket) :
                            $id_kandidat = $ket['id_kandidat']; ?>
                            <?php
                            $db = \Config\Database::connect();
                            // Prosentase Suara
                            $jml_vote = $db->query("SELECT COUNT(id_kandidat) AS pembilang FROM voting WHERE id_kandidat = $id_kandidat")->getResultArray();
                            foreach ($jml_vote as $pemb) {
                                foreach ($vote as $vot) {
                                    $penyebut = $vot['voting'];
                                    $pembilang = $pemb['pembilang'];
                                    if ($pembilang == 0 && $penyebut == 0) {
                                        $hasil = 0;
                                    } else {
                                        $hasil = $pembilang / $penyebut * 100 + 0;
                                    }
                                    $prosentase = round($hasil, 2) . '%';
                                }
                            }

                            // Jumlah Suara
                            $jml_suara = $db->query("SELECT COUNT(id_kandidat) AS suara FROM voting WHERE id_kandidat = $id_kandidat")->getRow();

                            // Menampilkan Nama Ketua dan Wakil ketua OSIS
                            $sql = $db->query("SELECT kandidat.wakil, user.nama_usr as wnama, kelas.nama_kelas as wkelas 
                                                                FROM kandidat, user, kelas WHERE kandidat.wakil = user.nis 
                                                                AND user.id_kelas = kelas.id_kelas AND kandidat.id_kandidat = $id_kandidat");
                            foreach ($sql->getResultArray() as $wakil) :
                            ?>
                                <div class="col-md-4">
                                    <div class="card bg-primary mb-2">
                                        <div class="card-body">
                                            <h1 class="font-weight-bolder text-center text-white"><?= $prosentase; ?></h1>
                                            <p class="text-center text-white"><?= $jml_suara->suara; ?> suara</p>
                                            <div class="progress progress-sm mr-2">
                                                <div class="progress-bar bg-success" role="progressbar" style="width: <?= $hasil ?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card" style="height: fit-content;">
                                        <img src="/assets/img/fotokandidat/<?= $ket['foto']; ?>" class="card-img-top" alt="img-paslon" style="object-fit: cover !important; height: 200px !important;">
                                        <div class="card-body text-center">
                                            <h5 class="font-weight-bolder text-dark"><?= $ket['nama_pasangan']; ?></h5>
                                            <h6 class="font-weight-bold"><?= $ket['nama_usr'] . ' & ' . $wakil['wnama']; ?></h6>
                                            <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
<?= $this->endSection(); ?>