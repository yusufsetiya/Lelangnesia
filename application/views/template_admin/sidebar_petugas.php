<body class="index">
    <!-- <div class="row">

        <div class="col-md-2"> -->

    <div class="user fixed-top">
        <ul>
            <li>
                <span class="utama">
                    <i class="fa fa-user-circle-o icon-petugas"></i>
                    <!-- <img src="<?= base_url(); ?>assets/icon/unnamed.png" alt="gambar" width="40px" class="img-profile rounded-circle"> -->
                </span>
                <span class="judul"><?= $this->session->userdata('username'); ?>
                    <p class="badge badge-pill badge-success ml-2">Petugas</p>
                </span>
                <div class="toggle" onclick="toggleMenu()"></div>
            </li>
        </ul>
    </div>

    <div class="navigation">
        <nav>

            <ul>
                <li>
                    <a href="<?= base_url('petugas/Cp_dashboard'); ?>">
                        <span class="icon"><i class="fa fa-home" aria-hidden="true"></i></span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('petugas/Cp_barang'); ?>">
                        <span class="icon"><i class="fa fa-shopping-bag" aria-hidden="true"></i></span>
                        <span class="title">Barang</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('petugas/Cp_penawaran/index'); ?>">
                        <span class="icon"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i></span>
                        <span class="title">Penawaran</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('C_pembayaran/petugas'); ?>">
                        <span class="icon"><i class="fa fa-money" aria-hidden="true"></i></span>
                        <span class="title">Pembayaran</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('C_laporan/second'); ?>">
                        <span class="icon"><i class="fa fa-book" aria-hidden="true"></i></span>
                        <span class="title">Laporan</span>
                    </a>
                </li>
                <li class="logout">
                    <a href="<?= base_url('auth_petugas/logout'); ?>">
                        <span class="icon"><i class="fa fa-sign-out"></i></span>
                        <span class="title">Logout</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>


    <!-- <div class="col-md-12">

            
        </div> -->