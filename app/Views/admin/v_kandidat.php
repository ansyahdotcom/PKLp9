<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?= $title; ?></h1>

    <!-- Flashdata Message -->
    <?php
    if (session()->getFlashdata('message')) {
        echo session()->getFlashdata('message');
    }
    ?>
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

                        <!-- Menampilkan nama kandidat -->
                        <?php
                        $db = \Config\Database::connect();
                        $builder = $db->table('user');
                        $ketua = $builder->getWhere(['nis' => $k['ketua']])
                                ->getFirstRow();
                        $wakil = $builder->getWhere(['nis' => $k['wakil']])
                                ->getFirstRow();
                        ?>
                        <!-- /. End menampilkan nama kandidat  -->

                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $ketua->nama_usr; ?></td>
                            <td><?= $wakil->nama_usr; ?></td>
                            <td><?= $k['updated_at']; ?></td>
                            <td class="d-flex">
                                <a href="#" class="btn btn-info btn-sm mr-2" title="lihat detail"><i class="fas fa-eye"></i></a>
                                <a href="/kandidat/editKandidat/<?= $k['id_kandidat']; ?>" class="btn btn-primary btn-sm mr-2" title="edit data"><i class="fas fa-edit"></i></a>
                                <button type="button" class="btn btn-danger btn-sm mr-2" data-toggle="modal" data-target="#delModal<?= $k['id_kandidat']; ?>" title="hapus data"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>

<!-- Modal Delete -->
<?php foreach ($kandidat as $k) : ?>
    <div class="modal fade" id="delModal<?= $k['id_kandidat']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="kandidat/<?= $k['id_kandidat']; ?>" method="post">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="_method" value="DELETE">
                    <div class="modal-body">
                        Apakah ingin menghapus data ini?
                        <input type="hidden" name="ketua" value="<?= $k['ketua']; ?>">
                        <input type="hidden" name="wakil" value="<?= $k['wakil']; ?>">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel <i class="fas fa-ban"></i></button>
                        <button type="submit" class="btn btn-danger">Delete <i class="fas fa-trash"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<!-- /.End Modal Delete -->

<!-- /.container-fluid -->

<?= $this->endSection(); ?>