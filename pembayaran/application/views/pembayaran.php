<body class="detail-b">

    <div class="container-fluid mt-3">
        <div class="card">
            <div class="card-body">
                <div class="card">
                    <div class="card-header alert alert-primary text-center">
                        <h4><b>Form Pembayaran</b></h4>
                    </div>
                    <div class="alert alert-secondary text-center">
                        <?php foreach ($saldo as $sal) : ?>
                            <h4><b>Saldo Rekening Anda : Rp. <?= number_format($sal->saldo); ?></b></h4>
                        <?php endforeach; ?>
                    </div>
                    <h6><?= $this->session->flashdata('message'); ?></h6>
                    <div class="card-body">
                        <form action="<?= base_url('pembayaran/bayar'); ?>" method="POST">
                            <div class="form-group">
                                <label for="">Nomor Virtual Account</label>
                                <input type="text" name="va" required class="form-control">
                            </div>
                            <!-- <div class="form-group">
                                <label for="">Nomor Rekening</label>
                                <input type="text" name="rekening" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Nominal Pembayaran</label>
                                <input type="number" name="bayar" class="form-control">
                                <span class="petunjuk small">* Masukan Nominal Sesuai Tagihan Anda</span>
                            </div> -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Masukan Pin</label>
                                        <input type="password" name="pin1" value="<?php echo set_value('pin1'); ?>" required class="form-control form-password"><br>
                                        <?php echo form_error('pin1', "<small class='text-danger pl-3'>", '</small>'); ?>
                                        <input type="checkbox" name="tampil_pwd" class="form-checkbox"> Tampilkan PIN
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Konfirmasi Pin</label>
                                        <input type="password" name="pin2" value="<?php echo set_value('pin2'); ?>" required class="form-control form-password">
                                        <?php echo form_error('pin2', "<small class='text-danger pl-3'>", '</small>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mt-4">
                                <button type="submit" class="btn btn-success form-control"><b><i class="fa fa-hand-o-right"></i> Selanjutnya</b></button>
                            </div>
                        </form>
                    </div>
                </div>
                <a href="<?= base_url('login/logout'); ?>" class="btn btn-danger mt-4"><i class="fa fa-sign-out"></i> Logout</a>
            </div>
        </div>
    </div>