<?php
	//admin.php deki mehsul silmek ucun olan buttona klik edende alinan id adresi eger varsa
	if(isset($_POST['mehsul']) && !empty($_POST['mehsul'])){
		$mehsul_id = $_POST['mehsul'];

		include "../../../db-bakuweb/db.php";
		if($conn){
			//mehsulun papkasinin yolunu alir databazadan
			$select = "SELECT tmp FROM mehsullar WHERE id = '$mehsul_id'";
			$sel_netice = mysqli_query($conn,$select);

			while($row = mysqli_fetch_assoc($sel_netice)){
				$tmp = $row['tmp'];
			}

			//uygun id adresine sahib mehsulu silir
			$delete = "DELETE FROM mehsullar WHERE id = '$mehsul_id'";
			$del_netice = mysqli_query($conn,$delete);
			//eger mehsul silindise, mehsulun papkasini item papkasindan sil
			if($del_netice){
				foreach (glob("../../../item/".$tmp."/*.*") as $filename){
				    if(is_file($filename)){
				        unlink($filename);
				    }
				}
				//top12.json faylini update ederek en son elave edilen 12 mehsulu secirik
	    		$select_top_12 = "SELECT * FROM mehsullar ORDER BY id DESC LIMIT 12";
				$netice_top_12 = mysqli_query($conn,$select_top_12);
				$update_top_12 = "[";
				while($row = mysqli_fetch_assoc($netice_top_12)) {
				    if ($update_top_12 != "[") {
				    	$update_top_12 .= ",";
				    }
				    $update_top_12 .= '{"id":"'.$row['id'].'","basliq":"'.$row['basliq'].'","kateqoriya":"'.$row['kateqoriya'].'","qiymet":"'.$row['qiymet'].'","olcu":"'.$row['olcu'].'","ceki":"'.$row['ceki'].'","cins":"'.$row['cins'].'","yasgrupu":"'.$row['yasgrupu'].'","qas":"'.$row['qas'].'","tmp":"'.$row['tmp'].'","img_alt":"'.$row['img_alt'].'","a_title":"'.$row['a_title'].'"}';
				}
				$update_top_12 .="]";
				$fp = fopen("../mehsul-elave-et/top12.json","wb");
				fwrite($fp,$update_top_12);
				fclose($fp);

				//nece eded hansi mehsuldan qaldigini mueyyen edir, yoxdursa 0 yazir
				//butun kateqoriyalar
				$uzuk=0;
				$sirga=0;
				$qolbaq=0;
				$boyunbagi=0;
				$komplekt=0;

				//uzukler
				$u_qiymet_10_30 = 0;
				$u_qiymet_30_50 = 0;
				$u_qiymet_50_70 = 0;
				$u_qiymet_70_100 = 0;
				$u_qiymet_100_plus = 0;

				$u_olcu_16_minus = 0;
				$u_olcu_16_18 = 0;
				$u_olcu_18_20= 0;
				$u_olcu_20_22 = 0;
				$u_olcu_22_24 = 0;

				$u_ceki_1_5 = 0;
				$u_ceki_5_10 = 0;
				$u_ceki_10_20 = 0;
				$u_ceki_20_30 = 0;
				$u_ceki_30_plus = 0;

				$u_cins_kisi = 0;
				$u_cins_qadin = 0;

				$u_yasgrupu_usaq = 0;
				$u_yasgrupu_boyuk = 0;

				//sirga
				$s_qiymet_10_30 = 0;
				$s_qiymet_30_50 = 0;
				$s_qiymet_50_70 = 0;
				$s_qiymet_70_100 = 0;
				$s_qiymet_100_plus = 0;

				$s_ceki_1_5 = 0;
				$s_ceki_5_10 = 0;
				$s_ceki_10_20 = 0;
				$s_ceki_20_30 = 0;
				$s_ceki_30_plus = 0;

				$s_yasgrupu_usaq = 0;
				$s_yasgrupu_boyuk = 0;

				//qolbaq
				$q_qiymet_10_30 = 0;
				$q_qiymet_30_50 = 0;
				$q_qiymet_50_70 = 0;
				$q_qiymet_70_100 = 0;
				$q_qiymet_100_plus = 0;

				$q_ceki_1_5 = 0;
				$q_ceki_5_10 = 0;
				$q_ceki_10_20 = 0;
				$q_ceki_20_30 = 0;
				$q_ceki_30_plus = 0;

				$q_cins_kisi = 0;
				$q_cins_qadin = 0;

				$q_yasgrupu_usaq = 0;
				$q_yasgrupu_boyuk = 0;

				//boyunbagilar
				$b_qiymet_10_30 = 0;
				$b_qiymet_30_50 = 0;
				$b_qiymet_50_70 = 0;
				$b_qiymet_70_100 = 0;
				$b_qiymet_100_plus = 0;

				$b_ceki_1_5 = 0;
				$b_ceki_5_10 = 0;
				$b_ceki_10_20 = 0;
				$b_ceki_20_30 = 0;
				$b_ceki_30_plus = 0;

				$b_cins_kisi = 0;
				$b_cins_qadin = 0;

				$b_yasgrupu_usaq = 0;
				$b_yasgrupu_boyuk = 0;

				//komplektler
				$k_qiymet_10_30 = 0;
				$k_qiymet_30_50 = 0;
				$k_qiymet_50_70 = 0;
				$k_qiymet_70_100 = 0;
				$k_qiymet_100_plus = 0;

				$k_ceki_1_5 = 0;
				$k_ceki_5_10 = 0;
				$k_ceki_10_20 = 0;
				$k_ceki_20_30 = 0;
				$k_ceki_30_plus = 0;

				$k_cins_kisi = 0;
				$k_cins_qadin = 0;

				$k_yasgrupu_usaq = 0;
				$k_yasgrupu_boyuk = 0;

				if($conn){
					$select_all_for_mehsul_sayisi = "SELECT * FROM mehsullar";
					$mehsul_sayisi = mysqli_query($conn,$select_all_for_mehsul_sayisi);
					while($row = mysqli_fetch_assoc($mehsul_sayisi)){
						//butun kateqoriyalar
						if($row['kateqoriya']=="uzuk"){
							$uzuk++;
						}
						if($row['kateqoriya']=="sirga"){
							$sirga++;
						}
						if($row['kateqoriya']=="qolbaq"){
							$qolbaq++;
						}
						if($row['kateqoriya']=="boyunbagi"){
							$boyunbagi++;
						}
						if($row['kateqoriya']=="komplekt"){
							$komplekt++;
						}
						//uzukler
						if($row['kateqoriya']=="uzuk" && $row['qiymet']>=10 && $row['qiymet']<=30){
							$u_qiymet_10_30++;
						}
						if($row['kateqoriya']=="uzuk" && $row['qiymet']>=30 && $row['qiymet']<=50){
							$u_qiymet_30_50++;
						}
						if($row['kateqoriya']=="uzuk" && $row['qiymet']>=50 && $row['qiymet']<=70){
							$u_qiymet_50_70++;
						}
						if($row['kateqoriya']=="uzuk" && $row['qiymet']>=70 && $row['qiymet']<=100){
							$u_qiymet_70_100++;
						}
						if($row['kateqoriya']=="uzuk" && $row['qiymet']>100){
							$u_qiymet_100_plus++;
						}
						if($row['kateqoriya']=="uzuk" && $row['olcu']<16){
							$u_olcu_16_minus++;
						}
						if($row['kateqoriya']=="uzuk" && $row['olcu']>=16 && $row['olcu']<=18){
							$u_olcu_16_18++;
						}
						if($row['kateqoriya']=="uzuk" && $row['olcu']>=18 && $row['olcu']<=20){
							$u_olcu_18_20++;
						}
						if($row['kateqoriya']=="uzuk" && $row['olcu']>=20 && $row['olcu']<=22){
							$u_olcu_20_22++;
						}
						if($row['kateqoriya']=="uzuk" && $row['olcu']>=22 && $row['olcu']<=24){
							$u_olcu_22_24++;
						}
						if($row['kateqoriya']=="uzuk" && $row['ceki']>=1 && $row['ceki']<=5){
							$u_ceki_1_5++;
						}
						if($row['kateqoriya']=="uzuk" && $row['ceki']>=5 && $row['ceki']<=10){
							$u_ceki_5_10++;
						}
						if($row['kateqoriya']=="uzuk" && $row['ceki']>=10 && $row['ceki']<=20){
							$u_ceki_10_20++;
						}
						if($row['kateqoriya']=="uzuk" && $row['ceki']>=20 && $row['ceki']<=30){
							$u_ceki_20_30++;
						}
						if($row['kateqoriya']=="uzuk" && $row['ceki']>30){
							$u_ceki_30_plus++;
						}
						if($row['kateqoriya']=="uzuk" && $row['cins']=="kisi"){
							$u_cins_kisi++;
						}
						if($row['kateqoriya']=="uzuk" && $row['cins']=="qadin"){
							$u_cins_qadin++;
						}
						if($row['kateqoriya']=="uzuk" && $row['yasgrupu']=="usaq"){
							$u_yasgrupu_usaq++;
						}
						if($row['kateqoriya']=="uzuk" && $row['yasgrupu']=="boyuk"){
							$u_yasgrupu_boyuk++;
						}
						//sirgalar
						if($row['kateqoriya']=="sirga" && $row['qiymet']>=10 && $row['qiymet']<=30){
							$s_qiymet_10_30++;
						}
						if($row['kateqoriya']=="sirga" && $row['qiymet']>=30 && $row['qiymet']<=50){
							$s_qiymet_30_50++;
						}
						if($row['kateqoriya']=="sirga" && $row['qiymet']>=50 && $row['qiymet']<=70){
							$s_qiymet_50_70++;
						}
						if($row['kateqoriya']=="sirga" && $row['qiymet']>=70 && $row['qiymet']<=100){
							$s_qiymet_70_100++;
						}
						if($row['kateqoriya']=="sirga" && $row['qiymet']>100){
							$s_qiymet_100_plus++;
						}
						if($row['kateqoriya']=="sirga" && $row['ceki']>=1 && $row['ceki']<=5){
							$s_ceki_1_5++;
						}
						if($row['kateqoriya']=="sirga" && $row['ceki']>=5 && $row['ceki']<=10){
							$s_ceki_5_10++;
						}
						if($row['kateqoriya']=="sirga" && $row['ceki']>=10 && $row['ceki']<=20){
							$s_ceki_10_20++;
						}
						if($row['kateqoriya']=="sirga" && $row['ceki']>=20 && $row['ceki']<=30){
							$s_ceki_20_30++;
						}
						if($row['kateqoriya']=="sirga" && $row['ceki']>30){
							$s_ceki_30_plus++;
						}
						if($row['kateqoriya']=="sirga" && $row['yasgrupu']=="usaq"){
							$s_yasgrupu_usaq++;
						}
						if($row['kateqoriya']=="sirga" && $row['yasgrupu']=="boyuk"){
							$s_yasgrupu_boyuk++;
						}
						//qolbaqlar
						if($row['kateqoriya']=="qolbaq" && $row['qiymet']>=10 && $row['qiymet']<=30){
							$q_qiymet_10_30++;
						}
						if($row['kateqoriya']=="qolbaq" && $row['qiymet']>=30 && $row['qiymet']<=50){
							$q_qiymet_30_50++;
						}
						if($row['kateqoriya']=="qolbaq" && $row['qiymet']>=50 && $row['qiymet']<=70){
							$q_qiymet_50_70++;
						}
						if($row['kateqoriya']=="qolbaq" && $row['qiymet']>=70 && $row['qiymet']<=100){
							$q_qiymet_70_100++;
						}
						if($row['kateqoriya']=="qolbaq" && $row['qiymet']>100){
							$q_qiymet_100_plus++;
						}
						if($row['kateqoriya']=="qolbaq" && $row['ceki']>=1 && $row['ceki']<=5){
							$q_ceki_1_5++;
						}
						if($row['kateqoriya']=="qolbaq" && $row['ceki']>=5 && $row['ceki']<=10){
							$q_ceki_5_10++;
						}
						if($row['kateqoriya']=="qolbaq" && $row['ceki']>=10 && $row['ceki']<=20){
							$q_ceki_10_20++;
						}
						if($row['kateqoriya']=="qolbaq" && $row['ceki']>=20 && $row['ceki']<=30){
							$q_ceki_20_30++;
						}
						if($row['kateqoriya']=="qolbaq" && $row['ceki']>30){
							$q_ceki_30_plus++;
						}
						if($row['kateqoriya']=="qolbaq" && $row['cins']=="kisi"){
							$q_cins_kisi++;
						}
						if($row['kateqoriya']=="qolbaq" && $row['cins']=="qadin"){
							$q_cins_qadin++;
						}
						if($row['kateqoriya']=="qolbaq" && $row['yasgrupu']=="usaq"){
							$q_yasgrupu_usaq++;
						}
						if($row['kateqoriya']=="qolbaq" && $row['yasgrupu']=="boyuk"){
							$q_yasgrupu_boyuk++;
						}
						//boyunbagilar
						if($row['kateqoriya']=="boyunbagi" && $row['qiymet']>=10 && $row['qiymet']<=30){
							$b_qiymet_10_30++;
						}
						if($row['kateqoriya']=="boyunbagi" && $row['qiymet']>=30 && $row['qiymet']<=50){
							$b_qiymet_30_50++;
						}
						if($row['kateqoriya']=="boyunbagi" && $row['qiymet']>=50 && $row['qiymet']<=70){
							$b_qiymet_50_70++;
						}
						if($row['kateqoriya']=="boyunbagi" && $row['qiymet']>=70 && $row['qiymet']<=100){
							$b_qiymet_70_100++;
						}
						if($row['kateqoriya']=="boyunbagi" && $row['qiymet']>100){
							$b_qiymet_100_plus++;
						}
						if($row['kateqoriya']=="boyunbagi" && $row['ceki']>=1 && $row['ceki']<=5){
							$b_ceki_1_5++;
						}
						if($row['kateqoriya']=="boyunbagi" && $row['ceki']>=5 && $row['ceki']<=10){
							$b_ceki_5_10++;
						}
						if($row['kateqoriya']=="boyunbagi" && $row['ceki']>=10 && $row['ceki']<=20){
							$b_ceki_10_20++;
						}
						if($row['kateqoriya']=="boyunbagi" && $row['ceki']>=20 && $row['ceki']<=30){
							$b_ceki_20_30++;
						}
						if($row['kateqoriya']=="boyunbagi" && $row['ceki']>30){
							$b_ceki_30_plus++;
						}
						if($row['kateqoriya']=="boyunbagi" && $row['cins']=="kisi"){
							$b_cins_kisi++;
						}
						if($row['kateqoriya']=="boyunbagi" && $row['cins']=="qadin"){
							$b_cins_qadin++;
						}
						if($row['kateqoriya']=="boyunbagi" && $row['yasgrupu']=="usaq"){
							$b_yasgrupu_usaq++;
						}
						if($row['kateqoriya']=="boyunbagi" && $row['yasgrupu']=="boyuk"){
							$b_yasgrupu_boyuk++;
						}
						//komplektler
						if($row['kateqoriya']=="komplekt" && $row['qiymet']>=10 && $row['qiymet']<=30){
							$k_qiymet_10_30++;
						}
						if($row['kateqoriya']=="komplekt" && $row['qiymet']>=30 && $row['qiymet']<=50){
							$k_qiymet_30_50++;
						}
						if($row['kateqoriya']=="komplekt" && $row['qiymet']>=50 && $row['qiymet']<=70){
							$k_qiymet_50_70++;
						}
						if($row['kateqoriya']=="komplekt" && $row['qiymet']>=70 && $row['qiymet']<=100){
							$k_qiymet_70_100++;
						}
						if($row['kateqoriya']=="komplekt" && $row['qiymet']>100){
							$k_qiymet_100_plus++;
						}
						if($row['kateqoriya']=="komplekt" && $row['ceki']>=1 && $row['ceki']<=5){
							$k_ceki_1_5++;
						}
						if($row['kateqoriya']=="komplekt" && $row['ceki']>=5 && $row['ceki']<=10){
							$k_ceki_5_10++;
						}
						if($row['kateqoriya']=="komplekt" && $row['ceki']>=10 && $row['ceki']<=20){
							$k_ceki_10_20++;
						}
						if($row['kateqoriya']=="komplekt" && $row['ceki']>=20 && $row['ceki']<=30){
							$k_ceki_20_30++;
						}
						if($row['kateqoriya']=="komplekt" && $row['ceki']>30){
							$k_ceki_30_plus++;
						}
						if($row['kateqoriya']=="komplekt" && $row['cins']=="kisi"){
							$k_cins_kisi++;
						}
						if($row['kateqoriya']=="komplekt" && $row['cins']=="qadin"){
							$k_cins_qadin++;
						}
						if($row['kateqoriya']=="komplekt" && $row['yasgrupu']=="usaq"){
							$k_yasgrupu_usaq++;
						}
						if($row['kateqoriya']=="komplekt" && $row['yasgrupu']=="boyuk"){
							$k_yasgrupu_boyuk++;
						}
					}
					$update_mehsul_sayisi = '[{"uzuk":"'.$uzuk.'","sirga":"'.$sirga.'","qolbaq":"'.$qolbaq.'","boyunbagi":"'.$boyunbagi.'","komplekt":"'.$komplekt.'","u_qiymet_10_30":"'.$u_qiymet_10_30.'","u_qiymet_30_50":"'.$u_qiymet_30_50.'","u_qiymet_50_70":"'.$u_qiymet_50_70.'","u_qiymet_70_100":"'.$u_qiymet_70_100.'","u_qiymet_100_plus":"'.$u_qiymet_100_plus.'","u_olcu_16_minus":"'.$u_olcu_16_minus.'","u_olcu_16_18":"'.$u_olcu_16_18.'","u_olcu_18_20":"'.$u_olcu_18_20.'","u_olcu_20_22":"'.$u_olcu_20_22.'","u_olcu_22_24":"'.$u_olcu_22_24.'","u_ceki_1_5":"'.$u_ceki_1_5.'","u_ceki_5_10":"'.$u_ceki_5_10.'","u_ceki_10_20":"'.$u_ceki_10_20.'","u_ceki_20_30":"'.$u_ceki_20_30.'","u_ceki_30_plus":"'.$u_ceki_30_plus.'","u_cins_kisi":"'.$u_cins_kisi.'","u_cins_qadin":"'.$u_cins_qadin.'","u_yasgrupu_usaq":"'.$u_yasgrupu_usaq.'","u_yasgrupu_boyuk":"'.$u_yasgrupu_boyuk.'","s_qiymet_10_30":"'.$s_qiymet_10_30.'","s_qiymet_30_50":"'.$s_qiymet_30_50.'","s_qiymet_50_70":"'.$s_qiymet_50_70.'","s_qiymet_70_100":"'.$s_qiymet_70_100.'","s_qiymet_100_plus":"'.$s_qiymet_100_plus.'","s_ceki_1_5":"'.$s_ceki_1_5.'","s_ceki_5_10":"'.$s_ceki_5_10.'","s_ceki_10_20":"'.$s_ceki_10_20.'","s_ceki_20_30":"'.$s_ceki_20_30.'","s_ceki_30_plus":"'.$s_ceki_30_plus.'","s_yasgrupu_usaq":"'.$s_yasgrupu_usaq.'","s_yasgrupu_boyuk":"'.$s_yasgrupu_boyuk.'","q_qiymet_10_30":"'.$q_qiymet_10_30.'","q_qiymet_30_50":"'.$q_qiymet_30_50.'","q_qiymet_50_70":"'.$q_qiymet_50_70.'","q_qiymet_70_100":"'.$q_qiymet_70_100.'","q_qiymet_100_plus":"'.$q_qiymet_100_plus.'","q_ceki_1_5":"'.$q_ceki_1_5.'","q_ceki_5_10":"'.$q_ceki_5_10.'","q_ceki_10_20":"'.$q_ceki_10_20.'","q_ceki_20_30":"'.$q_ceki_20_30.'","q_ceki_30_plus":"'.$q_ceki_30_plus.'","q_cins_kisi":"'.$q_cins_kisi.'","q_cins_qadin":"'.$q_cins_qadin.'","q_yasgrupu_usaq":"'.$q_yasgrupu_usaq.'","q_yasgrupu_boyuk":"'.$q_yasgrupu_boyuk.'","b_qiymet_10_30":"'.$b_qiymet_10_30.'","b_qiymet_30_50":"'.$b_qiymet_30_50.'","b_qiymet_50_70":"'.$b_qiymet_50_70.'","b_qiymet_70_100":"'.$b_qiymet_70_100.'","b_qiymet_100_plus":"'.$b_qiymet_100_plus.'","b_ceki_1_5":"'.$b_ceki_1_5.'","b_ceki_5_10":"'.$b_ceki_5_10.'","b_ceki_10_20":"'.$b_ceki_10_20.'","b_ceki_20_30":"'.$b_ceki_20_30.'","b_ceki_30_plus":"'.$b_ceki_30_plus.'","b_cins_kisi":"'.$b_cins_kisi.'","b_cins_qadin":"'.$b_cins_qadin.'","b_yasgrupu_usaq":"'.$b_yasgrupu_usaq.'","b_yasgrupu_boyuk":"'.$b_yasgrupu_boyuk.'","k_qiymet_10_30":"'.$k_qiymet_10_30.'","k_qiymet_30_50":"'.$k_qiymet_30_50.'","k_qiymet_50_70":"'.$k_qiymet_50_70.'","k_qiymet_70_100":"'.$k_qiymet_70_100.'","k_qiymet_100_plus":"'.$k_qiymet_100_plus.'","k_ceki_1_5":"'.$k_ceki_1_5.'","k_ceki_5_10":"'.$k_ceki_5_10.'","k_ceki_10_20":"'.$k_ceki_10_20.'","k_ceki_20_30":"'.$k_ceki_20_30.'","k_ceki_30_plus":"'.$k_ceki_30_plus.'","k_cins_kisi":"'.$k_cins_kisi.'","k_cins_qadin":"'.$k_cins_qadin.'","k_yasgrupu_usaq":"'.$k_yasgrupu_usaq.'","k_yasgrupu_boyuk":"'.$k_yasgrupu_boyuk.'"}]';
					
					$mehsul = fopen("../mehsul-elave-et/mehsul_sayisi.json","wb");
					fwrite($mehsul,$update_mehsul_sayisi);
					fclose($mehsul);
				}
	    		//top12.json faylini update ederek en son elave edilen 12 mehsulu secirik
	    		$select_top_12 = "SELECT * FROM mehsullar ORDER BY id DESC LIMIT 12";
				$netice_top_12 = mysqli_query($conn,$select_top_12);
				$update_top_12 = "[";
				while($row = mysqli_fetch_assoc($netice_top_12)) {
				    if ($update_top_12 != "[") {
				    	$update_top_12 .= ",";
				    }
				    $update_top_12 .= '{"id":"'.$row['id'].'","basliq":"'.$row['basliq'].'","kateqoriya":"'.$row['kateqoriya'].'","qiymet":"'.$row['qiymet'].'","olcu":"'.$row['olcu'].'","ceki":"'.$row['ceki'].'","cins":"'.$row['cins'].'","yasgrupu":"'.$row['yasgrupu'].'","qas":"'.$row['qas'].'","tmp":"'.$row['tmp'].'","img_alt":"'.$row['img_alt'].'","a_title":"'.$row['a_title'].'"}';
				}
				$update_top_12 .="]";
				$fp = fopen("../mehsul-elave-et/top12.json","wb");
				fwrite($fp,$update_top_12);
				fclose($fp);

				$delete_folder = rmdir("../../../item/".$tmp);
				if($delete_folder){
					echo "silindi";
				}
			}
			mysqli_close($conn);
		}
	}
?>