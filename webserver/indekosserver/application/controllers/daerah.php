<?php

class Daerah extends CI_Controller{
	
	public function get_kota_prov(){
		$prov = $_GET['provinsi_id'];
		$data['provinsi_id'] = $prov;
		$this->session->set_userdata($data);
		$this->load->model('daerah_m');
		$query = $this->daerah_m->kota($prov);
		?>
		<select class="select-kota" name="kab_kota_id">
			<option value=""> PILIH KOTA </option>
			<?php
				foreach($query as $kab_kota){
					echo "<option =\"$kab_kota->kab_kota_id\">$kab_kota->kab_kota_nama </option>";
				} ?>
		</select>
		<?php 
	}
	
}

