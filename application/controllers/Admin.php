<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct(){
		parent:: __construct();
		$this->load->model('M_Admin');
	}

	public function index(){
		$this->load->view('Vpertama');
	}

	public function Profile(){
		$id_petugas = $this->session->userdata('id_petugas');

		if($this->session->userdata('level') == 'admin'){

			$data['profile'] = $this->db->get_where('petugas', array('id_petugas' => $id_petugas))->row();
			$this->load->view('Layout_admin/Navbar');
			$this->load->view('Profile/Profile_petugas', $data);

		}else if($this->session->userdata('level') == 'petugas'){

			$data['profile'] = $this->db->get_where('petugas', array('id_petugas' => $id_petugas))->row();
			$this->load->view('Layout_admin/Navbar_Petugas');
			$this->load->view('Profile/Profile_petugas', $data);

		}else{
			redirect('Petugas');
		}
	}

	public function Edit_Profile(){
		$id_petugas = $this->session->userdata('id_petugas');

		if($this->session->userdata('level') == 'admin'){

			$data['edit'] = $this->db->get_where('petugas', array('id_petugas' => $id_petugas))->row();
			$this->load->view('Layout_admin/Navbar');
			$this->load->view('Profile/Edit_Profile_Petugas', $data);

		}else if($this->session->userdata('level') == 'petugas'){

			$data['edit'] = $this->db->get_where('petugas', array('id_petugas' => $id_petugas))->row();
			$this->load->view('Layout_admin/Navbar_Petugas');
			$this->load->view('Profile/Edit_Profile_Petugas', $data);

		}else{
			redirect('Petugas');
		}
	}

	public function Proses_Edit_Profile_Petugas($id_petugas){
		$nama_petugas = $this->input->post('nama', true);
		$username	  = $this->input->post('username', true);

		$data = array('nama_petugas' => $nama_petugas,
					  'username'	 => $username);

		$edit = $this->M_Admin->Proses_Edit_Profile_Petugas($id_petugas, $data);

		if($edit){
			redirect('Admin/Profile');
		}else{
			echo "Gagal Edit Profile";
		}
	}

	public function Ubah_Password(){
		$id_petugas = $this->session->userdata('id_petugas');

		if($this->session->userdata('level') == 'admin'){

			$this->load->view('Layout_admin/Navbar');
			$this->load->view('Profile/Ubah_Password');

		}else if($this->session->userdata('level') == 'petugas'){

			$this->load->view('Layout_admin/Navbar_Petugas');
			$this->load->view('Profile/Ubah_Password');

		}else{
			redirect('Petugas');
		}
	}

	public function Proses_Ubah_Password(){
		$id_petugas = $this->session->userdata('id_petugas');

		$pass_lama  = $this->input->post('pass_lama', true);
		$pass_baru  = $this->input->post('pass_baru', true);
		$pass_baru2 = $this->input->post('pass_baru2', true);

		$ambil = $this->db->get_where('petugas', array('id_petugas' => $id_petugas, 'password' => $pass_lama))->row();
		$cek   = count($ambil);
		if($cek > 0){
			if($pass_baru == $pass_baru2){
				$data = array('password' => $pass_baru);
				$update = $this->M_Admin->Proses_Edit_Profile_Petugas($id_petugas, $data);
				if($update){
					redirect('Admin/Profile');
				}else{
					echo "Gagal Update Password!";
				}
			}else{
				$this->session->set_flashdata('error_second_input', true);
				redirect('Admin/Ubah_Password');
			}
		}else{
			$this->session->set_flashdata('error_oldpass_input', true);
			redirect('Admin/Ubah_Password');
		}
	}


	//--------------------------------------------SISWA--------------------------------------------------
	public function Data_Siswa(){
		if($this->session->userdata('level') == 'admin'){
			
			$nis 				= $this->input->post('nis', true);
			$nama 				= $this->input->post('nama', true);
			$kelas 				= $this->input->post('kelas', true);
			$kompetensi_keahlian= $this->input->post('kompetensi_keahlian', true);
			$spp 				= $this->input->post('spp', true);
			$alamat 			= $this->input->post('alamat', true);

			$data_filter = array('siswa.nis' => $nis,
									'siswa.nama' => $nama,
									'siswa.id_kelas' => $kelas,
									'siswa.id_spp' => $spp,
									'kelas.kompetensi_keahlian' => $kompetensi_keahlian,
									'siswa.alamat' => $alamat,);

			$data['ket'] = array('nis' => $nis,
								 'nama' => $nama,
								 'kelas' => $kelas,
								 'kompetensi_keahlian' => $kompetensi_keahlian,
								 'id_spp' => $spp,
								 'alamat' => $alamat,);

			$this->load->view('Layout_admin/Navbar');
			$data['siswa'] = $this->M_Admin->Data_Siswa($data_filter);
			$data['spp']   = $this->db->get('spp')->result_array();
			$this->load->view('Admin/Data_Siswa/Data_Siswa', $data);
		}else{
			redirect('Petugas');
		}
	}

	public function Tambah_Data_Siswa(){
		if($this->session->userdata('level') == 'admin'){
			$this->load->view('Layout_admin/Navbar');
			$data['kelas'] = $this->db->get('kelas')->result_array();
			$this->load->view('Admin/Data_Siswa/Tambah_Data_Siswa', $data);
		}else{
			redirect('Petugas');
		}
	}

	public function Proses_Tambah_Data_Siswa(){
		$nisn 	= $this->input->post('nisn', true);
		$nis 	= $this->input->post('nis', true);
		$nama 	= $this->input->post('nama', true);
		$tempat = $this->input->post('tempat', true);
		$tgl_lahir = $this->input->post('tgl_lahir', true);
		$kelas 	= $this->input->post('kelas', true);
		$no_telp= $this->input->post('no_telp', true);
		$alamat = $this->input->post('alamat', true);
		$status_siswa = $this->input->post('status_siswa');

		if($status_siswa == ''){
			$status_siswa = null;
		}

		$id_petugas = $this->session->userdata('id_petugas');
		$password = $nisn.$nis;

		$cek = $this->db->get_where('siswa', array('nisn' => $nisn))->row();
		if($nisn == $cek->nisn){
			echo 'NISN sudah ada!';
		}else{
			$data = array('nisn' 		=> $nisn,
							'nis'		=> $nis,
							'nama'		=> $nama,
							'tempat'	=> $tempat,
							'tgl_lahir'	=> $tgl_lahir,
							'id_kelas'	=> $kelas,
							'no_telp'	=> $no_telp,
							'alamat'	=> $alamat,
							'id_spp'	=> 4,
							'password'	=> $password,
							'status_siswa'=> $status_siswa,);

			if(empty($status_siswa)){
				$tambah = $this->db->insert('siswa', $data);
				if($tambah){
					redirect('Admin/Data_Siswa');
				}else{
					echo 'Gagal Insert Data';
				}
			}else{
				$tambah = $this->db->insert('siswa', $data);
				if($tambah){
					if($status_siswa == 'siswa pindahan ke kelas X'){
						redirect('Admin/Data_Siswa');
					}else if($status_siswa == 'siswa pindahan ke kelas XI'){
						for ($i=1; $i < 13; $i++) { 
							$data_pembayaran = array('id_petugas'=> $id_petugas,
												'nisn' 			=> $nisn,
												'tgl_bayar'		=> date('y-m-d'),
												'bulan_dibayar'	=> $i,
												'tahun_dibayar'	=> 1,
												'id_spp'		=> 1,
												'jumlah_bayar'	=> 0,
												'status_pembayaran_siswa'=> $status_siswa);

							$this->db->insert('pembayaran', $data_pembayaran);
						}
						$data_update = array('id_spp' => '2');
						$update_tb   = $this->M_Pembayaran->Update_ID_SPP($nisn, $data_update);
					}else if($status_siswa == 'siswa pindahan ke kelas XII'){
						for ($i=1; $i < 13; $i++) { 
							$data_pembayaran = array('id_petugas'=> $id_petugas,
												'nisn' 			=> $nisn,
												'tgl_bayar'		=> date('y-m-d'),
												'bulan_dibayar'	=> $i,
												'tahun_dibayar'	=> 1,
												'id_spp'		=> 1,
												'jumlah_bayar'	=> 0,
												'status_pembayaran_siswa'=> $status_siswa);

							$this->db->insert('pembayaran', $data_pembayaran);
						}
						for ($i=1; $i < 13; $i++) { 
							$data_pembayaran = array('id_petugas'=> $id_petugas,
												'nisn' 			=> $nisn,
												'tgl_bayar'		=> date('y-m-d'),
												'bulan_dibayar'	=> $i,
												'tahun_dibayar'	=> 2,
												'id_spp'		=> 2,
												'jumlah_bayar'	=> 0,
												'status_pembayaran_siswa'=> $status_siswa);

							$this->db->insert('pembayaran', $data_pembayaran);
						}
						$data_update = array('id_spp' => '3');
						$update_tb   = $this->M_Pembayaran->Update_ID_SPP($nisn, $data_update);
					}

					redirect('Admin/Data_Siswa');
				}else{
					echo 'Gagal Insert Data';
				}
			}

		}
	}

	public function Edit_Data_Siswa($nisn){
		if($this->session->userdata('level') == 'petugas'){
			redirect('Petugas');
		}else if($this->session->userdata('level') == 'admin'){
			$this->load->view('Layout_admin/Navbar');
			$data['siswa'] = $this->M_Admin->Edit_Data_Siswa($nisn);
			$this->load->view('Admin/Data_Siswa/Edit_Data_Siswa', $data);
		}else{
			redirect('Petugas');
		}
	}

	public function Proses_Edit_Data_Siswa(){
		$nisn 	= $this->input->post('nisn', true);
		$nis 	= $this->input->post('nis', true);
		$nama 	= $this->input->post('nama', true);
		$tempat = $this->input->post('tempat', true);
		$tgl_lahir = $this->input->post('tgl_lahir', true);
		$kelas 	= $this->input->post('kelas', true);
		$no_telp= $this->input->post('no_telp', true);
		$alamat = $this->input->post('alamat', true);
		$status_siswa = $this->input->post('status_siswa', true);

		$data = array('nisn' 		=> $nisn,
						'nis'		=> $nis,
						'nama'		=> $nama,
						'tempat'	=> $tempat,
						'tgl_lahir'	=> $tgl_lahir,
						'id_kelas'	=> $kelas,
						'no_telp'	=> $no_telp,
						'alamat'	=> $alamat,
						'status_siswa'=> $status_siswa);

		$edit = $this->M_Admin->Proses_Edit_Data_Siswa($nisn, $data);
		if($edit){
			redirect('Admin/Data_Siswa');
		}else{
			echo 'Gagal Update';
		}
	}

	public function Hapus_data_Siswa($nisn){
		$pembayaran = $this->db->get_where('pembayaran',array('nisn' => $nisn))->result_array();
		$cek = count((array)$pembayaran);

		if ($cek > 0) {
			$this->M_Admin->Hapus_Pembayaran_Siswa($nisn);
			$hapus = $this->M_Admin->Hapus_data_Siswa($nisn);

			if ($hapus) {
				redirect('Admin/Data_Siswa');
			}else{
				echo 'Menghapus data gagal !';
			}
		}else{
			$hapus = $this->M_Admin->Hapus_data_Siswa($nisn);

			if ($hapus) {
				redirect('Admin/Data_Siswa');
			}else{
				echo 'Menghapus data gagal !';
			}
		}

	}


	//--------------------------------------------------PETUGASS-------------------------------------------------
	public function Data_Petugas(){
		if($this->session->userdata('level') == 'admin'){
			$nama_petugas = $this->input->post('nama_petugas', true);
			$level		  = $this->input->post('level',true);

			$data_filter  = array('nama_petugas' => $nama_petugas, 'level' => $level);

			$this->load->view('Layout_admin/Navbar');
			$data['petugas'] = $this->M_Admin->Data_Petugas($data_filter);
			$this->load->view('Admin/Data_Petugas/Data_Petugas', $data);
		}else{
			redirect('Petugas');
		}
	}

	public function Tambah_Data_Petugas(){
		if($this->session->userdata('level') == 'admin'){
			$this->load->view('Layout_admin/Navbar');
			$this->load->view('Admin/Data_Petugas/Tambah_Data_Petugas');
		}else{
			redirect('Petugas');
		}
	}

	public function Proses_Tambah_Data_Petugas(){
		$nama 		= $this->input->post('nama', true);
		$level 		= $this->input->post('level', true);
		$username 	= $this->input->post('username', true);
		$password	= $this->input->post('password', true);

		$data = array('nama_petugas' => $nama,
						'level'		 => $level,
						'username'	 => $username,
						'password'	 => $password);
		$tambah = $this->db->insert('petugas', $data);
		if($tambah){
			redirect('Admin/Data_Petugas');
		}else{
			echo 'Gagal Tambah Data!';
		}
	}

	public function Edit_Data_Petugas($id_petugas){
		if($this->session->userdata('level') == 'admin'){
			$this->load->view('Layout_admin/Navbar');
			$data['petugas'] = $this->M_Admin->Edit_Data_Petugas($id_petugas);
			$this->load->view('Admin/Data_Petugas/Edit_Data_Petugas', $data);
		}else{
			redirect('Petugas');
		}
	}

	public function Proses_Edit_Data_Petugas($id_petugas){
		$nama 		= $this->input->post('nama', true);
		$level 		= $this->input->post('level', true);
		$username 	= $this->input->post('username', true);
		$password	= $this->input->post('password', true);

		$data = array('nama_petugas' => $nama,
						'level'		 => $level,
						'username'	 => $username,
						'password'	 => $password);
		$edit = $this->M_Admin->Proses_Edit_Data_Petugas($id_petugas, $data);
		if($edit){
			redirect('Admin/Data_Petugas');
		}else{
			echo 'Gagal Tambah Data!';
		}
	}

	public function Hapus_Data_Petugas($id_petugas){
		$hapus = $this->M_Admin->Hapus_Data_Petugas($id_petugas);

		if($hapus){
			redirect('Admin/Data_Petugas');
		}else{
			echo 'Gagal Hapus Data!';
		}
	}

	//---------------------------------------KELAS-----------------------------------------------------------------
	public function Data_Kelas(){
		if($this->session->userdata('level') == 'admin'){
			$this->load->view('Layout_admin/Navbar');
			$data['kelas'] = $this->M_Admin->Data_Kelas();
			$this->load->view('Admin/Data_Kelas/Data_Kelas', $data);
		}else{
			redirect('Petugas');
		}
	}

	public function Tambah_Data_Kelas(){
		if($this->session->userdata('level') == 'admin'){
			$this->load->view('Layout_admin/Navbar');
			$this->load->view('Admin/Data_Kelas/Tambah_Data_Kelas');
		}else{
			redirect('Petugas');
		}
	}

	public function Proses_Tambah_Data_Kelas(){
		$kelas = $this->input->post('kelas', true);
		$kompetensi = $this->input->post('kompetensi', true);

		$cek = $this->db->get_where('kelas', array('nama_kelas' => $kelas, 'kompetensi_keahlian' => $kompetensi))->row();
		$hasil = count($cek);
		if($hasil > 0){
			echo 'Data yang anda masukan sudah ada!';
		}else{
			$data = array('nama_kelas' => $kelas, 'kompetensi_keahlian' => $kompetensi);
			$tambah = $this->db->insert('kelas', $data);

			if($tambah){
				redirect('Admin/Data_Kelas');
			}else{
				echo 'Gagagl Insert Data!';
			}
		}
	}

	public function Edit_Data_Kelas($id_kelas){
		if($this->session->userdata('level') == 'admin'){
			$this->load->view('Layout_admin/Navbar');
			$data['kelas'] = $this->M_Admin->Edit_Data_Kelas($id_kelas);
			$this->load->view('Admin/Data_Kelas/Edit_Data_Kelas', $data);
		}else{
			redirect('Petugas');
		}
	}

	public function Proses_Edit_Data_Kelas($id_kelas){
		$kelas = $this->input->post('kelas', true);
		$kompetensi = $this->input->post('kompetensi', true);

		$data = array('nama_kelas' => $kelas, 'kompetensi_keahlian' => $kompetensi);
		$edit = $this->M_Admin->Proses_Edit_Data_Kelas($id_kelas, $data);

		if($edit){
			redirect('Admin/Data_Kelas');
		}else{
			echo 'Gagagl Insert Data!';
		}
	}

	public function Hapus_Data_Kelas($id_kelas){
		$hapus = $this->M_Admin->Hapus_Data_Kelas($id_kelas);

		if($hapus){
			redirect('Admin/Data_Kelas');
		}else{
			echo 'Gagal Hapus Data!';
		}
	}

	//----------------------------------------------------------DATA SPP-----------------------------------------------------
	public function Data_Spp(){
		if($this->session->userdata('level') == 'admin'){
			$this->load->view('Layout_admin/Navbar');
			$data['spp'] = $this->M_Admin->Data_Spp();
			$this->load->view('Admin/Data_Spp/Data_Spp',$data);
		}else{
			redirect('Petugas');
		}
	}

	public function Tambah_Data_Spp(){
		if($this->session->userdata('level') == 'admin'){
			$this->load->view('Layout_admin/Navbar');
			$this->load->view('Admin/Data_Spp/Tambah_Data_Spp');
		}else{
			redirect('Petugas');
		}
	}

	public function Proses_Tambah_Data_Spp(){
		$tahun	= $this->input->post('tahun', true);
		$nominal= $this->input->post('nominal', true);

		$cek = $this->db->get_where('spp', array('tahun'=>$tahun))->row();
		$hasil = count($cek);

		if($hasil > 0){
			echo 'Tahun yang anda masukan sudah ada!';
		}else{
			$data = array('tahun' => $tahun, 'nominal' => $nominal);
			$tambah = $this->db->insert('spp', $data);
			if($tambah){
				redirect('Admin/Data_Spp');
			}else{
				echo 'Gagagl Insert Data!';
			}
		}
	}

	public function Edit_Data_Spp($id_spp){
		if($this->session->userdata('level') == 'admin'){
			$this->load->view('Layout_admin/Navbar');
			$data['spp'] = $this->M_Admin->Edit_Data_Spp($id_spp);
			$this->load->view('Admin/Data_Spp/Edit_Data_Spp', $data);
		}else{
			redirect('Petugas');
		}
	}

	public function Proses_Edit_Data_Spp($id_spp){
		$tahun	= $this->input->post('tahun', true);
		$nominal= $this->input->post('nominal', true);

		$data = array('tahun' => $tahun, 'nominal' => $nominal);
		$edit = $this->M_Admin->Proses_Edit_Data_Spp($id_spp, $data);
		if($edit){
			redirect('Admin/Data_Spp');
		}else{
			echo 'Gagagl Insert Data!';
		}
	}

	public function Hapus_Data_Spp($id_spp){
		$hapus = $this->M_Admin->Hapus_Data_Spp($id_spp);

		if($hapus){
			redirect('Admin/Data_Spp');
		}else{
			echo 'Gagal Hapus Data!';
		}
	}

}