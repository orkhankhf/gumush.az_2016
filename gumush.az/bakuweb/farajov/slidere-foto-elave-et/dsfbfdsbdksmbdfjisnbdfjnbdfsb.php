<?php
	if(isset($_POST['submit'])){
		$basliq = $_POST["basliq_slider"];
		$basliq = trim($basliq);

		$aciqlama = $_POST["aciqlama_slider"];
		$aciqlama = trim($aciqlama);

		$qiymet = $_POST["qiymet_slider"];
		$qiymet = trim($qiymet);

		$link = $_POST['mehsulun_linki_slider'];
		$link = trim($link);

		$img_alt = $_POST["img_alt_slider"];
		$img_alt = trim($img_alt);

		$a_title = $_POST["a_title_slider"];
		$a_title = trim($a_title);

		$foto_yeri = $_FILES['image_slider']['tmp_name'];
		$foto_size = $_FILES['image_slider']['size'];

		$img_name = rand(111111111,999999999);
		$img_name .= ".jpg";

		$sekil_move_olub = false;

		if(isset($basliq) && !empty($basliq) && isset($aciqlama) && !empty($aciqlama) && isset($qiymet) && !empty($qiymet) && isset($link) && !empty($link) && isset($img_alt) && !empty($img_alt) && isset($a_title) && !empty($a_title) && isset($foto_yeri) && !empty($foto_yeri) && isset($foto_size) && !empty($foto_size)){
			
		if ($foto_yeri != "" && $foto_size < 10000000){

			$slider_papkasindaki_yeri = "../../../slider/".$img_name;
			if(move_uploaded_file($foto_yeri, $slider_papkasindaki_yeri)) {
				$sekil_move_olub = true;
			}

		}else{
			echo "Faylın göndərilməsində problem yaşandı!";
		}

			if(isset($sekil_move_olub) && $sekil_move_olub == true){
				include "../../../db-bakuweb/db.php";
				if($conn){
					$insert = "INSERT INTO slider (basliq,aciqlama,qiymet,mehsulun_linki,img_alt,a_title,img_name) VALUES ('$basliq','$aciqlama','$qiymet','$link','$img_alt','$a_title','$img_name')";
					$netice = mysqli_query($conn,$insert);
					if($netice){
						$select_slider_photos = "SELECT * FROM slider ORDER BY id DESC";
						$select_netice = mysqli_query($conn,$select_slider_photos);

						$slider_fotolari_json = "[";
						while($row = mysqli_fetch_assoc($select_netice)) {
						    if ($slider_fotolari_json != "[") {
						    	$slider_fotolari_json .= ",";
						    }
						    $slider_fotolari_json .= '{"id":"'.$row['id'].'","basliq":"'.$row['basliq'].'","aciqlama":"'.$row['aciqlama'].'","qiymet":"'.$row['qiymet'].'","link":"'.$row['mehsulun_linki'].'","img_alt":"'.$row['img_alt'].'","a_title":"'.$row['a_title'].'","img_name":"'.$row['img_name'].'"}';
						}
						$slider_fotolari_json .="]";

						$slider_fotolari = fopen("slider_fotolari.json","wb");
						fwrite($slider_fotolari,$slider_fotolari_json);
						fclose($slider_fotolari);

	    				echo "<script>window.location.href='../admin.php';</script>";
					}
					mysqli_close($conn);
				}
			}
		}
	}else{
		header('Location: ../../farajov');
	}
?>