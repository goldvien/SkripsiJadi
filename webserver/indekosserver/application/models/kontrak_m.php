<?php

class Kontrak_M extends CI_Model{

	public function get_all($indekos_id){
		$this->db->select('*');
		$this->db->where('indekos_id',$indekos_id);
		$this->db->where('kamar_kontrak_status','kontrak');
		return $this->db->get('kamar');
	}
	
	public function cek_all($indekos_id){
		$date = date('Y-m-d');
		$this->db->select('*');
		$this->db->where('indekos_id',$indekos_id);
		$this->db->where('kamar_kontrak_sampai_tanggal <',$date);
		$kontrak = $this->db->get('kamar');
		foreach($kontrak->result() as $data){
			$dt = array(
				'kamar_kontrak_status'			=> 'kosong',
				'kamar_kontrak_dari_tanggal'	=> '0000-00-00',
				'kamar_kontrak_sampai_tanggal'	=> '0000-00-00'
			);
			$this->db->where('kamar_id',$data->kamar_id);
			$this->db->update('kamar',$dt);
		}
	}
	
	public function perpanjang(){
		$data = array(
			'kamar_kontrak_status'			=> 'kontrak',
			'kamar_kontrak_sampai_tanggal'	=> $this->input->post('kamar_kontrak_sampai_tanggal')
		);
		$this->db->where('kamar_id',$this->input->post('kamar_id'));
		if($this->db->update('kamar',$data)){
			return true;
		}else return false;
	}
	
	public function tambah(){
		$data = array(
			'kamar_kontrak_status'			=> 'kontrak',
			'kamar_kontrak_dari_tanggal'	=> $this->input->post('kamar_kontrak_dari_tanggal'),
			'kamar_kontrak_sampai_tanggal'	=> $this->input->post('kamar_kontrak_sampai_tanggal')
		);
		$this->db->where('kamar_id',$this->input->post('kamar_id'));
		if($this->db->update('kamar',$data)){
			return true;
		}else return false;
	}
	
	public function hapus($kamar_id){
		$data = array(
			'kamar_kontrak_status'			=> 'kosong',
			'kamar_kontrak_dari_tanggal'	=> '0000-00-00',
			'kamar_kontrak_sampai_tanggal'	=> '0000-00-00'
		);
		$this->db->where('kamar_id',$kamar_id);
		if($this->db->update('kamar',$data)){
			return true;
		}else return false;
	}
	
}

