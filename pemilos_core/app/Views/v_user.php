<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<!-- Begin Page Content -->
<div class="content">
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <h4 class="card-title">Data Latih</h4>
                        </div>
                        <div class="float-right">
                            <a href="javascript:void(0)" data-toggle="modal" data-target="#modalImport" class="btn btn-round btn-primary"><i class="fas fa-plus"></i>&nbsp;&nbsp;Impor Data</a>
                            <!-- <a href="javascript:void(0)" onclick="deleteAllD()" class="btn btn-danger btn-round ml-auto">
                                <i class="fa fa-trash"></i>
                                &nbsp;Hapus Semua Data
                            </a> -->
                            <button class="btn btn-info btn-round ml-auto" type="button" data-toggle="collapse" data-target="#info" aria-expanded="false" aria-controls="collapseExample">
                                <i class="fa fa-info-circle mr-1"></i>Informasi
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="collapse px-3 pb-3" id="info">
                            <h5>
                                <strong>Informasi :</strong>
                            </h5>
                            <p class="mx-3 text-muted">1. Di bawah ini merupakan kumpulan data latih klasifikasi kanker serviks. Ada 19 parameter atau atribut penelitian yang digunakan.</p>
                        </div>
                        <div class="table-responsive">
                            <table id="datatable" class="display table table-striped table-hover">
                                <thead>
                                    <th>NIS</th>
                                    <th>Aksi</th>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($user as $data) { ?>
                                        <tr>
                                            <td><?= $data['nis']; ?></td>
                                            <td>
                                                <div class="form-button-action">
                                                    <button type="button" data-toggle="modal" data-tooltip="tooltip" title="Detail Data" data-target="#DetailModal<?= $data['id_train'] ?>" title="" class="btn btn-info btn-sm" data-original-title="Detail">
                                                        <i class="fa fa-info"></i>
                                                    </button>&nbsp;
                                                    <button data-tooltip="tooltip" title="Hapus Data" type="button" data-id="<?= $data['id_train'] ?>" data-link="/Training/delete/" data-nama=" Training <?= $data['id_train'] ?>" id="hapus_crud" class="btn btn-danger btn-sm hapus_crud"><i class="fas fa-trash"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalImport" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Impor Data Latih</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form action="<?= base_url('/Training/prosesExcel/') ?>" enctype="multipart/form-data" method="post">
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
                    <li>Masukkan data latih pada <i>Template Excel</i> yang telah diunduh</li>
                    <li>Klik tombol "Pilih File" di sebelah kiri untuk memilih <i>File Excel</i> yang akan diunggah</li>
                    <li>Klik tombol "Unggah File Excel" untuk unggah <i>File Excel</i> yang telah berisi data latih</li>
                </ol><br>
                <div class="float-right">
                    <a href="<?= base_url(); ?>/assets/excel/template_data.xlsx" class="btn btn-success"><i class="fas fa-download"></i>&nbsp;&nbsp;Unduh Template Excel</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
<?= $this->endSection(); ?>