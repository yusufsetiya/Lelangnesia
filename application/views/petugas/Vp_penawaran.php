<div class="konten">
    <div class="container">
        <h2><i class="fa fa-money"></i> Penawaran</h1>
            <hr><br>
            <!-- <form action="<?= base_url('petugas/Cp_penawaran/pencarian'); ?>">
                <div class="col-md-3 col-sm-2 col-xs-2" align="center"><b>Status Lelang</b>
                    <hr>
                    <div class="row">
                        <div class="col-md-10">
                            <select class="dropdown-toggle form-control" name="status">
                                <div class="dropdown-menu">
                                    <option>Semua</option>
                                    <option value="dibuka">Dibuka</option>
                                    <option value="ditutup">Ditutup</option>
                                </div>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary">Cari</button>
                        </div>
                    </div>


                </div>
            </form><br> -->
            <div class="card">
                <div class="card-header alert alert-success">
                    <h5>Barang Tersedia</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="tb-pelelang">
                            <table class="table table-bordered table-striped text-center" id="penawaran">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>Nama Barang</th>
                                        <th>Gambar</th>
                                        <th>Status Barang</th>
                                        <th>Status Lelang</th>
                                        <th>Penawaran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($tawar as $twr) :
                                    ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $twr->nama_barang; ?></td>
                                            <td><img src="<?= base_url(); ?>upload/barang/<?= $twr->foto; ?>" width="100" alt="gambar"></td>
                                            <td>
                                                <?php if ($twr->status_barang == '2') { ?>
                                                    <p class="badge badge-pill badge-danger">Terjual</p>
                                                <?php } elseif ($twr->status_barang == '3') { ?>
                                                    <p class="badge badge-pill badge-warning">Pending Pembayaran</p>
                                                <?php } else { ?>
                                                    <p class="badge badge-pill badge-success">Tersedia</p>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <?php if ($twr->status == 'ditutup') { ?>
                                                    <p class="badge badge-pill badge-danger"> Ditutup</p>
                                                <?php } else { ?>
                                                    <p class="badge badge-pill badge-success"> Dibuka</p>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <a href="<?= base_url('petugas/Cp_penawaran/perbarang/' . $twr->id_lelang); ?>"><button class="btn btn-primary"> Lihat</button></a>
                                                <!-- <button class="btn btn-success"> Lihat</button> -->
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
                <div class="card-header alert alert-danger">
                    <h5>Barang Terjual</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">

                        <table class="table table-bordered table-striped text-center" id="terjual">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>Nama Barang</th>
                                    <th>Gambar</th>
                                    <th>Status Barang</th>
                                    <th>Status Lelang</th>
                                    <th>Penawaran</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($tselesai as $twr) :
                                ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $twr->nama_barang; ?></td>
                                        <td><img src="<?= base_url(); ?>upload/barang/<?= $twr->foto; ?>" width="100" alt="gambar"></td>
                                        <td>
                                            <?php if ($twr->status_barang == '2') { ?>
                                                <p class="badge badge-pill badge-danger">Terjual</p>
                                            <?php } elseif ($twr->status_barang == '3') { ?>
                                                <p class="badge badge-pill badge-warning">Pending Pembayaran</p>
                                            <?php } else { ?>
                                                <p class="badge badge-pill badge-success">Tersedia</p>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <?php if ($twr->status == 'ditutup') { ?>
                                                <p class="badge badge-pill badge-danger"> Ditutup</p>
                                            <?php } else { ?>
                                                <p class="badge badge-pill badge-success"> Dibuka</p>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <a href="<?= base_url('petugas/Cp_penawaran/perbarang/' . $twr->id_lelang); ?>"><button class="btn btn-primary"> Lihat</button></a>
                                            <!-- <button class="btn btn-success"> Lihat</button> -->
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