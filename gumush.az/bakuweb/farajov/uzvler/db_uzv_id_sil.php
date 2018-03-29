<?php
	if(isset($_POST['uzv_id']) && !empty($_POST['uzv_id'])){
		$uzv_id = $_POST['uzv_id'];

		include "../../../db-bakuweb/db.php";

		if($conn){
			$delete = "DELETE FROM userler_bw WHERE id = '$uzv_id'";
			$del_netice = mysqli_query($conn,$delete);
			//eger user silindise, echo et
			if($del_netice){
				echo "uzv_silindi";
			}
			mysqli_close($conn);
		}
	}else{
		echo "Xəta baş verdi!";
	}
?>