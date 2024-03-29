<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="flash-data" data-flashdata="<?= session()->get('message') ?>"></div>
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?= $title; ?></h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="<?= base_url(); ?>/periode/addPeriode" class="btn btn-success">
                <i class="fas fa-plus"></i>
                Add data
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Periode</th>
                            <th>Status</th>
                            <th>Last Update</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Periode</th>
                            <th>Status</th>
                            <th>Last Update</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($periode as $p) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $p['periode']; ?></td>
                                <td>
                                    <?php if ($p['st_periode'] == "1") : ?>
                                        <span class="badge badge-pill badge-success">Active</span>
                                    <?php else : ?>
                                        <span class="badge badge-pill badge-danger">Disabled</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= $p['updated_pd']; ?></td>
                                <td class="d-flex">
                                    <?php
                                    if ($p['st_periode'] == "1") :
                                        $disabled = "disabled";
                                        $buka = "";
                                    ?>
                                        <button class="btn btn-secondary btn-sm mr-2" data-toggle="modal" data-target="#modalNonactive<?= $p['id_periode']; ?>" title="nonaktifkan"><i class="fas fa-eye-slash"></i></button>
                                    <?php
                                    else :
                                        $disabled = "";
                                        $buka = "disabled";
                                    ?>
                                        <button class="btn btn-info btn-sm mr-2" data-toggle="modal" data-target="#modalActive<?= $p['id_periode']; ?>" title="aktifkan"><i class="fas fa-eye"></i></button>
                                    <?php endif; ?>

                                    <?php if ($p['st_buka'] == "1") : ?>
                                        <a href="<?= base_url(); ?>/periode/close/<?= $p['id_periode']; ?>" class="btn btn-warning btn-sm mr-2" title="tutup vote"><i class="fas fa-fw fa-sign-out-alt"></i></a>
                                    <?php else : ?>
                                        <a href="<?= base_url(); ?>/periode/open/<?= $p['id_periode']; ?>" class="btn btn-success btn-sm mr-2 <?= $buka; ?>" title="buka vote"><i class="fas fa-fw fa-sign-in-alt"></i></a>
                                    <?php endif; ?>

                                    <a href="<?= base_url(); ?>/periode/editPeriode/<?= $p['id_periode']; ?>" class="btn btn-primary btn-sm mr-2" title="edit data"><i class="fas fa-edit"></i></a>
                                    <button type="button" class="btn btn-danger btn-sm mr-2" data-toggle="modal" data-target="#delModal<?= $p['id_periode']; ?>" title="hapus data" <?= $disabled; ?>><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Active -->
<?php foreach ($periode as $p) : ?>
    <div class="modal fade" id="modalActive<?= $p['id_periode']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Aktifkan Periode</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url(); ?>/periode/active/<?= $p['id_periode']; ?>" method="post">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="_method" value="ACTIVE">
                    <div class="modal-body">
                        Apakah Anda yakin ingin mengaktifkan periode ini?
                        jika iya maka voting periode sebelumnya akan ditutup
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Tidak</button>
                        <button type="submit" class="btn btn-primary">Iya</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<!-- /.End Modal Active -->

<!-- Modal Nonctive -->
<?php foreach ($periode as $p) : ?>
    <div class="modal fade" id="modalNonactive<?= $p['id_periode']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nonaktifkan Periode</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url(); ?>/periode/nonactive/<?= $p['id_periode']; ?>" method="post">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="_method" value="NONACTIVE">
                    <div class="modal-body">
                        Apakah Anda yakin ingin menonaktifkan periode ini?
                        jika iya maka voting pada periode ini akan ditutup
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Tidak</button>
                        <button type="submit" class="btn btn-primary">Iya</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<!-- /.End Modal Nonctive -->

<!-- Modal Delete -->
<?php foreach ($periode as $p) : ?>
    <div class="modal fade" id="delModal<?= $p['id_periode']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url(); ?>/periode/delete" method="post">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="_method" value="DELETE">
                    <div class="modal-body">
                        <input type="hidden" name="id" value="<?= $p['id_periode']; ?>">
                        Apakah ingin menghapus data ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Hapus</i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<!-- /.End Modal Delete -->

<!-- /.container-fluid -->

<?= $this->endSection(); ?>