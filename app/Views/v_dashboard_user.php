<?= $this->extend('layout/template_user'); ?>
<?= $this->section('content'); ?>
<?php foreach ($periode as $prd) {
    $period = $prd['periode'];
} ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="flash-data" data-flashdata="<?= session()->get('message') ?>"></div>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pemilihan Ketua OSIS SMA Negeri 4 Surakarta Periode <?= $period; ?></h1>
    </div>
    <?php if ($st_pemilih == 1) : ?>
        <p class="mb-4 text-success">Anda sudah memilih!</p>
    <?php else : ?>
        <p><strong>*Pilih salah satu pasangan calon lalu klik Submit!</strong></p>
    <?php endif; ?>
    <form action="/submit" method="post">
        <?= csrf_field(); ?>
        <input type="text" name="nis" hidden value="<?= $nis ?>">
        <?php $i = 1;
        foreach ($kandidat as $knd) :
            $id_kandidat = $knd['id_kandidat']; ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow mb-4 border-left-primary">
                        <div class="card-header py-3">
                            <h2 class="m-0 font-weight-bold text-primary"><?= $i++ . '. ' . $knd['nama_pasangan']; ?></h2>
                        </div>
                        <div class="card-body">
                            <div class="row no-gutters">
                                <div class="col-md-3 mr-3">
                                    <img src="\assets\img\fotokandidat\<?= $knd['foto']; ?>" alt="foto kandidat" style="width: 100%;">
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="font-weight-bold text-primary text-uppercase mb-1">Ketua :</div>
                                    <div class="h5 mb-3 font-weight-bold"><?= $knd['nama_usr'] . ' / ' . $knd['nama_kelas']; ?></div>
                                    <?php
                                    $db = \Config\Database::connect();
                                    $sql = $db->query("SELECT kandidat.wakil, user.nama_usr as wnama, kelas.nama_kelas as wkelas 
                                                                    FROM kandidat, user, kelas WHERE kandidat.wakil = user.nis 
                                                                    AND user.id_kelas = kelas.id_kelas AND kandidat.id_kandidat = $id_kandidat");
                                    foreach ($sql->getResultArray() as $wakil) :
                                    ?>
                                        <div class="font-weight-bold text-primary text-uppercase mb-1">Wakil :</div>
                                        <div class="h5 mb-3 font-weight-bold"><?= $wakil['wnama'] . ' / ' . $wakil['wkelas']; ?></div>
                                    <?php endforeach; ?>
                                    <div class="font-weight-bold text-primary text-uppercase mb-1">Visi :</div>
                                    <p class="mb-2"><?= htmlspecialchars_decode($knd['visi']); ?></p>
                                    <div class="font-weight-bold text-primary text-uppercase mb-1">Misi :</div>
                                    <p class="mb-2"><?= htmlspecialchars_decode($knd['misi']); ?></p>
                                </div>
                                <div class="col-md-2">
                                    <div class="custom-control custom-radio radiobut">
                                        <h5 class="text-primary">Pilih</h5>
                                        <input type="radio" name="vote" required class="radiobutton" <?= $st_pemilih == 1 ? 'disabled' : '' ?> value="<?= $knd['id_kandidat']; ?>" class="mb-4">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <button type="submit" class="btn-primary btn-block mb-4 btn-lg" <?= $st_pemilih == 1 ? 'disabled' : '' ?>>Submit</button>
    </form>
</div>
<?= $this->endSection(); ?>