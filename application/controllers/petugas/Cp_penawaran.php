<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cp_penawaran extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('M_penawaran');
        if (empty($this->session->userdata('id_petugas') && $this->session->userdata('petugas'))) {
            echo "<script>
            alert('Anda Tidak Memiliki Akses Ke Halaman Tersebut');
            window.location.href = '" . base_url('auth_petugas') . "';
        </script>";
            $this->session->sess_destroy();
        }
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        // $id = $this->db->query("SELECT * FROM tb_barang JOIN history_lelang ON tb_barang.id_barang=history_lelang.id_barang")->row_array();
        // $id_barang = $id['id_barang'];
        // $hitung = $this->db->query("SELECT COUNT(id_barang) AS jumlah FROM history_lelang WHERE id_barang = '$id_barang'")->row_array();
        // $data['jumlahp'] = $hitung['jumlah'];
        $data['tawar'] = $this->M_penawaran->get_data();
        $data['tselesai'] = $this->M_penawaran->get_selesai();
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar_petugas');
        $this->load->view('petugas/Vp_penawaran', $data);
        $this->load->view('template_admin/footer');
    }

    public function perbarang($id)
    {
        $data['title'] = 'Penawaran';
        $where = array('id_lelang' => $id);
        $tawar = $this->M_penawaran->get_tertinggi($where['id_lelang'], 'history_lelang');
        $data['tombol'] = $tawar['tertinggi'];
        $data['detail'] = $this->M_penawaran->get_detail($where['id_lelang'], 'tb_lelang');
        $data['tawaran'] = $this->M_penawaran->get_tawaran($where['id_lelang'], 'history_lelang');
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar_petugas');
        $this->load->view('petugas/Vp_perbarang', $data);
        $this->load->view('template_admin/footer');
    }

    public function pemenang($id)
    {
        date_default_timezone_set('Asia/Jakarta');
        $sekarang = date('Y-m-d H:i:s');
        $nanti = date("Y-m-d H:i:s", strtotime($sekarang . '+5 days'));
        $id = $this->input->post('id');
        $id_barang = $this->input->post('id_barang');
        $pemenang = $this->input->post('pemenang');

        $where = array(
            'id_user' => $pemenang
        );
        $telp = $this->M_penawaran->get_telp($where['id_user'], 'tb_masyarakat');
        $eml = $this->M_penawaran->get_email($where['id_user'], 'tb_masyarakat');
        $brg = $this->M_penawaran->get_nmBrg($id_barang, 'tb_barang');
        $kode = hexdec(uniqid());
        $kodes = substr($kode, 10, 4);
        $telepon = $kodes . $telp['telepon'];
        $email = $eml['eml'];
        $nama_brg = $brg['brg'];
        $tawaran = $this->input->post('tawaran');
        date_default_timezone_set('Asia/Jakarta');
        $tgl = date('Y-m-d H:i:s');
        $tanggal = $tgl;
        $status_lelang = 'ditutup';
        $status_barang = '3';
        $status_bayar = 'belum';

        $config = [
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'protocol'  => 'smtp',
            'smtp_host' => 'smtp.gmail.com',
            'smtp_user' => 'mochamadyusuf2002@gmail.com',
            'smtp_pass'   => 'mochamadyusuf2424',
            'smtp_crypto' => 'ssl',
            'smtp_port'   => 465,
            'crlf'    => "\r\n",
            'newline' => "\r\n"
        ];
        $this->load->library('email', $config);
        $this->email->from('mochamadyusuf2002@gmail.com', 'Lelangnesia');
        $this->email->to($email);
        // $this->email->attach('Masukan Kode OTP di atas pada Form Verifikasi');
        $this->email->subject('Pembayaran Lelang');


        $this->email->message('Selamat Anda Memenangkan Lelang <h2>' . $nama_brg . '</h2><br> Harap Segera Melakukan Pembayaran Pada Virtual Account :<br><h1>' . $telepon . '</h1><br><table class="table table-bordered"><tr><th><hr><h3>Cara Pembayaran</h3><hr></th></tr><tr><td>- Masuk Ke Aplikasi M-Banking Yang Anda Miliki</td></tr><tr><td>- Masukan Kode Virtual Account Diatas</td></tr><tr><td>- Cek Apakah Total Pembayaran Sama Dengan Tagihan Di Aplikasi Lelang</td></tr><tr><td>- Jika Dirasa Sudah Sama Lakukan Transfer</td></tr><tr><td><b>Pembayaran Akan Hangus Jika Melebihi Batas Waktu 5 Hari Setelah Menerima Email Ini</b></td></tr></table>');
        // $this->email->message('Selamat Anda Memenangkan Lelang <h2>' . $nama_brg . '</h2><br> Harap Segera Melakukan Pembayaran Pada Virtual Account :<br><h1>' . $telepon . '</h1><br><h3>Cara Pembayaran</h3><hr><br>- Masuk Ke Aplikasi M-Banking Yang Anda Miliki<br>- Masukan Kode Virtual Account Diatas<br>- Cek Apakah Total Pembayaran Sama Dengan Tagihan Di Aplikasi Lelang<br>- Jika Dirasa Sudah Sama Lakukan Transfer');

        if ($this->email->send()) {

            $data = array(
                'id_user' => $pemenang,
                'harga_akhir' => $tawaran,
                'status' => $status_lelang,
                'waktu_menang' => $tanggal
            );
            $where = array(
                'id_lelang' => $id
            );
            $this->M_penawaran->pemenang($where, $data, 'tb_lelang');

            $bayar = array(
                'id_user' => $pemenang,
                'id_lelang' => $id,
                'id_barang' => $id_barang,
                'jumlah_bayar' => $tawaran,
                'status_bayar' => $status_bayar,
                'va' => $telepon,
                'batas_bayar' => $nanti,
            );
            $this->M_penawaran->bayar($bayar, 'tb_pembayaran');

            $this->session->set_flashdata('pemenang', 'berhasil');
            echo "<script>
            window.location.href = '" . base_url('petugas/Cp_penawaran/perbarang/' . $id) . "';
        </script>";
        } else {
            $this->session->set_flashdata('tdkEmail', 'berhasil');
            echo "<script>
            window.location.href = '" . base_url('petugas/Cp_penawaran/perbarang/' . $id) . "';
        </script>";
            // echo 'Error! email tidak dapat dikirim.';
        }
    }

    // public function pemenang($id)
    // {
    //     date_default_timezone_set('Asia/Jakarta');
    //     $sekarang = date('Y-m-d H:i:s');
    //     $nanti = date("Y-m-d H:i:s", strtotime($sekarang . '+5 days'));
    //     $id = $this->input->post('id');
    //     $id_barang = $this->input->post('id_barang');
    //     $pemenang = $this->input->post('pemenang');

    //     $where = array(
    //         'id_user' => $pemenang
    //     );
    //     $telp = $this->M_penawaran->get_telp($where['id_user'], 'tb_masyarakat');
    //     $telepon = '112' . $telp['telepon'];
    //     $tawaran = $this->input->post('tawaran');
    //     date_default_timezone_set('Asia/Jakarta');
    //     $tgl = date('Y-m-d H:i:s');
    //     $tanggal = $tgl;
    //     $status_lelang = 'ditutup';
    //     $status_barang = '3';
    //     $status_bayar = 'belum';
    //     $data = array(
    //         'id_user' => $pemenang,
    //         'harga_akhir' => $tawaran,
    //         'status' => $status_lelang,
    //         'waktu_menang' => $tanggal
    //     );
    //     $where = array(
    //         'id_lelang' => $id
    //     );
    //     $this->M_penawaran->pemenang($where, $data, 'tb_lelang');

    //     $barang = array(
    //         'status_lelang' => $status_lelang,
    //         'status_barang' => $status_barang
    //     );
    //     $patokan = array(
    //         'id_barang' => $id_barang
    //     );
    //     $this->M_penawaran->update_barang($patokan, $barang, 'tb_barang');

    //     $bayar = array(
    //         'id_user' => $pemenang,
    //         'id_lelang' => $id,
    //         'id_barang' => $id_barang,
    //         'jumlah_bayar' => $tawaran,
    //         'status_bayar' => $status_bayar,
    //         'va' => $telepon,
    //         'batas_bayar' => $nanti,
    //     );
    //     $this->M_penawaran->bayar($bayar, 'tb_pembayaran');

    //     $this->session->set_flashdata('pemenang', 'berhasil');
    //     echo "<script>
    //         window.location.href = '" . base_url('petugas/Cp_penawaran/perbarang/' . $id) . "';
    //     </script>";
    // }

    public function pencarian()
    {
        $status = $this->input->get('status');
        $data['tawar'] = $this->M_penawaran->pencarian($status)->result_array();
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar_petugas');
        $this->load->view('petugas/Vp_penawaran', $data);
        $this->load->view('template_admin/footer');
    }
}
