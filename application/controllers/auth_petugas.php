<?php
defined('BASEPATH') or exit('No direct script access allowed');

class auth_petugas extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_login');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->Model('M_login');
    }

    public function index()
    {
        $data['title'] = 'Login';
        $this->load->view('login-reg/login_petugas', $data);
    }


    function proses_login()
    {
        $username = htmlspecialchars($this->input->post('username', TRUE), ENT_QUOTES);
        $password = htmlspecialchars($this->input->post('password', TRUE), ENT_QUOTES);

        $cek_petugas = $this->M_login->auth_petugas($username, $password);

        if ($cek_petugas->num_rows() > 0) {
            $data = $cek_petugas->row_array();
            $this->session->set_userdata('masuk', TRUE);
            if ($data['id_level'] == '4') { //administrator
                $this->session->set_userdata('admin', '4');
                $this->session->set_userdata('id_petugas', $data['id_petugas']);
                $this->session->set_userdata('username', $data['nama_petugas']);
                redirect('admin/C_dashboard');
            } elseif ($data['id_level'] == '5') { //petugas
                $this->session->set_userdata('petugas', '5');
                $this->session->set_userdata('id_petugas', $data['id_petugas']);
                $this->session->set_userdata('username', $data['nama_petugas']);
                redirect('petugas/Cp_dashboard');
            }
        } else { //petugas
            $url = base_url('auth_petugas/index');
            $this->session->set_flashdata('pwdSalah', 'berhasil');
            redirect($url);
        }
    }


    public function logout()
    {
        $this->session->sess_destroy();
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">anda telah logout</div>');
        redirect('auth_petugas/index');
    }


    public function lupa_pwd()
    {
        $data['title'] = 'Lupa Password';
        $this->load->view('login-reg/lupa_pwd', $data);
    }

    public function cari_akun()
    {
        $username = htmlspecialchars($this->input->post('username', TRUE), ENT_QUOTES);
        $telepon = htmlspecialchars($this->input->post('telepon', TRUE), ENT_QUOTES);

        $cek_akun = $this->M_login->cek_akun($username, $telepon);

        if ($cek_akun->num_rows() > 0) {
            $sql = $this->db->query("SELECT id_user AS id FROM tb_masyarakat where username='$username' AND telp='$telepon'")->row_array();
            $data['id'] = $sql['id'];
            $data['title'] = 'Reset Password';
            $this->session->set_flashdata('ditemukan', 'berhasil');
            $this->load->view('login-reg/reset_pwd', $data);
        } else { //masyarakat
            $this->session->set_flashdata('gakKetemu', 'berhasil');
            redirect('C_login/lupa_pwd');
        }
    }

    public function reset_pwd()
    {
        $data['title'] = 'Reset Password';
        $this->load->view('login-reg/reset_pwd', $data);
    }

    public function proses_reset()
    {
        $id = $this->input->post('id');
        $password1 = $this->input->post('password1');
        $password2 = $this->input->post('password2');
        $this->form_validation->set_rules('password1', 'Password', 'required|trim');
        $this->form_validation->set_rules('password2', 'Confirm Password', 'required|matches[password1]');
        if ($this->form_validation->run() == FALSE) {
            $data['id'] = $this->input->post('id');
            // $where = $this->session->userdata('id_masyarakat');
            // $data['profile'] = $this->M_masyarakat->get_profile($where);
            // $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password Tidak Sama</div>');
            $this->session->set_flashdata('salah', 'berhasil');
            $data['title'] = 'Reset Password';
            $this->load->view('login-reg/reset_pwd', $data);
        } else {
            $data = array(
                'v_password' => $password1,
                'password' => md5($password1),
            );

            $where = array(
                'id_user' => $id
            );

            $this->M_login->update_password($where, $data, 'tb_masyarakat');
            $this->session->set_flashdata('berhasil', 'berhasil');
            redirect(site_url('C_login/index'));
        }
    }
}
