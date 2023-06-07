<?php
class M_barang extends CI_Model
{
    private $table = 'tb_barang';
    private $tb_lelang = 'tb_tb_lelang';

    public function get_petugas()
    {
        return $this->db->get('tb_petugas')->result();
    }

    public function get_barang()
    {

        // $query = $this->db->query("SELECT * FROM tb_barang JOIN tb_petugas ON tb_barang.petugas=tb_petugas.id_petugas JOIN tb_lelang ON tb_lelang.id_barang=tb_barang.id_barang ")->result();
        // return $query;

        $this->db->select('*');
        $this->db->from('tb_barang', 'tb_petugas', 'tb_lelang');
        $this->db->join('tb_petugas', 'tb_petugas.id_petugas = tb_barang.petugas');
        // $this->db->join('tb_lelang', 'tb_lelang.id_id_barang = tb_barang.id_barang');
        $query = $this->db->get('');
        return $query->result();

        // $query = $this->db->query("SELECT * FROM tb_barang")->result();
        // return $query;
        // return $this->db->get('tb_petugas')->result();
    }

    public function get_detail($where, $table)
    {
        return $this->db->get_where($table, $where);
        // return $this->db->get('tb_petugas')->result();
    }

    public function update_barang($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    public function tambah_data($data, $table)
    {
        $this->db->insert($table, $data);
        $sql = "SELECT MAX(id_barang) AS id_barang FROM $table";
        return $this->db->query($sql)->row_array();
    }
    public function tambah_lelang($lelang, $tb_lelang)
    {
        $this->db->insert($tb_lelang, $lelang);
    }

    public function hapus_data($id, $table)
    {
        $this->db->where($id);
        $this->db->delete($table);
    }

    public function open($where, $data, $tb_lelang)
    {
        $this->db->where($where);
        $this->db->update($tb_lelang, $data);
        // $this->db->insert($tb_lelang, $data);
    }

    public function open_update($where, $openUpdate, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $openUpdate);
    }

    public function tutup($where, $tutup, $tb_lelang)
    {
        $this->db->where($where);
        $this->db->update($tb_lelang, $tutup);
    }

    public function get_idBarang()
    {
        $query = $this->db->query("SELECT * FROM tb_barang ")->row_array();
        return $query;
    }
}
