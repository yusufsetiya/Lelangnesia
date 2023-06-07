<?php
class M_dashboard extends CI_Model
{

    private $table = 'tb_barang';
    private $table_p = 'tb_masyarakat';
    private $petugas = 'tb_petugas';

    public function get_barang()
    {
        $sql = "SELECT * FROM tb_barang JOIN tb_lelang ON tb_barang.id_barang=tb_lelang.id_barang  WHERE tb_barang.status_lelang='dibuka' AND tb_barang.status_barang='1'";
        return $this->db->query($sql)->result();

        // $query = $this->db->query("SELECT * FROM tb_barang WHERE status_lelang='dibuka' AND status_barang = '1'")->result();
        // return $query;
        // return $this->db->get('tb_petugas')->result();
    }

    public function get_waktu()
    {
        $sql = "SELECT * FROM tb_barang";
        return $this->db->query($sql)->result_array();
    }

    public function tutup_lelang($id)
    {
        $sql = "UPDATE tb_barang SET status_lelang = 'ditutup' WHERE id_barang=$id";
        return $this->db->query($sql);
    }

    public function tbLelang_tutup($id)
    {
        $sql = "UPDATE tb_lelang SET status = 'ditutup' WHERE id_barang=$id";
        return $this->db->query($sql);
    }

    public function detail_barang($where, $table)
    {
        $sql = "SELECT * FROM tb_barang JOIN tb_lelang ON tb_barang.id_barang=tb_lelang.id_barang WHERE tb_barang.id_barang=$where AND tb_barang.status_lelang='dibuka'";
        return $this->db->query($sql);
        // return $this->db->get_where($table, $where);
        // return $this->db->get('tb_petugas')->result();
    }

    public function get_disable($verif)
    {
        $sql = "SELECT * FROM tb_pembayaran WHERE status_bayar='belum' AND id_user=$verif";
        return $this->db->query($sql)->result();
        // return $this->db->get_where($table, $where);
        // return $this->db->get('tb_petugas')->result();
    }

    public function get_verif($verif, $table_p)
    {
        return $this->db->get_where($table_p, $verif);
        // $query = $this->db->query("SELECT * FROM tb_masyarakat WHERE id_user = $verif")->result();
        // return $query;
        // return $this->db->get('tb_petugas')->result();
    }

    public function get_tawaran($where, $table)
    {
        // $query = $this->db->query("SELECT * FROM history_lelang JOIN tb_lelang ON history_lelang.id_lelang=tb_lelang.id_lelang JOIN tb_barang tb_lelang.id_barang=tb_barang.id_barang WHERE id_lelang = $where")->result();
        // return $query;
        $sql = "SELECT * FROM history_lelang JOIN tb_lelang ON history_lelang.id_barang=tb_lelang.id_barang JOIN tb_barang ON history_lelang.id_barang=tb_barang.id_barang JOIN tb_masyarakat ON history_lelang.id_user=tb_masyarakat.id_user WHERE history_lelang.id_barang =$where ORDER BY convert(history_lelang.penawaran_harga,decimal) DESC";
        return $this->db->query($sql);
        // $sql = "SELECT * FROM history_lelang JOIN tb_lelang ON history_lelang.id_barang=tb_lelang.id_barang JOIN tb_barang ON history_lelang.id_barang=tb_barang.id_barang JOIN tb_masyarakat ON history_lelang.id_user=tb_masyarakat.id_user WHERE history_lelang.id_barang =$where ORDER BY history_lelang.penawaran_harga DESC";
        // return $this->db->query($sql);
        // $sql = "SELECT * FROM $table WHERE id_lelang = $where";
        // return $this->db->query($sql)->result();
        // return $this->db->get_where($table, $where);
        // return $this->db->get('tb_petugas')->result();
    }

    public function get_tertinggi($where, $table)
    {
        $sql = "SELECT max(convert(penawaran_harga, decimal)) AS tertinggi FROM history_lelang JOIN tb_lelang ON history_lelang.id_barang=tb_lelang.id_barang WHERE history_lelang.id_barang =$where";
        return $this->db->query($sql)->row_array();
    }
    public function get_dtBayar($where)
    {
        $sql = "SELECT * FROM tb_lelang JOIN tb_pembayaran ON tb_lelang.id_lelang=tb_pembayaran.id_lelang JOIN tb_barang ON tb_lelang.id_barang=tb_barang.id_barang JOIN tb_masyarakat ON tb_masyarakat.id_user=tb_lelang.id_user JOIN tb_petugas ON tb_lelang.id_petugas=tb_petugas.id_petugas WHERE tb_lelang.id_lelang = $where";
        return $this->db->query($sql)->result();
    }

    public function jumlah_barang()
    {
        $sql = "SELECT COUNT(id_barang) AS jumlah FROM tb_barang WHERE status_barang ='1' OR status_barang='3'";
        return $this->db->query($sql)->row_array();
    }

    public function barang_dilelang()
    {
        $sql = "SELECT COUNT(id_barang) AS jumlah FROM tb_barang WHERE status_lelang='dibuka'";
        return $this->db->query($sql)->row_array();
    }

    public function bayar()
    {
        $sql = "SELECT COUNT(id_bayar) AS jumlah FROM tb_pembayaran WHERE status_bayar='belum'";
        return $this->db->query($sql)->row_array();
    }

    public function pelanggan()
    {
        $sql = "SELECT COUNT(id_user) AS jumlah FROM tb_masyarakat WHERE verif='2'";
        return $this->db->query($sql)->row_array();
    }
    public function petugas()
    {
        $sql = "SELECT COUNT(id_petugas) AS jumlah FROM tb_petugas WHERE id_level='5'";
        return $this->db->query($sql)->row_array();
    }

    public function telepon($where, $data, $petugas)
    {
        $this->db->where($where);
        $this->db->update($petugas, $data);
        // $this->db->insert($tb_lelang, $data);
    }
}
