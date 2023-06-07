<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/vendor/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/style.css">
    <title><?= $title; ?></title>
</head>

<body class="loter">
    <div class="auth">

        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-7 col-lg-6 mt-5">
                    <div class="card login">
                        <div class="card-body">
                            <h2 class="mb-5"><i class="fa fa-money"></i> M-Banking</h2>
                            <h5><?= $this->session->flashdata('message'); ?></h5>
                            <form action="<?= base_url('login/proses_login'); ?>" method="post">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">No Rekening</label>
                                    <input type="username" class="form-control" name="rekening" aria-describedby="emailHelp">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Kode Akses</label>
                                    <input type="password" class="form-control form-password" name="kode"><br>
                                    <input type="checkbox" name="tampil_pwd" class="form-checkbox"> Tampil Password
                                </div>
                                <div class="form-group my-4">
                                    <button type="submit" class="btn btn-primary form-control">Sign In</button>
                                </div>
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
</script>