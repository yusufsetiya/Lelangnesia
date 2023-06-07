<body class="detail-b">
    <div class="detail">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="card">
                        <div class="card-header alert-warning">
                            <b>Perlu Pembayaran</b>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="tb-pelelang">
                                    <table class="table table-bordered text-center table-hover" id="p_bayar">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Barang</th>
                                                <th>Waktu Menang</th>
                                                <th>Jumlah Pembayaran</th>
                                                <th>Status Pembayaran</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            foreach ($perbayar as $pb) :
                                            ?>
                                                <tr>
                                                    <td><?= $no++; ?></td>
                                                    <td><?= $pb->nama_barang; ?></td>
                                                    <td><?= date('l, d-m-Y, H:i:s', strtotime($pb->waktu_menang)); ?></td>
                                                    <td>Rp. <?= number_format($pb->harga_akhir); ?></td>
                                                    <td>
                                                        <?php if ($pb->status_bayar == 'belum') { ?>
                                                            <p class="badge badge-pill badge-danger">Belum Dibayar</p>
                                                        <?php } else { ?>
                                                            <p class="badge badge-pill badge-success">Lunas</p>
                                                        <?php } ?>
                                                    </td>
                                                    <td>
                                                        <a href="<?= base_url('C_index/dtBayar/' . $pb->id_lelang); ?>"><button class="btn btn-info">Detail</button></a>
                                                    </td>

                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mt-5">
                        <div class="card-header alert-success">
                            <b> Pembayaran Berhasil</b>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="tb-pelelang">
                                    <table class="table table-bordered table-hover text-center" id="lunas">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Barang</th>
                                                <th>Waktu Menang</th>
                                                <th>Jumlah Pembayaran</th>
                                                <th>Status Pembayaran</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            foreach ($sukses as $lunas) : ?>
                                                <tr>
                                                    <td><?= $no++; ?></td>
                                                    <td><?= $lunas->nama_barang; ?></td>
                                                    <td><?= date('l, d-m-Y, H:i:s', strtotime($lunas->waktu_menang)); ?></td>
                                                    <td>Rp. <?= number_format($lunas->harga_akhir); ?></td>
                                                    <td>
                                                        <?php if ($lunas->status_bayar == 'sudah') { ?>
                                                            <p class="badge badge-pill badge-success">Berhasil</p>
                                                        <?php } else { ?>
                                                            <p class="badge badge-pill badge-danger">Belum Dibayar</p>
                                                        <?php } ?>
                                                    </td>
                                                    <td>
                                                        <a href="<?= base_url('C_index/dtBayarsc/' . $lunas->id_lelang); ?>"><button class="btn btn-info">Detail</button></a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="bayar" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Pembayaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="">
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
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success">Bayar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- modal detail -->
    <div class="modal fade" id="detail" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Pembayaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="">
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
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success">Bayar</button>
                </div>
            </div>
        </div>
    </div>