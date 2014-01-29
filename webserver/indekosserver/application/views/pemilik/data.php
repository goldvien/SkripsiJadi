<?php  

$this->load->view('header');
$this->load->view('menu_disabled'); ?>
		<script>
			function newWindow(file,window) {
				msgWindow=open(file,window,'resizable=no,location=0,status=1,scrollbars=1, width=900,height=500');
				if (msgWindow.opener == null) msgWindow.opener = self;
			}
			
		</script>
			<div class="span9">
				<section>
					<div class="page-header">
						<h1><img src="<?php echo base_url().'assets/img/icons/36/profil_pemilik.png';?>" class="btn btn-primary" disabled> LENGKAPI DATA PRIBADI ANDA.</h1>
					</div>
					<?php // echo $pesan;?>
					<form name="data_pribadi" method="post" action="<?php echo base_url().'pemilik/update_data';?>">
						<table class="table table-striped">
							<thead>
								<tr>
									<th style="width:30%;">NAMA FIELD</th>
									<th style="width:40%;">ISI FIELD</th>
									<th style="width:30%;"></th>
								</tr>
							</thead>
							<tbody>
								<?php 
									foreach($pribadi as $data){
										$this->load->model('daerah_m');
										$kota = $this->daerah_m->kota($data->provinsi_id);
										$nama = $this->daerah_m->get_nama_provinsi($data->provinsi_id);
										
										echo "<tr><td>PEMILIK EMAIL</td><td><input name=\"pemilik_id\" type=\"hidden\" value=\"$data->pemilik_id\">
										<input name=\"pemilik_email\" type=\"text\" class=\"input-xlarge\" value=\"$data->pemilik_email\" readonly></td><td>".form_error('pemilik_email').form_error('pemilik_id')."</td></tr>";
										echo "<tr><td>PROVINSI</td><td><input name=\"provinsi_id\" type=\"text\" class=\"input-xlarge\" value=\"$nama\" readonly></td><td>".form_error('provinsi_id')."</td></tr>";
										echo "<tr><td>KOTA</td>
											<td>
												<select name=\"kab_kota_id\" required>
													<option value=\"\"> PILIH KOTA ANDA </option>";
													foreach($kota as $kab_kota){
													echo "<option value=\"$kab_kota->kab_kota_id\"> $kab_kota->kab_kota_nama</option>";
													}
												echo "</select>
											</td><td>".form_error('kab_kota_id')."</td></tr>";
										echo "<tr><td>PEMILIK NAMA</td><td><input name=\"pemilik_nama\" type=\"text\" class=\"input-xlarge\" value=\"$data->pemilik_nama\" required></td><td>".form_error('pemilik_nama')."</td></tr>";
										echo "<tr><td>PEMILIK NO HP</td><td><input name=\"pemilik_no_hp\" type=\"text\" class=\"input-xlarge\" value=\"$data->pemilik_no_hp\" required></td><td>".form_error('pemilik_no_hp')."</td></tr>";
										echo "<tr><td>PEMILIK PETA RUMAH</td>
											<td>
											<a href=\"#\" onclick=\"javascript: newWindow('".base_url()."pemilik/peta_rumah_long_lat_kota','window2')\" class=\"btn btn-primary\"><img src=\"".base_url()."assets/img/icons/36/maps.png\"></a>&nbsp;
											<input name=\"pemilik_rumah_long\" value=\"119.970703125\"  class=\"input-small\" id=\"disabledInput\" type=\"text\" placeholder=\"LONGITUDE\" readonly>&nbsp;
											<input name=\"pemilik_rumah_lat\" value=\"-4.653079918274038\" placeholder=\"LATITUDE\"  class=\"input-small\" id=\"disabledInput\" type=\"text\" readonly></td><td>".form_error('pemilik_rumah_long')."</td>";
										echo "<tr><td>PEMILIK ALAMAT</td><td><textarea rows=\"5\" name=\"pemilik_alamat\" class=\"input-xlarge\" required>$data->pemilik_alamat</textarea></td><td>".form_error('pemilik_alamat')."</td></tr>";
										echo "<tr><td></td><td><input type=\"submit\" name=\"submit\" class=\"btn btn-primary\" value=\"SIMPAN\"></td><td></td></tr>";
									}
								?>
							</tbody>
						</table>
					</form>
				</section>
			</div>
<?php $this->load->view('footer');?>