<?php $this->load->view('header'); ?>
	<script>
		function newWindow(file,window) {
			msgWindow=open(file,window,'resizable=no,location=0,status=1,scrollbars=1, width=900,height=500');
			if (msgWindow.opener == null) msgWindow.opener = self;
		}
		
	</script>
	<div class="span4">
		<section>
			<div class="page-header">
				<h4>Tambah Kota</h4>
			</div>
			<form class="form-vertical" method="post" name="kab_kota" action="<?php echo base_url().'admin/kota_tambah';?>">
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
							<td><input type="hidden" name="provinsi_id"value="<?php echo $provinsi_id;?>"><input type="text" name="kab_kota_kode" id="kab_kota_kode" placeholder="KAB KOTA KODE" required>
							<?php echo form_error('kab_kota_kode');?></td>
						</tr>
						<tr>
							<td><label class="control-label" for="kab_kota_nama">NAMA</label></td>
							<td><input type="text" name="kab_kota_nama" id="kab_kota_nama" placeholder="KAB KOTA NAMA" required>
							<?php echo form_error('kab_kota_nama');?></td>
						</tr>
						<tr>
							<td><a href="#" onclick="javascript: newWindow('<?=base_url();?>admin/kota_peta','window2')" class="btn btn-primary"><img src="<?php echo base_url().'assets/img/icons/36/maps.png';?>"></a>&nbsp;</td><td>
							<input type="text" name="kab_kota_long" value="0" placeholder="LONGITUDE" class="input-small" required readonly> 
							<input type="text" name="kab_kota_lat" value="0" placeholder="LATITUDE" class="input-small" required readonly>
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
						if($rows_kota == 0){
							echo "<tr><td colspan=\"3\"><center>Provinsi tidak ditemukan, tidak ada kota.</center></td></tr>";
						}else{
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
						}
					?>
				</tbody>
			</table>
			<center></center>
		</section>
	</div>
<?php $this->load->view('footer'); ?>