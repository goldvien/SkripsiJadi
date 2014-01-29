<?php
$this->load->view('header');
$this->load->view('menu');
 ?>
	<div class="span9">
		<section>
			<div class="page-header">
				<h1><a href="<?php echo base_url().'indekos/lihat';?>" class="btn btn-primary"><img src="<?php echo base_url().'assets/img/icons/36/indekos_icon.png';?>"><br>INDEKOS</a>
				FASILITAS <?php echo strtoupper($indekos_nama);?></h1>
			</div>
			<form method="post" action="<?php echo base_url().'fasilitas/eksternal_tambah';?>">
				<input type="hidden" name="indekos_id" value="<?php echo $indekos_id;?>">
				<div class="accordion" id="accordion2">
				<?php foreach($this->fasilitas_m->master()->result() as $data){ ?>
					<div class="accordion-group">
						<div class="accordion-heading">
							<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#eksternal<?php echo $data->fasilitas_master_nama;?>"><?php echo $data->fasilitas_master_nama;?></a>
						</div>
						<div id="eksternal<?php echo $data->fasilitas_master_nama;?>" class="accordion-body collapse">
						  <div class="accordion-inner">
							<?php
							foreach($this->fasilitas_m->eksternal($this->session->userdata('email'),$data->fasilitas_master_id)->result() as $eksternal){
								if($this->indekos_m->cek_fasilitas_eks($indekos_id,$eksternal->fasilitas_eks_id)){$checked = "checked";}else{$checked ="";}
								echo "<label class=\"checkbox\">
									<h6><input type=\"checkbox\" name=\"fasilitas_eks_id[$eksternal->fasilitas_eks_id]\" value=\"$eksternal->fasilitas_eks_id\" $checked> $eksternal->fasilitas_eks_nama</h6>
								</label>";
								//echo"<input type=\"checkbox\" >$eksternal->fasilitas_eks_nama";
							}
							?>
						  </div>
						</div>
					</div>
				<?php } ?>
				</div>
				<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
			</form>
			<div class="page-header">
				<h4>Daftar Fasilitas Indekos yang sudah ada.</h4>
			</div>
			<div>
				<table class="table table-striped">
					<thead>
						<tr><th style="width:10%">Icon</th><th style="width:65%">Fasilitas Eksternal</th><th style="width:25%">Action</th></tr>
					</thead>
					<tbody>
					<?php
					if($indekos_fasilitas_eks->num_rows()>0){
						foreach($indekos_fasilitas_eks->result() as $data){
							echo"<tr><td><img src=\"".base_url()."assets/images/icons/$data->fasilitas_master_icon\" class=\"img-polaroid\"></td>
							<td>$data->fasilitas_eks_nama</td>
							<td><a href=\"".base_url()."fasilitas/eksternal_hapus/$data->indekos_id/$data->fasilitas_eks_id\" class=\"btn btn-danger\" onclick=\"return confirm('Yakin akan menghapus data ini?');\">Hapus</a></td></tr>";
						}
					}else{
						echo"<tr><td colspan=\"3\"><center>Belum memiliki Fasilitas</center></td></tr>";
					}
					?>
					</tbody>
				</table>
			</div>
		</section>
	</div>
<?php $this->load->view('footer'); ?>