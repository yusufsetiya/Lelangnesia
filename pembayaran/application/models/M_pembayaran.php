<?php
class M_pembayaran extends CI_Model
{
    private $table = 'tb_pembayaran';

    // public function get_level()
    // {
    //     return $this->db->get('tb_level')->result();
    // }

    public function get_bayar()
    {
        $sql = "SELECT * FROM tb_pembayaran JOIN tb_lelang ON tb_pembayaran.id_lelang=tb_lelang.id_lelang JOIN tb_barang ON tb_pembayaran.id_barang=tb_barang.id_barang JOIN tb_masyarakat ON tb_pembayaran.id_user=tb_masyarakat.id_user";
        return $this->db->query($sql)->result();
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

    public function get_perbayar($id_user)
    {
        $sql = "SELECT * FROM tb_lelang JOIN tb_barang ON tb_lelang.id_barang=tb_barang.id_barang JOIN tb_masyarakat ON tb_lelang.id_user=tb_masyarakat.id_user JOIN tb_pembayaran ON tb_pembayaran.id_lelang=tb_lelang.id_lelang WHERE tb_lelang.id_user= $id_user AND tb_pembayaran.status_bayar='belum'";
        return $this->db->query($sql)->result();
        // return $this->db->get('tb_petugas')->result();
    }

    public function get_sukses($id_user)
    {
        $sql = "SELECT * FROM tb_lelang JOIN tb_barang ON tb_lelang.id_barang=tb_barang.id_barang JOIN tb_masyarakat ON tb_lelang.id_user=tb_masyarakat.id_user JOIN tb_pembayaran ON tb_pembayaran.id_lelang=tb_lelang.id_lelang WHERE tb_lelang.id_user= $id_user AND tb_pembayaran.status_bayar='sudah'";
        return $this->db->query($sql)->result();
        // return $this->db->get('tb_petugas')->result();
    }
}
