<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Logger extends Mokiweb_Model
{
    public function write($pesan)
    {
        $query = $this->db->query("SELECT current_timestamp as c");
        $row = $query->row();
        $waktu = $row->c;
        $id_admin = $this->session->userdata('id_admin');
        $ip_address = $_SERVER['REMOTE_ADDR'];
        if($id_admin){

            $data = array(
                'id_admin' => $id_admin,
                'ip_address' => $ip_address,
                'date_create' => $waktu,
                'activity' => $pesan,
            );
            
            $this->db->insert('admin_log', $data);
        }
    }
}

/* End of file Logger.php */