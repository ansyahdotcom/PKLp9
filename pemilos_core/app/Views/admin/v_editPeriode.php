<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="flash-data" data-flashdata="<?= session()->get('message') ?>"></div>
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?= $title; ?></h1>
    <div class="card shadow mb-4">
        <form action="<?= base_url(); ?>/periode/update/<?= $periode['id_periode']; ?>" method="post">
            <?= csrf_field(); ?>
            <div class="card-header bg-primary py-3">
                <h5 class="text-white font-weight-bold text-center">Form Tambah Data Periode</h5>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <small class="text-muted font-italic"><b>Keterangan: field yang bertanda <span class="text-danger">*</span> wajib diisi.</b></small>
                </div>
                <hr>
                <div class="form-row">
                    <input type="hidden" name="id" value="<?= $periode['id_periode']; ?>">
                    <input type="hidden" name="old_periode" value="<?= $periode['periode']; ?>">
                    <div class="form-group col-md-12">
                        <label for="periode"><b>Periode <span class="text-danger">*</span></b></label>
                        <input type="text" name="periode" class="form-control <?= ($validation->hasError('periode')) ? 'is-invalid' : ''; ?>" id="periode" value="<?= $periode['periode']; ?>" placeholder="Masukkan periode (ex: 2024/2025)...">
                        <div class="invalid-feedback">
                            <?= $validation->getError('periode'); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="<?= base_url(); ?>/periode" class="btn btn-outline-secondary">
                    Kembali
                </a>
                <button type="submit" class="btn btn-primary float-right" id="save-btn">
                    Simpan
                </button>
        </form>
    </div>
</div>
</div>
<?= $this->endSection(); ?>