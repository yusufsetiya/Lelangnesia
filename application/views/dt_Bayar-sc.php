<body class="detail-b">

    <div class="container-fluid detail">
        <div class="card">
            <div class="card-body">
                <div class="card-body">
                    <h5 class="text-center"><b>Detail Pembelian Barang</b></h5>
                    <hr><br>
                    <?php foreach ($dtSukses as $lunas) : ?>
                        <div class="row">
                            <div class="col-md-4">
                                <img src="<?= base_url(); ?>upload/barang/<?= $lunas->foto; ?>" class="img-thumbnail" alt="gambar">
                            </div>
                            <div class="col-md-8">
                                <div class="table-responsive">
                                    <table class="table table-borderedless">
                                        <tr>
                                            <th>Waktu Bayar</th>
                                            <td>:</td>
                                            <td><?= date('l, d-m-Y, H:i:s', strtotime($lunas->waktu_bayar)); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Nama Pemenang</th>
                                            <td>:</td>
                                            <td> <?= $lunas->nama_lengkap; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Harga Awal</th>
                                            <td>:</td>
                                            <td>Rp. <?= number_format($lunas->harga_awal); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Harga Jadi</th>
                                            <td>:</td>
                                            <td><b>Rp. <?= number_format($lunas->harga_akhir); ?></b></td>
                                        </tr>
                                        <tr>
                                            <th class="text-danger">Nomor Virtual Account</th>
                                            <td>:</td>
                                            <td><b><?= $lunas->va; ?></b></td>
                                        </tr>
                                        <tr>
                                            <th class="text-danger">Rekening</th>
                                            <td>:</td>
                                            <td><b><?= $lunas->rekening; ?></b></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div><br>
                        <div class="alert alert-warning text-center">
                            <h7><b>Pembayaran Senilai : Rp. <?= number_format($lunas->harga_akhir); ?> </b>
                            </h7>

                            <div class="row mt-3">
                                <div class="col-md-4">

                                </div>
                                <div class="col-md-4">
                                    <p class="text-white bg-success rounded-pill text-center"><b>Berhasil</b></p>
                                </div>
                                <div class="col-md-4">

                                </div>
                            </div>
                        </div>
                </div>
                <a class="wafixed" href=" https://api.whatsapp.com/send?phone=62<?= $lunas->telepon; ?>&text=Saya%20Perlu%20Bantuan%20Untuk" target="_blank">
                    <span class="text-dark rounded"><b>Customer Service</b></span>
                    <span class="fa-stack fa-lg">
                        <i class="fa fa-circle fa-stack-2x text-success"></i>
                        <i class="fa fa-whatsapp fa-stack-1x fa-inverse"></i>
                    </span>
                </a>
            </div>
        <?php endforeach; ?>
        </div>