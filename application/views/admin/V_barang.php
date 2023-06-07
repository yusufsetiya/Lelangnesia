<div class="konten">
    <div class="container">
        <h2><i class="fa fa-shopping-bag"></i> Manage Barang</h2>
        <hr><br>
        <button type="button" class="btn btn-primary tambah-petugas" data-toggle="modal" data-target="#tambah">
            <i class="fa fa-plus"> </i> Tambah Barang
        </button>

        <h6><?= $this->session->flashdata('message'); ?></h6>
        <div class="table-responsive">
            <table class="table table-bordered table-striped text-center table-hover" id="barang">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Barang</th>
                        <th>Foto</th>
                        <th>Harga</th>
                        <th>Status Lelang</th>
                        <th>Status Barang</th>
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
                            <td>
                                <?php if ($brg->status_lelang == 'ditutup') { ?>
                                    <p class="badge badge-danger">ditutup</p>
                                <?php } elseif ($brg->status_lelang == 'dibuka') { ?>
                                    <p class="badge badge-success">Dibuka</p>
                                <?php } else { ?>
                                    <p class="badge badge-danger">ditutup</p>
                                <?php } ?>
                            </td>
                            <td>
                                <?php if ($brg->status_barang == '2') { ?>
                                    <p class="badge badge-danger">Terjual</p>
                                <?php } elseif ($brg->status_barang == '3') { ?>
                                    <p class="badge badge-warning">Pending Pembayaran</p>
                                <?php } else { ?>
                                    <p class="badge badge-success">Tersedia</p>
                                <?php } ?>
                            </td>
                            <td>
                                <?php if ($brg->status_barang == '1') { ?>
                                    <a href="<?= base_url('admin/C_barang/detailBrg/' . $brg->id_barang); ?>"><button class="btn btn-primary"><i class="fa fa-eye"></i></button></a>
                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?= $brg->id_barang; ?>">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <a href="<?= base_url('admin/C_barang/hapus/' . $brg->id_barang); ?>"><button type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button></a>
                                <?php } elseif ($brg->status_barang == '3') { ?>
                                    <a href="<?= base_url('admin/C_barang/detailBrg/' . $brg->id_barang); ?>"><button class="btn btn-primary"><i class="fa fa-eye"></i></button></a>
                                    <button disabled type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?= $brg->id_barang; ?>">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <a href="<?= base_url('admin/C_barang/hapus/' . $brg->id_barang); ?>"><button disabled type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button></a>
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
                <form action="<?= base_url('admin/C_barang/tambah'); ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="">Nama Barang</label>
                        <input type="text" required name="nama_barang" class="form-control" autocomplete="off">
                    </div>
                    <!-- <div class="form-group">
                        <label for="">Tanggal</label>
                        <input type="date" required name="tanggal_upload" class="form-control">
                    </div> -->
                    <div class="form-group">
                        <label for="">Harga</label>
                        <input type="number" required min="1" name="harga" class="form-control" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="">Deskripsi</label>
                        <textarea name="deskripsi" required id="" class="form-control" cols="30" rows="5"></textarea>
                    </div>
                    <!-- <div class="form-group">
                        <label for="">Batas Waktu Lelang</label>
                        <input type="datetime-local" name="batas" class="form-control">
                    </div> -->
                    <div class="form-group">
                        <label for="">Foto</label>
                        <input type="file" required class="form-control" name="foto">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" type="button" class="btn btn-success">Simpan</button>
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
                    <form action="<?= base_url('admin/C_barang/update'); ?>" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $row->id_barang; ?>">
                        <div class="form-group">
                            <label for="">Nama Barang</label>
                            <input type="text" required name="nama_barang" class="form-control" value="<?= $row->nama_barang; ?>" autocomplete="off">
                        </div>
                        <!-- <div class="form-group">
                            <label for="">Tanggal Upload</label>
                            <input type="date" required name="tanggal_upload" class="form-control" readonly value="<?= $row->tgl; ?>">
                        </div> -->
                        <div class="form-group">
                            <label for="">Harga</label>
                            <input type="number" min="1" required name="harga_awal" class="form-control" value="<?= $row->harga_awal; ?>" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="">Deskripsi</label>
                            <textarea name="deskripsi_barang" required id="" class="form-control" cols="30" rows="5"><?= $row->deskripsi_barang; ?></textarea>
                        </div>
                        <!-- <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Batas Tanggal</label>
                                    <input type="date" name="batas_tgl" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="">Batas waktu</label>
                                    <input type="time" name="batas_waktu" class="form-control">
                                </div>
                            </div>
                        </div> -->
                        <div class="form-group">
                            <label for="">Foto</label><br>
                            <img src="<?php echo base_url() ?>upload/barang/<?php echo $row->foto ?>" width="200" alt="" name="foto">
                            <input type="hidden" name="old_pict" value="<?php echo $row->foto ?>">
                            <input type="file" class="form-control mt-2" name="foto">
                        </div>
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