<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_index extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('M_dashboard');
        $this->load->model('M_penawaran');
    }

    public function index()
    {
        $batas = $this->M_dashboard->get_barang();
        foreach ($batas as $waktu) {
            date_default_timezone_set('Asia/Jakarta');
            $sekarang = date('Y-m-d H:i:s');
            if (date('Y-m-d H:i:s', strtotime($waktu->batas)) == $sekarang || date('Y-m-d H:i:s', strtotime($waktu->batas)) <= $sekarang) {
                $id = $waktu->id_barang;
                $this->M_dashboard->tutup_lelang($id);
                $this->M_dashboard->tbLelang_tutup($id);
            }
        }
        $data['session'] = $this->session->userdata('id_masyarakat');
        $verif = $this->session->userdata('id_masyarakat');
        $sql = $this->db->query("SELECT * FROM tb_pembayaran where id_user='$verif' AND status_bayar='belum'")->result();
        $data['notif'] = $sql;
        $data['barang'] = $this->M_dashboard->get_barang();
        $data['title'] = "Dashboard";
        $this->load->view('template_user/header', $data);
        $this->load->view('dashboard', $data);
        $this->load->view('template_user/footer');
    }

    public function detail($id)
    {
        // $batas = $this->M_dashboard->get_barang();
        // foreach ($batas as $waktu) {
        //     date_default_timezone_set('Asia/Jakarta');
        //     $sekarang = date('Y-m-d H:i:s');
        //     if (date('Y-m-d H:i:s', strtotime($waktu->batas)) == $sekarang || date('Y-m-d H:i:s', strtotime($waktu->batas)) <= $sekarang) {
        //         $id = $waktu->id_barang;
        //         $this->M_dashboard->tutup_lelang($id);
        //         $this->M_dashboard->tbLelang_tutup($id);
        //     }
        // }
        $data['title'] = "Detail";
        $data['session'] = $this->session->userdata('id_masyarakat');
        $verif = $this->session->userdata('id_masyarakat');
        $where = array('id_barang' => $id);
        $jika = $where['id_barang'];
        $sql = $this->db->query("SELECT * FROM tb_pembayaran where id_user='$verif' AND status_bayar='belum'")->result();
        $data['disable'] = $sql;
        $waktu = $this->db->query("SELECT batas AS bts FROM tb_lelang where id_barang='$id'")->row_array();
        $data['waktune'] = $waktu['bts'];
        $data['profile'] = $this->db->get_where('tb_masyarakat', ['id_user' => $verif])->row();
        $data['detail'] = $this->M_dashboard->detail_barang($where['id_barang'], 'tb_barang')->result();
        $data['tawar'] = $this->M_dashboard->get_tawaran($where['id_barang'], 'history_lelang')->result();
        $tinggi = $this->M_dashboard->get_tertinggi($where['id_barang'], 'history_lelang');
        $data['tinggi'] = $tinggi['tertinggi'];
        $this->load->view('template_user/header', $data);
        $this->load->view('template_user/navigation', $data);
        $this->load->view('detail', $data);
        $this->load->view('template_user/footer', $data);
    }

    public function tawar()
    {
        $pelanggan =  $this->session->userdata('id_masyarakat');
        $nominal = $this->input->post('penawaran');
        $id_lelang = $this->input->post('id_lelang');
        $id_barang = $this->input->post('id_barang');

        $data = array(
            'id_lelang' => $id_lelang,
            'penawaran_harga' => $nominal,
            'id_user' => $pelanggan,
            'id_barang' => $id_barang
        );

        $this->M_penawaran->user_tawar($data, 'history_lelang');

        $data = $this->session->userdata('id_masyarakat');
        $this->session->set_flashdata('tawar', 'berhasil');
        redirect('C_index/detail/' . $id_barang);
    }

    public function panduan()
    {
        $data['title'] = "Panduan";
        $data['session'] = $this->session->userdata('id_masyarakat');
        $this->load->view('template_user/header', $data);
        $this->load->view('template_user/navigation', $data);
        $this->load->view('panduan');
        $this->load->view('template_user/footer');
    }

    public function dtBayar($id)
    {
        $data['title'] = "Detail";
        $data['session'] = $this->session->userdata('id_masyarakat');
        $where = array('id_lelang' => $id);
        $data['dtBayar'] = $this->M_dashboard->get_dtBayar($where['id_lelang'], 'tb_lelang');
        $this->load->view('template_user/header', $data);
        $this->load->view('template_user/navigation');
        $this->load->view('dt_bayar', $data);
        $this->load->view('template_user/footer');
    }
    public function dtBayarsc($id)
    {
        $data['title'] = "Detail";
        $data['session'] = $this->session->userdata('id_masyarakat');
        $where = array('id_lelang' => $id);
        $data['dtSukses'] = $this->M_dashboard->get_dtBayar($where['id_lelang'], 'tb_lelang');
        $this->load->view('template_user/header', $data);
        $this->load->view('template_user/navigation');
        $this->load->view('dt_bayar-sc', $data);
        $this->load->view('template_user/footer');
    }
    public function bukti()
    {
        $data['title'] = "Detail";
        $data['session'] = $this->session->userdata('id_masyarakat');
        $this->load->view('template_user/header', $data);
        $this->load->view('template_user/navigation');
        $this->load->view('bukti');
        $this->load->view('template_user/footer');
    }

    public function get_batas()
    {
        $batas = $this->input->post('penawaran');
        $hasil = $this->M_login->get_emails($batas);

        echo $hasil;
    }
}
