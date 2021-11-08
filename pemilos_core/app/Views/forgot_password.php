<?= $this->extend('layout/template_login'); ?>
<?= $this->section('content'); ?>

<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-8 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0 mx-auto">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block">
                            <img src="<?= base_url(); ?>/assets/img/OSIS.jpg">
                        </div>
                        <div class="col-lg mx-auto">
                            <div class="p-4">
                                <div class="text-center my-auto">
                                    <h1 class="h4 text-gray-900 mb-4">Silakan Menghubungi Admin Untuk Mengubah Password!</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>