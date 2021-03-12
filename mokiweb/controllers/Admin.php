<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends Mokiweb_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('template');
		$this->load->model('Mauth');
		$this->load->model('Mpegawai');
		$this->load->model('Mabsen');
		$this->load->model('Mlocation');
		$this->load->model('Mkoordinat');
		$this->load->model('Mlock');
		$this->load->model('Minstansi');

		include APPPATH . 'views/tool/function.php';
	}
	public function index()
	{
		$d['title'] = 'Dashboard';
		$d['pegawai'] = $this->Mpegawai->data();
		$d['absen'] = $this->Mabsen->data();
		$d['absenmasuk'] = $this->Mabsen->datamasuk();
		$d['absenpulang'] = $this->Mabsen->datapulang();
		$this->Logger->write('Membuka Menu Dashboard');
		$this->template->admin('admin/home', $d);
	}
	public function logout()
	{
		$this->Logger->write('Logout');
		$this->session->unset_userdata('id_admin');
		$this->session->unset_userdata('islogin');
		redirect(base_url());
	}
	//profil
	public function profil()
	{
		$this->Logger->write('Mmembuka Menu Profil');
		$this->template->admin('admin/setting/profil');
	}
	public function prosesprofil()
	{
		$this->Logger->write('Update data Profil');
		if ($this->input->post('password_admin') != null) {
			if (md5($this->input->post('password_admin')) == md5($this->input->post('ulangi_password'))) {
				$this->Mauth->profildenganpassword();
				$this->session->set_flashdata('msg', 'edit');
				redirect(base_url('admin/profil'));
				//echo "1";
			} else {
				$this->session->set_flashdata('msg', 'passsalah');
				redirect(base_url('admin/profil'));
				//echo "2";
			}
		} else {
			$this->session->set_flashdata('msg', 'edit');
			$this->Mauth->editprofil();
			redirect(base_url('admin/profil'));
			//echo "3";
		}
	}

	//pegawai
	public function pegawai()
	{
		$this->Logger->write('Membuka Menu Pegawai');
		$d['title'] = 'Data Pegawai';
		$d['pegawai'] = $this->Mpegawai->data();
		$this->template->admin('admin/pegawai/data', $d);
	}

	public function tambahpegawai()
	{
		$this->Logger->write('Membuka Menu Tambah Pegawai');
		include APPPATH . 'views/admin/pegawai/tambah.php';
	}

	public function editpegawai()
	{
		$this->Logger->write('Membuka Menu Edit Pegawai');
		$pegawai = $this->Mpegawai->detailpegawai();
		include APPPATH . 'views/admin/pegawai/edit.php';
	}

	public function importpegawai()
	{
		$this->Logger->write('Membuka Menu Import Pegawai');
		include APPPATH . 'views/admin/pegawai/import.php';
	}

	//absen
	public function absen()
	{
		$this->Logger->write('Membuka Menu Absen');
		$d['title'] = 'Data absen';
		$d['absen'] = $this->Mabsen->data();
		$this->template->admin('admin/absen/data', $d);
	}

	public function data_absen()
	{
		$result = [
			'status' 	=> true,
			'message' 	=> 'success load the data',
			'data' 	=> $this->Mabsen->data_absen()
		];

		echo json_encode($result);
	}

	// Lokasi
	public function lokasi()
	{
		$this->Logger->write('Membuka Menu Lokasi');
		$data['location'] = $this->Mlocation->getLocation();
		$this->template->admin('admin/lokasi/data', $data);
	}

	public function tambahlokasi()
	{
		$this->Logger->write('Membuka Menu Tambah Lokasi');
		$this->load->view('admin/lokasi/add');
	}

	public function tl_aksi()
	{
		$lokasi = $this->input->post('lokasi', TRUE);
		$data = array('nama_lokasi' => $lokasi);
		$this->Mlocation->insert_data($data);
		$this->session->set_flashdata('msg', 'simpan');
		$this->Logger->write('Tambah Loaksi '.$lokasi);
		redirect('admin/lokasi');
	}

	public function tl_editaksi()
	{
		$lokasi = $this->input->post('lokasi', TRUE);
		$id = $this->input->post('id', TRUE);
		$data = array('nama_lokasi' => $lokasi);
		$this->Mlocation->update_data($id, $data);
		$this->session->set_flashdata('msg', 'edit');
		$this->Logger->write('Edit Lokasi id : '.$id);
		redirect('admin/lokasi');
	}

	public function hapuslokasi($id)
	{
		$this->Logger->write('Hapus Lokasi id : '.$id);
		$this->Mlocation->delete_data($id);
		$this->session->set_flashdata('msg', 'hapus');
		redirect('admin/lokasi');
	}

	public function editlokasi($id = NULL)
	{
		$data['row'] = $this->Mlocation->get_id($id);
		$this->Logger->write('Membuka Menu Edit Lokasi '.$data['row']->nama_lokasi);
		$this->load->view('admin/lokasi/edit', $data);
	}

	//Instansi

	public function data_instansi()
	{
		$result = [
			'status' 	=> true,
			'message' 	=> 'success load the data',
			'data' 	=> $this->Minstansi->getInstansi()
		];

		echo json_encode($result);
	}
	public function instansi()
	{
		$this->Logger->write('Membuka Menu Instansi');
		$data['instansi'] = $this->Minstansi->getInstansi();
		$this->template->admin('admin/instansi/data', $data);
	}

	public function tambahinstansi()
	{
		$this->Logger->write('Membuka Menu Tambah Instansi');
		$this->load->view('admin/instansi/add');
	}

	public function ti_aksi()
	{
		$instansi = $this->input->post('instansi', TRUE);
		$data = array('instansi' => $instansi);
		$this->Minstansi->insert_data($data);
		$this->session->set_flashdata('msg', 'simpan');
		$this->Logger->write('Tambah Instansi '.$instansi);
		redirect('admin/instansi');
	}

	public function ti_editaksi()
	{
		$instansi = $this->input->post('instansi', TRUE);
		$id = $this->input->post('id', TRUE);
		$data = array('instansi' => $instansi);
		$this->Minstansi->update_data($id, $data);
		$this->session->set_flashdata('msg', 'edit');
		$this->Logger->write('Edit Instansi '.$instansi);
		redirect('admin/instansi');
	}

	public function hapusinstansi($id)
	{
		$instansi = $this->Minstansi->delete_data($id);
		$this->session->set_flashdata('msg', 'hapus');
		$this->Logger->write('Hapus Instansi '.$instansi);
		redirect('admin/instansi');
	}

	public function editinstansi($id = NULL)
	{
		$data['row'] = $this->Minstansi->get_id($id);
		$this->Logger->write('Membuka Menu Edit Instansi '.$data['row']->instansi);
		$this->load->view('admin/instansi/edit', $data);
	}


	//Koordinat

	public function koordinat()
	{
		$this->Logger->write('Membuka Menu Koordinat');
		$d['koordinat'] = $this->Mkoordinat->getKoordinat();
		$this->template->admin('admin/koordinat/data', $d);
	}

	public function tambahkoordinat()
	{
		$this->Logger->write('Membuka Menu Tambah Koordinat');
		$d['lokasi'] = $this->Mlocation->getLocation();
		$this->load->view('admin/koordinat/add', $d);
	}

	public function editkoordinat($id = NULL)
	{
		$d['lokasi'] = $this->Mlocation->getLocation();
		$d['row'] = $this->Mkoordinat->get_id($id);
		$id_lokasi = $d['row']->id_lokasi;
		$nama_lokasi = $this->db->query("select nama_lokasi from lokasi where id_lokasi = '$id_lokasi'")->row()->nama_lokasi;
		$this->Logger->write('Membuka Menu Edit Koordinat Lokasi '.$nama_lokasi);
		$this->load->view('admin/koordinat/edit', $d);
	}

	public function addkoordinataction()
	{
		$lokasi = $this->input->post('lokasi');
		$koordinat = $this->input->post('koordinat');
		$data = array(
			'id_lokasi' => $lokasi,
			'jarak' => $koordinat
		);
		$this->Mkoordinat->insert_data($data);
		$this->session->set_flashdata('msg', 'simpan');
		$this->Logger->write('Tambah Koordinat '.$koordinat.' Lokasi '.$lokasi);
		redirect(base_url('admin/koordinat'));
	}


	public function editkoordinataction()
	{
		$id = $this->input->post('id');

		$lokasi = $this->input->post('lokasi');
		$koordinat = $this->input->post('koordinat');
		$data = array(
			'id_lokasi' => $lokasi,
			'jarak' => $koordinat
		);
		$this->Mkoordinat->update_data($id, $data);
		$this->session->set_flashdata('msg', 'edit');
		$nama_lokasi = $this->db->query("select nama_lokasi from lokasi where id_lokasi = '$lokasi'")->row()->nama_lokasi;
		$this->Logger->write('Edit Koordinat Lokasi '.$nama_lokasi);
		redirect(base_url('admin/koordinat'));
	}


	public function deletekoordinat()
	{
		$id = $this->uri->segment(3);
		
		$data = $this->Mkoordinat->get_id($id);
		$id_lokasi = $data->id_lokasi;
		$nama_lokasi = $this->db->query("select nama_lokasi from lokasi where id_lokasi = '$id_lokasi'")->row()->nama_lokasi;
		
		$this->Mkoordinat->delete_data($id);
		$this->Logger->write('Hapus Koordinat Lokasi '.$nama_lokasi);
		$this->session->set_flashdata('msg', 'hapus');
	}

	//lock

	public function lock()
	{

		$d['lock'] = $query = $this->db->join('lokasi', 'lokasi.id_lokasi = lock_posisi.id_lokasi', 'left')->get_where('lock_posisi')->result();
		$d['title'] = 'Data Lokasi';
		$this->Logger->write('Membuka Menu Lock Lokasi');

		$this->template->admin('admin/lock/lock', $d);
	}

	//settlokasi
	public function settlokasi()
	{
		$users = $this->db->join('pegawai', 'relasi_pegawai.id_pegawai = pegawai.id_pegawai', 'left')
			->join('lokasi', 'lokasi.id_lokasi = relasi_pegawai.id_lokasi', 'left')
			->get('relasi_pegawai')
			->result();
		$user_group = array();

		foreach ($users as $key => $value) {
			if (!array_key_exists($value->id_pegawai, $user_group)) {
				$user_group[$value->id_pegawai]["id_pegawai"] = $value->id_pegawai;
				$user_group[$value->id_pegawai]["nama_pegawai"] = $value->nama_pegawai;
				$user_group[$value->id_pegawai]["nrp_pegawai"] = $value->nrp_pegawai;
				$user_group[$value->id_pegawai]["lokasi"][] = array(
					"id_lokasi" => $value->id_lokasi,
					"nama_lokasi" => $value->nama_lokasi,
				);
			} else {
				$user_group[$value->id_pegawai]["lokasi"][] = array(
					"id_lokasi" => $value->id_lokasi,
					"nama_lokasi" => $value->nama_lokasi,
				);
			}
		}
		$d["user"] = $user_group;
		$this->template->admin('admin/settlokasi/setlokasi', $d);
	}

	public function tambah_settlokasi()
	{
		$d['title'] = 'Tambah Lokasi Absen';
		$d['lokasi'] = $this->db->get('lokasi')
			->result();

		$d['pegawai'] = $this->db->get('pegawai')
			->result();

		$this->Logger->write('Membuka Menu Tambah Lokasi Absen');
		$this->template->admin('admin/settlokasi/tambah', $d);
	}

	public function edit_settlokasi()
	{
		$d['title'] = 'Edit Lokasi Absen';
		$d['loc'] = $this->db->get_where('relasi_pegawai', array('id' => $this->uri->segment(3)))->row();
		$d['title'] = 'Dashboard';
		$this->Logger->write('Membuka Menu Edit Lokasi Absen');
		$this->template->admin('admin/settlokasi/edit', $d);
	}

	public function editdata_settlokasi()
	{
		$d['lokasi'] = $this->Mlocation->getLocation();
		$d['pegawai'] = $this->db->get('pegawai')->result();

		$d['loc'] = $this->db->get_where('relasi_pegawai', array('id_pegawai' => $this->uri->segment(3)))->result();
		$this->Logger->write('Membuka Menu Edit Data Lokasi');
		$this->load->view('admin/settlokasi/edit', $d);
	}

	// public function hapus()
	// {
	// 	$id = $this->uri->segment(3);
	// 	$this->Msetting_lokasi->hapusdata($id);
	// 	$this->session->set_flashdata('msg', 'hapus');
	// }

	public function monitoring()
	{
		$id = $this->session->userdata('id_lokasi');
		$d['izin'] = $this->Mizin->getIzin($id);
		$this->Logger->write('Membuka Menu Monitoring');
		$this->template->admin('admin/monitoring/data', $d);
	}

	public function tambah_izin()
	{
		$id = $this->session->userdata('id_lokasi');
		$data['pegawai'] = $this->Mpegawai->getPegawaiByLocation($id);
		$data['status'] = $this->Mizin->getStatus()->result();
		$data['lokasi'] = $this->Mlocation->getLocationById($id);
		
		$this->Logger->write('Membuka Menu Tambah Izin');

		$this->load->view('admin/monitoring/tambah', $data);
	}

	public function data_izin()
	{
		$id = $this->uri->segment(3);
		$data['row'] = $this->Mizin->get($id);
		$data['status'] = $this->Mizin->getStatus()->result();
		$this->Logger->write('Membuka Menu Edit Izin id: '.$id);
		$this->load->view('admin/monitoring/edit', $data);
	}


	public function edit()
	{
		$d['title'] = 'Edit Lokasi';
		$d['lock'] = $this->db->get_where('lock_posisi', array('id_lock' => $this->uri->segment(3)))->row();
		$d['title'] = 'Dashboard';
		$this->Logger->write('Membuka Menu Edit Lock Lokasi id: '.$this->uri->segment(3));
		$this->template->admin('admin/lock/edit', $d);
	}

	public function tambah()
	{
		$d['title'] = 'Tambah Lokasi';
		$this->Logger->write('Membuka Menu Tambah Lock Lokasi');
		$this->template->admin('admin/lock', $d);
	}

	public function tambahdata()
	{
		$d['lokasi'] = $this->Mlocation->getLocation();
		$this->Logger->write('Membuka Menu Tambah Lock Lokasi');
		$this->load->view('admin/lock/tambah', $d);
	}

	public function hapus()
	{
		$data 	= [
			'display' 		=> '1',
			'action'		=> 'delete',
			'id_admin'		=> $this->session->userdata('id_admin'),
			'log_tanggal'	=> date('Y-m-d H:i:s')
		];

		$this->db->where(['id_lock' => $this->uri->segment(3)]);
		$read 	= $this->db->get('lock_posisi');
		if ($read->num_rows() == 1) {

			$this->db->where(['id_lock' => $this->uri->segment(3)]);
			$this->db->delete('lock_posisi', array('id_lock' => $this->uri->segment(3)));
		}

		$this->Logger->write('Hapus Lock Lokasi id: '.$this->uri->segment(3));

		redirect(base_url('admin/lock'));
	}

	// public function hapuslock()
	// {
	// 	$id = $this->uri->segment(3);
	// 	$this->Mlock->hapuslok($id);
	// 	$this->session->set_flashdata('msg', 'hapus');
	// }

	public function hapusloc()
	{
		$id = $this->uri->segment(3);
		$this->Mkoordinat->delete_data($id);
		$this->Logger->write('Hapus Lock Lokasi id: '.$id);
		$this->session->set_flashdata('msg', 'hapus');
	}

	public function set_edit_lokasi()
	{
		$data = array(
			'nama_lokasi' => $this->input->post('nama'),
			'lang' => $this->input->post('lang'),
			'long' => $this->input->post('long'),
			'action'		=> 'create',
			'id_admin'		=> $this->session->userdata('id_admin'),
			'log_tanggal'	=> date('Y-m-d H:i:s')
		);
	}

	public function editdata()
	{
		$d['lokasi'] = $this->Mlocation->getLocation();
		$d['lock'] = $this->Mlock->detailpegawai();
		$this->Logger->write('Membuka Menu Edit Lock Lokasi');
		$this->load->view('admin/lock/edit', $d);
	}

	public function set_simpan_lokasi()
	{
		$nama_lokasi = $this->input->post('nama');
		$data = array(
			'nama_lokasi' => $this->input->post('nama'),
			'lang' => $this->input->post('lang'),
			'long' => $this->input->post('long'),
			'action'		=> 'create',
			'id_admin'		=> $this->session->userdata('id_admin'),
			'log_tanggal'	=> date('Y-m-d H:i:s')
		);

		$this->db->insert('lock_posisi', $data);
		
		$this->Logger->write('Simpan Lokasi '.$nama_lokasi);

		redirect(base_url('admin/lock'));
	}
	public function data_pegawai()
	{
		$result = [
			'status' 	=> true,
			'message' 	=> 'success load the data',
			'data' 	=> $this->Mpegawai->data_pegawai()
		];

		echo json_encode($result);
	}

	public function log_admin(){
		$this->Logger->write('Membuka Menu Log Admin');
		$d['title'] = 'Data Log Admin';
		$d['data'] = $this->db->query("select b.nama_admin, a.ip_address, a.activity, a.date_create from admin_log a, admin b where a.id_admin = b.id_admin");
		$this->template->admin('admin/log_admin/data', $d);		
	}
}