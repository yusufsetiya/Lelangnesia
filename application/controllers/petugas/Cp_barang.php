<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cp_barang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('M_barang');
        $this->load->model('M_dashboard');
        if (empty($this->session->userdata('id_petugas') && $this->session->userdata('petugas'))) {
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
        $data['title'] = 'Dashboard';
        $id_petugas = $this->session->userdata('id_petugas');
        $sql = $this->db->query("SELECT telepon AS telp FROM tb_petugas where id_petugas='$id_petugas'")->row_array();
        $data['telepon'] = $sql['telp'];
        $data['petugas'] = $this->M_barang->get_petugas();
        $data['barang'] = $this->M_barang->get_barang();
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar_petugas');
        $this->load->view('petugas/Vp_barang', $data);
        $this->load->view('template_admin/footer');
    }

    public function open()
    {
        $petugas = $this->session->userdata('id_petugas');
        $tgl = date('Y-m-d');
        $id = $this->input->post('id');
        $batas = $this->input->post('batas');
        $tgl_lelang = $tgl;
        $status = 'dibuka';
        $id_update = 'dibuka';

        $data = array(
            'status' => $status,
            'batas' => $batas,
            'id_petugas' => $petugas
        );

        $openUpdate = array(
            'status_lelang' => $id_update,
        );

        $where = array(
            'id_barang' => $id
        );

        $this->M_barang->open($where, $data, 'tb_lelang');
        $this->M_barang->open_update($where, $openUpdate, 'tb_barang');
        $this->session->set_flashdata('openlelang', 'berhasil');
        echo "<script>
        window.location.href = '" . base_url('petugas/Cp_barang') . "';
    </script>";
    }

    public function close($id)
    {
        $id = $id;
        $status = 'ditutup';
        $id_update = 'ditutup';

        $openUpdate = array(
            'status_lelang' => $id_update
        );

        $tutup = array(
            'status' => $status
        );

        $where = array(
            'id_barang' => $id
        );

        $this->M_barang->open_update($where, $openUpdate, 'tb_barang');
        $this->M_barang->tutup($where, $tutup, 'tb_lelang');
        $this->session->set_flashdata('tutuplelang', 'berhasil');
        echo "<script>
        window.location.href = '" . base_url('petugas/Cp_barang') . "';
    </script>";
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
        if ($foto = '') {
        } else {
            $config['upload_path'] = './upload/barang';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size'] = 5024;
            $config['encrypt_name'] = true;

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('foto')) {
                $this->session->set_flashdata('salahFormat', 'berhasil');
                redirect('petugas/Cp_barang');
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
                    'status' => $status,
                    'tgl_lelang' => $tanggal
                );

                $this->M_barang->tambah_lelang($lelang, 'tb_lelang');
                $this->session->set_flashdata('tambah', 'berhasil');
                redirect('petugas/Cp_barang');
            }
        }

        // echo "<script>
        //     alert('Data Barang berhasil di tambahkan');
        //     window.location.href = '" . base_url('petugas/Cp_barang') . "';
        // </script>";
    }

    public function detail($id)
    {
        $data['title'] = 'Detail Barang';
        $where = array('id_barang' => $id);
        $data['petugas'] = $this->M_barang->get_petugas();
        $data['detail'] = $this->M_barang->get_detail($where, 'tb_barang')->result();
        // $data['detail'] = $this->M_barang->detail_barang($where, 'tb_barang')->result();
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar_petugas');
        $this->load->view('admin/detail-brg', $data);
        $this->load->view('template_admin/footer');
    }

    public function hapus($id)
    {
        // $this->db->delete('tb_petugas', array('id_petugas' => $id));
        // echo 'Deleted successfully.';
        $_id = $this->db->get_where('tb_barang', ['id_barang' => $id])->row();
        $query = $this->db->delete('history_lelang', ['id_barang' => $id]);
        $query = $this->db->delete('tb_barang', ['id_barang' => $id]);
        if ($query) {
            unlink("upload/barang/" . $_id->foto);
        }

        $this->session->set_flashdata('Hbarang', 'berhasil');
        redirect('petugas/Cp_barang');
        // echo "<script>
        //     alert('Data Barang berhasil di Hapus');
        //     window.location.href = '" . base_url('admin/C_barang') . "';
        // </script>";
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
        redirect('petugas/Cp_barang');
    }
}
