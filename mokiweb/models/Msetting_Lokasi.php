<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Msetting_Lokasi extends Mokiweb_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	public function lock()
	{
		$this->db->order_by('nama_pegawai', 'asc');
		return $this->db->get('pegawai');
	}
	public function tambah()
	{
		$id_pegawai = $this->input->post('pegawai');
		$id_lokasi = $this->input->post('lokasi');
		$d = array();
		for ($i=0; $i < count($id_lokasi) ; $i++) { 
			$d[] = array(
				"id_pegawai" => $id_pegawai,
				"id_lokasi"	 => $id_lokasi[$i]
			);
		}
		$this->db->insert_batch('relasi_pegawai', $d);
	}
	public function edit()
	{
		$id_pegawai = $this->input->post('pegawai');
		$id_lokasi = $this->input->post('lokasi');
		$this->db->delete('relasi_pegawai', ["id_pegawai" => $this->uri->segment(3)]);
		$d = array();
		for ($i=0; $i < count($id_lokasi) ; $i++) { 
			$d[] = array(
				"id_pegawai" => $id_pegawai,
				"id_lokasi"	 => $id_lokasi[$i]
			);
		}
		$this->db->insert_batch('relasi_pegawai', $d);
	}
	public function hapus()
	{
		$this->db->where('id_pegawai', $this->uri->segment(3));
		$this->db->delete('relasi_pegawai');
	}
}
