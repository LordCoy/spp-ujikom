<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Excel extends CI_Controller {

	public function Excel_Pembayaran(){
		// Load plugin PHPExcel nya
		include APPPATH.'third_party/PHPExcel/PHPExcel.php';
		
		// Panggil class PHPExcel nya
		$excel = new PHPExcel();

		// Settingan awal fil excel
		$excel->getProperties()->setCreator('SPP SMEA')
							   ->setLastModifiedBy('SPP SMEA 2020')
							   ->setTitle("Data Pembayaran")
							   ->setSubject("Pembayaran")
							   ->setDescription("Laporan Semua Data Pembayaran")
							   ->setKeywords("Data Pembayaran");

		// Buat sebuah variabel untuk menampung pengaturan style dari header tabel
		$style_col = array(
			'font' => array('bold' => true), // Set font nya jadi bold
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
			),
			'borders' => array(
				'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
				'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
				'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
				'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
			)
		);

		// Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
		$style_row = array(
			'alignment' => array(
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
			),
			'borders' => array(
				'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
				'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
				'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
				'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
			)
		);

		//POST dari form
		$nis2 	= $this->input->post('nis2', true);
		$nama2 	= $this->input->post('nama2', true);
		$kelas2 = $this->input->post('kelas2', true);
		$tb2 	= $this->input->post('tb2', true);
		$tgl2 	= $this->input->post('tgl2', true);

		$data_cari = array('siswa.nis'					=> $nis2,
							'siswa.nama'				=> $nama2,
							'siswa.id_kelas'			=> $kelas2,
							'pembayaran.tahun_dibayar'	=> $tb2,
							'pembayaran.tgl_bayar'		=> $tgl2,);

		if($nis2 == '' && $nama2 == '' && $kelas2 =='' && $tb2 =='' && $tgl2 == ''){
			$excel->setActiveSheetIndex(0)->setCellValue('A1', "DATA Pembayaran"); 
		}else{
			if($nis2 == ''){
				$nis2 = '';
			}else{
				$nis2 = 'NIS '.$nis2;
			}

			if($nama2 == ''){
				$nama2 = '';
			}else{
				$nama2 = ''.$nama2;
			}

			if($kelas2 == ''){
				$kelas2 = '';
			}else{
				$get_kelas = $this->db->get_where('kelas', array('id_kelas' => $kelas2))->row();
				$kelas2 = 'Kelas '.$get_kelas->nama_kelas.' '.$get_kelas->kompetensi_keahlian;
			}

			if($tb2 == ''){
				$tb2 = '';
			}else{
				$tb2 = 'Tahun Ke '.$tb2;
			}

			if($tgl2 == ''){
				$tgl2 = '';
			}else{
				$tgl2 = 'Tanggal '.$tgl2;
			}

			//SET Judul Excel
			$excel->setActiveSheetIndex(0)->setCellValue('A1', 'Data Pembayaran '.$nis2.' '.$nama2.' '.$kelas2.' '.$tb2.' '.$tgl2); 
		}

		$excel->getActiveSheet()->mergeCells('A1:I1'); // Set Merge Cell pada kolom A1 sampai E1
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(12); // Set font size 15 untuk kolom A1
		$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1

		// Buat header tabel nya pada baris ke 3
		$excel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); 
		$excel->setActiveSheetIndex(0)->setCellValue('B3', "PETUGAS"); 
		$excel->setActiveSheetIndex(0)->setCellValue('C3', "NIS"); 
		$excel->setActiveSheetIndex(0)->setCellValue('D3', "NAMA SISWA/SISWI"); 
		$excel->setActiveSheetIndex(0)->setCellValue('E3', "TANGGAL BAYAR"); 
		$excel->setActiveSheetIndex(0)->setCellValue('F3', "TAHUN DIBAYAR"); 
		$excel->setActiveSheetIndex(0)->setCellValue('G3', "BULAN DIBAYAR"); 
		$excel->setActiveSheetIndex(0)->setCellValue('H3', "JUMLAH BAYAR"); 
		$excel->setActiveSheetIndex(0)->setCellValue('I3', "STATUS SISWA"); 

		// Apply style header yang telah kita buat tadi ke masing-masing kolom header
		$excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('H3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('I3')->applyFromArray($style_col);

		//Ambil Data Pembayaran
		$pembayaran = $this->M_Pembayaran->Data_Pembayaran_SPP($data_cari);

		$no = 1; // Untuk penomoran tabel, di awal set dengan 1
		$numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
		foreach($pembayaran as $data){ 
			$excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
			$excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data['nama_petugas']);
			$excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data['nis']);
			$excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data['nama']);
			$excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data['tgl_bayar']);
			$excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, 'Tahun Ke '.$data['tahun_dibayar']);
			$excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $data['bulan_dibayar'].' Bulan');
			$excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, 'Rp.'.$data['jumlah_bayar'].';');
			$excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $data['status_siswa']);
			
			// Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
			$excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('I'.$numrow)->applyFromArray($style_row);
			
			$no++; 
			$numrow++; // Tambah 1 setiap kali looping
		}

		// Set width kolom
		$excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); 
		$excel->getActiveSheet()->getColumnDimension('B')->setWidth(15); 
		$excel->getActiveSheet()->getColumnDimension('C')->setWidth(10); 
		$excel->getActiveSheet()->getColumnDimension('D')->setWidth(30); 
		$excel->getActiveSheet()->getColumnDimension('E')->setWidth(30); 
		$excel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
		$excel->getActiveSheet()->getColumnDimension('G')->setWidth(25);
		$excel->getActiveSheet()->getColumnDimension('H')->setWidth(30);
		$excel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
		
		// Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
		$excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);

		// Set orientasi kertas jadi LANDSCAPE
		$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

		// Set judul file excel nya
		$excel->getActiveSheet(0)->setTitle("Laporan Data Pembayaran");
		$excel->setActiveSheetIndex(0);

		// Proses file excel
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="Data Pembayaran.xlsx"'); // Set nama file excel nya
		header('Cache-Control: max-age=0');

		$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		$write->save('php://output');
	}

	public function Excel_Siswa(){
		// Load plugin PHPExcel nya
		include APPPATH.'third_party/PHPExcel/PHPExcel.php';
		
		// Panggil class PHPExcel nya
		$excel = new PHPExcel();

		// Settingan awal fil excel
		$excel->getProperties()->setCreator('SPP SMEA')
							   ->setLastModifiedBy('SPP SMEA 2020')
							   ->setTitle("Data Siswa")
							   ->setSubject("Siswa")
							   ->setDescription("Laporan Semua Data Siswa")
							   ->setKeywords("Data Siswa");

		// Buat sebuah variabel untuk menampung pengaturan style dari header tabel
		$style_col = array(
			'font' => array('bold' => true), // Set font nya jadi bold
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
			),
			'borders' => array(
				'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
				'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
				'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
				'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
			)
		);

		// Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
		$style_row = array(
			'alignment' => array(
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
			),
			'borders' => array(
				'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
				'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
				'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
				'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
			)
		);

		//POST dari form
		$nis2 	= $this->input->post('nis2', true);
		$nama2 	= $this->input->post('nama2', true);
		$kelas2 = $this->input->post('kelas2', true);
		$kompetensi_keahlian2 = $this->input->post('kompetensi_keahlian2', true);
		$alamat2= $this->input->post('alamat2', true);
		$spp2 	= $this->input->post('spp2', true);

		$data_filter = array('siswa.nis'				=> $nis2,
							'siswa.nama'				=> $nama2,
							'kelas.nama_kelas'			=> $kelas2,
							'kelas.kompetensi_keahlian'	=> $kompetensi_keahlian2,
							'siswa.alamat'				=> $alamat2,
							'siswa.id_spp'				=> $spp2,);

		if($nis2 == '' && $nama2 == '' && $kelas2 =='' && $kompetensi_keahlian2 =='' && $alamat2 == '' && $spp2 == ''){
			$excel->setActiveSheetIndex(0)->setCellValue('A1', "DATA Siswa"); 
		}else{
			if($nis2 == ''){
				$nis2 = '';
			}else{
				$nis2 = 'NIS '.$nis2;
			}

			if($nama2 == ''){
				$nama2 = '';
			}else{
				$nama2 = ''.$nama2;
			}

			if($kelas2 == ''){
				$kelas2 = '';
			}else{
				$kelas2 = 'Kelas '.$kelas2;
			}

			if($kompetensi_keahlian2 == ''){
				$kompetensi_keahlian2 = '';
			}else{
				$kompetensi_keahlian2 = ''.$kompetensi_keahlian2;
			}

			if($alamat2 == ''){
				$alamat2 = '';
			}else{
				$alamat2 = 'Alamat '.$alamat2;
			}

			if($spp2 == '4'){
				$spp2 = 'Belum bayar';
			}else if($spp2 == ''){
				$spp2 = '';
			}else{
				$spp2 = 'SPP Tahun Ke '.$spp2;
			}

			//SET Judul Excel
			$excel->setActiveSheetIndex(0)->setCellValue('A1', 'Data Siswa '.$nis2.' '.$nama2.' '.$kelas2.' '.$kompetensi_keahlian2.' '.$alamat2.' '.$spp2); 
		}

		$excel->getActiveSheet()->mergeCells('A1:H1'); // Set Merge Cell pada kolom A1 sampai E1
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(12); // Set font size 15 untuk kolom A1
		$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1

		// Buat header tabel nya pada baris ke 3
		$excel->setActiveSheetIndex(0)->setCellValue('A3', "NISN"); 
		$excel->setActiveSheetIndex(0)->setCellValue('B3', "NIS"); 
		$excel->setActiveSheetIndex(0)->setCellValue('C3', "NIS"); 
		$excel->setActiveSheetIndex(0)->setCellValue('D3', "NAMA SISWA/SISWI"); 
		$excel->setActiveSheetIndex(0)->setCellValue('E3', "KELAS"); 
		$excel->setActiveSheetIndex(0)->setCellValue('F3', "ALAMAT"); 
		$excel->setActiveSheetIndex(0)->setCellValue('G3', "NO TELEPON"); 
		$excel->setActiveSheetIndex(0)->setCellValue('H3', "SPP TAHUN"); 

		// Apply style header yang telah kita buat tadi ke masing-masing kolom header
		$excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('H3')->applyFromArray($style_col);

		//Ambil Data Pembayaran
		$siswa = $this->M_Admin->Data_Siswa($data_filter);

		$no = 1; // Untuk penomoran tabel, di awal set dengan 1
		$numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
		foreach($siswa as $data){ 
			if($data['id_spp'] == '4'){
				$tahun = 'Belum Bayar';
			}else{
				$tahun = 'Tahun Ke '.$data['tahun'];
			}

			$excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
			$excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data['nisn']);
			$excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data['nis']);
			$excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data['nama']);
			$excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data['nama_kelas'].' '.$data['kompetensi_keahlian']);
			$excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $data['alamat']);
			$excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $data['no_telp']);
			$excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $tahun);
			
			// Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
			$excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_row);
			
			$no++; 
			$numrow++; // Tambah 1 setiap kali looping
		}

		// Set width kolom
		$excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); 
		$excel->getActiveSheet()->getColumnDimension('B')->setWidth(15); 
		$excel->getActiveSheet()->getColumnDimension('C')->setWidth(10); 
		$excel->getActiveSheet()->getColumnDimension('D')->setWidth(30); 
		$excel->getActiveSheet()->getColumnDimension('E')->setWidth(35); 
		$excel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
		$excel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
		$excel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
		
		// Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
		$excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);

		// Set orientasi kertas jadi LANDSCAPE
		$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

		// Set judul file excel nya
		$excel->getActiveSheet(0)->setTitle("Laporan Data Siswa");
		$excel->setActiveSheetIndex(0);

		// Proses file excel
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="Data Siswa.xlsx"'); // Set nama file excel nya
		header('Cache-Control: max-age=0');

		$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		$write->save('php://output');
	}
}