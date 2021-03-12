<?php

class Mlocation extends Mokiweb_Model
{

	public function getLocation()
	{
		return $this->db->get('lokasi')->result();
	}

	public function getLocationById($id)
	{
		if ($id == "0") {
			$query = $this->db;
			return $query->get('lokasi')->result();
		} else {
			$query = $this->db->where('id_lokasi', $id);
			return $query->get('lokasi')->result();
		}
	}

	public function insert_data($data)
	{
		return $this->db->insert('lokasi', $data);
	}

	public function get_id($id)
	{

		return $this->db->where('id_lokasi', $id)->get('lokasi')->row();
	}

	public function update_data($id, $data)
	{
		return $this->db->where('id_lokasi', $id)->update('lokasi', $data);
	}

	public function delete_data($id)
	{

		return $this->db->where('id_lokasi', $id)->delete('lokasi');
	}

	public function getLokasi()
	{
		return $this->db->get('lokasi')->result_array();
	}

	public function getLokasiKaryawan($id_pegawai)
	{
		$this->db->select('*');
		$this->db->from('lokasi_pegawai');
		$this->db->join('lokasi', 'lokasi_pegawai.id_lokasi = lokasi.id_lokasi');
		$this->db->where('lokasi_pegawai.id_pegawai', $id_pegawai);
		// $this->db->select('*');
		// $this->db->from('lokasi');
		// $this->db->where('lokasi.id_lokasi', $id_lokasi);
		$data = $this->db->get()->row_array();

		if ($data != null) {
			return $data;
		} else {
			return false;
		}
	}

	public function getLatAndLongPosisi($id_lokasi)
	{
		return $this->db->get_where('lock_posisi', ['id_lokasi' => $id_lokasi])->row_array();
	}

	// function getDistanceBetweenPoints($lat, $lon, $lat2, $lon2)
	// {
	// 	$theta 			= $lon - $lon2;
	// 	$miles 			= (sin(deg2rad($lat)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
	// 	$miles 			= acos($miles);
	// 	$miles 			= rad2deg($miles);
	// 	$miles 			= $miles * 60 * 1.1515;
	// 	$feet 			= $miles * 5280;
	// 	$yards 			= $feet / 3;
	// 	$kilometers 	= $miles * 1.609344;
	// 	$meters 		= $kilometers * 1000;
	// 	return compact('miles', 'feet', 'yards', 'kilometers', 'meters');
	// }

	public function getDistanceBetweenPoints(
        $latitudeFrom = 0, $longitudeFrom = 0, $latitudeTo = 0, $longitudeTo = 0, $earthRadius = 6371000) {
        // convert from degrees to radians
        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($latitudeTo);
        $lonTo = deg2rad($longitudeTo);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
            cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
        return $angle * $earthRadius;
	}
	

	public function getKoordinat($id_lokasi)
	{
		return $this->db->get_where('koordinat', ['id_lokasi' => $id_lokasi])->row_array();
	}
}