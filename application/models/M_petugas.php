<?php
class M_petugas extends CI_Model
{
    private $table = 'tb_petugas';

    public function get_level()
    {
        return $this->db->get('tb_level')->result();
    }

    public function get_petugas()
    {
        $query = $this->db->query("SELECT * FROM tb_petugas WHERE id_level='5' AND is_delete = '1'")->result();
        return $query;
        // return $this->db->get('tb_petugas')->result();
    }

    public function tambah_petugas($data, $table)
    {
        $this->db->insert($table, $data);
    }

    public function update_petugas($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    public function delete($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
        // $this->db->where($id);
        // $this->db->delete($table);
    }

    public function get_username($username)
    {
        $sql = "SELECT username FROM tb_petugas WHERE username = '$username' AND is_delete='1' ";
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
