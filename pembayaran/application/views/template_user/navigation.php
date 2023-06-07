<body>

    <div class="shadow fixed-top">

        <nav class="navbar navbar-expand-lg navbar-light nv">
            <div class="container">
                <a class="navbar-brand judul-nav" href="#">Lelang - <b>Online</b></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link link " href="<?= base_url('C_index'); ?>">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link link" href="<?= base_url('C_index/panduan'); ?>">Panduan Lelang</a>
                        </li>
                        <li class="nav-item">
                            <?php if ($session) { ?>
                                <a class="nav-link link" href="<?= base_url('C_history'); ?>">History</a>
                            <?php } else { ?>
                                <a class="nav-link link" hidden href="<?= base_url('C_history'); ?>">History</a>
                            <?php } ?>
                        </li>
                        <li class="nav-item">
                            <?php if ($session) { ?>
                                <a class="nav-link link" href="<?= base_url('C_profile'); ?>">Profile</a>
                            <?php } else { ?>
                                <a class="nav-link link" hidden href="<?= base_url('C_profile'); ?>">Profile</a>
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
    </div>