<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="#">Lelang<b class="text-danger">nesia</b>.com</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="<?= base_url('C_index'); ?>" data-toggle="modal" data-target="#bayar<?php $notif ?>">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('C_index/panduan'); ?>">Panduan Lelang</a>
                    </li>
                    <li class="nav-item">
                        <?php if ($session) { ?>
                            <a class="nav-link" href="<?= base_url('C_history'); ?>">History</a>
                        <?php } else { ?>
                            <a class="nav-link" hidden href="<?= base_url('C_history'); ?>">History</a>
                        <?php } ?>
                    </li>
                    <li class="nav-item">
                        <?php if ($session) { ?>
                            <a class="nav-link" href="<?= base_url('C_profile'); ?>">Profile</a>
                        <?php } else { ?>
                            <a class="nav-link" hidden href="<?= base_url('C_profile'); ?>">Profile</a>
                        <?php } ?>
                    </li>
                    <li class="nav-item ">
                        <?php if ($session) { ?>
                            <a href="<?= base_url('C_login/logout'); ?>"> <button class=" btn btn-danger tombol bt-login">Logout</button></a>
                        <?php } else { ?>
                            <a href="<?= base_url('C_login/index'); ?>"> <button class=" btn btn-primary tombol bt-login">Login</button></a>
                        <?php } ?>
                    </li>
                </ul>
            </div>
    </nav>
    </div>

    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4" id="text"></h1>
            <a href="#barang"><button class="btn btn-primary tombol" data-toggle="modal" data-target="#bayar<?php $notif ?>">Mulai Lelang</button></a>
            <!-- <a href="#barang"><button class="btn btn-primary tombol">Mulai Lelang</button></a> -->
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-10 info-panel">
                <div class="row">
                    <div class="col-lg">
                        <img src="<?= base_url(); ?>assets/icon/shield.png" class="float-left" alt="gambar">
                        <h4>Aman</h4>
                        <p>Lorem ipsum dolor sit amet </p>
                    </div>
                    <div class="col-lg">
                        <img src="<?= base_url(); ?>assets/icon/quality.png" class="float-left" alt="gambar">
                        <h4>Qualitas Terjamin</h4>
                        <p>Lorem ipsum dolor sit amet </p>
                    </div>
                    <div class="col-lg">
                        <img src="<?= base_url(); ?>assets/icon/trust.png" class="float-left" alt="gambar">
                        <h4>Terpercaya</h4>
                        <p>Lorem ipsum dolor sit amet </p>
                    </div>
                </div>

            </div>
        </div>
    </div><br><br>


    <!-- <div class="jumbotron warna-bg background">
        <div class="container text-white">

            <h1 class="display-4">Selamat datang</h1>
            <p class="lead" id="text"></p>
            <hr class="my-4">
            <p>Mulai lelang dengan klik tombol di bawah ini</p>
            <a class="btn btn-primary btn-lg" href="#barang" role="button">Mulai Lelang</a>
        </div>
    </div> -->

    <!-- <section id="lelang">
        <br><br>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-5">
                        <img src="<?= base_url(); ?>assets/img/4.jpg" alt="gambar" class="img-fluid" width="600">
                    </div>
                    <div class="col-md-7">
                        <div class="title">
                            <h2>Laptop Asus</h2>
                        </div><br>
                        <div class="">
                            Rp. 120.000.000
                        </div><br>
                        <div class="subtitle">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab sint nostrum, cumque perferendis recusandae tempore, eum dolorum consequatur omnis tenetur quibusdam! Perferendis accusantium vitae rerum iusto possimus, veritatis commodi assumenda.
                        </div><br>
                    </div>
                </div>

                <div class="card card-lg">
                    <div class="card-header text-center">
                        Kirim Penawaran
                    </div>
                    <div class="card-body">
                        <div class="card">
                            <div class="card-body">
                                <p>Harga Minimal Penawaran Rp. 120.000.000</p>
                                <form action="">
                                    <div class="form-group">
                                        <input type="number" class="form-control" max="" name="">
                                    </div>
                                    <div class="form-group">

                                        <a href="#" class="btn btn-primary w-100">Kirim Penawaran</a>
                                    </div>

                                </form>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

    </section> -->

    <section id="barang">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-3 col-md-3">
                    <hr>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <h2> <b>Daftar Barang</b></h2>
                </div>
                <div class="col-lg-3 col-md-3">
                    <hr>
                </div>
            </div> <br><br>

            <div class="row">
                <?php foreach ($barang as $row) : ?>
                    <div class="col-md-3 mb-4">
                        <div class="card barang">
                            <img src="<?= base_url(); ?>upload/barang/<?= $row->foto; ?>" class="card-img-top" width="100" height="170" alt="Gambar">
                            <div class="card-body">
                                <h5 class="card-title"><?= $row->nama_barang; ?></h5>
                                <p class="text-success"><b>Rp. <?= number_format($row->harga_awal); ?></b></p>
                                <!-- <p class="card-text"><?= substr(strip_tags($row->deskripsi_barang), 0, 30);  ?>...</p> -->
                                <hr>
                                <p class="time"><span class="text-danger bold-jam">
                                        <h6><b>Batas Waktu Lelang</b></h6>
                                </p>
                                <p class="time"><span class="text-danger bold-jam"> Tanggal : </span> <?= date('d F Y', strtotime($row->batas)); ?></p>
                                <p class="time"><span class="text-danger bold-jam"> Jam : </span> <?= date('H:i:s', strtotime($row->batas)); ?></p>
                                <a href=" <?= base_url('C_index/detail/' . $row->id_barang); ?>"> <button class="btn btn-primary">Lelang</button></a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>
    </section>

    <?php if ($notif == !NULL) { ?>
        <div class="modal fade" id="bayar<?php $notif ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- <div class="modal-header ">
                        <h5 class="text-center"><b>Notifikasi</b></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div> -->
                    <div class="modal-body  alert-danger">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <div class="text-center">
                            <div class="card-body">
                                <h5><b>Pemberitahuan</b></h5>
                                <hr>
                                <h6><b>Harap Melakukan Pembayaran Barang Yang sudah anda menangkan Terlebih Dahulu, Jika Anda Ingin Mengikuti Lelang. </b></h6>

                            </div>
                        </div><br>

                        <!-- <form action="">
                        <div class="form-group">
                            <label for="">Alamat Lengkap Pengiriman</label>
                            <textarea name="" id="" cols="30" rows="4" class="form-control"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Kota</label>
                                    <input type="text" name="nama_barang" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Kode Pos</label>
                                    <input type="text" class="form-control" name="time">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Bukti Transfer</label>
                            <input type="file" name="harga" class="form-control">
                        </div>
                        <div class="alert alert-warning teks">
                            <p><b>Nb.</b> Konfirmasi Pembayaran Akan Diproses paling lama 1 x 24 jam, pastikan Cek status pembayaran secara berkala</p>
                        </div>
                    </form> -->
                    </div>
                    <!-- <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div> -->
                </div>
            </div>
        </div>
    <?php } ?>