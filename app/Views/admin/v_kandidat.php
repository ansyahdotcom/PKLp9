<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?= $title; ?></h1>

    <!-- Flashdata Message -->
    <?php if (session()->getFlashdata('message')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('message'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>
    <!-- /.End Flashdata Message -->

    <form action="" method="post">
        <div class="form-group">
            <label for="nama_psg"><b>Periode Kandidat:</b> </label>
            <div class="input-group">
                <select class="form-control col-md-3 selectpicker" id="periode" name="periode1" data-live-search="true">
                    <?php foreach ($periode as $p) : ?>
                        <option value="<?= $p['id_periode']; ?>"><?= $p['periode']; ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="input-group-append">
                    <button class="btn btn-primary" type="button" title="cari">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a href="/kandidat/addKandidat" class="btn btn-success">
                    <i class="fas fa-plus"></i>
                    Add data
                </a>
            </div>
    </form>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Ketua</th>
                        <th>Nama Wakil</th>
                        <th>Last Update</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Nama Ketua</th>
                        <th>Nama Wakil</th>
                        <th>Last Update</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php foreach ($kandidat as $k) : ?>
                        <?php $no = 1; ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $k['ketua']; ?></td>
                            <td><?= $k['wakil']; ?></td>
                            <td><?= $k['updated_at']; ?></td>
                            <td class="d-flex">
                                <a href="#" class="btn btn-info btn-sm mr-2" title="lihat detail"><i class="fas fa-eye"></i></a>
                                <a href="#" class="btn btn-primary btn-sm mr-2" title="edit data"><i class="fas fa-edit"></i></a>
                                <a href="#" class="btn btn-danger btn-sm mr-2" title="hapus data"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>
<!-- /.container-fluid -->

<?= $this->endSection(); ?>