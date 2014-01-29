<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {


	public function index()
	{
		if($this->session->userdata('is_logged_in')){
			redirect('pemilik/home');
		}else{
			$this->log_in();
		}
	}
	
	public function log_in(){
		$this->load->model('daerah_m');
		$query = $this->daerah_m->provinsi();
		$data['provinsi'] = $query;
		$this->load->view('login',$data);
	}
	
	public function login_validasi(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email','Email','required|trim|xss_clean|callback_validate_credentials');
		$this->form_validation->set_rules('password','Password','required|md5|trim');
		if($this->form_validation->run()){
			$this->session->unset_userdata('admin_login');
			$data = array(
				'email'			=> $this->input->post('email'),
				'is_logged_in'	=> 1
			);
			$this->session->set_userdata($data);
			redirect('pemilik/home');
		}else{
			$this->load->view('login');
		}
	}
	
	public function validate_credentials(){
		$this->load->model('login_m');
		if($this->login_m->cek_login()){
			return true;
		}else{
			$this->form_validation->set_message('validate_credentials','Email dan Password tidak ditemukan');
			return false;
		}
	}
	
	public function daftar(){
		$this->load->library('form_validation');
		$this->load->model('login_m');
		$this->load->model('daerah_m');
		$this->form_validation->set_rules('provinsi_id','Provinsi','required|trim');
		$this->form_validation->set_rules('dftemail','Email','required|trim|valid_email|is_unique[pemilik.pemilik_email]');
		$this->form_validation->set_rules('dftpassword','Password','required|trim');
		$this->form_validation->set_rules('cpassword','Password','required|trim|matches[dftpassword]');
		
		$query = $this->daerah_m->provinsi();
		$data['provinsi'] = $query;
		
		if($this->form_validation->run()){
			
			// email
			$this->load->library('email',array('mailtype'=>'html'));
			//generate random key
			$key = uniqid();
			//send email
			$this->email->from('indekos1234567890@gmail.com','Indekos Web');
			$this->email->to($this->input->post('dftemail'));
			$this->email->subject("Konfirmasi Akun Pemilik Indekos");
			
			$message = "<p>Terima kasih telah daftar.</p>";
			$message .= "<p><a href='".base_url()."pemilik/confirm/$key'>Klik ini</a> untuk konfirmasi akun</p>";
			
			$this->email->message($message);
			
			if($this->login_m->tambah_user($key)){
				if($this->email->send()){
					echo "<script language=\"javascript\">alert('Daftar berhasil dilakukan. Cek Email Anda untuk konfirmasi akun.');document.location=\"".base_url()."\";</script>";
				}else{
					echo "<script language=\"javascript\">alert('Email konfirmasi gagal dikirim. kirim ulang.');document.location=\"".base_url()."\";</script>";
				}
			}else{
				echo "<script language=\"javascript\">alert('Gagal daftar!');document.location=\"".base_url()."\";</script>";
			}
			
		}else{
			$this->load->view('login',$data);
		}
	}
	
	public function email(){
		$this->load->view('email');
	}
	
	public function kirim_konfirmasi_ulang(){
		$this->load->library('form_validation');
		$this->load->model('login_m');
		$this->load->model('daerah_m');
		$query = $this->daerah_m->provinsi();
		$data['provinsi'] = $query;
		$this->form_validation->set_rules('email_konfirmasi_ulang','Email','required|trim|valid_email');
		if($this->form_validation->run()){
			$email = $this->login_m->cek_email($this->input->post('email_konfirmasi_ulang'));
			if($email->num_rows()==1){
				foreach($email->result() as $data);
				if($data->pemilik_status=='pending'){
					$this->load->library('email',array('mailtype'=>'html'));
					$key = uniqid();
					$this->email->from('indekos1234567890@gmail.com','Indekos Web');
					$this->email->to($this->input->post('email_konfirmasi_ulang'));
					$this->email->subject("Alamat Konfirmasi Akun");
					
					$message = "<p>Konfirmasi akun Anda untuk login sistem.</p>";
					$message .= "<p><a href='".base_url()."pemilik/confirm/$key'>Klik ini</a> untuk konfirmasi akun</p>";
					
					$this->email->message($message);
					
					if($this->login_m->konfirmasi_ulang($this->input->post('email_konfirmasi_ulang'),$key)){
						if($this->email->send()){
							echo "<script language=\"javascript\">alert('Konfirmasi akun terkirim ke email Anda. Cek Email Anda untuk konfirmasi akun.');document.location=\"".base_url()."\";</script>";
						}else{
							echo "<script language=\"javascript\">alert('Email konfirmasi gagal dikirim. kirim ulang.');document.location=\"".base_url()."\";</script>";
						}
					}else{
						echo "<script language=\"javascript\">alert('Gagal Kirim konfirmasi!');document.location=\"".base_url()."\";</script>";
					}
				}else{
					$p['email_konfrimasi_ulang'] = "<div class=\"alert alert-warning\">Email yang Anda masukan sudah terdaftar dengan status Aktif.</div>";
					$this->load->view('login',$p);
				}
			}else{
				$data['email_konfrimasi_ulang'] = "<div class=\"alert alert-error\">Email tidak ditemukan dalam database.</div>";
				$this->load->view('login',$data);
			}
		}else{
			$this->load->view('login',$data);
		}
	}
	
	public function lupa_password(){
		$this->load->library('form_validation');
		$this->load->model('login_m');
		$this->load->model('daerah_m');
		$query = $this->daerah_m->provinsi();
		$data['provinsi'] = $query;
		
		$this->form_validation->set_rules('email_lupa_password','Email','required|trim|');
		if($this->form_validation->run()){
			if($this->login_m->cek_email($this->input->post('email_lupa_password'))->num_rows()==1){
			/*$key = md5(uniqid());
				$to=$this->input->post('email_lupa_password');
				$subject ="Pemulihan Password";
				
				$message = "<p>Pemulihan atas password Anda.</p>";
				$message .= "<p><a href='".base_url()."pemilik/recovery_password/$key'>Klik ini</a> untuk memulihkan password Anda.</p>";
				
				if($this->login_m->lupa_password($this->input->post('email_lupa_password'),$key)){
					if(mail($to,$subject,$message)){
						echo "<script language=\"javascript\">alert('Alamat untuk memulihkan akun sudah terkirim keemail Anda. Cek email Anda.');document.location=\"".base_url()."\";</script>";
					}else{
						echo "<script language=\"javascript\">alert('Alamat pemulihan gagal dikirim keemail Anda.');document.location=\"".base_url()."\";</script>";
					}
				}else{
					echo "<script language=\"javascript\">alert('Gagal memulihkan password Anda.');document.location=\"".base_url()."\";</script>";
				}*/
				$this->load->library('email',array('mailtype'=>'html'));
				$key = md5(uniqid());
				$this->email->from('indekos1234567890@gmail.com','Indekos Web');
				$this->email->to($this->input->post('email_lupa_password'));
				$this->email->subject("Pemulihan Password");
				
				$message = "<p>Pemulihan atas password Anda.</p>";
				$message .= "<p><a href='".base_url()."pemilik/recovery_password/$key'>Klik ini</a> untuk memulihkan password Anda.</p>";
				
				$this->email->message($message);
				
				if($this->login_m->lupa_password($this->input->post('email_lupa_password'),$key)){
					if($this->email->send()){
						echo "<script language=\"javascript\">alert('Alamat untuk memulihkan akun sudah terkirim keemail Anda. Cek email Anda.');document.location=\"".base_url()."\";</script>";
					}else{
						echo "<script language=\"javascript\">alert('Alamat pemulihan gagal dikirim keemail Anda.');document.location=\"".base_url()."\";</script>";
					}
				}else{
					echo "<script language=\"javascript\">alert('Gagal memulihkan password Anda.');document.location=\"".base_url()."\";</script>";
				}
				

			}else{
				$data['email_lupa_password'] = "<div class=\"alert alert-error\">Email tidak ditemukan dalam database.</div>";
				$this->load->view('login',$data);
			}
		}else{
			$this->load->view('login',$data);
		}
	}
	
}

