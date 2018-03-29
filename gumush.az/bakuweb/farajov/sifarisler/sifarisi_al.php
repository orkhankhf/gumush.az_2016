<?php
	if(isset($_POST['user_id_sifarisi_al']) && !empty($_POST['user_id_sifarisi_al'])){
		$user_id = $_POST['user_id_sifarisi_al'];

		include "../../../db-bakuweb/db.php";
		if($conn){
			$update = "UPDATE userler_bw SET sifaris_gorulub = '1' WHERE id = '$user_id'";
			$netice = mysqli_query($conn,$update);
			if($netice){
				echo "sifaris_alindi";
			}
			mysqli_close($conn);
		}
	}
?>