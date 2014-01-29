<?php $this->load->view('header'); ?>
	<div class="control-group"></div>
	<div class="alert alert-warning">Alamat konfirmasi tidak terkirim keemail Anda. Kirim ulang konfirmasi keemail Anda. <a href="<?php echo base_url();?>">Kembali?</a></div>
	<div class="control-group"></div>
	<div class="well">
		<center>
			<h5>Kirim ulang alamat konfirmasi keemail Anda.</h5>
			<form action="<?php echo base_url().'login/kirim_konfirmasi_ulang';?>" method="post">
				<div class="input-append"><input type="email" class="input-large" name="email_konfirmasi_ulang"><button class="btn" type="submit">Kirim</button></div>
			</form>
		</center>
	</div>
<?php $this->load->view('footer'); ?>