<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mauth extends Mokiweb_Model {
	public function login(){
		$this->db->where('username_admin',$this->input->post('username'));
		$this->db->where('password_admin',md5($this->input->post('password')));
		return $this->db->get('admin');
	}
	public function lastloginadmin($id_admin){
		$d['lastlogin_admin']= date('Y-m-d H:i:s');
		$this->db->where('id_admin',$id_admin);
		$this->db->update('admin',$d);
	}
	public function akunadmin($id_admin){
		$this->db->where('id_admin',$id_admin);
		return $this->db->get('admin');
	}
	public function profildenganpassword(){
		$d['nama_admin']= $this->input->post('nama_admin');
		$d['username_admin']= $this->input->post('username_admin');
		$d['password_admin']= md5($this->input->post('password_admin'));
		$d['admin']= $this->input->post('password_admin');
		$this->db->where('id_admin',$this->session->userdata('id_admin'));
		$this->db->update('admin',$d);
	}
	public function editprofil(){
		$d['nama_admin']= $this->input->post('nama_admin');
		$d['username_admin']= $this->input->post('username_admin');
		$this->db->where('id_admin',$this->session->userdata('id_admin'));
		$this->db->update('admin',$d);
	}
}