<div class="main-panel">
    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-secondary">
                            <div class="card-title text-white text-center">Detail Data Siswa </div>
                        </div>
                        <div class="card-body row mt-3">
                            <div class="col-lg-5 col-md-6 col-12">
                                <div class="form-group">
                                    <label for="nama">Nama Lengkap</label>
                                    <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukkan Nama Lengkap" value="<?= $user['nama']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="nis">NIS</label>
                                    <input type="text" name="nis" class="form-control" id="nis" placeholder="Masukkan NIS" value="<?= $user['nip']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="jk">Jenis Kelamin</label>
                                    <input type="text" name="jk" class="form-control" id="jk" placeholder="Masukkan Jenis Kelamin" value="<?= $user['email']; ?>">
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-6 col-12">
                                <div class="form-group">
                                    <label for="kelas">Kelas</label>
                                    <input type="text" name="kelas" class="form-control" id="kelas" placeholder="Masukkan Nomor Telepon" value="<?= $user['nohp']; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4 mr-3">
                            <div class="col-md">
                                <a href="<?php echo base_url('/user') ?>" class="btn btn-primary mr-1 float-right"><i class="fas fa-angle-left"></i>&nbsp;&nbsp;Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>