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
                <div class="col-md-7 col-lg-8">
                    <div class="card login">
                        <div class="card-body">
                            <div class="logo">

                            </div>
                            <h2 class="mb-3"> <i class="fa fa-opencart"></i> Sign Up</h2>
                            <hr class="mt-4">
                            <p class="text-center loginj ">Harap Data Diri Diisi Sesuai dengan KTP</p>
                            <hr>
                            <?php
                            if (isset($_POST['url'])) {
                                $url = $_POST['url'];
                            } else {
                                $url = 'pertama';
                            }
                            switch ($url) {
                                case 'kedua':
                                    $nama = $_POST['nama'];
                                    $nik = $_POST['nik'];
                                    $tpt_lahir = $_POST['tpt_lahir'];
                                    $tgl = $_POST['tgl'];
                            ?>
                                    <form action="<?= base_url(); ?>C_login/register" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="nama" value="<?= $nama; ?>">
                                        <input type="hidden" name="nik" value="<?= $nik; ?>">
                                        <input type="hidden" name="tpt_lahir" value="<?= $tpt_lahir; ?>">
                                        <input type="hidden" name="tgl" value="<?= $tgl; ?>">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Gender</label>
                                            <select name="gender" id="" class="form-control">
                                                <option value="Laki-Laki" name="gender">Laki-Laki</option>
                                                <option value="Perempuan" name="gender">Perempuan</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Alamat</label>
                                            <textarea name="alamat" id="" cols="30" rows="2" class="form-control"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Telepon</label>
                                            <input type="text" class="form-control" name="telepon" aria-describedby="emailHelp">
                                        </div>

                                        <div class="form-group mt-4 text-right">
                                            <button type="submit" name='url' value="ketiga" class="btn btn-primary">Selanjutnya</button>
                                        </div>
                                        <p>Sudah Punya Akun ? <a href="<?= base_url('C_login/index'); ?>">Masuk</a></p>
                                    </form>
                                    <?php break; ?>
                                <?php
                                case 'ketiga':
                                    $nama = $_POST['nama'];
                                    $nik = $_POST['nik'];
                                    $tpt_lahir = $_POST['tpt_lahir'];
                                    $tgl = $_POST['tgl'];
                                    $gender = $_POST['gender'];
                                    $telepon = $_POST['telepon'];
                                    $alamat = $_POST['alamat'];
                                ?>
                                    <form action="<?= base_url('C_login/proses_regis'); ?>" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="nama" value="<?= $nama; ?>">
                                        <input type="hidden" name="nik" value="<?= $nik; ?>">
                                        <input type="hidden" name="tpt_lahir" value="<?= $tpt_lahir; ?>">
                                        <input type="hidden" name="tgl" value="<?= $tgl; ?>">
                                        <input type="hidden" name="gender" value="<?= $gender; ?>">
                                        <input type="hidden" name="alamat" value="<?= $alamat; ?>">
                                        <input type="hidden" name="telepon" value="<?= $telepon; ?>">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Foto Wajah</label>
                                                    <input type="file" class="form-control" name="wajah" aria-describedby="emailHelp">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Foto KTP</label>
                                                    <input type="file" class="form-control" name="ktp" aria-describedby="emailHelp">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Username</label>
                                            <input type="text" class="form-control" name="username" aria-describedby="emailHelp">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Password</label>
                                            <input type="password" class="form-control form-password" name="password"><br>
                                            <input type="checkbox" name="tampil" class="form-checkbox"> Tampil Password
                                        </div>
                                        <div class="form-group mt-4 text-right">
                                            <button type="submit" class="btn btn-success form-control">Sign Up</button>
                                        </div>

                                    </form>
                                    <?php break; ?>
                                <?php
                                default:
                                ?>
                                    <form action="<?= base_url(); ?>C_login/register" method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nama Lengkap</label>
                                            <input type="text" class="form-control" name="nama" aria-describedby="emailHelp">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">NIK</label>
                                            <input type="text" class="form-control" name="nik" aria-describedby="emailHelp">
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Tempat Lahir</label>
                                                    <input type="text" class="form-control" name="tpt_lahir" aria-describedby="emailHelp">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Tanggal Lahir</label>
                                                    <input type="date" class="form-control" name="tgl" aria-describedby="emailHelp">
                                                </div>
                                            </div>
                                        </div>



                                        <div class="form-group mt-4 text-right">
                                            <button type="submit" name='url' value="kedua" class="btn btn-primary">Selanjutnya</button>
                                        </div>
                                        <p>Sudah Punya Akun ? <a href="<?= base_url('C_login/index'); ?>">Masuk</a></p>
                                    </form>
                            <?php break;
                            } ?>
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