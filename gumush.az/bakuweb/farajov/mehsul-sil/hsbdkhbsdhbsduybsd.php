<?php
	include "../../../db-bakuweb/db.php";
	if($conn){
		$select = "SELECT id,basliq,qiymet,tmp,mehsulun_sahibi FROM mehsullar ORDER BY id DESC";
		$netice = mysqli_query($conn,$select);
		$table = "<table class='table table-hover'>
				    <thead>
				      <tr>
				        <th>Şəkil</th>
				        <th>Başlıq</th>
				        <th>Qiymət</th>
				        <th>Məhsulun Sahibi</th>
				        <th></th>
				      </tr>
				    </thead>
				    <tbody>";
		while($row = mysqli_fetch_assoc($netice)){
			$table .= "<tr>
				        <td><img src='../../item/".$row['tmp']."/image0.jpg' width='60' height='60' /></td>
				        <td>".$row['basliq']."</td>
				        <td>".$row['qiymet']." AZN</td>
				        <td>".$row['mehsulun_sahibi']."</td>
				        <td><button id='mehsul".$row['id']."' onclick='db_mehsul_id_sil(this.id)' class='btn btn-danger'>SİL</button></td>
				      </tr>
				    ";
		}
		$table .= "</tbody>
				  </table>";

		echo $table;
		mysqli_close($conn);
	}
?>