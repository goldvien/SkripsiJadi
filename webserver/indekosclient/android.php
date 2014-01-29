<?php

mysql_connect("localhost","root","");
mysql_select_db("db_indekos");

extract($_REQUEST, EXTR_OVERWRITE);
if($act=="provinsi_id"){
	$query = mysql_query("SELECT * FROM provinsi");
	$send = "";$prov = array();
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['provinsi_id']);
		$send .= $dt."#";
		$prov[] =$data;
	}
	//json_encode($prov);
	echo $send;
}else if($act=="provinsi_kode"){
	$query = mysql_query("SELECT * FROM provinsi");
	$send = "";$prov = array();
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['provinsi_kode']);
		$send .= $dt."#";
		$prov[] =$data;
	}
	echo $send;
}else if($act=="provinsi_nama"){
	$query = mysql_query("SELECT * FROM provinsi");
	$send = "";$prov = array();
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['provinsi_nama']);
		$send .= $dt."#";
		$prov[] =$data;
	}
	echo $send;
/* ====================================== */
/* ==============  PEMILIK ============== */
/* ====================================== */
}else if($act=="pemilik_id"){
	$query = mysql_query("SELECT * FROM pemilik");
	$send = "";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['pemilik_id']);
		$send .= $dt."#";
	}
	echo $send;
}else if($act=="pemilik_no_hp"){
	$query = mysql_query("SELECT * FROM pemilik");
	$send = "";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['pemilik_no_hp']);
		$send .= $dt."#";
	}
	echo $send;
/* ====================================== */
/* ============== KAB KOTA ============== */
/* ====================================== */
}else if($act=="kab_kota_id"){
	$query = mysql_query("SELECT * FROM kab_kota");
	$send = "";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['kab_kota_id']);
		$send .= $dt."#";
	}
	echo $send;
}else if($act=="kab_kota_id_relasi_provinsi_id"){
	$query = mysql_query("SELECT * FROM kab_kota");
	$send = "";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['provinsi_id']);
		$send .= $dt."#";
	}
	echo $send;
}else if($act=="kab_kota_kode"){
	$query = mysql_query("SELECT * FROM kab_kota");
	$send = "";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['kab_kota_kode']);
		$send .= $dt."#";
	}
	echo $send;
}else if($act=="kab_kota_nama"){
	$query = mysql_query("SELECT * FROM kab_kota");
	$send = "";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['kab_kota_nama']);
		$send .= $dt."#";
	}
	echo $send;
}else if($act=="kab_kota_long"){
	$query = mysql_query("SELECT * FROM kab_kota");
	$send = "";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['kab_kota_long']);
		$send .= $dt."#";
	}
	echo $send;
}else if($act=="kab_kota_lat"){
	$query = mysql_query("SELECT * FROM kab_kota");
	$send = "";
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
	$send = "";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['indekos_id']);
		$send .= $dt."#";
	}
	echo $send;
}else if($act=="indekos_id_relasi_pemilik_id"){
	$query = mysql_query("SELECT * FROM indekos");
	$send = "";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['pemilik_id']);
		$send .= $dt."#";
	}
	echo $send;
}else if($act=="indekos_id_relasi_kab_kota_id"){
	$query = mysql_query("SELECT * FROM indekos");
	$send = "";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['kab_kota_id']);
		$send .= $dt."#";
	}
	echo $send;
}else if($act=="indekos_nama"){
	$query = mysql_query("SELECT * FROM indekos");
	$send = "";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['indekos_nama']);
		$send .= $dt."#";
	}
	echo $send;
}else if($act=="indekos_untuk"){
	$query = mysql_query("SELECT * FROM indekos");
	$send = "";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['indekos_untuk']);
		$send .= $dt."#";
	}
	echo $send;
}else if($act=="indekos_keterangan"){
	$query = mysql_query("SELECT * FROM indekos");
	$send = "";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['indekos_keterangan']);
		$send .= $dt."#";
	}
	echo $send;
}else if($act=="indekos_long"){
	$query = mysql_query("SELECT * FROM indekos");
	$send = "";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['indekos_long']);
		$send .= $dt."#";
	}
	echo $send;
}else if($act=="indekos_lat"){
	$query = mysql_query("SELECT * FROM indekos");
	$send = "";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['indekos_lat']);
		$send .= $dt."#";
	}
	echo $send;
}else if($act=="indekos_kab_kota_jarak"){
	$query = mysql_query("SELECT * FROM indekos");
	$send = "";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['indekos_kab_kota_jarak']);
		$send .= $dt."#";
	}
	echo $send;
	
/* ====================================== */
/* =============== KAMAR ================ */
/* ====================================== */
}else if($act=="kamar_id"){
	$query = mysql_query("SELECT * FROM kamar");
	$send = "";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['kamar_id']);
		$send .= $dt."#";
	}
	echo $send;
}else if($act=="kamar_id_relasi_indekos_id"){
	$query = mysql_query("SELECT * FROM kamar");
	$send = "";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['indekos_id']);
		$send .= $dt."#";
	}
	echo $send;
}else if($act=="kamar_nama"){
	$query = mysql_query("SELECT * FROM kamar");
	$send = "";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['kamar_nama']);
		$send .= $dt."#";
	}
	echo $send;
}else if($act=="kamar_harga"){
	$query = mysql_query("SELECT * FROM kamar");
	$send = "";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['kamar_harga']);
		$send .= $dt."#";
	}
	echo $send;
}else if($act=="kamar_isi"){
	$query = mysql_query("SELECT * FROM kamar");
	$send = "";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['kamar_isi']);
		$send .= $dt."#";
	}
	echo $send;
}else if($act=="kamar_ukuran_panjang"){
	$query = mysql_query("SELECT * FROM kamar");
	$send = "";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['kamar_ukuran_panjang']);
		$send .= $dt."#";
	}
	echo $send;
}else if($act=="kamar_ukuran_lebar"){
	$query = mysql_query("SELECT * FROM kamar");
	$send = "";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['kamar_ukuran_lebar']);
		$send .= $dt."#";
	}
	echo $send;
}else if($act=="kamar_ukuran_jenis"){
	$query = mysql_query("SELECT * FROM kamar");
	$send = "";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['kamar_ukuran_jenis']);
		$send .= $dt."#";
	}
	echo $send;
}else if($act=="kamar_foto"){
	$query = mysql_query("SELECT * FROM kamar");
	$send = "";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['kamar_foto']);
		$send .= $dt."#";
	}
	echo $send;
}else if($act=="kamar_minimal_kontrak"){
	$query = mysql_query("SELECT * FROM kamar");
	$send = "";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['kamar_minimal_kontrak']);
		$send .= $dt."#";
	}
	echo $send;
}else if($act=="kamar_minimal_kontrak_jenis"){
	$query = mysql_query("SELECT * FROM kamar");
	$send = "";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['kamar_minimal_kontrak_jenis']);
		$send .= $dt."#";
	}
	echo $send;
}else if($act=="kamar_kontrak_status"){
	$query = mysql_query("SELECT * FROM kamar");
	$send = "";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['kamar_kontrak_status']);
		$send .= $dt."#";
	}
	echo $send;
}else if($act=="kamar_kontrak_dari_tanggal"){
	$query = mysql_query("SELECT * FROM kamar");
	$send = "";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['kamar_kontrak_dari_tanggal']);
		$send .= $dt."#";
	}
	echo $send;
}else if($act=="kamar_kontrak_sampai_tanggal"){
	$query = mysql_query("SELECT * FROM kamar");
	$send = "";
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
	$send = "";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['fasilitas_master_id']);
		$send .= $dt."#";
	}
	echo $send;
}else if($act=="fasilitas_master_nama"){
	$query = mysql_query("SELECT * FROM fasilitas_master");
	$send = "";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['fasilitas_master_nama']);
		$send .= $dt."#";
	}
	echo $send;
}else if($act=="fasilitas_master_icon"){
	$query = mysql_query("SELECT * FROM fasilitas_master");
	$send = "";
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
	$send = "";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['fasilitas_eks_id']);
		$send .= $dt."#";
	}
	echo $send;
}else if($act=="fasilitas_eks_id_relasi_fasilitas_master_id"){
	$query = mysql_query("SELECT * FROM fasilitas_eks");
	$send = "";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['fasilitas_master_id']);
		$send .= $dt."#";
	}
	echo $send;
}else if($act=="fasilitas_eks_id_relasi_kab_kota_id"){
	$query = mysql_query("SELECT * FROM fasilitas_eks");
	$send = "";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['kab_kota_id']);
		$send .= $dt."#";
	}
	echo $send;
}else if($act=="fasilitas_eks_nama"){
	$query = mysql_query("SELECT * FROM fasilitas_eks");
	$send = "";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['fasilitas_eks_nama']);
		$send .= $dt."#";
	}
	echo $send;
}else if($act=="fasilitas_eks_long"){
	$query = mysql_query("SELECT * FROM fasilitas_eks");
	$send = "";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['fasilitas_eks_long']);
		$send .= $dt."#";
	}
	echo $send;
}else if($act=="fasilitas_eks_lat"){
	$query = mysql_query("SELECT * FROM fasilitas_eks");
	$send = "";
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
	$send = "";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['fasilitas_int_id']);
		$send .= $dt."#";
	}
	echo $send;
}else if($act=="fasilitas_int_id_relasi_pemilik_id"){
	$query = mysql_query("SELECT * FROM fasilitas_int");
	$send = "";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['pemilik_id']);
		$send .= $dt."#";
	}
	echo $send;
}else if($act=="fasilitas_int_nama"){
	$query = mysql_query("SELECT * FROM fasilitas_int");
	$send = "";
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
	$send = "";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['indekos_fasilitas_eks_id']);
		$send .= $dt."#";
	}
	echo $send;
}else if($act=="indekos_fasilitas_eks_id_relasi_indekos_id"){
	$query = mysql_query("SELECT * FROM indekos_fasilitas_eks");
	$send = "";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['indekos_id']);
		$send .= $dt."#";
	}
	echo $send;
}else if($act=="indekos_fasilitas_eks_id_relasi_fasilitas_eks_id"){
	$query = mysql_query("SELECT * FROM indekos_fasilitas_eks");
	$send = "";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['fasilitas_eks_id']);
		$send .= $dt."#";
	}
	echo $send;
}else if($act=="indekos_fasilitas_eks_jarak"){
	$query = mysql_query("SELECT * FROM indekos_fasilitas_eks");
	$send = "";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['indekos_fasilitas_eks_jarak']);
		$send .= $dt."#";
	}
	echo $send;
/* ====================================== */
/* ======= KAMAR FASILITAS INT ========== */
/* ====================================== */
}else if($act=="kamar_fasilitas_int_id"){
	$query = mysql_query("SELECT * FROM kamar_fasilitas_int");
	$send = "";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['kamar_fasilitas_int_id']);
		$send .= $dt."#";
	}
	echo $send;
}else if($act=="kamar_fasilitas_int_id_relasi_kamar_id"){
	$query = mysql_query("SELECT * FROM kamar_fasilitas_int");
	$send = "";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['kamar_id']);
		$send .= $dt."#";
	}
	echo $send;
}else if($act=="kamar_fasilitas_int_id_relasi_fasilitas_int_id"){
	$query = mysql_query("SELECT * FROM kamar_fasilitas_int");
	$send = "";
	while($data = mysql_fetch_array($query)){
		$dt = stripslashes($data['fasilitas_int_id']);
		$send .= $dt."#";
	}
	echo $send;
}else if($act=="provinsi"){
	$id = addslashes($_POST['provinsi_id']);
	$query = mysql_query("SELECT * FROM provinsi WHERE provinsi_id='$id'");
	$rows = mysql_num_rows($query);
	if($rows==0){
		echo 0;
	}else{
		echo $rows;
	}
}else if($act=="pemilik"){
	$id = addslashes($_POST['pemilik_id']);
	$query = mysql_query("SELECT * FROM pemilik WHERE pemilik_id='$id'");
	$rows = mysql_num_rows($query);
	if($rows==0){
		echo 0;
	}else{
		echo $rows;
	}
}else if($act=="kab_kota"){
	$id = addslashes($_POST['kab_kota_id']);
	$query = mysql_query("SELECT * FROM kab_kota WHERE kab_kota_id='$id'");
	$rows = mysql_num_rows($query);
	if($rows==0){
		echo 0;
	}else{
		echo $rows;
	}
}else if($act=="indekos"){
	$id = addslashes($_POST['indekos_id']);
	$query = mysql_query("SELECT * FROM indekos WHERE indekos_id='$id'");
	$rows = mysql_num_rows($query);
	if($rows==0){
		echo 0;
	}else{
		echo $rows;
	}
}else if($act=="fasilitas_master"){
	$id = addslashes($_POST['fasilitas_master_id']);
	$query = mysql_query("SELECT * FROM fasilitas_master WHERE fasilitas_master_id='$id'");
	$rows = mysql_num_rows($query);
	if($rows==0){
		echo 0;
	}else{
		echo $rows;
	}
}else if($act=="fasilitas_eks"){
	$id = addslashes($_POST['fasilitas_eks_id']);
	$query = mysql_query("SELECT * FROM fasilitas_eks WHERE fasilitas_eks_id='$id'");
	$rows = mysql_num_rows($query);
	if($rows==0){
		echo 0;
	}else{
		echo $rows;
	}
}else if($act=="fasilitas_int"){
	$id = addslashes($_POST['fasilitas_int_id']);
	$query = mysql_query("SELECT * FROM fasilitas_int WHERE fasilitas_int_id='$id'");
	$rows = mysql_num_rows($query);
	if($rows==0){
		echo 0;
	}else{
		echo $rows;
	}
}else if($act=="kamar"){
	$id = addslashes($_POST['kamar_id']);
	$query = mysql_query("SELECT * FROM kamar WHERE kamar_id='$id'");
	$rows = mysql_num_rows($query);
	if($rows==0){
		echo 0;
	}else{
		echo $rows;
	}
}else if($act=="indekos_fasilitas_eks"){
	$id = addslashes($_POST['indekos_fasilitas_eks_id']);
	$query = mysql_query("SELECT * FROM indekos_fasilitas_eks WHERE indekos_fasilitas_eks_id='$id'");
	$rows = mysql_num_rows($query);
	if($rows==0){
		echo 0;
	}else{
		echo $rows;
	}
}else if($act=="kamar_fasilitas_int"){
	$id = addslashes($_POST['kamar_fasilitas_int_id']);
	$query = mysql_query("SELECT * FROM kamar_fasilitas_int WHERE kamar_fasilitas_int_id='$id'");
	$rows = mysql_num_rows($query);
	if($rows==0){
		echo 0;
	}else{
		echo $rows;
	}
}else if($act=="terdekat_indekos_id"){
	$jarak = mysql_query("SELECT *, (
						(
							(acos
								(sin
									((indekos_lat*pi()/180)) * 
									sin(($lat*pi()/180))+
									cos((indekos_lat*pi()/180)) * 
									cos(($lat*pi()/180)) * 
									cos(((indekos_long - $lng)* pi()/180))
								)
							)*180/pi()
						)*60*1.1515
					) as jarak
			FROM indekos ORDER BY jarak ASC");
	$send = "";
	while($data = mysql_fetch_array($jarak)){
		$dt = stripslashes($data['indekos_id']);
		$send .= $dt."#";
	}
	echo $send;
}else if($act=="terdekat_jarak"){
	$jarak = mysql_query("SELECT indekos_lat, indekos_long, indekos_id, (
						(
							(acos
								(sin
									((indekos_lat*pi()/180)) * 
									sin(($lat*pi()/180))+
									cos((indekos_lat*pi()/180)) * 
									cos(($lat*pi()/180)) * 
									cos(((indekos_long - $lng)* pi()/180))
								)
							)*180/pi()
						)*60*1.1515
					) as jarak
			FROM indekos ORDER BY jarak ASC");
	$send = "";
	while($data = mysql_fetch_array($jarak)){
		$dt = stripslashes($data['jarak']);
		$send .= $dt."#";
	}
	echo $send;
}
/*
SELECT fasilitas_eks.fasilitas_eks_id, indekos.indekos_id, indekos.indekos_nama, fasilitas_eks.fasilitas_eks_nama, ( 6371 * acos( cos( radians(37) ) * cos( radians( indekos.indekos_lat) ) * cos( radians( indekos.indekos_long) - radians(fasilitas_eks.fasilitas_eks_long) ) + sin( radians(fasilitas_eks.fasilitas_eks_lat) ) * sin( radians( indekos.indekos_lat) ) ) ) AS jarak FROM 
fasilitas_eks, indekos_fasilitas_eks,indekos WHERE 
indekos_fasilitas_eks.fasilitas_eks_id=fasilitas_eks.fasilitas_eks_id AND
indekos_fasilitas_eks.indekos_id=indekos.indekos_id ORDER BY jarak;


"SELECT fasilitas_eks.fasilitas_eks_id, indekos.indekos_id, indekos.indekos_nama, 
indekos.indekos_long, fasilitas_eks.fasilitas_eks_long, fasilitas_eks.fasilitas_eks_nama, 
indekos.indekos_lat, fasilitas_eks.fasilitas_eks_lat,
( 6371 * acos( cos( radians(57.29577951) ) * cos( radians( indekos.indekos_lat) ) * cos( radians( indekos.indekos_long) - radians(fasilitas_eks.fasilitas_eks_long) ) + sin( radians(fasilitas_eks.fasilitas_eks_lat) ) * sin( radians( indekos.indekos_lat) ) ) ) AS jarak 
FROM fasilitas_eks, indekos WHERE 
fasilitas_eks.fasilitas_eks_id='12' AND indekos.indekos_id='37' ORDER BY
jarak;"


SELECT fasilitas_eks.fasilitas_eks_id, indekos.indekos_id, indekos.indekos_nama, indekos.indekos_long,fasilitas_eks.fasilitas_eks_long, fasilitas_eks.fasilitas_eks_nama, indekos.indekos_lat, fasilitas_eks.fasilitas_eks_lat,( 6371 * acos( cos( radians(57.29577951) ) * cos( radians(fasilitas_eks.fasilitas_eks_lat) ) * cos( radians(fasilitas_eks.fasilitas_eks_long) - radians(indekos.indekos_long) ) + sin( radians(indekos.indekos_lat) ) * sin( radians(fasilitas_eks.fasilitas_eks_id) ) ) ) AS jarak FROM fasilitas_eks, indekos WHERE fasilitas_eks.fasilitas_eks_id='3' AND indekos.indekos_id='1' ORDER BY
jarak;


SELECT (
			(
				(acos
					(sin
						((fasilitas_eks.fasilitas_eks_lat*pi()/180)) * 
						sin((indekos.indekos_lat*pi()/180))+
						cos((fasilitas_eks.fasilitas_eks_lat*pi()/180)) * 
						cos((indekos.indekos_lat*pi()/180)) * 
						cos(((fasilitas_eks.fasilitas_eks_long - indekos.indekos_long)* pi()/180))
					)
				)*180/pi()
			)*60*1.1515
        ) as distance
FROM fasilitas_eks,indekos WHERE fasilitas_eks.fasilitas_eks_id=10 AND indekos.indekos_id=2

SELECT (
			(
				(acos
					(sin
						((indekos.indekos_lat*pi()/180)) * 
						sin((fasilitas_eks.fasilitas_eks_lat*pi()/180))+
						cos((indekos.indekos_lat*pi()/180)) * 
						cos((fasilitas_eks.fasilitas_eks_lat*pi()/180)) * 
						cos(((indekos.indekos_long - fasilitas_eks.fasilitas_eks_long)* pi()/180))
					)
				)*180/pi()
			)*60*1.1515
        ) as distance
FROM fasilitas_eks,indekos WHERE fasilitas_eks.fasilitas_eks_id=10 AND indekos.indekos_id=2

*/
?>