<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mabsen extends Mokiweb_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function update($id = null, $data = null)
	{
		$this->db->where('id_absen', $id);
		$this->db->update('absen', $data);
		return $this->db->last_query();
	}
	public function data_absen()
	{
		// $this->db->select('*, pegawai.id_pegawai as pegawai_id');
		$this->db->join('pegawai', 'pegawai.id_pegawai=absen.id_pegawai_absen', 'left');
		$this->db->join('instansi', 'instansi.id_instansi = pegawai.instansi', 'left');
		$this->db->order_by('id_absen', 'desc');
		return $this->db->get('absen')->result_array();
	}

	public function data()
	{
		$this->db->join('pegawai', 'pegawai.id_pegawai=absen.id_pegawai_absen', 'left');
		$this->db->order_by('id_absen', 'desc');
		return $this->db->get('absen');
	}
	public function datamasuk()
	{
		$this->db->join('pegawai', 'pegawai.id_pegawai=absen.id_pegawai_absen', 'left');
		$this->db->where('masuk_absen!=', NULL);
		$this->db->order_by('id_absen', 'asc');
		return $this->db->get('absen');
	}
	public function datapulang()
	{
		$this->db->join('pegawai', 'pegawai.id_pegawai=absen.id_pegawai_absen', 'left');
		$this->db->where('pulang_absen!=', NULL);
		$this->db->order_by('id_absen', 'asc');
		return $this->db->get('absen');
	}
	public function cekabsen($nrp_pegawai)
	{
		$this->db->join('pegawai', 'pegawai.id_pegawai=absen.id_pegawai_absen', 'left');
		$this->db->where('nrp_pegawai', $nrp_pegawai);
		$this->db->order_by('id_absen', 'desc');
		$this->db->limit(1);
		return $this->db->get('absen');
	}
	public function simpanmasuk($id_pegawai)
	{
		$d['id_pegawai_absen'] = $id_pegawai;
		$d['masuk_absen'] = date('Y-m-d H:i:s');
		$d['lat_absen'] = $this->input->post('latitude');
		$d['long_absen'] = $this->input->post('longitude');
		$d['ip_absen'] = $_SERVER['REMOTE_ADDR'];
		$this->db->insert('absen', $d);
	}
	public function updatepulang($id_absen)
	{
		$d['pulang_absen'] = date('Y-m-d H:i:s');
		$this->db->where('id_absen', $id_absen);
		$this->db->update('absen', $d);
	}
	public function hapus()
	{
		$this->db->where('id_absen', $this->uri->segment(3));
		$this->db->delete('absen');
	}
	public function datatanggal($instansi = null, $tgldari, $tglsampai)
	{
		$this->db->join('pegawai', 'pegawai.id_pegawai = absen.id_pegawai_absen', 'left');
		$this->db->join('instansi', 'instansi.id_instansi = pegawai.instansi', 'left');
		$this->db->join('lokasi', 'lokasi.id_lokasi = pegawai.lokasi', 'left');

		if($instansi)
		{
			$this->db->where('instansi.id_instansi', $instansi);
		}

		$this->db->where('date(masuk_absen) BETWEEN "'.$tgldari.'" AND "'.$tglsampai.'"');
		$this->db->order_by('id_absen', 'desc');
		return $this->db->get('absen');
	}
}
