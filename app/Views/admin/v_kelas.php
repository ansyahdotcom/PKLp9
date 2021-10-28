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
                                    <a href="/kelas/detailKelas/<?= $k['id_kelas']; ?>" class="btn btn-info btn-sm mr-2"><i class="fas fa-eye"></i></a>
                                    <!-- Tombol Edit -->
                                    <a href="/kelas/editKelas/<?= $k['id_kelas']; ?>" class="btn btn-primary btn-sm mr-2" title="Edit Data"><i class="fas fa-edit"></i></a>
                                    <!-- Tombol Hapus -->
                                    <form action="/kelas/<?= $k['id_kelas'] ?>" method="post" class="d-inline">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger btn-sm mr-2" onclick="return confirm('Anda yakin untuk menghapus KELAS ini?')"><i class="fas fa-trash"></i>
                                    </form>
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