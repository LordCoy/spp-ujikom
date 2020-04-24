<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembayaran extends CI_Controller {

	public function Dashboard(){
		if($this->session->userdata('level') == 'petugas'){ 

			$data['siswa_bayar'] 		= $this->M_Pembayaran->siswa_bayar(); 
			$data['siswa_belum_bayar'] 	= $this->M_Pembayaran->siswa_belum_bayar(); 
			$data['seluruh_pembayaran'] = $this->db->get('pembayaran')->result_array(); 

			$this->load->view('Layout_admin/Navbar_Petugas'); 
			$this->load->view('Pembayaran_SPP/Dashboard', $data); 

		}else if($this->session->userdata('level') == 'admin'){ 

			$data['siswa_bayar'] 		= $this->M_Pembayaran->siswa_bayar(); 
			$data['siswa_belum_bayar'] 	= $this->M_Pembayaran->siswa_belum_bayar();
			$data['seluruh_pembayaran'] = $this->db->get('pembayaran')->result_array(); 

			$this->load->view('Layout_admin/Navbar'); 
			$this->load->view('Pembayaran_SPP/Dashboard', $data); 

		}else{ 
			redirect('Siswa'); 
		}
	}

	public function Data_Pembayaran_SPP(){
		$nis 	= $this->input->post('nis', true);	
		$nama 	= $this->input->post('nama', true);	
		$kelas 	= $this->input->post('kelas', true);
		$tb 	= $this->input->post('tb', true);	
		$tgl 	= $this->input->post('tgl', true);	

	
		$data_cari = array(
							'siswa.nis'					=> $nis,  
							'siswa.nama'				=> $nama, 
							'siswa.id_kelas'			=> $kelas,
							'pembayaran.tahun_dibayar'	=> $tb,	  
							'pembayaran.tgl_bayar'		=> $tgl,);

	
		$data['ket2'] = array('nis'			=> $nis,  
							'nama'			=> $nama,
							'id_kelas'		=> $kelas,
							'tahun_dibayar'	=> $tb,
							'tgl_bayar'		=> $tgl,);

		
		if($this->session->userdata('level') == 'petugas'){ 

			$data['data_kelas'] = $this->db->get('kelas')->result_array(); 
			$data['data'] 		= $this->M_Pembayaran->Data_Pembayaran_SPP($data_cari);

			$this->load->view('Layout_admin/Navbar_Petugas'); 
			$this->load->view('Pembayaran_SPP/Data_Pembayaran_SPP', $data);

		}else if($this->session->userdata('level') == 'admin'){ 

			$data['data_kelas'] = $this->db->get('kelas')->result_array(); 
			$data['data'] 		= $this->M_Pembayaran->Data_Pembayaran_SPP($data_cari); 

			$this->load->view('Layout_admin/Navbar');
			$this->load->view('Pembayaran_SPP/Data_Pembayaran_SPP', $data); //

		}else{ 
			redirect('Petugas'); 
		}
	}

	public function Pencarian_Data_Siswa(){
		if($this->session->userdata('level') == 'petugas'){ 

			$this->load->view('Layout_admin/Navbar_Petugas');
			$this->load->view('Pembayaran_SPP/Pencarian_Data_Siswa'); 

		}else if($this->session->userdata('level') == 'admin'){ 

			$this->load->view('Layout_admin/Navbar'); 
			$this->load->view('Pembayaran_SPP/Pencarian_Data_Siswa'); 

		}else{ 
			redirect('Petugas'); 
		}
	}

	public function Cari_NIS_Pembayaran(){
		$nis = $this->input->post('nis', true); 
		redirect('Pembayaran/Bayar_SPP/'.$nis); 
	}

	public function Bayar_SPP($nis){ 
		$data['data_siswa']  = $this->M_Pembayaran->Proses_Pencarian_Data_Siswa($nis); 
		

		$status_siswa = $data['data_siswa']->status_siswa; 
		

		$cek = count((array)$data['data_siswa']);

		if($cek > 0){ 

			for ($i=1; $i < 13; $i++) { 

				if($status_siswa == 'siswa pindahan ke kelas X'){ 	

					$data['ambil1'][] = $this->M_Pembayaran->data_pembayaran_status($i, $tahun = 1, $data['data_siswa']->nisn, $status_siswa); 
					
					$data['ambil2'][] = $this->M_Pembayaran->data_pembayaran_status($i, $tahun = 2, $data['data_siswa']->nisn, $status_siswa);
					
					$data['ambil3'][] = $this->M_Pembayaran->data_pembayaran_status($i, $tahun = 3, $data['data_siswa']->nisn, $status_siswa);
				}else{
					$data['ambil1'][] = $this->M_Pembayaran->data_pembayaran($i, $tahun = 1, $data['data_siswa']->nisn);
					
					$data['ambil2'][] = $this->M_Pembayaran->data_pembayaran($i, $tahun = 2, $data['data_siswa']->nisn);
					
					$data['ambil3'][] = $this->M_Pembayaran->data_pembayaran($i, $tahun = 3, $data['data_siswa']->nisn);
					
				}

				$data['TN2'][] = $this->M_Pembayaran->data_pembayaran_status($i, $tahun = 1, $data['data_siswa']->nisn, $status = 'tidak naik ke kelas XI');
				
				$data['TN3'][] = $this->M_Pembayaran->data_pembayaran_status($i, $tahun = 2, $data['data_siswa']->nisn, $status = 'tidak naik ke kelas XII');
				
			}

			$ambil_TN1 = $this->M_Pembayaran->data_pembayaran_status(1, 1, $data['data_siswa']->nisn, 'tidak naik ke kelas XI'); 
			if(empty($status_siswa) || $status_siswa == 'siswa pindahan ke kelas X' || $status_siswa == 'siswa pindahan ke kelas XI' || $status_siswa == 'siswa pindahan ke kelas XII'){
			
				$data['ket_TN'] = array('status' => 'kosong'); 

			}else if($status_siswa == 'tidak naik ke kelas XI'){ 
			
				$data['ket_TN'] = array('status' => 'tidak naik ke kelas XI'); 
				
			}else if($status_siswa == 'tidak naik ke kelas XII'){
			
				$cek_TN1 = count($ambil_TN1); 
				
				if($cek_TN1 > 0){ 
					$data['ket_TN'] = array('status' => 'tidak naik 2 kali'); 
					
				}else{ 

					$data['ket_TN'] = array('status' => 'tidak naik ke kelas XII');
					
				}
			}

			$data['numrows_1'] = $this->M_Pembayaran->hitung_pembayaran($data['data_siswa']->nisn, $id_spp = 1);
			$data['numrows_2'] = $this->M_Pembayaran->hitung_pembayaran($data['data_siswa']->nisn, $id_spp = 2);
			$data['numrows_3'] = $this->M_Pembayaran->hitung_pembayaran($data['data_siswa']->nisn, $id_spp = 3);


			if($this->session->userdata('level') == 'petugas'){ 

				$this->load->view('Layout_admin/Navbar_Petugas'); 
				$this->load->view('Pembayaran_SPP/Bayar_SPP', $data); 

			}else if($this->session->userdata('level') == 'admin'){ 

				$this->load->view('Layout_admin/Navbar');
				$this->load->view('Pembayaran_SPP/Bayar_SPP', $data); 

			}else{ 
				redirect('Petugas'); 
			}
	
		}else{ 
			echo 'NIS yang anda masukan tidak ditemukan!';
		}
	}

	public function Proses_Bayar_SPP(){
		$id_petugas = $this->session->userdata('id_petugas');
		$nisn   	= $this->input->post('nisn');
		$nis   		= $this->input->post('nis');
		$bulan  	= $this->input->post('bulan');
		$id_spp 	= $this->input->post('id_spp');
		$status_siswa = $this->input->post('status_siswa');

		
		$max_bulan_bayar 	= $this->M_Pembayaran->hitung_pembayaran($nisn, $id_spp); 
		

		$ambil_total_bayar 	= $this->db->get_where('spp', array('id_spp' => $id_spp))->row(); 
	

		$harga_perbulan		= $ambil_total_bayar->nominal/12; 

		if(empty($status_siswa)){
			$status_siswa = ' ';
		}

		if($id_spp == 1){

			
			if($max_bulan_bayar+1 == $bulan){ 
				$data = array('id_petugas' 	=> $id_petugas,
							'nisn'			=> $nisn,
							'tgl_bayar' 	=> date('y-m-d'),
							'bulan_dibayar'	=> $bulan,
							'tahun_dibayar'	=> $id_spp,
							'id_spp'		=> $id_spp,
							'jumlah_bayar'	=> $harga_perbulan,
							'status_pembayaran_siswa'=> $status_siswa);

				$data_update  = array('id_spp' => '1');
				$update_siswa = $this->M_Pembayaran->Update_Siswa($nisn, $data_update);

				$bayar = $this->db->insert('pembayaran', $data);
				if($bayar){
					redirect('Pembayaran/Bayar_SPP/'.$nis);
				}else{
					echo('Gagal melakukan Pembayaran!');
				}
			}else{
				echo "Pembayaran SPP tidak boleh acak!"; 
			}
		}else if($id_spp == 2){

			if($max_bulan_bayar+1 == $bulan){ 
				$data = array('id_petugas' 	=> $id_petugas,
							'nisn'			=> $nisn,
							'tgl_bayar' 	=> date('y-m-d'),
							'bulan_dibayar'	=> $bulan,
							'tahun_dibayar'	=> $id_spp,
							'id_spp'		=> $id_spp,
							'jumlah_bayar'	=> $harga_perbulan,
							'status_pembayaran_siswa'=> $status_siswa);

				$data_update  = array('id_spp' => '2');
				$update_siswa = $this->M_Pembayaran->Update_Siswa($nisn, $data_update);

				$bayar = $this->db->insert('pembayaran', $data);
				if($bayar){
					redirect('Pembayaran/Bayar_SPP/'.$nis);
				}else{
					echo('Gagal melakukan Pembayaran!');
				}
			}else{
				echo "Pembayaran SPP tidak boleh acak!"; 
			}
		}else if($id_spp == 3){

			if($max_bulan_bayar+1 == $bulan){ 
				$data = array('id_petugas' 	=> $id_petugas,
							'nisn'			=> $nisn,
							'tgl_bayar' 	=> date('y-m-d'),
							'bulan_dibayar'	=> $bulan,
							'tahun_dibayar'	=> $id_spp,
							'id_spp'		=> $id_spp,
							'jumlah_bayar'	=> $harga_perbulan,
							'status_pembayaran_siswa'=> $status_siswa);

				$data_update  = array('id_spp' => '3');
				$update_siswa = $this->M_Pembayaran->Update_Siswa($nisn, $data_update);

				$bayar = $this->db->insert('pembayaran', $data);
				if($bayar){
					redirect('Pembayaran/Bayar_SPP/'.$nis);
				}else{
					echo('Gagal melakukan Pembayaran!');
				}
			}else{
				echo "Pembayaran SPP tidak boleh acak!"; 
			}
		}
	}

	public function Proses_Bayar_SPP_TN(){
		$id_petugas = $this->session->userdata('id_petugas');
		$nisn   	= $this->input->post('nisn');
		$nis   		= $this->input->post('nis');
		$bulan  	= $this->input->post('bulan');
		$id_spp 	= $this->input->post('id_spp');
		$status_siswa = $this->input->post('status_siswa');

		$max_bulan_bayar 	= $this->M_Pembayaran->hitung_pembayaran_TN($nisn, $id_spp, $status_siswa);
		$ambil_total_bayar 	= $this->db->get_where('spp', array('id_spp' => $id_spp))->row();
		$harga_perbulan		= $ambil_total_bayar->nominal/12; 

		if($max_bulan_bayar+1 == $bulan){ 
			$data = array('id_petugas' 	=> $id_petugas,
						'nisn'			=> $nisn,
						'tgl_bayar' 	=> date('y-m-d'),
						'bulan_dibayar'	=> $bulan,
						'tahun_dibayar'	=> $id_spp,
						'id_spp'		=> $id_spp,
						'jumlah_bayar'	=> $harga_perbulan,
						'status_pembayaran_siswa'=> $status_siswa);

			$data_update  = array('id_spp' => $id_spp);
			$update_siswa = $this->M_Pembayaran->Update_Siswa($nisn, $data_update);

			$bayar = $this->db->insert('pembayaran', $data);
			if($bayar){
				redirect('Pembayaran/Bayar_SPP/'.$nis);
			}else{
				echo('Gagal melakukan Pembayaran!');
			}
		}else{
			echo "Pembayaran SPP tidak boleh acak!"; 
		}
	}

	

	public function Pembayaran_SPP($nisn){
		$bulan 		= $this->input->post('bulan', true);
		$tahun 		= $this->input->post('tahun', true);
		$id_spp 	= $this->input->post('id_spp', true);
		$status_siswa= $this->input->post('status_siswa', true);

		$id_petugas = $this->session->userdata('id_petugas');

		
		if(empty($status_siswa)){
			$status_siswa = ' ';
			if($id_spp == '1' || $id_spp == '4'){
				$id_spp2 = '1';
				$spp = $this->db->get_where('spp', array('id_spp' => $id_spp2))->row();
				
				$total_spp = $spp->nominal;
				$spp_per_bulan = $total_spp/12;

				$jumlah_bayar = $bulan*$spp_per_bulan;
			}else if($id_spp == '2'){
				$spp = $this->db->get_where('spp', array('id_spp' => $id_spp))->row();
				
				$total_spp = $spp->nominal;
				$spp_per_bulan = $total_spp/12;

				$jumlah_bayar = $bulan*$spp_per_bulan;
			}else{
				$spp = $this->db->get_where('spp', array('id_spp' => $id_spp))->row();
				
				$total_spp = $spp->nominal;
				$spp_per_bulan = $total_spp/12;

				$jumlah_bayar = $bulan*$spp_per_bulan;
			}
		}else{
			$jumlah_bayar = 0;
		}

		$ambil = $this->db->get_where('pembayaran', array('nisn'=> $nisn))->result_array();
		foreach ($ambil as $a) {
			$hitung2 += $a['bulan_dibayar'];
		}
		$cek = $hitung2+$bulan;
		
	
		if($cek > 36){
			if($hitung2 >= 36){
				redirect('Pembayaran/SPP_Selesai');
			}else{
				$bulan2 = 36-$hitung2;

				$data = array(
						'id_petugas'	=> $id_petugas,
						'nisn'			=> $nisn,
						'tgl_bayar'		=> date('Y-m-d'),
						'bulan_dibayar'	=> $bulan2,
						'tahun_dibayar'	=> '3',
						'id_spp'		=> '3',
						'jumlah_bayar'	=> $jumlah_bayar,
						'status_siswa'	=> $status_siswa,
					);

				$tambah = $this->db->insert('pembayaran', $data);

				if($tambah){
					redirect('Pembayaran/Data_Pembayaran_SPP');
				}else{
					echo 'Gagal Insert Data!';
				}
			}
		}else{
			if($cek <13){
				if(empty($hitung2)){
					$data = array(
						'id_petugas'	=> $id_petugas,
						'nisn'			=> $nisn,
						'tgl_bayar'		=> date('Y-m-d'),
						'bulan_dibayar'	=> $bulan,
						'tahun_dibayar'	=> '1',
						'id_spp'		=> '1',
						'jumlah_bayar'	=> $jumlah_bayar,
						'status_siswa'	=> $status_siswa,
					);

					$tambah = $this->db->insert('pembayaran', $data);
					$data_update = array('id_spp' => '1');
					$update_tb = $this->M_Pembayaran->Update_ID_SPP($nisn, $data_update);
				}else{
					$data = array(
						'id_petugas'	=> $id_petugas,
						'nisn'			=> $nisn,
						'tgl_bayar'		=> date('Y-m-d'),
						'bulan_dibayar'	=> $bulan,
						'tahun_dibayar'	=> '1',
						'id_spp'		=> '1',
						'jumlah_bayar'	=> $jumlah_bayar,
						'status_siswa'	=> $status_siswa,
					);

					$tambah = $this->db->insert('pembayaran', $data);
				}
			}else if($cek >12 && $cek <25){
				$data = array(
						'id_petugas'	=> $id_petugas,
						'nisn'			=> $nisn,
						'tgl_bayar'		=> date('Y-m-d'),
						'bulan_dibayar'	=> $bulan,
						'tahun_dibayar'	=> '2',
						'id_spp'		=> '2',
						'jumlah_bayar'	=> $jumlah_bayar,
						'status_siswa'	=> $status_siswa,
					);

				$data_update = array('id_spp' => '2');
				$update_tb = $this->M_Pembayaran->Update_ID_SPP($nisn, $data_update);
				if(!$update_tb){
					echo 'Gagal Update Data Siswa (ID_SPP)';
				}
				$tambah = $this->db->insert('pembayaran', $data);
			}else if($cek >24 && $cek <37){
				$data = array(
						'id_petugas'	=> $id_petugas,
						'nisn'			=> $nisn,
						'tgl_bayar'		=> date('Y-m-d'),
						'bulan_dibayar'	=> $bulan,
						'tahun_dibayar'	=> '3',
						'id_spp'		=> '3',
						'jumlah_bayar'	=> $jumlah_bayar,
						'status_siswa'	=> $status_siswa,
					);

				$data_update = array('id_spp' => '3');
				$update_tb = $this->M_Pembayaran->Update_ID_SPP($nisn, $data_update);
				if(!$update_tb){
					echo 'Gagal Update Data Siswa (ID_SPP)';
				}
				$tambah = $this->db->insert('pembayaran', $data);
			}
			
			if($tambah){
				redirect('Pembayaran/Data_Pembayaran_SPP');
			}else{
				echo 'Gagal Insert Data!';
			}
		}
	}

	public function SPP_Selesai(){
		if($this->session->userdata('level') == 'admin'){
			$this->load->view('Layout_admin/Navbar');
			$this->load->view('Pembayaran_SPP/SPP_Selesai');
		}else if($this->session->userdata('level') == 'petugas'){
			$this->load->view('Layout_admin/Navbar_Petugas');
			$this->load->view('Pembayaran_SPP/SPP_Selesai');
		}else{
			redirect('Petugas');
		}
	}

	public function Ubah_Nominal_SPP(){
		if($this->session->userdata('level') == 'petugas'){
			redirect('Petugas');
		}else if($this->session->userdata('level') == 'admin'){
			$this->load->view('Layout_admin/Navbar');
			$data['data'] = $this->db->get('spp')->result_array();
			$this->load->view('Pembayaran_SPP/Ubah_Nominal_SPP', $data);
		}else{
			redirect('Petugas');
		}
	}

	public function Proses_Ubah_Nominal_SPP(){
		$tahun 		= $this->input->post('tahun', true);
		$nominal 	= $this->input->post('nominal', true);

		$hasil_nominal = $nominal*12;

		$data_tahun 	= array('tahun' => $tahun);
		$data_nominal 	= array('nominal' => $hasil_nominal);
		$update = $this->M_Pembayaran->Proses_Ubah_Nominal_SPP($data_nominal, $data_tahun);

		if($update){
			redirect('Admin/Data_Spp');
		}else{
			echo 'Gagal Update Data!';
		}
	}

}