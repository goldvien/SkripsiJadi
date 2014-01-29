<?php

class Login_M extends CI_Model{
	
	public function cek_login(){
		$this->db->where('pemilik_email',$this->input->post('email'));
		$this->db->where('pemilik_status','aktif');
		$this->db->where('pemilik_password',md5($this->input->post('password')));
		
		$query = $this->db->get('pemilik');
		if($query->num_rows()==1){
			return true;
		}else return false;
	}
	
	public function cek_login_admin(){
		$this->db->where('admin_email',$this->input->post('email'));
		$this->db->where('admin_status','aktif');
		$this->db->where('admin_password',md5($this->input->post('password')));
		
		$query = $this->db->get('admin');
		if($query->num_rows()==1){
			return true;
		}else return false;
	}
	
	public function tambah_user($key){
		$data = array(
			'pemilik_email'			=>$this->input->post('dftemail'),
			'pemilik_password'		=> md5($this->input->post('dftpassword')),
			'provinsi_id'			=> $this->input->post('provinsi_id'),
			'pemilik_status'		=> 'pending',
			'pemilik_kode_aktif'	=> $key
		);
		
		$query = $this->db->insert('pemilik',$data);
		if($query){
			return true;
		}else return false;
	}
	
	public function konfirmasi_ulang($email,$key){
		$data = array('pemilik_kode_aktif'=>$key);
		$this->db->where('pemilik_email',$email);
		if($this->db->update('pemilik',$data)){
			return true;
		}else return false;
	}
	
	public function cek_email($email){
		$this->db->select('pemilik_email,pemilik_status');
		$this->db->where('pemilik_email',$email);
		return $this->db->get('pemilik');
	}
	
	public function lupa_password($email,$key){
		$this->db->select('*');
		$this->db->where('pemilik_email',$email);
		$data = $this->db->get('pemilik');
		foreach($data->result() as $pemilik){
			
			$insert = array(
				'pemilik_id'		=>$pemilik->pemilik_id,
				'lupa_password_key'	=>$key
			);
			$this->db->select('*');
			$lupa = $this->db->get_where('lupa_password',array('pemilik_id'=>$pemilik->pemilik_id))->num_rows();
			//$this->db->where('pemilik_email',$email);
			if($lupa == 0){
				if($this->db->insert('lupa_password',$insert)){
					return true;
				}else return false;
			}else{
				$this->db->where('pemilik_id',$pemilik->pemilik_id);
				if($this->db->update('lupa_password',$insert)){
					return true;
				}else return false;
			}
		}
	}
	
}
