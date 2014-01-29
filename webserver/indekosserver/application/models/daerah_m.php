<?php

class Daerah_M extends CI_Model{
	
	public function provinsi(){
		$this->db->select('provinsi_id,provinsi_nama');
		$q = $this->db->get('provinsi');
		if ($q->num_rows() > 0){
			foreach($q->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}
	
	public function get_provinsi($provinsi_id){
		$this->db->select('*');
		$this->db->where('provinsi_id',$provinsi_id);
		return $this->db->get('provinsi');
	}
	
	public function kota($provinsi_id){
		$this->db->select('*');
		$this->db->where('provinsi_id',$provinsi_id);
		$q = $this->db->get('kab_kota');
		if ($q->num_rows() > 0){
			foreach($q->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}
	
	public function rows_kota($provinsi_id){
		$this->db->select('*');
		$this->db->where('provinsi_id',$provinsi_id);
		$q = $this->db->get('kab_kota');
		return $q->num_rows();
	}
	
	public function get_kota($provinsi_id,$kab_kota_id){
		$this->db->select('*');
		$this->db->where('provinsi_id',$provinsi_id);
		$this->db->where('kab_kota_id',$kab_kota_id);
		return $this->db->get('kab_kota');
	}
	
	public function get_id_provinsi_kota($email){
		$this->db->select('provinsi_id,kab_kota_id');
		$this->db->where('pemilik_email',$email);
		return $this->db->get('pemilik');
	}
	
	public function get_nama_provinsi($provinsi_id){
		$this->db->select('provinsi_nama');
		$this->db->where('provinsi_id',$provinsi_id);
		$query = $this->db->get('provinsi')->result();
		foreach($query as $prov)
			return $prov->provinsi_nama;
	}
	
	public function get_nama_kab_kota($id){
		$this->db->select('kab_kota_nama');
		$this->db->where('kab_kota_id',$id);
		$query = $this->db->get('kab_kota')->result();
		foreach($query as $kota)
			return $kota->kab_kota_nama;
	}
	
	public function all_kota(){
		$this->db->select('kab_kota_id,kab_kota_nama,kab_kota_long,kab_kota_lat');
		$query = $this->db->get('kab_kota');
		return $query;
	}
	
	public function get_long_lat_kota($kab_kota_id){
		$this->db->select('kab_kota_long,kab_kota_lat');
		$this->db->where('kab_kota_id',$kab_kota_id);
		return $this->db->get('kab_kota');
	}
	
	public function provinsi_limit_offset($limit,$offset){
		$this->db->select('*');
		return $this->db->get('provinsi',$limit,$offset);
	}
	
	public function provinsi_hapus($provinsi_id){
		$this->db->where('provinsi_id',$provinsi_id);
		if($this->db->delete('provinsi')){
			return true;
		}else return false;
	}
		
	public function provinsi_tambah(){
		$data = array(
			'provinsi_kode'		=> $this->input->post('provinsi_kode'),
			'provinsi_nama'		=> strtoupper($this->input->post('provinsi_nama'))
		);
		
		if($this->db->insert('provinsi',$data)){
			return true;
		}else return false;
	}

	public function provinsi_ubah(){
		$data = array(
			'provinsi_kode'		=> $this->input->post('provinsi_kode'),
			'provinsi_nama'		=> strtoupper($this->input->post('provinsi_nama'))
		);
		$this->db->where('provinsi_id',$this->input->post('provinsi_id'));
		if($this->db->update('provinsi',$data)){
			return true;
		}else return false;
	}
	
	public function kota_tambah(){
		$data = array(
			'provinsi_id'		=> $this->input->post('provinsi_id'),
			'kab_kota_kode'		=> $this->input->post('kab_kota_kode'),
			'kab_kota_nama'		=> strtoupper($this->input->post('kab_kota_nama')),
			'kab_kota_long'		=> $this->input->post('kab_kota_long'),
			'kab_kota_lat'		=> $this->input->post('kab_kota_lat')
		);
		if($this->db->insert('kab_kota',$data)){
			return true;
		}else return false;
	}
	
	public function kota_hapus($provinsi_id,$kab_kota_id){
		$this->db->where('provinsi_id',$provinsi_id);
		$this->db->where('kab_kota_id',$kab_kota_id);
		if($this->db->delete('kab_kota')){
			return true;
		}else return false;
	}
	
	public function kota_ubah(){
		$data = array(
			'kab_kota_kode'		=> $this->input->post('kab_kota_kode'),
			'kab_kota_nama'		=> strtoupper($this->input->post('kab_kota_nama')),
			'kab_kota_long'		=> $this->input->post('kab_kota_long'),
			'kab_kota_lat'		=> $this->input->post('kab_kota_lat')
		);
		$this->db->where('provinsi_id',$this->input->post('provinsi_id'));
		$this->db->where('kab_kota_id',$this->input->post('kab_kota_id'));
		if($this->db->update('kab_kota',$data)){
			return true;
		}else return false;
	}


}
