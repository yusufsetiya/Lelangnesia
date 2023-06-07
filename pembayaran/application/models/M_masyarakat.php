<?php
class M_masyarakat extends CI_Model
{
    private $table = 'tb_masyarakat';

    public function get_masyarakat()
    {
        $query = $this->db->query("SELECT * FROM tb_masyarakat WHERE verif='1'")->result();
        return $query;
        // return $this->db->get('tb_petugas')->result();
    }
    public function get_verif()
    {
        $query = $this->db->query("SELECT * FROM tb_masyarakat WHERE verif='2'")->result();
        return $query;
        // return $this->db->get('tb_petugas')->result();
    }

    public function get_blokir()
    {
        $query = $this->db->query("SELECT * FROM tb_masyarakat WHERE verif='3'")->result();
        return $query;
        // return $this->db->get('tb_petugas')->result();
    }

    public function verif($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
        // return $this->db->get('tb_petugas')->result();
    }

    public function get_profile($where)
    {
        $query = $this->db->query("SELECT * FROM tb_masyarakat WHERE id_user = $where")->result();
        return $query;
        // return $this->db->get('tb_petugas')->result();
    }

    public function update_masyarakat($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    public function cek_old($where)
    {
        $query = $this->db->query("SELECT password FROM tb_masyarakat WHERE id_user = $where")->result();
        return $query;

        // $old = md5($this->input->post('old'));
        // $this->db->where('password', $old);
        // $query = $this->db->get('tb_masyarakat');
        // return $query->result();
    }

    public function save_pwd()
    {
        $pass = md5($this->input->post('new'));
        $view_pass = $this->input->post('new');
        $data = array(
            'password' => $pass,
            'v_password' => $view_pass,
        );
        $this->db->where('id_user', $this->session->userdata('id_masyarakat'));
        $this->db->update('tb_masyarakat', $data);
    }

    public function hapus_data($id, $table)
    {
        $this->db->where($id);
        $this->db->delete($table);
    }
}
