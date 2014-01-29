<?php

class Fasilitas_m extends CI_Model{

	public function master(){
		$this->db->select('*');
		return $this->db->get('fasilitas_master');
	}
	
	public function master_limit_offset($limit,$offset){
		$this->db->select('*');
		return $this->db->get('fasilitas_master',$limit,$offset);
	}
	
	public function get_fasilitas_master($fasilitas_master_id){
		$this->db->select('*');
		$this->db->where('fasilitas_master_id',$fasilitas_master_id);
		return $this->db->get('fasilitas_master');
	}
	
	public function fasilitas_master_ubah_nama(){
		$data = array(
			'fasilitas_master_nama'		=> $this->input->post('fasilitas_master_nama')
		);
		$this->db->where('fasilitas_master_id',$this->input->post('fasilitas_master_id'));
		if($this->db->update('fasilitas_master',$data)){
			return true;
		}else return false;
	}
	
	public function fasilitas_master_ubah_nama_icon($fasilitas_master_icon,$fasilitas_master_nama){
		$data = array(
			'fasilitas_master_nama'	=> strtoupper($fasilitas_master_nama),
			'fasilitas_master_icon'	=> $fasilitas_master_icon
		);
		$this->db->where('fasilitas_master_id',$this->input->post('fasilitas_master_id'));
		if($this->db->update('fasilitas_master',$data)){
			return true;
		}else return false;
	}
	
	public function get_eksternal($kab_kota_id,$fasilitas_eks_id){
		$this->db->select('*');
		$this->db->where('fasilitas_eks.kab_kota_id',$kab_kota_id);
		$this->db->where('fasilitas_eks.fasilitas_eks_id',$fasilitas_eks_id);
		return $this->db->get('fasilitas_eks');
	}
	
	public function get_fasilitas_eksternal($kab_kota_id,$fasilitas_master_id){
		$this->db->select('*');
		$this->db->join('kab_kota','kab_kota.kab_kota_id=fasilitas_eks.kab_kota_id');
		$this->db->where('kab_kota.kab_kota_id',$kab_kota_id);
		$this->db->where('fasilitas_eks.fasilitas_master_id',$fasilitas_master_id);
		$this->db->order_by('fasilitas_eks_nama');
		return $this->db->get('fasilitas_eks');
	}
	
	public function fasilitas_master_hapus($fasilitas_master_id){
		$this->db->where('fasilitas_master_id',$fasilitas_master_id);
		if($this->db->delete('fasilitas_master')){
			return true;
		}else return false;
	}
	
	public function eksternal($pemilik_email,$fasilitas_master_id){
		$this->db->select('*');
		$this->db->join('kab_kota','kab_kota.kab_kota_id=fasilitas_eks.kab_kota_id');
		$this->db->join('pemilik','pemilik.kab_kota_id=kab_kota.kab_kota_id');
		$this->db->where('pemilik.pemilik_email',$pemilik_email);
		$this->db->where('fasilitas_eks.fasilitas_master_id',$fasilitas_master_id);
		return $this->db->get('fasilitas_eks');
	}
	
	public function fasilitas_master_tambah($fasilitas_master_icon,$fasilitas_master_nama){
		$data = array(
			'fasilitas_master_nama'	=> strtoupper($fasilitas_master_nama),
			'fasilitas_master_icon'	=> $fasilitas_master_icon
		);
		if($this->db->insert('fasilitas_master',$data)){
			return true;
		}else return false;
	}
	
	public function fasilitas_eksternal_tambah(){
		$data = array(
			'fasilitas_master_id'	=> $this->input->post('fasilitas_master_id'),
			'kab_kota_id'			=> $this->input->post('kab_kota_id'),
			'fasilitas_eks_nama'	=> $this->input->post('fasilitas_eks_nama'),
			'fasilitas_eks_long'	=> $this->input->post('fasilitas_eks_long'),
			'fasilitas_eks_lat'		=> $this->input->post('fasilitas_eks_lat')
		);
		if($this->db->insert('fasilitas_eks',$data)){
			return true;
		}else return false;
	}
	
	public function fasilitas_eksternal_hapus($fasilitas_eks_id){
		$this->db->where('fasilitas_eks_id',$fasilitas_eks_id);
		if($this->db->delete('fasilitas_eks')){
			return true;
		}else return false;
	}
	
	public function fasilitas_eksternal_ubah(){
		$data = array(
			'fasilitas_master_id'	=> $this->input->post('fasilitas_master_id'),
			'kab_kota_id'			=> $this->input->post('kab_kota_id'),
			'fasilitas_eks_nama'	=> $this->input->post('fasilitas_eks_nama'),
			'fasilitas_eks_long'	=> $this->input->post('fasilitas_eks_long'),
			'fasilitas_eks_lat'		=> $this->input->post('fasilitas_eks_lat')
		);
		$this->db->where('fasilitas_eks_id',$this->input->post('fasilitas_eks_id'));
		if($this->db->update('fasilitas_eks',$data)){
			return true;
		}else return false;
	}
	
	public function eksternal_tambah($indekos_id,$array_fasilitas_eks_id){
		while(list($key,$value)=each($array_fasilitas_eks_id)){
			//$this->db->select('fasilitas_eks.fasilitas_eks_id, indekos.indekos_id,( 6371 * acos( cos( radians(37) ) * cos( radians( indekos.indekos_lat) ) * cos( radians( indekos.indekos_long) - radians(fasilitas_eks.fasilitas_eks_long) ) + sin( radians(fasilitas_eks.fasilitas_eks_lat) ) * sin( radians( indekos.indekos_lat) ) ) ) AS jarak ');
			//$this->db->where('fasilitas_eks.fasilia');
			$jarak = $this->db->query("SELECT (
						(
							(acos
								(sin
									((indekos.indekos_lat*pi()/180)) * 
									sin((fasilitas_eks.fasilitas_eks_lat*pi()/180))+
									cos((indekos.indekos_lat*pi()/180)) * 
									cos((fasilitas_eks.fasilitas_eks_lat*pi()/180)) * 
									cos(((indekos.indekos_long - fasilitas_eks.fasilitas_eks_long)* pi()/180))
								)
							)*180/pi()
						)*60*1.1515
					) as jarak
			FROM fasilitas_eks,indekos WHERE fasilitas_eks.fasilitas_eks_id=$key AND indekos.indekos_id=$indekos_id
			");
			foreach($jarak->result() as $datajarak);
			
			$data = array(
				'indekos_id'					=> $indekos_id,
				'fasilitas_eks_id'				=> $key,
				'indekos_fasilitas_eks_jarak'	=> $datajarak->jarak
			);
			$this->db->select('*');
			$this->db->where('indekos_id',$indekos_id);
			$this->db->where('fasilitas_eks_id',$key);
			if($this->db->get('indekos_fasilitas_eks')->num_rows()==0){
				$this->db->insert('indekos_fasilitas_eks',$data);
			}else{
				$this->db->where('indekos_id',$indekos_id);
				$this->db->where('fasilitas_eks_id',$key);
				$this->db->update('indekos_fasilitas_eks',$data);
			}
		}
	}
	
	public function eksternal_hapus($pemilik_email,$indekos_id,$fasilitas_eks_id){
		$this->db->select('*');
		$this->db->join('indekos','indekos.indekos_id=indekos_fasilitas_eks.indekos_id');
		$this->db->join('pemilik','pemilik.pemilik_id=indekos.pemilik_id');
		$this->db->join('fasilitas_eks','fasilitas_eks.fasilitas_eks_id=indekos_fasilitas_eks.fasilitas_eks_id');
		$this->db->where('pemilik.pemilik_email',$pemilik_email);
		$this->db->where('indekos.indekos_id',$indekos_id);
		$this->db->where('fasilitas_eks.fasilitas_eks_id',$fasilitas_eks_id);
		if($this->db->get('indekos_fasilitas_eks')->num_rows()==1){
			$this->db->where('indekos_fasilitas_eks.indekos_id',$indekos_id);
			$this->db->where('indekos_fasilitas_eks.fasilitas_eks_id',$fasilitas_eks_id);
			$this->db->delete('indekos_fasilitas_eks');
			return true;
		}else return false;
	}
	
	public function internal_tambah(){
		$data = array(
			'pemilik_id'		=> $this->input->post('pemilik_id'),
			'fasilitas_int_nama'=> $this->input->post('fasilitas_int_nama'),
		);
		if($this->db->insert('fasilitas_int',$data)){
			return true;
		}else return false;
	}
	
	public function cek_kamar_fasilitas($fasilitas_int_id,$kamar_id){
		$this->db->select('*');
		$this->db->where('fasilitas_int_id',$fasilitas_int_id);
		$this->db->where('kamar_id',$kamar_id);
		return $this->db->get('kamar_fasilitas_int');
	}
	
	public function kamar_internal_tambah($kamar_id,$array_fasilitas_int_id){
		if(is_array($array_fasilitas_int_id)){
			while(list($key,$value)=each($array_fasilitas_int_id)){
				$data = array(
					'kamar_id'	=> $kamar_id,
					'fasilitas_int_id'	=> $key,
				);
				if($this->cek_kamar_fasilitas($key,$kamar_id)->num_rows()==0){
					$this->db->insert('kamar_fasilitas_int',$data);
				}
			}
		}
	}
	
	public function daftar_fasilitas_internal($pemilik_email){
		$this->db->select('*');
		$this->db->join('fasilitas_int','fasilitas_int.pemilik_id=pemilik.pemilik_id');
		$this->db->where('pemilik.pemilik_email',$pemilik_email);
		return $this->db->get('pemilik');
	}
	
	public function get_fasilitas_kamar($kamar_id){
		$this->db->select('*');
		$this->db->join('fasilitas_int','fasilitas_int.fasilitas_int_id=kamar_fasilitas_int.fasilitas_int_id');
		$this->db->where('kamar_id',$kamar_id);
		return $this->db->get('kamar_fasilitas_int');
	}
	
	public function internal_hapus($kamar_fasilitas_int_id){
		$this->db->where('kamar_fasilitas_int_id',$kamar_fasilitas_int_id);
		if($this->db->delete('kamar_fasilitas_int')){
			return true;
		}else return false;
	}

	public function tambahint(){
		$data = array(
			'pemilik_id'			=> $this->input->post('pemilik_id'),
			'fasilitas_int_nama'	=> $this->input->post('fasilitas_int_nama')
		);
		if($this->db->insert('fasilitas_int',$data)){
			return true;
		}else{
			return false;
		}
	}
	
	public function ubahint(){
		$data = array(
			'fasilitas_int_nama'	=> $this->input->post('fasilitas_int_nama')
		);
		$this->db->where('fasilitas_int_id',$this->input->post('fasilitas_int_id'));
		if($this->db->update('fasilitas_int',$data)){
			return true;
		}else{
			return false;
		}
	}
	
	public function hapusint(){
		$this->db->where('fasilitas_int_id',$this->uri->segment(3));
		if($this->db->delete('fasilitas_int')){
			return true;
		}else return false;
	}
	
	public function pemilik_internal($fasilitas_int,$pemilik_email){
		$this->db->select('*');
		$this->db->join('fasilitas_int','fasilitas_int.pemilik_id=pemilik.pemilik_id');
		$this->db->where('fasilitas_int.fasilitas_int_id',$fasilitas_int);
		$this->db->where('pemilik.pemilik_email',$pemilik_email);
		return $this->db->get('pemilik');
	}
	
}

