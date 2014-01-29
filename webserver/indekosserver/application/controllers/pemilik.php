<?php

class Pemilik extends CI_Controller{

	public function index(){
		$this->home();
	}

	public function home(){
		if($this->cek_data()){
			$this->load->view('pemilik/home');
		}
	}
	
	public function cek_data(){
		if($this->session->userdata('is_logged_in')){
			$this->load->model('pemilik_m');
			$this->load->model('daerah_m');
			$pemilik = $this->pemilik_m->cek_data($this->session->userdata('email'));
			if($pemilik->num_rows()==1){
				//$this->daerah_m->kota($this->session->userdata());
				$data['pribadi'] = $pemilik->result();
				$this->load->view('pemilik/data',$data);
			}else{
				return true;
			}
		}else{
			redirect('login');
		}
	}
	
	public function restricted(){
		$this->load->view('login');
	}
	
	public function logout(){
		$this->session->sess_destroy();
		redirect('login/index');
	}
	
	public function peta_rumah(){
		$this->load->library('googlemaps');
		$this->load->model('pemilik_m');
		$long_lat = $this->pemilik_m->get_long_lat_rumah($this->session->userdata('email'));
		//belum selesai mau ambil data kota dari pemilik, buat jadi center peta
		foreach($long_lat->result() as $ll);
		$config['center'] = "$ll->pemilik_rumah_lat, $ll->pemilik_rumah_long";
		//$peta = $ll;
		//echo $peta->kab_kota_long;
		$marker = array();
		$marker['position'] ="$ll->pemilik_rumah_lat, $ll->pemilik_rumah_long";
		$marker['draggable'] = true;
		$marker['ondragend'] = 'long_lat(event.latLng.lng(),event.latLng.lat())';
		$this->googlemaps->add_marker($marker);
		$data['peta'] = $long_lat;
		//$config['zoom'] = 'auto';
		$config['trafficOverlay'] = TRUE;
		//$config['ondblclick'] = 'long_lat(event.latLng.lng(),event.latLng.lat())';
		$this->googlemaps->initialize($config);
		$data['map'] = $this->googlemaps->create_map();
		$this->load->view('pemilik/peta_rumah',$data);
	}
	
	public function peta_rumah_long_lat_kota(){
		$this->load->library('googlemaps');
		$this->load->model('pemilik_m');
		$long_lat = $this->pemilik_m->get_long_lat_rumah($this->session->userdata('email'));
		foreach($long_lat->result() as $ll){
		//$config['center'] = "$ll->pemilik_rumah_long, $ll->pemilik_rumah_lat";
		}
		$config['center'] = "-7.812534564621957, 110.36539077758789";//}
		$data['peta'] = $long_lat;
		$marker = array();
		$marker['position'] = "-7.812534564621957, 110.36539077758789";
		$marker['draggable'] = true;
		$marker['ondragend'] = 'long_lat(event.latLng.lng(),event.latLng.lat())';
		$this->googlemaps->add_marker($marker);
		//$config['zoom'] = 'auto';
		$config['trafficOverlay'] = TRUE;
		//$config['ondblclick'] = 'long_lat(event.latLng.lng(),event.latLng.lat())';
		$this->googlemaps->initialize($config);
		$data['map'] = $this->googlemaps->create_map();
		$this->load->view('pemilik/peta_rumah',$data);
	}
	
	public function update_data(){
		$this->load->library('form_validation');
		$this->load->model('pemilik_m');
		$this->load->model('daerah_m');
		$this->form_validation->set_rules('pemilik_id','ID','required|trim');
		$this->form_validation->set_rules('pemilik_nama','Nama','required|trim');
		$this->form_validation->set_rules('pemilik_email','Email','required|trim');
		$this->form_validation->set_rules('provinsi_id','Provinsi','required|trim');
		$this->form_validation->set_rules('kab_kota_id','Kota','required|trim');
		$this->form_validation->set_rules('pemilik_no_hp','No Hp','required|trim|numeric');
		$this->form_validation->set_rules('pemilik_alamat','Alamat','required|trim');
		$this->form_validation->set_rules('pemilik_rumah_long','Longitude or Latitude','required|trim');
		$this->form_validation->set_rules('pemilik_rumah_lat','Longitude or Latitude','required|trim');
		if($this->form_validation->run()){
			if($this->pemilik_m->update_pribadi_pertama()){
				$pribadi['pesan'] = "<div class=\"alert alert-success\">Data berhasil diubah</div>";
			}else{
				$pribadi['pesan'] = "<div class=\"alert alert-error\">Gagal ubah data pribadi</div>";
			}
			$pemilik = $this->pemilik_m->data_pribadi($this->session->userdata('email'));
			$pribadi['pribadi'] = $pemilik->result();
			$this->load->view('pemilik/pribadi',$pribadi);
		}else{
			$this->cek_data();
		}
	}
	
	public function pribadi(){
		if($this->cek_data()){
			$this->load->model('pemilik_m');
			$pemilik = $this->pemilik_m->data_pribadi($this->session->userdata('email'));
			$data['pribadi'] = $pemilik->result();
			$data['pesan'] = "";
			$this->load->view('pemilik/pribadi',$data);
		}
	}
	
	public function update(){
		if($this->cek_data()){
			$this->load->library('form_validation');
			$this->load->model('pemilik_m');
			$this->load->model('daerah_m');
			$this->form_validation->set_rules('pemilik_id','ID','required|trim');
			$this->form_validation->set_rules('pemilik_nama','Nama','required|trim');
			$this->form_validation->set_rules('pemilik_email','Email','required|trim');
			$this->form_validation->set_rules('pemilik_no_hp','No Hp','required|trim|numeric');
			$this->form_validation->set_rules('pemilik_alamat','Alamat','required|trim');
			$this->form_validation->set_rules('pemilik_rumah_long','Longitude or Latitude','required|trim');
			$this->form_validation->set_rules('pemilik_rumah_lat','Longitude or Latitude','required|trim');
			$pribadi['pesan']='';
			if($this->form_validation->run()){
				if($this->pemilik_m->update_pribadi()){
					$pribadi['pesan'] = "<div class=\"alert alert-success\">Data berhasil diubah</div>";
				}else{
					$pribadi['pesan'] = "<div class=\"alert alert-error\">Gagal ubah data pribadi</div>";
				}
			}else{
				$pribadi['pesan'] = "<div class=\"alert alert-error\">Gagal ubah data pribadi</div>";
			}
			$pemilik = $this->pemilik_m->data_pribadi($this->session->userdata('email'));
			$pribadi['pribadi'] = $pemilik->result();
			$this->load->view('pemilik/pribadi',$pribadi);
		}
	}
	
	public function password(){
		if($this->cek_data()){
			$this->load->model('pemilik_m');
			$query = $this->pemilik_m->get_pemilik_id($this->session->userdata('email'));
			$data['pemilik'] = $query;
			$data['pesan'] ='';
			$this->load->view('pemilik/ubah_password',$data);
		}
	}
	
	public function ubah_password(){
		if($this->cek_data()){
			$this->load->model('pemilik_m');
			$this->load->library('form_validation');
			$this->form_validation->set_rules('pemilik_id','ID','required|trim');
			$this->form_validation->set_rules('pemilik_email','Email','required|trim');
			$this->form_validation->set_rules('pemilik_password_lama','Pasword Lama','required|trim');
			$this->form_validation->set_rules('pemilik_password_baru','Pasword Baru','required|trim');
			$this->form_validation->set_rules('pemilik_password_conf','Pasword Konfirmasi','required|trim|matches[pemilik_password_baru]');
			if($this->form_validation->run()){
				if($this->pemilik_m->cek_password()){
					if($this->pemilik_m->ubah_password()){
						$data['pesan'] = "<div class=\"alert alert-success\">Ubah Password berhasil dilakukan</div>";
					}else{
						$data['pesan'] = "<div class=\"alert alert-error\">Gagal ubah Password</div>";
					}
				}else{
					$data['pesan'] = "<div class=\"alert alert-error\">Password yang Anda masukan salah</div>";
				}
				$query = $this->pemilik_m->get_pemilik_id($this->session->userdata('email'));
				$data['pemilik'] = $query;
				$this->load->view('pemilik/ubah_password',$data);
			}else{
				$query = $this->pemilik_m->get_pemilik_id($this->session->userdata('email'));
				$data['pemilik'] = $query;
				$data['pesan'] ='';
				$this->load->view('pemilik/ubah_password',$data);
			}
		}
	}
	
	public function confirm(){
			$key = $this->uri->segment(3);
			$this->load->model('pemilik_m');
			$data = $this->pemilik_m->confirm($key);
			if($data->num_rows()==1){
				$this->pemilik_m->pemilik_aktif($key);
				//$this->load->view('akunaktif');
				echo"<script language=\"javascript\">alert('Akun Anda sudah aktif. Silahkan login kesistem.');document.location=\"".base_url()."\";</script>";
			}else{
				//$this->load->view('key');
				echo"<script language=\"javascript\">alert('Kode yang Anda masukan tidak ditemukan.');document.location=\"".base_url()."\";</script>";
			}
	}
	
	public function recovery_password(){
		$key = $this->uri->segment(3);
		$this->load->model('pemilik_m');
		$data = $this->pemilik_m->password_key($key);
		if($data->num_rows()==1){
			foreach($data->result() as $email){
				$this->pemilik_m->recovery($email->pemilik_email,$key);
				//$this->load->view('password');
				echo"<script language=\"javascript\">alert('Password Anda sudah dipulihkan, dan diubah dengan email Anda.');document.location=\"".base_url()."\";</script>";
			}
		}else{
			//$this->load->view('key');
			echo"<script language=\"javascript\">alert('Kode yang Anda masukan tidak ditemukan.');document.location=\"".base_url()."\";</script>";
		}
	}
	
}

