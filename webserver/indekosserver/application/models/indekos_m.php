<?php

class Indekos_M extends CI_Model{

	public function get_all($pemilik_email){
		$this->db->select('*');
		$this->db->from('indekos');
		$this->db->join('pemilik','pemilik.pemilik_id=indekos.pemilik_id');
		$this->db->join('kab_kota','kab_kota.kab_kota_id=indekos.kab_kota_id');
		$this->db->where('pemilik.pemilik_email',$pemilik_email);
		$query = $this->db->get();
		return $query;
	}
	
	public function get_indekos_limit_offset($limit,$offset){
		$this->db->select('*');
		//$this->db->from('indekos');
		$this->db->join('pemilik','pemilik.pemilik_id=indekos.pemilik_id');
		$this->db->join('kab_kota','kab_kota.kab_kota_id=indekos.kab_kota_id');
		$this->db->where('pemilik.pemilik_email',$this->session->userdata('email'));
		$query = $this->db->get('indekos',$limit,$offset);
		return $query;
	}
	
	public function detail_indekos($id,$email){
		$this->db->select('*');
		$this->db->join('pemilik','pemilik.pemilik_id=indekos.pemilik_id');
		$this->db->where('pemilik_email',$email);
		$this->db->where('indekos_id',$id);
		return $this->db->get('indekos');
		
	}

	public function get_kamar($id){
		return $this->db->get_where('kamar',array('indekos_id'=>$id));
	}
	
	public function tambah_indekos(){
		$long = $this->input->post('indekos_long');
		$lat = $this->input->post('indekos_lat');
		$kab_kota_id = $this->input->post('kab_kota_id');
		$jarak = $this->db->query("SELECT (
						(
							(acos
								(sin
									((kab_kota_lat*pi()/180)) * 
									sin(($lat*pi()/180))+
									cos((kab_kota_lat*pi()/180)) * 
									cos(($lat*pi()/180)) * 
									cos(((kab_kota_long - $long)* pi()/180))
								)
							)*180/pi()
						)*60*1.1515
					) as jarak
			FROM kab_kota WHERE kab_kota_id=$kab_kota_id");
			foreach($jarak->result() as $datajarak);
			
		$data = array(	
			'pemilik_id'			=> $this->input->post('pemilik_id'),	
			'kab_kota_id'			=> $this->input->post('kab_kota_id'),	
			'indekos_nama'			=> $this->input->post('indekos_nama'),	
			'indekos_untuk'			=> $this->input->post('indekos_untuk'),	
			'indekos_keterangan'	=> $this->input->post('indekos_keterangan'),	
			'indekos_long'			=> $this->input->post('indekos_long'),	
			'indekos_lat'			=> $this->input->post('indekos_lat'),
			'indekos_kab_kota_jarak'=> $datajarak->jarak
		);
		if($this->db->insert('indekos',$data)){
			return true;
		}else return false;
	}
	
	public function get_long_lat_indekos($email,$id){
		$this->db->select('*');
		$this->db->join('pemilik','pemilik.pemilik_id=indekos.pemilik_id');
		$this->db->where('pemilik_email',$email);
		$this->db->where('indekos_id',$id);
		return $this->db->get('indekos');
	}
	
	public function ubah_indekos($id){
		$long = $this->input->post('indekos_long');
		$lat = $this->input->post('indekos_lat');
		$kab_kota_id = $this->input->post('kab_kota_id');
		$jarak = $this->db->query("SELECT (
						(
							(acos
								(sin
									((kab_kota_lat*pi()/180)) * 
									sin(($lat*pi()/180))+
									cos((kab_kota_lat*pi()/180)) * 
									cos(($lat*pi()/180)) * 
									cos(((kab_kota_long - $long)* pi()/180))
								)
							)*180/pi()
						)*60*1.1515
					) as jarak
			FROM kab_kota WHERE kab_kota_id=$kab_kota_id");
			foreach($jarak->result() as $datajarak);
			
		$data = array(	
			'indekos_nama'			=> $this->input->post('indekos_nama'),	
			'indekos_untuk'			=> $this->input->post('indekos_untuk'),	
			'indekos_keterangan'	=> $this->input->post('indekos_keterangan'),	
			'indekos_long'			=> $this->input->post('indekos_long'),	
			'indekos_lat'			=> $this->input->post('indekos_lat'),	
			'indekos_kab_kota_jarak'=> $datajarak->jarak
		);
		$this->db->where('pemilik_id',$id);
		$this->db->where('indekos_id',$this->input->post('indekos_id'));
		if($this->db->update('indekos',$data)){
			return true;
		}else return false;
	}
	
	public function get_nama_indekos($id){
		$this->db->select('indekos_nama');
		$this->db->where('indekos_id',$id);
		$query = $this->db->get('indekos');
		foreach($query->result() as $data);
		return $data->indekos_nama;
	}
	
	public function cek_kontrak_seluruh_kamar($indekos_id){
		$this->db->select('*');
		$this->db->join('kamar','kamar.indekos_id=indekos.indekos_id');
		$this->db->where('indekos.indekos_id',$indekos_id);
		$this->db->where('kamar.kamar_kontrak_status !=','kosong');
		return $this->db->get('indekos');
	}
	
	public function hapus_indekos($indekos_id){
		$this->db->select('*');
		$this->db->where('indekos_id',$indekos_id);
		$kamar = $this->db->get('kamar');
		foreach($kamar->result() as $data){
			if(file_exists(APPPATH.'../assets/images/'.$data->kamar_foto)){ unlink(APPPATH.'../assets/images/'.$data->kamar_foto); }
			if(file_exists(APPPATH.'../assets/images/96/'.$data->kamar_foto)){ unlink(APPPATH.'../assets/images/96/'.$data->kamar_foto); }
		}
		$this->db->delete('kamar',array('indekos_id'=>$indekos_id));
		if($this->db->delete('indekos',array('indekos_id'=>$indekos_id))){
			return true;
		}else return false;
	}
	
	public function indekos_fasilitas_eks($indekos_id){
		$this->db->select('*');
		$this->db->join('fasilitas_eks','fasilitas_eks.fasilitas_eks_id=indekos_fasilitas_eks.fasilitas_eks_id');
		$this->db->join('fasilitas_master','fasilitas_master.fasilitas_master_id=fasilitas_eks.fasilitas_master_id');
		$this->db->join('indekos','indekos.indekos_id=indekos_fasilitas_eks.indekos_id');
		$this->db->order_by("fasilitas_master.fasilitas_master_id", "asc"); 
		$this->db->where('indekos.indekos_id',$indekos_id);
		return $this->db->get('indekos_fasilitas_eks');
	}
	
	public function cek_fasilitas_eks($indekos_id,$fasilitas_eks_id){
		$this->db->select('*');
		$this->db->where('indekos_id',$indekos_id);
		$this->db->where('fasilitas_eks_id',$fasilitas_eks_id);
		if($this->db->get('indekos_fasilitas_eks')->num_rows()==1){
			return true;
		}else return false;
	}
	
}

