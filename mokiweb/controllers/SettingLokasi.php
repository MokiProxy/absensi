<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SettingLokasi extends Mokiweb_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Msetting_lokasi');
		include APPPATH . 'views/tool/function.php';
	}
	public function tambah()
	{
		$this->Msetting_lokasi->tambah();
		$this->session->set_flashdata('msg', 'simpan');
		redirect(base_url('admin/settlokasi'));
	}
	public function edit()
	{
		$this->Msetting_lokasi->edit();
		$this->session->set_flashdata('msg', 'edit');
		redirect(base_url('admin/settlokasi'));
	}
	public function hapus()
	{
		$this->Msetting_lokasi->hapus();
		$this->session->set_flashdata('msg', 'hapus');

		// redirect(base_url('admin/settlokasi'));
	}
}
