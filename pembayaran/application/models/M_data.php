<?php

class M_data extends CI_Model
{
    private $tabel = "tb_lokasi_wisata";

    public function get_kategori()
    {
        return $this->db->get('tb_kategori')->result();
    }

    public function tampil_data()
    {
        $this->db->select('*');
        $this->db->from('tb_lokasi_wisata', 'tb_kategori');
        $this->db->join('tb_kategori', 'tb_kategori.id_kat = tb_lokasi_wisata.id_kat');
        $query = $this->db->get('');
        return $query->result();
    }

    public function tambah_data($data, $table)
    {
        $this->db->insert($table, $data);
    }

    public function detail($where, $table)
    {
        return $this->db->get_where($table, $where);
    }

    public function hapus_data($id, $table)
    {
        $this->db->where($id);
        $this->db->delete($table);
    }

    public function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
}
