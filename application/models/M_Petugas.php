<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Petugas extends CI_Model {
	public function Proses_Login($username, $password){
		$this->db->where('username', $username);
		$this->db->where('password', $password);
		return $this->db->get('petugas')->row();
	}
}