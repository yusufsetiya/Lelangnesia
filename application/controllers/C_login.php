<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_Login extends CI_Controller
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
        $this->load->view('login-reg/login', $data);
    }


    function proses_login()
    {
        $username = htmlspecialchars($this->input->post('username', TRUE), ENT_QUOTES);
        $password = htmlspecialchars($this->input->post('password', TRUE), ENT_QUOTES);

        // $cek_petugas = $this->M_login->auth_petugas($username, $password);
        $cek_masyarakat = $this->M_login->auth_masyarakat($username, $password);

        if ($cek_masyarakat->num_rows() > 0) {
            $blokir = $this->db->query("SELECT verif AS ver FROM tb_masyarakat where username='$username' AND v_password= '$password'")->row_array();
            $cek_blokir = $blokir['ver'];
            if ($cek_blokir == '3') {
                $url = base_url('C_login/index');
                $this->session->set_flashdata('akunDiblokir', 'berhasil');
                redirect($url);
            } else {
                $status = $this->db->query("SELECT active AS act FROM tb_masyarakat where username='$username' AND v_password= '$password'")->row_array();
                $cek_status = $status['act'];
                if ($cek_status == '2') {
                    $data = $cek_masyarakat->row_array();
                    $this->session->set_userdata('masuk', TRUE);
                    $this->session->set_userdata('id_masyarakat', $data['id_user']);
                    $this->session->set_userdata('username', $data['username']);
                    $this->session->set_userdata('wajah', $data['wajah']);
                    $this->session->set_userdata('nama_lengkap', $data['nama_lengkap']);
                    $this->session->set_userdata('telepon', $data['telp']);
                    $this->session->set_userdata('verif', $data['verif']);
                    redirect('C_index');
                } else {
                    $this->session->set_flashdata('BVemail', 'berhasil');
                    redirect('C_login');
                }
            }
        } else { //petugas
            $url = base_url('C_login/index');
            $this->session->set_flashdata('pwdSalah', 'berhasil');
            redirect($url);
        }

        // } else { //masyarakat
        //     $cek_masyarakat = $this->M_login->auth_masyarakat($username, $password);
        //     if ($cek_masyarakat->num_rows() > 0) {
        //         $data = $cek_masyarakat->row_array();
        //         $this->session->set_userdata('masuk', TRUE);
        //         $this->session->set_userdata('id_masyarakat', $data['id_user']);
        //         $this->session->set_userdata('username', $data['username']);
        //         $this->session->set_userdata('wajah', $data['wajah']);
        //         $this->session->set_userdata('nama_lengkap', $data['nama_lengkap']);
        //         $this->session->set_userdata('telepon', $data['telp']);
        //         $this->session->set_userdata('verif', $data['verif']);
        //         redirect('C_index');
        //     } else {  // jika username dan password tidak ditemukan atau salah
        //         $url = base_url('C_login/index');
        //         $this->session->set_flashdata('pwdSalah', 'berhasil');
        //         redirect($url);
        //     }
        // }
    }

    public function register()
    {
        $data['title'] = 'Register';
        $this->load->view('template_admin/header', $data);
        $this->load->view('login-reg/register');
        $this->load->view('template_admin/footer');
    }

    public function proses_regis()
    {
        $telepon = $this->input->post('telepon');
        $email = $this->input->post('email');
        $sql = $this->db->query("SELECT telp FROM tb_masyarakat where telp='$telepon'");
        $cek_telp = $sql->num_rows();
        $cEmail = $this->db->query("SELECT email FROM tb_masyarakat where email='$email'");
        $cek_email = $cEmail->num_rows();
        if ($cek_telp > 0) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Nomor Telepon Sudah Digunakan Sebelumnya</div>');
            redirect(site_url('C_login/register'));
        } elseif ($cek_email > 0) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email Sudah Digunakan Sebelumnya</div>');
            redirect(site_url('C_login/register'));
        } else {
            $nama = $this->input->post('nama');
            $username = $this->input->post('username');
            $v_password = $this->input->post('password');
            $password = md5($v_password);
            $tpt_lahir = $this->input->post('tpt_lahir');
            $tgl = $this->input->post('tgl');
            $alamat = $this->input->post('alamat');
            $telepon = $this->input->post('telepon');
            $nik = $this->input->post('nik');
            $gender = $this->input->post('gender');
            $email = $this->input->post('email');
            $verif = '1';
            $wajah = $_FILES['wajah']['name'];
            $ktp = $_FILES['ktp']['name'];

            // if ($this->upload->do_upload('wajah')) {
            //     $wajah = $this->upload->data('file_name');
            //     // echo "foto_wisata Gagal Diupload !!";
            // } elseif (!$this->upload->do_upload('ktp')) {
            //     // echo "foto_wisata Gagal Diupload !!";
            //     $ktp = $this->upload->data('file_name');
            // } else {
            //     echo "foto_wisata Gagal Diupload !!";
            //     // $wajah = $this->upload->data('file_name');
            //     // $ktp = $this->upload->data('file_name');
            // }
            // $uniq = strtoupper(uniqid());
            // $kodes = substr($uniq, 5);
            $saltid   = md5($email);
            $config = [
                'mailtype'  => 'html',
                'charset'   => 'utf-8',
                'protocol'  => 'smtp',
                'smtp_host' => 'smtp.gmail.com',
                'smtp_user' => 'mochamadyusuf2002@gmail.com',
                'smtp_pass'   => 'mochamadyusuf2424',
                'smtp_crypto' => 'ssl',
                'smtp_port'   => 465,
                'crlf'    => "\r\n",
                'newline' => "\r\n"
            ];
            $this->load->library('email', $config);
            $url = base_url() . "C_login/confirmation/" . $saltid;
            $this->email->from('mochamadyusuf2002@gmail.com', 'Lelangnesia');
            $this->email->to($email);
            $this->email->attach('Masukan Kode OTP di atas pada Form Verifikasi');
            $this->email->subject('Verifikasi Alamat Email');


            $this->email->message("<html><head><head></head><body><p>Hai,<h2>" . $nama . "</h2></p><p>Terimakasih Sudah Bergabung Dengan Lelangnesia.</p><p>Klik Tombol Di Bawah Untuk Melakukan Verifikasi Email Anda.</p><br> <a href=' " . $url . "' style=' font-family: sans-serif;
            font-size: 18px;
            background: #0000FF;
            color: white;
            border: white 3px solid;
            margin-top: 50px;
            margin-bottom: 50px;
            border-radius: 5px;
            padding: 12px 20px; ' >Verifikasi</a> <br> <p style='margin-top: 50px;'>Hormat Kami,</p><p><b>Tim Lelangnesia</b></p></body></html>");

            if ($this->email->send()) {

                $config['upload_path'] = './upload/profile';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['max_size'] = 5024;
                $config['encrypt_name'] = true;
                $this->load->library('upload', $config);

                if (!empty($_FILES['wajah'])) {
                    $this->upload->do_upload('wajah');
                    $data1 = $this->upload->data();
                    $wajah = $data1['file_name'];
                } else {
                    echo 'gagal 1';
                }

                if (!empty($_FILES['ktp'])) {
                    $this->upload->do_upload('ktp');
                    $data2 = $this->upload->data();
                    $ktp = $data2['file_name'];
                } else {
                    echo "gagal 2";
                }

                $data = array(
                    'nama_lengkap' => $nama,
                    'username' => $username,
                    'password' => $password,
                    'v_password' => $v_password,
                    'telp' => $telepon,
                    'alamat' => $alamat,
                    'nik' => $nik,
                    'gender' => $gender,
                    'wajah' => $wajah,
                    'ktp' => $ktp,
                    'verif' => $verif,
                    'tpt_lahir' => $tpt_lahir,
                    'email' => $email,
                    'active' => '1',
                    'tgl' => $tgl
                );

                $this->M_login->register($data, 'tb_masyarakat');
                // $id = $insert['email'];

                // $kode = array(
                //     'kode' => $kodes,
                //     'email' => $email,
                // );
                // $this->M_login->tambah_kode($kode, 'tb_kode');
                // $data['email'] = $email;
                // $data['title'] = 'Verifikasi';
                // $data['id'] = $id;
                $this->session->set_flashdata('verifRegis', 'berhasil');
                redirect('C_login');
                // $this->load->view('login-reg/verif_reg', $data);
            } else {
                $this->session->set_flashdata('tdkEmail', 'berhasil');
                redirect('C_login/register');
                // echo 'Error! email tidak dapat dikirim.';
            }
            // $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Registrasi Berhasil, Silahkan Login</div>');
            // echo "<script>
            //     window.location.href = '" . base_url('C_login/index') . "';
            // </script>";
        }
    }

    public function confirmation($key)
    {
        if ($this->M_login->verifyemail($key)) {
            // $this->session->set_flashdata('messege', '<div class="alert alert-success text-center">Your Email Address is successfully verified!</div>');
            $this->session->set_flashdata('verifEmail', 'berhasil');
            redirect('C_login');
        } else {
            // $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Your Email Address Verification Failed. Please try again later...</div>');
            $this->session->set_flashdata('gagalVEmail', 'berhasil');
            redirect('C_login');
        }
    }

    public function finish_regis()
    {
        $email = $this->input->post('email');
        $kode = $this->input->post('kode');

        // $cek_akun = $this->M_login->cek_kode($id_user);
        $sql = $this->db->query("SELECT kode AS kode FROM tb_kode where email='$email'")->row_array();
        $hasil = $sql['kode'];
        if ($hasil == $kode) {
            $this->M_login->hapus_kode($email);
            $this->session->set_flashdata('regisBerhasil', 'berhasil');
            redirect("C_login");
        } else {
            $data['title'] = 'Reset Password';
            $data['id'] = $this->input->post('id_user');
            $this->session->set_flashdata('gaksama', 'berhasil');
            $this->load->view('login-reg/verif_reg', $data);
        }
    }
    // public function proses_regis()
    // {

    //     $telepon = $this->input->post('telepon');
    //     $sql = $this->db->query("SELECT telp FROM tb_masyarakat where telp='$telepon'");
    //     $cek_telp = $sql->num_rows();
    //     if ($cek_telp > 0) {
    //         $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Nomor Telepon Sudah Digunakan Sebelumnya</div>');
    //         redirect(site_url('C_login/register'));
    //     } else {
    //         $nama = $this->input->post('nama');
    //         $username = $this->input->post('username');
    //         $v_password = $this->input->post('password');
    //         $password = md5($v_password);
    //         $tpt_lahir = $this->input->post('tpt_lahir');
    //         $tgl = $this->input->post('tgl');
    //         $alamat = $this->input->post('alamat');
    //         $telepon = $this->input->post('telepon');
    //         $nik = $this->input->post('nik');
    //         $gender = $this->input->post('gender');
    //         $email = $this->input->post('email');
    //         $verif = '1';
    //         $wajah = $_FILES['wajah']['name'];
    //         $ktp = $_FILES['ktp']['name'];

    //         $config['upload_path'] = './upload/profile';
    //         $config['allowed_types'] = 'jpg|jpeg|png|gif';
    //         $config['max_size'] = 5024;
    //         $config['encrypt_name'] = true;
    //         $this->load->library('upload', $config);

    //         if (!empty($_FILES['wajah'])) {
    //             $this->upload->do_upload('wajah');
    //             $data1 = $this->upload->data();
    //             $wajah = $data1['file_name'];
    //         } else {
    //             echo 'gagal 1';
    //         }

    //         if (!empty($_FILES['ktp'])) {
    //             $this->upload->do_upload('ktp');
    //             $data2 = $this->upload->data();
    //             $ktp = $data2['file_name'];
    //         } else {
    //             echo "gagal 2";
    //         }

    //         // if ($this->upload->do_upload('wajah')) {
    //         //     $wajah = $this->upload->data('file_name');
    //         //     // echo "foto_wisata Gagal Diupload !!";
    //         // } elseif (!$this->upload->do_upload('ktp')) {
    //         //     // echo "foto_wisata Gagal Diupload !!";
    //         //     $ktp = $this->upload->data('file_name');
    //         // } else {
    //         //     echo "foto_wisata Gagal Diupload !!";
    //         //     // $wajah = $this->upload->data('file_name');
    //         //     // $ktp = $this->upload->data('file_name');
    //         // }

    //         $data = array(
    //             'nama_lengkap' => $nama,
    //             'username' => $username,
    //             'password' => $password,
    //             'v_password' => $v_password,
    //             'telp' => $telepon,
    //             'alamat' => $alamat,
    //             'nik' => $nik,
    //             'gender' => $gender,
    //             'wajah' => $wajah,
    //             'ktp' => $ktp,
    //             'verif' => $verif,
    //             'tpt_lahir' => $tpt_lahir,
    //             'email' => $email,
    //             'tgl' => $tgl
    //         );
    //         $this->M_login->register($data, 'tb_masyarakat');
    //         $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Registrasi Berhasil, Silahkan Login</div>');
    //         echo "<script>
    //             window.location.href = '" . base_url('C_login/index') . "';
    //         </script>";
    //     }
    // }

    public function logout()
    {
        $this->session->sess_destroy();
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">anda telah logout</div>');
        redirect('C_login/index');
    }


    public function lupa_pwd()
    {
        $data['title'] = 'Lupa Password';
        $this->load->view('login-reg/lupa_pwd', $data);
    }

    public function cari_akun()
    {
        $username = htmlspecialchars($this->input->post('username', TRUE), ENT_QUOTES);
        $email = htmlspecialchars($this->input->post('email', TRUE), ENT_QUOTES);
        $emails = $this->input->post('email');

        $cek_akun = $this->M_login->cek_akun($username, $email);

        if ($cek_akun->num_rows() > 0) {
            $sql = $this->db->query("SELECT id_user AS id FROM tb_masyarakat where username='$username' AND email='$email'")->row_array();
            $data['id'] = $sql['id'];
            $email = $this->db->query("SELECT email AS eml FROM tb_masyarakat where username='$username' AND email='$email'")->row_array();
            $data['email'] = $email['eml'];
            $id_user = $sql['id'];
            $uniq = strtoupper(uniqid());
            $kodes = substr($uniq, 5);

            $kode = array(
                'kode' => $kodes,
                'email' => $emails
            );

            // $jikaId = array(
            //     'id_user' => $id_user
            // );
            // $this->M_login->update_kodePwd($jikaId, $kode, 'tb_masyarakat');
            $this->M_login->update_kodePwd($kode, 'tb_kode');

            $config = [
                'mailtype'  => 'html',
                'charset'   => 'utf-8',
                'protocol'  => 'smtp',
                'smtp_host' => 'smtp.gmail.com',
                'smtp_user' => 'mochamadyusuf2002@gmail.com',
                'smtp_pass'   => 'mochamadyusuf2424',
                'smtp_crypto' => 'ssl',
                'smtp_port'   => 465,
                'crlf'    => "\r\n",
                'newline' => "\r\n"
            ];
            $this->load->library('email', $config);
            $this->email->from('mochamadyusuf2002@gmail.com', 'Lelangnesia');
            $this->email->to($emails);
            $this->email->attach('Masukan Kode OTP di atas pada Form Verifikasi');
            $this->email->subject('Kode OTP Ubah Password');


            $this->email->message('Kode Reset Password Anda : <h1>' . $kodes . '</h1><br>Silahkan Masukan Kode tersebut Pada Form Kode Verifikasi.');

            if ($this->email->send()) {
                $data['title'] = 'Reset Password';
                $this->session->set_flashdata('ditemukan', 'berhasil');
                $this->load->view('login-reg/verif_pwd', $data);
            } else {
                $this->session->set_flashdata('tdkemail', 'berhasil');
                redirect('C_login/lupa_pwd');
                // echo 'Error! email tidak dapat dikirim.';
            }
        } else { //masyarakat
            $this->session->set_flashdata('gakKetemu', 'berhasil');
            redirect('C_login/lupa_pwd');
        }
    }

    public function verif_pwd()
    {
        $id_user = $this->input->post('id_user');
        $email = $this->input->post('email');
        $kode = $this->input->post('kode');

        // $cek_akun = $this->M_login->cek_kode($id_user);
        $sql = $this->db->query("SELECT kode AS kode FROM tb_kode where email='$email'")->row_array();
        $hasil = $sql['kode'];
        if ($hasil == $kode) {
            $this->M_login->hapus_kode($email);
            $data['title'] = 'Reset Password';
            $data['id'] = $this->input->post('id_user');
            $data['email'] = $this->input->post('email');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Silahkan Masukan Password Baru Anda</div>');
            $this->load->view('login-reg/reset_pwd', $data);
        } else {
            $data['title'] = 'Reset Password';
            $data['id'] = $this->input->post('id_user');
            $data['email'] = $this->input->post('email');
            $this->session->set_flashdata('gaksama', 'berhasil');
            $this->load->view('login-reg/verif_pwd', $data);
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

    public function coba()
    {
        $config = [
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'protocol'  => 'smtp',
            'smtp_host' => 'smtp.gmail.com',
            'smtp_user' => 'mochamadyusuf2002@gmail.com',  // Email gmail
            'smtp_pass'   => 'mochamadyusuf2424',  // Password gmail
            'smtp_crypto' => 'ssl',
            'smtp_port'   => 465,
            'crlf'    => "\r\n",
            'newline' => "\r\n"
        ];

        // Load library email dan konfigurasinya
        $this->load->library('email', $config);

        // Email dan nama pengirim
        $this->email->from('mochamadyusuf2002@gmail.com', 'Lelangnesia');

        // Email penerima
        $this->email->to('yusufsetiya6@gmail.com'); // Ganti dengan email tujuan

        // Lampiran email, isi dengan url/path file
        $this->email->attach('Masukan Kode OTP di atas pada Form Verifikasi');

        // Subject email
        $this->email->subject('Kode OTP Ubah Password');

        // Isi email
        $uniq = strtoupper(uniqid());
        $kode = substr($uniq, 5);
        $this->email->message('Kode Reset Password Anda : <h1>' . $kode . '</h1><br>Silahkan Masukan Kode tersebut Pada Form Kode Verifikasi.');

        // Tampilkan pesan sukses atau error
        if ($this->email->send()) {
            $this->session->set_flashdata('berhasil', 'berhasil');
            redirect(site_url('C_login/index'));
        } else {
            echo 'Error! email tidak dapat dikirim.';
        }
    }

    public function get_telepon()
    {
        $telepon = $this->input->post('telepon');
        $hasil = $this->M_login->get_telepon($telepon);

        echo $hasil;
    }

    public function get_email()
    {
        $email = $this->input->post('email');
        $hasil = $this->M_login->get_emails($email);

        echo $hasil;
    }
    public function get_username()
    {
        $username = $this->input->post('username');
        $hasil = $this->M_login->get_username($username);

        echo $hasil;
    }
}
