<?= $this->extend('layout/template_user'); ?>
<?= $this->section('content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="flash-data" data-flashdata="<?= session()->get('message') ?>"></div>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
    </div>
    <div class="row">
        <div class="col-lg-3">
            <div class="card shadow mb-4">
                <!-- <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><?= $nama; ?></h6>
                </div> -->
                <div class="card-body text-center">
                    <img class="mx-auto" src="<?= base_url(); ?>/assets/img/profile.jpg" alt="foto profil" width="200px">
                </div>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="h5 mb-0 font-weight-bold text-gray-900">Nama</div>
                    <div class="h5 font-weight-bold text-primary text-uppercase mb-3">
                        <?= $nama; ?></div>
                    <div class="h5 mb-0 font-weight-bold text-gray-900">NIS</div>
                    <div class="h5 font-weight-bold text-primary text-uppercase mb-3">
                        <?= $nis; ?></div>
                </div>
            </div>
            <div class="card shadow mb-4">
                <form action="<?= base_url(); ?>/profile/change_psswd" method="post">
                    <input type="text" hidden name="nis" value="<?= $nis; ?>">
                    <?= csrf_field(); ?>
                    <a href="#collapseCardExample" class="d-block card-header py-3 collapsed" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseCardExample">
                        <h6 class="m-0 font-weight-bold text-primary">Ubah Password</h6>
                    </a>
                    <div class="collapse show" id="collapseCardExample">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="password" class="form-label text-gray-900">Password saat ini</label>
                                <input type="password" class="form-control" name="password" id="password" required>
                            </div>
                            <div class="mb-3">
                                <label for="password1" class="form-label text-gray-900">Password baru</label>
                                <input type="password" class="form-control <?= ($validation->hasError('password1')) ? 'is-invalid' : ''; ?>" name="password1" id="password1" required>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('password1'); ?>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="password2" class="form-label text-gray-900">Konfirmasi password baru</label>
                                <input type="password" class="form-control" name="password2" id="password2" required>
                                <small id="showerror"></small>
                            </div>
                            <button type="submit" class="btn btn-primary" id="submit">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>