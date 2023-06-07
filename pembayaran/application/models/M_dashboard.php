<?php
class M_dashboard extends CI_Model
{

    private $table = 'tb_barang';
    private $table_p = 'tb_masyarakat';

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

    public function detail_barang($where, $table)
    {
        $sql = "SELECT * FROM tb_barang JOIN tb_lelang ON tb_barang.id_barang=tb_lelang.id_barang  WHERE tb_barang.id_barang=$where";
        return $this->db->query($sql);
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
        $sql = "SELECT * FROM history_lelang JOIN tb_lelang ON history_lelang.id_barang=tb_lelang.id_barang JOIN tb_barang ON history_lelang.id_barang=tb_barang.id_barang JOIN tb_masyarakat ON history_lelang.id_user=tb_masyarakat.id_user WHERE history_lelang.id_barang =$where";
        return $this->db->query($sql);
        // $sql = "SELECT * FROM $table WHERE id_lelang = $where";
        // return $this->db->query($sql)->result();
        // return $this->db->get_where($table, $where);
        // return $this->db->get('tb_petugas')->result();
    }

    public function get_tertinggi($where, $table)
    {
        $sql = "SELECT max(penawaran_harga) AS tertinggi FROM history_lelang JOIN tb_lelang ON history_lelang.id_barang=tb_lelang.id_barang WHERE history_lelang.id_barang =$where";
        return $this->db->query($sql)->row_array();
    }
    public function get_dtBayar($where)
    {
        $sql = "SELECT * FROM tb_lelang JOIN tb_pembayaran ON tb_lelang.id_lelang=tb_pembayaran.id_lelang JOIN tb_barang ON tb_lelang.id_barang=tb_barang.id_barang JOIN tb_masyarakat ON tb_masyarakat.id_user=tb_lelang.id_user WHERE tb_lelang.id_lelang = $where";
        return $this->db->query($sql)->result();
    }
}
