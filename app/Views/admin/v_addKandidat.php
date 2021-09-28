<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?= $title; ?></h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <form action="/kandidat/save" method="post">
            <?= csrf_field(); ?>
            <div class="card-header bg-primary py-3">
                <h5 class="text-white font-weight-bold text-center">Form Tambah Data Kandidat</h5>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <small class="text-muted font-italic"><b>Keterangan: field yang bertanda <span class="text-danger">*</span> wajib diisi.</b></small>
                </div>
                <hr>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="ketua"><b>Ketua <span class="text-danger">*</span></b></label>
                        <select class="form-control selectpicker <?= ($validation->hasError('ketua')) ? 'is-invalid' : ''; ?>" id="ketua" name="ketua" data-live-search="true" title="pilih ketua..." autofocus>
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
                        <select class="form-control selectpicker <?= ($validation->hasError('wakil')) ? 'is-invalid' : ''; ?>" id="wakil" name="wakil" data-live-search="true" title="pilih wakil...">
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
                        <input type="file" name="foto" class="form-control" id="foto">
                    </div>
                </div>
                <div class="form-group">
                    <label for="nama_psg"><b>Visi <span class="text-danger">*</span></b></label>
                    <textarea class="form-control <?= ($validation->hasError('visi')) ? 'is-invalid' : ''; ?>" name="visi" id="visi"><?= old('visi'); ?></textarea>
                    <div class="invalid-feedback">
                        <?= $validation->getError('visi'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="nama_psg"><b>Misi <span class="text-danger">*</span></b></label>
                    <textarea class="form-control <?= ($validation->hasError('misi')) ? 'is-invalid' : ''; ?>" name="misi" id="misi"><?= old('misi'); ?></textarea>
                    <div class="invalid-feedback">
                        <?= $validation->getError('misi'); ?>
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