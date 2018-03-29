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
			include "../db-bakuweb/db.php";
			if($conn){
				$movcud_sebeti_sec = "SELECT sebet FROM userler_bw WHERE id='$user_id'";
				$secilenin_neticesi = mysqli_query($conn,$movcud_sebeti_sec);
				while($setir = mysqli_fetch_assoc($secilenin_neticesi)){
					$sebet = $setir['sebet'];
				}
				//movcud sebetden mehsulun id adresini silir
				if(!empty($sebet)){
					$ids = str_split($sebet);
					$kes = "";
					$arr = array();
					for($i=0; $i<=count($ids)-1; $i++){// bu döngüde boşluklar arasındaki ürün idlerini ayırdım diziye
						if($ids[$i] != " "){
							$kes = $kes.$ids[$i];// dedimki eger boşluk ise önceki kısmı 1 elaman olarak diziye at sonra içini  boşalt diğer idleri alalım :)
						}
						if($ids[$i] == " " || $i == count($ids)-1){//dedimki eger boşluk ise veriyi diziye eleman olarak ata sonra cümleyi temizle
							$arr[] = $kes;
							$kes = "";
						}
					}
					$ids = "";
					for($i=0; $i<=count($arr)-1; $i++){//burdada dizideki silinicek elaman buldum ve sildim sonrada döngüyü kesitm
						if($arr[$i] == $mehsul){
							unset($arr[$i]);
							$i = count($arr);
						}
					}
					$arr = array_values($arr); //burda dizideki elemanı silince haliyle elamanın idside silindi o yüzden idyi temizledim tekara sıraladım
					for($i=0; $i<=count($arr)-1; $i++){//bu döngüdede tekrardan diziyi normal elamana atadım 
						if($i == count($arr)){
							$ids = $ids.$arr[$i];
						}else{
							$ids = $ids.$arr[$i]." ";
						}
					}
					$yeni_sebet = trim($ids);
				}
				//sebetdeki mehsullari silenden sonra axirinci mehsulu silib alis verisi tamamla-ya kliklemek olmur disable olur cunku.buna gorede her defe sil-e klik edende eger axirincisini silirse avtomatik adminpanelde sifarislerden silir userin sifarisini
				if(strpos($sebet," ")){
					//yeni sebet deyerini databazaya yazir
					$insert = "UPDATE userler_bw SET sebet = '$yeni_sebet' WHERE id='$user_id'";
					$insertin_neticesi = mysqli_query($conn,$insert);
					if($insertin_neticesi){
						//yeni deyer databazada userin sebet columnuna yazildisa echo edir
						echo "Məhsul_silindi!";
					}
				}else{
					//yeni sebet deyerini databazaya yazir
					$insert = "UPDATE userler_bw SET sebet = '$yeni_sebet',sifaris_tamamlandi = '0',sifaris_gorulub = '0' WHERE id='$user_id'";
					$insertin_neticesi = mysqli_query($conn,$insert);
					if($insertin_neticesi){
						//yeni deyer databazada userin sebet columnuna yazildisa echo edir
						echo "Məhsul_silindi!";
					}
				}
				mysqli_close($conn);
			}else{
				//databazaya baglanmayanda error verir
				echo "xeta";
			}
		}else{
			//eger deyerler reqem deyilse
			echo "xeta";
		}
	}else{
		echo "daxil_olun";
	}
?>