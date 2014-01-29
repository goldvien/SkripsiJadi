<?php

class indekos extends CI_Controller{

	public function index(){
		$this->lihat();
	}
	
	public function cek_data(){
		if($this->session->userdata('is_logged_in')){
			$this->load->model('pemilik_m');
			$this->load->model('daerah_m');
			$pemilik = $this->pemilik_m->cek_data($this->session->userdata('email'));
			if($pemilik->num_rows()==1){
				$data['pribadi'] = $pemilik->result();
				$this->load->view('pemilik/data',$data);
			}else{
				return true;
			}
		}else{
			redirect('login');
		}
	}
	
	public function lihat(){
		//cek login
		if($this->cek_data()){
		//=============
		$this->load->library('pagination');
		$this->load->model('indekos_m');
		$this->load->model('kamar_m');
		$q = $this->indekos_m->get_all($this->session->userdata('email'));
		$config['base_url'] = base_url().'indekos/lihat/';
		$config['total_rows'] = $q->num_rows();
		$config['per_page'] = 10; 
        $this->pagination->initialize($config);
        $data['page'] = $this->pagination->create_links();
		$rows = array();
		$query = $this->indekos_m->get_indekos_limit_offset($config['per_page'],$this->uri->segment(3));
		foreach($query->result() as $row){
			$rows[] = $row;
		}
		$data['pesan'] = "";
		$data['indekos'] = $rows;
		$data['indekos_total'] = $query->num_rows();
		$this->load->view('indekos/lihat',$data);
		}
	}
	
	public function tambah(){
		//cek login
		if($this->cek_data()){
		//=============
		$this->load->model('daerah_m');
		$this->load->model('pemilik_m');
		$id = $this->pemilik_m->get_pemilik_id($this->session->userdata('email'));
		$data['pemilik'] = $id;
		$data['daerah'] = $this->daerah_m->get_id_provinsi_kota($this->session->userdata('email'));
		$this->load->view('indekos/tambah',$data);
		}
	}
	
	public function tambah_proses(){
		//cek login
		if($this->cek_data()){
		//=============
		$this->load->model('daerah_m');
		$this->load->model('indekos_m');
		$this->load->model('pemilik_m');
		$id = $this->pemilik_m->get_pemilik_id($this->session->userdata('email'));
		$data['pemilik'] = $id;
		$data['daerah'] = $this->daerah_m->get_id_provinsi_kota($this->session->userdata('email'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('indekos_nama','Name','required|trim');
		$this->form_validation->set_rules('indekos_untuk','Untuk','required|trim');
		$this->form_validation->set_rules('pemilik_id','Untuk','required|trim');
		$this->form_validation->set_rules('provinsi_id','Provinsi','required|trim');
		$this->form_validation->set_rules('kab_kota_id','Kota','required|trim');
		$this->form_validation->set_rules('indekos_long','Longitude or Latitude','required|trim');
		$this->form_validation->set_rules('indekos_lat','Longitude or Latitude','required|trim');
		$this->form_validation->set_rules('indekos_keterangan','Keterangan','required|trim');
		
		if($this->form_validation->run()){
			if($this->input->post('submit')=='SIMPAN'){
				if($this->indekos_m->tambah_indekos()){
					$data['pesan'] = "<div class=\"alert alert-success\">Data berhasil ditambah.</div>";
				}else{
					$data['pesan'] = "<div class=\"alert alert-error\">Data gagal ditambah.</div>";
				}
				redirect("indekos/lihat");
			}else{
				redirect('indekos/lihat');
			}
		}else{
			$data['pesan'] = "<div class=\"alert alert-error\">Data gagal ditambah.</div>";
			$this->load->view('indekos/tambah',$data);
		}
		}
	}
	

	public function detail($id){
		//cek login
		if($this->cek_data()){
		//=============
		$kmr = array();$rows = array();
		$this->load->model('indekos_m');
		$query = $this->indekos_m->detail_indekos($id,$this->session->userdata('email'));
		foreach($query->result() as $row){
			$rows[] = $row;
		}
		if($query->num_rows()>0){
			$data['pesan'] = '';
			$data['psn'] = '';
		}else{
			$data['pesan'] = "<div class=\"alert alert-error\">Data yang Anda cari tidak ditemukan.</div>";
		}
		$kamar = $this->indekos_m->get_kamar($id);
		
		foreach($kamar->result() as $k){
			$kmr[] = $k;
		}
		$data['kamar']	= $kmr;
		$data['detail'] = $rows;
		$this->load->view('indekos/detail',$data);
		}
	}
	
	public function indekos_peta(){
		if($this->cek_data()){
		$this->load->library('googlemaps');
		$this->load->model('pemilik_m');
		$long_lat = $this->pemilik_m->get_long_lat_kota_pemilik($this->session->userdata('email'))->result();
		$long = $this->uri->segment(3);
		$lat = $this->uri->segment(4);
		$data['peta'] = $long_lat;
		$config['center'] ="$lat,$long";
		$marker = array();
		$marker['position'] ="$lat,$long";
		$marker['draggable'] = true;
		$marker['ondragend'] = 'long_lat(event.latLng.lng(),event.latLng.lat())';
		$this->googlemaps->add_marker($marker);
		//$config['zoom'] = 'auto';
		$config['trafficOverlay'] = TRUE;
		//$config['ondblclick'] = 'long_lat(event.latLng.lng(),event.latLng.lat())';
		$this->googlemaps->initialize($config);
		$data['map'] = $this->googlemaps->create_map();
		$this->load->view('indekos/peta',$data);
		}
	}
	
	public function ubah_indekos_peta(){
		if($this->cek_data()){
		$id =  $this->uri->segment(3);
		$this->load->library('googlemaps');
		$this->load->model('indekos_m');
		$long_lat = $this->indekos_m->get_long_lat_indekos($this->session->userdata('email'),$id)->result();
		foreach($long_lat as $ll) $peta = $ll;
		$data['peta'] = $long_lat;
		$config['center'] ="$peta->indekos_lat, $peta->indekos_long";
		$marker = array();
		$marker['position'] ="$peta->indekos_lat, $peta->indekos_long";
		$marker['draggable'] = true;
		$marker['ondragend'] = 'long_lat(event.latLng.lng(),event.latLng.lat())';
		$this->googlemaps->add_marker($marker);
		//$config['zoom'] = 'auto';
		$config['trafficOverlay'] = TRUE;
		//$config['ondblclick'] = 'long_lat(event.latLng.lng(),event.latLng.lat())';
		$this->googlemaps->initialize($config);
		$data['map'] = $this->googlemaps->create_map();
		$this->load->view('indekos/peta',$data);
		}
	}
	
	public function ubah_data(){
		if($this->cek_data()){
			$kmr = array();$rows = array();
			$this->load->model('indekos_m');
			$this->load->model('pemilik_m');
			$this->load->library('form_validation');
			$this->form_validation->set_rules('provinsi_id','Provinsi','required|trim');
			$this->form_validation->set_rules('kab_kota_id','Kota','required|trim');
			$this->form_validation->set_rules('indekos_id','ID','required|trim');
			$this->form_validation->set_rules('indekos_nama','Nama','required|trim');
			$this->form_validation->set_rules('indekos_untuk','Untuk','required|trim');
			$this->form_validation->set_rules('indekos_keterangan','Keterangan','required|trim');
			
			if($this->form_validation->run()){
				$id = $this->pemilik_m->get_pemilik_id($this->session->userdata('email'));
				foreach($id->result() as $pemilik_id);
				if($this->indekos_m->ubah_indekos($pemilik_id->pemilik_id)){
					$data['psn'] = "<div class=\"alert alert-success\">Data berhasil diubah.</div>";
				}else{
					$data['psn'] = "<div class=\"alert alert-error\">Data gagal diubah.</div>";
				}
				$query = $this->indekos_m->detail_indekos($this->input->post('indekos_id'),$this->session->userdata('email'));
				foreach($query->result() as $row){$rows[] = $row;}
				if($query->num_rows()>0){$data['pesan'] = '';
				}else{$data['pesan'] = "<div class=\"alert alert-error\">Data yang Anda cari tidak ditemukan.</div>";}
				$kamar = $this->indekos_m->get_kamar($this->input->post('indekos_id'));
				
				foreach($kamar->result() as $k){
					$kmr[] = $k;
				}
				$data['kamar']	= $kmr;
				$data['detail'] = $rows;
				$this->load->view('indekos/detail',$data);
			}else{
				$query = $this->indekos_m->detail_indekos($this->input->post('indekos_id'),$this->session->userdata('email'));
				foreach($query->result() as $row){$rows[] = $row;}
				if($query->num_rows()>0){$data['pesan'] = ''; $data['psn'] = '';
				}else{$data['pesan'] = "<div class=\"alert alert-error\">Data yang Anda cari tidak ditemukan.</div>";}
				$kamar = $this->indekos_m->get_kamar($this->input->post('indekos_id'));
				
				foreach($kamar->result() as $k){
					$kmr[] = $k;
				}
				$data['kamar']	= $kmr;
				$data['detail'] = $rows;
				$this->load->view('indekos/detail',$data);
			}
		}
	}
	
	public function hapus(){
		if($this->cek_data()){
			$indekos_id = $this->uri->segment(3);
			$this->load->model('indekos_m');
			$kontrak = $this->indekos_m->cek_kontrak_seluruh_kamar($indekos_id);
			if($kontrak->num_rows()==0){
				if($this->indekos_m->hapus_indekos($indekos_id)){
					echo "<script language=\"javascript\">alert('Indekos berhasil dihapus.');document.location=\"".base_url()."indekos/lihat\";</script>";
				}else{
					echo "<script language=\"javascript\">alert('Indekos gagal dihapus.');document.location=\"".base_url()."indekos/lihat\";</script>";
				}
			}else{
				echo "<script language=\"javascript\">alert('Masih ada kamar yang dikontrakkan.');document.location=\"".base_url()."indekos/lihat\";</script>";
			}
		}
	}
	
}

