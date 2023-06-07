<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_laporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('M_laporan');
    }

    public function index()
    {
        $data['title'] = "Laporan";
        $data['laporan'] = $this->M_laporan->get_laporan();
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/V_laporan', $data);
        $this->load->view('template_admin/footer');
    }

    public function second()
    {
        $data['title'] = "Laporan";
        $data['laporan'] = $this->M_laporan->get_laporan();
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar_petugas');
        $this->load->view('petugas/Vp_laporan', $data);
        $this->load->view('template_admin/footer');
    }

    public function lihat()
    {
        $data['title'] = "Laporan";
        $mulai = $this->input->get('mulai');
        $selesai = $this->input->get('selesai');
        // $data['mulai'] = $mulai;
        // $data['selesai'] = $selesai;
        $filter = $this->M_laporan->get_tanggal($mulai, $selesai);
        $data['laporan'] = $filter;
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar_petugas');
        $this->load->view('petugas/Vp_laporan', $data);
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
}
