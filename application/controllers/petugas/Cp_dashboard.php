<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cp_dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('M_dashboard');
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
        $id_petugas = $this->session->userdata('id_petugas');
        $tinggi = $this->M_dashboard->jumlah_barang();
        $data['barang'] = $tinggi['jumlah'];
        $dilelang = $this->M_dashboard->barang_dilelang();
        $data['dilelang'] = $dilelang['jumlah'];
        $bayar = $this->M_dashboard->bayar();
        $data['bayar'] = $bayar['jumlah'];
        $sql = $this->db->query("SELECT telepon AS telp FROM tb_petugas where id_petugas='$id_petugas'")->row_array();
        $data['telepon'] = $sql['telp'];
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar_petugas');
        $this->load->view('petugas/dashboard_petugas', $data);
        $this->load->view('template_admin/footer');
    }

    public function cetak($mulai, $selesai)
    {
        $data['title'] = 'Cetak Laporan';
        // $mulai = $this->input->post('mulai');
        // $selesai = $this->input->post('selesai');
        $data['mulai'] = $mulai;
        $data['selesai'] = $selesai;
        // $data['hasil'] = $this->$this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/header', $data);
        $this->load->view('petugas/cetak_laporan', $data);
        $this->load->view('template_admin/footer');
    }

    public function nomor()
    {
        $id_petugas = $this->session->userdata('id_petugas');
        $nomor = $this->input->post('nomor');

        $data = array(
            'telepon' => $nomor
        );

        $where = array(
            'id_petugas' => $id_petugas
        );

        $this->M_dashboard->telepon($where, $data, 'tb_petugas');
        $this->session->set_flashdata('ubahNomor', 'berhasil');
        echo "<script>
        window.location.href = '" . base_url('petugas/Cp_dashboard') . "';
    </script>";
    }
}
