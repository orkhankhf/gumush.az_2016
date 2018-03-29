<?php
	if(isset($_POST['user_id_sifarisleri']) && !empty($_POST['user_id_sifarisleri'])){
		$user_id = $_POST['user_id_sifarisleri'];

		include "../../../db-bakuweb/db.php";
		if($conn){
			$toplam_tutar = 0;

			$select_sebet = "SELECT sebet FROM userler_bw WHERE id = '$user_id'";
			$netice_select_sebet = mysqli_query($conn,$select_sebet);

			while($row = mysqli_fetch_assoc($netice_select_sebet)){
				$sebet = $row['sebet'];
			}
			$sebet_array = explode(" ", $sebet);

			//eger sebetde eyni mehsuldan coxdursa yeni bir mehsuldan 2-3 eded sifaris olunubsa
			$bir_mehsuldan_coxdursa = array_diff_assoc($sebet_array, array_unique($sebet_array));

			$tekrarlananlar_mehsullar = array();
			//arraydan deyerleri aliriq
			foreach ($bir_mehsuldan_coxdursa as $acar => $deyer){
				//tekrarlanan mehsullari arrayin icine yigiriq
				array_push($tekrarlananlar_mehsullar, $deyer);
			}

			//tekrarlanan mehsullarin hansindan nece dene var?
			$vals = array_count_values($tekrarlananlar_mehsullar);


			$select_from_mehsullar_by_id = "SELECT id,basliq,qiymet,tmp,kateqoriya,olcu,cins,yasgrupu,qas FROM mehsullar WHERE id = ";
			for($a=0; $a < count($sebet_array); $a++){
				$select_from_mehsullar_by_id .= $sebet_array[$a];
				$select_from_mehsullar_by_id .= " or id = ";
			}
			//axirdaki or id = yazisini silir ki sql sorgusu "where id = 40 or id =" olmasin
			$select_from_mehsullar_by_id = substr($select_from_mehsullar_by_id, 0, -9);
			$select_from_mehsullar_by_id .= " ORDER BY id DESC";

			$netice_select_from_mehsullar_by_id = mysqli_query($conn,$select_from_mehsullar_by_id);
			$table = "<table class='table table-hover table-bordered'>
				    <thead>
				      <tr>
				        <th>Şəkil</th>
				        <th>Başlıq</th>
				        <th>Kateqoriya</th>
				        <th>Cins</th>
				        <th>Yaş Grupu</th>
				        <th>Qaş</th>
				        <th>Ölçü</th>
				        <th>Ədəd</th>
				        <th>Qiymət</th>
				      </tr>
				    </thead>
				    <tbody>";
			$sira = 1;
			while($row = mysqli_fetch_assoc($netice_select_from_mehsullar_by_id)){
				//toplam tutari hesablayir 
				$toplam_tutar = $toplam_tutar + $row['qiymet'];
				if(isset($vals[$row['id']])){
					//kateqoriya
					if($row['kateqoriya'] == "uzuk"){
						$kateqoriya = "Üzük";
					}else if($row['kateqoriya'] == "boyunbagi"){
						$kateqoriya = "Boyunbağı";
					}else if($row['kateqoriya'] == "qolbaq"){
						$kateqoriya = "Qolbaq";
					}else if($row['kateqoriya'] == "sirga"){
						$kateqoriya = "Sırğa";
					}else if($row['kateqoriya'] == "komlpekt"){
						$kateqoriya = "Komplekt";
					}
					//olcu
					if($row['olcu'] != 0){
						$olcu = $row['olcu'];
					}else{
						$olcu = "<i class='fa fa-minus' aria-hidden='true'></i>";
					}
					//cins
					if($row['cins'] == "qadin"){
						$cins = "Qadın";
					}else{
						$cins = "Kişi";
					}
					//yasgrupu
					if($row['yasgrupu'] == "boyuk"){
						$yasgrupu = "Böyük";
					}else{
						$yasgrupu = "Uşaq";
					}
					//tekrarlanan mehsuldan nece eded oldugunu gosterir, normaldan 1 eded az gosterdiyi ucun +1 edilir (arraydir 0dan baslayir).
					$eded = $vals[$row['id']] + 1;
					//yuxarida qiymet bir defe toplam tutarin ustune geldiyi ucun burda toplamtutar + 50*2 edib sonra qiymeti 1 defe cixiriq
					$toplam_tutar = $toplam_tutar + $row['qiymet'] * $eded - $row['qiymet'];
						$table .= "<tr>
					        <td><img src='../../item/".$row['tmp']."/image0.jpg' width='60' height='60' /></td>
					        <td>".$row['basliq']."</td>
					        <td>".$kateqoriya."</td>
					        <td>".$cins."</td>
					        <td>".$yasgrupu."</td>
					        <td>".$row['qas']."</td>
					        <td>".$olcu."</td>
					        <td>".$eded."</td>
					        <td>".$row['qiymet']." AZN</td>
					      </tr>
					    ";
				}else{
					//kateqoriya
					if($row['kateqoriya'] == "uzuk"){
						$kateqoriya = "Üzük";
					}else if($row['kateqoriya'] == "boyunbagi"){
						$kateqoriya = "Boyunbağı";
					}else if($row['kateqoriya'] == "qolbaq"){
						$kateqoriya = "Qolbaq";
					}else if($row['kateqoriya'] == "sirga"){
						$kateqoriya = "Sırğa";
					}else if($row['kateqoriya'] == "komlpekt"){
						$kateqoriya = "Komplekt";
					}
					//olcu
					if($row['olcu'] != 0){
						$olcu = $row['olcu'];
					}else{
						$olcu = "<i class='fa fa-minus' aria-hidden='true'></i>";
					}
					//cins
					if($row['cins'] == "qadin"){
						$cins = "Qadın";
					}else{
						$cins = "Kişi";
					}
					//yasgrupu
					if($row['yasgrupu'] == "boyuk"){
						$yasgrupu = "Böyük";
					}else{
						$yasgrupu = "Uşaq";
					}
					$table .= "<tr>
				        <td><img src='../../item/".$row['tmp']."/image0.jpg' width='60' height='60' /></td>
				        <td>".$row['basliq']."</td>
					    <td>".$kateqoriya."</td>
					    <td>".$cins."</td>
					    <td>".$yasgrupu."</td>
					    <td>".$row['qas']."</td>
					    <td>".$olcu."</td>
				        <td>1</td>
				        <td>".$row['qiymet']." AZN</td>
				      </tr>
				    ";
				}

				$sira++;
			}
			$table .= "
				<tr class='toplam_tutar_td'><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td align='right' class='text-primary'>Cəmi: </td>
					<td class='text-primary'>".$toplam_tutar." AZN</td>
				</tr>
				</tbody>
				  </table>";
			echo $table;
			mysqli_close($conn);
		}
	}
?>