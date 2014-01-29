<?php $this->load->view('header'); foreach($kamar->result() as $kmr);?>
	<script>
		function newWindow(file,window) {
			msgWindow=open(file,window,'resizable=no,location=0,status=1,scrollbars=1, width=900,height=500');
			if (msgWindow.opener == null) msgWindow.opener = self;
		}
	</script>
	<div class="span4">
		<section>
			<div class="page-header">
				<h4>Tambah Fasilitas Internal</h4>
			</div>
			<form class="form-vertical" method="post" name="fasilitas_eks" action="<?php echo base_url().'fasilitas/internal_tambah';?>">
				<table class="table table-striped">
					<thead>
						<tr>
						  <th style="width:25%;">NAMA</th>
						  <th style="width:75%;text-align:center;">ISI</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><label class="control-label" for="kab_kota_nama">FASILITAS</label></td>
							<td><input type="hidden" name="pemilik_id"value="<?php echo $pemilik_id;?>">
							<input type="hidden" name="indekos_id"value="<?php echo $indekos_id;?>">
							<input type="hidden" name="kamar_id"value="<?php echo $kamar_id;?>">
							<input type="text" name="fasilitas_int_nama" required>
							<?php echo form_error('fasilitas_int_nama');?></td>
						</tr>
						<tr>
							<td colspan="2"><input type="submit" class="btn btn-primary" name="submit" value="Simpan"/></td>
						</tr>
					</tbody>
				</table>
			</form>
		</section>
		<section>
			<div class="page-header">
				<h4>Tambah Fasilitas kamar <?php echo $kmr->kamar_nama;?></h4>
			</div>
			<form class="form-vertical" method="post" name="fasilitas_eks" action="<?php echo base_url().'fasilitas/kamar_internal_tambah';?>">
				<table class="table table-striped">
					<thead>
						<tr>
							<th style="width:75%;">
								<input type="hidden" name="indekos_id"value="<?php echo $indekos_id;?>">
								<input type="hidden" name="kamar_id"value="<?php echo $kamar_id;?>">NAMA</th>
						</tr>
					</thead>
					<tbody>
						<?php
						foreach($pemilik_fasilitas->result() as $fasilitas){
							if($this->fasilitas_m->cek_kamar_fasilitas($fasilitas->fasilitas_int_id,$kamar_id)->num_rows()==1){$checked="checked";}else{$checked="";}
							echo"<tr>
								<td><label class=\"checkbox\"><input type=\"checkbox\" name=\"fasilitas_int_id[$fasilitas->fasilitas_int_id]\" value=\"$fasilitas->fasilitas_int_id\" $checked> $fasilitas->fasilitas_int_nama</label></td>
							</tr>";
						}
						?>
						<tr>
							<td><input type="submit" class="btn btn-primary" name="submit" value="Simpan"/></td>
						</tr>
					</tbody>
				</table>
			</form>
		</section>
	</div>
	
	<div class="span8">
		<section>
			<div class="page-header">
				<h4><a href="<?php echo base_url()."indekos/detail/$indekos_id";?>" class="btn btn-primary" ><img src="<?php echo base_url()."assets/img/icons/36/indekos_icon.png";?>"><br>INDEKOS</a>
				<?php echo $kmr->indekos_nama." | ".$kmr->kamar_nama;?> | Daftar Fasilitas kamar</h4>
			</div>
			<table class="table table-striped">
				<thead>
					<tr><th>Nama Fasilitas</th><th>Hapus</th></tr>
				</thead>
				<tbody>
				<?php
				if($kamar_fasilitas_int->num_rows()==0){echo"<tr><td colspan=\"2\"><center>Tidak memiliki fasilitas.</center></td></tr>";}else{
					foreach($kamar_fasilitas_int->result() as $kamar){
						echo"<tr><td>$kamar->fasilitas_int_nama</td><td><a href=\"".base_url()."fasilitas/internal_hapus/$indekos_id/$kamar_id/$kamar->kamar_fasilitas_int_id\" class=\"btn btn-danger\" onclick=\"return confirm('Yakin akan menghapus data ini?');\">Hapus</a></td></tr>";
					}
				}
				?>
				</tbody>
			</table>
		</section>
	</div>
<?php $this->load->view('footer'); ?>