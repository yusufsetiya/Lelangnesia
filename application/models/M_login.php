<?php
class M_login extends CI_Model
{
    private $table = 'tb_masyarakat';
    private $tb_kode = 'tb_kode';

    function auth_petugas($username, $password)
    {
        $query = $this->db->query("SELECT * FROM tb_petugas WHERE username='$username' AND password = MD5('$password') LIMIT 1");
        return $query;
    }

    //cek nim dan password mahasiswa
    function auth_masyarakat($username, $password)
    {
        $query = $this->db->query("SELECT * FROM tb_masyarakat WHERE username='$username' AND password =MD5('$password') LIMIT 1");
        return $query;
    }

    public function register($data, $table)
    {
        $this->db->insert($table, $data);
        $sql = "SELECT MAX(email) AS email FROM $table";
        return $this->db->query($sql)->row_array();
    }

    function cek_akun($username, $email)
    {
        $query = $this->db->query("SELECT * FROM tb_masyarakat WHERE username='$username' AND email ='$email' LIMIT 1");
        return $query;
    }

    public function update_password($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    public function update_kodePwd($kode, $tb_kode)
    {
        $this->db->insert($tb_kode, $kode);
    }
    // public function update_kodePwd($jikaId, $kode, $table)
    // {
    //     $this->db->where($jikaId);
    //     $this->db->update($table, $kode);
    // }

    public function cek_kode($id_user)
    {
        $query = $this->db->query("SELECT kode FROM tb_masyarakat WHERE id_user='$id_user' LIMIT 1");
        return $query;
    }
    public function hapus_kode($email)
    {
        $query = $this->db->query("DELETE FROM tb_kode WHERE email = '$email'");
        return $query;
    }

    public function tambah_kode($kode, $tb_kode)
    {
        $this->db->insert($tb_kode, $kode);
    }

    public function verifyemail($key)
    {
        $data = array('active' => 2);
        $this->db->where('md5(email)', $key);
        return $this->db->update('tb_masyarakat', $data);
    }

    public function get_telepon($telepon)
    {
        $sql = "SELECT telp FROM tb_masyarakat WHERE telp = '$telepon'";
        $hasil = $this->db->query($sql)->row_array();

        if ($hasil >= 1) {
            $result = ['result' => '1'];
            return json_encode($result);
        } else {
            $result = ['result' => '0'];
            return json_encode($result);
        }
    }

    public function get_emails($email)
    {
        $sql = "SELECT email FROM tb_masyarakat WHERE email = '$email'";
        $hasil = $this->db->query($sql)->row_array();

        if ($hasil >= 1) {
            $result = ['result' => '1'];
            return json_encode($result);
        } else {
            $result = ['result' => '0'];
            return json_encode($result);
        }
    }
    public function get_username($username)
    {
        $sql = "SELECT username FROM tb_masyarakat WHERE username = '$username'";
        $hasil = $this->db->query($sql)->row_array();

        if ($hasil >= 1) {
            $result = ['result' => '1'];
            return json_encode($result);
        } else {
            $result = ['result' => '0'];
            return json_encode($result);
        }
    }
}
