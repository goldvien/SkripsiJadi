<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Sistem Indekos</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="<?php echo base_url(); ?>/assets/css/bootstrap.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>/assets/css/bootstrap-responsive.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>/assets/css/docs.css" rel="stylesheet">

    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url().'/assets/img/icons/96/aplikasi.png';?>">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url().'/assets/img/icons/72/aplikasi.png';?>">
	<link rel="apple-touch-icon-precomposed" href="<?php echo base_url().'/assets/img/icons/48/aplikasi.png';?>">
	<link rel="shortcut icon" href="<?php echo base_url().'/assets/img/icons/36/aplikasi.png';?>">
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="assets/js/html5shiv.js"></script>
    <![endif]-->

</head>
<body data-twttr-rendered="true" data-spy="scroll" data-target=".bs-docs-sidebar">
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
			<?php if($this->session->userdata('admin_login')){?>
			<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<?php // } ?>
          <a class="brand" href="<?php echo base_url().'admin/home';?>">SISTEM INDEKOS</a>
			<div class="nav-collapse collapse">
				<?php // if($this->session->userdata('admin_login')){?>
				<ul class="nav">
					<li class=""> <a href="<?php echo base_url().'admin/home';?>">Home</a> </li>
					<li class=""><a href="<?php echo base_url().'admin/provinsi';?>">Provinsi</a></li>
					<li class=""><a href="<?php echo base_url().'admin/fasilitas_master';?>">Fasilitas Master</a></li>
					<li class=""><a href="<?php echo base_url().'admin/logout';?>">Logout</a></li>
				</ul>
				<?php }else{ ?>
			<a class="brand" href="<?php echo base_url();?>">SISTEM INDEKOS</a>
			<div class="nav-collapse collapse">
				<?php } ?>
			</div>
        </div>
      </div>
    </div>
	<div class="container">
		<?php
		/*	echo "<pre>";
			print_r($this->session->all_userdata());
			echo "</pre>"; */
		?>
		<div class="span3">
			<?php echo form_open('login/login_validasi',array('class'=>'form-vertical'));
				//echo validation_errors();
			?>
				<div class="control-group">
				</div>
				<div class="controls" style="border-bottom:1px solid #ccc;" ><h5>LOGIN</h5></div>
				<div class="control-group">
					<label class="control-label" for="inputEmail">Email</label>
					<div class="controls">
						<?php $dataEmail = array(
							'id'			=> 'inputEmail',
							'placeholder'	=> 'Email',
							'type'			=> 'email',
							'name'			=> 'email'
						);
						echo form_input($dataEmail);?></div>
					<label class="control-label"><?php echo form_error('email');?></label>
				</div>
				<div class="control-group">
					<label class="control-label" for="inputPass">Password</label>
					<div class="controls">
						<?php $dataPass = array(
							'id'			=> 'inputPass',
							'placeholder'	=> 'Password',
							'name'			=> 'password'
						);
						echo form_password($dataPass);?></div>
					<label class="control-label"><?php echo form_error('password');?></label>
				</div>
				<div class="control-group">
					<div class="controls"><input type="submit" class="btn" value="login"></div>
				</div>
			<?php echo form_close();?>
		</div>
		<div class="span4" style="border-left:1px solid #ccc;border-right:1px solid #ccc;padding-right:15px;padding-left:30px;">
			<?php echo form_open('login/daftar',array('class'=>'form-vertical'));
				//echo validation_errors();
			?>
				<div class="control-group">
				</div>
				<div class="controls" style="border-bottom:1px solid #ccc;"><h5>DAFTAR</h5></div>
				<div class="control-group">
					<label class="control-label" for="inputProvinsi">Provinsi</label>
					<div class="controls">
						<select name="provinsi_id" id="inputProvinsi">
							<option value="">PILIH PROVINSI</option>
							<?php
								foreach($provinsi as $data){
									echo "<option value=\"$data->provinsi_id\">$data->provinsi_nama</option>";
								}
							?>
						</select>
					</div>
					<label class="control-label"><?php echo form_error('provinsi_id');?></label>
				</div>
				<div class="control-group">
					<label class="control-label" for="inputDftEmail">Email</label>
					<div class="controls">
						<?php $dataEmail = array(
							'id'			=> 'inputDftEmail',
							'placeholder'	=> 'Email',
							'type'			=> 'email',
							'name'			=> 'dftemail'
						);
						echo form_input($dataEmail);?></div>
					<label class="control-label"><?php echo form_error('dftemail');?></label>
				</div>
				<div class="control-group">
					<label class="control-label" for="inputDftPass">Password</label>
					<div class="controls">
						<?php $dataPass = array(
							'id'			=> 'inputDftPass',
							'placeholder'	=> 'Password',
							'name'			=> 'dftpassword'
						);
						echo form_password($dataPass);?></div>
					<label class="control-label"><?php echo form_error('dftpassword');?></label>
				</div>
				<div class="control-group">
					<label class="control-label" for="inputCPass">Confirm Password</label>
					<div class="controls">
						<?php $dataPass = array(
							'id'			=> 'inputCPass',
							'placeholder'	=> 'Confirm Password',
							'name'			=> 'cpassword'
						);
						echo form_password($dataPass);?></div>
					<label class="control-label"><?php echo form_error('cpassword');?></label>
				</div>
				<div class="control-group">
					<div class="controls"><input type="submit" class="btn" value="Daftar"></div>
				</div>
			<?php echo form_close();?>
		</div>
		<div class="span3">
			<h5><p>Alamat konfirmasi tidak terkirim?<br>Kirim ulang konfirmasi keemail Anda.</p></h5>
				<form action="<?php echo base_url().'login/kirim_konfirmasi_ulang';?>" method="post">
					<div class="input-append"><input type="email" class="input-large" name="email_konfirmasi_ulang"><button class="btn" type="submit">Kirim</button></div>
					<?php echo form_error('email_konfirmasi_ulang');?>
					<?php if(isset($email_konfrimasi_ulang)){echo $email_konfrimasi_ulang;} ?>
				</form>
		</div>
		<div class="span3">
				<div class="controls" style="border-top:1px solid #ccc;"><h5>LUPA PASSWORD?</h5></div>
				<form action="<?php echo base_url().'login/lupa_password';?>" method="post">
					<div class="input-append"><input type="email" class="input-large" name="email_lupa_password"><button class="btn" type="submit">Kirim</button></div>
					<?php echo form_error('email_lupa_password');?>
					<?php if(isset($email_lupa_password)){echo $email_lupa_password;} ?>
				</form>
		</div>
	</div>
	<footer class="footer">
      <div class="container">
        <p>Copyright &copy; Sistem Indekos Wafi</p>
      </div>
    </footer>
</body>
</html>