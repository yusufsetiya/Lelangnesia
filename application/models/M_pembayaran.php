<?php
class M_pembayaran extends CI_Model
{
    private $table = 'tb_pembayaran';
    private $tb_barang = 'tb_barang';
    private $tb_lelang = 'tb_lelang';
    private $history = 'history_lelang';

    // public function get_level()
    // {
    //     return $this->db->get('tb_level')->result();
    // }

    public function get_bayar()
    {
        $sql = "SELECT * FROM tb_pembayaran JOIN tb_lelang ON tb_pembayaran.id_lelang=tb_lelang.id_lelang JOIN tb_barang ON tb_pembayaran.id_barang=tb_barang.id_barang JOIN tb_masyarakat ON tb_pembayaran.id_user=tb_masyarakat.id_user WHERE tb_pembayaran.status_bayar='belum'";
        return $this->db->query($sql)->result();
        // return $this->db->get('tb_petugas')->result();
    }

    public function get_lunas()
    {
        $sql = "SELECT * FROM tb_pembayaran JOIN tb_lelang ON tb_pembayaran.id_lelang=tb_lelang.id_lelang JOIN tb_barang ON tb_pembayaran.id_barang=tb_barang.id_barang JOIN tb_masyarakat ON tb_pembayaran.id_user=tb_masyarakat.id_user WHERE tb_pembayaran.status_bayar='sudah'";
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

    public function W_bayar($id)
    {
        $sql = "SELECT * FROM tb_pembayaran WHERE id_user = $id";
        return $this->db->query($sql)->result();
    }

    public function update_barang($where, $barang, $tb_barang)
    {
        $this->db->where($where);
        $this->db->update($tb_barang, $barang);
    }

    public function update_lelang($where, $lelang, $tb_lelang)
    {
        $this->db->where($where);
        $this->db->update($tb_lelang, $lelang);
    }

    public function update_barangb($where, $barang, $tb_barang)
    {
        $this->db->where($where);
        $this->db->update($tb_barang, $barang);
    }

    public function get_ambil($sekarang)
    {
        $sql = "SELECT batas_bayar AS jam FROM tb_pembayaran WHERE batas_bayar<='$sekarang'";
        return $this->db->query($sql)->row_array();
    }

    public function hapus_bayar($id, $table)
    {
        $this->db->where($id);
        $this->db->delete($table);
    }

    public function hapus_tawaran($id_user, $id)
    {
        $sql = "DELETE FROM history_lelang WHERE id_user='$id_user' AND id_barang = '$id'";
        return $this->db->query($sql);
    }
}
