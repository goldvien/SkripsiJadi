<?php
	$this->load->view('header');
	$this->load->view('menu'); ?>
	<div class="span9">
		<section>
			<div class="page-header">
				<h1><img src="<?php echo base_url().'assets/img/icons/36/password.png';?>" class="btn btn-primary" disabled> UBAH PASSWORD</h1>
			</div>
			<?php echo $pesan;?>
				<form method="post" action="<?php echo base_url().'pemilik/ubah_password';?>">
					<table class="table table-striped">
						<thead>
							<tr>
								<th style="width:30%">NAMA FIELD</th><th style="width:40%">ISI FIELD</th><th style="width:30%"></th>
							</tr>
						</thead>
						<tbody>
							<?php
							foreach($pemilik->result() as $data){
								echo "<tr><td>PEMILIK EMAIL</td><td><input type=\"hidden\" name=\"pemilik_id\" value=\"$data->pemilik_id\">
								<input type=\"text\" name=\"pemilik_email\" value=\"$data->pemilik_email\" class=\"input-xlarge\" readonly></td><td></td></tr>";
							}?>
							<tr><td>PASSWORD LAMA</td><td><input type="password" name="pemilik_password_lama" class="input-xlarge"></td><td><?php echo form_error('pemilik_password_lama');?></td></tr>
							<tr><td>PASSWORD BARU</td><td><input type="password" name="pemilik_password_baru" class="input-xlarge"></td><td><?php echo form_error('pemilik_password_baru');?></td></tr>
							<tr><td>PASSWORD KONFIRMASI</td><td><input type="password" name="pemilik_password_conf" class="input-xlarge"></td><td><?php echo form_error('pemilik_password_conf');?></td></tr>
							<tr><td></td><td><input type="submit" name="submit" class="btn btn-primary" value="SIMPAN"></td><td></td></tr>
						</tbody>
					</table>
				</form>
		</section>
	</div>
<?php $this->load->view('footer'); ?>