<?php

class Admin_m extends CI_Model{

	public function cek_login(){
		$this->db->where('admin_email',$this->input->post('email'));
		$this->db->where('admin_status','aktif');
		$this->db->where('admin_password',md5($this->input->post('password')));
		
		$query = $this->db->get('admin');
		if($query->num_rows()==1){
			return true;
		}else return false;
	}
	
	public function cek_data($email){
		$this->db->where('admin_email',$email);
		$this->db->where('admin_status','aktif');
		return $this->db->get('admin');
	}

}

