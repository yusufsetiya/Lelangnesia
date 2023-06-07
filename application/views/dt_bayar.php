<body class="detail-b">

    <div class="container-fluid detail">
        <div class="card">
            <div class="card-body">
                <div class="alert alert-warning">

                    <p>Mohon Untuk menyelesaikan Pembayaran Paling lama <b>5 hari</b> Setelah tanggal barang ini dimenangkan.</p>
                </div><br>
                <div class="card">
                    <div class="card-header">
                        Detail Barang
                    </div>
                    <div class="card-body">
                        <?php foreach ($dtBayar as $db) : ?>
                            <div class="row">
                                <div class="col-md-4">
                                    <img src="<?= base_url(); ?>upload/barang/<?= $db->foto; ?>" class="img-thumbnail" alt="gambar">
                                </div>
                                <div class="col-md-8">
                                    <div class="table-responsive">

                                        <table class="table table-borderedless">
                                            <tr>
                                                <th>Waktu Menang</th>
                                                <td>:</td>
                                                <td><?= date('l, d-m-Y, H:i:s', strtotime($db->waktu_menang)); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Nama Pemenang</th>
                                                <td>:</td>
                                                <td> <?= $db->nama_lengkap; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Harga Awal</th>
                                                <td>:</td>
                                                <td>Rp.<?= number_format($db->harga_awal); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Harga Jadi</th>
                                                <td>:</td>
                                                <td><b>Rp. <?= number_format($db->harga_akhir); ?></b></td>
                                            </tr>
                                            <tr>
                                                <th>Batas Pembayaran</th>
                                                <td>:</td>
                                                <td><b>Tanggal : <?= date('l, d-m-Y', strtotime($db->batas_bayar));  ?></b></td>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <th></th>
                                                <td><b>Jam : <?= date('H:i:s', strtotime($db->batas_bayar));  ?></b></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div><br>
                            <div class="alert alert-danger text-center">
                                <h7><b>Jumlah Yang Harus Dibayar : Rp. <?= number_format($db->harga_akhir); ?></b></h7>
                                <button class="btn btn-success ml-3" data-toggle="modal" data-target="#bayar<?= $db->id_lelang; ?>">Pembayaran</button>
                            </div>
                    </div>
                </div>

                <!-- <div class="card mt-2">
                    <div class="card-header text-center bg-success text-white">
                        <b>Panduan Pembayaran</b>
                    </div>
                    <div class="card-body alert alert-success text-dark">
                        <span>Silahkan Melakukan Transfer Pembayaran pada nomor rekening yang sudah disediakan</span><br>
                        <p>Nomor Rekening Pembayaran :</p>
                        <p><b>BRI</b> : 78263784916</p>
                        <p><b>BCA</b> : 78263784916</p>
                        <p><b>BNI</b> : 78263784916</p>
                        <b>Pastikan Nomor rekening tujuan atas nama : Lelang Online</b>

                    </div>
                </div> -->

            </div>
        </div>

        <a class="wafixed" href=" https://api.whatsapp.com/send?phone=62<?= $db->telepon; ?>&text=Saya%20Perlu%20Bantuan%20Untuk" target="_blank">
            <span class="text-dark rounded"><b>Customer Service</b></span>
            <span class="fa-stack fa-lg">
                <i class="fa fa-circle fa-stack-2x text-success"></i>
                <i class="fa fa-whatsapp fa-stack-1x fa-inverse"></i>
            </span></a>
    <?php endforeach; ?>
    </div>

    <!-- modal detail -->
    <?php foreach ($dtBayar as $va) : ?>
        <div class="modal fade" id="bayar<?= $va->id_lelang; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Pembayaran</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                            <h4 class="text-danger"><b>Nomor Virtual Account</b></h4>

                            <h5><b><?= $va->va; ?></b></h5>
                        </div><br>
                        <div class="card mt-2">
                            <div class="card-body alert alert-success text-dark">
                                <p>Silahkan Melakukan Pembayaran Dengan Nomor Virtual Account yang sudah diberikan di atas. </p>
                            </div>
                        </div>
                        <!-- <form action="">
                        <div class="form-group">
                            <label for="">Alamat Lengkap Pengiriman</label>
                            <textarea name="" id="" cols="30" rows="4" class="form-control"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Kota</label>
                                    <input type="text" name="nama_barang" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Kode Pos</label>
                                    <input type="text" class="form-control" name="time">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Bukti Transfer</label>
                            <input type="file" name="harga" class="form-control">
                        </div>
                        <div class="alert alert-warning teks">
                            <p><b>Nb.</b> Konfirmasi Pembayaran Akan Diproses paling lama 1 x 24 jam, pastikan Cek status pembayaran secara berkala</p>
                        </div>
                    </form> -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>