<?= $this->extend('layout/template_user'); ?>

<?= $this->section('content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Content Row -->
    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 text-center align-items-center justify-content-between">
                    <h3 class="m-0 font-weight-bold text-gray-800">Perolehan Suara Calon Ketua OSIS</h3>
                    <div class="dropdown no-arrow">
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <p class="font-italic text-gray-800 font-weight-bold"> Jika ingin melakukan voting silahkan klik menu voting ketua osis <sup class="text-danger">(*)</sup></p>
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