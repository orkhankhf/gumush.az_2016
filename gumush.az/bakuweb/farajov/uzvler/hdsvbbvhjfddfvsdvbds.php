<?php
	include "../../../db-bakuweb/db.php";
	if($conn){
		$select = "SELECT id,ad,soyad,email_no_md5,tel,ip,sifre_deyisenin_ip,aktivasiya,sebet FROM userler_bw ORDER BY id DESC";
		$netice = mysqli_query($conn,$select);
		$table = "<table class='table table-hover'>
				    <thead>
				      <tr>
				      	<th>Sıra</th>
				        <th>Ad</th>
				        <th>Soyad</th>
				        <th>E-mail</th>
				        <th>Telefon</th>
				        <th>İP adresi</th>
				        <th>Şifrə dəyişənin İP adresi</th>
				        <th>Aktiv</th>
				        <th>Səbət</th>
				        <th></th>
				      </tr>
				    </thead>
				    <tbody>";
		$sira = 1;
		while($row = mysqli_fetch_assoc($netice)){
			$aktivlik = "<td class='uzv_aktivdir'>Hə</td>";
			if($row['aktivasiya'] != "aktiv"){
				$aktivlik = "<td class='uzv_aktiv_deyil'>Yox</td>";
			}
			$sebet = "Boş";
			if($row['sebet'] != ""){
				$sebet = "Dolu";
			}
			$table .= "<tr>
						<td>".$sira.".</td>
				        <td>".$row['ad']."</td>
				        <td>".$row['soyad']."</td>
				        <td>".$row['email_no_md5']."</td>
				        <td>".$row['tel']."</td>
				        <td>".$row['ip']."</td>
				        <td>".$row['sifre_deyisenin_ip']."</td>
				        ".$aktivlik."
				        <td>".$sebet."</td>
				        <td><button id='".$row['id']."' onclick='db_uzv_id_sil(this.id)' class='btn btn-danger'>SİL</button></td>
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