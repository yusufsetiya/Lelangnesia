<body class="detail-b">

    <div class="container-fluid mt-3">
        <div class="card">
            <div class="card-body">
                <div class="card">
                    <div class="card-header alert alert-warning text-center">
                        <h5><b>Detail Transfer</b></h5>
                    </div>
                    <h6><?= $this->session->flashdata('message'); ?></h6>
                    <?php foreach ($detail as $dtl) : ?>
                        <div class="card-body">
                            <div class="card">
                                <div class="card-body ">
                                    <div class="form-group row ">
                                        <label for="inputPassword" class="col-sm-3 col-form-label ss">
                                            <div class=""><b>Username Merchant</b><span class="text-danger">*</span></div>
                                        </label>
                                        <div class="col-sm-8">
                                            <p><?= $dtl->username; ?></p>
                                            <!-- <input type="text" class="form-control" id="inputPassword" value="yusuf8888"> -->
                                        </div>
                                    </div>
                                    <div class="form-group row ">
                                        <label for="inputPassword" class="col-sm-3 col-form-label ss">
                                            <div class=""><b>Saldo Anda</b> <span class="text-danger">*</span></div>
                                        </label>
                                        <div class="col-sm-8">
                                            <p><b>Rp. <?= number_format($dtl->saldo); ?></b></p>
                                            <!-- <input type="text" class="form-control" id="inputPassword" value="12.000.000"> -->
                                        </div>
                                    </div>
                                    <div class="form-group row ">
                                        <label for="inputPassword" class="col-sm-3 col-form-label ss">
                                            <div class=""><b>Jumlah Transfer</b> <span class="text-danger">*</span></div>
                                        </label>
                                        <div class="col-sm-8">
                                            <p><b>Rp. <?= number_format($dtl->jumlah); ?></b></p>
                                            <!-- <input type="text" class="form-control" id="inputPassword" value="12.000.000"> -->
                                        </div>
                                    </div>
                                    <div class="form-group row ">
                                        <label for="inputPassword" class="col-sm-3 col-form-label ss">
                                            <div class=""><b>Nomor Rekening </b><span class="text-danger">*</span></div>
                                        </label>
                                        <div class="col-sm-8">
                                            <p><?= $dtl->rekening_p; ?></p>
                                            <!-- <input type="text" class="form-control" id="inputPassword" value="674839564738"> -->
                                        </div>
                                    </div>
                                    <div class="form-group row ">
                                        <label for="inputPassword" class="col-sm-3 col-form-label ss">
                                            <div class=""><b>Nomor VA </b><span class="text-danger">*</span></div>
                                        </label>
                                        <div class="col-sm-8">
                                            <p><?= $dtl->va; ?></p>
                                            <!-- <input type="text" class="form-control" id="inputPassword" value="88374653759"> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="container-fluid">

                                    <div class="alert alert-success">
                                        <h6>Nb. Pembayaran Senilai <b>Rp. <?= number_format($dtl->jumlah); ?></b> Akan dipotong dari saldo Rekening anda</h6>
                                    </div>
                                </div>
                            </div>
                            <form action="<?= base_url('pembayaran/selesai'); ?>" method="POST">
                                <input type="hidden" name="rekening" value="<?= $dtl->rekening_p; ?>">
                                <input type="hidden" name="id" value="<?= $dtl->id_bayar; ?>">
                                <input type="hidden" name="id_barang" value="<?= $dtl->id_barang; ?>">
                                <input type="hidden" name="jumlah" value="<?= $dtl->jumlah; ?>">
                                <div class="form-group mt-4">
                                    <button type="submit" class="btn btn-primary form-control"><i class="fa fa-check-circle-o"></i> Transfer</button>
                                </div>
                            </form>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>