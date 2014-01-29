<?php

	$this->load->view('header');
	$this->load->view('menu'); foreach($detail as $data);?>
		<script>
			function newWindow(file,window) {
				msgWindow=open(file,window,'resizable=no,location=0,status=1,scrollbars=1, width=900,height=500');
				if (msgWindow.opener == null) msgWindow.opener = self;
			}
			
		</script>
		<div class="span9">
				<section>
					<div class="page-header">
						<h1>
							<a href="<?php echo base_url().'kamar/tambah_kamar/';echo $data->indekos_id;?>" class="btn btn-primary" title="Tambah Kamar"><img src="<?php echo base_url().'assets/img/icons/36/tambah_kamar.png';?>"><br>ADD</a> DETAIL INDEKOS</h1>
					</div>
					<?php if(isset($pesan)and ($pesan!='')){ echo $pesan; return false;} if(isset($psn)){echo $psn;}?>
					<form method="post" action="<?php echo base_url().'indekos/ubah_data';?>" name="indekos">
						<table class="table table-striped">
							<thead>
								<tr>
									<th style="width:30%">NAMA FIELD</th>
									<th style="width:40%">ISI FIELD</th>
									<th style="width:30%"></th>
								</tr>
							</thead><tbody>
							<?php
							
								$prov = $this->daerah_m->get_nama_provinsi($data->provinsi_id);
								$kota = $this->daerah_m->get_nama_kab_kota($data->kab_kota_id);
								//echo "<inputDisabled input here\" disabled>";
								echo "<tr><td>PROVINSI</td><td>
									<input name=\"indekos_id\" type=\"hidden\" value=\"$data->indekos_id\" readonly>
									<input name=\"provinsi_id\" type=\"hidden\" value=\"$data->provinsi_id\" readonly>
									<input name=\"provinsi_nama\"  class=\"input-xlarge\" type=\"text\" value=\"$prov\" readonly></td><td>".form_error('provinsi_id')."</td></tr>";
								echo "<tr><td>KOTA</td><td>
									<input name=\"kab_kota_id\" type=\"hidden\" value=\"$data->kab_kota_id\" readonly>
									<input name=\"kab_kota_nama\"  class=\"input-xlarge\" type=\"text\"value=\"$kota\" readonly></td><td>".form_error('kab_kota_id')."</td></tr>";
								echo "<tr><td>INDEKOS NAMA</td><td><input name=\"indekos_nama\"  class=\"input-xlarge\" type=\"text\" placeholder=\"$data->indekos_nama\" value=\"$data->indekos_nama\" required></td><td>".form_error('indekos_nama')."</td></tr>";
								
								echo "<tr><td>UNTUK</td><td><select name=\"indekos_untuk\">";
									if($data->indekos_untuk == 'LAKI'){
										echo "<option value=\"LAKI\" selected> LAKI</option>";
										echo "<option value=\"PEREMPUAN\"> PEREMPUAN</option>";
										echo "<option value=\"SEMUA\"> SEMUA</option>";
									}else if($data->indekos_untuk == 'PEREMPUAN'){
										echo "<option value=\"LAKI\"> LAKI</option>";
										echo "<option value=\"PEREMPUAN\" selected> PEREMPUAN</option>";
										echo "<option value=\"SEMUA\"> SEMUA</option>";
									}else{
										echo "<option value=\"LAKI\"> LAKI</option>";
										echo "<option value=\"PEREMPUAN\"> PEREMPUAN</option>";
										echo "<option value=\"SEMUA\" selected> SEMUA</option>";
									}
								echo "</td><td>".form_error('indekos_untuk')."</td></tr>";
								?>
								<tr><td>INDEKOS PETA</td>
								<td>
									<a href="#" onclick="javascript: newWindow('<?=base_url();?>indekos/ubah_indekos_peta/<?php echo $data->indekos_id;?>','window2')" class="btn btn-primary"><img src="<?php echo base_url().'assets/img/icons/36/maps.png';?>"></a>&nbsp;
									<input name="indekos_long" value="<?php echo $data->indekos_long;?>"  class="input-small" id="disabledInput" type="text" placeholder="LONGITUDE" readonly>&nbsp;
									<input name="indekos_lat" value="<?php echo $data->indekos_lat;?>" placeholder="LATITUDE"  class="input-small" id="disabledInput" type="text" readonly></td><td><?php echo form_error('indekos_long');?></td></tr>
								<?php
								echo "<tr><td>KETERANGAN</td><td><textarea name=\"indekos_keterangan\" class=\"input-xlarge\" rows=\"5\" required>$data->indekos_keterangan</textarea></td><td>".form_error('indekos_keterangan')."</td></tr>";
							
							?>
								<tr><td></td><td><input type="submit" name="submit" class="btn btn-primary" value="SIMPAN"/></td><td></td></tr>
							</tbody>
						</table>
					</form>
					<div class="page-header">
						<h1 id="daftar-kamar"><a href="<?php echo base_url().'kamar/tambah_kamar/';echo $data->indekos_id;?>" class="btn btn-primary" title="Tambah Kamar"><img src="<?php echo base_url().'assets/img/icons/36/tambah_kamar.png';?>"><br>ADD</a>
						DAFTAR KAMAR</h1>
					</div>
					<table class="table table-striped">
						<thead>
							<tr>
								<th style="width:15%;">NAMA</th>
								<th style="width:10%;">HARGA</th>
								<th style="width:10%;">KONTRAK</th>
								<th style="width:10%;">STATUS</th>
								<th style="width:30%;">ACTION</th>
								<th style="width:25%;">KONTRAK</th>
							</tr>
						</thead><tbody>
						<?php
						foreach($kamar as $kmr){
							echo "<tr>
								<td>$kmr->kamar_nama</td>
								<td>$kmr->kamar_harga</td>
								<td>$kmr->kamar_minimal_kontrak $kmr->kamar_minimal_kontrak_jenis</td>
								<td>".strtoupper($kmr->kamar_kontrak_status)."</td>";
								echo "<td><a href=\"".base_url()."kamar/lihat/$kmr->kamar_id\" class=\"btn btn-primary\">Lihat</a>
									<a href=\"".base_url()."fasilitas/internal/$kmr->indekos_id/$kmr->kamar_id\" class=\"btn btn-primary\">Fasilitas</a>
									<a href=\"".base_url()."kamar/hapus/$kmr->kamar_id\" onclick=\"return confirm('Yakin ingin menghapus kamar ini?');\" class=\"btn btn-danger\">Hapus</a></td>";
								if($kmr->kamar_kontrak_status=='kontrak'){
									?><td><a href="#perpanjang<?php echo $kmr->kamar_id;?>" role="button" class="btn btn-primary" data-toggle="modal">PERPANJANG</a>
										<div id="perpanjang<?php echo $kmr->kamar_id;?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
											<form method="post" action="<?php echo base_url().'kontrak/perpanjang';?>">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
													<h3 id="myModalLabel">Perpanjang kontrak kamar.</h3>
												</div>
												<div class="modal-body">
													<div class="control-group">
														<label class="control-label" for="sampaiTanggal">Sampai tanggal</label>
														<div class="controls">
															<input type="hidden" name="indekos_id" value="<?php echo $kmr->indekos_id;?>">
															<input type="hidden" name="kamar_id" value="<?php echo $kmr->kamar_id;?>">
															<input type="date" name="kamar_kontrak_sampai_tanggal" id="sampaiTanggal" placeholder="Tanggal" required>
														</div>
													</div>
												</div>
												<div class="modal-footer">
													<button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
													<button type="submit" class="btn btn-primary">Simpan</button>
												</div>
											</form>
										</div><?php echo " <a href=\"".base_url()."kontrak/hapus/$kmr->kamar_id\" onclick=\"return confirm('Yakin ingin hapus kontrak ini?');\" class=\"btn btn-danger\">BATAL</a></td>";
								}else{
								?><td><a href="#tambah<?php echo $kmr->kamar_id;?>" role="button" class="btn btn-primary" data-toggle="modal">KONTRAK BARU</a>
									<div id="tambah<?php echo $kmr->kamar_id;?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										<form method="post" action="<?php echo base_url().'kontrak/tambah';?>">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
												<h3 id="myModalLabel">Buat kontrak kamar.</h3>
											</div>
											<div class="modal-body">
												<div class="control-group">
													<label class="control-label" for="dariTanggal">Dari tanggal</label>
													<div class="controls">
														<input type="hidden" name="indekos_id" value="<?php echo $kmr->indekos_id;?>">
														<input type="hidden" name="kamar_id" value="<?php echo $kmr->kamar_id;?>">
														<input type="date" name="kamar_kontrak_dari_tanggal" id="dariTanggal" placeholder="Tanggal" required>
													</div>
												</div>
												<div class="control-group">
													<label class="control-label" for="sampaiTanggal">Sampai tanggal</label>
													<div class="controls">
														<input type="date" name="kamar_kontrak_sampai_tanggal" id="sampaiTanggal" placeholder="Tanggal" required>
														<?php echo form_error('kamar_kontrak_sampai_tanggal');?>
													</div>
												</div>
											</div>
											<div class="modal-footer">
												<button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
												<button type="submit" class="btn btn-primary">Simpan</button>
											</div>
										</form>
									</div><?php echo "</td>";
								}	
								echo "</tr>";
						}
						?>
						</tbody>
					</table>
				</section>
			</div>
	<?php $this->load->view('footer');

?>