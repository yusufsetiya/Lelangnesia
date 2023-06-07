<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembayaran extends CI_Controller
{

    public function index()
    {
        $data['title'] = 'Pembayaran';
        $this->load->view('template_user/header', $data);
        $this->load->view('pembayaran');
        $this->load->view('template_user/footer');
    }

    public function transfer()
    {
        $data['title'] = 'Detail Pembayaran';
        $this->load->view('template_user/header', $data);
        $this->load->view('dt_pembayaran');
        $this->load->view('template_user/footer');
    }
}
