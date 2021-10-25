<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?= $title; ?></h1>
    <!-- Flashdata Message -->
    <?php
    if (session()->getFlashdata('message')) {
        echo session()->getFlashdata('message');
    }
    ?>
    <!-- /.End Flashdata Message -->
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <form action="/kelas/insertKelas" method="post">
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
                <a href="/user" class="btn btn-danger">
                    <i class="fas fa-arrow-circle-left"></i>
                    Back
                </a>
                <button type="submit" class="btn btn-primary float-right" id="save-btn">
                    Save <i class="fas fa-save"></i>
                </button>
        </form>
    </div>
</div>
</div>
<?= $this->endSection(); ?>