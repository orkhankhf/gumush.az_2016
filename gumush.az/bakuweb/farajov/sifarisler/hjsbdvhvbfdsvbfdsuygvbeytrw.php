<?php
	include "../../../db-bakuweb/db.php";
	if($conn){
		$select = "SELECT id,ad,soyad,email_no_md5,tel,sebet,sifaris_tamamlanan_tarix,sifaris_gorulub FROM userler_bw WHERE sifaris_tamamlandi = '1' ORDER BY id DESC";
		$netice = mysqli_query($conn,$select);
		$table = "<table class='table table-hover'>
				    <thead>
				      <tr>
				      	<th>Sıra</th>
				        <th>Ad</th>
				        <th>Soyad</th>
				        <th>E-mail</th>
				        <th>Telefon</th>
				        <th>Son sifariş tarixi</th>
				        <th>Sifarişi al</th>
				        <th>Sifarişlərə bax</th>
				        <th></th>
				      </tr>
				    </thead>
				    <tbody>";
		$sira = 1;
		while($row = mysqli_fetch_assoc($netice)){
			if($row['sifaris_gorulub'] != '1'){
				$sifarisi_al_buttonu = "<td><button id='".$row['id']."' onclick='sifarisi_al(this.id)' class='btn btn-success'>AL</button></td>";
			}else{
				$sifarisi_al_buttonu = "<td><button id='".$row['id']."' onclick='sifarisi_al(this.id)' class='btn btn-success' disabled>AL</button></td>";
			}
			$table .= "<tr>
						<td>".$sira.".</td>
				        <td>".$row['ad']."</td>
				        <td>".$row['soyad']."</td>
				        <td>".$row['email_no_md5']."</td>
				        <td>".$row['tel']."</td>
				        <td>".$row['sifaris_tamamlanan_tarix']."</td>
				        ".$sifarisi_al_buttonu."
				        <td><button id='".$row['id']."' onclick='userin_sifarislerine_bax(this.id)' class='btn btn-info' data-toggle='modal' data-target='#myModal'>BAX</button></td>
				        <td><button id='".$row['id']."' onclick='verildi(this.id)' class='btn btn-danger'>VERİLDİ</button></td>
				      </tr>
				    ";
			$sira++;
		}
		$table .= "</tbody>
				  </table>";

		echo $table;
		mysqli_close($conn);
	}
?>