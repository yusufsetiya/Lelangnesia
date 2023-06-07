<div class="footer mt-4">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <p class="mt-3 f">&copy; Copyright 2021 All Rights Reserved</p>
            </div>
            <div class="col-md-6 text-right">
                <p class="mt-3 f"> Designed By <b>Mochamad Yusuf</b></p>
            </div>
        </div>

    </div>
</div>
</body>

</html>

<script src="<?= base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url(); ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="<?= base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url(); ?>assets/vendor/sweetalert/sweetalert.min.js"></script>
<script src="<?= base_url(); ?>assets/vendor/sweetalert/sweetalert-dev.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>assets/vendor/countdown/jquery.countdown.js"></script>
<script src="<?= base_url(); ?>assets/vendor/elevatezoom/jquery.elevatezoom.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#tawaran').DataTable();
    });
    $(document).ready(function() {
        $('#p_bayar').DataTable();
    });
    $(document).ready(function() {
        $('#lunas').DataTable();
    });
    $(document).ready(function() {
        $("#detail-img").elevateZoom({
            scrollZoom: true
        });

    });
</script>

<script>
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

<script>
    $(document).ready(function() {
        $('.form-checkbox').click(function() {
            if ($(this).is(':checked')) {
                $('.form-password').attr('type', 'text');
            } else {
                $('.form-password').attr('type', 'password');
            }
        });

        <?php if ($this->session->flashdata('tawar') == 'berhasil') : ?>
            swal({
                title: "Tawaran Terkirim",
                text: 'Silahkan Menunggu Pesan Dari Email Jika Anda Memenangkan Barang Ini',
                type: "success",
                confirmButtonColor: '#3085d6',
                closeOnConfirm: false,
                closeOnCancel: false
            });
        <?php endif; ?>

        <?php if ($this->session->flashdata('telat') == 'berhasil') : ?>
            swal({
                title: "Melebihi Batas Waktu",
                text: 'Barang Hangus Karena Melebihi Batas Waktu Pembayaran',
                type: "warning",
                confirmButtonColor: '#3085d6',
                closeOnConfirm: false,
                closeOnCancel: false
            });
        <?php endif; ?>

        $('#only-number').on('keydown', '#telepons', function(e) {
            -1 !== $
                .inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) || /65|67|86|88/
                .test(e.keyCode) && (!0 === e.ctrlKey || !0 === e.metaKey) ||
                35 <= e.keyCode && 40 >= e.keyCode || (e.shiftKey || 48 > e.keyCode || 57 < e.keyCode) &&
                (96 > e.keyCode || 105 < e.keyCode) && e.preventDefault()
        });
        var minChar = 12;
        $("#telepons").keyup(function() {
            var telepon = $(this).val();
            var jmlChar = $("#telepons").val().length;

            if (jmlChar > minChar) {
                // $("berikut").css('display', 'none');
                $('#telepons').css('border-color', 'red');
                $('#simpan').prop('disabled', true);
            } else {
                $('#telepons').css('border-color', 'green');
                $('#min-telepon').css('display', 'hidden');
                $('#simpan').prop('disabled', false);

            }

            // value = {
            //     'telepon': telepon;
            // }
            // $.ajax({

            // })

        });

        var countdown = $('#countdown').val();
        $('#peringatan-lelang').css('display', 'none')
        $('#hitung-mundur').countdown(countdown, function(event) {
            $(this).text(
                event.strftime('%D Hari %H:%M:%S')
            );

            var waktu = $('#hitung-mundur').html();
            if (waktu == '00 Hari 00:00:00') {
                $('#hitung-mundur').html('Waktu Habis')
                $('#penawaran').css('display', 'none')
                $('#peringatan-lelang').css('display', 'flex')
            }

        });
    });
</script>