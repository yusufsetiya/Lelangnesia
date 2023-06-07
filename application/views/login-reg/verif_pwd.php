<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/vendor/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/style.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/vendor/sweetalert/sweetalert.css">
    <title><?= $title; ?></title>
</head>

<body class="loter">
    <div class="auth">

        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-7 col-lg-6 mt-5">
                    <div class="card login">
                        <div class="card-body">
                            <h2 class="mb-4"><i class="fa fa-email"></i>Verifikasi Akun</h2>
                            <hr>
                            <p class="alert alert-success ">Masukan Kode OTP Yang Sudah Dikirim Ke Email Anda</p>
                            <hr>
                            <h6><?= $this->session->flashdata('message'); ?></h6>
                            <form action="<?= base_url('C_login/verif_pwd'); ?>" method="post">
                                <input type="hidden" name="id_user" value="<?= $id; ?>">
                                <input type="hidden" name="email" value="<?= $email; ?>">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Kode OTP</label>
                                    <input type="text" class="form-control" name="kode" aria-describedby="emailHelp" autocomplete="off">
                                </div>
                                <div class="form-group mt-4">
                                    <button type="submit" class="btn btn-primary form-control">Verifikasi</button>
                                </div>
                                <!-- <p><a href="<?= base_url('C_login/index'); ?>"><i class="fa fa-chevron-left"></i> Kembali Ke Halaman Login</a></p> -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="row content">
                <div class="col-md-6">
                    <img src="<?= base_url(); ?>assets/img/bid.png" class="img-fluid" alt="image" />
                </div>
                <div class="col-md-6">
                    <h3 class="signin-text mb-3">Login</h3>
                    <form action="">
                        <br />
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="username" name="username" class="form-control-1" />
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control-1" />
                        </div>
                        <a href="<?= base_url('C_login/register'); ?>" class="signup-link">Create an Account</a><br><br>
                        <button class="btn btn-class">Login</button>
                    </form>
                </div>
            </div> -->
        </div>
    </div>
</body>

</html>
<script src="<?= base_url(); ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="<?= base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url(); ?>assets/vendor/sweetalert/sweetalert.min.js"></script>
<script src="<?= base_url(); ?>assets/vendor/sweetalert/sweetalert-dev.js"></script>

<script>
    $(document).ready(function() {
        <?php if ($this->session->flashdata('gakKetemu') == 'berhasil') : ?>
            swal({
                title: "Akun Tidak Ditemukan",
                text: 'Cek Kembali Username Dan Telepon Anda',
                type: "warning",
                confirmButtonColor: '#3085d6',
                closeOnConfirm: false,
                closeOnCancel: false
            });
        <?php endif; ?>
        <?php if ($this->session->flashdata('ditemukan') == 'berhasil') : ?>
            swal({
                title: "Akun Ditemukan",
                text: 'Silahkan Cek Email Anda',
                type: "success",
                confirmButtonColor: '#3085d6',
                closeOnConfirm: false,
                closeOnCancel: false
            });
        <?php endif; ?>
        <?php if ($this->session->flashdata('gaksama') == 'berhasil') : ?>
            swal({
                title: "Kode Tidak Sama",
                text: 'Silahkan Cek Kembali Kode Anda',
                type: "warning",
                confirmButtonColor: '#3085d6',
                closeOnConfirm: false,
                closeOnCancel: false
            });
        <?php endif; ?>
    });
</script>