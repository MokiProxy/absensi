<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends Mokiweb_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Mauth');

		include APPPATH.'views/tool/function.php';
	}
	public function index(){
		$this->load->view('absen');
	}

	public function foto(){
		$this->load->view('foto');
	}

	public function save_foto(){
		$nama_file = time().'.jpg';
		$direktori = 'file/foto/';
		$target = $direktori.$nama_file;

		
		move_uploaded_file($_FILES['webcam']['tmp_name'], $target);
			$data = array(
				'nama_file' => $nama_file
			);

			
			$this->db->insert('foto', $data);
		
		
	}

	public function authadmin(){
		$this->load->view('auth');
	}
	public function login(){
		$cek= $this->Mauth->login();
		if($cek->num_rows() > 0){
			$data= $cek->row();
			$this->Mauth->lastloginadmin($data->id_admin);
			$this->session->set_userdata('id_admin',$data->id_admin);
			$this->session->set_userdata('hak_akses',$data->hak_akses);
			
			$this->session->set_userdata('islogin','admin');
			$this->Logger->write('Login');
			redirect(base_url('admin'));
		}
		else{
			$this->session->set_flashdata('msg','gagal');
			redirect(base_url());
		}
	}
}