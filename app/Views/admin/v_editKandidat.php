<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="flash-data" data-flashdata="<?= session()->get('message') ?>"></div>
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?= $title; ?></h1>
    <div class="card shadow mb-4">
        <form action="/kandidat/update/<?= $kandidat['id_kandidat']; ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <div class="card-header bg-primary py-3">
                <h5 class="text-white font-weight-bold text-center">Form Edit Data Kandidat</h5>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <small class="text-muted font-italic"><b>Keterangan: field yang bertanda <span class="text-danger">*</span> wajib diisi.</b></small>
                </div>
                <hr>
                <div class="text-center mb-4">
                    <h3 class="font-weight-bold">Foto Kandidat</h3>
                    <img class="img img-responsive img-resize img-preview" src="/assets/img/fotokandidat/<?= $kandidat['foto']; ?>" class="mt-2" alt="foto kandidat" width="200px">
                </div>
                <input type="hidden" name="id" value="<?= $kandidat['id_kandidat']; ?>">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="ketua"><b>Ketua <span class="text-danger">*</span></b></label>
                        <select class="form-control selectpicker <?= ($validation->hasError('ketua')) ? 'is-invalid' : ''; ?>" id="ketua" name="ketua" data-live-search="true" data-size="5" title="pilih ketua..." required autofocus>
                            <?php foreach ($user as $u) : ?>
                                <option value="<?= $u['nis']; ?>"><?= $u['nama_usr']; ?> (NIS: <?= $u['nis']; ?>)</option>
                            <?php endforeach; ?>
                        </select>
                        <input type="hidden" name="old_ketua" id="old_ketua" value="<?= $kandidat['ketua']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('ketua'); ?>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="wakil"><b>Wakil <span class="text-danger">*</span></b></label>
                        <select class="form-control selectpicker <?= ($validation->hasError('wakil')) ? 'is-invalid' : ''; ?>" id="wakil" name="wakil" data-live-search="true" data-size="5" required title="pilih wakil...">
                            <?php foreach ($user as $u) : ?>
                                <option value="<?= $u['nis']; ?>"><?= $u['nama_usr']; ?> (NIS: <?= $u['nis']; ?>)</option>
                            <?php endforeach; ?>
                        </select>
                        <input type="hidden" name="old_wakil" id="old_wakil" value="<?= $kandidat['wakil']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('wakil'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="nama_psg"><b>Nama Pasangan <span class="text-danger">*</span></b></label>
                        <input type="text" name="nama_psg" class="form-control <?= ($validation->hasError('nama_psg')) ? 'is-invalid' : ''; ?>" id="nama_psg" value="<?= $kandidat['nama_pasangan']; ?>" placeholder="nama pasangan (ex: CalonSIP)...">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama_psg'); ?>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="wakil"><b>Foto <span class="text-danger">*</span></b></label>
                        <input type="file" name="foto" class="form-control <?= ($validation->hasError('foto')) ? 'is-invalid' : ''; ?>" id="foto" accept=".jpg,.jpeg,.png,.gif" onchange="previewImg()">
                        <input type="hidden" name="old_foto" value="<?= $kandidat['foto']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('foto'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="nama_psg"><b>Visi <span class="text-danger">*</span></b></label>
                        <textarea class="form-control <?= ($validation->hasError('visi')) ? 'is-invalid' : ''; ?>" rows="5" name="visi" id="visi" placeholder="visi kandidat..."><?= $kandidat['visi']; ?></textarea>
                        <div class="invalid-feedback">
                            <?= $validation->getError('visi'); ?>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="nama_psg"><b>Misi <span class="text-danger">*</span></b></label>
                        <textarea class="form-control <?= ($validation->hasError('misi')) ? 'is-invalid' : ''; ?>" rows="5" name="misi" id="misi" placeholder="misi kandidat..."><?= $kandidat['misi']; ?></textarea>
                        <div class="invalid-feedback">
                            <?= $validation->getError('misi'); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="/kandidat" class="btn btn-danger">
                    <i class="fas fa-arrow-circle-left"></i>
                    Back
                </a>
                <button type="submit" class="btn btn-primary float-right" id="save-btn">
                    Save <i class="fas fa-save"></i>
                </button>
        </form>
    </div>
</div>
</div>
<?= $this->endSection(); ?>