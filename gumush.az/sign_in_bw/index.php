<?php
session_start();
if(isset($_POST['a']) && isset($_POST['b'])){
	$email = trim($_POST['a']);
	$parol = trim($_POST['b']);

	$email = htmlspecialchars($email);
	$parol = htmlspecialchars($parol);

	$email = filter_var($email, FILTER_SANITIZE_EMAIL);
	if(!filter_var($email, FILTER_VALIDATE_EMAIL) === false){
		$email = md5($email);
		$email = filter_var($email, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
	}else{
		echo "Xəta baş verdi!Xahiş edirik bunu bizə bildirin!";
	}

	$parol = filter_var($parol, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
	if(!filter_var($parol, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH) === false){
		$parol = md5($parol);
		$parol = filter_var($parol, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
	}else{
		echo "Xəta baş verdi!Xahiş edirik bunu bizə bildirin!";
	}

	if(!filter_var($email, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH) === false && !filter_var($parol, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH) === false){
		include "../db-bakuweb/db.php";
		if($conn){
			$select = "SELECT email FROM userler_bw WHERE email='$email'";
			$netice = mysqli_query($conn,$select);
			while($row = mysqli_fetch_assoc($netice)){
				if(isset($row['email'])){
					$select = "SELECT sifre,id,aktivasiya FROM userler_bw WHERE email='$email'";
					$netice = mysqli_query($conn,$select);
					while($row = mysqli_fetch_assoc($netice)){
						if($row['sifre'] == $parol){
							if($row['aktivasiya'] != "aktiv"){
								echo "hesab_aktiv_deyil";
							}else{
								echo "signed_in";
								$_SESSION['user_id'] = $row['id'];
							}
						}else{
							echo "sifre_sehvdir";
						}
					}
				}
			}
		}else{
			echo "Xəta baş verdi!Xahiş edirik bunu bizə bildirin!";
		}
		mysqli_close($conn);
	}else{
		echo "Daxil olunmadi";
	}
}
?>