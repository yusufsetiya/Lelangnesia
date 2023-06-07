<div class="konten">
    <div class="container">
        <h2><i class="fa fa-user-o"></i> Manage Petugas</h1>
            <hr><br>
            <button type="button" class="btn btn-primary tambah-petugas" data-toggle="modal" data-target="#tambah">
                <i class="fa fa-plus"></i> Tambah Petugas
            </button>
            <div class="table-responsive">

                <table class="table table-bordered table-striped table-hover text-center" id="petugas">
                    <thead>
                        <tr>
                            <th scope="col">NO</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Username</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($petugas as $row) { ?>
                            <tr id="<?php echo $row->id_petugas; ?>">
                                <td><?= $no++; ?></td>
                                <td><?= $row->nama_petugas; ?></td>
                                <td><?= $row->username; ?></td>
                                <td>
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#detail_petugas<?= $row->id_petugas; ?>">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                    <button class="btn btn-warning" data-toggle="modal" data-target="#edit_petugas<?= $row->id_petugas; ?>">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button type="submit" class="btn btn-danger remove"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
    </div>
</div>


<!-- Modal tambah -->
<div class="modal fade" id="tambah" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Tambah Petugas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url() . 'admin/C_petugas/tambah'; ?>" method="post">

                    <div class="form-group">
                        <label for="">Nama Petugas</label>
                        <input type="text" name="nama" class="form-control" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="">Username</label>
                        <input id="username" type="text" name="username" class="form-control" required autocomplete="off">
                        <span id="peringatan-username" class="text-danger small">Username Telah Digunakan</span>
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" name="password" class="form-control form-password" required autocomplete="off"><br>
                        <input type="checkbox" name="tampil_pwd" class="form-checkbox"> Tampil Password
                    </div>
                    <div class="form-group">
                        <label for="">level</label>
                        <select name="level" id="" class="form-control" required>
                            <option value="">--Pilih--</option>
                            <?php foreach ($level as $row) : ?>
                                <option value="<?= $row->id_level; ?>"><?= $row->level; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button id="simpan" type="submit" class="btn btn-success">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal edit -->
<?php foreach ($petugas as $dtl) : ?>
    <div class="modal fade" id="detail_petugas<?= $dtl->id_petugas; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Detail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nama Petugas</label>
                        <input type="text" name="nama_petugas" class="form-control" readonly value="<?= $dtl->nama_petugas; ?>" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="">Username</label>
                        <input type="text" name="username" class="form-control" readonly value="<?= $dtl->username; ?>" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" name="password" class="form-control form-password" readonly value="<?= $dtl->V_password; ?>" autocomplete="off"><br>
                        <input type="checkbox" name="tampil_pwd" class="form-checkbox"> Tampil Password
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
<?php foreach ($petugas as $dt) : ?>
    <div class="modal fade" id="edit_petugas<?= $dt->id_petugas; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit Petugas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= site_url('admin/C_petugas/edit'); ?>" method="post">
                        <input type="hidden" name="id_petugas" class="form-control" value="<?= $dt->id_petugas; ?>" required autocomplete="off">
                        <div class="form-group">
                            <label for="">Nama Petugas</label>
                            <input type="text" name="nama" class="form-control" value="<?= $dt->nama_petugas; ?>" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="">Username</label>
                            <input type="text" name="username" class="form-control" value="<?= $dt->username; ?>" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" name="password" class="form-control form-password" value="<?= $dt->V_password; ?>" autocomplete="off"><br>
                            <input type="checkbox" name="tampil_pwd" class="form-checkbox"> Tampil Password
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