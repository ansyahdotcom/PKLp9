<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="flash-data" data-flashdata="<?= session()->get('message') ?>"></div>
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?= $title; ?></h1>
    <div class="card shadow mb-4">
        <form action="<?= base_url(); ?>/kelas/insertKelas" method="post">
            <?= csrf_field(); ?>
            <div class="card-header bg-primary py-3">
                <h5 class="text-white font-weight-bold text-center">Form Tambah Data Kelas</h5>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <small class="text-muted font-italic"><b>Keterangan: field yang bertanda <span class="text-danger">*</span> wajib diisi.</b></small>
                </div>
                <hr>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="nama_kelas"><b>Nama Kelas<span class="text-danger">*</span></b></label>
                        <input type="text" name="nama_kelas" class="form-control <?= ($validation->hasError('nama_kelas')) ? 'is-invalid' : ''; ?>" id="nama_kelas" value="<?= old('nama_kelas'); ?>" placeholder="Masukkan Nama Kelas...">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama_kelas'); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="<?= base_url(); ?>/kelas" class="btn btn-outline-secondary">
                    Kembali
                </a>
                <button type="submit" class="btn btn-primary float-right" id="save-btn">
                    Tambah
                </button>
        </form>
    </div>
</div>
</div>
<?= $this->endSection(); ?>