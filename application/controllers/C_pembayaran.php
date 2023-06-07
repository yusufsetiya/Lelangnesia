<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_pembayaran extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->Model('M_pembayaran');
    }

    public function index()
    {
        $data['title'] = "Pembayaran";
        date_default_timezone_set('Asia/Jakarta');
        $sekarang = date('Y-m-d H:i:s');
        // $ambil = $this->db->query("SELECT batas_bayar FROM tb_pembayaran WHERE batas_bayar='$sekarang'");

        $jam = $this->M_pembayaran->get_ambil($sekarang);
        $data['waktu'] = $jam['jam'];
        $data['bayar'] = $this->M_pembayaran->get_bayar();
        $data['lunas'] = $this->M_pembayaran->get_lunas();
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar', $data);
        $this->load->view('admin/V_pembayaran', $data);
        $this->load->view('template_admin/footer');
    }
    public function petugas()
    {
        $data['title'] = "Pembayaran";
        date_default_timezone_set('Asia/Jakarta');
        $sekarang = date('Y-m-d H:i:s');
        // $ambil = $this->db->query("SELECT batas_bayar FROM tb_pembayaran WHERE batas_bayar='$sekarang'");

        $jam = $this->M_pembayaran->get_ambil($sekarang);
        $data['waktu'] = $jam['jam'];
        $data['bayar'] = $this->M_pembayaran->get_bayar();
        $data['lunas'] = $this->M_pembayaran->get_lunas();
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar_petugas', $data);
        $this->load->view('petugas/Vp_pembayaran', $data);
        $this->load->view('template_admin/footer');
    }

    public function batal_menang()
    {
        $id = $this->input->post('id');
        $_id = $this->db->get_where('tb_pembayaran', ['id_barang' => $id])->row();
        $query = $this->db->delete('tb_pembayaran', ['id_barang' => $id]);
        $this->M_pembayaran->hapus_data($id, 'tb_pembayaran');
        $this->M_pembayaran->hapus_tawaran($id, 'history_lelang');

        $harga_akhir = '';

        $lelang = array(
            'harga_akhir' => $harga_akhir,
        );

        $where = array(
            'id_barang' => $id
        );
        $this->M_pembayaran->update_lelang($where, $lelang, 'tb_lelang');
        $this->session->set_flashdata('Bmenang', 'berhasil');
        redirect('C_pembayaran/index');
    }

    public function batal_menangp()
    {
        $id = $this->input->post('id');
        $id_user = $this->input->post('id_user');
        $_id = $this->db->get_where('tb_pembayaran', ['id_barang' => $id])->row();
        $query = $this->db->delete('tb_pembayaran', ['id_barang' => $id]);
        $this->M_pembayaran->hapus_data($id, 'tb_pembayaran');
        $this->M_pembayaran->hapus_tawaran($id_user, $id, 'history_lelang');

        $harga_akhir = '';
        $id_pemenang = '';
        $status_barang = '1';

        $lelang = array(
            'harga_akhir' => $harga_akhir,
            'id_user' => $id_pemenang,
        );

        $barang = array(
            'status_barang' => $status_barang,
        );

        $where = array(
            'id_barang' => $id
        );
        $this->M_pembayaran->update_lelang($where, $lelang, 'tb_lelang');
        $this->M_pembayaran->update_barangb($where, $barang, 'tb_barang');
        $this->session->set_flashdata('Bmenang', 'berhasil');
        redirect('C_pembayaran/petugas');
    }
}
