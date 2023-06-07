<?php
class M_profile extends CI_Model
{
    private $table = 'tb_masyarakat';

    public function get_masyarakat()
    {
        $query = $this->db->query("SELECT * FROM tb_masyarakat WHERE verif='1'")->result();
        return $query;
        // return $this->db->get('tb_petugas')->result();
    }
    public function get_verif()
    {
        $query = $this->db->query("SELECT * FROM tb_masyarakat WHERE verif='2'")->result();
        return $query;
        // return $this->db->get('tb_petugas')->result();
    }

    public function verif($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
        // return $this->db->get('tb_petugas')->result();
    }
}
