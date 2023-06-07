<body class="detail-b">

    <div class="container detail">
        <div class="card">
            <div class="card-body">
                <?php foreach ($detail as $dt) : ?>
                    <div class="row">
                        <div class="col-md-5">
                            <img id="detail-img" src="<?= base_url(); ?>upload/barang/<?= $dt->foto; ?>" alt="gambar" class="img-fluid" width="600">
                        </div>
                        <div class="col-md-7">
                            <div class="title">
                                <h2><?= $dt->nama_barang; ?></h2>
                                <hr>
                            </div>
                            <div class="">
                                <H6><b>Harga Awal :</b></H6>
                                <h4 class="text-success">
                                    Rp. <?= number_format($dt->harga_awal); ?>
                                </h4>
                            </div><br>
                            <div class="subtitle">
                                <h6><b>Deskripsi :</b></h6>
                                <p>
                                    <?= nl2br($dt->deskripsi_barang); ?>
                                </p>
                            </div>
                            <div class="text-center">
                                <table class="table table-bordered">
                                    <th class="alert-success">
                                        <h4><b>Batas Penawaran :</b> <b class="text-danger" id="hitung-mundur"></b></h4>
                                    </th>
                                </table>
                                <input id="countdown" type="hidden" value="<?= $dt->batas; ?>">
                                <!-- <h5 class="text-danger"><b id="getting-started"></b></h5> -->
                            </div><br>
                        </div>
                    </div>
                    <h6><?= $this->session->flashdata('message'); ?></h6>
                    <div class="card card-lg">
                        <div class="card-header text-center">
                            Kirim Penawaran
                        </div>
                        <div class="card-body">
                            <div class="card">
                                <div class="card-body">
                                    <?php if ($tinggi == null) { ?>
                                        <p>Minimal Awal Penawaran <b>Rp. <?= number_format($dt->harga_awal); ?></b></p>
                                    <?php } else { ?>
                                        <p>Nominal Pelelang Tertinggi <b>Rp. <?= number_format($tinggi); ?></b></p>
                                    <?php } ?>
                                    <form action="<?= base_url('C_index/tawar/' . $dt->id_barang); ?>" method="POST">
                                        <div class="form-group">
                                            <input type="hidden" name="id_lelang" value="<?= $dt->id_lelang; ?>">
                                            <input type="hidden" name="id_barang" value="<?= $dt->id_barang; ?>">
                                            <?php if ($tinggi == null) { ?>
                                                <input type="number" class="form-control" min="<?= $dt->harga_awal + 100000 ?>" name="penawaran" autocomplete="off">
                                            <?php } else { ?>
                                                <input type="number" class="form-control" min="<?= $tinggi + 100000 ?>" name="penawaran" autocomplete="off">
                                            <?php } ?>
                                        </div>
                                        <div class="form-group">
                                        <?php endforeach; ?>
                                        <?php if ($this->session->userdata('id_masyarakat')) { ?>
                                            <?php if ($disable == !NULL) { ?>
                                                <button disabled="disabled" class="btn btn-primary w-100">Kirim Penawaran</button>
                                                <div class="alert alert-danger mt-3">
                                                    Mohon Maaf Anda Tidak dapat mengikuti lelang jika belum melakukan <b>Pembayaran</b> Barang Yang dimenangkan
                                                </div>
                                            <?php } else { ?>
                                                <?php if ($profile->verif == '2') { ?>
                                                    <button id="penawaran" type="submit" class="btn btn-primary w-100">Kirim Penawaran</button>
                                                    <div id="peringatan-lelang" class="alert alert-danger mt-3">
                                                        Waktu Lelang Telah Habis
                                                    </div>
                                                <?php } elseif ($profile->verif == '1') { ?>
                                                    <button disabled="disabled" class="btn btn-primary w-100">Kirim Penawaran</button>
                                                    <div class="alert alert-danger mt-3">
                                                        Mohon Maaf akun Anda <b>Belum Terverifikasi</b> oleh admin, harap Tunggu Maksimal 1 x 24 jam.
                                                    </div>
                                                <?php } elseif ($profile->verif == '3') { ?>
                                                    <button disabled="disabled" class="btn btn-primary w-100">Kirim Penawaran</button>
                                                    <div class="alert alert-danger mt-3">
                                                        Mohon Maaf akun Anda <b>Terblokir</b>
                                                    </div>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <button disabled="disabled" class="btn btn-primary w-100">Kirim Penawaran</button>
                                        <?php } ?>
                                        </div>

                                    </form>

                                </div>
                            </div>

                        </div>

                        <div class="card-bodyl">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="text-center">Pelelang Barang</h4>
                                    <hr>
                                    <div class="tb-pelelang">
                                        <table class="table table-bordered text-center" id="tawaran">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Username</th>
                                                    <th>Tanggal Lelang</th>
                                                    <th>Penawaran</th>
                                                    <th>Rank</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                foreach ($tawar as $twr) : ?>
                                                    <tr>
                                                        <td><?= $no++; ?></td>
                                                        <td><?= $twr->username; ?></td>
                                                        <td><?= date('d-m-Y', strtotime($twr->tgl_lelang)); ?></td>
                                                        <td>Rp. <?= number_format($twr->penawaran_harga); ?></td>
                                                        <?php if ($twr->penawaran_harga == $tinggi) { ?>
                                                            <td>
                                                                <p class="badge badge-pill badge-success">Tertinggi</p>
                                                            </td>
                                                        <?php } else { ?>
                                                            <td>-</td>
                                                        <?php } ?>
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