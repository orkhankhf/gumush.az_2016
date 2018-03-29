<?php
	if(isset($_POST['user_id_sifaris_verildi']) && !empty($_POST['user_id_sifaris_verildi'])){
		$user_id = $_POST['user_id_sifaris_verildi'];

		include "../../../db-bakuweb/db.php";
		if($conn){
			$update = "UPDATE userler_bw SET sebet = '',sifaris_tamamlandi = '0',sifaris_gorulub = '0' WHERE id = '$user_id'";
			$netice = mysqli_query($conn,$update);
			if($netice){
				echo "sifarisler_verildi";
			}
			mysqli_close($conn);
		}
	}
?>