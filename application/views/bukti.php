<body class="detail-b">

    <div class="container-fluid detail">
        <div class="card">
            <div class="card-body">
                <div class="card">
                    <div class="card-header text-center alert-info">
                        <h5><b>Bukti Pembayaran</b></h5>
                    </div>
                    <div class="card-body">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="style-bukti" for="">Nama</label>
                                            <input type="text" class="col-sm-8 form-control" disabled value="Mochamad yusuf">
                                        </div>
                                        <div class="form-group">
                                            <label class="style-bukti" for="">Barang</label>
                                            <input type="text" class="col-sm-8 form-control" disabled value="Laptop Asus">
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="style-bukti" for="">Tanggal</label>
                                                    <input type="text" class="col-sm-8 form-control" disabled value="12-90-2021">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="style-bukti" for="">Jam</label>
                                                    <input type="text" class="col-sm-8 form-control" disabled value="12:00:00">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="style-bukti" for="">Jumlah Transfer</label>
                                            <input type="text" class="col-sm-8 form-control" disabled value="120.000.000">
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="style-bukti" for="">Bukti Transfer</label><br>
                                            <img src="<?= base_url(); ?>assets/img/tf.jpg" width="200" alt="gambar">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div><br>
                <button class="btn btn-success text-center" onclick="window.print()"><i class="fa fa-pint"></i>Cetak</button>
            </div>
        </div>
    </div>