<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Mkoordinat extends Mokiweb_Model
{
    public function getKoordinat()
    {
        return $this->db->join('lokasi', 'lokasi.id_lokasi = koordinat.id_lokasi', 'left')
            ->get('koordinat')->result();
    }

    public function insert_data($data)
	{
		return $this->db->insert('koordinat', $data);
	}

	public function get_id($id)
	{

		return $this->db->where('id_koordinat', $id)->get('koordinat')->row();
	}

	public function update_data($id, $data)
	{
		return $this->db->where('id_koordinat', $id)->update('koordinat', $data);
	}

	public function delete_data($id)
	{

		return $this->db->where('id_koordinat', $id)->delete('koordinat');
	}
}

/* End of file Mkoordinat.php */
