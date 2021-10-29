<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="flash-data" data-flashdata="<?= session()->get('message') ?>"></div>
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?= $title; ?></h1>
    <div class="card shadow mb-4">
        <form action="/user/edit/<?= $user['nis']; ?>" method="post">
            <?= csrf_field(); ?>
            <div class="card-header bg-primary py-3">
                <h5 class="text-white font-weight-bold text-center">Form Edit Data Siswa</h5>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <small class="text-muted font-italic"><b>Keterangan: field yang bertanda <span class="text-danger">*</span> wajib diisi.</b></small>
                    <button type="button" class="btn btn-secondary btn-sm mr-2 float-right btn-batalpsw float-right"><i class="fas fa-ban"></i>&nbsp;Batal Ubah Kata Sandi</button>
                    <button type="button" class="btn btn-primary btn-sm mr-2 float-right btn-ubahpsw float-right"><i class="fas fa-lock"></i>&nbsp;Ubah Kata Sandi</button>
                </div>
                <hr>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="nis"><b>NIS<span class="text-danger">*</span></b></label>
                        <input type="text" name="nis" class="form-control" id="nis" value="<?= $user['nis']; ?>" placeholder="NIS Siswa" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="nama_usr"><b>Nama Siswa<span class="text-danger">*</span></b></label>
                        <input type="text" name="nama_usr" class="form-control <?= ($validation->hasError('nama_usr')) ? 'is-invalid' : ''; ?>" id="nama_usr" value="<?= $user['nama_usr']; ?>" placeholder="Masukkan Nama Siswa...">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama_usr'); ?>
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
                <div class="form-row">
                    <div class="form-group col-md-6 psw">
                        <label for="exampleInputPassword1">Kata Sandi</label>
                        <input type="password" name="psw_usr1" class="form-control <?= ($validation->hasError('psw_usr1')) ? 'is-invalid' : ''; ?>" id="psw_usr1" placeholder="Masukkan Kata Sandi..." value="<?= set_value('psw_usr1'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('psw_usr1'); ?>
                        </div>

                    </div>
                    <div class="form-group col-md-6 psw1">
                        <label for="exampleInputPassword1">Ulangi Kata Sandi</label>
                        <input type="password" name="psw_usr2" class="form-control <?= ($validation->hasError('psw_usr2')) ? 'is-invalid' : ''; ?>" id="psw_usr2" placeholder="Ketik Ulang Kata Sandi..." value="<?= set_value('psw_usr2'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('psw_usr2'); ?>
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