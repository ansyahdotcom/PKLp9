<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="flash-data" data-flashdata="<?= session()->get('message') ?>"></div>
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?= $title; ?></h1>
    <div class="card shadow mb-4">
        <?= csrf_field(); ?>
        <div class="card-header bg-primary py-3">
            <h5 class="text-white font-weight-bold text-center">Detail Data Kelas</h5>
        </div>
        <div class="card-body">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="nama_kelas"><b>Nama Kelas</b></label>
                    <input type="text" name="nama_kelas" class="form-control" id="nama_kelas" value="<?= $nama_kelas['nama_kelas']; ?>" placeholder="Masukkan Nama Kelas..." readonly>

                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="<?= base_url(); ?>/kelas" class="btn btn-outline-secondary">
                Kembali
            </a>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>