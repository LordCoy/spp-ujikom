<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Petugas extends CI_Controller {

	public function index(){
		$this->load->view('Login');
	}

	public function Proses_Login(){
		$username = $this->input->post('username', true);
		$password = $this->input->post('password', true);
		$cek = $this->M_Petugas->Proses_Login($username, $password);
		$hasil = count($cek);

		if($hasil<1){
			$this->session->set_flashdata('error_login', true);
			redirect('Petugas');
		}else{
			if($cek->level == 'admin'){
				$data_session = array(
							'id_petugas' => $cek->id_petugas,
							'username'	 => $cek->username,
							'nama_petugas'=>$cek->nama_petugas,
							'level'		 => $cek->level,
				);

				$this->session->set_userdata($data_session);
				redirect('Pembayaran/Dashboard');
			}else{
				$data_session = array(
							'id_petugas' => $cek->id_petugas,
							'username'	 => $cek->username,
							'nama_petugas'=>$cek->nama_petugas,
							'level'		 => $cek->level,
				);

				$this->session->set_userdata($data_session);
				redirect('Pembayaran/Dashboard');
			}
		}
	}

	public function Logout(){
		$this->session->sess_destroy();
		redirect('Siswa');
	}

	public function Profile(){
		$this->load->view('Profile/Profile_petugas');
	}
}