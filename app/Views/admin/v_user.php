<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?= $title; ?></h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="" class="btn btn-success btn-sm">
                <i class="fas fa-plus"></i>
                Add data
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