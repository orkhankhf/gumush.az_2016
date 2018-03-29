<?php
session_start();
//UPDATE NEW PASSWORD
	if(!isset($_SESSION['user_id'])){
		if(isset($_POST['a']) && !empty($_POST['a']) && isset($_POST['b']) && !empty($_POST['b'])){
			//PHP filterleri

			//IP adresini alir
			$ip = trim($_SERVER['REMOTE_ADDR']);
			$ip = filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4);

			$parol = trim($_POST['a']);
			$parol = htmlspecialchars($parol);
			$parol = filter_var($parol, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);

			$email = trim($_POST['b']);
			$email = htmlspecialchars($email);
			$email = filter_var($email, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);

			if(!filter_var($parol, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH) === false && !filter_var($email, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH) === false){
				//parolu md5'e kodlayir
				$parol = md5($parol);
				$parol = filter_var($parol, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);

				include "../db-bakuweb/db.php";
				if($conn){
					if(!filter_var($parol, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH) === false && !filter_var($email, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH) === false){
						$update = "UPDATE userler_bw SET sifre='$parol',sifre_deyisenin_ip='$ip' WHERE email='$email'";
						$update_netice = mysqli_query($conn,$update);
						echo "deyisdi";
					}
					mysqli_close($conn);
				}
				
			}else{
				echo "Xəta baş verdi!Xahiş edirik bunu bizə bildirin!";
			}

		}
	}else{
		echo "<script>location.href = '../';</script>";
	}
?>