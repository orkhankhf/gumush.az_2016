<?php
	session_start();
	//eger session ve mehsul varsa ve bos deyilse
	if(isset($_SESSION['user_id']) && isset($_POST['mehsul']) && !empty($_SESSION['user_id']) && !empty($_POST['mehsul'])){
		//userin ve mehsulun id adresini alir
		$user_id = $_SESSION['user_id'];
		$mehsul = $_POST['mehsul'];

		//deyiskenleri filter edir
		if(!filter_var($user_id,FILTER_VALIDATE_INT) === false && !filter_var($mehsul,FILTER_VALIDATE_INT) === false){
			//eger deyerler reqemdirse

			//item bolmesinden elave edende nece eded sifarish oldugunu bilirik
			if(isset($_POST['eded'])){
				//eger eded varsa deyisken teyin et
				$eded = $_POST['eded'];
				//eger eded reqemdirse mehsulun id'ni al ve nece eded sifaris olunubsa o qeder mehsulun arxasina elave et, yeni 65 dirse 3 eded sifaris olunubsa 65 65 65 yaz
				if(!filter_var($eded,FILTER_VALIDATE_INT) === false){
					//mehsulun id'si 65 dirse eded_mehsul 65 olur ve for dongusu ile nece defe sifarish olunubsa o qeder elave olunur
					$eded_mehsul = $mehsul;
					for($a = 2; $a <= $eded; $a++){
						//for dongusu ona gore 2 den baslayir ki 1 eded sifarish verende ele 1 defe mehsulun ozu yazilsin
						$mehsul .= " ".$eded_mehsul;
					}
				}
			}
			include "../db-bakuweb/db.php";
			if($conn){
				$movcud_sebeti_sec = "SELECT sebet FROM userler_bw WHERE id='$user_id'";
				$secilenin_neticesi = mysqli_query($conn,$movcud_sebeti_sec);
				while($setir = mysqli_fetch_assoc($secilenin_neticesi)){
					$sebet = $setir['sebet'];
				}
				if(strlen($sebet) > 196){
					echo "limit_dolub";
				}else{
					//movcud sebetdeki id adreslerine yenisini elave edir
					if(!empty($sebet)){
						$yeni_sebet = $mehsul." ".$sebet;
					}else{
						$yeni_sebet = $mehsul;
					}

					//yeni sebet deyerini databazaya yazir
					$insert = "UPDATE userler_bw SET sebet='$yeni_sebet' WHERE id='$user_id'";
					$insertin_neticesi = mysqli_query($conn,$insert);
					if($insertin_neticesi){
						//yeni deyer databazada userin sebet columnuna yazildisa echo edir
						echo "sifarish_oldu";
					}
				}
				mysqli_close($conn);
			}else{
				//databazaya baglanmayanda error verir
				echo "1xeta";
			}
		}else{
			//eger deyerler reqem deyilse
			echo "2xeta";
		}
	}else{
		echo "daxil_olun";
	}
?>