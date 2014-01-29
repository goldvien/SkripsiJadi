<?php

class Kamar extends CI_Controller{
	
	public function index(){
		redirect('indekos/lihat');
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
	
	public function tambah_kamar(){
		if($this->uri->segment(3)){
			$id = $this->uri->segment(3);
			$this->load->model('indekos_m');
			$query = $this->indekos_m->detail_indekos($id,$this->session->userdata('email'));
			if($query->num_rows()==1){
				$data['indekos'] = $query;
				$data['indekos_id'] = $id;
				$data['indekos_nama'] = $this->indekos_m->get_nama_indekos($id);
				$this->load->view('kamar/tambah',$data);
			}else{
				echo "<script language=\"javascript\">alert('Indekos tidak ditemukan.');document.location=\"".base_url()."indekos/lihat\";</script>";
			}
		}else{
			redirect('indekos/lihat');
		}
	}

	public function tambah(){
		if($this->cek_data()){
			$this->load->library('form_validation');
			$this->load->model('indekos_m');
			$this->load->model('kamar_m');
			$this->form_validation->set_rules('indekos_id','Indekos','required|trim');
			$this->form_validation->set_rules('kamar_nama','Nama','required|trim');
			$this->form_validation->set_rules('kamar_harga','Harga','required|trim|numeric');
			$this->form_validation->set_rules('kamar_isi','Isi','required|trim|numeric');
			$this->form_validation->set_rules('kamar_ukuran_panjang','Panjang','required|trim|numeric|max_length[3]');
			$this->form_validation->set_rules('kamar_ukuran_lebar','Lebar','required|trim|numeric|max_length[3]');
			$this->form_validation->set_rules('kamar_ukuran_jenis','Jenis Ukuran','required|trim');
			$this->form_validation->set_rules('kamar_minimal_kontrak','Kontrak','required|trim');
			$this->form_validation->set_rules('kamar_minimal_kontrak_jenis','Jenis Kontrak','required|trim');
			//$this->form_validation->set_rules('kamar_foto','Foto','required|trim');
			$foto = strtolower(addslashes($_FILES['kamar_foto']['name']));
			if($this->form_validation->run()){
				if($foto==''){
					$query = $this->indekos_m->detail_indekos($this->input->post('indekos_id'),$this->session->userdata('email'));
					$data['indekos'] = $query;
					$data['indekos_id'] = $this->input->post('indekos_id');
					$data['indekos_nama'] = $this->indekos_m->get_nama_indekos($this->input->post('indekos_id'));
					$data['error_foto'] = 'No file selected';
					$this->load->view('kamar/tambah',$data);
				}else{
					$foto = 'kamar_'.$this->input->post('indekos_id').time().'.png';
					if (move_uploaded_file($_FILES['kamar_foto']['tmp_name'],APPPATH."../assets/images/$foto")){
						//echo"isi";
						if($this->kamar_m->tambah_kamar($foto)){
							echo"<script language=\"javascript\">alert('Kamar berhasil ditambah.');document.location=\"".base_url()."indekos/detail/".$this->input->post('indekos_id')."\";</script>";
						}else{
							echo"<script language=\"javascript\">alert('Kamar gagal ditambah.');document.location=\"".base_url()."indekos/detail/".$this->input->post('indekos_id')."\";</script>";
						}
						copy($_FILES['kamar_foto']['tmp_name'],APPPATH."../assets/images/96/$foto");
					}else{
						echo"<script language=\"javascript\">alert('File gagal diupload');document.location=\"".base_url()."kamar/tambah_kamar/".$this->input->post('indekos_id')."\";</script>";
					}
				}
				if($this->kamar_m->tambah_kamar()){
					echo"<script language=\"javascript\">alert('Kamar berhasil ditambah.');document.location=\"".base_url()."indekos/detail/".$this->input->post('indekos_id')."\";</script>";
				}else{
					echo"<script language=\"javascript\">alert('Kamar gagal ditambah.');document.location=\"".base_url()."indekos/detail/".$this->input->post('indekos_id')."\";</script>";
				}
				//redirect('indekos/detail/'.$this->input->post('indekos_id'));
			}else{
				$query = $this->indekos_m->detail_indekos($this->input->post('indekos_id'),$this->session->userdata('email'));
				$data['indekos'] = $query;
				$data['indekos_id'] = $this->input->post('indekos_id');
				$data['indekos_nama'] = $this->indekos_m->get_nama_indekos($this->input->post('indekos_id'));
				$this->load->view('kamar/tambah',$data);
			}
		}
	}
	
	public function lihat(){
		if($this->cek_data()){
			$kamar_id = $this->uri->segment(3);
			$this->load->model('kamar_m');
			$indekos = $this->kamar_m->get_indekos_id($kamar_id);
			if($indekos->num_rows()==1){
				$this->load->model('indekos_m');
				foreach($indekos->result() as $indekos_id);
				$pemilik_indekos = $this->indekos_m->detail_indekos($indekos_id->indekos_id,$this->session->userdata('email'));
				if($pemilik_indekos->num_rows()==1){
					$data['indekos_id'] = $indekos_id->indekos_id;
					$data['indekos_nama']= $indekos_id->indekos_nama;
					$data['kamar'] = $this->kamar_m->get_data_kamar($kamar_id);
					$this->load->view('kamar/detail',$data);
				}else{
					$q = $this->indekos_m->get_all();
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
					$this->load->view('indekos/indekos',$data);
				}
			}else{
				//echo "<script language=\"javascript\">alert('Kamar tidak ditemukan.');document.location=</script>";
				echo "<script language=\"javascript\">alert('Kamar tidak ditemukan.');document.location=\"".base_url()."indekos/lihat\";</script>";
				//redirect('indekos/lihat');
			}
		}
	}
	
	public function ubah_data(){
		if($this->cek_data()){
			$this->load->library('form_validation');
			$this->load->model('indekos_m');
			$this->load->model('kamar_m');
			$this->form_validation->set_rules('indekos_id','Indekos','required|trim');
			$this->form_validation->set_rules('kamar_nama','Nama','required|trim');
			$this->form_validation->set_rules('kamar_harga','Harga','required|trim|numeric');
			$this->form_validation->set_rules('kamar_isi','Isi','required|trim|numeric');
			$this->form_validation->set_rules('kamar_ukuran_panjang','Panjang','required|trim|numeric|max_length[3]');
			$this->form_validation->set_rules('kamar_ukuran_lebar','Lebar','required|trim|numeric|max_length[3]');
			$this->form_validation->set_rules('kamar_ukuran_jenis','Jenis Ukuran','required|trim');
			$this->form_validation->set_rules('kamar_minimal_kontrak','Kontrak','required|trim');
			$this->form_validation->set_rules('kamar_minimal_kontrak_jenis','Jenis Kontrak','required|trim');
			$foto = strtolower(addslashes($_FILES['kamar_foto']['name']));
			if($this->form_validation->run()){
				if($foto==''){
					if($this->kamar_m->ubah_data()){
						$data['pesan'] = "<div class=\"alert alert-success\">Data berhasil diubah.</div>";
					}else{
						$data['pesan'] = "<div class=\"alert alert-error\">Data gagal diubah.</div>";
					}
					$query = $this->indekos_m->detail_indekos($this->input->post('indekos_id'),$this->session->userdata('email'));
					$data['indekos'] = $query;
					$data['kamar'] = $this->kamar_m->get_data_kamar($this->input->post('kamar_id'));
					$data['indekos_id'] = $this->input->post('indekos_id');
					$data['indekos_nama'] = $this->indekos_m->get_nama_indekos($this->input->post('indekos_id'));
					$this->load->view('kamar/detail',$data);
				}else{
					$nama_foto = $this->input->post('nama_foto');
					if($nama_foto == ''){
						$foto = 'kamar_'.$this->input->post('indekos_id').time().'.png';
					}else{
						$foto = $nama_foto;
						if(file_exists(APPPATH.'../assets/images/'.$nama_foto)){ unlink(APPPATH.'../assets/images/'.$nama_foto); }
						if(file_exists(APPPATH.'../assets/images/96/'.$nama_foto)){ unlink(APPPATH.'../assets/images/96/'.$nama_foto); }
					}
					if (move_uploaded_file($_FILES['kamar_foto']['tmp_name'],APPPATH."../assets/images/$foto")){
						//echo"isi";
						if($this->kamar_m->ubah_data_foto($foto)){
							echo"<script language=\"javascript\">alert('Kamar berhasil diubah.');document.location=\"".base_url()."kamar/lihat/".$this->input->post('kamar_id')."\";</script>";
						}else{
							echo"<script language=\"javascript\">alert('Kamar gagal diubah.');document.location=\"".base_url()."kamar/lihat/".$this->input->post('kamar_id')."\";</script>";
						}
						copy($_FILES['kamar_foto']['tmp_name'],APPPATH."../assets/images/96/$foto");
					}else{
						echo"<script language=\"javascript\">alert('File gagal diupload');document.location=\"".base_url()."kamar/lihat/".$this->input->post('kamar_id')."\";</script>";
					}
				}
				//redirect('indekos/detail/'.$this->input->post('indekos_id'));
			}else{
				$query = $this->indekos_m->detail_indekos($this->input->post('indekos_id'),$this->session->userdata('email'));
				$data['indekos'] = $query;
				$data['kamar'] = $this->kamar_m->get_data_kamar($this->input->post('kamar_id'));
				$data['indekos_id'] = $this->input->post('indekos_id');
				$data['indekos_nama'] = $this->indekos_m->get_nama_indekos($this->input->post('indekos_id'));
				$this->load->view('kamar/detail',$data);
			}
		}
	}
	
	public function hapus(){
		if($this->cek_data()){
			$this->load->model('pemilik_m');
			$this->load->model('kamar_m');
			$this->load->model('indekos_m');
			$pemilik_id = $this->pemilik_m->get_pemilik_id($this->session->userdata('email'));
			if($pemilik_id->num_rows()==1){
				$kamar_id = $this->uri->segment(3);
				foreach($pemilik_id->result() as $id);
				$true = $this->kamar_m->cek_relasi_pemilik_kamar($id->pemilik_id,$kamar_id);
				if($true->num_rows()==1){
					if($this->kamar_m->cek_kontrak($kamar_id)->num_rows()==1){
						if($this->kamar_m->hapus_kamar($kamar_id)){
							echo "<script language=\"javascript\">alert('Kamar berhasil dihapus.');document.location=\"".base_url()."indekos/lihat\";</script>";
						}else{
							echo "<script language=\"javascript\">alert('Kamar gagal dihapus.');document.location=\"".base_url()."indekos/lihat\";</script>";
						}
					}else{
						echo "<script language=\"javascript\">alert('Kamar masih dikontrak.');document.location=\"".base_url()."kontrak/lihat\";</script>";
					}
				}else{
					echo "<script language=\"javascript\">alert('Kamar tidak ditemukan.');document.location=\"".base_url()."indekos/lihat\";</script>";
				}
			}
		}
	}
	
}

