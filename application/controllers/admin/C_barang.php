<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_barang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('M_barang');
        $this->load->model('M_dashboard');
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
        $batas = $this->M_dashboard->get_barang();
        foreach ($batas as $waktu) {
            date_default_timezone_set('Asia/Jakarta');
            $sekarang = date('Y-m-d H:i:s');
            if (date('Y-m-d H:i:s', strtotime($waktu->batas)) == $sekarang || date('Y-m-d H:i:s', strtotime($waktu->batas)) <= $sekarang) {
                $id = $waktu->id_barang;
                $this->M_dashboard->tutup_lelang($id);
                $this->M_dashboard->tbLelang_tutup($id);
            }
        }
        $data['title'] = 'Manage Barang';
        $data['petugas'] = $this->M_barang->get_petugas();
        $data['barang'] = $this->M_barang->get_barang();
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/V_barang', $data);
        $this->load->view('template_admin/footer', $data);
    }
    public function detail()
    {
        $data['title'] = 'Manage Barang';
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/detail-brg');
        $this->load->view('template_admin/footer');
    }

    public function tambah()
    {
        $petugas = $this->session->userdata('id_petugas');
        $nama_barang = htmlspecialchars($this->input->post('nama_barang'));
        $deskripsi = htmlspecialchars($this->input->post('deskripsi'));
        // $tanggal = $this->input->post('tanggal_upload');
        date_default_timezone_set('Asia/Jakarta');
        $tgl = date('Y-m-d');
        $tanggal = $tgl;
        $harga = $this->input->post('harga');
        $status = 'ditutup';
        $status_barang = '1';
        $status_lelang = 'ditutup';
        $foto = $_FILES['foto']['name'];
        $format = 'jpg|jpeg|png|gif';
        if ($foto = '') {
        } else {
            $config['upload_path'] = './upload/barang';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size'] = 5024;
            $config['encrypt_name'] = true;

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('foto')) {
                $this->session->set_flashdata('salahFormat', 'berhasil');
                redirect('admin/C_barang');
                // echo "foto Gagal Diupload !!";
            } else {
                $foto = $this->upload->data('file_name');
                $data = array(
                    'nama_barang' => $nama_barang,
                    'foto' => $foto,
                    'tgl' => $tanggal,
                    'status_lelang' => $status_lelang,
                    'harga_awal' => $harga,
                    'deskripsi_barang' => $deskripsi,
                    'petugas' => $petugas,
                    'status_barang' => $status_barang
                );
                $insert = $this->M_barang->tambah_data($data, 'tb_barang');

                $lelang = array(
                    'id_barang' => $insert['id_barang'],
                    'id_petugas' => $petugas,
                    'status' => $status,
                    'tgl_lelang' => $tanggal
                );

                $this->M_barang->tambah_lelang($lelang, 'tb_lelang');
                $this->session->set_flashdata('tambah', 'berhasil');
                redirect('admin/C_barang');
            }
        }
        // echo "<script>
        //     alert('Data Barang berhasil di tambahkan');
        //     window.location.href = '" . base_url('petugas/Cp_barang') . "';
        // </script>";
    }

    public function detailBrg($id)
    {
        $data['title'] = 'Manage Barang';
        $where = array('id_barang' => $id);
        $data['petugas'] = $this->M_barang->get_petugas();
        $data['detail'] = $this->M_barang->get_detail($where, 'tb_barang')->result();
        // $data['detail'] = $this->M_barang->detail_barang($where, 'tb_barang')->result();
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/detail-brg', $data);
        $this->load->view('template_admin/footer');
    }

    public function update()
    {
        $id = $this->input->post('id');
        $nama = htmlspecialchars($this->input->post('nama_barang'));
        $deskripsi = htmlspecialchars($this->input->post('deskripsi_barang'));
        // $tanggal_upload = $this->input->post('tanggal_upload');
        $harga = $this->input->post('harga_awal');
        $old_foto = $this->input->post('old_pic');
        $_id = $this->db->get_where('tb_barang', ['id_barang' => $id])->row();
        $foto = $_FILES['foto']['name'];

        if ($foto == null) {
            $data = array(
                'nama_barang' => $nama,
                'deskripsi_barang' => $deskripsi,
                // 'tgl' => $tanggal_upload,
                'harga_awal' => $harga,
            );

            $where = array(
                'id_barang' => $id
            );

            $this->M_barang->update_barang($where, $data, 'tb_barang');
        } else {
            $config['upload_path'] = './upload/barang';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 5024;
            $config['encrypt_name'] = true;

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('foto')) {
                // echo "foto Gagal Diupload !!";
                $this->session->set_flashdata('salahFormat', 'berhasil');
                redirect('admin/C_barang');
            } else {
                $foto = $this->upload->data('file_name');
                unlink("upload/barang/" . $_id->foto);
                $data = array(
                    'nama_barang' => $nama,
                    'deskripsi_barang' => $deskripsi,
                    // 'tgl' => $tanggal_upload,
                    'harga_awal' => $harga,
                    'foto' => $foto
                );

                $where = array(
                    'id_barang' => $id
                );

                $this->M_barang->update_barang($where, $data, 'tb_barang');
            }
        }
        $this->session->set_flashdata('updateBarang', 'berhasil');
        // $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Berhasil Diubah</div>');
        redirect('admin/C_barang');
    }


    public function hapus($id)
    {
        // $this->db->delete('tb_petugas', array('id_petugas' => $id));
        // echo 'Deleted successfully.';
        $_id = $this->db->get_where('tb_barang', ['id_barang' => $id])->row();
        $query = $this->db->delete('tb_barang', ['id_barang' => $id]);
        if ($query) {
            unlink("upload/barang/" . $_id->foto);
        }
        $this->M_barang->hapus_data($id, 'tb_barang');
        $this->M_barang->hapus_history($id, 'history_lelang');
        $this->session->set_flashdata('Hbarang', 'berhasil');
        redirect('admin/C_barang');
        // echo "<script>
        //     alert('Data Barang berhasil di Hapus');
        //     window.location.href = '" . base_url('admin/C_barang') . "';
        // </script>";
    }
}
