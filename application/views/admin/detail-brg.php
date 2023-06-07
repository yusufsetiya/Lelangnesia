<div class="konten">
    <?php foreach ($detail as $dtl) : ?>
        <div class="container">
            <h2>Detail > <b><?= $dtl->nama_barang; ?></b></h2>
            <hr><br>
            <div class="card">
                <div class="card-body">
                    <form action="">
                        <div class="form-group">
                            <label for="">Nama Barang</label>
                            <input type="text" name="nama_barang" class="form-control" readonly value="<?= $dtl->nama_barang; ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Foto</label><br>
                            <img src="<?= base_url(); ?>upload/barang/<?= $dtl->foto; ?>" alt="" class="img-thumbnail" width="300">
                        </div>
                        <div class="form-group">
                            <label for="">Tanggal Upload</label>
                            <input type="text" name="nama_barang" class="form-control" readonly value="<?= date('l, d F Y', strtotime($dtl->tgl)); ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Waktu Ditutup</label>
                            <input type="text" name="nama_barang" class="form-control" readonly value="<?= date('l, d F Y, H:i:s', strtotime($dtl->batas)); ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Harga</label>
                            <input type="text" name="harga" class="form-control" readonly value="Rp. <?= number_format($dtl->harga_awal); ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Deskripsi</label>
                            <textarea name="" id="" class="form-control" readonly cols="30" rows="5"><?= $dtl->deskripsi_barang; ?></textarea>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach ?>