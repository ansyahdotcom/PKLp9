<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pemilihan Ketua OSIS SMA Negeri 4 Surakarta Periode 2021/2022</h1>
    </div>
    <?php foreach ($kandidat as $knd) : ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow mb-4 border-left-primary">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary"><?= $knd['nama_pasangan']; ?></h6>
                    </div>
                    <div class="card-body">
                        <div class="row no-gutters">
                            <div class="col-md-3 mr-3">
                                <img src="\assets\img\fotokandidat\<?= $knd['foto']; ?>" alt="..." style="width: 100%;">
                            </div>
                            <div class="col-md-6">
                                <div class="font-weight-bold text-primary text-uppercase mb-1">Ketua :</div>
                                <div class="h5 mb-3 font-weight-bold"><?= $knd['nama_usr'] . ' / ' . $knd['nama_kelas']; ?></div>
                                <div class="font-weight-bold text-primary text-uppercase mb-1">Wakil :</div>
                                <div class="h5 mb-3 font-weight-bold">Rendi</div>
                                <div class="font-weight-bold text-primary text-uppercase mb-1">Visi :</div>
                                <p class="mb-2"><?= $knd['visi']; ?></p>
                                <div class="font-weight-bold text-primary text-uppercase mb-1">Misi :</div>
                                <p class="mb-2"><?= $knd['misi']; ?></p>
                            </div>
                            <div class="col-auto">
                                <div class="form-group">
                                    <input type="radio"> Pilih
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<?= $this->endSection(); ?>