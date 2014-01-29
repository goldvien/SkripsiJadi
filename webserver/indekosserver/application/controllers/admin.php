<?php

class Admin extends CI_Controller{

	public function index(){
		$this->cek();
	}
	
	public function cek(){
		if($this->session->userdata('admin_login')){
			redirect('admin/home');
		}else{
			$this->login();
		}
	}
	
	public function login(){
		$this->load->view('admin/login');
	}
	
	public function validasi(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email','Email','required|trim|email_valid|callback_validate');
		$this->form_validation->set_rules('password','Password','required|md5|trim');
		if($this->form_validation->run()){
			$this->session->unset_userdata('is_logged_in');
			$data = array(
				'admin_email'			=> $this->input->post('email'),
				'admin_login'	=> 1
			);
			$this->session->set_userdata($data);
			redirect('admin/home');
		}else{
			$this->load->view('admin/login');
		}
	}
	
	public function validate(){
		$this->load->model('login_m');
		if($this->login_m->cek_login_admin()){
			return true;
		}else{
			$this->form_validation->set_message('validate','Email dan Password tidak ditemukan');
			return false;
		}
	}

	public function cek_data(){
		if($this->session->userdata('admin_login')){
			$this->load->model('admin_m');
			$admin = $this->admin_m->cek_data($this->session->userdata('email'));
			if($admin->num_rows()==1){
				$data['admin'] = $admin->result();
				//$this->load->view('admin/data',$data);
				return true;
			}else{
				redirect('admin/login');
			}
		}else{
			redirect('admin/login');
		}
	}
	
	public function home(){
		if($this->cek_data()){
			$this->load->view('admin/home');
		}
	}
	
	public function logout(){
		$this->session->sess_destroy();
		redirect('admin/login');
	}
	
	public function provinsi(){
		if($this->cek_data()){
			$this->load->model('daerah_m');
			$this->load->library('pagination');
			$prov = count($this->daerah_m->provinsi());
			$config['base_url'] = base_url().'admin/provinsi';
			$config['total_rows'] = $prov;
			$config['per_page'] = 20;
			
			$this->pagination->initialize($config);
        	$data['page'] = $this->pagination->create_links();
        	$data['provinsi'] = $this->daerah_m->provinsi_limit_offset($config['per_page'],$this->uri->segment(3));		
			$this->load->view('admin/provinsi',$data);
		}
	}
	
	public function provinsi_tambah(){
		if($this->cek_data()){
			$this->load->model('daerah_m');
			$this->load->library('form_validation');
			$this->form_validation->set_rules('provinsi_kode','Kode','required|trim|numeric');
			$this->form_validation->set_rules('provinsi_nama','Nama','required|trim');
			if($this->form_validation->run()){
				if($this->daerah_m->provinsi_tambah()){
					echo"<script language=\"javascript\">alert('Data berhasil ditambah.');document.location=\"".base_url()."admin/provinsi\"</script>";
				}else{
					echo"<script language=\"javascript\">alert('Data gagal ditambah.');document.location=\"".base_url()."admin/provinsi\"</script>";
				}
			}else{
				$this->provinsi();
			}
		}
	}
	
	public function provinsi_hapus(){
		if($this->cek_data()){
			$provinsi_id = $this->uri->segment(3);
			$this->load->model('daerah_m');
			if($this->daerah_m->provinsi_hapus($provinsi_id)){
				echo"<script language=\"javascript\">alert('Data berhasil dihapus.');document.location=\"".base_url()."admin/provinsi\"</script>";
			}else{
				echo"<script language=\"javascript\">alert('Data gagal dihapus.');document.location=\"".base_url()."admin/provinsi\"</script>";
			}
		}
	}
	
	public function provinsi_edit(){
		if($this->cek_data()){
			$provinsi_id = $this->uri->segment(3);
			$offset = $this->uri->segment(4);
			$this->load->model('daerah_m');
			$this->load->library('pagination');
			$prov = count($this->daerah_m->provinsi());
			$config['base_url'] = base_url().'admin/provinsi_edit/'.$provinsi_id;
			$config['total_rows'] = $prov;
			$config['per_page'] = 20;
			
			$this->pagination->initialize($config);
        	$data['page'] = $this->pagination->create_links();
        	$data['provinsi'] = $this->daerah_m->provinsi_limit_offset($config['per_page'],$offset);		
			$data['edit'] = $this->daerah_m->get_provinsi($provinsi_id);
			$this->load->view('admin/provinsi_edit',$data);
		}
	}
	
	public function provinsi_ubah(){
		if($this->cek_data()){
			$this->load->model('daerah_m');
			$this->load->library('form_validation');
			$this->form_validation->set_rules('provinsi_id','ID','required|trim|numeric');
			$this->form_validation->set_rules('provinsi_kode','Kode','required|trim|numeric');
			$this->form_validation->set_rules('provinsi_nama','Nama','required|trim');
			if($this->form_validation->run()){
				if($this->daerah_m->provinsi_ubah()){
					echo"<script language=\"javascript\">alert('Data berhasil diubah.');document.location=\"".base_url()."admin/provinsi\"</script>";
				}else{
					echo"<script language=\"javascript\">alert('Data gagal diubah.');document.location=\"".base_url()."admin/provinsi\"</script>";
				}
			}else{
				$this->provinsi();
			}
		}
	}
	
	public function kota(){
		if($this->cek_data()){
			if($this->uri->segment(3)){
			$this->load->model('daerah_m');
        	$data['kota'] = $this->daerah_m->kota($this->uri->segment(3));	
			$data['provinsi_id'] = $this->uri->segment(3);
			$data['rows_kota'] = $this->daerah_m->rows_kota($this->uri->segment(3));
        	$data['provinsi_nama'] = $this->daerah_m->get_nama_provinsi($this->uri->segment(3));		
			$this->load->view('admin/kota',$data);
			}else{
				$this->provinsi();
			}
		}
	}
	
	public function kota_peta(){
		if($this->cek_data()){
			$this->load->library('googlemaps');
			//$config['zoom'] = 'auto';
			$config['center'] = "-7.812534564621957, 110.36539077758789";
			
			$marker = array();
			$marker['position'] = "-7.812534564621957, 110.36539077758789";
			$marker['draggable'] = true;
			$marker['ondragend'] = 'long_lat(event.latLng.lng(),event.latLng.lat())';
			$this->googlemaps->add_marker($marker);
			$config['trafficOverlay'] = TRUE;
			//$config['ondblclick'] = 'long_lat(event.latLng.lng(),event.latLng.lat())';
			$this->googlemaps->initialize($config);
			$data['map'] = $this->googlemaps->create_map();
			$this->load->view('admin/kota_peta',$data);
		}
	}
	
	public function kota_peta_ubah(){
		if($this->cek_data()){
			$this->load->library('googlemaps');
			//masih error
			$marker = array();
			if(($this->uri->segment(3)) or ($this->uri->segment(4))){
				$long = $this->uri->segment(3);
				$lat = $this->uri->segment(4);
				$config['center'] ="$lat,$long";
				$marker['position'] = "$lat,$long";
			}else{
				$config['center'] = "-7.812534564621957, 110.36539077758789";
				$marker['position'] = "-7.812534564621957, 110.36539077758789";
			}
			$marker['draggable'] = true;
			$marker['ondragend'] = 'long_lat(event.latLng.lng(),event.latLng.lat());';
			$this->googlemaps->add_marker($marker);
			//$config['zoom'] = 'auto';
			$config['trafficOverlay'] = TRUE;
			//$config['ondblclick'] = 'long_lat(event.latLng.lng(),event.latLng.lat());';
			$this->googlemaps->initialize($config);
			$data['map'] = $this->googlemaps->create_map();
			$this->load->view('admin/kota_peta',$data);
		}
	}
	
	public function kota_tambah(){
		if($this->cek_data()){
			$this->load->model('daerah_m');
			$this->load->library('form_validation');
			$this->form_validation->set_rules('provinsi_id','ID','required|trim|numeric');
			$this->form_validation->set_rules('kab_kota_kode','Kode','required|trim|numeric');
			$this->form_validation->set_rules('kab_kota_nama','Nama','required|trim');
			$this->form_validation->set_rules('kab_kota_long','Longitude & Latitude','required|trim');
			$provinsi_id = $this->input->post('provinsi_id');
			if($this->form_validation->run()){
				if($this->daerah_m->kota_tambah()){
					echo"<script language=\"javascript\">alert('Data berhasil ditambah.');document.location=\"".base_url()."admin/kota/$provinsi_id\"</script>";
				}else{
					echo"<script language=\"javascript\">alert('Data gagal ditambah.');document.location=\"".base_url()."admin/kota/$provinsi_id\"</script>";
				}
			}else{
			
        	$data['kota'] = $this->daerah_m->kota($provinsi_id);	
			$data['provinsi_id'] = $provinsi_id;
        	$data['provinsi_nama'] = $this->daerah_m->get_nama_provinsi($provinsi_id);		
			$this->load->view('admin/kota',$data);
			}
		}
	}
	
	public function kota_hapus(){
		if($this->cek_data()){
			$provinsi_id = $this->uri->segment(3);
			$kab_kota_id = $this->uri->segment(4);
			$this->load->model('daerah_m');
			if($this->daerah_m->kota_hapus($provinsi_id,$kab_kota_id)){
				$data['kota'] = $this->daerah_m->kota($provinsi_id);	
				$data['provinsi_id'] = $provinsi_id;
				$data['provinsi_nama'] = $this->daerah_m->get_nama_provinsi($provinsi_id);
				echo"<script language=\"javascript\">alert('Data berhasil dihapus.');document.location=\"".base_url()."admin/kota/$provinsi_id\"</script>";
			}else{
				$data['kota'] = $this->daerah_m->kota($provinsi_id);	
				$data['provinsi_id'] = $provinsi_id;
				$data['provinsi_nama'] = $this->daerah_m->get_nama_provinsi($provinsi_id);
				echo"<script language=\"javascript\">alert('Data gagal dihapus.');document.location=\"".base_url()."admin/kota/$provinsi_id\"</script>";
			}
		}
	}
	
	public function kota_edit(){
		if($this->cek_data()){
			$provinsi_id = $this->uri->segment(3);
			$kab_kota_id = $this->uri->segment(4);
			$this->load->model('daerah_m');
			if(($this->uri->segment(3))and($this->uri->segment(4))){
        	$data['kota'] 			= $this->daerah_m->kota($this->uri->segment(3));	
			$data['provinsi_id'] 	= $this->uri->segment(3);
        	$data['provinsi_nama'] 	= $this->daerah_m->get_nama_provinsi($this->uri->segment(3));
			$data['get_kota']		= $this->daerah_m->get_kota($provinsi_id,$kab_kota_id);
			$this->load->view('admin/kota_edit',$data);
			}else{
				$this->provinsi();
			}
		}
	}
	
	public function kota_ubah(){
		if($this->cek_data()){
			$this->load->model('daerah_m');
			$this->load->library('form_validation');
			$this->form_validation->set_rules('provinsi_id','ID','required|trim|numeric');
			$this->form_validation->set_rules('kab_kota_id','ID','required|trim|numeric');
			$this->form_validation->set_rules('kab_kota_kode','Kode','required|trim|numeric');
			$this->form_validation->set_rules('kab_kota_nama','Nama','required|trim');
			$this->form_validation->set_rules('kab_kota_long','Longitude & Latitude','required|trim');
			$provinsi_id = $this->input->post('provinsi_id');
			$kab_kota_id = $this->input->post('kab_kota_id');
			if($this->form_validation->run()){
				if($this->daerah_m->kota_ubah()){
					echo"<script language=\"javascript\">alert('Data berhasil diubah.');document.location=\"".base_url()."admin/kota/$provinsi_id\"</script>";
				}else{
					echo"<script language=\"javascript\">alert('Data gagal diubah.');document.location=\"".base_url()."admin/kota/$provinsi_id\"</script>";
				}
			}else{
				$data['kota'] 			= $this->daerah_m->kota($provinsi_id);	
				$data['provinsi_id'] 	= $provinsi_id;
				$data['provinsi_nama'] 	= $this->daerah_m->get_nama_provinsi($provinsi_id);
				$data['get_kota']		= $this->daerah_m->get_kota($provinsi_id,$kab_kota_id);
				$this->load->view('admin/kota_edit',$data);
			}
		}
	}
	
	public function fasilitas_master(){
		if($this->cek_data()){
			$this->load->model('fasilitas_m');
			$this->load->library('pagination');
			$master = $this->fasilitas_m->master()->num_rows();
			$config['base_url'] = base_url().'admin/fasilitas_master';
			$config['total_rows'] = $master;
			$config['per_page'] = 20;
			
			$this->pagination->initialize($config);
        	$data['page'] = $this->pagination->create_links();
        	$data['master'] = $this->fasilitas_m->master_limit_offset($config['per_page'],$this->uri->segment(3));
			$this->load->view('admin/fasilitas_master',$data);
		}
	}
	
	public function fasilitas_master_tambah(){
		if($this->cek_data()){
			$this->load->library('form_validation');
			$this->load->model('fasilitas_m');
			$this->form_validation->set_rules('fasilitas_master_nama','Nama','required|trim');
			if($this->form_validation->run()){
				$config = array(
					'allowed_types'		=>	'jpg|jpeg|gif|png',
					'file_name'			=>	$this->input->post('fasilitas_master_nama'),
					'image_width'		=> 70,
					'image_height'		=>50,
					'upload_path'		=>	realpath(APPPATH.'../assets/images')
				);
				$this->load->library('upload',$config);
				$this->upload->do_upload();
				$image = $this->upload->data();
				
				$config = array(
					'source_image'		=> $image['full_path'],
					'new_image'			=> realpath(APPPATH.'../assets/images/icons'),
					'maintain_ration'	=>	true,
					'width'				=> 50,
					'height'			=>50
				);
				
				$this->load->library('image_lib',$config);
				if($this->image_lib->resize()){
					if($this->fasilitas_m->fasilitas_master_tambah($image['file_name'],$this->input->post('fasilitas_master_nama'))){
						if(file_exists($image['full_path'])){ unlink($image['full_path']);}
						echo"<script language=\"javascript\">alert('Data berhasil ditambah');document.location=\"".base_url()."admin/fasilitas_master\"</script>";
					}else{
						if(file_exists($image['full_path'])){ unlink($image['full_path']);}
						echo"<script language=\"javascript\">alert('Data gagal ditambah');document.location=\"".base_url()."admin/fasilitas_master\"</script>";
					}
				}else{
					if(file_exists($image['full_path'])){
						unlink($image['full_path']);
					}
					echo"<script language=\"javascript\">alert('Data gagal ditambah');document.location=\"".base_url()."admin/fasilitas_master\"</script>";
				}
			}else{
				$this->load->library('pagination');
				$master = $this->fasilitas_m->master()->num_rows();
				$config['base_url'] = base_url().'admin/fasilitas_master';
				$config['total_rows'] = $master;
				$config['per_page'] = 20;
				
				$this->pagination->initialize($config);
				$data['page'] = $this->pagination->create_links();
				$data['master'] = $this->fasilitas_m->master_limit_offset($config['per_page'],$this->uri->segment(3));
				$this->load->view('admin/fasilitas_master',$data);
			}
		}
	}
	
	public function fasilitas_master_edit(){
		if($this->cek_data()){
			if($fasilitas_master_id = $this->uri->segment(3)){
				$this->load->library('pagination');
				$this->load->model('fasilitas_m');
				$master = $this->fasilitas_m->master()->num_rows();
				$config['base_url'] = base_url().'admin/fasilitas_master';
				$config['total_rows'] = $master;
				$config['per_page'] = 20;
				
				$this->pagination->initialize($config);
				$data['page'] = $this->pagination->create_links();
				$data['edit'] = $this->fasilitas_m->get_fasilitas_master($fasilitas_master_id);
				$data['master'] = $this->fasilitas_m->master_limit_offset($config['per_page'],0);
				$this->load->view('admin/fasilitas_master_edit',$data);
			}else{
				redirect('admin/fasilitas_master');
			}
		}
	}
	
	public function fasilitas_master_ubah(){
		if($this->cek_data()){
			$this->load->library('form_validation');
			$this->load->model('fasilitas_m');
			$this->form_validation->set_rules('fasilitas_master_id','ID','required|trim|numeric');
			$this->form_validation->set_rules('fasilitas_master_nama','Nama','required|trim');
			if($this->form_validation->run()){
				if($_FILES['userfile']['name']==''){
					if($this->fasilitas_m->fasilitas_master_ubah_nama()){
						echo"<script language=\"javascript\">alert('Data berhasil diubah');document.location=\"".base_url()."admin/fasilitas_master\"</script>";
					}else{
						echo"<script language=\"javascript\">alert('Data gagal diubah');document.location=\"".base_url()."admin/fasilitas_master\"</script>";
					}
				}else{
					// upload
					$file_icon = $this->input->post('fasilitas_master_icon');
					if(file_exists(APPPATH.'../assets/images/icons/'.$file_icon)){unlink(APPPATH.'../assets/images/icons/'.$file_icon);}
					$config = array(
						'allowed_types'		=>	'jpg|jpeg|gif|png',
						'file_name'			=>	$this->input->post('fasilitas_master_nama'),
						'image_width'		=> 70,
						'image_height'		=>50,
						'upload_path'		=>	realpath(APPPATH.'../assets/images')
					);
					$this->load->library('upload',$config);
					$this->upload->do_upload();
					$image = $this->upload->data();
					
					$config = array(
						'source_image'		=> $image['full_path'],
						'new_image'			=> realpath(APPPATH.'../assets/images/icons'),
						'maintain_ration'	=>	true,
						'width'				=> 50,
						'height'			=>50
					);
					
					$this->load->library('image_lib',$config);
					if($this->image_lib->resize()){
						if($this->fasilitas_m->fasilitas_master_ubah_nama_icon($image['file_name'],$this->input->post('fasilitas_master_nama'))){
							if(file_exists($image['full_path'])){ unlink($image['full_path']);}
							echo"<script language=\"javascript\">alert('Data berhasil diubah');document.location=\"".base_url()."admin/fasilitas_master\"</script>";
						}else{
							if(file_exists($image['full_path'])){ unlink($image['full_path']);}
							echo"<script language=\"javascript\">alert('Data gagal diubah');document.location=\"".base_url()."admin/fasilitas_master\"</script>";
						}
					}else{
						if(file_exists($image['full_path'])){
							unlink($image['full_path']);
						}
						echo"<script language=\"javascript\">alert('Data gagal diubah');document.location=\"".base_url()."admin/fasilitas_master\"</script>";
					}
				}
			}else{
				echo"<script language=\"javascript\">alert('Data gagal diubah');document.location=\"".base_url()."admin/fasilitas_master\"</script>";
			}
		}
	}
	
	public function fasilitas_eksternal(){
		if($this->cek_data()){
			if($this->uri->segment(3)){
				$kab_kota_id = $this->uri->segment(3);
				$this->load->model('fasilitas_m');
				$this->load->model('daerah_m');
				$data['kab_kota_id'] = $kab_kota_id;
				$data['kab_kota_nama'] = $this->daerah_m->get_nama_kab_kota($kab_kota_id);
				$this->load->view('admin/fasilitas_eksternal',$data);
			}else{
				redirect('admin/provinsi');
			}
		}
	}
	
	public function fasilitas_eksternal_tambah(){
		if($this->cek_data()){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('kab_kota_id','Kota','required|trim');
			$this->form_validation->set_rules('fasilitas_master_id','ID','required|trim|numeric');
			$this->form_validation->set_rules('fasilitas_eks_nama','Nama','required|trim');
			$this->form_validation->set_rules('fasilitas_eks_long','Longitude & Latitude','required|trim');
			if($this->form_validation->run()){
				$kab_kota_id = $this->input->post('kab_kota_id');
				$this->load->model('fasilitas_m');
				if($this->fasilitas_m->fasilitas_eksternal_tambah()){
					echo"<script language=\"javascript\">alert('Data berhasil ditambah.');document.location=\"".base_url()."admin/fasilitas_eksternal/$kab_kota_id\";</script>";
				}else{
					echo"<script language=\"javascript\">alert('Data gagal ditambah.');document.location=\"".base_url()."admin/fasilitas_eksternal/$kab_kota_id\";</script>";
				}
			}else{
				$kab_kota_id = $this->input->post('kab_kota_id');
				$this->load->model('fasilitas_m');
				$this->load->model('daerah_m');
				$data['kab_kota_id'] = $kab_kota_id;
				$data['kab_kota_nama'] = $this->daerah_m->get_nama_kab_kota($kab_kota_id);
				$this->load->view('admin/fasilitas_eksternal',$data);
			}
		}
	}
	
	public function fasilitas_master_hapus(){
		if($this->cek_data()){
			if($this->uri->segment(3)){
				$fasilitas_master_id = $this->uri->segment(3);
				$this->load->model('fasilitas_m');
				foreach($this->fasilitas_m->master()->result() as $data);
				if(file_exists(APPPATH.'../assets/images/icons/'.$data->fasilitas_master_icon)){unlink(APPPATH.'../assets/images/icons/'.$data->fasilitas_master_icon);}
				if($this->fasilitas_m->fasilitas_master_hapus($fasilitas_master_id)){
					echo"<script language=\"javascript\">alert('Data berhasil dihapus.');document.location=\"".base_url()."admin/fasilitas_master\";</script>";
				}else{
					echo"<script language=\"javascript\">alert('Data gagal dihapus.');document.location=\"".base_url()."admin/fasilitas_master\";</script>";
				}
			}else{
				redirect('admin/fasilitas_master');
			}
		}
	}
	
	public function fasilitas_eksternal_peta(){
		if($this->cek_data()){
			if($this->uri->segment(3)){
				$kab_kota_id = $this->uri->segment(3);
				$this->load->library('googlemaps');
				$this->load->model('daerah_m');
				$long_lat = $this->daerah_m->get_long_lat_kota($kab_kota_id);
				foreach($long_lat->result() as $ll);
				$long = $ll->kab_kota_long;
				$lat = $ll->kab_kota_lat;
				$data['maps'] = $this->googlemaps->create_map();
				$config['center'] ="$lat, $long";
				$marker = array();
				$marker['position'] = "$lat, $long";
				$marker['draggable'] = true;
				$marker['ondragend'] = 'long_lat(event.latLng.lng(),event.latLng.lat())';
				$this->googlemaps->add_marker($marker);
				//$config['zoom'] = 'auto';
				$config['trafficOverlay'] = TRUE;
				//$config['ondblclick'] = 'long_lat(event.latLng.lng(),event.latLng.lat())';
				$this->googlemaps->initialize($config);
				$data['map'] = $this->googlemaps->create_map();
				$this->load->view('admin/fasilitas_eksternal_peta',$data);
			}
		}
	}
	
	public function fasilitas_eksternal_peta_edit(){
		if($this->cek_data()){
			if($this->uri->segment(3)){
				$long = $this->uri->segment(3);
				$lat = $this->uri->segment(4);
				$this->load->library('googlemaps');
				$config['center'] ="$lat, $long";
				$marker = array();
				$marker['position'] = "$lat, $long";
				$marker['draggable'] = true;
				$marker['ondragend'] = 'long_lat(event.latLng.lng(),event.latLng.lat());';
				$this->googlemaps->add_marker($marker);
				//$config['zoom'] = 'auto';
				$config['trafficOverlay'] = TRUE;
				//$config['ondblclick'] = 'long_lat(event.latLng.lng(),event.latLng.lat())';
				$this->googlemaps->initialize($config);
				$data['map'] = $this->googlemaps->create_map();
				$this->load->view('admin/fasilitas_eksternal_peta',$data);
			}
		}
	}
	
	public function fasilitas_eksternal_hapus(){
		if($this->cek_data()){
			if(($this->uri->segment(3))and($this->uri->segment(4))){
				$kab_kota_id = $this->uri->segment(3);
				$fasilitas_eks_id = $this->uri->segment(4);
				$this->load->model('fasilitas_m');
				if($this->fasilitas_m->fasilitas_eksternal_hapus($fasilitas_eks_id)){
						echo"<script language=\"javascript\">alert('Data berhasil dihapus.');document.location=\"".base_url()."admin/fasilitas_eksternal/$kab_kota_id\";</script>";
				}else{
					echo"<script language=\"javascript\">alert('Data gagal dihapus.');document.location=\"".base_url()."admin/fasilitas_eksternal/$kab_kota_id\";</script>";
				}
			}else{
				redirect('admin/fasilitas_eksternal');
			}
		}
	}
	
	public function fasilitas_eksternal_edit(){
		if($this->cek_data()){
			if(($this->uri->segment(3))and($this->uri->segment(4))){
				$kab_kota_id = $this->uri->segment(3);
				$fasilitas_eks_id = $this->uri->segment(4);
				$this->load->model('fasilitas_m');
				$this->load->model('daerah_m');
				$data['kab_kota_id'] = $kab_kota_id;
				$data['kab_kota_nama'] = $this->daerah_m->get_nama_kab_kota($kab_kota_id);
				$data['edit']	= $this->fasilitas_m->get_eksternal($kab_kota_id,$fasilitas_eks_id);
				$this->load->view('admin/fasilitas_eksternal_edit',$data);
			}else{
				redirect('admin/fasilitas_eksternal');
			}
		}
	}
	
	public function fasilitas_eksternal_ubah(){
		if($this->cek_data()){
			$this->load->library('form_validation');
			$kab_kota_id = $this->input->post('kab_kota_id');
			$fasilitas_eks_id = $this->input->post('fasilitas_eks_id');
			$this->form_validation->set_rules('kab_kota_id','ID','required|trim');
			$this->form_validation->set_rules('fasilitas_master_id','ID','required|trim');
			$this->form_validation->set_rules('fasilitas_eks_id','ID','required|trim');
			$this->form_validation->set_rules('fasilitas_eks_nama','Nama','required|trim');
			$this->form_validation->set_rules('fasilitas_eks_long','Longitude & Latitude','required|trim');
			if($this->form_validation->run()){
				$this->load->model('fasilitas_m');
				if($this->fasilitas_m->fasilitas_eksternal_ubah()){
					echo"<script language=\"javascript\">alert('Data berhasil dihapus.');document.location=\"".base_url()."admin/fasilitas_eksternal/$kab_kota_id\";</script>";
				}else{
					echo"<script language=\"javascript\">alert('Data gagal diubah.');document.location=\"".base_url()."admin/fasilitas_eksternal/$kab_kota_id\";</script>";
				}
			}else{
				$this->load->model('fasilitas_m');
				$this->load->model('daerah_m');
				$data['kab_kota_id'] = $kab_kota_id;
				$data['kab_kota_nama'] = $this->daerah_m->get_nama_kab_kota($kab_kota_id);
				$data['edit']	= $this->fasilitas_m->get_fasilitas_eksternal($kab_kota_id,$fasilitas_eks_id);
				$this->load->view('admin/fasilitas_eksternal_edit',$data);
			}
		}
	}
	
}

