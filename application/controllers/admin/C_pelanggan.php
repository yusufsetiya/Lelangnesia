<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_pelanggan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('M_masyarakat');
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
        $data['title'] = 'Manage Masyarakat';
        $data['masyarakat'] = $this->M_masyarakat->get_masyarakat();
        $data['verif'] = $this->M_masyarakat->get_verif();
        $data['blokir'] = $this->M_masyarakat->get_blokir();
        $data['title'] = 'Manage Petugas';
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/V_pelanggan', $data);
        $this->load->view('template_admin/footer');
    }
    public function verif()
    {
        $data['title'] = 'Manage Petugas';
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/detail-verif');
        $this->load->view('template_admin/footer');
    }
    public function detail()
    {
        $data['title'] = 'Manage Petugas';
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/detail-pel');
        $this->load->view('template_admin/footer');
    }

    public function verifNew($id_user)
    {
        $id = $id_user;
        $verif = '2';

        $data = array(
            'verif' => $verif,
        );

        $where = array(
            'id_user' => $id
        );

        $this->M_masyarakat->verif($where, $data, 'tb_masyarakat');
        $this->session->set_flashdata('verif', 'berhasil');
        redirect('admin/C_pelanggan');
    }

    public function blokir()
    {
        $id = $this->input->post('id');
        $alasan = $this->input->post('alasan');
        $blokir = '3';

        $data = array(
            'verif' => $blokir,
            'alasan' => $alasan,
        );

        $where = array(
            'id_user' => $id
        );

        $this->M_masyarakat->verif($where, $data, 'tb_masyarakat');
        $this->session->set_flashdata('blokir', 'berhasil');
        redirect('admin/C_pelanggan');
    }

    public function buka()
    {
        $id = $this->input->post('id');
        $blokir = '2';

        $data = array(
            'verif' => $blokir,
        );

        $where = array(
            'id_user' => $id
        );

        $this->M_masyarakat->verif($where, $data, 'tb_masyarakat');
        $this->session->set_flashdata('buka', 'berhasil');
        redirect('admin/C_pelanggan');
    }

    public function hapus($id)
    {
        // $this->db->delete('tb_petugas', array('id_petugas' => $id));
        // echo 'Deleted successfully.';
        $_id = $this->db->get_where('tb_masyarakat', ['id_user' => $id])->row();
        $query = $this->db->delete('tb_masyarakat', ['id_user' => $id]);
        if ($query) {
            unlink("upload/profile/" . $_id->wajah);
        }
        if ($query) {
            unlink("upload/profile/" . $_id->ktp);
        }
        $this->M_masyarakat->hapus_data($id, 'tb_masyarakat');
        $this->session->set_flashdata('hapus', 'berhasil');
        redirect('admin/C_pelanggan');
    }
}
