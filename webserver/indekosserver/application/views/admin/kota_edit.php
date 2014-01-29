<?php $this->load->view('header'); 
	if($get_kota->num_rows()==0){
		echo "<script>alert('Data tidak ditemukan');document.location=\"".base_url()."admin/provinsi\";</script>";
	} 
	foreach($get_kota->result() as $k);?>
	<script>
		function newWindow(file,window) {
			msgWindow=open(file,window,'resizable=no,location=0,status=1,scrollbars=1, width=900,height=500');
			if (msgWindow.opener == null) msgWindow.opener = self;
		}
	</script>
	<div class="span4">
		<section>
			<div class="page-header">
				<h4>Edit Kota</h4>
			</div>
			<form class="form-vertical" method="post" name="kab_kota" action="<?php echo base_url().'admin/kota_ubah';?>">
				<table class="table table-striped">
					<thead>
						<tr>
						  <th style="width:25%;">NAMA</th>
						  <th style="width:75%;text-align:center;">ISI</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><label class="control-label" for="kab_kota_kode">KODE</label></td>
							<td><input type="hidden" name="provinsi_id"value="<?php echo $k->provinsi_id;?>">
							<input type="hidden" name="kab_kota_id"value="<?php echo $k->kab_kota_id;?>">
							<input type="text" name="kab_kota_kode" id="kab_kota_kode" value="<?php echo $k->kab_kota_kode;?>" placeholder="KAB KOTA KODE" required>
							<?php echo form_error('kab_kota_kode');?></td>
						</tr>
						<tr>
							<td><label class="control-label" for="kab_kota_nama">NAMA</label></td>
							<td><input type="text" name="kab_kota_nama" id="kab_kota_nama" value="<?php echo $k->kab_kota_nama;?>" placeholder="KAB KOTA NAMA" required>
							<?php echo form_error('kab_kota_nama');?></td>
						</tr>
						<tr>
							<td><a href="#" onclick="javascript: newWindow('<?=base_url();?>admin/kota_peta_ubah/<?php echo $k->kab_kota_long;?>/<?php echo $k->kab_kota_lat;?>','window2')" class="btn btn-primary"><img src="<?php echo base_url().'assets/img/icons/36/maps.png';?>"></a>&nbsp;</td><td>
							<input type="text" name="kab_kota_long" value="<?php echo $k->kab_kota_long;?>" placeholder="LONGITUDE" class="input-small" required readonly> 
							<input type="text" name="kab_kota_lat" value="<?php echo $k->kab_kota_lat;?>" placeholder="LATITUDE" class="input-small" required readonly>
							<?php echo form_error('kab_kota_long');?></td>
						</tr>
						<tr>
							<td colspan="2"><input type="submit" class="btn btn-primary" name="submit" value="Simpan"/></td>
						</tr>
					</tbody>
				</table>
			</form>
		</section>
	</div>
	<div class="span8">
		<section>
			<div class="page-header">
				<h4>Provinsi <?php echo $provinsi_nama;?></h4>
			</div>
			<table class="table table-striped">
				<thead>
					<tr>
					  <th style="width:25%;text-align:center;">KODE</th>
					  <th style="width:40%;text-align:center;">KAB KOTA NAMA</th>
					  <th style="width:35%;text-align:center;">ACTION</th>
					</tr>
				</thead>
				<tbody>
					<?php
						foreach($kota as $data){
							echo"<tr>
								<td>$data->kab_kota_kode</td>
								<td>$data->kab_kota_nama</td>
								<td>
									<a href=\"".base_url()."admin/fasilitas_eksternal/$data->kab_kota_id\" class=\"btn btn-primary\">Eksternal</a> 
									<a href=\"".base_url()."admin/kota_edit/$data->provinsi_id/$data->kab_kota_id\" class=\"btn btn-primary\">Ubah</a> 
									<a href=\"".base_url()."admin/kota_hapus/$data->provinsi_id/$data->kab_kota_id\" onclick=\"return confirm('Yakin akan menghapus data ini?');\" class=\"btn btn-danger\">Hapus</a></td>
							</tr>";
						}
					?>
				</tbody>
			</table>
			<center></center>
		</section>
	</div>
<?php $this->load->view('footer'); ?>