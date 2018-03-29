<?php
	if(isset($_POST['user_id']) && !empty($_POST['user_id'])){
		$user_id = trim($_POST['user_id']);
		$ip = trim($_SERVER['REMOTE_ADDR']);

		include "../db-bakuweb/db.php";
		if($conn){
			$update = "UPDATE userler_bw SET sifaris_tamamlandi = '1',sifaris_tamamlanan_tarix = CURRENT_TIMESTAMP WHERE id = '$user_id'";
			$netice = mysqli_query($conn,$update);
			if($netice){
				echo "sifaris_tamamlandi";
			}
			mysqli_close($conn);
		}
	}
?>