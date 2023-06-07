<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_profile extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('M_masyarakat');
        // if (empty($this->session->userdata('logged_in'))) {
        //     redirect('C_login/', 'refresh');
        // }
    }

    public function index()
    {
        $data['session'] = $this->session->userdata('id_masyarakat');
        $where = $this->session->userdata('id_masyarakat');
        $data['profile'] = $this->M_masyarakat->get_profile($where);
        $data['title'] = "Profile";
        $this->load->view('template_user/header', $data);
        $this->load->view('template_user/navigation', $data);
        $this->load->view('profile', $data);
        $this->load->view('template_user/footer');
    }

    public function update()
    {
        $id = $this->input->post('id');
        $telepon = $this->input->post('telepon');
        $username = $this->input->post('username');

        $data = array(
            'username' => $username,
            'telp' => $telepon,
        );

        $where = array(
            'id_user' => $id
        );

        $this->M_masyarakat->update_masyarakat($where, $data, 'tb_masyarakat');
        echo $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Berhasil Diubah</div>');
        redirect('C_profile');
    }

    public function ubah_pwd()
    {
        $id = $this->session->userdata('id_masyarakat');
        $old = $this->input->post('old');
        $new = $this->input->post('new');
        $re_new = $this->input->post('re_new');
        $this->form_validation->set_rules('new', 'Password', 'required|trim');
        $this->form_validation->set_rules('re_new', 'Confirm Password', 'required|matches[new]');
        if ($this->form_validation->run() == FALSE) {
            $data['session'] = $this->session->userdata('id_masyarakat');
            $where = $this->session->userdata('id_masyarakat');
            $data['profile'] = $this->M_masyarakat->get_profile($where);
            $data['title'] = "Profile";
            $this->load->view('template_user/header', $data);
            $this->load->view('template_user/navigation', $data);
            $this->load->view('profile', $data);
            $this->load->view('template_user/footer');
        } else {
            $sql = $this->db->query("SELECT v_password FROM tb_masyarakat where v_password='$old'");
            $cek_telp = $sql->num_rows();
            if ($cek_telp < 0) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password Tidak Sama</div>');
                redirect(site_url('C_profile/index'));
            } else {
                $data = array(
                    'v_password' => $new,
                    'password' => md5($new),
                );

                $where = array(
                    'id_user' => $id
                );

                $this->M_masyarakat->update_password($where, $data, 'tb_masyarakat');
                echo $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password Berhasil Diubah, Silahkan Login Kembali</div>');
                redirect(site_url('C_login/index'));
            }
        }
    }
}
