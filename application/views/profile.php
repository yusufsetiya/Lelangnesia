<body class="detail-b">
    <div class="detail">
        <div class="container-fluid ">
            <!-- <h4 class="perofil">Profil Akun Anda : Toni</h4><br> -->
            <div class="bg-white"><br>
                <div class="container-fluid">
                    <h3> Detail Akun Anda</h3>
                    <hr>
                    <div class="row">
                        <div class="col-md-7  mb-4">
                            <div class="card">
                                <div class="card-header bg-success text-white">
                                    <h5>Profil Anda</h5>
                                    <!-- <h5 class=" text-white text-center">Profil Anda</h5> -->
                                </div>

                                <div class="card-body">
                                    <form action="<?= base_url('C_profile/update'); ?>" method="POST">
                                        <?php foreach ($profile as $row) : ?>
                                            <input type="hidden" name="id" value="<?= $row->id_user ?>">
                                            <div class="text-center">
                                                <img src="<?= base_url(); ?>upload/profile/<?= $row->wajah ?>" alt="gambar" width="200" height="200" class="rounded-circle">
                                            </div><br>
                                            <div class="form-group row ">
                                                <label for="inputPassword" class="col-sm-3 col-form-label ss">
                                                    <div class="style">Username <span class="text-danger">*</span></div>
                                                </label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="username" value="<?= $row->username ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputPassword" class="col-sm-3 col-form-label">
                                                    <div class="style">Nama <span class="text-danger">*</span></div>
                                                </label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" readonly value="<?= $row->nama_lengkap ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row" id="only-number">
                                                <label for="inputPassword" class="col-sm-3 col-form-label">
                                                    <div class="style">Telepon <span class="text-danger">*</span></div>
                                                </label>
                                                <div class="col-sm-8">
                                                    <input type="tel" id="telepons" class="form-control" name="telepon" value="<?= $row->telp ?>">
                                                    <span class="small text-dark"><b>Nb.</b> Nomor Telepon Tidak Boleh Lebih Dari 12 Digit</span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="staticEmail" class="col-sm-3 col-form-label">
                                                    <div class="style">Status Akun <span class="text-danger">*</span></div>
                                                </label>
                                                <?php if ($row->verif == '2') { ?>
                                                    <div class="col-sm-3">
                                                        <p class="text-white bg-success rounded-pill text-center">Terverifikasi</p>
                                                    </div>
                                                <?php } elseif ($row->verif == '1') { ?>
                                                    <div class="col-sm-4">
                                                        <p class="text-white bg-warning rounded-pill text-center">Belum Terverifikasi</p>
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="col-sm-4">
                                                        <p class="text-white bg-danger rounded-pill text-center">Terblokir</p>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <?php if ($row->verif == '3') { ?>
                                                <div class="alert alert-danger">
                                                    <h6><b>Nb. </b> <?= $row->alasan; ?></h6>
                                                </div>
                                            <?php } ?>
                                            <h6><?= $this->session->flashdata('message'); ?></h6>
                                            <div class="form-group">
                                                <button id="simpan" type="submit" class="btn btn-success" data-toggle="modal" data-target="#edit">
                                                    <i class="fa fa-edit"></i> Simpan
                                                </button>
                                    </form>
                                <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-header bg-success text-white">
                                <h5>Ganti Password</h5>
                            </div>
                            <div class="card-body">
                                <form action="<?= base_url('C_profile/ubah_pwd'); ?>" method="POST">
                                    <!-- <div class="form-group row">
                                        <label for="" class="col-sm-4 ">
                                            <div class="style">Password Lama</div>
                                        </label>
                                        <div class="col-sm-7">
                                            <input type="password" name="old" class="form-control form-password" id="inputPassword">
                                        </div>
                                    </div> -->
                                    <div class="form-group row">
                                        <label for="inputPassword" class="col-sm-4 col-form-label">
                                            <div class="style">Password Baru</div>
                                        </label>
                                        <div class="col-sm-7">
                                            <input type="password" name="new" class="form-control form-password" id="inputPassword">
                                            <?php echo form_error('new', "<small class='text-danger pl-3'>", '</small>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPassword" class="col-sm-4 col-form-label ">
                                            <div class="style">Konfirmasi Password Baru</div>
                                        </label>
                                        <div class="col-sm-7">
                                            <input type="password" name="re_new" class="form-control form-password" id="inputPassword">
                                            <?php echo form_error('re_new', "<small class='text-danger pl-3'>", '</small>'); ?><br>
                                            <input type="checkbox" name="tampil_pwd" class="form-checkbox"> Tampil Password
                                        </div>
                                    </div>
                                    <!-- <div class="form-group">
                                        <label for="">Password Lama</label>
                                        <input type="password" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Password Baru</label>
                                        <input type="password" class="form-control">
                                    </div> -->

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success"><i class="fa fa-edit"></i> Ubah Password</button>
                                    </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    </div>