<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_petugas extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('M_petugas');
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
        $data['title'] = 'Manage Petugas';
        $data['level'] = $this->M_petugas->get_level();
        $data['petugas'] = $this->M_petugas->get_petugas();
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/V_petugas', $data);
        $this->load->view('template_admin/footer');
    }

    public function tambah()
    {
        $nama = $this->input->post('nama');
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));
        $V_password = $this->input->post('password');
        $level = $this->input->post('level');
        $delete = '1';

        $data = array(
            'nama_petugas' => $nama,
            'username' => $username,
            'password' => $password,
            'V_password' => $V_password,
            'id_level' => $level,
            'is_delete' => $delete
        );

        $this->M_petugas->tambah_petugas($data, 'tb_petugas');
        echo "<script>
        window.location.href = '" . base_url('admin/C_petugas') . "';
    </script>";
    }

    public function edit()
    {
        $id = $this->input->post('id_petugas');
        $nama = $this->input->post('nama');
        $username = $this->input->post('username');
        $password = MD5($this->input->post('password'));
        $V_password = $this->input->post('password');

        $data = array(
            'nama_petugas' => $nama,
            'username' => $username,
            'password' => $password,
            'V_password' => $V_password
        );

        $where = array(
            'id_petugas' => $id
        );

        $this->M_petugas->update_petugas($where, $data, 'tb_petugas');
        $this->session->set_flashdata('updateBarang', 'berhasil');
        redirect('admin/C_petugas');
    }

    public function hapus($id)
    {
        $delete = '2';

        $data = array(
            'is_delete' => $delete,
        );

        $where = array(
            'id_petugas' => $id
        );
        $this->M_petugas->delete($where, $data, 'tb_petugas');
        // $this->db->delete('tb_petugas', array('id_petugas' => $id));
        echo 'Deleted successfully.';
        // $_id = $this->db->get_where('tb_petugas', ['id_petugas' => $id])->row();
        // $query = $this->db->delete('tb_petugas', ['id_petugas' => $id]);
        // $this->M_petugas->hapus_data($id, 'tb_petugas');
        // echo "<script>
        //     alert('Data Petugas berhasil di Hapus');
        //     window.location.href = '" . base_url('admin/C_petugas') . "';
        // </script>";
    }

    public function get_username()
    {
        $username = $this->input->post('username');
        $hasil = $this->M_petugas->get_username($username);

        echo $hasil;
    }
}
