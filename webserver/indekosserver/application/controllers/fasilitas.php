<?php

class Fasilitas extends CI_Controller{

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
			$this->load->view('fasilitas/lihat');
		}
	}
	
	public function eksternal(){
		if($this->cek_data()){
			$indekos_id = $this->uri->segment(3);
			$this->load->model('fasilitas_m');
			$this->load->model('indekos_m');
			$query = $this->indekos_m->detail_indekos($indekos_id,$this->session->userdata('email'));
			if($query->num_rows()==1){
				$data['indekos_fasilitas_eks'] = $this->indekos_m->indekos_fasilitas_eks($indekos_id);
				$data['indekos'] = $query;
				$data['indekos_id'] = $indekos_id;
				$data['indekos_nama'] = $this->indekos_m->get_nama_indekos($indekos_id);
				$this->load->view('fasilitas/eksternal',$data);
			}else{
				echo "<script language=\"javascript\">alert('Indekos tidak ditemukan.');document.location=\"".base_url()."indekos/lihat\";</script>";
			}
		}
	}
	
	public function eksternal_tambah(){
		if($this->cek_data()){
			$this->load->model('fasilitas_m');
			$indekos_id = $this->input->post('indekos_id');
			$this->fasilitas_m->eksternal_tambah($indekos_id,$this->input->post('fasilitas_eks_id'));
			echo "<script language=\"javascript\">alert('Data berhasil dimasukan.');document.location=\"".base_url()."fasilitas/eksternal/$indekos_id\";</script>";
		}
	}
	
	public function eksternal_hapus(){
		if($this->cek_data()){
			if(($this->uri->segment(3)) and($this->uri->segment(4))){
				$indekos_id = $this->uri->segment(3);
				$fasilitas_eks_id = $this->uri->segment(4);
				$this->load->model('fasilitas_m');
				if($this->fasilitas_m->eksternal_hapus($this->session->userdata('email'),$indekos_id,$fasilitas_eks_id)){
					echo "<script language=\"javascript\">alert('Data berhasil dihapus.');document.location=\"".base_url()."fasilitas/eksternal/$indekos_id\";</script>";
				}else{
					echo "<script language=\"javascript\">alert('Data tidak ditemukan.');document.location=\"".base_url()."indekos/lihat\";</script>";
				}
			}else{
				redirect('indekos/lihat');
			}
		}
	}
	
	public function internal(){
		if($this->cek_data()){
			$this->load->model('fasilitas_m');
			$this->load->model('indekos_m');
			$this->load->model('kamar_m');
			if(($this->uri->segment(3))and($this->uri->segment(4))){
				$indekos_id = $this->uri->segment(3);
				$kamar_id = $this->uri->segment(4);
				$query = $this->indekos_m->detail_indekos($indekos_id,$this->session->userdata('email'));
				if($query->num_rows()==1){
					foreach($query->result() as $kamar);
					if($this->kamar_m->cek_relasi_pemilik_kamar($kamar->pemilik_id,$kamar_id)->num_rows()==1){
					$data['kamar'] = $this->kamar_m->get_data_kamar($kamar_id);
					$data['pemilik_id']				= $kamar->pemilik_id;
					$data['indekos_id']				= $indekos_id;
					$data['kamar_id']				= $kamar_id;
					$data['pemilik_fasilitas']		= $this->kamar_m->get_pemilik_fasilitas_id($kamar->pemilik_id);
					$data['kamar_fasilitas_int']	= $this->fasilitas_m->get_fasilitas_kamar($kamar_id);
					$this->load->view('fasilitas/internal',$data);
					}else{
						echo "<script language=\"javascript\">alert('Kamar tidak ditemukan.');document.location=\"".base_url()."indekos/detail/$indekos_id\";</script>";
					}
				}else{
					echo "<script language=\"javascript\">alert('Indekos tidak ditemukan.');document.location=\"".base_url()."indekos/lihat\";</script>";
				}
			}else{
				//redirect('indekos/lihat');
				$data['internal'] = $this->fasilitas_m->daftar_fasilitas_internal($this->session->userdata('email'));
				$this->load->view('fasilitas/int',$data);
			}
		}
	}
	
	public function internal_tambah(){
		if($this->cek_data()){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('pemilik_id','ID','required|trim');
			$this->form_validation->set_rules('fasilitas_int_nama','Nama','required|trim');
			$indekos_id = $this->input->post('indekos_id');
			$kamar_id = $this->input->post('kamar_id');
			if($this->form_validation->run()){
				$this->load->model('fasilitas_m');
				if($this->fasilitas_m->internal_tambah()){
					echo"<script language=\"javascript\">alert('Data berhasil ditambah');document.location=\"".base_url()."fasilitas/internal/$indekos_id/$kamar_id\"</script>";
				}else{
					echo"<script language=\"javascript\">alert('Data gagal ditambah');document.location=\"".base_url()."fasilitas/internal/$indekos_id/$kamar_id\"</script>";
				}
			}else{
				redirect('fasilitas/internal/'.$indekos_id.'/'.$kamar_id);
			}
		}
	}
	
	public function kamar_internal_tambah(){
		if($this->cek_data()){
			$indekos_id = $this->input->post('indekos_id');
			$kamar_id = $this->input->post('kamar_id');
			$fasilitas_int_id = $this->input->post('fasilitas_int_id');
			$this->load->model('fasilitas_m');
			$this->fasilitas_m->kamar_internal_tambah($kamar_id,$fasilitas_int_id);
			echo"<script language=\"javascript\">alert('Data berhasil ditambah');document.location=\"".base_url()."fasilitas/internal/$indekos_id/$kamar_id\"</script>";
		}
	}
	
	public function internal_hapus(){
		if($this->cek_data()){
			if(($this->uri->segment(3))and($this->uri->segment(4))and($this->uri->segment(5))){
				$indekos_id = $this->uri->segment(3);
				$kamar_id = $this->uri->segment(4);
				$kamar_fasilitas_int_id = $this->uri->segment(5);
				$this->load->model('fasilitas_m');
				$this->load->model('indekos_m');
				$this->load->model('kamar_m');
				$query = $this->indekos_m->detail_indekos($indekos_id,$this->session->userdata('email'));
				if($query->num_rows()==1){
					foreach($query->result() as $kamar);
					if($this->kamar_m->cek_relasi_pemilik_kamar($kamar->pemilik_id,$kamar_id)->num_rows()==1){
						if($this->fasilitas_m->internal_hapus($kamar_fasilitas_int_id)){
							echo "<script language=\"javascript\">alert('Data berhasil dihapus.');document.location=\"".base_url()."fasilitas/internal/$indekos_id/$kamar_id\";</script>";
						}else{
							echo "<script language=\"javascript\">alert('Data gagal dihapus.');document.location=\"".base_url()."fasilitas/internal/$indekos_id/$kamar_id\";</script>";
						}
					}else{
						echo "<script language=\"javascript\">alert('Kamar tidak ditemukan.');document.location=\"".base_url()."indekos/detail/$indekos_id\";</script>";
					}
				}else{
					echo "<script language=\"javascript\">alert('Indekos tidak ditemukan.');document.location=\"".base_url()."indekos/lihat\";</script>";
				}
			}else{
				redirect('indekos/lihat');
			}
		}
	}

	public function tambahint(){
		if($this->cek_data()){
			$this->load->model('fasilitas_m');
			if($this->fasilitas_m->tambahint()){
				echo"<script>alert('Data berhasil ditambah');document.location=\"".base_url()."fasilitas/internal\";</script>";
			}else{
				echo"<script>alert('Data gagal ditambah');document.location=\"".base_url()."fasilitas/internal\";</script>";
			}
		}
	}
	
	public function ubahint(){
		if($this->cek_data()){
			$this->load->model('fasilitas_m');
			$fasilitas = $this->fasilitas_m->pemilik_internal($this->uri->segment(3),$this->session->userdata('email'));
			if($fasilitas->num_rows()==1){
				$data['internal'] = $this->fasilitas_m->daftar_fasilitas_internal($this->session->userdata('email'));
				$data['fasilitas'] = $fasilitas;
				$this->load->view('fasilitas/ubahint',$data);
			}else{
				echo"<script>alert('Data tidak ditemukan');document.location=\"".base_url()."fasilitas/internal\";</script>";
			}
		}
	}
	
	public function ubahinternal(){
		if($this->cek_data()){
			$this->load->model('fasilitas_m');
			if($this->fasilitas_m->ubahint()){
				echo"<script>alert('Data berhasil diubah');document.location=\"".base_url()."fasilitas/internal\";</script>";
			}else{
				echo"<script>alert('Data gagal diubah');document.location=\"".base_url()."fasilitas/internal\";</script>";
			}
		}
	}
	
	public function hapusint(){
		if($this->cek_data()){
			$this->load->model('fasilitas_m');
			$fasilitas = $this->fasilitas_m->pemilik_internal($this->uri->segment(3),$this->session->userdata('email'));
				if($fasilitas->num_rows()==1){
					if($this->fasilitas_m->hapusint()){
					echo"<script>alert('Data berhasil dihapus');document.location=\"".base_url()."fasilitas/internal\";</script>";
				}else{
					echo"<script>alert('Data gagal gagal');document.location=\"".base_url()."fasilitas/internal\";</script>";
				}
			}else{
				echo"<script>alert('Data tidak ditemukan');document.location=\"".base_url()."fasilitas/internal\";</script>";
			}
			
		}
	}
}

