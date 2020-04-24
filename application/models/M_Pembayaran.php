<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Pembayaran extends CI_Model {

	//Dashboard
	public function siswa_bayar(){
		$this->db->like('id_spp', '1');
		$this->db->or_like('id_spp', '2');
		$this->db->or_like('id_spp', '3');
		return $this->db->get('siswa')->num_rows();
	}

	public function siswa_belum_bayar(){
		$this->db->like('id_spp', '4');
		return $this->db->get('siswa')->num_rows();
	}
	//
	
	//Data Pembayaran Baru
	public function Data_Pembayaran_SPP($data_cari){
		$this->db->order_by('pembayaran.tgl_bayar','pembayaran.tahun_dibayar', 'desc');
		$this->db->like($data_cari);
		$this->db->select('*');
		$this->db->from('pembayaran');
		$this->db->join('siswa', 'siswa.nisn = pembayaran.nisn');
		$this->db->join('petugas', 'petugas.id_petugas = pembayaran.id_petugas');
		return $this->db->get()->result_array();
	}

	public function data_pembayaran($bulan, $tahun, $nisn){
		$this->db->where('nisn', $nisn);
		$this->db->where('bulan_dibayar', $bulan);
		$this->db->where('tahun_dibayar', $tahun);
		$this->db->where('status_pembayaran_siswa', '');
		return $this->db->get('pembayaran')->row();
	}

	public function data_pembayaran_status($bulan, $tahun, $nisn, $status){
		$this->db->where('nisn', $nisn);
		$this->db->where('bulan_dibayar', $bulan);
		$this->db->where('tahun_dibayar', $tahun);
		$this->db->where('status_pembayaran_siswa', $status);
		return $this->db->get('pembayaran')->row();
	}
	//

	//Proses Pembayaran Baru
	public function hitung_pembayaran($nisn, $id_spp){
		$this->db->where('nisn', $nisn);
		$this->db->where('tahun_dibayar', $id_spp);
		$this->db->where('status_pembayaran_siswa', '');
		return $this->db->get('pembayaran')->num_rows();
	}

	public function hitung_pembayaran_TN($nisn, $id_spp, $status_siswa){
		$this->db->where('nisn', $nisn);
		$this->db->where('tahun_dibayar', $id_spp);
		$this->db->where('status_pembayaran_siswa', $status_siswa);
		return $this->db->get('pembayaran')->num_rows();
	}

	public function Update_Siswa($nisn, $data_update){
		$this->db->where('nisn', $nisn);
		return $this->db->update('siswa', $data_update);
	}

	//

	public function pindahan($nisn, $tahun){
		$this->db->where('nisn', $nisn);
		$this->db->where('tahun_dibayar', $tahun);
		return $this->db->get('pembayaran')->result_array();
	}

	public function ambil_siswa($nis){
		$this->db->where('nis', $nis);
		return $this->db->get('siswa')->row();
	}

	public function Jumlah_Bayar($nisn){
		$this->db->like('nisn', $nisn);
		$this->db->select_sum('bulan_dibayar');
		return $this->db->get('pembayaran')->row();
	}

	public function Proses_Pencarian_Data_Siswa($nis){
		$this->db->where('siswa.nis', $nis);
		$this->db->select('*');
		$this->db->from('kelas', 'spp');
		$this->db->join('siswa', 'siswa.id_kelas = kelas.id_kelas');
		$this->db->join('spp', 'spp.id_spp = siswa.id_spp');
		return $this->db->get('')->row();
	}

	public function Update_ID_SPP($nisn, $data_update){
		$this->db->where('nisn', $nisn);
		return $this->db->update('siswa', $data_update);
	}

	public function Proses_Ubah_Nominal_SPP($data_nominal, $data_tahun){
		$this->db->where($data_tahun);
		return $this->db->update('spp', $data_nominal);
	}
}