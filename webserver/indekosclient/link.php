<?php 

else if($act=="kab_kota_id"){
	$query = mysql_query("SELECT * FROM kab_kota");
	$send = "#";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['kab_kota_id']);
		$send .= $dt."#";
	}
	echo $send;
}else if($act=="kab_kota_id_relasi_provinsi_id"){
	$query = mysql_query("SELECT * FROM kab_kota");
	$send = "#";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['provinsi_id']);
		$send .= $dt."#";
	}
	echo $send;
}else if($act=="kab_kota_kode"){
	$query = mysql_query("SELECT * FROM kab_kota");
	$send = "#";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['kab_kota_kode']);
		$send .= $dt."#";
	}
	echo $send;
}else if($act=="kab_kota_nama"){
	$query = mysql_query("SELECT * FROM kab_kota");
	$send = "#";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['kab_kota_nama']);
		$send .= $dt."#";
	}
	echo $send;
}else if($act=="kab_kota_long"){
	$query = mysql_query("SELECT * FROM kab_kota");
	$send = "#";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['kab_kota_long']);
		$send .= $dt."#";
	}
	echo $send;
}else if($act=="kab_kota_lat"){
	$query = mysql_query("SELECT * FROM kab_kota");
	$send = "#";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['kab_kota_lat']);
		$send .= $dt."#";
	}
	echo $send;
/* ====================================== */
/* ============== INDEKOS =============== */
/* ====================================== */
}else if($act=="indekos_id"){
	$query = mysql_query("SELECT * FROM indekos");
	$send = "#";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['indekos_id']);
		$send .= $dt."#";
	}
	echo $send;
}else if($act=="indekos_id_relasi_pemilik_id"){
	$query = mysql_query("SELECT * FROM indekos");
	$send = "#";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['pemilik_id']);
		$send .= $dt."#";
	}
	echo $send;
}else if($act=="indekos_id_relasi_kab_kota_id"){
	$query = mysql_query("SELECT * FROM indekos");
	$send = "#";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['kab_kota_id']);
		$send .= $dt."#";
	}
	echo $send;
}else if($act=="indekos_nama"){
	$query = mysql_query("SELECT * FROM indekos");
	$send = "#";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['indekos_nama']);
		$send .= $dt."#";
	}
	echo $send;
}else if($act=="indekos_untuk"){
	$query = mysql_query("SELECT * FROM indekos");
	$send = "#";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['indekos_untuk']);
		$send .= $dt."#";
	}
	echo $send;
}else if($act=="indekos_keterangan"){
	$query = mysql_query("SELECT * FROM indekos");
	$send = "#";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['indekos_keterangan']);
		$send .= $dt."#";
	}
	echo $send;
}else if($act=="indekos_long"){
	$query = mysql_query("SELECT * FROM indekos");
	$send = "#";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['indekos_long']);
		$send .= $dt."#";
	}
	echo $send;
}else if($act=="indekos_lat"){
	$query = mysql_query("SELECT * FROM indekos");
	$send = "#";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['indekos_lat']);
		$send .= $dt."#";
	}
	echo $send;
/* ====================================== */
/* =============== KAMAR ================ */
/* ====================================== */
}else if($act=="kamar_id"){
	$query = mysql_query("SELECT * FROM kamar");
	$send = "#";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['kamar_id']);
		$send .= $dt."#";
	}
	echo $send;
}else if($act=="kamar_id_relasi_indekos_id"){
	$query = mysql_query("SELECT * FROM kamar");
	$send = "#";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['indekos_id']);
		$send .= $dt."#";
	}
	echo $send;
}else if($act=="kamar_nama"){
	$query = mysql_query("SELECT * FROM kamar");
	$send = "#";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['kamar_nama']);
		$send .= $dt."#";
	}
	echo $send;
}else if($act=="kamar_harga"){
	$query = mysql_query("SELECT * FROM kamar");
	$send = "#";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['kamar_harga']);
		$send .= $dt."#";
	}
	echo $send;
}else if($act=="kamar_isi"){
	$query = mysql_query("SELECT * FROM kamar");
	$send = "#";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['kamar_isi']);
		$send .= $dt."#";
	}
	echo $send;
}else if($act=="kamar_ukuran_panjang"){
	$query = mysql_query("SELECT * FROM kamar");
	$send = "#";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['kamar_ukuran_panjang']);
		$send .= $dt."#";
	}
	echo $send;
}else if($act=="kamar_ukuran_lebar"){
	$query = mysql_query("SELECT * FROM kamar");
	$send = "#";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['kamar_ukuran_lebar']);
		$send .= $dt."#";
	}
	echo $send;
}else if($act=="kamar_ukuran_jenis"){
	$query = mysql_query("SELECT * FROM kamar");
	$send = "#";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['kamar_ukuran_jenis']);
		$send .= $dt."#";
	}
	echo $send;
}else if($act=="kamar_foto"){
	$query = mysql_query("SELECT * FROM kamar");
	$send = "#";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['kamar_foto']);
		$send .= $dt."#";
	}
	echo $send;
}else if($act=="kamar_minimal_kontrak"){
	$query = mysql_query("SELECT * FROM kamar");
	$send = "#";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['kamar_minimal_kontrak']);
		$send .= $dt."#";
	}
	echo $send;
}else if($act=="kamar_minimal_kontrak_jenis"){
	$query = mysql_query("SELECT * FROM kamar");
	$send = "#";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['kamar_minimal_kontrak_jenis']);
		$send .= $dt."#";
	}
	echo $send;
}else if($act=="kamar_kontrak_status"){
	$query = mysql_query("SELECT * FROM kamar");
	$send = "#";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['kamar_kontrak_status']);
		$send .= $dt."#";
	}
	echo $send;
}else if($act=="kamar_kontrak_dari_tanggal"){
	$query = mysql_query("SELECT * FROM kamar");
	$send = "#";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['kamar_kontrak_dari_tanggal']);
		$send .= $dt."#";
	}
	echo $send;
}else if($act=="kamar_kontrak_sampai_tanggal"){
	$query = mysql_query("SELECT * FROM kamar");
	$send = "#";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['kamar_kontrak_sampai_tanggal']);
		$send .= $dt."#";
	}
	echo $send;
/* ====================================== */
/* ========= FASILITAS MASTER =========== */
/* ====================================== */
}else if($act=="fasilitas_master_id"){
	$query = mysql_query("SELECT * FROM fasilitas_master");
	$send = "#";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['fasilitas_master_id']);
		$send .= $dt."#";
	}
	echo $send;
}else if($act=="fasilitas_master_nama"){
	$query = mysql_query("SELECT * FROM fasilitas_master");
	$send = "#";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['fasilitas_master_nama']);
		$send .= $dt."#";
	}
	echo $send;
}else if($act=="fasilitas_master_icon"){
	$query = mysql_query("SELECT * FROM fasilitas_master");
	$send = "#";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['fasilitas_master_icon']);
		$send .= $dt."#";
	}
	echo $send;
/* ====================================== */
/* ========== FASILITAS EKS ============= */
/* ====================================== */
}else if($act=="fasilitas_eks_id"){
	$query = mysql_query("SELECT * FROM fasilitas_eks");
	$send = "#";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['fasilitas_eks_id']);
		$send .= $dt."#";
	}
	echo $send;
}else if($act=="fasilitas_eks_id_relasi_fasilitas_master_id"){
	$query = mysql_query("SELECT * FROM fasilitas_eks");
	$send = "#";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['fasilitas_master_id']);
		$send .= $dt."#";
	}
	echo $send;
}else if($act=="fasilitas_eks_id_relasi_kab_kota_id"){
	$query = mysql_query("SELECT * FROM fasilitas_eks");
	$send = "#";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['kab_kota_id']);
		$send .= $dt."#";
	}
	echo $send;
}else if($act=="fasilitas_eks_nama"){
	$query = mysql_query("SELECT * FROM fasilitas_eks");
	$send = "#";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['fasilitas_eks_nama']);
		$send .= $dt."#";
	}
	echo $send;
}else if($act=="fasilitas_eks_long"){
	$query = mysql_query("SELECT * FROM fasilitas_eks");
	$send = "#";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['fasilitas_eks_long']);
		$send .= $dt."#";
	}
	echo $send;
}else if($act=="fasilitas_eks_lat"){
	$query = mysql_query("SELECT * FROM fasilitas_eks");
	$send = "#";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['fasilitas_eks_lat']);
		$send .= $dt."#";
	}
	echo $send;
/* ====================================== */
/* =========== FASILITAS INT ============ */
/* ====================================== */
}else if($act=="fasilitas_int_id"){
	$query = mysql_query("SELECT * FROM fasilitas_int");
	$send = "#";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['fasilitas_int_id']);
		$send .= $dt."#";
	}
	echo $send;
}else if($act=="fasilitas_int_id_relasi_pemilik_id"){
	$query = mysql_query("SELECT * FROM fasilitas_int");
	$send = "#";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['pemilik_id']);
		$send .= $dt."#";
	}
	echo $send;
}else if($act=="fasilitas_int_nama"){
	$query = mysql_query("SELECT * FROM fasilitas_int");
	$send = "#";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['fasilitas_int_nama']);
		$send .= $dt."#";
	}
	echo $send;
/* ====================================== */
/* ======= INDEKOS FASILITAS EKS ======== */
/* ====================================== */
}else if($act=="indekos_fasilitas_eks_id"){
	$query = mysql_query("SELECT * FROM indekos_fasilitas_eks");
	$send = "#";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['indekos_fasilitas_eks_id']);
		$send .= $dt."#";
	}
	echo $send;
}else if($act=="indekos_fasilitas_eks_id_relasi_indekos_id"){
	$query = mysql_query("SELECT * FROM indekos_fasilitas_eks");
	$send = "#";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['indekos_id']);
		$send .= $dt."#";
	}
	echo $send;
}else if($act=="indekos_fasilitas_eks_id_relasi_fasilitas_eks_id"){
	$query = mysql_query("SELECT * FROM indekos_fasilitas_eks");
	$send = "#";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['fasilitas_eks_id']);
		$send .= $dt."#";
	}
	echo $send;
/* ====================================== */
/* ======= KAMAR FASILITAS INT ========== */
/* ====================================== */
}else if($act=="kamar_fasilitas_int_id"){
	$query = mysql_query("SELECT * FROM kamar_fasilitas_int");
	$send = "#";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['kamar_fasilitas_int_id']);
		$send .= $dt."#";
	}
	echo $send;
}else if($act=="kamar_fasilitas_int_id_relasi_kamar_id"){
	$query = mysql_query("SELECT * FROM kamar_fasilitas_int");
	$send = "#";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['kamar_id']);
		$send .= $dt."#";
	}
	echo $send;
}else if($act=="kamar_fasilitas_int_id_relasi_fasilitas_int_id"){
	$query = mysql_query("SELECT * FROM kamar_fasilitas_int");
	$send = "#";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['fasilitas_int_id']);
		$send .= $dt."#";
	}
	echo $send;
}

?>