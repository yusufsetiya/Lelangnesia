<div class="konten">
    <div class="container">
        <h2 class="font-weight-bold"> Laptop Asus</h2>
        <hr><br>

        <div class="card">
            <div class="card-header">
                Detail Barang
            </div>
            <div class="card-body">
                <?php foreach ($detail as $dtl) : ?>
                    <div class="row">
                        <div class="col-md-4">
                            <img src="<?= base_url(); ?>upload/barang/<?= $dtl->foto; ?>" class="img-thumbnail" alt="gambar">
                        </div>
                        <div class="col-md-8">
                            <table class="table table-borderedless">
                                <tr>
                                    <th>Tanggal Lelang</th>
                                    <td>:</td>
                                    <td> <?= date('l, d-m-Y', strtotime($dtl->tgl_lelang));  ?></td>
                                </tr>
                                <tr>
                                    <th>Pemenang</th>
                                    <td>:</td>
                                    <td> <?= $dtl->id_user; ?></td>
                                </tr>
                                <tr>
                                    <th>Harga Awal</th>
                                    <td>:</td>
                                    <td>Rp. <?= number_format($dtl->harga_awal); ?></td>
                                </tr>
                                <tr>
                                    <th>Harga Jadi</th>
                                    <td>:</td>
                                    <?php if ($dtl->harga_akhir == '') { ?>
                                        <td>-</td>
                                    <?php } else { ?>
                                        <td>Rp. <?= number_format($dtl->harga_akhir); ?></td>
                                    <?php } ?>
                                </tr>
                            </table>
                        </div>
                    </div>
            </div>
        <?php endforeach; ?>
        </div><br>


        <div class="card">
            <div class="card-header">
                Penawaran
            </div>
            <div class="card-body">
                <div class="table-responsive">

                    <table class="table table-bordered table-striped text-center" id="tawaran">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Username</th>
                                <th>Nama Lengkap</th>
                                <th>Tawar</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($tawaran as $tawar) : ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $tawar->username; ?></td>
                                    <td><?= $tawar->nama_lengkap; ?></td>
                                    <td>Rp. <?= number_format($tawar->penawaran_harga); ?></td>
                                    <td>
                                        <?php if ($tawar->penawaran_harga == $tombol && $tawar->harga_akhir == NULL) { ?>
                                            <form action="<?= base_url('petugas/Cp_penawaran/pemenang/' . $tawar->id_lelang); ?>" method="POST">
                                                <input type="hidden" name="pemenang" value="<?= $tawar->id_user; ?>">
                                                <input type="hidden" name="id" value="<?= $tawar->id_lelang; ?>">
                                                <input type="hidden" name="id_barang" value="<?= $tawar->id_barang; ?>">
                                                <input type="hidden" name="tawaran" value="<?= $tawar->penawaran_harga; ?>">
                                                <button type="submit" class="btn btn-success"> Pilih Jadi Pemenang</button>
                                            </form>
                                        <?php } else { ?>
                                            -
                                        <?php } ?>
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