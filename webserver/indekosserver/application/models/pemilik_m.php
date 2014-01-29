<?php

class Pemilik_M extends CI_Model{

	public function get_pemilik_id($email){
		$this->db->select('pemilik_id,pemilik_email,pemilik_rumah_long,pemilik_rumah_lat');
		$query = $this->db->get_where('pemilik',array('pemilik_email'=>$email,'pemilik_status'=>'aktif'));
		
		if($query->num_rows()==1){
			return $query;
		}else return false;
	}
	
	public function get_long_lat_kota_pemilik($email){
		$this->db->select('*');
		$this->db->from('pemilik');
		$this->db->join('kab_kota','kab_kota.kab_kota_id=pemilik.kab_kota_id');
		$this->db->where('pemilik.pemilik_email',$email);
		return $query = $this->db->get();
	}
	
	public function get_long_lat_rumah($email){
		$this->db->select('*');
		$this->db->from('pemilik');
		$this->db->where('pemilik.pemilik_email',$email);
		return $query = $this->db->get();
	}
	
	public function cek_data($email){
		$this->db->select('*');
		$data = array(
			'pemilik_email'		=> $email,
			'pemilik_status'	=> 'aktif',
			'pemilik_alamat'	=> '',
			'pemilik_no_hp'		=> '0',
			'pemilik_rumah_long'=> '110.38015365600586',
			'pemilik_rumah_lat'	=> '-7.807602562408751'
		);
		/*$this->db->where('pemilik_email',$email);
		$this->db->or_where('pemilik_alamat','');
		$this->db->or_where('pemilik_no_hp','');
		$this->db->or_where('pemilik_rumah_long','');
		$this->db->or_where('pemilik_rumah_lat','');*/
		return $this->db->get_where('pemilik',$data);
	}
	
	public function update_pribadi(){
		$data = array(
			'pemilik_nama' 			=> $this->input->post('pemilik_nama'),
			'pemilik_alamat' 		=> $this->input->post('pemilik_alamat'),
			'pemilik_no_hp' 		=> $this->input->post('pemilik_no_hp'),
			'pemilik_rumah_long' 	=> $this->input->post('pemilik_rumah_long'),
			'pemilik_rumah_lat' 	=> $this->input->post('pemilik_rumah_lat')
		);
		$this->db->where('pemilik_id',$this->input->post('pemilik_id'));
		$this->db->where('pemilik_email',$this->input->post('pemilik_email'));
		if($this->db->update('pemilik',$data))return true; else return false;
	}
	
	public function update_pribadi_pertama(){
		$data = array(
			'pemilik_nama' 			=> $this->input->post('pemilik_nama'),
			'pemilik_alamat' 		=> $this->input->post('pemilik_alamat'),
			'kab_kota_id' 			=> $this->input->post('kab_kota_id'),
			'pemilik_no_hp' 		=> $this->input->post('pemilik_no_hp'),
			'pemilik_rumah_long' 	=> $this->input->post('pemilik_rumah_long'),
			'pemilik_rumah_lat' 	=> $this->input->post('pemilik_rumah_lat')
		);
		$this->db->where('pemilik_id',$this->input->post('pemilik_id'));
		$this->db->where('pemilik_email',$this->input->post('pemilik_email'));
		if($this->db->update('pemilik',$data))return true; else return false;
	}
	
	public function cek_password(){
		$data = array(
			'pemilik_email'		=> $this->input->post('pemilik_email'),
			'pemilik_password'		=> md5($this->input->post('pemilik_password_lama'))
		);
		$query = $this->db->get_where('pemilik',$data);
		if($query->num_rows()==1){
			return true;
		}else return false;
	}
	
	public function ubah_password(){
		$databaru = array(
			'pemilik_password'		=> md5($this->input->post('pemilik_password_baru'))
		);
		$this->db->where('pemilik_email',$this->input->post('pemilik_email'));
		if($this->db->update('pemilik',$databaru)){
			return true;
		}else return false;
	}
	
	public function data_pribadi($email){
		$this->db->select('*');
		return $this->db->get_where('pemilik',array('pemilik_email'=>$email));
	}
	
	public function confirm($key){
		$this->db->select('pemilik_kode_aktif');
		$this->db->where('pemilik_kode_aktif',$key);
		return $this->db->get('pemilik');
	}
	
	public function pemilik_aktif($key){
		$data = array(
			'pemilik_status'=>'aktif',
			'pemilik_kode_aktif'=>''
		);
		$this->db->where('pemilik_kode_aktif',$key);
		if($this->db->update('pemilik',$data)){
			return true;
		}else return false;
	}
	
	public function password_key($key){
		$this->db->select('*');
		$this->db->join('pemilik','pemilik.pemilik_id=lupa_password.pemilik_id');
		$this->db->where('lupa_password.lupa_password_key',$key);
		//return $this->db->get('pemilik');
		return $this->db->get('lupa_password');
	}
	
	public function recovery($email,$key){
		$data = array(
			'pemilik_password' => md5($email)
		);
		$this->db->where('lupa_password_key',$key);
		
		$query = $this->db->get('lupa_password');
		if($query->num_rows()==1){
			foreach($query->result() as $pemilik_id);
			$this->db->where('pemilik_id',$pemilik_id->pemilik_id);
			if($this->db->update('pemilik',$data)){
				$this->db->where('lupa_password_key',$key);
				$this->db->delete('lupa_password');
				return true;
			}else return false;
		}
	}
	
}

