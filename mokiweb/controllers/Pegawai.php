<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pegawai extends Mokiweb_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mpegawai');
		include APPPATH . 'views/tool/function.php';
	}

	public function tambah()
	{
		$this->Mpegawai->tambah();
		$this->session->set_flashdata('msg', 'simpan');
		redirect(base_url('admin/pegawai'));
	}

	public function edit()
	{
		$this->Mpegawai->edit();
		$this->session->set_flashdata('msg', 'edit');
		redirect(base_url('admin/pegawai'));
	}

	public function hapus()
	{
		$this->Mpegawai->hapus();
		$this->session->set_flashdata('msg', 'hapus');

		echo "oke";
		//redirect(base_url('admin/pegawai'));
	}
}
