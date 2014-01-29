<?php

	$this->load->view('header');
	$this->load->view('menu'); ?>
		<script>
			function newWindow(file,window) {
				msgWindow=open(file,window,'resizable=no,location=0,status=1,scrollbars=1, width=900,height=500');
				if (msgWindow.opener == null) msgWindow.opener = self;
			}
			
		</script>
		<div class="span9">
				<section>
					<div class="page-header">
						<h1><a href="<?php echo base_url().'indekos/lihat';?>" class="btn btn-primary" title="Kembali"><img src="<?php echo base_url().'assets/img/icons/36/back.png';?>"><br>BACK</a>
						TAMBAH INDEKOS</h1>
					</div>
					<form action="<?php echo base_url().'indekos/tambah_proses';?>" method="post" name="indekos">
						<table class="table table-striped">
							<thead>
							<tr>
								<th style="width:30%">NAMA FIELD</th>
								<th style="width:40%">ISI FIELD</th>
								<th style="width:30%"></th>
							</tr>
							</thead><tbody>
							<?php
								foreach($daerah->result() as $data);
								$prov = $this->daerah_m->get_nama_provinsi($data->provinsi_id);
								$kota = $this->daerah_m->get_nama_kab_kota($data->kab_kota_id);
								$long_lat_kota = $this->daerah_m->get_long_lat_kota($data->kab_kota_id)->result();
								foreach($long_lat_kota as $long_lat);
							?>
							<tr><td>PROVINSI</td>
								<td>
									<input name="pemilik_id" type="hidden" value="<?php foreach($pemilik->result() as $pemilik_id); echo $pemilik_id->pemilik_id;?>"/>
									<input name="provinsi_id" type="hidden" value="<?php echo $data->provinsi_id; ?>"/>
									<input name="provinsi_nama"  class="input-xlarge" type="text" value="<?php echo $prov; ?>" readonly required>
								</td><td><?php echo form_error('provinsi_id');?></td></tr>
							<tr><td>KOTA</td>
								<td>
									<input name="kab_kota_id" type="hidden" value="<?php echo $data->kab_kota_id; ?>"/>
									<input name="kab_kota_nama"  class="input-xlarge" type="text" value="<?php echo $kota; ?>" readonly required>
									</td><td><?php echo form_error('kab_kota_id');?></td></tr>
							<tr><td>INDEKOS NAMA</td><td><input name="indekos_nama"  class="input-xlarge" type="text" required /></td><td><?php echo form_error('indekos_nama');?></td></tr>
							<tr><td>INDEKOS UNTUK</td><td><select name="indekos_untuk">
									<option value="LAKI"> LAKI</option>
									<option value="PEREMPUAN"> PEREMPUAN</option>
									<option value="SEMUA"> SEMUA</option></td><td><?php echo form_error('indekos_untuk');?></td></tr>
							<tr><td>INDEKOS PETA</td>
								<td>
									<a href="#" onclick="javascript: newWindow('<?=base_url();?>indekos/indekos_peta/<?php echo $pemilik_id->pemilik_rumah_long;?>/<?php echo $pemilik_id->pemilik_rumah_lat;?>','window2')" class="btn btn-primary"><img src="<?php echo base_url().'assets/img/icons/36/maps.png';?>"></a>&nbsp;
									<input name="indekos_long" value="<?php echo $pemilik_id->pemilik_rumah_long;?>"  class="input-small" id="disabledInput" type="text" placeholder="LONGITUDE" readonly>&nbsp;
									<input name="indekos_lat" value="<?php echo $pemilik_id->pemilik_rumah_lat;?>" placeholder="LATITUDE"  class="input-small" id="disabledInput" type="text" readonly></td><td><?php echo form_error('indekos_long');?></td></tr>
							<tr><td>KETERANGAN</td><td><textarea name="indekos_keterangan" class="input-xlarge" rows="5" required></textarea></td><td><?php echo form_error('indekos_keterangan');?></td></tr>
							<tr><td></td><td><input type="submit" name="submit" class="btn btn-primary" value="SIMPAN"/></td><td></td></tr>
						</tbody>
						</table>
					</form>
				</section>
			</div>
	<?php 
	$this->load->view('footer');

?>