<?php
class M_login extends CI_Model
{
    private $table = 'm_banking';

    function login($rekening, $kode)
    {
        $query = $this->db->query("SELECT * FROM m_banking WHERE rekening='$rekening' AND kode = $kode LIMIT 1");
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
    }
}
