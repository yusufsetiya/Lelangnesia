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
        $query = $this->db->query("SELECT * FROM tb_petugas WHERE id_level='5'")->result();
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

    public function hapus_data($id)
    {
        $this->db->where('id_petugas', $id);
        return $this->db->delete('tb_petugas');
        // $this->db->where($id);
        // $this->db->delete($table);
    }
}
