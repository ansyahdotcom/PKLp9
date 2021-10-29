<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="flash-data" data-flashdata="<?= session()->get('message') ?>"></div>
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?= $title; ?></h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header bg-primary py-3">
            <h5 class="text-white font-weight-bold text-center">Belum ada periode yang diaktifkan</h5>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>