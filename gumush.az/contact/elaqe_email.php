<?php 
	session_start();

	if(isset($_POST['a']) && isset($_POST['b']) && isset($_POST['c']) && isset($_POST['d']) && isset($_POST['e']) && !empty($_POST['a']) && !empty($_POST['b']) && !empty($_POST['c']) && !empty($_POST['d']) && !empty($_POST['e'])){
		//PHP filterleri
		$ad = trim($_POST['a']);
		$soyad = trim($_POST['b']);
		$email = trim($_POST['c']);
		$tel = (int)$_POST['d'];
		$ip = trim($_SERVER['REMOTE_ADDR']);
		$muraciet = $_POST['e'];

		$ad = htmlspecialchars($ad);
		$soyad = htmlspecialchars($soyad);
		$email = htmlspecialchars($email);
		$tel = htmlspecialchars($tel);
		$ip = htmlspecialchars($ip);
		

		$ad = filter_var($ad, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW );
		$soyad = filter_var($soyad, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
		$email = filter_var($email, FILTER_SANITIZE_EMAIL);

		$tel = filter_var($tel, FILTER_VALIDATE_INT);
		$ip = filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4);

		//eger daxil olan user muraciet gonderirse userin id adresini alir
		if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])){
			$user_id_isset = $_SESSION['user_id'];
			if(!filter_var($user_id_isset,FILTER_VALIDATE_INT) === false){
				$user_id = $user_id_isset;
			}
		}else{
			$user_id = "User daxil olmayıb və id adresi mövcud deyil";
		}

		if(!filter_var($ad, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW) === false && !filter_var($soyad, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW) === false && !filter_var($email, FILTER_VALIDATE_EMAIL) === false && !filter_var($tel, FILTER_VALIDATE_INT) === false && !filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) === false){
			//eger filterleri kecdise mail gonder
			$basliq = 'From: <support@gumush.az>';
			$email_basligi = "GUMUSH.AZ'in əlaqə formundan göndərilən müraciət";
			$email_mezmunu = "Ad: ".$ad."\n\nSoyad: ".$soyad."\n\nE-mail: ".$email."\n\nTelefon: ".$tel."\n\nİP: ".$ip."\n\nUserin İD nömrəsi: ".$user_id."\n\nMüraciətin məzmunu :\n\n".$muraciet;
			$header = "From: support@gumush.az\n";
			$header .= "Reply-To: ".$email;	
			$send = mail("orhandwk@code.edu.az,info@bakuweb.az",$email_basligi,$email_mezmunu,$header);
			if($send){
				echo "email_gonderildi";
			}else{
				echo "xeta";
			}
		}
	}
?>