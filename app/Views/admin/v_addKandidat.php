<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?= $title; ?></h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <form action="/kandidat/save" enctype="multipart/form-data" method="post">
            <?= csrf_field(); ?>
            <div class="card-header bg-primary py-3">
                <h5 class="text-white font-weight-bold text-center">Form Tambah Data Kandidat</h5>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <small class="text-muted font-italic"><b>Keterangan: field yang bertanda <span class="text-danger">*</span> wajib diisi.</b></small>
                </div>
                <hr>
                <div class="text-center mb-4">
                    <h3 class="font-weight-bold">Foto Kandidat</h3>
                    <img class="img img-responsive img-resize img-preview" src="/assets/img/fotokandidat/default.jpg" class="mt-2" alt="foto kandidat" width="200px">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="ketua"><b>Ketua <span class="text-danger">*</span></b></label>
                        <select class="form-control selectpicker <?= ($validation->hasError('ketua')) ? 'is-invalid' : ''; ?>" id="ketua" name="ketua" data-live-search="true" data-size="5" title="pilih ketua..." autofocus>
                            <?php foreach ($user as $u) : ?>
                                <option value="<?= $u['nis']; ?> <?= old('ketua'); ?>"><?= $u['nama_usr']; ?> (NIS: <?= $u['nis']; ?>)</option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('ketua'); ?>
                        </div>
                        <!-- <small class="text-danger" id="alert_ketua"></small> -->
                        <!-- <input type="text" name="ketua" id="hide_ketua" hidden> -->
                    </div>
                    <div class="form-group col-md-6">
                        <label for="wakil"><b>Wakil <span class="text-danger">*</span></b></label>
                        <select class="form-control selectpicker <?= ($validation->hasError('wakil')) ? 'is-invalid' : ''; ?>" id="wakil" name="wakil" data-live-search="true" data-size="5" title="pilih wakil...">
                            <?php foreach ($user as $u) : ?>
                                <option value="<?= $u['nis']; ?> <?= old('wakil'); ?>"><?= $u['nama_usr']; ?> (NIS: <?= $u['nis']; ?>)</option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('wakil'); ?>
                        </div>
                        <!-- <small class="text-danger" id="alert_wakil"></small> -->
                        <!-- <input type="text" name="wakil" id="hide_wakil" hidden> -->
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="nama_psg"><b>Nama Pasangan <span class="text-danger">*</span></b></label>
                        <input type="text" name="nama_psg" class="form-control <?= ($validation->hasError('nama_psg')) ? 'is-invalid' : ''; ?>" id="nama_psg" value="<?= old('nama_psg'); ?>" placeholder="nama pasangan (ex: CalonSIP)...">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama_psg'); ?>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="wakil"><b>Foto <span class="text-danger">*</span></b></label>
                        <input type="file" name="foto" class="form-control <?= ($validation->hasError('foto')) ? 'is-invalid' : ''; ?>" id="foto" accept=".jpg,.jpeg,.png,.gif" onchange="previewImg()">
                        <div class="invalid-feedback">
                            <?= $validation->getError('foto'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="visi"><b>Visi <span class="text-danger">*</span></b></label>
                        <textarea class="form-control <?= ($validation->hasError('visi')) ? 'is-invalid' : ''; ?>" rows="5" name="visi" id="visi" placeholder="visi kandidat..."><?= old('visi'); ?></textarea>
                        <div class="invalid-feedback">
                            <?= $validation->getError('visi'); ?>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="misi"><b>Misi <span class="text-danger">*</span></b></label>
                        <textarea class="form-control <?= ($validation->hasError('misi')) ? 'is-invalid' : ''; ?>" rows="5" name="misi" id="misi" placeholder="misi kandidat..."><?= old('misi'); ?></textarea>
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