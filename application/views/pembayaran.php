<body class="detail-b">

    <div class="container-fluid mt-3">
        <div class="card">
            <div class="card-body">
                <div class="card">
                    <div class="card-header alert alert-success text-center">
                        <h5><b>Pembayaran Lelang Online</b></h5>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url('pembayaran/transfer'); ?>">
                            <div class="form-group">
                                <label for="">Nomor Virtual Account</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Nomor Rekening</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Nominal Pembayaran</label>
                                <input type="number" class="form-control">
                                <span class="petunjuk small">* Masukan Nominal Sesuai Tagihan Anda</span>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Masukan Pin</label>
                                        <input type="password" class="form-control form-password"><br>
                                        <input type="checkbox" name="tampil_pwd" class="form-checkbox"> Tampilkan PIN
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Konfirmasi Pin</label>
                                        <input type="password" class="form-control form-password">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mt-4">
                                <button type="submit" class="btn btn-success form-control">Transfer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>