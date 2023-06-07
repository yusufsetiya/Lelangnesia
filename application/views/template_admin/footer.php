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
<script src="<?= base_url(); ?>assets/vendor/elevatezoom/jquery.elevatezoom.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#petugas').DataTable();
    });

    $(document).ready(function() {
        $('#barang').DataTable();
    });

    $(document).ready(function() {
        $('#b_verif').DataTable();
    });
    $(document).ready(function() {
        $('#verif').DataTable();
    });
    $(document).ready(function() {
        $('#blokir').DataTable();
    });
    $(document).ready(function() {
        $('#p_bayar').DataTable();
    });
    $(document).ready(function() {
        $('#lunas').DataTable();
    });
    $(document).ready(function() {
        $('#penawaran').DataTable();
    });
    $(document).ready(function() {
        $('#terjual').DataTable();
    });
    $(document).ready(function() {
        $('#tawaran').DataTable();
    });
    $(document).ready(function() {
        $('#laporan').DataTable();
    });

    $(document).ready(function() {
        $("#detail-ktp").elevateZoom({

        });
        // $("#detail-ktp").elevateZoom({
        //     zoomType: "inner",
        //     cursor: "crosshair",
        // });
    });
</script>

<script type="text/javascript">
    function toggleMenu() {
        let navigation = document.querySelector('.navigation');
        let toggle = document.querySelector('.toggle');
        let konten = document.querySelector('.konten');
        let user = document.querySelector('.user');
        navigation.classList.toggle('active');
        toggle.classList.toggle('active');
        konten.classList.toggle('geser');
        user.classList.toggle('slide');
    }

    $(document).ready(function() {
        $('.form-checkbox').click(function() {
            if ($(this).is(':checked')) {
                $('.form-password').attr('type', 'text');
            } else {
                $('.form-password').attr('type', 'password');
            }
        });

        <?php if ($this->session->flashdata('updateBarang') == 'berhasil') : ?>
            swal({
                title: "Update Sukses",
                text: 'Data Berhasil Di Update',
                type: "success",
                confirmButtonColor: '#3085d6',
                closeOnConfirm: false,
                closeOnCancel: false
            });
        <?php endif; ?>

        <?php if ($this->session->flashdata('openlelang') == 'berhasil') : ?>
            swal({
                title: "Lelang Sukses",
                text: 'Lelang Berhasil Dimulai',
                type: "success",
                confirmButtonColor: '#3085d6',
                closeOnConfirm: false,
                closeOnCancel: false
            });
        <?php endif; ?>

        <?php if ($this->session->flashdata('tutuplelang') == 'berhasil') : ?>
            swal({
                title: "Sukses",
                text: 'Lelang Berhasil DItutup',
                type: "success",
                confirmButtonColor: '#3085d6',
                closeOnConfirm: false,
                closeOnCancel: false
            });
        <?php endif; ?>

        <?php if ($this->session->flashdata('pemenang') == 'berhasil') : ?>
            swal({
                title: "Sukses",
                text: 'Berhasil Pilih Pemenang',
                type: "success",
                confirmButtonColor: '#3085d6',
                closeOnConfirm: false,
                closeOnCancel: false
            });
        <?php endif; ?>

        <?php if ($this->session->flashdata('blokir') == 'berhasil') : ?>
            swal({
                title: "Sukses",
                text: 'Pelanggan Berhasil Di Blokir',
                type: "success",
                confirmButtonColor: '#3085d6',
                closeOnConfirm: false,
                closeOnCancel: false
            });
        <?php endif; ?>

        <?php if ($this->session->flashdata('buka') == 'berhasil') : ?>
            swal({
                title: "Sukses",
                text: 'Blokir Berhasil Dibuka',
                type: "success",
                confirmButtonColor: '#3085d6',
                closeOnConfirm: false,
                closeOnCancel: false
            });
        <?php endif; ?>

        <?php if ($this->session->flashdata('hapus') == 'berhasil') : ?>
            swal({
                title: "Sukses",
                text: 'Pelanggan Berhasil Dihapus',
                type: "success",
                confirmButtonColor: '#3085d6',
                closeOnConfirm: false,
                closeOnCancel: false
            });
        <?php endif; ?>

        <?php if ($this->session->flashdata('verif') == 'berhasil') : ?>
            swal({
                title: "Sukses",
                text: 'Berhasil Verifikasi',
                type: "success",
                confirmButtonColor: '#3085d6',
                closeOnConfirm: false,
                closeOnCancel: false
            });
        <?php endif; ?>

        <?php if ($this->session->flashdata('tambah') == 'berhasil') : ?>
            swal({
                title: "Sukses",
                text: 'Barang Berhasil Ditambahkan',
                type: "success",
                confirmButtonColor: '#3085d6',
                closeOnConfirm: false,
                closeOnCancel: false
            });
        <?php endif; ?>

        <?php if ($this->session->flashdata('Hbarang') == 'berhasil') : ?>
            swal({
                title: " Hapus Sukses",
                text: 'Barang Berhasil Dihapus',
                type: "success",
                confirmButtonColor: '#3085d6',
                closeOnConfirm: false,
                closeOnCancel: false
            });
        <?php endif; ?>
        <?php if ($this->session->flashdata('Bmenang') == 'berhasil') : ?>
            swal({
                title: " Sukses",
                text: 'Pemenang Berhasil Dibatalkan',
                type: "success",
                confirmButtonColor: '#3085d6',
                closeOnConfirm: false,
                closeOnCancel: false
            });
        <?php endif; ?>
        <?php if ($this->session->flashdata('ubahNomor') == 'berhasil') : ?>
            swal({
                title: " Sukses",
                text: 'Nomor WhatsApp Berhasil Diubah',
                type: "success",
                confirmButtonColor: '#3085d6',
                closeOnConfirm: false,
                closeOnCancel: false
            });
        <?php endif; ?>
        <?php if ($this->session->flashdata('salahFormat') == 'berhasil') : ?>
            swal({
                title: " Gagal",
                text: 'File Yang Di Inputkan Harus Berupa Gambar',
                type: "error",
                confirmButtonColor: '#3085d6',
                closeOnConfirm: false,
                closeOnCancel: false
            });
        <?php endif; ?>
        <?php if ($this->session->flashdata('tdkEmail') == 'berhasil') : ?>
            swal({
                title: "Terjadi Kesalahan",
                text: 'Pemenang Gagal Dipilih, Periksa Jaringan Anda',
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

        $('#peringatan-username').css('display', 'none');
        $("#username").keyup(function() {
            var username = $(this).val();

            value = {
                'username': username
            }

            $.ajax({
                url: "<?php echo base_url(); ?>admin/C_petugas/get_username",
                type: "POST",
                data: value,
                success: function(data, textStatus, jqXHR) {
                    var datas = jQuery.parseJSON(data);
                    if (datas.result == 1) {
                        $('#username').css('border-color', 'red');
                        $('#peringatan-username').css('display', 'flex');
                        $('#simpan').prop('disabled', true);
                    } else {
                        $('#username').css('border-color', 'green');
                        $('#peringatan-username').css('display', 'none');
                        $('#simpan').prop('disabled', false);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    $('#username').css('border-color', 'red');
                    $('#simpan').prop('disabled', true);

                    value = null;
                }
            })
        });

    });

    $(".remove").click(function() {
        var id_petugas = $(this).parents("tr").attr("id");

        swal({
                title: "Apakah Anda Yakin?",
                text: "Anda tidak bisa melihat data setelah dihapus ! ",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Hapus Data !",
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                cancelButtonText: "Tidak !",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: '<?= base_url('admin/C_petugas/hapus/'); ?>' + id_petugas,
                        type: 'post',
                        error: function() {
                            alert('Something is wrong');
                        },
                        success: function(data) {
                            $("#" + id_petugas).remove();
                            swal("Terhapus!", "Berhasil Dihapus.", "success");
                            location.reload();
                        }
                    });
                } else {
                    swal("Batal", "Anda Membatalkan Penghapusan", "error");
                }
            });

    });

    $(".verif").click(function() {
        var id_user = $(this).data('id');
        swal({
            title: "Sukses Verifikasi",
            type: "success",
            closeOnConfirm: false,
            closeOnCancel: false
        });

        // Swal("Our First Alert", "With some body text and success icon!", "success");
    });
</script>
<script>
    $(".check-item").on("click", function() {
        if ($(".check-item:checked").length < 2) {
            $('.action-cetak').prop('disabled', false);
        } else {
            $('.action-cetak').prop('disabled', true);
        }
    });

    $(".action-cetak").on("click", function() {
        window.print();
    })
</script>