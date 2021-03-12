<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Mpegawai extends Mokiweb_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function data_pegawai()
	{
		$this->db->order_by('nama_pegawai', 'asc');
		return $this->db->get('pegawai')->result_array();
	}

	public function data()
	{
		$this->db->order_by('nama_pegawai', 'asc');
		return $this->db->get('pegawai');
	}

	public function tambah()
	{
		// $idfp_pegawai = $this->input->post('idfp_pegawai');
		$nama_pegawai = $this->input->post('nama_pegawai');
		$jk_pegawai = $this->input->post('jk_pegawai');
		$nrp_pegawai = $this->input->post('nrp_pegawai');
		$departemen_pegawai = $this->input->post('departemen_pegawai');
		$jabatan_pegawai = $this->input->post('jabatan_pegawai');
		$lokasi_pegawai = $this->input->post('lokasi_pegawai');
		$status_pegawai = $this->input->post('status_pegawai');
		$instansi_pegawai = $this->input->post('instansi_pegawai');
		$this->db->insert('pegawai', [
			// 'idfp_pegawai' => $idfp_pegawai,
			'nama_pegawai' => $nama_pegawai,
			'jk_pegawai' => $jk_pegawai,
			'nrp_pegawai' => $nrp_pegawai,
			'departemen_pegawai' => $departemen_pegawai,
			'jabatan_pegawai' => $jabatan_pegawai,
			'status_pegawai' => $status_pegawai,
			'lokasi' => $lokasi_pegawai,
			'instansi' => $instansi_pegawai
		]);

		$data = $this->db->get_where('pegawai', ['nrp_pegawai' => $nrp_pegawai])->row_array();

		$this->db->insert('lokasi_pegawai', [
			'id_lokasi' => $lokasi_pegawai,
			'id_pegawai' => $data['id_pegawai']
		]);
	}

	public function detailpegawai()
	{
		$this->db->where('id_pegawai', $this->uri->segment(3));
		return $this->db->get('pegawai');
	}

	public function edit()
	{
		// $idfp_pegawai = $this->input->post('idfp_pegawai');
		$nama_pegawai = $this->input->post('nama_pegawai');
		$jk_pegawai = $this->input->post('jk_pegawai');
		$nrp_pegawai = $this->input->post('nrp_pegawai');
		$departemen_pegawai = $this->input->post('departemen_pegawai');
		$jabatan_pegawai = $this->input->post('jabatan_pegawai');
		$lokasi_pegawai = $this->input->post('lokasi_pegawai');
		$status_pegawai = $this->input->post('status_pegawai');
		$instansi_pegawai = $this->input->post('instansi_pegawai');
		$this->db->where('id_pegawai', $this->input->post('id_pegawai'));
		$this->db->update(
			'pegawai',
			[
				// 'idfp_pegawai' => $idfp_pegawai,
				'nama_pegawai' => $nama_pegawai,
				'jk_pegawai' => $jk_pegawai,
				'nrp_pegawai' => $nrp_pegawai,
				'departemen_pegawai' => $departemen_pegawai,
				'jabatan_pegawai' => $jabatan_pegawai,
				'status_pegawai' => $status_pegawai,
				'instansi' => $instansi_pegawai
			],
			[
				'id_pegawai' =>  $this->input->post('id_pegawai')
			]
		);

		$this->db->update(
			'lokasi_pegawai',
			[
				'id_lokasi' => $lokasi_pegawai,
			],
			[
				'id_pegawai' => $this->input->post('id_pegawai')
			]
		);
	}

	public function hapus()
	{
		$this->db->where('id_pegawai', $this->uri->segment(3));
		$this->db->delete('pegawai');
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
