<?php
class M_penawaran extends CI_Model
{
    private $table = 'history_lelang';
    private $lelang = 'tb_lelang';
    private $tb_barang = 'tb_barang';
    private $tb_bayar = 'tb_pembayaran';

    public function get_data()
    {
        $query = $this->db->query("SELECT * FROM tb_lelang JOIN tb_barang ON tb_lelang.id_barang=tb_barang.id_barang ")->result();
        return $query;
    }

    public function get_detail($where, $lelang)
    {
        $sql = "SELECT * FROM tb_lelang JOIN tb_barang ON tb_lelang.id_barang=tb_barang.id_barang  WHERE id_lelang =$where";
        return $this->db->query($sql)->result();
        // return $this->db->get_where($lelang, $where);
        // return $this->db->get('tb_petugas')->result();
    }

    public function get_pemenang($where, $lelang)
    {
        $sql = "SELECT * FROM tb_lelang JOIN tb_barang ON tb_lelang.id_barang=tb_barang.id_barang WHERE id_lelang =$where";
        return $this->db->query($sql)->result();
        // return $this->db->get_where($lelang, $where);
        // return $this->db->get('tb_petugas')->result();
    }

    public function get_tawaran($where, $table)
    {
        // $query = $this->db->query("SELECT * FROM history_lelang JOIN tb_lelang ON history_lelang.id_lelang=tb_lelang.id_lelang JOIN tb_barang tb_lelang.id_barang=tb_barang.id_barang WHERE id_lelang = $where")->result();
        // return $query;
        $sql = "SELECT * FROM history_lelang JOIN tb_lelang ON history_lelang.id_lelang=tb_lelang.id_lelang JOIN tb_barang ON history_lelang.id_barang=tb_barang.id_barang JOIN tb_masyarakat ON history_lelang.id_user=tb_masyarakat.id_user WHERE history_lelang.id_lelang =$where ";
        return $this->db->query($sql)->result();
        // $sql = "SELECT * FROM $table WHERE id_lelang = $where";
        // return $this->db->query($sql)->result();
        // return $this->db->get_where($table, $where);
        // return $this->db->get('tb_petugas')->result();
    }

    public function get_user($where, $lelang)
    {
        $sql = "SELECT id_user FROM history_lelang WHERE id_history = $where";
        return $this->db->query($sql)->row_array();
        // return $this->db->get_where($lelang, $where);
        // return $this->db->get('tb_petugas')->result();
    }

    public function pemenang($where, $data, $lelang)
    {
        $this->db->where($where);
        $this->db->update($lelang, $data);
    }

    public function update_barang($patokan, $barang, $tb_barang)
    {
        $this->db->where($patokan);
        $this->db->update($tb_barang, $barang);
    }

    function pencarian($status)
    {
        $this->db->where("status", $status);
        return $this->db->get("tb_barang");
        // $sql = "SELECT * FROM tb_lelang JOIN tb_barang ON tb_lelang.id_barang=tb_barang.id_barang WHERE tb_barang.status_lelang=$status";
        // return $this->db->query($sql);

        // $query = $this->db->query("SELECT * FROM tb_lelang JOIN tb_barang ON tb_lelang.id_barang=tb_barang.id_barang WHERE id_barang.status_lelang=$status");
        // return $query;

        // $this->db->where("status",$status);
        // return $this->db->get("aps");
    }

    public function user_tawar($data, $table)
    {
        $this->db->insert($table, $data);
    }

    public function bayar($bayar, $tb_bayar)
    {
        $this->db->insert($tb_bayar, $bayar);
    }

    public function get_telp($where)
    {
        $sql = "SELECT telp AS telepon FROM tb_masyarakat WHERE id_user=$where";
        return $this->db->query($sql)->row_array();
        // return $this->db->get_where($lelang, $where);
        // return $this->db->get('tb_petugas')->result();
    }

    // public function get_petugas()
    // {
    //     $query = $this->db->query("SELECT * FROM tb_petugas WHERE id_level='5'")->result();
    //     return $query;
    //     // return $this->db->get('tb_petugas')->result();
    // }

    // public function tambah_petugas($data, $table)
    // {
    //     $this->db->insert($table, $data);
    // }

    // public function update_petugas($where, $data, $table)
    // {
    //     $this->db->where($where);
    //     $this->db->update($table, $data);
    // }

    // public function hapus_data($id)
    // {
    //     $this->db->where('id_petugas', $id);
    //     return $this->db->delete('tb_petugas');
    //     // $this->db->where($id);
    //     // $this->db->delete($table);
    // }
}
