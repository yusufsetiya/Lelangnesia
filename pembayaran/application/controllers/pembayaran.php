<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembayaran extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('transfer');
        if (empty($this->session->userdata('id_banking'))) {
            echo "<script>
            alert('Anda Tidak Memiliki Akses Ke Halaman Tersebut');
            window.location.href = '" . base_url('login') . "';
        </script>";
            $this->session->sess_destroy();
        }
    }

    public function index()
    {
        $data['title'] = 'Pembayaran';
        // $data = $this->pembayaran->transfer();
        $id = $this->session->userdata('id_banking');
        $data['saldo'] = $this->transfer->saldo($id);
        $this->load->view('template_user/header', $data);
        $this->load->view('pembayaran', $data);
        $this->load->view('template_user/footer');
    }

    public function transfer()
    {
        $data['title'] = 'Detail Pembayaran';
        $id = $this->transfer->get_tampung();
        $idT = $id['idT'];
        $data['detail'] = $this->transfer->join($idT);
        $this->load->view('template_user/header', $data);
        $this->load->view('dt_pembayaran', $data);
        $this->load->view('template_user/footer');
    }

    public function bayar()
    {
        $pin1 = $this->input->post('pin1');
        $id = $this->session->userdata('id_banking');
        $this->form_validation->set_rules('pin1', 'PIN', 'required|trim');
        $this->form_validation->set_rules('pin2', 'Confirm Pin', 'required|matches[pin1]');
        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Pembayaran';
            // $data = $this->pembayaran->transfer();
            $id = $this->session->userdata('id_banking');
            $data['saldo'] = $this->transfer->saldo($id);
            $this->load->view('template_user/header', $data);
            $this->load->view('pembayaran', $data);
            $this->load->view('template_user/footer');
        } else {
            $cek_pinw = $this->transfer->cek_pin($pin1, $id, 'm_banking');
            $cek = $cek_pinw['pinr'];
            if ($cek == False) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Pin Salah</div>');
                redirect('pembayaran/index');
            } else {
                $va = $this->input->post('va');
                $cek_va = $this->transfer->cek_va($va);
                if ($cek_va->num_rows() > 0) {
                    $id = $this->session->userdata('id_banking');
                    $rek = $this->session->userdata('rekening');
                    $va = $this->input->post('va');
                    $rekening = $this->input->post('rekening');
                    $id_barang = $this->transfer->get_va($va);
                    $id_br = $id_barang['idBr'];
                    $id_user = $this->transfer->get_user($va);
                    $id_usr = $id_user['user'];
                    $id_jml = $this->transfer->get_jumlah($va);
                    $jumlah = $id_jml['jumlahs'];

                    $data = array(
                        'va' => $va,
                        'jumlah' => $jumlah,
                        'rekening_p' => $rek,
                        'id_bayar' => $id_br,
                        'id_banking' => $id,
                        'id_user' => $id_usr
                    );
                    $this->transfer->bayar($data, 'p_pembayaran');

                    // $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Berhasil Ditambahkan</div>');
                    redirect('pembayaran/transfer');
                } else {
                    $this->session->set_flashdata('va_gaketemu', 'berhasil');
                    redirect('pembayaran/index');
                }
                // $petugas = $this->session->userdata('id_petugas');

                // echo "<script>
                //     alert('Data Barang berhasil di tambahkan');
                //     window.location.href = '" . base_url('petugas/Cp_barang') . "';
                // </script>";
            }
        }
    }

    public function selesai()
    {
        // $petugas = $this->session->userdata('id_petugas');
        $id = $this->session->userdata('id_banking');
        $jumlah = $this->input->post('jumlah');
        $cek = $this->db->query("SELECT saldo AS saldos FROM m_banking where id_banking='$id'")->row_array();
        $cekS = $cek['saldos'];

        if ($cekS < $jumlah) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Maaf Saldo Rekening Anda Tidak Cukup</div>');
            $data['title'] = 'Detail Pembayaran';
            $id = $this->transfer->get_tampung();
            $idT = $id['idT'];
            $data['detail'] = $this->transfer->join($idT);
            $this->load->view('template_user/header', $data);
            $this->load->view('dt_pembayaran', $data);
            $this->load->view('template_user/footer');
        } else {
            $id = $this->session->userdata('id_banking');
            $sql = $this->db->query("SELECT id_banking AS saldos FROM m_banking where id_banking='$id'")->row_array();
            $idB = $sql['saldos'];
            $saldos = $this->transfer->cek_saldo($id);
            // $sql = $this->db->query("SELECT saldo AS saldos FROM m_banking where id_banking='$id'")->result_array();
            $saldo = $saldos['saldos'];
            $jumlah = $this->input->post('jumlah');
            $hasil = $saldo - $jumlah;
            $id = $this->input->post('id');
            $id_barang = $this->input->post('id_barang');
            $rekening = $this->input->post('rekening');
            $status = 'sudah';
            $status_lelang = 'terjual';
            $barang = '2';
            date_default_timezone_set('Asia/Jakarta');
            $tgl = date('Y-m-d H:i:s');
            $nanti = date("Y-m-d H:i:s", strtotime($tgl . '+1000 days'));
            $data = array(
                'status_bayar' => $status,
                'rekening' => $rekening,
                'waktu_bayar' => $tgl,
                'batas_bayar' => $nanti,
            );

            $where = array(
                'id_bayar' => $id
            );

            $isi = array(
                'status_barang' => $barang,
                'status_lelang' => $status_lelang,
            );

            $jika = array(
                'id_barang' => $id_barang
            );

            $saldo = array(
                'saldo' => $hasil,
            );

            $sald = array(
                'id_banking' => $idB
            );

            $this->transfer->selesai($where, $data, 'tb_pembayaran');
            $this->transfer->update_br($jika, $isi, 'tb_barang');
            $this->transfer->get_saldo($sald, $saldo, 'm_banking');

            $this->session->set_flashdata('bayar', 'berhasil');
            redirect('pembayaran/index');
        }
        // echo "<script>
        //     alert('Data Barang berhasil di tambahkan');
        //     window.location.href = '" . base_url('petugas/Cp_barang') . "';
        // </script>";
    }
}
