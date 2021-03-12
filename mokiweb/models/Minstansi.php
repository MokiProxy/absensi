<?php

class Minstansi extends Mokiweb_Model
{

    public function getInstansi()
    {
        return $this->db->get('instansi')->result();
    }

    public function getInstansiById($id)
    {
        if ($id == "0") {
            $query = $this->db;
            return $query->get('instansi')->result();
        } else {
            $query = $this->db->where('id_instansi', $id);
            return $query->get('instansi')->result();
        }
    }

    public function insert_data($data)
    {
        return $this->db->insert('instansi', $data);
    }

    public function get_id($id)
    {

        return $this->db->where('id_instansi', $id)->get('instansi')->row();
    }

    public function update_data($id, $data)
    {
        return $this->db->where('id_instansi', $id)->update('instansi', $data);
    }

    public function delete_data($id)
    {
        $instansi = $this->db->get_where('instansi', ['id_instansi' => $id])->row()->instansi;
         $this->db->where('id_instansi', $id)->delete('instansi');
         return $instansi;
    }

    public function getInstansion($id_instansi = null)
    {
        if ($id_instansi != null) {
            return $this->db->get_where('instansi', ['id_instansi' => $id_instansi])->row_array();
        } else {
            return $this->db->get('instansi')->result_array();
        }
    }

    public function getInstansiKaryawan($id_pegawai)
    {
        $this->db->select('*');
        $this->db->from('instansi_pegawai');
        $this->db->join('instansi', 'instansi_pegawai.id_instansi = instansi.id_instansi');
        $this->db->where('instansi_pegawai.id_pegawai', $id_pegawai);
        $data = $this->db->get()->row_array();

        if ($data != null) {
            return $data;
        } else {
            return false;
        }
    }
}