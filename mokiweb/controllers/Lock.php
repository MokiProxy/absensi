<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lock extends Mokiweb_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mlock');
		include APPPATH . 'views/tool/function.php';
	}
	public function tambah()
	{
		$this->Mlock->tambah();
		$this->session->set_flashdata('msg', 'simpan');
		redirect(base_url('admin/lock'));
	}
	public function edit()
	{
		$this->Mlock->edit();
		$this->session->set_flashdata('msg', 'edit');
		redirect(base_url('admin/lock'));
	}
	public function hapuslock()
	{
		$id = $this->uri->segment(3);
		$this->Mlock->hapuslok($id);
		$this->session->set_flashdata('msg', 'hapus');

		// echo "oke";
		// $id = $this->uri->segment(3);

		// $this->Mizin->hapus($id);

		// $this->session->set_flashdata('msg', 'hapus');
		//redirect(base_url('admin/pegawai'));
	}
}
