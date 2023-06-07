<div class="konten">
    <div class="container">
        <h2><i class="fa fa-shopping-bag"></i> Manage Barang</h2>
        <hr><br>
        <button type="button" class="btn btn-primary tambah-petugas" data-toggle="modal" data-target="#tambah">
            <i class="fa fa-plus"> </i> Tambah Barang
        </button>
        <h6><?= $this->session->flashdata('message'); ?></h6>
        <!-- <form action="<?= base_url('petugas/Cp_barang/cari'); ?>" method="GET">
            <div class="form-group">
                <input type="text" name="cari" class="form-control" placeholder="cari">
                <button type="submit" class="btn btn-primary">Cari</button>
            </div>
        </form> -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped text-center" id="barang">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Foto</th>
                        <th>Harga</th>
                        <!-- <th>Diposting</th> -->
                        <!-- <th>Status Lelang</th> -->
                        <th>Status Barang</th>
                        <th>Lelang</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($barang as $brg) :
                    ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $brg->nama_barang; ?></td>
                            <td><img src="<?= base_url(); ?>upload/barang/<?= $brg->foto; ?>" width="100px" alt="image" /></td>
                            <td>Rp. <?= number_format($brg->harga_awal); ?></td>
                            <!-- <td><?= $brg->nama_petugas; ?></td> -->
                            <!-- <td>
                        <p class="badge badge-pill badge-success">Dibuka</p>
                    </td> -->
                            <td>
                                <?php if ($brg->status_barang == '2') { ?>
                                    <p class="badge badge-pill badge-danger">Terjual</p>
                                <?php } elseif ($brg->status_barang == '3') { ?>
                                    <p class="badge badge-pill badge-warning">Pending Pembayaran</p>
                                <?php } else { ?>
                                    <p class="badge badge-pill badge-success">Tersedia</p>
                                <?php } ?>
                            </td>
                            <td>
                                <?php if ($telepon == !NULL) { ?>
                                    <?php if ($brg->status_barang == '3') { ?>
                                        <button type="button" disabled di class="btn btn-success"><i class="fa fa-play"></i> Mulai</button>
                                    <?php } elseif ($brg->status_lelang == 'dibuka') { ?>
                                        <a href="<?= base_url('petugas/Cp_barang/close/' . $brg->id_barang); ?>"><button class="btn btn-danger"><i class="fa fa-stop"></i> Stop</button></a>
                                    <?php } elseif ($brg->status_lelang == 'ditutup') { ?>
                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#open<?= $brg->id_barang; ?>">
                                            <i class="fa fa-play"></i> Mulai
                                        </button>
                                    <?php } elseif ($brg->status_lelang == 'terjual') { ?>
                                        <button type="button" disabled di class="btn btn-danger"><i class="fa fa-ban"></i> Terjual</button>
                                    <?php } ?>
                                <?php } else { ?>
                                    <button type="button" disabled di class="btn btn-success"><i class="fa fa-play"></i> Mulai</button>
                                    <p class="text-danger small">Harap Menyetel No WhatsApp Terlebih Dahulu</p>
                                <?php } ?>
                            </td>
                            <td>
                                <?php if ($brg->status_barang == '1') { ?>
                                    <a href="<?= base_url('petugas/Cp_barang/detail/' . $brg->id_barang); ?>"><button class="btn btn-primary"><i class="fa fa-eye"></i></button></a>
                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?= $brg->id_barang; ?>">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <a href="<?= base_url('petugas/Cp_barang/hapus/' . $brg->id_barang); ?>"><button type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button></a>
                                <?php } elseif ($brg->status_barang == '3') { ?>
                                    <a href="<?= base_url('petugas/Cp_barang/detail/' . $brg->id_barang); ?>"><button class="btn btn-primary"><i class="fa fa-eye"></i></button></a>
                                    <button disabled type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?= $brg->id_barang; ?>">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <a href="<?= base_url('petugas/Cp_barang/hapus/' . $brg->id_barang); ?>"><button disabled type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button></a>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- Modal tambah -->
<div class="modal fade" id="tambah" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Tambah Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('petugas/Cp_barang/tambah'); ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="">Nama Barang</label>
                        <input type="text" required name="nama_barang" class="form-control" autocomplete="off">
                    </div>
                    <!-- <div class="form-group">
                        <label for="">Tanggal Diupload</label>
                        <input type="date" required name="tanggal_upload" class="form-control" autocomplete="off">
                    </div> -->
                    <!-- <div class="form-group">
                        <label for="">Waktu Ditutup</label>
                        <input type="datetime-local" class="form-control" name="batas">
                    </div> -->
                    <div class="form-group">
                        <label for="">Harga</label>
                        <input type="number" min="1" required name="harga" class="form-control" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="">Deskripsi</label>
                        <textarea name="deskripsi" required id="" class="form-control" cols="30" rows="5"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Foto</label>
                        <input type="file" required class="form-control" name="foto">
                    </div>

                    <!-- <div class="form-group">
                        <label for="">Status Lelang</label>
                        <select name="status" id="" class="form-control">
                            <option value="">Dibuka</option>
                            <option value="">Ditutup</option>
                        </select>
                    </div> -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal edit -->
<?php foreach ($barang as $row) : ?>
    <div class="modal fade" id="edit<?= $row->id_barang; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('petugas/Cp_barang/update/' . $row->id_barang); ?>" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $row->id_barang; ?>">
                        <div class="form-group">
                            <label for="">Nama Barang</label>
                            <input type="text" required name="nama_barang" class="form-control" value="<?= $row->nama_barang; ?>" autocomplete="off">
                        </div>
                        <!-- <div class="form-group">
                            <label for="">Tanggal Diupload</label>
                            <input type="date" readonly name="tanggal_upload" class="form-control" value="<?= $row->tgl; ?>">
                        </div> -->
                        <!-- <div class="form-group">
                            <label for="">Waktu Ditutup</label>
                            <input type="datetime-local" class="form-control" name="time">
                        </div> -->
                        <div class="form-group">
                            <label for="">Harga</label>
                            <input type="text" required name="harga_awal" class="form-control" value="<?= $row->harga_awal; ?>" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="">Deskripsi</label>
                            <textarea name="deskripsi_barang" required id="" class="form-control" cols="30" rows="5"><?= $row->deskripsi_barang; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Foto</label><br>
                            <img src="<?php echo base_url() ?>upload/barang/<?php echo $row->foto ?>" width="200" alt="" name="foto">
                            <input type="hidden" name="old_pict" value="<?php echo $row->foto ?>">
                            <input type="file" class="form-control mt-2" name="foto">
                        </div>
                        <!-- <div class="form-group">
                            <label for="">Status Lelang</label>
                            <select name="status" id="" class="form-control">
                                <option value="">Dibuka</option>
                                <option value="">Ditutup</option>
                            </select>
                        </div> -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Modal -->
<?php foreach ($barang as $op) : ?>
    <div class="modal fade" id="open<?= $op->id_barang; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header alert-success text-center">
                    <h5 class="modal-title">Masukan Batas Waktu lelang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('petugas/Cp_barang/open/' . $op->id_barang); ?>" method="POST">
                        <input type="hidden" name="id" value="<?= $op->id_barang; ?>">
                        <div class="form-group">
                            <input type="datetime-local" required name="batas" class="form-control">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Mulai Lelang</button>
                </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>