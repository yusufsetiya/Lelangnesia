<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_history extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('M_pembayaran');
        // if (empty($this->session->userdata('logged_in'))) {
        //     redirect('C_login/', 'refresh');
        // }
    }

    public function index()
    {
        $id = $this->session->userdata('id_masyarakat');
        $wBayar = $this->M_pembayaran->W_bayar($id);
        foreach ($wBayar as $waktu) {
            date_default_timezone_set('Asia/Jakarta');
            $sekarang = date('Y-m-d H:i:s');
            if (date('Y-m-d H:i:s', strtotime($waktu->batas_bayar)) == $sekarang || date('Y-m-d H:i:s', strtotime($waktu->batas_bayar)) <= $sekarang) {
                $id = $waktu->id_barang;
                $status_barang = '1';
                $id_user = '';

                $barang = array(
                    'status_barang' => $status_barang,
                );

                $lelang = array(
                    'id_user' => $id_user,
                );

                $where = array(
                    'id_barang' => $id
                );
                $this->M_pembayaran->update_barang($where, $barang, 'tb_barang');
                $this->M_pembayaran->update_lelang($where, $lelang, 'tb_lelang');
                $this->session->set_flashdata('telat', 'berhasil');
            }
        }
        $data['title'] = "History";
        $data['session'] = $this->session->userdata('id_masyarakat');
        $id_user = $this->session->userdata('id_masyarakat');
        $data['perbayar'] = $this->M_pembayaran->get_perbayar($id_user);
        $data['sukses'] = $this->M_pembayaran->get_sukses($id_user);
        $this->load->view('template_user/header', $data);
        $this->load->view('template_user/navigation', $data);
        $this->load->view('history', $data);
        $this->load->view('template_user/footer');
    }
}
