</body>

</html>

<script src="<?= base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url(); ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
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

        <?php if ($this->session->flashdata('bayar') == 'berhasil') : ?>
            swal({
                title: "Pembayaran Sukses",
                type: "success",
                closeOnConfirm: false,
                closeOnCancel: false
            });
        <?php endif; ?>
        <?php if ($this->session->flashdata('va_gaketemu') == 'berhasil') : ?>
            swal({
                title: "Gagal",
                text: "Nomor VA Tidak Ditemukan",
                type: "error",
                closeOnConfirm: false,
                closeOnCancel: false
            });
        <?php endif; ?>
    });

    var i = 0,
        text;
    text = "Selamat Datang DI Website Lelang Terpercaya Di Indonesia"

    function ketik() {
        if (i < text.length) {
            document.getElementById("text").innerHTML += text.charAt(i);
            i++;
            setTimeout(ketik, 80);
        }
    }
    ketik();
</script>