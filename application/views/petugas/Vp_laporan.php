<div class="konten">
    <div class="container">
        <h2><i class="fa fa-book"></i> Laporan</h1>
            <hr><br>
            <div class="card text-center">
                <div class="card-header bg-danger">
                    <h5 class="text-white">Filter Tanggal</h5>
                </div>
                <div class="card-body">
                    <?php
                    $today = date("Y-m-d");
                    $yesterday = date("Y-m-d", strtotime("-1 days"));
                    ?>
                    <form method="get">
                        <div class="row">
                            <div class="col-md-5">
                                <label>Tanggal Mulai</label>
                                <input type="date" class="form-control" name="startdate" value="<?= $yesterday; ?>">
                            </div>
                            <div class="col-md-5">
                                <label>Tanggal Selesai</label>
                                <input type="date" class="form-control" name="enddate" value="<?= $today; ?>">
                            </div>
                            <div class="col-md-2">
                                <label>&nbsp;</label><br>
                                <button type="submit" class="btn btn-primary">Lihat</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <br>
            <?php $koneksi =  mysqli_connect("localhost", "root", "", "lelang"); ?>
            <?php
            $mulai = date("d-m-Y");
            $selesai = date("d-m-Y");
            ?>
            <?php if (isset($_GET['startdate'])) {
                $mulai = $_GET['startdate'];
                $selesai = $_GET['enddate'];
                $sql = mysqli_query($koneksi, "SELECT * FROM tb_pembayaran JOIN tb_barang ON tb_pembayaran.id_barang=tb_barang.id_barang JOIN tb_masyarakat ON tb_pembayaran.id_user=tb_masyarakat.id_user JOIN tb_lelang ON tb_lelang.id_lelang=tb_pembayaran.id_lelang WHERE tb_lelang.tgl_lelang BETWEEN '$mulai' AND '$selesai' AND tb_pembayaran.status_bayar ='sudah'");

                $sql2 = mysqli_query($koneksi, "SELECT SUM(jumlah_bayar) as gtotal FROM tb_pembayaran JOIN tb_barang ON tb_pembayaran.id_barang=tb_barang.id_barang JOIN tb_masyarakat ON tb_pembayaran.id_user=tb_masyarakat.id_user JOIN tb_lelang ON tb_lelang.id_lelang=tb_pembayaran.id_lelang WHERE tb_lelang.tgl_lelang BETWEEN '$mulai' AND '$selesai' AND tb_pembayaran.status_bayar ='sudah'");

                $sql3 = mysqli_query($koneksi, "SELECT COUNT(id_bayar) as item FROM tb_pembayaran JOIN tb_barang ON tb_pembayaran.id_barang=tb_barang.id_barang JOIN tb_masyarakat ON tb_pembayaran.id_user=tb_masyarakat.id_user JOIN tb_lelang ON tb_lelang.id_lelang=tb_pembayaran.id_lelang WHERE tb_lelang.tgl_lelang BETWEEN '$mulai' AND '$selesai' AND tb_pembayaran.status_bayar ='sudah'");

                $gtotal = mysqli_fetch_array($sql2);
                $item = mysqli_fetch_array($sql3);
            } else {
                $sql = mysqli_query($koneksi, "SELECT * FROM tb_pembayaran JOIN tb_barang ON tb_pembayaran.id_barang=tb_barang.id_barang JOIN tb_masyarakat ON tb_pembayaran.id_user=tb_masyarakat.id_user JOIN tb_lelang ON tb_lelang.id_lelang=tb_pembayaran.id_lelang WHERE tb_lelang.tgl_lelang = '$today' AND tb_pembayaran.status_bayar ='sudah'");

                $sql2 = mysqli_query($koneksi, "SELECT SUM(jumlah_bayar) as gtotal FROM tb_pembayaran JOIN tb_barang ON tb_pembayaran.id_barang=tb_barang.id_barang JOIN tb_masyarakat ON tb_pembayaran.id_user=tb_masyarakat.id_user JOIN tb_lelang ON tb_lelang.id_lelang=tb_pembayaran.id_lelang WHERE tb_lelang.tgl_lelang = '$today' AND tb_pembayaran.status_bayar ='sudah'");

                $sql3 = mysqli_query($koneksi, "SELECT COUNT(id_bayar) as item FROM tb_pembayaran JOIN tb_barang ON tb_pembayaran.id_barang=tb_barang.id_barang JOIN tb_masyarakat ON tb_pembayaran.id_user=tb_masyarakat.id_user JOIN tb_lelang ON tb_lelang.id_lelang=tb_pembayaran.id_lelang WHERE tb_lelang.tgl_lelang = '$today' AND tb_pembayaran.status_bayar ='sudah'");

                $gtotal = mysqli_fetch_array($sql2);
                $item = mysqli_fetch_array($sql3);
            } ?>
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <h3>Laporan Tanggal</h3><br>
                        <h4>"<?php echo date('d-m-Y', strtotime($mulai)); ?>" <span class="text-danger text-strong">SD</span> "<?php echo date('d-m-Y', strtotime($selesai)); ?>"</h4>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6 text-center">
                            <div class="form-group">
                                <label for="">Jumlah Transaksi</label>
                                <input type="text" class="form-control" readonly value="<?php echo number_format($item['item']) ?>">
                            </div>
                        </div>
                        <div class="col-md-6 text-center">
                            <div class="form-group">
                                <label for="">Total Pendapatan</label>
                                <input type="text" class="form-control" readonly value="Rp. <?php echo number_format($gtotal['gtotal']) ?>">
                            </div>
                        </div>
                    </div>
                    <div class="tb-pelelang">

                        <div class="table-responsive">

                            <table class="table table-bordered table-striped text-center" id="laporan">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Barang</th>
                                        <th>Pemenang</th>
                                        <th>Tanggal Lelang</th>
                                        <th>Detail Lelang</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    while ($lp = mysqli_fetch_array($sql)) { ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $lp['nama_barang']; ?></td>
                                            <td><?= $lp['nama_lengkap']; ?></td>
                                            <td><?= date('l, d-m-Y', strtotime($lp['tgl_lelang'])); ?></td>
                                            <td>
                                                <button class="btn btn-success" data-toggle="modal" data-target="#detail<?= $lp['id_bayar']; ?>"><i class="fa fa-eye"></i></button>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <a href="<?= base_url(); ?>petugas/Cp_dashboard/cetak/<?= $mulai; ?>/<?= $selesai; ?>" target="_blank" class="btn btn-success"><i class="fa fa-print"> Cetak</i></a>

                    </div>
                </div>
            </div>

    </div>
</div>


<!-- Modal tambah -->
<?php foreach ($laporan as $lap) : ?>
    <div class="modal fade" id="detail<?= $lap->id_bayar; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Detail Lelang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 text-center">
                                    <h6><b><?= $lap->nama_barang; ?></b></h6>
                                    <hr>
                                    <img src="<?= base_url(); ?>upload/barang/<?= $lap->foto; ?>" class="img-thumbnail" alt="gambar">
                                </div>
                                <div class="col-md-8">
                                    <table class="table table-bordered table-striped">
                                        <tr>
                                            <th>Tanggal Menang</th>
                                            <td>:</td>
                                            <td> <?= date('l, d-m-Y, H:i:s', strtotime($lap->waktu_menang)); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Harga Awal</th>
                                            <td>:</td>
                                            <td>Rp. <?= number_format($lap->harga_awal); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Harga Jadi</th>
                                            <td>:</td>
                                            <td>Rp. <?= number_format($lap->harga_akhir); ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Modal edit -->
<div class="modal fade" id="edit" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edit Petugas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="form-group">
                        <label for="">Nama Petugas</label>
                        <input type="text" name="nama_petugas" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Username</label>
                        <input type="text" name="username" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success">Simpan</button>
            </div>
        </div>
    </div>
</div>