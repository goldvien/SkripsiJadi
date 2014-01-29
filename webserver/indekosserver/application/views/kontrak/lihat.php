<?php
$this->load->view('header');
$this->load->view('menu'); ?>
	<div class="span9">
		<section>
			<div class="page-header">
				<h1><a href="#" class="btn btn-primary disabled"><img src="<?php echo base_url().'assets/img/icons/36/kontrak_baru.png';?>"></a>
				KONTRAK KAMAR</h1>
			</div>
			<table class="table table-bordered">
				<thead>
					<tr>
					  <th style="width:20%;">NAMA INDEKOS</th>
					  <th style="width:15%;">KAMAR</th>
					  <th style="width:15%;">DARI</th>
					  <th style="width:15%;">SAMPAI</th>
					  <th style="width:35%;">ACTION</th>
					</tr>
				</thead>
				<tbody>
					<?php
						foreach($indekos->result() as $data){
							$kamar = $this->kontrak_m->cek_all($data->indekos_id);
							$kamar = $this->kontrak_m->get_all($data->indekos_id);
							$rows = $kamar->num_rows();
							echo "<tr><td rowspan=\"$rows\">$data->indekos_nama</td>";
							if($rows!=0){
								$no = 1;
								foreach($kamar->result() as $kamar){
									if($no==1){
										echo"<td>$kamar->kamar_nama</td><td>$kamar->kamar_kontrak_dari_tanggal</td><td>$kamar->kamar_kontrak_sampai_tanggal</td>";
									}else{
										echo"<tr><td>$kamar->kamar_nama</td><td>$kamar->kamar_kontrak_dari_tanggal</td><td>$kamar->kamar_kontrak_sampai_tanggal</td>";
									}
									echo"<td>";//<a href=\"\" class=\"btn btn-primary\">PERPANJANG</a>
									?><a href="#kamar<?php echo $kamar->kamar_id;?>" role="button" class="btn btn-primary" data-toggle="modal">PERPANJANG</a>
									<div id="kamar<?php echo $kamar->kamar_id;?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										<form method="post" action="<?php echo base_url().'kontrak/perpanjang';?>">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
												<h3 id="myModalLabel">Perpanjang kontrak kamar.</h3>
											</div>
											<div class="modal-body">
												<div class="control-group">
													<label class="control-label" for="sampaiTanggal">Sampai tanggal</label>
													<div class="controls">
														<input type="hidden" name="kamar_id" value="<?php echo $kamar->kamar_id;?>">
														<input type="date" name="kamar_kontrak_sampai_tanggal" id="sampaiTanggal" value="<?php echo $kamar->kamar_kontrak_sampai_tanggal;?>" placeholder="Tanggal" required>
													</div>
												</div>
											</div>
											<div class="modal-footer">
												<button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
												<button type="submit" class="btn btn-primary">Simpan</button>
											</div>
										</form>
									</div><?php echo "&nbsp;&nbsp;<a href=\"".base_url()."kontrak/hapus/$kamar->kamar_id\" onclick=\"return confirm('Yakin akan membatalkan kontrak?');\" class=\"btn btn-danger\">BATAL KONTRAK</a></td></tr>";
									$no++;
								}
							}else{
								echo "<td colspan=\"100\"><center><h5>Tidak ada kamar yang dikontrakan.</h5></center></td></tr>";
							}
						}
					?>
				</tbody>
			</table>
		</section>
	</div>
<?php $this->load->view('footer');?>