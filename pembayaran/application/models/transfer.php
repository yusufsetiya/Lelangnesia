<?php
class transfer extends CI_Model
{
    private $table = 'p_pembayaran';
    private $bayar = 'tp_pembayaran';
    private $barang = 'tb_barang';
    private $banking = 'm_banking';

    public function bayar($data, $table)
    {
        $this->db->insert($table, $data);
    }

    public function saldo($id)
    {
        $sql = "SELECT * FROM m_banking WHERE id_banking = $id";
        return $this->db->query($sql)->result();
    }

    public function cek_saldo($id)
    {
        $sql = "SELECT saldo AS saldos FROM m_banking where id_banking='$id'";
        return $this->db->query($sql)->row_array();
    }

    // public function saldos($id)
    // {
    //     $sql = "SELECT saldo AS saldoa FROM m_banking WHERE id_banking = $id";
    //     return $this->db->query($sql)->row_array();
    // }

    public function get_tampung()
    {
        $sql = "SELECT MAX(id_tampung) AS idT FROM p_pembayaran";
        return $this->db->query($sql)->row_array();
    }

    public function get_va($va)
    {
        $sql = "SELECT id_bayar AS idBr FROM tb_pembayaran WHERE va='$va' AND status_bayar='belum' ";
        return $this->db->query($sql)->row_array();
    }

    public function get_user($va)
    {
        $sql = "SELECT id_user AS user FROM tb_pembayaran WHERE va='$va' AND status_bayar='belum'";
        return $this->db->query($sql)->row_array();
    }

    public function get_jumlah($va)
    {
        $sql = "SELECT jumlah_bayar AS jumlahs FROM tb_pembayaran WHERE va='$va' AND status_bayar='belum'";
        return $this->db->query($sql)->row_array();
    }

    public function join($idT)
    {
        $sql = "SELECT * FROM p_pembayaran JOIN tb_pembayaran ON p_pembayaran.id_bayar=tb_pembayaran.id_bayar JOIN tb_masyarakat ON p_pembayaran.id_user=tb_masyarakat.id_user JOIN m_banking ON p_pembayaran.id_banking=m_banking.id_banking WHERE p_pembayaran.id_tampung=$idT AND tb_pembayaran.status_bayar='belum'";
        return $this->db->query($sql)->result();
    }

    public function selesai($where, $data, $bayar)
    {
        $this->db->where($where);
        $this->db->update($bayar, $data);
    }

    public function update_br($jika, $isi, $barang)
    {
        $this->db->where($jika);
        $this->db->update($barang, $isi);
    }

    public function get_saldo($sald, $saldo, $banking)
    {
        $this->db->where($sald);
        $this->db->update($banking, $saldo);
    }

    //cek nim dan password mahasiswa
    function auth_masyarakat($username, $password)
    {
        $query = $this->db->query("SELECT * FROM tb_masyarakat WHERE username='$username' AND password =MD5('$password') LIMIT 1");
        return $query;
    }

    public function register($data, $table)
    {
        $this->db->insert($table, $data);
    }

    public function cek_pin($pin, $id)
    {
        $sql = "SELECT pin AS pinr FROM m_banking WHERE pin='$pin' AND id_banking = $id";
        return $this->db->query($sql)->row_array();
    }

    function cek_va($va)
    {
        $query = $this->db->query("SELECT * FROM tb_pembayaran WHERE va='$va' AND status_bayar ='belum' LIMIT 1");
        return $query;
    }
}
