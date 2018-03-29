<?php
	$kod = $_GET['fgb65fd1xgf5641fb6818b5f151fg65n1f6g51n8562'];
	$mail = $_GET['6gn16fx41nxn8df56b18df1b5fgx1n6886ngf1n'];

	$kod = trim($kod);
	$kod = filter_var($kod, FILTER_VALIDATE_INT);

	$mail = trim($mail);
	$mail = filter_var($mail, FILTER_SANITIZE_STRING);


	if(!filter_var($kod, FILTER_VALIDATE_INT) === false && !filter_var($mail, FILTER_SANITIZE_STRING) === false && !strstr($mail, '"') && !strstr($mail, "'") && !strstr($mail, "=") && !strstr($mail, "&") && !strstr($mail, "%") && !strstr($kod, '"') && !strstr($kod, "'") && !strstr($kod, "=") && !strstr($kod, "&") && !strstr($kod, "%") && strlen($mail) == 32 && strlen($kod) == 9){
		include "../db-bakuweb/db.php";
		if($conn){
			$netice = mysqli_query($conn,"SELECT email,aktivasiya FROM userler_bw WHERE email = '$mail'");
			if($netice){
				while($row = mysqli_fetch_assoc($netice)){
					if($kod == $row['aktivasiya'] && $mail == $row['email']){
						$insert = mysqli_query($conn,"UPDATE userler_bw SET aktivasiya = 'aktiv' WHERE email = '$mail'");
						if($insert){
							header('Location: ../');
						}
					}
				}
			}else{
				echo "Xəta baş verdi!Xahiş edirik bunu bizə bildirin!";
			}
			mysqli_close($conn);
		}else{
			echo "Xəta baş verdi!Xahiş edirik bunu bizə bildirin!";
		}
	}else{
		echo "Xəta baş verdi!Xahiş edirik bunu bizə bildirin!";
	}
?>