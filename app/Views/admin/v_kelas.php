<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="flash-data" data-flashdata="<?= session()->get('message') ?>"></div>
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?= $title; ?></h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="/kelas/addKelas" class="btn btn-success">
                <i class="fas fa-plus"></i>
                Add Data
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kelas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama Kelas</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($kelas as $k) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $k['nama_kelas']; ?></td>
                                <td class="d-flex">
                                    <!-- Tombol Detail -->
                                    <a href="/kelas/detailKelas/<?= $k['id_kelas']; ?>" class="btn btn-info btn-sm mr-2" title="Lihat Detail"><i class="fas fa-eye"></i></a>
                                    <!-- Tombol Edit -->
                                    <a href="/kelas/editKelas/<?= $k['id_kelas']; ?>" class="btn btn-primary btn-sm mr-2" title="Edit"><i class="fas fa-edit"></i></a>
                                    <!-- Tombol Hapus -->
                                    <button class="btn btn-danger btn-sm mr-2" data-toggle="modal" data-target="#delModal<?= $k['id_kelas']; ?>" title="Hapus"><i class="fas fa-trash"></i></button>
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
<!-- Modal Delete -->
<?php foreach ($kelas as $k) : ?>
    <div class="modal fade" id="delModal<?= $k['id_kelas']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/kelas/delete/<?= $k['id_kelas']; ?>" method="post">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="_method" value="DELETE">
                    <div class="modal-body">
                        Apakah ingin menghapus data ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<!-- /.End Modal Delete -->
<?= $this->endSection(); ?>