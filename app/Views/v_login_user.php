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
                        <div class="col-lg-6 d-none d-lg-block">
                            <img src="<?= base_url(); ?>/assets/img/OSIS.jpg">
                        </div>
                        <div class="col-lg mx-auto">
                            <div class="p-4">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Login Siswa</h1>
                                </div>
                                <form class="user" action="<?= base_url('login/login_user'); ?>" method="POST">
                                    <?= csrf_field(); ?>
                                    <div class="form-group">
                                        <input type="text" name="nis" class="form-control form-control-user <?= ($validation->hasError('nis')) ? 'is-invalid' : ''; ?>" placeholder="NIS" required autofocus autocomplete="off">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('nis'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control form-control-user" placeholder="Password" required autofocus>
                                    </div>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('password'); ?>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Login</button>
                                    <div class="text-center mt-3">
                                        <a class="small" href="#">Forgot Password?</a>
                                    </div>
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