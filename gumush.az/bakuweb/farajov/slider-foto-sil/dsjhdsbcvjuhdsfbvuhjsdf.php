<?php
	include "../../../db-bakuweb/db.php";
	if($conn){
		$select = "SELECT id,basliq,aciqlama,qiymet,mehsulun_linki,img_name FROM slider ORDER BY id DESC";
		$netice = mysqli_query($conn,$select);
		$table = "<table class='table table-hover'>
				    <thead>
				      <tr>
				        <th>Şəkil</th>
				        <th>Başlıq</th>
				        <th>Açıqlama</th>
				        <th>Link</th>
				        <th>Qiymət</th>
				        <th></th>
				      </tr>
				    </thead>
				    <tbody>";
		while($row = mysqli_fetch_assoc($netice)){
			$table .= "<tr>
					    <td><img src='../../slider/".$row['img_name']."' width='80' height='60' /></td>
					    <td>".$row['basliq']."</td>
					    <td>".$row['aciqlama']."</td>
					    <td><a href='".$row['mehsulun_linki']."' target='_blank'>Məhsula bax</a></td>
					    <td>".$row['qiymet']." AZN</td>
				        <td><button id='mehsul".$row['id']."' onclick='db_slider_foto_id_sil(this.id)' class='btn btn-danger'>SİL</button></td>
				      </tr>
				    ";
		}
		$table .= "</tbody>
				  </table>";

		echo $table;
		mysqli_close($conn);
	}
?>