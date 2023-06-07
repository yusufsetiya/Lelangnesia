<?php $koneksi =  mysqli_connect("localhost", "root", "", "lelang"); ?>
<?php
$today = date("Y-m-d");
$yesterday = date("Y-m-d", strtotime("-1 days"));
?>
<?php
$mulai = $mulai;
$selesai = $selesai;
?>
<?php if ($mulai) {
    $mulai = $mulai;
    $selesai = $selesai;
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

                <table class="table table-bordered table-striped text-center">
                    <tr>
                        <th>#</th>
                        <th>Barang</th>
                        <th>Pemenang</th>
                        <th>Tanggal Lelang</th>
                        <th>Total Bayar</th>
                    </tr>
                    <?php
                    $no = 1;
                    while ($lp = mysqli_fetch_array($sql)) { ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $lp['nama_barang']; ?></td>
                            <td><?= $lp['nama_lengkap']; ?></td>
                            <td><?= date('l, d-m-Y', strtotime($lp['tgl_lelang'])); ?></td>
                            <td>Rp. <?= number_format($lp['harga_akhir']); ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>

        </div>
    </div>
</div>


<script>
    window.print();
</script>