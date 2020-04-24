<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Admin extends CI_Model {
	//DATA SISWA
	public function Data_Siswa($data_filter){
		$this->db->like($data_filter);
		$this->db->order_by('nama', 'asc');
		$this->db->select('*');
		$this->db->from('kelas','spp');
		$this->db->join('siswa', 'siswa.id_kelas = kelas.id_kelas');
		$this->db->join('spp', 'spp.id_spp = siswa.id_spp');
		return $this->db->get()->result_array();
	}

	public function Edit_Data_Siswa($nisn){
		$this->db->select('*');
		$this->db->where('siswa.nisn', $nisn);
		$this->db->from('siswa');
		$this->db->join('kelas', 'kelas.id_kelas = siswa.id_kelas');
		return $this->db->get()->row();
	}

	public function Proses_Edit_Data_Siswa($nisn, $data){
		$this->db->where('nisn', $nisn);
		return $this->db->update('siswa', $data);
	}

	public function Hapus_Data_Siswa($nisn){
		$this->db->where('nisn',$nisn);
		return $this->db->delete('siswa');
	}

	public function Hapus_Pembayaran_Siswa($nisn){
		$this->db->where('nisn',$nisn);
		return $this->db->delete('pembayaran');
	}

	//DATA PETUGAS
	public function Data_Petugas($data_filter){
		$this->db->like($data_filter);
		return $this->db->get('petugas')->result_array();
	}

	public function Edit_Data_Petugas($id_petugas){
		$this->db->where('id_petugas', $id_petugas);
		return $this->db->get('petugas')->row();
	}

	public function Proses_Edit_Data_Petugas($id_petugas, $data){
		$this->db->where('id_petugas', $id_petugas);
		return $this->db->update('petugas', $data);
	}

	public function Hapus_Data_Petugas($id_petugas){
		$this->db->where('id_petugas', $id_petugas);
		return $this->db->delete('petugas');
	}

	//DATA KELAS
	public function Data_Kelas(){
		return $this->db->get('kelas')->result_array();
	}

	public function Edit_Data_Kelas($id_kelas){
		$this->db->where('id_kelas', $id_kelas);
		return $this->db->get('kelas')->row();
	}

	public function Proses_Edit_Data_Kelas($id_kelas, $data){
		$this->db->where('id_kelas', $id_kelas);
		return $this->db->update('kelas', $data);
	}

	public function Hapus_Data_Kelas($id_kelas){
		$this->db->where('id_kelas',$id_kelas);
		return $this->db->delete('kelas');
	}

	//DATA SPP
	public function Data_Spp(){
		return $this->db->get('spp')->result_array();
	}

	public function Edit_Data_Spp($id_spp){
		$this->db->where('id_spp', $id_spp);
		return $this->db->get('spp')->row();
	}

	public function Proses_Edit_Data_Spp($id_spp, $data){
		$this->db->where('id_spp', $id_spp);
		return $this->db->update('spp', $data);
	}

	public function Hapus_Data_Spp($id_spp){
		$this->db->where('id_spp',$id_spp);
		return $this->db->delete('spp');
	}


	public function Proses_Edit_Profile_Petugas($id_petugas, $data){
		$this->db->where('id_petugas', $id_petugas);
		return $this->db->update('petugas', $data);
	}

}