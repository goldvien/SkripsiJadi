<?php

class Kamar_M extends CI_Model{

	

	public function get_total_kamar($indekos_id){
		$this->db->select('*');
		$this->db->join('indekos','kamar.indekos_id=indekos.indekos_id');
		$this->db->where('kamar.indekos_id',$indekos_id);
		return $row = $this->db->get('kamar')->num_rows();
		
	}
	
	public function tambah_kamar($foto){
		$data = array(
			'indekos_id'					=> $this->input->post('indekos_id'),
			'kamar_nama'					=> $this->input->post('kamar_nama'),
			'kamar_harga'					=> $this->input->post('kamar_harga'),
			'kamar_isi'						=> $this->input->post('kamar_isi'),
			'kamar_ukuran_panjang'			=> $this->input->post('kamar_ukuran_panjang'),
			'kamar_ukuran_lebar'			=> $this->input->post('kamar_ukuran_lebar'),
			'kamar_ukuran_jenis'			=> $this->input->post('kamar_ukuran_jenis'),
			'kamar_foto'					=> $foto,
			'kamar_minimal_kontrak'			=> $this->input->post('kamar_minimal_kontrak'),
			'kamar_minimal_kontrak_jenis'	=> $this->input->post('kamar_minimal_kontrak_jenis')
		);
		if($this->db->insert('kamar',$data)){
			return true;
		}else return false;
	}
	
	public function ubah_data(){
		$data = array(
			'kamar_nama'					=> $this->input->post('kamar_nama'),
			'kamar_harga'					=> $this->input->post('kamar_harga'),
			'kamar_isi'						=> $this->input->post('kamar_isi'),
			'kamar_ukuran_panjang'			=> $this->input->post('kamar_ukuran_panjang'),
			'kamar_ukuran_lebar'			=> $this->input->post('kamar_ukuran_lebar'),
			'kamar_ukuran_jenis'			=> $this->input->post('kamar_ukuran_jenis'),
			'kamar_minimal_kontrak'			=> $this->input->post('kamar_minimal_kontrak'),
			'kamar_minimal_kontrak_jenis'	=> $this->input->post('kamar_minimal_kontrak_jenis')
		);
		$this->db->where('kamar_id',$this->input->post('kamar_id'));
		if($this->db->update('kamar',$data)){
			return true;
		}else return false;
	}
	
	public function ubah_data_foto($foto){
		$data = array(
			'kamar_nama'					=> $this->input->post('kamar_nama'),
			'kamar_harga'					=> $this->input->post('kamar_harga'),
			'kamar_isi'						=> $this->input->post('kamar_isi'),
			'kamar_ukuran_panjang'			=> $this->input->post('kamar_ukuran_panjang'),
			'kamar_ukuran_lebar'			=> $this->input->post('kamar_ukuran_lebar'),
			'kamar_ukuran_jenis'			=> $this->input->post('kamar_ukuran_jenis'),
			'kamar_minimal_kontrak'			=> $this->input->post('kamar_minimal_kontrak'),
			'kamar_minimal_kontrak_jenis'	=> $this->input->post('kamar_minimal_kontrak_jenis'),
			'kamar_foto'					=> $foto
		);
		$this->db->where('kamar_id',$this->input->post('kamar_id'));
		if($this->db->update('kamar',$data)){
			return true;
		}else return false;
	}
	
	public function get_pemilik_fasilitas_id($pemilik_id){
		$this->db->select('*');
		$this->db->where('pemilik_id',$pemilik_id);
		return $this->db->get('fasilitas_int');
	}
	
	public function get_indekos_id($kamar_id){
		$this->db->select('*');
		$this->db->join('indekos','indekos.indekos_id=kamar.indekos_id');
		$this->db->where('kamar_id',$kamar_id);
		return $this->db->get('kamar');
	}

	public function get_fasilitas_int($kamar_id){
		$this->db->select('*');
		$this->db->where('kamar_id',$kamar_id);
		return $this->db->get('kamar_fasilitas_int');
	}
	
	public function get_data_kamar($kamar_id){
		$this->db->select('*');
		$this->db->join('indekos','indekos.indekos_id=kamar.indekos_id');
		$this->db->where('kamar_id',$kamar_id);
		return $this->db->get('kamar');
	}
	
	public function cek_relasi_pemilik_kamar($pemilik_id, $kamar_id){
		$this->db->select('*');
		$this->db->join('indekos','indekos.indekos_id=kamar.indekos_id');
		$this->db->join('pemilik','pemilik.pemilik_id=indekos.pemilik_id');
		$this->db->where('pemilik.pemilik_id',$pemilik_id);
		$this->db->where('kamar.kamar_id',$kamar_id);
		return $this->db->get('kamar');
	}
	
	public function cek_kontrak($kamar_id){
		$this->db->where('kamar_kontrak_status','kosong');
		$this->db->where('kamar_id',$kamar_id);
		return $this->db->get('kamar');		
	}
	
	public function hapus_kamar($kamar_id){
		$this->db->select('*');
		$this->db->where('kamar_id',$kamar_id);
		$kamar = $this->db->get('kamar');
		foreach($kamar->result() as $data){
			if(file_exists(APPPATH.'../assets/images/'.$data->kamar_foto)){ unlink(APPPATH.'../assets/images/'.$data->kamar_foto); }
			if(file_exists(APPPATH.'../assets/images/96/'.$data->kamar_foto)){ unlink(APPPATH.'../assets/images/96/'.$data->kamar_foto); }
		}
		$this->db->where('kamar_id',$kamar_id);
		if($this->db->delete('kamar')){
			return true;
		}else return false;
	}
	
}

