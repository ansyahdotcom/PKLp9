<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?= $title; ?></h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="javascript:void(0)" data-toggle="modal" data-target="#TambahModal" class="btn btn-success btn-sm">
                <i class="fas fa-plus"></i>
                Add Data
            </a>
            <a href="javascript:void(0)" data-toggle="modal" data-target="#modalImport" class="btn btn-success btn-sm">
                <i class="fas fa-plus"></i>&nbsp;&nbsp;Import Data
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="datatable">
                    <thead>
                        <tr>
                            <th>NIS</th>
                            <th>Nama Siswa</th>
                            <th>Status Pemilih</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>NIS</th>
                            <th>Nama Siswa</th>
                            <th>Status Pemilih</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach ($user as $k) : ?>
                            <?php $no = 1; ?>
                            <tr>
                                <td><?= $k['nis']; ?></td>
                                <td><?= $k['nama_usr']; ?></td>
                                <td><?php if ($k['st_pemilih'] == 1) {
                                        echo '<span class="badge badge-primary"><b>Sudah Vote</b></span>';
                                    } else {
                                        echo '<span class="badge badge-danger"><b>Belum Vote</b></span>';
                                    } ?></td>
                                <td class="d-flex">
                                    <a href="#" class="btn btn-info btn-sm mr-2" title="lihat detail"><i class="fas fa-eye"></i></a>
                                    <a href="#" class="btn btn-primary btn-sm mr-2" title="edit data"><i class="fas fa-edit"></i></a>
                                    <button data-tooltip="tooltip" title="Hapus Data" type="button" data-id="<?= $k['nis'] ?>" data-link="/user/delete/" data-nama=" Siswa <?= $k['nama_usr'] ?>" id="hapus_crud" class="btn btn-danger btn-sm hapus_crud"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="TambahModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class=" modal-lg modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h4 class="modal-title">
                    <span class="">
                        Tambah Data Siswa</span>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url() ?>/user/insert" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group form-group-default mx-0">
                                <label>Nama Siswa</label>
                                <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukkan Nama Lengkap" value="">
                            </div>
                            <div class="form-group form-group-default mx-0">
                                <label>Nama Siswa</label>
                                <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukkan Nama Lengkap" value="">
                            </div>
                            <div class="form-group form-group-default mx-0">
                                <label>Nama Siswa</label>
                                <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukkan Nama Lengkap" value="">
                            </div>
                            <div class="form-group form-group-default mx-0">
                                <label>Nama Siswa</label>
                                <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukkan Nama Lengkap" value="">
                            </div>
                            <div class="form-group form-group-default mx-0">
                                <label>Nama Siswa</label>
                                <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukkan Nama Lengkap" value="">
                            </div>
                        </div>
                        <!-- <div class="col-md-6">
                            <div class="form-group form-group-default mx-0">
                                <label>Alpha</label>
                                <input id="alpha" type="number" name="alpha" pattern="^(?:0*(?:\.\d+)?|1(\.0*)?)$" class="form-control" placeholder="Masukkan nilai antara 0.0 - 0.1" required>
                            </div>
                        </div> -->
                    </div>
                </div>
                <div class="modal-footer no-bd">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Detail -->
<?php
foreach ($user as $data) { ?>
    <div class="modal fade" id="DetailModal<?= $data['nis'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header no-bd">
                    <h3 class="modal-title">
                        <span class="fw-mediumbold">
                            Detail Data Siswa</span>
                    </h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url() ?>/user" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="nama">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" value="<?= set_value('nama_usr') ?>" id="nama" placeholder="Masukkan Nama Lengkap">
                        </div>
                    </form>
                </div>
                <div class="modal-footer no-bd">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<!-- Modal Import Data -->
<div class="modal fade" id="modalImport" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Impor Data Siswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form action="<?= base_url('/User/prosesExcel/') ?>" enctype="multipart/form-data" method="post">
                        <div class="form-group mx-4">
                            <label for="exampleFormControlFile1">Pilih File Excel</label>
                            <input type="file" name="file_excel" accept=".xlsx, .xls, .csv" class="form-control-file" id="file_excel">
                            <button type="submit" class="btn btn-primary btn-sm mt-1"> <i class="fas fa-upload"></i>&nbsp;&nbsp;Unggah File Excel</button>
                        </div>
                    </form>
                </div> <br>
                <h5 class="mx-3 text-muted"><strong>Panduan mengunggah <i>File Excel</i>:</strong></h5>
                <ol>
                    <li>Silahkan unduh <i>Template Excel</i> terlebih dahulu dengan cara klik tombol "Unduh Template Excel" di bawah ini.</li>
                    <li>Masukkan data siswa pada <i>Template Excel</i> yang telah diunduh</li>
                    <li>Klik tombol "Pilih File" di sebelah kiri untuk memilih <i>File Excel</i> yang akan diunggah</li>
                    <li>Klik tombol "Unggah File Excel" untuk unggah <i>File Excel</i> yang telah berisi data siswa</li>
                </ol><br>
                <div class="float-right">
                    <a href="/assets/excel/template_data.xlsx" class="btn btn-success"><i class="fas fa-download"></i>&nbsp;&nbsp;Unduh Template Excel</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
<?= $this->endSection(); ?>