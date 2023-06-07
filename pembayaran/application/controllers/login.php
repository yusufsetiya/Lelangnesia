<?php
defined('BASEPATH') or exit('No direct script access allowed');

class login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->Model('M_login');
    }

    public function index()
    {
        $data['title'] = 'Login';
        $this->load->view('login-reg/login', $data);
    }

    function proses_login()
    {
        $rekening = htmlspecialchars($this->input->post('rekening', TRUE), ENT_QUOTES);
        $kode = htmlspecialchars($this->input->post('kode', TRUE), ENT_QUOTES);

        $cek_masyarakat = $this->M_login->login($rekening, $kode);
        if ($cek_masyarakat->num_rows() > 0) {
            $data = $cek_masyarakat->row_array();
            $this->session->set_userdata('masuk', TRUE);
            $this->session->set_userdata('id_banking', $data['id_banking']);
            $this->session->set_userdata('rekening', $data['rekening']);
            $this->session->set_userdata('pin', $data['pin']);
            redirect('pembayaran');
        } else {  // jika username dan password tidak ditemukan atau salah
            $url = base_url('login/index');
            echo $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">No. Rekening Atau Kode Salah</div>');
            redirect($url);
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">anda telah logout</div>');
        redirect('login/index');
    }
}
