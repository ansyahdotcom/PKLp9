<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="flash-data" data-flashdata="<?= session()->get('message') ?>"></div>
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?= $title; ?></h1>
    <div class="card shadow mb-4">
        <form action="/user/insert" method="post">
            <?= csrf_field(); ?>
            <div class="card-header bg-primary py-3">
                <h5 class="text-white font-weight-bold text-center">Form Tambah Data Siswa</h5>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <small class="text-muted font-italic"><b>Keterangan: field yang bertanda <span class="text-danger">*</span> wajib diisi.</b></small>
                </div>
                <hr>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="nama_usr"><b>Nama Siswa<span class="text-danger">*</span></b></label>
                        <input type="text" name="nama_usr" class="form-control <?= ($validation->hasError('nama_usr')) ? 'is-invalid' : ''; ?>" id="nama_usr" value="<?= old('nama_usr'); ?>" placeholder="Masukkan Nama Siswa...">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama_usr'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="nis"><b>NIS<span class="text-danger">*</span></b></label>
                        <input type="text" name="nis" class="form-control <?= ($validation->hasError('nis')) ? 'is-invalid' : ''; ?>" id="nis" value="<?= old('nis'); ?>" placeholder="Masukkan NIS Siswa...">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nis'); ?>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="password"><b>Password<span class="text-danger">*</span></b></label>
                        <input type="password" name="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" id="password" value="<?= old('password'); ?>" placeholder="Masukkan Password...">
                        <div class="invalid-feedback">
                            <?= $validation->getError('password'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="kelas"><b>Kelas <span class="text-danger">*</span></b></label>
                        <select class="form-control selectpicker <?= ($validation->hasError('id_kelas')) ? 'is-invalid' : ''; ?>" id="kelas" name="id_kelas" data-live-search="true" title="Pilih Kelas..." autofocus>
                            <?php foreach ($kelas as $u) : ?>
                                <option value="<?= $u['id_kelas']; ?>"><?= $u['nama_kelas']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('id_kelas'); ?>
                        </div>
                        <!-- <small class="text-danger" id="alert_ketua"></small> -->
                        <!-- <input type="text" name="ketua" id="hide_ketua" hidden> -->
                    </div>
                    <div class="form-group col-md-6">
                        <label for="kelas"><b>Jenis Kelamin <span class="text-danger">*</span></b></label>
                        <select class="form-control selectpicker <?= ($validation->hasError('jk')) ? 'is-invalid' : ''; ?>" id="jk" name="jk" data-live-search="true" title="Pilih Jenis Kelamin..." autofocus>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
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