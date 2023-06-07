<div class="konten">
    <div class="container">
        <h2><i class="fa fa-book"></i> Laporan</h1>
            <hr><br>

            <div class="text-center">
                <h3>Laporan Tanggal</h3><br>
                <h4>"19-05-2021" <span class="text-danger text-strong">SD</span> "20-05-2021"</h4>
            </div><br>

            <div class="table-responsive">

                <table class="table table-bordered table-striped text-center">
                    <tr>
                        <th>NO</th>
                        <th>Username</th>
                        <th>Barang</th>
                        <th>Detail Lelang</th>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Mochamad Yusuf</td>
                        <td>Asus L300</td>
                        <td>
                            <button class="btn btn-success" data-toggle="modal" data-target="#detail"><i class="fa fa-eye"></i></button>
                        </td>
                    </tr>
                </table>
            </div>
    </div>
</div>


<!-- Modal tambah -->
<div class="modal fade" id="detail" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                            <div class="col-md-4">
                                <img src="<?= base_url(); ?>assets/img/4.jpg" class="img-thumbnail" alt="gambar">
                            </div>
                            <div class="col-md-8">
                                <table class="table table-bordered table-striped">
                                    <tr>
                                        <th>Tanggal Lelang</th>
                                        <td>:</td>
                                        <td> 19-02-2020</td>
                                    </tr>
                                    <tr>
                                        <th>Pemenang</th>
                                        <td>:</td>
                                        <td> -</td>
                                    </tr>
                                    <tr>
                                        <th>Harga Awal</th>
                                        <td>:</td>
                                        <td>Rp. 4.000.000</td>
                                    </tr>
                                    <tr>
                                        <th>Harga Jadi</th>
                                        <td>:</td>
                                        <td>Rp. -</td>
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