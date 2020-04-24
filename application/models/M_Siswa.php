<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Siswa extends CI_Model {
	public function Proses_Login($nis, $password){
		$this->db->where('nis', $nis);
		$this->db->where('password', $password);
		return $this->db->get('siswa')->row();
	}

	public function Profile($nis){
		$this->db->where('siswa.nis', $nis);
		$this->db->from('kelas');
		$this->db->join('siswa', 'siswa.id_kelas = kelas.id_kelas');
		return $this->db->get()->row();
	}

	public function Proses_ubah_Password($nis, $data){
		$this->db->where('nis', $nis);
		return $this->db->update('siswa', $data);
	}

	public function Ambil_SPP($nisn){
		$this->db->where('nisn', $nisn);
		return $this->db->get('pembayaran')->result_array();
	}

	public function Data_Pembayaran_SPP($nisn, $bulan, $tahun){
		$this->db->where('nisn', $nisn);
		$this->db->where('bulan_dibayar', $bulan);
		$this->db->where('tahun_dibayar', $tahun);
		$this->db->where('status_pembayaran_siswa', '');
		return $this->db->get('pembayaran')->row();
	}

	public function Data_Pembayaran_SPP_TN($nisn, $bulan, $tahun, $status){
		$this->db->where('nisn', $nisn);
		$this->db->where('bulan_dibayar', $bulan);
		$this->db->where('tahun_dibayar', $tahun);
		$this->db->where('status_pembayaran_siswa', $status);
		return $this->db->get('pembayaran')->row();
	}

	public function Tahun_SPP($nisn, $id_spp){
		$this->db->where('nisn', $nisn);
		$this->db->like('id_spp', $id_spp);
		return $this->db->get('pembayaran')->result_array();
	}

	public function Jumlah_Bayar($nisn){
		$this->db->where('nisn', $nisn);
		$this->db->select_sum('jumlah_bayar');
		return $this->db->get('pembayaran')->row();
	}

	public function Jumlah_Bulan($nisn){
		$this->db->where('nisn', $nisn);
		$this->db->select_sum('bulan_dibayar');
		return $this->db->get('pembayaran')->row();
	}
}