<?php $this->load->view('header'); ?>
	<div class="span3">
		<?php echo form_open('admin/validasi',array('class'=>'form-vertical'));
			//echo validation_errors();
		?>
			<div class="control-group"></div>
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
	<div class="span9">
		<div class="control-group"></div>
		<div class="controls" style="border-bottom:1px solid #ccc;" ><h5>SELAMAT DATANG ADMIN INDEKOS</h5></div>
	</div>
<?php $this->load->view('footer'); ?>