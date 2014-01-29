<?php

class Kontrak extends CI_Controller{

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
		if($this->cek_data()){
			$this->load->model('kontrak_m');
			$this->load->model('indekos_m');
			$data['indekos'] = $this->indekos_m->get_all($this->session->userdata('email'));
			$this->load->view('kontrak/lihat',$data);
		}
	}
	
	public function perpanjang(){
		if($this->cek_data()){
			$this->load->model('kontrak_m');
			$this->load->model('indekos_m');
			$this->load->library('form_validation');
			$this->form_validation->set_rules('kamar_id','ID','required|trim');
			$this->form_validation->set_rules('kamar_kontrak_sampai_tanggal','Tanggal','required|trim');
			if($this->form_validation->run()){
				if($this->kontrak_m->perpanjang()){
					echo"<script language=\"javascript\">alert('Perpanjang kontrak berhasil dilakukan.');document.location=\"".base_url()."kontrak/lihat\";</script>";
				}else{
					echo"<script language=\"javascript\">alert('Perpanjang kontrak gagal dilakukan.');document.location=\"".base_url()."kontrak/lihat\";</script>";
				}
			}else{
				echo"<script language=\"javascript\">alert('Tanggal yang Anda masukan tidak valid.');document.location=\"".base_url()."kontrak/lihat\";</script>";
			}
		}
	}
	
	public function tambah(){
		if($this->cek_data()){
			$this->load->model('kontrak_m');
			$this->load->model('indekos_m');
			$this->load->library('form_validation');
			$this->form_validation->set_rules('kamar_id','ID','required|trim');
			$this->form_validation->set_rules('kamar_kontrak_dari_tanggal','Tanggal','required|trim|date');
			$this->form_validation->set_rules('kamar_kontrak_sampai_tanggal','Tanggal','required|trim|date');
			if($this->form_validation->run()){
				if($this->kontrak_m->tambah()){
					echo"<script language=\"javascript\">alert('Kontrak berhasil ditambah.');document.location=\"".base_url()."kontrak/lihat\";</script>";
				}else{
					echo"<script language=\"javascript\">alert('Kontrak gagal ditambah.');document.location=\"".base_url()."indekos/detail/".$this->input->post('indekos_id')."\";</script>";
				}
			}else{
				echo"<script language=\"javascript\">alert('Tanggal yang Anda masukan tidak valid.');document.location=\"".base_url()."indekos/detail/".$this->input->post('indekos_id')."\";</script>";
			}
		}
	}
	
	public function hapus(){
		if($this->cek_data()){
			$kamar_id = $this->uri->segment(3);
			$this->load->model('pemilik_m');
			$this->load->model('kamar_m');
			$this->load->model('kontrak_m');
			$pemilik = $this->pemilik_m->get_pemilik_id($this->session->userdata('email'));
			foreach($pemilik->result() as $pemilik_id);
			$pemilik_id->pemilik_id;
			$kamar = $this->kamar_m->cek_relasi_pemilik_kamar($pemilik_id->pemilik_id,$kamar_id);
			if($kamar->num_rows() == 1){
				if($this->kontrak_m->hapus($kamar_id)){
					echo"<script language=\"javascript\">alert('Kontrak berhasil dihapus.');document.location=\"".base_url()."kontrak/lihat\";</script>";
				}else{
					echo"<script language=\"javascript\">alert('Kontrak gagal dihapus.');document.location=\"".base_url()."kontrak/lihat\";</script>";
				}
			}else{
				echo"<script language=\"javascript\">alert('Kamar tidak ditemukan.');document.location=\"".base_url()."kontrak/lihat\";</script>";
			}
		}
	}

}

