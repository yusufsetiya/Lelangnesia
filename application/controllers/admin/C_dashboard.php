<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('M_dashboard');
        if (empty($this->session->userdata('id_petugas') && $this->session->userdata('admin'))) {
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
        $tinggi = $this->M_dashboard->jumlah_barang();
        $data['barang'] = $tinggi['jumlah'];
        $dilelang = $this->M_dashboard->barang_dilelang();
        $data['dilelang'] = $dilelang['jumlah'];
        $petugas = $this->M_dashboard->petugas();
        $data['petugas'] = $petugas['jumlah'];
        $pelanggan = $this->M_dashboard->pelanggan();
        $data['pelanggan'] = $pelanggan['jumlah'];
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/dashboard_admin', $data);
        $this->load->view('template_admin/footer');
    }
}
