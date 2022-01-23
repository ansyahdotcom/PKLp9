<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="flash-data" data-flashdata="<?= session()->get('message') ?>"></div>
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?= $title; ?></h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <form action="<?= base_url(); ?>/kandidat/save" enctype="multipart/form-data" method="post">
            <?= csrf_field(); ?>
            <div class="card-header bg-primary py-3">
                <h5 class="text-white font-weight-bold text-center">Form Tambah Data Kandidat</h5>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <small class="text-muted font-italic"><b>Keterangan: field yang bertanda <span class="text-danger">*</span> wajib diisi.</b></small>
                </div>
                <hr>
                <input type="hidden" name="periode" value="<?= $periode['id_periode']; ?>" readonly>
                <div class="text-center mb-4">
                    <h3 class="font-weight-bold">Foto Kandidat</h3>
                    <img class="img img-responsive img-resize img-preview" src="<?= base_url(); ?>/assets/img/fotokandidat/default.jpg" class="mt-2" alt="foto kandidat" width="200px">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="ketua"><b>Ketua <span class="text-danger">*</span></b></label>
                        <select class="form-control <?= ($validation->hasError('ketua')) ? 'is-invalid' : ''; ?>" id="ketua" name="ketua" title="pilih ketua..." onchange="getValue1(this.value)">
                            <option value="" selected>pilih ketua...</option>
                            <?php foreach ($user as $u) : ?>
                                <option value="<?= $u['nis']; ?>"><?= $u['nama_usr']; ?> (NIS: <?= $u['nis']; ?>)</option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('ketua'); ?>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="wakil"><b>Wakil <span class="text-danger">*</span></b></label>
                        <select class="form-control <?= ($validation->hasError('wakil')) ? 'is-invalid' : ''; ?>" id="wakil" name="wakil" title="pilih wakil..." onchange="getValue2(this.value)">
                            <option value="" selected>pilih wakil...</option>
                            <?php foreach ($user as $u) : ?>
                                <option value="<?= $u['nis']; ?>"><?= $u['nama_usr']; ?> (NIS: <?= $u['nis']; ?>)</option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('wakil'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="nama_psg"><b>Nama Pasangan <span class="text-danger">*</span></b></label>
                        <input type="text" name="nama_psg" class="form-control <?= ($validation->hasError('nama_psg')) ? 'is-invalid' : ''; ?>" id="nama_psg" value="<?= old('nama_psg'); ?>" placeholder="nama pasangan (contoh: Pasangan Sip)..." autocomplete="off">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama_psg'); ?>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="wakil"><b>Foto <span class="text-danger">*</span></b></label>
                        <input type="file" name="foto" class="form-control <?= ($validation->hasError('foto')) ? 'is-invalid' : ''; ?>" id="foto" accept=".jpg,.jpeg,.png,.gif" onchange="previewImg()" autocomplete="off">
                        <div class="invalid-feedback">
                            <?= $validation->getError('foto'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="visi"><b>Visi <span class="text-danger">*</span></b></label>
                        <textarea class="summernote form-control <?= ($validation->hasError('visi')) ? 'is-invalid' : ''; ?>" name="visi" id="visi" placeholder="visi kandidat..." required autocomplete="off"><?= old('visi'); ?></textarea>
                        <div class="invalid-feedback">
                            <?= $validation->getError('visi'); ?>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="misi"><b>Misi <span class="text-danger">*</span></b></label>
                        <textarea class="summernote form-control <?= ($validation->hasError('misi')) ? 'is-invalid' : ''; ?>" name="misi" id="misi" placeholder="misi kandidat..." required autocomplete="off"><?= old('misi'); ?></textarea>
                        <div class="invalid-feedback">
                            <?= $validation->getError('misi'); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="<?= base_url(); ?>/kandidat" class="btn btn-outline-secondary">
                    Kembali
                </a>
                <button type="submit" class="btn btn-primary float-right" id="save-btn">
                    Simpan
                </button>
        </form>
    </div>
</div>
</div>
<?= $this->endSection(); ?>