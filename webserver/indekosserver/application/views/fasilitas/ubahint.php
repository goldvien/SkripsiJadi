<?php $this->load->view('header'); foreach($internal->result() as $int); foreach($fasilitas->result() as $fasint);?>
	<div class="span4">
		<section>
			<div class="page-header">
				<h4>Tambah Fasilitas Internal</h4>
			</div>
			<form class="form-vertical" method="post" action="<?php echo base_url().'fasilitas/ubahinternal';?>">
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
							<td><input type="hidden" name="fasilitas_int_id"value="<?php echo $fasint->fasilitas_int_id;?>">
							<input type="text" name="fasilitas_int_nama" value="<?php echo $fasint->fasilitas_int_nama;?>" required>
							<?php echo form_error('fasilitas_int_nama');?></td>
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
				<h4><a href="<?php echo base_url();?>" class="btn btn-primary" ><img src="<?php echo base_url()."assets/img/icons/36/home.png";?>"><br>INDEKOS</a>
				Daftar Fasilitas internal</h4>
			</div>
			<table class="table table-striped">
				<thead>
					<tr><th style="width:65%;">Nama Fasilitas</th><th style="width:35%;">Action</th></tr>
				</thead>
				<tbody>
				<?php
					foreach($internal->result() as $data){
						echo"<tr><td>$data->fasilitas_int_nama</td><td>
						<a href=\"".base_url()."fasilitas/ubahint/$data->fasilitas_int_id\" class=\"btn btn-primary\">Ubah</a> 
						<a href=\"".base_url()."fasilitas/hapusint/$data->fasilitas_int_id\" onclick=\"return confirm('Yakin akan menghapus data ini?');\" class=\"btn btn-danger\">Hapus</a> </td></tr>";
					}
				?>
				</tbody>
			</table>
		</section>
	</div>
<?php $this->load->view('footer'); ?>