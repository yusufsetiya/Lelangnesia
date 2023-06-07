<div class="konten">
    <div class="container">
        <h2>Dashboard</h2>
        <hr>
        <br>
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah barang</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $barang; ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-box fa-2x text-gray-300"><i class="fa fa-shopping-bag"></i></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Barang Dilelang</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $dilelang; ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-box fa-2x text-gray-300"><i class="fa fa-play"></i></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Menunggu Pembayaran</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $bayar; ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-box fa-2x text-gray-300"><i class="fa fa-shopping-cart"></i></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row mt-4">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header alert-secondary">
                        <b>Nomor WhatsApp</b>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label for="">
                                <b>Nomor WhatsApp Anda</b>
                            </label>
                            <?php if ($telepon == !NULL) { ?>
                                <div class="alert alert-success">
                                    <h5><b>+62 <?= $telepon; ?></b></h5>
                                </div>
                                <form action="<?= base_url('petugas/Cp_dashboard/nomor'); ?>" method="POST">
                                    <div class="form-group">
                                        <div class="input-group mb-3" id="only-number">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><b>+62</b></span>
                                            </div>
                                            <input id="telepons" type="text" name="nomor" class="form-control" value="<?= $telepon; ?>" required autocomplete="off">
                                        </div>

                                    </div>
                                    <button id="simpan" type="submit" class="btn btn-danger">Ubah Nomor</button>
                                </form>
                        </div>
                    <?php } else { ?>
                        <form action="<?= base_url('petugas/Cp_dashboard/nomor'); ?>" method="POST">
                            <div class="form-group">
                                <div class="input-group mb-3" id="only-number">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><b>+62</b></span>
                                    </div>
                                    <input id="telepons" type="text" name="nomor" class="form-control" placeholder="Tanpa Awalan 0" required autocomplete="off">
                                </div>
                                <span class="small text-dark"><b>Nb.</b> Nomor Tidak Boleh Melebihi 12 Digit</span>
                                <div class="alert alert-danger mt-3">
                                    <p><b>Nomor WhatsApp Anda Belum Disetel</b></p>
                                </div>
                                <button id="simpan" type="submit" class="btn btn-primary">Simpan Nomor</button>
                            <?php } ?>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6">

            </div>
        </div>


    </div>
</div>