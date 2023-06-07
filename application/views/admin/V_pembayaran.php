<div class="konten">
    <div class="container">
        <h2> <i class="fa fa-money"></i> Pembayaran</h2>
        <hr><br>

        <div class="card">
            <div class="card-header alert alert-primary">
                <h6><b>Perlu Pembayaran</b></h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div class="tb-pelelang">
                        <table class="table table-bordered table-striped text-center" id="p_bayar">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>Username</th>
                                    <th>Tagihan</th>
                                    <th>Waktu Pembayaran</th>
                                    <th>Status</th>
                                    <th>Batas Waktu</th>
                                    <th>Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($bayar as $byr) :
                                ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $byr->username; ?></td>
                                        <!-- <td>Laptop Asus</td> -->
                                        <td class="text-danger">Rp. <?= number_format($byr->harga_akhir); ?></td>

                                        <?php if ($byr->waktu_bayar == null) { ?>
                                            <td>-</td>
                                        <?php } else { ?>
                                            <td><?= date('l, d-m-Y, H:i:s', strtotime($byr->waktu_bayar)); ?></td>
                                        <?php } ?>

                                        <td>
                                            <?php if ($byr->status_bayar == 'belum') { ?>
                                                <p class="badge badge-danger">Belum</p>
                                            <?php } else { ?>
                                                <p class="badge badge-success">Lunas</p>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <?php if ($byr->batas_bayar <= $waktu) { ?>
                                                <p><b>Melebihi Batas Waktu</b></p>
                                                <form action="<?= base_url('C_pembayaran/batal_menang'); ?>" method="POST">
                                                    <input type="hidden" name="id" value="<?= $byr->id_barang; ?>">
                                                    <button type="submit" class="btn btn-danger">
                                                        Batalkan Menang
                                                    </button>
                                                </form>
                                            <?php } else { ?>
                                                -
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <button class="btn btn-primary" data-toggle="modal" data-target="#detail<?= $byr->id_bayar; ?>">
                                                <i class="fa fa-eye"></i>
                                            </button>
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
            <div class="card-header alert alert-success">
                <h6><b>Pembayaran Lunas</b></h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div class="tb-pelelang">
                        <table class="table table-bordered table-striped text-center" id="lunas">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>Username</th>
                                    <th>Tagihan</th>
                                    <th>Waktu Pembayaran</th>
                                    <th>Status</th>
                                    <th>Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($lunas as $byr) :
                                ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $byr->username; ?></td>
                                        <!-- <td>Laptop Asus</td> -->
                                        <td class="text-danger">Rp. <?= number_format($byr->harga_akhir); ?></td>
                                        <td><?= date('l, d-m-Y, H:i:s', strtotime($byr->waktu_bayar)); ?></td>
                                        <td>
                                            <?php if ($byr->status_bayar == 'belum') { ?>
                                                <p class="badge badge-danger">Belum</p>
                                            <?php } else { ?>
                                                <p class="badge badge-success">Lunas</p>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <button class="btn btn-primary" data-toggle="modal" data-target="#detail<?= $byr->id_bayar; ?>">
                                                <i class="fa fa-eye"></i>
                                            </button>
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

<!-- Modal detail -->
<?php foreach ($bayar as $dtl) : ?>
    <div class="modal fade" id="detail<?= $dtl->id_bayar; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Detail Pembayaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <!-- <div class="card">
                                <div class="card-body"> -->
                                <h6 class="text-center"><b><?= $dtl->nama_barang; ?></b></h6>
                                <hr>
                                <img src="<?= base_url(); ?>upload/barang/<?= $dtl->foto; ?>" class="img-thumbnail" alt="gambar">
                                <!-- </div>
                            </div> -->

                            </div>
                            <div class="col-md-8">
                                <table class="table table-striped">
                                    <tr>
                                        <th>Username</th>
                                        <td>:</td>
                                        <td> <?= $dtl->username; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Virtual Account</th>
                                        <td>:</td>
                                        <td><b><?= $dtl->va; ?></b></td>
                                    </tr>
                                    <tr>
                                        <th>Rekening Pelanggan</th>
                                        <td>:</td>
                                        <td><b><?= $dtl->rekening; ?></b></td>
                                    </tr>
                                    <tr>
                                        <th>Tagihan</th>
                                        <td>:</td>
                                        <td class="text-danger">Rp. <?= number_format($dtl->harga_akhir); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Waktu Pembayaran</th>
                                        <td>:</td>
                                        <?php if ($dtl->waktu_bayar == null) { ?>
                                            <td>-</td>
                                        <?php } else { ?>
                                            <td><?= date('l, d-m-Y, H:i:s', strtotime($dtl->waktu_bayar)); ?></td>
                                        <?php } ?>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>:</td>
                                        <td>
                                            <?php if ($dtl->status_bayar == 'belum') { ?>
                                                <p class="text-white bg-danger rounded-pill text-center">Belum Dibayar</p>
                                            <?php } else { ?>
                                                <p class="text-white bg-success rounded-pill text-center">Lunas</p>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php endforeach; ?>

<?php foreach ($lunas as $dtl) : ?>
    <div class="modal fade" id="detail<?= $dtl->id_bayar; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Detail Pembayaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <!-- <div class="card">
                                <div class="card-body"> -->
                                <h6 class="text-center"><b><?= $dtl->nama_barang; ?></b></h6>
                                <hr>
                                <img src="<?= base_url(); ?>upload/barang/<?= $dtl->foto; ?>" class="img-thumbnail" alt="gambar">
                                <!-- </div>
                            </div> -->

                            </div>
                            <div class="col-md-8">
                                <table class="table table-striped">
                                    <tr>
                                        <th>Username</th>
                                        <td>:</td>
                                        <td> <?= $dtl->username; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Virtual Account</th>
                                        <td>:</td>
                                        <td><b><?= $dtl->va; ?></b></td>
                                    </tr>
                                    <tr>
                                        <th>Rekening Pelanggan</th>
                                        <td>:</td>
                                        <td><b><?= $dtl->rekening; ?></b></td>
                                    </tr>
                                    <tr>
                                        <th>Tagihan</th>
                                        <td>:</td>
                                        <td class="text-danger">Rp. <?= number_format($dtl->harga_akhir); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Waktu Pembayaran</th>
                                        <td>:</td>
                                        <?php if ($dtl->waktu_bayar == NULL) { ?>
                                            <td>-</td>
                                        <?php } else { ?>
                                            <td><?= date('l, d-m-Y, H:i:s', strtotime($dtl->waktu_bayar)); ?></td>
                                        <?php } ?>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>:</td>
                                        <td>
                                            <?php if ($dtl->status_bayar == 'belum') { ?>
                                                <p class="text-white bg-danger rounded-pill text-center">Belum Dibayar</p>
                                            <?php } else { ?>
                                                <p class="text-white bg-success rounded-pill text-center">Lunas</p>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php endforeach; ?>