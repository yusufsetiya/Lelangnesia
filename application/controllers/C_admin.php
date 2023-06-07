<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('M_admin');
        if (empty($this->session->userdata('logged_in'))) {
            redirect('C_login/', 'refresh');
        }
    }

    public function index()
    {
        // $data['total_barang'] = $this->model_admin->jumlahbarang();
        // $data['total_asset'] = $this->model_admin->hitungJumlahAsset();
        // $data['total_inventori'] = $this->model_admin->hitungJumlahInventori();
        $data['title'] = 'Peta';
        $titik['titik'] = $this->M_admin->tampil_titik()->result();
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('peta', $titik);
        $this->load->view('template_admin/footer');
    }

    public function save_password()
    {
        $this->form_validation->set_rules('new', 'Password Baru', 'required|trim|min_length[5]',  'Password Minimal 5 Karakter !');
        $this->form_validation->set_rules('re_new', 'Confirm Password', 'required|matches[new]');
        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Ubah Password';
            $this->load->view('template_admin/header', $data);
            $this->load->view('template_admin/sidebar');
            $this->load->view('V_ganti_pwd');
            $this->load->view('template_admin/footer');
        } else {
            $cek_old = $this->M_admin->cek_old();
            if ($cek_old == False) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password Lama Tidak Sama !</div>');
                $data['title'] = 'Ubah Password';
                $this->load->view('template_admin/header', $data);
                $this->load->view('template_admin/sidebar');
                $this->load->view('V_ganti_pwd');
                $this->load->view('template_admin/footer');;
            } else {
                $this->M_admin->save();
                $this->session->sess_destroy();
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password Sukses Dirubah Silahkan Login Kembali</div>');

                // redirect('C_login');
                $this->load->view('V_login');
            } //end if valid_user
        }
    }
}
