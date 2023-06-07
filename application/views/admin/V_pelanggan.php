<div class="konten">
  <div class="container">
    <h2><i class="fa fa-users" aria-hidden="true"></i> Manage Pelanggan</h2>
    <hr><br>

    <div class="card">
      <div class="card-header alert alert-warning">
        <b>Butuh Verifikasi</b>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <div class="tb-pelelang">

            <table class="table table-bordered table-striped text-center" id="b_verif">
              <thead>
                <tr>
                  <th>NO</th>
                  <th>Username</th>
                  <th>Foto</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                foreach ($masyarakat as $new) :
                ?>
                  <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $new->username; ?></td>
                    <td><img src="<?= base_url(); ?>upload/profile/<?= $new->wajah; ?>" width="70" alt="gambar" class="zoom"></td>
                    <td>
                      <?php if ($new->verif == '1') { ?>
                        <p class="badge  badge-warning">Belum</p>
                      <?php } else { ?>
                        <p class="badge  badge-success">Terverifikasi</p>
                      <?php } ?>
                    </td>
                    <td>
                      <a href="<?= base_url(); ?>admin/C_pelanggan/verifNew/<?= $new->id_user; ?>" class="btn btn-success"><i class="fa fa-check"></i></a>
                      <button type="button" class="btn btn-info" data-toggle="modal" data-target="#verif<?= $new->id_user; ?>">
                        <i class="fa fa-eye"></i>
                      </button>
                      <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#blokirV<?= $new->id_user; ?>">
                        <i class="fa fa-ban"></i>
                      </button>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div><br>
    <div class="card">
      <div class="card-header alert alert-success">
        <b>Terverifikasi</b>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <div class="tb-pelelang">

            <table class="table table-bordered table-striped text-center table-hover" id="verif">
              <thead>
                <tr>
                  <th>NO</th>
                  <th>Username</th>
                  <th>Nama Lengkap</th>
                  <th>Telepon</th>
                  <th>Status Verifikasi</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                foreach ($verif as $row) :
                ?>
                  <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $row->username; ?></td>
                    <td><?= $row->nama_lengkap; ?></td>
                    <td><?= $row->telp; ?></td>
                    <td>
                      <?php if ($row->verif == '2') { ?>
                        <p class="badge  badge-success">Terverifikasi</p>
                      <?php } else { ?>
                        <p class="badge badge-danger">Belum</p>
                      <?php } ?>
                    </td>
                    <td>
                      <button type="button" class="btn btn-info" data-toggle="modal" data-target="#detail<?= $row->id_user; ?>">
                        <i class="fa fa-eye"></i>
                      </button>
                      <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#block<?= $row->id_user; ?>">
                        <i class="fa fa-ban"></i>
                      </button>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div><br>

    <div class="card">
      <div class="card-header alert alert-danger">
        <b>Diblokir</b>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <div class="tb-pelelang">

            <table class="table table-bordered table-striped text-center" id="blokir">
              <thead>
                <tr>
                  <th>NO</th>
                  <th>Username</th>
                  <th>Alasan Diblokir</th>
                  <th>Status Verifikasi</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                foreach ($blokir as $red) :
                ?>
                  <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $red->username; ?></td>
                    <td><?= $red->alasan; ?></td>

                    <td>
                      <?php if ($red->verif == '1') { ?>
                        <p class="badge badge-warning">Belum</p>
                      <?php } elseif ($red->verif == '2') { ?>
                        <p class="badge badge-success">Terverifikasi</p>
                      <?php } else { ?>
                        <p class="badge  badge-danger">Diblokir</p>
                      <?php } ?>
                    </td>
                    <td>
                      <button type="button" class="btn btn-info" data-toggle="modal" data-target="#verif<?= $red->id_user; ?>">
                        <i class="fa fa-eye"></i>
                      </button>
                      <a href="<?= base_url('admin/C_pelanggan/hapus/' .  $red->id_user); ?>"><button type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button></a>
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

<!-- Modal detail pelanggan -->
<?php foreach ($verif as $detail) : ?>
  <div class="modal fade" id="detail<?= $detail->id_user; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-center" id="staticBackdropLabel">Detail <b><?= $detail->username; ?></b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="card">
            <div class="card-body">
              <form action="">
                <div class="form-group">
                  <label for="">Nama Pelanggan</label>
                  <input type="text" name="nama_pelanggan" class="form-control" readonly value="<?= $detail->nama_lengkap; ?>" autocomplete="off">
                </div>
                <div class="form-group">
                  <label for="">Username</label>
                  <input type="text" name="username" class="form-control" readonly value="<?= $detail->username; ?>" autocomplete="off">
                </div>
                <div class="form-group">
                  <label for="">Telepon</label>
                  <input type="text" name="password" class="form-control" readonly value="<?= $detail->telp; ?>" autocomplete="off">
                </div>
                <div class="form-group">
                  <div class="row text-center">
                    <div class="col-md-5">
                      <label class="mb-3">Foto Wajah</label><br>
                      <img src="<?= base_url(); ?>upload/profile/<?= $detail->wajah; ?>" class="img-thumbnail" width="200" alt="gambar">
                    </div>
                    <div class="col-md-5">
                      <label class="mb-3">Foto KTP</label><br>
                      <img id="detail-ktp" src="<?= base_url(); ?>upload/profile/<?= $detail->ktp; ?>" class="img-thumbnail" width="200" alt="gambar">
                    </div>
                  </div>

                </div>
              </form>
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
<!-- Modal detail Verif -->
<?php foreach ($masyarakat as $dtNew) : ?>
  <div class="modal fade" id="verif<?= $dtNew->id_user; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-center" id="staticBackdropLabel">Detail <b><?= $dtNew->username; ?></b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="card">
            <div class="card-body">
              <form action="<?= base_url('admin/C_pelanggan/verifNew/' . $dtNew->id_user); ?>" method="POST">
                <input type="hidden" name="id" value="<?= $dtNew->id_user; ?>">
                <div class="form-group">
                  <label for="">Nama Pelanggan</label>
                  <input type="text" class="form-control" readonly value="<?= $dtNew->nama_lengkap; ?>" autocomplete="off">
                </div>
                <div class="form-group">
                  <label for="">NIK</label>
                  <input type="text" class="form-control" readonly value="<?= $dtNew->nik; ?>" autocomplete="off">
                </div>
                <div class="form-group">
                  <label for="">Alamat</label>
                  <textarea name="" class="form-control" readonly id="" cols="30" rows="2"> <?= $dtNew->alamat; ?></textarea>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Tempat Lahir</label>
                      <input type="text" class="form-control" readonly value="<?= $dtNew->tpt_lahir; ?>" autocomplete="off">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Tanggal Lahir</label>
                      <input type="text" class="form-control" readonly value="<?= $dtNew->tgl; ?>">
                    </div>
                  </div>
                </div>
                <div class="card-body text-center">
                  <div class="row">
                    <div class="col-md-6">
                      <h3 class="mb-3">Foto Wajah</h3>
                      <hr>
                      <img src="<?= base_url(); ?>upload/profile/<?= $dtNew->wajah; ?>" alt="gambar" width="200" class="img-thumbnail">
                    </div>
                    <div class="col-md-6">
                      <h3 class="mb-3">Foto KTP</h3>
                      <hr>
                      <img id="detail-ktp" src="<?= base_url(); ?>upload/profile/<?= $dtNew->ktp; ?>" alt="gambar" width="300" class="img-thumbnail">
                    </div>
                  </div>
                </div>
            </div>
            <div class="card-footer text-center">
              <a href=""><button type="submit" class="btn btn-success">Verifikasi</button></a>
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php endforeach; ?>

<!-- Modal blokir -->
<?php foreach ($blokir as $block) : ?>
  <div class="modal fade" id="verif<?= $block->id_user; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-center" id="staticBackdropLabel">Detail <b><?= $block->username; ?></b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="card">
            <div class="card-body">
              <form action="<?= base_url('admin/C_pelanggan/buka'); ?>" method="POST">
                <input type="hidden" name="id" value="<?= $block->id_user; ?>">
                <div class="form-group">
                  <label for="">Nama Pelanggan</label>
                  <input type="text" class="form-control" readonly value="<?= $block->nama_lengkap; ?>">
                </div>
                <div class="form-group">
                  <label for="">Alasan Diblokir</label>
                  <textarea name="" class="form-control" readonly id="" cols="30" rows="2"> <?= $block->alasan; ?></textarea>
                </div>
                <div class="card-body text-center">
                  <div class="row">
                    <div class="col-md-6">
                      <h3 class="mb-3">Foto Wajah</h3>
                      <hr>
                      <img src="<?= base_url(); ?>upload/profile/<?= $block->wajah; ?>" alt="gambar" width="200" class="img-thumbnail">
                    </div>
                    <div class="col-md-6">
                      <h3 class="mb-3">Foto KTP</h3>
                      <hr>
                      <img src="<?= base_url(); ?>upload/profile/<?= $block->ktp; ?>" alt="gambar" width="300" class="img-thumbnail">
                    </div>
                  </div>
                </div>
            </div>
            <div class="card-footer text-center">
              <a href=""><button type="submit" class="btn btn-warning">Buka Blokir</button></a>
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php endforeach; ?>


<!-- modal masuk blokir -->
<?php foreach ($verif as $b) : ?>
  <!-- Modal -->
  <div class="modal fade" id="block<?= $b->id_user; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Alasan Diblokir</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="<?= base_url('admin/C_pelanggan/blokir'); ?>" method="POST">
            <input type="hidden" name="id" value="<?= $b->id_user; ?>" id="">
            <div class="form-group">
              <label for="">Alasan Diblokir</label>
              <textarea placeholder="Masukan Alasan Kenapa Pelanggan Diblokir" name="alasan" class="form-control" id="" cols="30" rows="5"></textarea>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Blokir</button>
        </div>
        </form>
      </div>
    </div>
  </div>
<?php endforeach; ?>

<!-- modal masuk blokir 2 -->
<?php foreach ($masyarakat as $c) : ?>
  <!-- Modal -->
  <div class="modal fade" id="blokirV<?= $c->id_user; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Alasan Diblokir</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="<?= base_url('admin/C_pelanggan/blokir'); ?>" method="POST">
            <input type="hidden" name="id" value="<?= $c->id_user; ?>" id="">
            <div class="form-group">
              <label for="">Alasan Diblokir</label>
              <textarea placeholder="Masukan Alasan Kenapa Pelanggan Diblokir" name="alasan" class="form-control" id="" cols="30" rows="5"></textarea>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Blokir</button>
        </div>
        </form>
      </div>
    </div>
  </div>
<?php endforeach; ?>