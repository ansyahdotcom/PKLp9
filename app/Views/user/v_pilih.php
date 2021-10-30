<?= $this->extend('layout/template_user'); ?>

<?= $this->section('content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pilih Kandidat</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Info Kandidat Vote -->

        <?php foreach ($ketua as $ket) :
            $id_kandidat = $ket['id_kandidat']; ?>
            <?php
            $db = \Config\Database::connect();
            $sql = $db->query("SELECT kandidat.wakil, user.nama_usr as wnama, kelas.nama_kelas as wkelas 
                                                                FROM kandidat, user, kelas WHERE kandidat.wakil = user.nis 
                                                                AND user.id_kelas = kelas.id_kelas AND kandidat.id_kandidat = $id_kandidat");
            foreach ($sql->getResultArray() as $wakil) :
            ?>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary h-100 py-2">
                        <div class="card-navbar font-weight-bold">
                            <div class="row no-gutters align-items-center mx-2">
                                <div class="col my-2 mx-2">
                                    <?= $ket['nama_pasangan']; ?>
                                </div>
                                <div class="row mx-2">
                                    <?= $ket['nama_usr'] . ' & ' . $wakil['wnama']; ?>
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800 mx-2">
                                    <hr class="sidebar-divider">
                                    <img class="img img-responsive img-preview" src="/assets/img/fotokandidat/default.jpg" class="mt-2" alt="foto kandidat" width="200px">
                                    <hr class="sidebar-divider">
                                </div>
                            </div>
                            <div class="text-center">
                                <a href="#" class="btn btn-success ">
                                    Vote
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </div>
    <!-- /.container-fluid -->
    <?= $this->endSection(); ?>