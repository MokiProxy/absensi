<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require('./mokiweb/third_party/vendor/autoload.php');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
class Exportimport extends Mokiweb_Controller {
	public function __construct(){
		parent:: __construct();
		$this->load->library('PHPExcel');
		$this->load->model('Mpegawai');
		$this->load->model('Mabsen');

		include APPPATH.'views/tool/function.php';
	}

	function newImport(){
		$file_mimes = array('application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			if(isset($_FILES['fileimport']['name']) && in_array($_FILES['fileimport']['type'], $file_mimes)) {
				$arr_file = explode('.', $_FILES['fileimport']['name']);
			    $extension = end($arr_file);
			 
			    if('csv' == $extension) {
			        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
			    } else {
			        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
			    }
			 
			    $spreadsheet = $reader->load($_FILES['fileimport']['tmp_name']);
			     
			    $sheetData = $spreadsheet->getActiveSheet()->toArray();

				for($i = 2;$i < count($sheetData);$i++){
					$notif[]= 1;
			        $d['nama_pegawai']	= $sheetData[$i][1];
					$d['jk_pegawai']	= $sheetData[$i][2];
					$d['nrp_pegawai']	= $sheetData[$i][3];
					$d['departemen_pegawai']= $sheetData[$i][4];
					$d['jabatan_pegawai']	= $sheetData[$i][5];
					$d['lokasi']	= $sheetData[$i][6];
					$d['instansi']			= $sheetData[$i][7];
					$d['status_pegawai']	= $sheetData[$i][8];

					$this->db->insert('pegawai',$d);
					$id_pegawai = $this->db->insert_id();


					$data_lokasi = [
						'id_pegawai' => $id_pegawai,
						'id_lokasi'  => $sheetData[$i][6],
					];
					$this->db->insert('lokasi_pegawai',$data_lokasi);

			    }
			    echo '<span class="text-success">Berhasil mengimport '.array_sum($notif).' data</span> <a href="'.base_url('admin/pegawai').'">Lihat Data</a>';
			}
	}
	//Pegawai
	public function importpegawai(){
		$temp = explode(".", $_FILES['fileimport']['name']);
		$new_name = time().'.'.end($temp);
		$config['upload_path'] = './file/import/';
		$config['file_name'] = $new_name;
		$config['allowed_types'] = 'xls|xlsx';
		$this->load->library('upload');
		$this->upload->initialize($config);

		if (!$this->upload->do_upload('fileimport'))
		{
			echo '<span class="text-danger">Gagal melakukan import data, periksa file anda.</span>';
		}

	   	else
	   	{
		   	$media = $this->upload->data('fileimport');
		   	$inputFileName = './file/import/' . $new_name;
			try{
			 	$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
			 	$objReader = PHPExcel_IOFactory::createReader($inputFileType);
			 	$objPHPExcel = $objReader->load($inputFileName);
			} catch (Exception $e) {
			 	die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());
			}

			$sheet = $objPHPExcel->getSheet(0);
			$highestRow = $sheet->getHighestRow();
			$highestColumn = $sheet->getHighestColumn();

			for ($row = 3; $row <= $highestRow; $row++) {
			 	$rowData = $sheet->rangeToArray('B' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);

			 	// if($rowData[0][0] != null){
			 		$notif[]= 1;

					// var_dump($rowData[0][7]);
					// exit();

					// $d['idfp_pegawai']= $rowData[0][0];
					$d['nama_pegawai']	= $rowData[0][0];
					$d['jk_pegawai']	= $rowData[0][1];
					$d['nrp_pegawai']	= $rowData[0][2];
					$d['departemen_pegawai']= $rowData[0][3];
					$d['jabatan_pegawai']	= $rowData[0][4];
					$d['lokasi_pegawai']	= $rowData[0][5];
					$d['instansi']			= $rowData[0][6];
					$d['status_pegawai']	= $rowData[0][7];

					var_dump($d);

					$insert = $this->db->insert('pegawai',$d);

					// var_dump($this->db->error_message());
					// exit();
			   // }
			}
			
			// die();
			echo '<span class="text-success">Berhasil mengimport '.array_sum($notif).' data</span> <a href="'.base_url('admin/pegawai').'">Lihat Data</a>';
		}
	}


	public function templatepegawai(){
		$huruf= array('F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ');
	  	include APPPATH.'views/tool/cssexport.php';
	   $objPHPExcel = new PHPExcel();
	   $objPHPExcel->getProperties()->setCreator("MOKI DEVELOPER");
	   //atur header
	   $objset = $objPHPExcel->setActiveSheetIndex(0);
	   $objPHPExcel->getActiveSheet(0)->mergeCells('A1:I1');
	   $objPHPExcel->getActiveSheet(0)->getColumnDimension('A')->setWidth(5);
	   $objPHPExcel->getActiveSheet(0)->getColumnDimension('B')->setWidth(30);
	   $objPHPExcel->getActiveSheet(0)->getColumnDimension('C')->setWidth(30);
	   $objPHPExcel->getActiveSheet(0)->getColumnDimension('D')->setWidth(15);
	   $objPHPExcel->getActiveSheet(0)->getColumnDimension('E')->setWidth(15);
	   $objPHPExcel->getActiveSheet(0)->getColumnDimension('F')->setWidth(30);
	   $objPHPExcel->getActiveSheet(0)->getColumnDimension('G')->setWidth(20);
	   $objPHPExcel->getActiveSheet(0)->getColumnDimension('H')->setWidth(20);
	   $objPHPExcel->getActiveSheet(0)->getColumnDimension('I')->setWidth(20);
		$objPHPExcel->getActiveSheet(0)->getStyle('A1:I2')->applyFromArray($headerwar)->getFont()->setSize(11);
		$objPHPExcel->getSheet(0)->getStyle('A1:I2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		//isi
		$objget = $objPHPExcel->getActiveSheet(0); 
    	$objget->setTitle('DATA Pegawai');
    	$objset->setCellValue('A1','Template Pegawai');
    	$objset->setCellValue('A2','NO');
    	// $objset->setCellValue('B2','ID Fingerprint');
    	$objset->setCellValue('B2','Nama Pegawai');
    	$objset->setCellValue('C2','JK');
    	$objset->setCellValue('D2','NRP Pegawai');
    	$objset->setCellValue('E2','Departemen');
    	$objset->setCellValue('F2','Jabatan');
    	$objset->setCellValue('G2','Lokasi');
    	$objset->setCellValue('H2','Instansi');
    	$objset->setCellValue('I2','Status');
    	//proses export
		$objset = $objPHPExcel->setActiveSheetIndex(0);
    	$filename = 'TemPegawai'.date('d-m-Y').'_'.time().'.xlsx';
    	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');//sesuaikan headernya 
    	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
    	header("Cache-Control: no-store, no-cache, must-revalidate");
    	header("Cache-Control: post-check=0, pre-check=0", false);
    	header("Pragma: no-cache");
    	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');//ubah nama file saat diunduh
    	header('Content-Disposition: attachment;filename='.$filename);//unduh file
    	$objWriter->save("php://output");
	}
	public function exportpegawai(){
		$huruf= array('F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ');
		$pegawai= $this->Mpegawai->data();
	  	include APPPATH.'views/tool/cssexport.php';
	   $objPHPExcel = new PHPExcel();
	   $objPHPExcel->getProperties()->setCreator("MOKI DEVELOPER");
	   //atur header
	   $objset = $objPHPExcel->setActiveSheetIndex(0);
	   $objPHPExcel->getActiveSheet(0)->mergeCells('A1:I1');
	   $objPHPExcel->getActiveSheet(0)->getColumnDimension('A')->setWidth(5);
	   $objPHPExcel->getActiveSheet(0)->getColumnDimension('B')->setWidth(30);
	   $objPHPExcel->getActiveSheet(0)->getColumnDimension('C')->setWidth(30);
	   $objPHPExcel->getActiveSheet(0)->getColumnDimension('D')->setWidth(15);
	   $objPHPExcel->getActiveSheet(0)->getColumnDimension('E')->setWidth(15);
	   $objPHPExcel->getActiveSheet(0)->getColumnDimension('F')->setWidth(30);
	   $objPHPExcel->getActiveSheet(0)->getColumnDimension('G')->setWidth(20);
	   $objPHPExcel->getActiveSheet(0)->getColumnDimension('H')->setWidth(20);
	   $objPHPExcel->getActiveSheet(0)->getColumnDimension('I')->setWidth(20);
	   $bord= $pegawai->num_rows()+2;
		$objPHPExcel->getActiveSheet(0)->getStyle('A1:I2')->applyFromArray($headerwar)->getFont()->setSize(11);
		$objPHPExcel->getSheet(0)->getStyle('A1:I'.$bord)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		//isi
		$objget = $objPHPExcel->getActiveSheet(0); 
    	$objget->setTitle('DATA Pegawai');
    	$objset->setCellValue('A1','Data Pegawai');
    	$objset->setCellValue('A2','NO');
    	// $objset->setCellValue('B2','ID Fingerprint');
    	$objset->setCellValue('B2','Nama Pegawai');
    	$objset->setCellValue('C2','JK');
    	$objset->setCellValue('D2','NRP Pegawai');
    	$objset->setCellValue('E2','Departemen');
    	$objset->setCellValue('F2','Jabatan');
    	$objset->setCellValue('G2','Lokasi');
    	$objset->setCellValue('H2','Instansi');
    	$objset->setCellValue('I2','Status');
    	$no= 1; $nop= 3; foreach($pegawai->result() as $r){
	    	$objset->setCellValue('A'.$nop,$no);
	    	// $objset->setCellValue('B'.$nop,$r->idfp_pegawai);
	    	$objset->setCellValue('B'.$nop,$r->nama_pegawai);
	    	$objset->setCellValue('C'.$nop,$r->jk_pegawai);
	    	$objset->setCellValue('D'.$nop,$r->nrp_pegawai);
	    	$objset->setCellValue('E'.$nop,$r->departemen_pegawai);
	    	$objset->setCellValue('F'.$nop,$r->jabatan_pegawai);
	    	$objset->setCellValue('G'.$nop,$r->lokasi_pegawai);
	    	$objset->setCellValue('H'.$nop,$r->instansi);
	    	$objset->setCellValue('I'.$nop,$r->status_pegawai);
    	$no++; $nop++; }
    	//proses export
		$objset = $objPHPExcel->setActiveSheetIndex(0);
    	$filename = 'DataPegawai'.date('d-m-Y').'_'.time().'.xlsx';
    	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');//sesuaikan headernya 
    	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
    	header("Cache-Control: no-store, no-cache, must-revalidate");
    	header("Cache-Control: post-check=0, pre-check=0", false);
    	header("Pragma: no-cache");
    	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');//ubah nama file saat diunduh
    	header('Content-Disposition: attachment;filename='.$filename);//unduh file
    	$objWriter->save("php://output");
	}


	public function exporttanggal(){
		$huruf= array('F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ');
		$tgldari	= ymd($this->input->get('dari'));
		$tglsampai	= ymd($this->input->get('sampai'));
		$instansi	= $this->input->get('instansi');
		$absen 	= $this->Mabsen->datatanggal($instansi,$tgldari,$tglsampai);

		// var_dump($absen->result());
		// exit();

	   include APPPATH.'views/tool/cssexport.php';
	   $objPHPExcel = new PHPExcel();
	   $objPHPExcel->getProperties()->setCreator("MOKI DEVELOPER");
	   //atur header
	   $objset = $objPHPExcel->setActiveSheetIndex(0);
	   $objPHPExcel->getActiveSheet(0)->mergeCells('A1:M1');
	   $objPHPExcel->getActiveSheet(0)->getColumnDimension('A')->setWidth(5);
	   $objPHPExcel->getActiveSheet(0)->getColumnDimension('B')->setWidth(15);
	   $objPHPExcel->getActiveSheet(0)->getColumnDimension('C')->setWidth(30);
	   $objPHPExcel->getActiveSheet(0)->getColumnDimension('D')->setWidth(30);
	   $objPHPExcel->getActiveSheet(0)->getColumnDimension('E')->setWidth(30);
	   $objPHPExcel->getActiveSheet(0)->getColumnDimension('F')->setWidth(30);
	   $objPHPExcel->getActiveSheet(0)->getColumnDimension('G')->setWidth(30);
	   $objPHPExcel->getActiveSheet(0)->getColumnDimension('H')->setWidth(30);
	   $objPHPExcel->getActiveSheet(0)->getColumnDimension('I')->setWidth(30);
	   $objPHPExcel->getActiveSheet(0)->getColumnDimension('J')->setWidth(30);
	   $objPHPExcel->getActiveSheet(0)->getColumnDimension('K')->setWidth(15);
	   $objPHPExcel->getActiveSheet(0)->getColumnDimension('L')->setWidth(15);
	   $objPHPExcel->getActiveSheet(0)->getColumnDimension('M')->setWidth(15);
	   $bora= $absen->num_rows()+2;
		$objPHPExcel->getActiveSheet(0)->getStyle('A1:L2')->applyFromArray($headerwar)->getFont()->setSize(11);
		$objPHPExcel->getSheet(0)->getStyle('A1:L'.$bora)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		//isi
		$objget = $objPHPExcel->getActiveSheet(0); 
    	$objget->setTitle('DATA Absen');
    	$objset->setCellValue('A1','Data Asben Dari '.dmy($tgldari).' s/d '.dmy($tglsampai));
    	$objset->setCellValue('A2','NO');
    	$objset->setCellValue('B2','Tanggal');
    	$objset->setCellValue('C2','Nama Pegawai');
    	$objset->setCellValue('D2','NRP Pegawai');
    	$objset->setCellValue('E2','Departemen');
    	$objset->setCellValue('F2','Jabatan');
    	$objset->setCellValue('G2','Lokasi');
    	$objset->setCellValue('H2','Instansi');
    	$objset->setCellValue('I2','Masuk');
    	$objset->setCellValue('J2','Pulang');
    	$objset->setCellValue('K2','Latitude');
    	$objset->setCellValue('L2','Longitude');
    	$objset->setCellValue('M2','IP');
    	$no= 1; $nop= 3; foreach($absen->result() as $r){
	    	$objset->setCellValue('A'.$nop,$no);
	    	$objset->setCellValue('B'.$nop,dmy($r->masuk_absen));
	    	$objset->setCellValue('C'.$nop,$r->nama_pegawai);
	    	$objset->setCellValue('D'.$nop,$r->nrp_pegawai);
	    	$objset->setCellValue('E'.$nop,$r->departemen_pegawai);
	    	$objset->setCellValue('F'.$nop,$r->jabatan_pegawai);
	    	$objset->setCellValue('G'.$nop,$r->nama_lokasi);
	    	$objset->setCellValue('H'.$nop,$r->instansi);
	    	$objset->setCellValue('I'.$nop,waktu($r->masuk_absen));
	    	$objset->setCellValue('J'.$nop,waktu($r->pulang_absen));
	    	$objset->setCellValue('K'.$nop,"".$r->lat_absen);
	    	$objset->setCellValue('L'.$nop,"".$r->long_absen);
	    	$objset->setCellValue('M'.$nop,"".$r->ip_absen);
    	$no++; $nop++; }
    	//proses export
		$objset = $objPHPExcel->setActiveSheetIndex(0);
    	$filename = 'DataAbsen '.date('d-m-Y').'_'.time().'.xlsx';
    	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');//sesuaikan headernya 
    	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
    	header("Cache-Control: no-store, no-cache, must-revalidate");
    	header("Cache-Control: post-check=0, pre-check=0", false);
    	header("Pragma: no-cache");
    	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');//ubah nama file saat diunduh
    	header('Content-Disposition: attachment;filename='.$filename);//unduh file
    	$objWriter->save("php://output");
	}
}