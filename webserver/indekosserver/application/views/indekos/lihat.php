<?php $this->load->view('header');
	$this->load->view('menu'); ?>
			<div class="span9">
				<section>
					<div class="page-header">
						<h1><a href="<?php echo base_url().'indekos/tambah';?>" class="btn btn-primary" title="Tambah Indekos"><img src="<?php echo base_url().'assets/img/icons/36/tambah_indekos.png';?>"><br>ADD</a>
						INDEKOS</h1>
					</div>
					<?php echo $pesan;?>
					<table class="table table-striped">
						<thead>
							<tr>
							  <th style="width:35%;">NAMA INDEKOS</th>
							  <th style="width:15%;text-align:center;">UNTUK</th>
							  <th style="width:15%;text-align:center;">KAMAR</th>
							  <th style="width:35%;text-align:center;">ACTION</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$this->load->model('kamar_m');
								if($indekos_total==0){
									echo "<tr>
										<td colspan=\"4\"><center><h4>Data indekos masih kosong<br>
											<a href=\"".base_url()."indekos/tambah\" class=\"btn btn-primary\" title=\"Tambah Indekos\"\>
												<img src=\"".base_url()."assets/img/icons/36/tambah_indekos.png\"><br>ADD
											</a></h4></center>
										</td>
									</tr>";
								}else{
									foreach($indekos as $data){
										echo "<tr>";
										echo "<td>".$data->indekos_nama."</td>";
										echo "<td style=\"text-align:center;\">".$data->indekos_untuk."</td>";
										echo "<td style=\"text-align:center;\">".$this->kamar_m->get_total_kamar($data->indekos_id)."</td>";
										echo "<td style=\"text-align:center;\">
											<a href=\"".base_url()."indekos/detail/$data->indekos_id\" class=\"btn btn-primary\">Lihat</a>
											<a href=\"".base_url()."fasilitas/eksternal/$data->indekos_id\" class=\"btn btn-primary\">Eksternal</a>
											<a href=\"".base_url()."indekos/hapus/$data->indekos_id\" class=\"btn btn-danger\" onClick=\"return confirm('Anda yakin akan menghapus kamar ini?');\">Hapus</a>
											</td>";
										echo "</tr>";
									}
								}
							?>
						</tbody>
					</table>
					<center><?php echo $page;?></center>
				</section>
			</div>
<?php $this->load->view('footer'); ?>