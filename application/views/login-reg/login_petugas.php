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
                            <h2 class="mb-4 text-dark"> Login Petugas</h2>
                            <hr>
                            <h6><?= $this->session->flashdata('message'); ?></h6>
                            <form action="<?= base_url('auth_petugas/proses_login'); ?>" method="post">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Username</label>
                                    <input type="username" class="form-control" name="username" aria-describedby="emailHelp" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input type="password" class="form-control form-password" name="password" autocomplete="off"><br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="checkbox" name="tampil_pwd" class="form-checkbox"> Tampil Password
                                        </div>

                                    </div>
                                </div>
                                <div class="form-group my-4">
                                    <button type="submit" class="btn btn-secondary form-control">Sign In</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

            </div>
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
        $('.form-checkbox').click(function() {
            if ($(this).is(':checked')) {
                $('.form-password').attr('type', 'text');
            } else {
                $('.form-password').attr('type', 'password');
            }
        });
    });

    <?php if ($this->session->flashdata('berhasil') == 'berhasil') : ?>
        swal({
            title: "Password Berhasil Dirubah",
            text: 'Silahkan Login Degan Password Baru Anda',
            type: "success",
            confirmButtonColor: '#3085d6',
            closeOnConfirm: false,
            closeOnCancel: false
        });
    <?php endif; ?>
    <?php if ($this->session->flashdata('pwdSalah') == 'berhasil') : ?>
        swal({
            title: "Gagal",
            text: 'Username Atau Password Anda Salah',
            type: "warning",
            confirmButtonColor: '#3085d6',
            closeOnConfirm: false,
            closeOnCancel: false
        });
    <?php endif; ?>
</script>