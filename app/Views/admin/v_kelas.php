<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?= $title; ?></h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="#" class="btn btn-success btn-sm">
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
                            <th>Nama Kelas</th>
                            <th>Jumlah Siswa</th>
                            <th>Last Update</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama Kelas</th>
                            <th>Jumlah Siswa</th>
                            <th>Last Update</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach($kelas as $k) : ?>
                        <?php $no = 1; ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $k['nama_kelas']; ?></td>
                            <td><?= $jm_siswa; ?></td>
                            <td><?= $k['updated_at']; ?></td>
                            <td class="d-flex">
                                <a href="#" class="btn btn-info btn-sm mr-2" title="lihat detail"><i
                                        class="fas fa-eye"></i></a>
                                <a href="#" class="btn btn-primary btn-sm mr-2" title="edit data"><i
                                        class="fas fa-edit"></i></a>
                                <a href="#" class="btn btn-danger btn-sm mr-2" title="hapus data"><i
                                        class="fas fa-trash"></i></a>
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