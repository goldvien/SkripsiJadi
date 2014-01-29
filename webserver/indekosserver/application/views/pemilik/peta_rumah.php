<html>
	<head><title>Peta Rumah</title><?php  echo $map['js'];?></head>
	<script language="javascript">
		function long_lat(_long,_lat){
			opener.document.data_pribadi.pemilik_rumah_long.value = _long;
			opener.document.data_pribadi.pemilik_rumah_lat.value = _lat;
			//self.close();
			return true;
		}
		function keluar(){
			self.close();
			return true;
		}
	</script>
	<body>
		<?php
		echo $map['html'];
		?>
		<input type="submit" name="submit" value="Pilih" onclick="keluar();">
	</body>
</html>
