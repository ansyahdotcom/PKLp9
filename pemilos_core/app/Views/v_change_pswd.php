<?= $this->extend('layout/template_login'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">
    <div class="flash-data" data-flashdata="<?= session()->get('message') ?>"></div>

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-6 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0 mx-auto">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block my-auto">
                            <img src="<?= base_url(); ?>/assets/img/OSIS.jpg">
                        </div>
                        <div class="col-lg mx-auto">
                            <div class="p-4">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Ubah Password Sebelum Voting</h1>
                                </div>
                                <form class="user" action="<?= base_url('login/change_password'); ?>" method="POST">
                                    <?= csrf_field(); ?>
                                    <div class="mb-3">
                                        <label for="password" class="form-label text-gray-900">Password saat ini</label>
                                        <input type="password" class="form-control form-control-user" name="password" id="password" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="password1" class="form-label text-gray-900">Password baru</label>
                                        <input type="password" class="form-control form-control-user <?= ($validation->hasError('password1')) ? 'is-invalid' : ''; ?>" name="password1" id="password1" required>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('password1'); ?>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="password2" class="form-label text-gray-900">Konfirmasi password baru</label>
                                        <input type="password" class="form-control form-control-user" name="password2" id="password2" required>
                                        <small id="showerror"></small>
                                    </div>
                                    <button type="submit" class="btn btn-primary" align="right">Ubah</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
<?= $this->section('script'); ?>
<script>
    $(document).ready(function() {
        <?= session()->getFlashdata('pesan'); ?>
    });
</script>
<?= $this->endSection(); ?>