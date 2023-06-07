<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_data extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('M_data');
        if (empty($this->session->userdata('logged_in'))) {
            redirect('C_login/', 'refresh');
        }
    }

    public function index()
    {
        $data['title'] = 'Manage-Data';
        $data['kategori'] = $this->M_data->get_kategori();
        $data['data'] = $this->M_data->tampil_data();
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('V_datalokasi', $data);
        $this->load->view('template_admin/footer');
    }

    public function tambah_data()
    {
        $nama_wisata = $this->input->post('nama_wisata');
        $deskripsi_wisata = $this->input->post('deskripsi_wisata');
        $id_kat = $this->input->post('id_kat');
        $lat_wisata = $this->input->post('lat_wisata');
        $long_wisata = $this->input->post('long_wisata');
        $foto_wisata = $_FILES['foto_wisata']['name'];
        if ($foto_wisata = '') {
        } else {
            $config['upload_path'] = './upload';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('foto_wisata')) {
                echo "foto_wisata Gagal Diupload !!";
            } else {
                $foto_wisata = $this->upload->data('file_name');
            }
        }
        $data = array(
            'nama_wisata' => $nama_wisata,
            'deskripsi_wisata' => $deskripsi_wisata,
            'id_kat' => $id_kat,
            'lat_wisata' => $lat_wisata,
            'long_wisata' => $long_wisata,
            'foto_wisata' => $foto_wisata
        );

        $this->M_data->tambah_data($data, 'tb_lokasi_wisata');
        echo "<script>
            alert('Data Wisata berhasil di tambahkan');
            window.location.href = '" . base_url('C_data/index') . "';
        </script>";
        // redirect('C_data/index');
    }

    public function detail($id)
    {
        $data['title'] = 'Detail';
        $where = array('id_wisata' => $id);
        $data['data'] = $this->M_data->detail($where, 'tb_lokasi_wisata')->result();
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('V_detail', $data);
        $this->load->view('template_admin/footer');
    }

    public function update()
    {
        $id = $this->input->post('id_wisata');
        $_id = $this->db->get_where('tb_lokasi_wisata', ['id_wisata' => $id])->row();
        $nama_wisata = $this->input->post('nama_wisata');
        $deskripsi_wisata = $this->input->post('deskripsi_wisata');
        $id_kat = $this->input->post('id_kat');
        $lat_wisata = $this->input->post('lat_wisata');
        $long_wisata = $this->input->post('long_wisata');
        $foto_wisata = $_FILES['foto_wisata']['name'];
        if ($foto_wisata = '') {
        } else {
            $config['upload_path'] = './upload';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('foto_wisata')) {
                echo "foto_wisata Gagal Diupload !!";
            } else {
                $foto_wisata = $this->upload->data('file_name');
                unlink("upload/" . $_id->foto_wisata);
            }
        }

        $data = array(
            'nama_wisata' => $nama_wisata,
            'deskripsi_wisata' => $deskripsi_wisata,
            'foto_wisata' => $foto_wisata,
            'lat_wisata' => $lat_wisata,
            'long_wisata' => $long_wisata,
            'id_kat' => $id_kat
            // 'gambar' => $gambar
        );

        $where = array(
            'id_wisata' => $id
        );

        $this->M_data->update_data($where, $data, 'tb_lokasi_wisata');
        redirect('C_data');
    }

    // public function remover()
    // {

    // }

    public function hapus($id)
    {
        $_id = $this->db->get_where('tb_lokasi_wisata', ['id_wisata' => $id])->row();
        $query = $this->db->delete('tb_lokasi_wisata', ['id_wisata' => $id]);
        if ($query) {
            unlink("upload/" . $_id->foto_wisata);
        }
        // $where = array('id_wisata' => $id);
        $this->M_data->hapus_data($id, 'tb_lokasi_wisata');
        echo "<script>
            alert('Data Wisata berhasil di Hapus');
            window.location.href = '" . base_url('C_data/index') . "';
        </script>";
        // redirect('C_data/index');
    }
}
