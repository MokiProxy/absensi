<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Mlock extends Mokiweb_Model
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
		$d['id_lokasi'] = $this->input->post('lokasi');
		$d['long'] = $this->input->post('long');
		$d['lang'] = $this->input->post('lang');
		$this->db->insert('lock_posisi', $d);
	}
	public function detailpegawai()
	{
		$this->db->where('id_lock', $this->uri->segment(3));
		return $this->db->get('lock_posisi');
	}
	public function edit()
	{
		
		$d['id_lokasi'] = $this->input->post('lokasi');
		$d['long'] = $this->input->post('long');
		$d['lang'] = $this->input->post('lang');
		$this->db->where('id_lock', $this->input->post('id_lock'));
		$this->db->update('lock_posisi', $d);
	}

	public function hapuslok($id)
	{
		$this->db->where('id_lock', $id);
		$this->db->delete('lock_posisi');
	}

	public function getone($id_pegawai)
	{
		$this->db->where('id_pegawai', $id_pegawai);
		return $this->db->get('pegawai');
	}
	public function getonenrp($nrp_pegawai)
	{
		$this->db->where('nrp_pegawai', $nrp_pegawai);
		return $this->db->get('pegawai');
	}
}
