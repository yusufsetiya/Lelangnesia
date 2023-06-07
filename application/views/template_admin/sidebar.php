<body class="index">
    <div class="row">
        <div class="col-md-2">
            <div class="navigation">
                <nav>

                    <ul>
                        <li>
                            <a href="<?= base_url('admin/C_dashboard'); ?>">
                                <span class="icon"><i class="fa fa-home" aria-hidden="true"></i></span>
                                <span class="title">Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('admin/C_petugas'); ?>">
                                <span class="icon"><i class="fa fa-user-o" aria-hidden="true"></i></span>
                                <span class="title">Petugas</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('admin/C_pelanggan'); ?>">
                                <span class="icon"><i class="fa fa-users" aria-hidden="true"></i></span>
                                <span class="title">Pelanggan</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('admin/C_barang'); ?>">
                                <span class="icon"><i class="fa fa-shopping-bag" aria-hidden="true"></i></span>
                                <span class="title">Barang</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('C_pembayaran/index'); ?>">
                                <span class="icon"><i class="fa fa-money" aria-hidden="true"></i></span>
                                <span class="title">Pembayaran</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('C_laporan/index'); ?>">
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
        </div>
        <div class="col-md-12">
            <div class="user fixed-top">
                <ul>
                    <li>
                        <span class="utama"><i class="fa fa-opencart"></i></span>
                        <span class="judul"><?= $this->session->userdata('username'); ?>
                            <p class="badge badge-pill badge-warning text-white ml-2">Administrator</p>
                        </span>
                        <div class="toggle" onclick="toggleMenu()"></div>
                    </li>
                </ul>
            </div>
        </div>
    </div>