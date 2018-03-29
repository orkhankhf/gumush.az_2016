<?php
	if(isset($_POST['mehsul']) && !empty($_POST['mehsul'])){
		$mehsul_id = $_POST['mehsul'];

		include "../../../db-bakuweb/db.php";

		if($conn){
			//sliderden silinecek sekilin adini alir id adresine gore
			$select = "SELECT img_name FROM slider WHERE id = '$mehsul_id'";
			$sel_netice = mysqli_query($conn,$select);

			while($row = mysqli_fetch_assoc($sel_netice)){
				$img_name = $row['img_name'];
			}
			//uygun id adresine sahib sekili databazadan silir
			$delete = "DELETE FROM slider WHERE id = '$mehsul_id'";
			$del_netice = mysqli_query($conn,$delete);
			//eger sekil silindise, sekili slider papkasindan sil ve databazada qalan melumatlari slider json-a yaz
			if($del_netice){
				unlink("../../../slider/".$img_name);

				$select_slider_photos = "SELECT * FROM slider ORDER BY id DESC";
				$select_netice = mysqli_query($conn,$select_slider_photos);

				$slider_fotolari_json = "[";
				while($row = mysqli_fetch_assoc($select_netice)){
				    if ($slider_fotolari_json != "[") {
				    	$slider_fotolari_json .= ",";
				    }
			    	$slider_fotolari_json .= '{"id":"'.$row['id'].'","basliq":"'.$row['basliq'].'","aciqlama":"'.$row['aciqlama'].'","qiymet":"'.$row['qiymet'].'","link":"'.$row['mehsulun_linki'].'","img_alt":"'.$row['img_alt'].'","a_title":"'.$row['a_title'].'","img_name":"'.$row['img_name'].'"}';
				}
				$slider_fotolari_json .="]";

				$slider_fotolari = fopen("../slidere-foto-elave-et/slider_fotolari.json","wb");
				fwrite($slider_fotolari,$slider_fotolari_json);
				fclose($slider_fotolari);
				echo "foto_silindi";
			}
			mysqli_close($conn);
		}
	}else{
		echo "Xəta baş verdi!";
	}
?>