<?php $this->load->view('header');
if($edit->num_rows()==0){
	echo "<script>alert('Data tidak ditemukan');document.location=\"".base_url()."admin/fasilitas_master\";</script>";
} 
foreach($edit->result() as $ubah);?>
<div class="span4">
		<section>
			<div class="page-header">
				<h4>Tambah Fasilitas Master</h4>
			</div>
			<form class="form-vertical" method="post" action="<?php echo base_url().'admin/fasilitas_master_ubah';?>" enctype="multipart/form-data">
				<table class="table table-striped">
					<thead>
						<tr>
						  <th style="width:25%;">NAMA</th>
						  <th style="width:75%;text-align:center;">ISI</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><label class="control-label" for="fasilitas_master_nama">NAMA</label></td>
							<td><input type="hidden" name="fasilitas_master_id" value="<?php echo $ubah->fasilitas_master_id;?>"/>
							<input type="text" name="fasilitas_master_nama" value="<?php echo $ubah->fasilitas_master_nama;?>" id="fasilitas_master_nama" placeholder="FASILITAS NAMA" required><?php echo form_error('fasilitas_master_nama');?></td>
						</tr>
						<tr>
							<td><label class="control-label" for="fasilitas_master_icon">ICON</label></td>
							<td><input type="hidden" name="fasilitas_master_icon" value="<?php echo $ubah->fasilitas_master_icon;?>"/>
							<img src="<?php echo base_url().'assets/images/icons/'.$ubah->fasilitas_master_icon;?>" class="img-polaroid" /></td>
						</tr>
						<tr>
							<td><label class="control-label" for="fasilitas_master_ubah">UBAH</label></td>
							<td><input type="file" name="userfile" id="fasilitas_master_ubah"></td>
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
				<h4>Fasilitas Master</h4>
			</div>
			<table class="table table-striped">
				<thead>
					<tr>
					  <th style="width:25%;text-align:center;">ICON</th>
					  <th style="width:45%;text-align:center;">FASILITAS NAMA</th>
					  <th style="width:30%;text-align:center;">ACTION</th>
					</tr>
				</thead>
				<tbody>
					<?php
					foreach($master->result() as $data){
						echo "<tr>
							<td><center><img src=\"".base_url()."assets/images/icons/$data->fasilitas_master_icon\" width=\"50\" height=\"50\" class=\"img-polaroid\"></center></td>
							<td>$data->fasilitas_master_nama</td>
							<td> 
							<a href=\"".base_url()."admin/fasilitas_master_edit/$data->fasilitas_master_id\" class=\"btn btn-primary\">Ubah</a> 
							<a href=\"".base_url()."admin/fasilitas_master_hapus/$data->fasilitas_master_id\" onclick=\"return confirm('Yakin akan menghapus data ini?')\" class=\"btn btn-danger\">Hapus</a></td>
						</tr>";
					}
					?>
				</tbody>
			</table>
			<center><?php echo $page; ?></center>
		</section>
	</div>
<?php $this->load->view('footer');?>