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
                                <div class="card border-left-primary h-100 py-2">
                                    <div class="card-navbar font-weight-bold">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mx-2">
                                                <?= $ket['nama_pasangan'] . ' | ' . $ket['nama_usr'] . ' & ' . $wakil['wnama']; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            <br>
                            <h4 class="small font-weight-bold">Perolehan Suara
                                <div class="float-right mr-2">
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
                                    }
                                    ?>
                                </div>
                            </h4>
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