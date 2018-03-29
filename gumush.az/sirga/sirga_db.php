<?php
	if(isset($_POST['u']) && isset($_POST['v'])){
		$select_start = $_POST['u'];
		$limit = $_POST['v'];
		if(filter_var($select_start, FILTER_VALIDATE_INT) && filter_var($limit, FILTER_VALIDATE_INT)){
			$select_start = $_POST['u'];
			$limit = $_POST['v'];
		}else{
			$select_start = 0;
			$limit = 12;
		}
	}
	$select_uzukler = "SELECT * FROM mehsullar WHERE kateqoriya = 'sirga'";

	//qiymet
	if(isset($_POST['p']) && !empty($_POST['p'])){
		$select_uzukler = $select_uzukler.=" AND qiymet BETWEEN 10 AND 30";
	}
	if(isset($_POST['q']) && !empty($_POST['q'])){
		$select_uzukler = $select_uzukler.=" AND qiymet BETWEEN 30 AND 50";
	}
	if(isset($_POST['r']) && !empty($_POST['r'])){
		$select_uzukler = $select_uzukler.=" AND qiymet BETWEEN 50 AND 70";
	}
	if(isset($_POST['s']) && !empty($_POST['s'])){
		$select_uzukler = $select_uzukler.=" AND qiymet BETWEEN 70 AND 100";
	}
	if(isset($_POST['t']) && !empty($_POST['t'])){
		$select_uzukler = $select_uzukler.=" AND qiymet > 100";
	}
	//ceki
	if(isset($_POST['f']) && !empty($_POST['f'])){
		$select_uzukler = $select_uzukler.=" AND ceki BETWEEN 1 AND 5";
	}
	if(isset($_POST['g']) && !empty($_POST['g'])){
		$select_uzukler = $select_uzukler.=" AND ceki BETWEEN 5 AND 10";
	}
	if(isset($_POST['h']) && !empty($_POST['h'])){
		$select_uzukler = $select_uzukler.=" AND ceki BETWEEN 10 AND 20";
	}
	if(isset($_POST['i']) && !empty($_POST['i'])){
		$select_uzukler = $select_uzukler.=" AND ceki BETWEEN 20 AND 30";
	}
	if(isset($_POST['j']) && !empty($_POST['j'])){
		$select_uzukler = $select_uzukler.=" AND ceki > 30";
	}
	//yas
	if(isset($_POST['d']) && !empty($_POST['d'])){
		$select_uzukler = $select_uzukler.=" AND yasgrupu = 'usaq'";
	}
	if(isset($_POST['e']) && !empty($_POST['e'])){
		$select_uzukler = $select_uzukler.=" AND yasgrupu = 'boyuk'";
	}
	

	include "../db-bakuweb/db.php";
	if($conn){
		//databazada sorguya uygun nece mehsul oldugunu gosterir
		$mehsul = 0;
		$a_netice = mysqli_query($conn,$select_uzukler);
		while($row = mysqli_fetch_assoc($a_netice)){
			$mehsul++;
		}

		$select_uzukler = $select_uzukler.=" ORDER BY id DESC LIMIT $select_start,$limit";


		$netice = mysqli_query($conn,$select_uzukler);
		while($row = mysqli_fetch_assoc($netice)){
			echo "<div class='sellone col-md-4 col-sm-6 col-xs-12'>
					<div class='imgBox col-xs-12'>
						<img src='../item/".$row['tmp']."/image0.jpg' alt='".$row['img_alt']."'>
					</div>
						<h2>".$row['basliq']."</h2>
						<p>".$row['qiymet']." AZN</p>
					<a class='add_a_btn' title='".$row['a_title']."'>
						<button class='btn btn-success' onclick='sifarish(this.id)' id='mehsul".$row['id']."'>Sİfarİş</button>
					</a>
					<a class='more_a_btn' href='../item/".$row['tmp']."' title='".$row['a_title']."'>
						<button class='btn btn-success'>Ətraflı</button>
					</a>
				</div>";
		}
		echo "dwkfilter-".$mehsul;
	}else{
		echo "Xəta!";
	}
	mysqli_close($conn);
?>