<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="flash-data" data-flashdata="<?= session()->get('message') ?>"></div>
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?= $title; ?></h1>

    <form action="<?= base_url(); ?>/kandidat/searchKandidat" method="post">
        <?= csrf_field(); ?>
        <?php
        $uri = service('uri');
        if ($uri->getSegment(2) != 'searchKandidat') :
        ?>
            <div class="form-group">
                <label for="nama_psg"><b>Cari kandidat berdasarkan periode:</b> </label>
                <input type="hidden" name="activePeriode" value="<?= $activePeriode['id_periode']; ?>" readonly>
                <div class="input-group">
                    <select class="form-control col-md-3" id="periode" name="periode1">
                        <?php foreach ($periode as $p) : ?>
                            <option value="<?= $p['id_periode']; ?>"><?= $p['periode']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit" title="cari">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        <?php else : ?>
            <div class="form-group">
                <label for="nama_psg"><b>Cari kandidat berdasarkan periode:</b> </label>
                <input type="hidden" name="activePeriode" value="<?= $kandidatPeriode ?>" readonly>
                <div class="input-group">
                    <select class="form-control col-md-3" id="periode" name="periode1">
                        <?php foreach ($periode as $p) : ?>
                            <option value="<?= $p['id_periode']; ?>"><?= $p['periode']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit" title="cari">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </form>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="<?= base_url(); ?>/kandidat/addKandidat" class="btn btn-success btn-addData">
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
                        <?php $no = 1; ?>
                        <?php foreach ($kandidat as $k) : ?>

                            <!-- Menampilkan nama kandidat -->
                            <?php
                            $db = \Config\Database::connect();
                            $user = $db->table('user');
                            $kd = $db->table('kandidat');
                            $ketua = $user->getWhere(['nis' => $k['ketua']])
                                ->getFirstRow();
                            $wakil = $user->getWhere(['nis' => $k['wakil']])
                                ->getFirstRow();
                            $updated_at = $kd->get()
                                ->getResultObject();
                            ?>
                            <!-- /. End menampilkan nama kandidat  -->

                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $ketua->nama_usr; ?></td>
                                <td><?= $wakil->nama_usr; ?></td>
                                <td><?= $k['updated_kd']; ?></td>
                                <td class="d-flex">
                                    <button class="btn btn-info btn-sm mr-2" data-toggle="modal" data-target="#detModal<?= $k['id_kandidat']; ?>" title="lihat detail"><i class="fas fa-eye"></i></button>
                                    <a href="<?= base_url(); ?>/kandidat/editKandidat/<?= $k['id_kandidat']; ?>" class="btn btn-primary btn-sm mr-2" title="edit data"><i class="fas fa-edit"></i></a>
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

<!-- Modal Detail -->
<?php foreach ($kandidat as $k) : ?>
    <?php
    $db = \Config\Database::connect();
    $user = $db->table('user');
    $kd = $db->table('kandidat');
    $ketua = $user->getWhere(['nis' => $k['ketua']])
        ->getFirstRow();
    $wakil = $user->getWhere(['nis' => $k['wakil']])
        ->getFirstRow();
    $updated_at = $kd->get()
        ->getResultObject();
    ?>
    <div class="modal fade" id="detModal<?= $k['id_kandidat']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Preview Kandidat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <div class="text-center mt-2">
                        <h3 class="font-weight-bold">Pasangan <?= $k['nama_pasangan']; ?></h3>
                        <img class="img img-responsive img-resize img-preview" src="<?= base_url(); ?>/assets/img/fotokandidat/<?= $k['foto']; ?>" class="mt-2" alt="foto kandidat" width="200px">
                    </div>
                    <hr>
                    <div class="row p-3">
                        <div class="col-md-6 bg-primary text-light p-2">
                            <label for="" class="font-weight-bold">Ketua</label>
                            <h5 class=""><?= $ketua->nama_usr; ?></h5>
                        </div>
                        <div class="col-md-6 bg-info text-light p-2">
                            <label for="" class="font-weight-bold">Wakil</label>
                            <h5 class=""><?= $wakil->nama_usr; ?></h5>
                        </div>
                    </div>
                    <hr>
                    <div class="text-center bg-primary text-light p-2">
                        <label for="" class="font-weight-bold">Visi</label>
                        <h5 class=""><?= $k['visi']; ?></h5>
                    </div>
                    <hr>
                    <div class="text-center bg-info text-light p-2">
                        <label for="" class="font-weight-bold">Misi</label>
                        <h5 class=""><?= $k['misi']; ?></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<!-- /.End Modal Detail -->

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
                <form action="<?= base_url(); ?>/kandidat/delete" method="post">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="_method" value="DELETE">
                    <div class="modal-body">
                        Apakah ingin menghapus data ini?
                        <input type="text" name="id" value="<?= $k['id_kandidat']; ?>">
                        <input type="hidden" name="ketua" value="<?= $k['ketua']; ?>">
                        <input type="hidden" name="wakil" value="<?= $k['wakil']; ?>">
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

<!-- /.container-fluid -->

<?= $this->endSection(); ?>