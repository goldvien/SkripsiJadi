<?php

$this->load->view('header');
$this->load->view('menu');
foreach($kamar->result() as $data);?>
	<div class="span9">
		<section>
			<div class="page-header">
				<h1><a href="<?php echo base_url().'indekos/detail/'.$data->indekos_id;?>" class="btn btn-primary" ><img src="<?php echo base_url().'assets/img/icons/36/indekos_icon.png';?>"><br>INDEKOS</a>
					<a href="#" class="btn btn-primary" disabled readonly><img src="<?php echo base_url().'assets/img/icons/36/tambah_kamar.png';?>" disabled><br>ADD</a> DETAIL KAMAR</h1>
			</div>
			<?php if(isset($pesan)){echo $pesan;} ?>
			<form action="<?php echo base_url().'kamar/ubah_data';?>" method="post" name="kamar" enctype="multipart/form-data">
				
				<table class="table table-striped">
					<thead>
					<tr>
						<th style="width:30%">NAMA FIELD</th>
						<th style="width:40%">ISI FIELD</th>
						<th style="width:30%"></th>
					</tr>
					</thead><tbody>
					<tr><td>INDEKOS NAMA</td><td><input type="hidden" name="indekos_id" value="<?php echo $indekos_id; ?>"><input type="hidden" name="kamar_id" value="<?php echo $data->kamar_id; ?>"><input type="text" name="indekos_nama" class="input-xlarge" value="<?php echo $indekos_nama; ?>" readonly></td><td><?php echo form_error('indekos_id');?></td></tr>
					<tr><td>KAMAR NAMA</td><td><input type="text" value="<?php echo $data->kamar_nama;?>" name="kamar_nama" class="input-xlarge" required></td><td><?php echo form_error('kamar_nama');?></td></tr>
					<tr><td>KAMAR HARGA/(MIN KONTRAK)</td><td><input type="text" value="<?php echo $data->kamar_harga;?>" name="kamar_harga" class="input-xlarge" required></td><td><?php echo form_error('kamar_harga');?></td></tr>
					<tr><td>KAMAR ISI</td><td><select name="kamar_isi" class="span1">
						<?php 
						for($i = 1;$i<=10;$i++){
							if($i == $data->kamar_isi){
								echo "<option value=\"$i\" selected> $i</option>";
							}else{
								echo "<option value=\"$i\"> $i</option>";
							}
						}
						?>
					</select> . <span>ORANG</span></td><td><?php echo form_error('kamar_isi');?></td></tr>
					<tr><td>KAMAR UKURAN</td><td><input type="text" value="<?php echo $data->kamar_ukuran_panjang;?>" name="kamar_ukuran_panjang" class="span1" placeholder="PANJANG" maxlength="3" required /> . <input type="text" value="<?php echo $data->kamar_ukuran_lebar;?>" name="kamar_ukuran_lebar" class="span1" placeholder="LEBAR" maxlength="3" required /> . <select name="kamar_ukuran_jenis" class="span1">
						<?php if($data->kamar_ukuran_jenis == 'CM'){
								echo "<option value=\"CM\" selected>CM</option>
								<option value=\"M\">MTR</option>";
							}else{
								echo "<option value=\"CM\">CM</option>
								<option value=\"M\" selected>MTR</option>";
							}
						?>
					</select></td><td><?php echo form_error('kamar_ukuran_panjang'); echo form_error('kamar_ukuran_lebar'); echo form_error('kamar_ukuran_jenis');?></td></tr>
					<tr><td>KAMAR MINIMAL KONTRAK</td><td><select name="kamar_minimal_kontrak" class="span1">
						<?php 
						for($i = 1;$i<=99;$i++){
							if($i == $data->kamar_minimal_kontrak){
								echo "<option value=\"$i\" selected> $i</option>";
							}else{
								echo "<option value=\"$i\"> $i</option>";
							}
						}
						?>
					</select> . <select name="kamar_minimal_kontrak_jenis" class="span1">
						<?php
						if($data->kamar_minimal_kontrak_jenis=='BULAN'){
						echo "<option value=\"HARI\">HARI</option>
							<option value=\"BULAN\" selected>BULAN</option>
							<option value=\"TAHUN\">TAHUN</option>";
						}else if($data->kamar_minimal_kontrak_jenis=='TAHUN'){
						echo "<option value=\"HARI\">HARI</option>
							<option value=\"BULAN\">BULAN</option>
							<option value=\"TAHUN\" selected>TAHUN</option>";
						}else{
						?>
						<option value="HARI">HARI</option>
						<option value="BULAN">BULAN</option>
						<option value="TAHUN">TAHUN</option>
						<?php } ?>
					</select></td><td><?php echo form_error('kamar_minimal_kontrak');echo form_error('kamar_minimal_kontrak_jenis');?></td></tr>
					<tr><td>KAMAR FOTO</td><td><input type="hidden" name="nama_foto" value="<?php echo $data->kamar_foto;?>"><img style="width:250px;height:250px;max-width:500px;max-height:500px;" src="<?php echo base_url()."assets/images/$data->kamar_foto";?>" class="img-polaroid"></td><td></td></tr>
					<tr><td>KAMAR UBAH FOTO</td><td><input type="file" name="kamar_foto" class="input-xlarge"></td><td><?php if(isset($error_foto)){echo $error_foto;} ?></td></tr>
					<tr><td></td><td><input type="submit" name="submit" class="btn btn-primary" value="SIMPAN"/></td><td></td></tr>
				</tbody>
				</table>
			</form>
		</section>
	</div>
<?php $this->load->view('footer'); ?>