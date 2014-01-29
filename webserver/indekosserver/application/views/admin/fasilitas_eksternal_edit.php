<?php $this->load->view('header'); 
	if($edit->num_rows()==0){
		echo "<script>alert('Data tidak ditemukan');document.location=\"".base_url()."admin/fasilitas_eksternal\";</script>";
	} 
	foreach($edit->result() as $ubah);?>
	<script>
		function newWindow(file,window) {
			msgWindow=open(file,window,'resizable=no,location=0,status=1,scrollbars=1, width=900,height=500');
			if (msgWindow.opener == null) msgWindow.opener = self;
		}
	</script>
	<div class="span4">
		<section>
			<div class="page-header">
				<h4>Edit Fasilitas Eksternal</h4>
			</div>
			<form class="form-vertical" method="post" name="fasilitas_eks" action="<?php echo base_url().'admin/fasilitas_eksternal_ubah';?>">
				<table class="table table-striped">
					<thead>
						<tr>
						  <th style="width:25%;">NAMA</th>
						  <th style="width:75%;text-align:center;">ISI</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><label class="control-label" for="kab_kota_nama">KOTA</label></td>
							<td><input type="hidden" name="fasilitas_eks_id"value="<?php echo $ubah->fasilitas_eks_id;?>">
							<input type="hidden" name="kab_kota_id"value="<?php echo $ubah->kab_kota_id;?>">
							<input type="text" name="kab_kota_nama" id="kab_kota_nama" value="<?php echo $kab_kota_nama;?>" readonly>
							<?php echo form_error('kab_kota_nama');?></td>
						</tr>
						<tr>
							<td>Master</td>
							<td><select name="fasilitas_master_id" required>
								<option value=""> FASILITAS MASTER</option>
								<?php 
								foreach($this->fasilitas_m->master()->result() as $data){
									if($ubah->fasilitas_master_id == $data->fasilitas_master_id){
										echo"<option value=\"$data->fasilitas_master_id\" selected> $data->fasilitas_master_nama</option>";
									}else{
										echo"<option value=\"$data->fasilitas_master_id\"> $data->fasilitas_master_nama</option>";
									}
								}
								?>
							</select></td>
						</tr>
						<tr>
							<td><label class="control-label" for="fasilitas_eks_nama">NAMA</label></td>
							<td><input type="text" name="fasilitas_eks_nama" value="<?php echo $ubah->fasilitas_eks_nama;?>" id="fasilitas_eks_nama" placeholder="FASILITAS NAMA" required>
							<?php echo form_error('fasilitas_eks_nama');?></td>
						</tr>
						<tr>
							<td><a href="#" onclick="javascript: newWindow('<?=base_url();?>admin/fasilitas_eksternal_peta_edit/<?php echo $ubah->fasilitas_eks_long;?>/<?php echo $ubah->fasilitas_eks_lat;?>','window2')" class="btn btn-primary"><img src="<?php echo base_url().'assets/img/icons/36/maps.png';?>"></a>&nbsp;</td><td>
							<input type="text" name="fasilitas_eks_long" value="<?php echo $ubah->fasilitas_eks_long;?>" placeholder="LONGITUDE" class="input-small" required readonly> 
							<input type="text" name="fasilitas_eks_lat" value="<?php echo $ubah->fasilitas_eks_lat;?>" placeholder="LATITUDE" class="input-small" required readonly>
							<?php echo form_error('fasilitas_eks_long');?></td>
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
				<h4><?php echo $kab_kota_nama;?> | Fasilitas Eksternal</h4>
			</div>
			<div class="accordion" id="accordion2">
				<?php foreach($this->fasilitas_m->master()->result() as $data){ ?>
					<div class="accordion-group">
						<div class="accordion-heading">
							<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#eksternal<?php echo $data->fasilitas_master_nama;?>"><?php echo $data->fasilitas_master_nama;?></a>
						</div>
						<div id="eksternal<?php echo $data->fasilitas_master_nama;?>" class="accordion-body collapse">
						  <div class="accordion-inner">
							
							<?php
							foreach($this->fasilitas_m->get_fasilitas_eksternal($kab_kota_id,$data->fasilitas_master_id)->result() as $eksternal){
								echo "<label class=\"checkbox\">$eksternal->fasilitas_eks_nama | 
								<a href=\"".base_url()."admin/fasilitas_eksternal_edit/$eksternal->kab_kota_id/$eksternal->fasilitas_eks_id\" class=\"btn btn-primary\">Ubah</a> | 
								<a href=\"".base_url()."admin/fasilitas_eksternal_hapus/$eksternal->kab_kota_id/$eksternal->fasilitas_eks_id\" class=\"btn btn-danger\" onclick=\"return confirm('Yakin akan menghapus data ini?')\">Delete</a></label>";
							} ?>
						  </div>
						 
						</div>
					</div>
				<?php } ?>
			</div>
		</section>
	</div>
<?php $this->load->view('footer'); ?>