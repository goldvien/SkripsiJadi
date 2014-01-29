<?php $this->load->view('header'); ?>
	<div class="span4">
		<section>
			<div class="page-header">
				<h4>Tambah Provinsi</h4>
			</div>
			<form class="form-vertical" method="post" action="<?php echo base_url().'admin/provinsi_tambah';?>">
				<table class="table table-striped">
					<thead>
						<tr>
						  <th style="width:25%;">NAMA</th>
						  <th style="width:75%;text-align:center;">ISI</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><label class="control-label" for="provinsiKode">KODE</label></td>
							<td><input type="text" name="provinsi_kode" id="provinsiKode" placeholder="PROVINSI KODE" required><?php echo form_error('provinsi_kode');?></td>
						</tr>
						<tr>
							<td><label class="control-label" for="provinsiNama">NAMA</label></td>
							<td><input type="text" name="provinsi_nama" id="provinsiNama" placeholder="PROVINSI NAMA" required><?php echo form_error('provinsi_nama');?></td>
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
				<h4>Provinsi</h4>
			</div>
			<table class="table table-striped">
				<thead>
					<tr>
					  <th style="width:25%;text-align:center;">PROVINSI KODE</th>
					  <th style="width:45%;text-align:center;">PROVINSI NAMA</th>
					  <th style="width:30%;text-align:center;">ACTION</th>
					</tr>
				</thead>
				<tbody>
					<?php
						foreach($provinsi->result() as $data){
							echo"<tr>
								<td>$data->provinsi_kode</td>
								<td>$data->provinsi_nama</td>
								<td>
									<a href=\"".base_url()."admin/kota/$data->provinsi_id\" class=\"btn btn-primary\">Kota</a> 
									<a href=\"".base_url()."admin/provinsi_edit/$data->provinsi_id\" class=\"btn btn-primary\">Ubah</a> 
									<a href=\"".base_url()."admin/provinsi_hapus/$data->provinsi_id\" onclick=\"return confirm('Yakin akan menghapus data ini?');\" class=\"btn btn-danger\">Hapus</a></td>
							</tr>";
						}
					?>
				</tbody>
			</table>
			<center><?php echo $page;?></center>
		</section>
	</div>
<?php $this->load->view('footer'); ?>