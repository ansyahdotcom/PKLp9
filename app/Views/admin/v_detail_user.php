<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?= $title; ?></h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <?= csrf_field(); ?>
        <div class="card-header bg-primary py-3">
            <h5 class="text-white font-weight-bold text-center">Detail Data Siswa</h5>
        </div>
        <div class="card-body">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="nis"><b>NIS</b></label>
                    <input type="text" name="nis" class="form-control" id="nis" value="<?= $user['nis']; ?>" placeholder="NIS Siswa" readonly>
                </div>
                <div class="form-group col-md-6">
                    <label for="nama_usr"><b>Nama Siswa</b></label>
                    <input type="text" name="nama_usr" class="form-control" id="nama_usr" value="<?= $user['nama_usr']; ?>" placeholder="Masukkan Nama Siswa..." readonly>

                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="kelas"><b>Kelas</b></label>
                    <input type="text" name="id_kelas" class="form-control" id="id_kelas" value="<?= $user['nama_kelas']; ?>" placeholder="Kelas belum terisi..." readonly>
                </div>
                <div class="form-group col-md-6">
                    <label for="kelas"><b>Jenis Kelamin</b></label>
                    <input type="text" name="jk" class="form-control" id="jk" value="<?= $user['jk']; ?>" placeholder="Jenis Kelamin belum terisi..." readonly>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="/user" class="btn btn-danger">
                <i class="fas fa-arrow-circle-left"></i>
                Back
            </a>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>