<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Absen extends Mokiweb_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mauth');
		$this->load->model('Mpegawai');
		$this->load->model('Mabsen');
		$this->load->model('Mlocation');
		$this->load->helper('cookie');

		include APPPATH . 'views/tool/function.php';
	}
	public function absenpegawai()
	{
		$tanggal = date('Y-m-d');
		$absen = $this->input->get('absen');
		$nrp = $this->input->post('nrp');
		$latitude = $this->input->post('latitude');
		$longitude = $this->input->post('longitude');
		$pegawai = $this->Mpegawai->getonenrp($nrp)->row_array();
		$dataLokasi = $this->Mlocation->getLokasiKaryawan($pegawai['id_pegawai']);
		$dataKoorLokasi = $this->Mlocation->getLatAndLongPosisi($dataLokasi['id_lokasi']);
		$dataMaxDistance = $this->Mlocation->getKoordinat($dataLokasi['id_lokasi']);
		$cek = $this->Mabsen->cekabsen($nrp);
		
		if ($pegawai != NULL) {
			if ($this->input->cookie('nrp') != null) {
				if ($this->input->cookie('nrp') != $nrp) {
					echo '<div class="alert alert-info alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h5><i class="icon fa fa-check"></i> Info</h5>1 NRP 1 Device. <br> </div>';
				} else {
					if ($this->Mlocation->getDistanceBetweenPoints($latitude, $longitude, $dataKoorLokasi['lang'], $dataKoorLokasi['long']) <= $dataMaxDistance['jarak']) {
						if ($cek->num_rows() > 0) {
							$data = $cek->row_array();
							if ($absen == 'pulang') {
								if (ymd($data['pulang_absen']) != $tanggal) {
									$this->Mabsen->updatepulang($data['id_absen']);
									$ceknotif = $this->Mabsen->cekabsen($nrp)->row_array();
									echo '<div class="alert alert-warning alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h5><i class="icon fa fa-check"></i> Sukses</h5>Absen Pulang Berhasil. <br>Nama : ' . $ceknotif['nama_pegawai'] . '<br>Waktu : ' . dmywaktu($ceknotif['pulang_absen']) . '</div>';
								} else {
									$ceknotif = $this->Mabsen->cekabsen($nrp)->row_array();
									echo '<div class="alert alert-info alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h5><i class="icon fa fa-exclamation"></i> Info</h5>Anda Sudah Absen Pulang Hari Ini. <br>Nama : ' . $ceknotif['nama_pegawai'] . '<br>Waktu : ' . dmywaktu($ceknotif['pulang_absen']) . '</div>';
								}
							} else if ($absen == 'masuk') {
								if (ymd($data['masuk_absen']) != $tanggal) {
									$this->Mabsen->simpanmasuk($pegawai['id_pegawai']);
									$ceknotif = $this->Mabsen->cekabsen($nrp)->row_array();
									echo '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h5><i class="icon fa fa-check"></i> Sukses</h5>Absen Masuk Berhasil. <br>Nama : ' . $ceknotif['nama_pegawai'] . '<br>Waktu : ' . dmywaktu($ceknotif['masuk_absen']) . '</div>';
								} else {
									$ceknotif = $this->Mabsen->cekabsen($nrp)->row_array();
									echo '<div class="alert alert-info alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h5><i class="icon fa fa-exclamation"></i> Info</h5>Anda Sudah Absen Masuk Hari Ini. <br>Nama : ' . $ceknotif['nama_pegawai'] . '<br>Waktu : ' . dmywaktu($ceknotif['masuk_absen']) . '</div>';
								}
							} else {
								$ceknotif = $this->Mabsen->cekabsen($nrp)->row_array();
								echo '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h5><i class="icon fa fa-ban"></i> Gagal</h5>Silahkan Coba Lagi.</div>';
							}
						} else {
							if ($absen == 'masuk') {
								$this->Mabsen->simpanmasuk($pegawai['id_pegawai']);
								$ceknotif = $this->Mabsen->cekabsen($nrp)->row_array();
								echo '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h5><i class="icon fa fa-check"></i> Sukses</h5>Absen Masuk Berhasil. <br>Nama : ' . $ceknotif['nama_pegawai'] . '<br>Waktu : ' . dmywaktu($ceknotif['masuk_absen']) . '</div>';
							} else {
								$ceknotif = $this->Mabsen->cekabsen($nrp)->row_array();
								echo '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h5><i class="icon fa fa-ban"></i> Gagal</h5>Silahkan Coba Lagi.</div>';
							}
						}
					} else {
						echo '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h5><i class="icon fa fa-ban"></i> Gagal</h5>Maaf Anda Berada Diluar Zona Absensi Loksi.</div>';
					}
				}
			} else {
				$cookie = [
					'name' => 'nrp',
					'value' => $nrp,
					'expire' => time() + (10 * 365 * 24 * 60 * 60),
					'path' => '/',
					'secure' => TRUE
				];

				setcookie($cookie['name'], $cookie['value'], $cookie['expire'], $cookie['path']);
				echo '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h5><i class="icon fa fa-ban"></i> Gagal</h5>Berhasil Diset.</div>';
				// echo "Cookie Berhasil diset";
			}
		} else {
			$ceknotif = $this->Mabsen->cekabsen($nrp)->row_array();
			echo '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h5><i class="icon fa fa-ban"></i> Gagal</h5>Tidak Ditemukan Pegawai.</div>';
		}
	}

	public function update()
	{
		$id 	= $this->input->post('id_absen');
		$masuk_absen = str_replace('/', '-', $this->input->post('masuk_absen'));
		$pulang_absen = str_replace('/', '-', $this->input->post('pulang_absen'));
		$data 	= [
			'masuk_absen' 	=> date('Y-m-d H:i:s', strtotime($masuk_absen)),
			'pulang_absen' 	=> date('Y-m-d H:i:s', strtotime($pulang_absen))
		];
		$query = $this->Mabsen->update($id, $data);
		echo  $query;
	}
	public function hapus()
	{
		$this->Mabsen->hapus();
		$this->session->set_flashdata('msg', 'hapus');

		echo "oke";
		//redirect(base_url('admin/'));
	}
	public function ambillokasi()
	{
		$latitude 	= $_POST['latitude'];
		$longitude	= $_POST['longitude'];

		if (!empty($latitude) && !empty($longitude)) {

			$gmap = 'http://maps.googleapis.com/maps/api/geocode/json?latlng=' . trim($latitude) . ',' . $longitude . '&sensor=false';
			// curl
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $gmap);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			$response = curl_exec($ch);
			curl_close($ch);
			// end curl
			$data = json_decode($response);
			var_dump($data);
			// if ($response) {
			// echo json_encode($data->results[0]->formatted_address);
			// }else{
			// echo json_encode(false);
			// }
		}
	}
}