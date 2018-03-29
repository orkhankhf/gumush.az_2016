<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="alternate" hreflang="az" href="http://gumush.az/sebetim/index.php" />
	<meta http-equiv="content-language" content="az" />
	<meta name="keywords" content="gumus uzukler,gumus qolbaqlar,gumus sepler,gümüş qolbaqlar,qadin gumusleri,kisi gumusleri,usaq gumusleri,gumus satisi,gumus satisi bakida,qolbaqlar,qadın və kişi gümüşləri,online gumus sifarisi" />
	<meta name="description" content="Qadın və Kişi gümüşlərinin satışı. Bakı şəhəri daxilində çatdırılma pulsuzdur. Qapıda ödəmə." />
	<link rel="author" href="https://plus.google.com/108728687434805525511/posts"/>
	<meta name="abstract" content="Qadın Və Kişi Gümüşlərinin Onlayn Satışı" />
	<meta name="copyright" content="Bakuweb Dizayn Studiyası" />
	<meta name="robots" content="index, follow" />
	<meta property="og:url" content="http://gumush.az/sebetim/" />
	<meta property="og:type" content="website" />
	<meta property="og:title" content="Qadın Və Kişi Gümüşlərinin Onlayn Satışı" />
	<meta property="og:description" content="Bakı şəhəri daxilində sifariş verdiyiniz məhsulları istədiyiniz ünvana heç bir əlavə ödəniş tələb etmədən çatdırırıq." />
	<meta property="og:image" content="http://gumush.az/img/silverstorexl.jpg" />
	<meta property="og:image:type" content="image/jpeg" />
	<meta property="og:image:width" content="400" />
	<meta property="og:image:height" content="300" />
	<meta property="fb:app_id" content="268883703487579" />
	<meta property="fb:admins" content="ideal.nasirzade" />
	<meta property="fb:admins" content="OrxanDWK" />
	<meta property="og:site_name" content="Gumush" />
	<style type="text/css">
		body{
			overflow: hidden;
		}
		.container{
			display: none;
		}
	</style>
	<?php include "../head.php"; ?>
</head>
<body>
	<div id="fb-root"></div>
	<script>
		(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/az_AZ/sdk.js#xfbml=1&version=v2.6&appId=268883703487579";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
	</script>
	<!-- SEHIFELER YUKLENMEDEN ONCE CIXAN LOADING START -->
		<div class="circle"></div>
		<div class="circle1"></div>
	<!-- SEHIFELER YUKLENMEDEN ONCE CIXAN LOADING FINISH -->
	<script type="text/javascript">
		$(document).ready(function(){
		    document.title = "Səbətim";
		    setTimeout(function(){
		    	$(".circle").hide();
		    	$(".circle1").hide();
		    	$("body").css("overflow","visible");
		    },450);
		    setTimeout(function(){
				$(".container").fadeIn("slow");
		    },455);
		});
	</script>
	<div class="container">
		<?php include "../header_nav.php"; ?>
		<h1 class="seo_h1">Gumush.az Səbətim Gumush.az Sebetim Gümüş Üzüklər Gumus Uzukler Kişi Gümüşləri Kisi Gumusleri Qadın Gümüşləri Qadin Gumusleri</h1>
		<!-- SIFARISH POP-UP'S START -->
			<div class="sifarish_oldu_bg"></div>
			<div class="mehsul_sil_popup">
				<p>Məhsul səbətinizdən silindi!</p>
				<button onclick="sil_popup_bagla()">Bağla</button>
			</div>
			<div class="sifarish_xeta">
				<p>Xəta baş verdi! Xahiş edirik bunu bizə bildirin.</p>
				<button onclick="xetani_bildirin()">Bİldİr</button>
				<button onclick="xeta_bagla()">Bağla</button>
			</div>
			<script type="text/javascript">
				//mehsul silinende cixan popup penceresini baglayir
				function sil_popup_bagla(){
					//klik edende mehsul silindi popup baglanir ve sehife yenilenir
					$(".sifarish_oldu_bg,.mehsul_sil_popup").hide(600);
					setTimeout(function(){
						location.reload();
					},600);
				}
				//xeta bas vererse bunu contact sehifesi vasitesile bildirir
				function xetani_bildirin(){
					$(".sifarish_oldu_bg,.sifarish_xeta").hide(600);
					setTimeout(function(){
						//basqa sehifelerde istifade edende adresi uygun olaraq deyis
						window.location.href="../contact";
					},600);
				}
				//bildirmek istemese xeta bildiris penceresini baglayir
				function xeta_bagla(){
					$(".sifarish_oldu_bg,.sifarish_xeta").hide(600);
				}
			</script>
		<!-- SIFARISH POP-UP'S FINISH -->
		<script type="text/javascript">
			$("a[href='../sebetim']").css({
				backgroundColor:'#ED5258',
				color:'white'
			})
		</script>
		<!-- SEBETIM START -->
			<div class="row main_divs_space sebetim_main">

				<!-- xs ekran ucun start-->
				<div class="sebetim_alisverisi_tamamla sebet_tamamla_xs col-md-3 col-sm-3 col-xs-12">
					<p class="toplam">Toplam</p>
					<p class="toplam_mehsul"></p>
					<p class="odenilecek_mebleg">Ödəniləcək məbləğ</p>
					<p class="odenilecek_mebleg_reqem"></p>
					<button class="btn btn-success">Alış-verişi bitir<i class="fa fa-chevron-right" aria-hidden="true"></i></button>
				</div>
				<!-- xs ekran ucun finish-->

				<?php
					//odenilecek cemi meblegi asagida hesablayib gosterir
					$toplam_tutar = 0;
					//toplam mehsul sayisini asagida hesablayib gosterir
					$toplam_mehsul_sayisi = 0;
					//eger sebetde mehsul varsa true olur
					$sebet_de_mehsul_var = false;
					//eger hesaba daxil olunubsa yeni session varsa false olur ve asagidaki "Xahiş edirik hesabınıza daxil olun..." yazisi cixmir
					$hesaba_daxil_olun = true;

					if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id']) && !filter_var($_SESSION['user_id'],FILTER_VALIDATE_INT) === false){
						//eger hesaba daxil olunubsa yeni session varsa false olur ve asagidaki "Xahiş edirik hesabınıza daxil olun..." yazisi cixmir
						$hesaba_daxil_olun = false;

						include "../db-bakuweb/db.php";
						if($conn){
							//userin id adresini teyin edir
							$user_id = $_SESSION['user_id'];

							//daxil olan userin id adresine gore sebetini select edir
							$userin_sebeti = "SELECT sebet,sifaris_tamamlandi,sifaris_gorulub from userler_bw WHERE id = '$user_id'";
							$sebetdeki_idler_netice = mysqli_query($conn,$userin_sebeti);

							//sebetdeki mehsullarin id adresine gore mehsullari secir
							$select_mehsullar = "SELECT id,basliq,qiymet,tmp,img_alt,a_title FROM mehsullar WHERE id = ";

							while($setir = mysqli_fetch_assoc($sebetdeki_idler_netice)){

								if(isset($setir['sebet']) && !empty($setir['sebet'])){
									if($setir['sifaris_tamamlandi'] == '1' && $setir['sifaris_gorulub'] == '0'){
										$sifaris_tamamlanib = true;
									}
									if($setir['sifaris_gorulub'] == '1'){
										$sifarisiniz_baxildi = true;
									}
									//select olunan sebeti arraya insert edir
									$sebet_array = explode(" ",$setir['sebet']);

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
									

									for($a=0; $a < count($sebet_array);$a++){
										$select_mehsullar .= $sebet_array[$a];
										$select_mehsullar .= " or id = ";
										$toplam_mehsul_sayisi++;
									}
									//sebetde mehsul varsa true olur ki "Səbətinizdə məhsul yoxdur..." yazisi cixmasin
									$sebet_de_mehsul_var = true;

									//axirdaki or id = yazisini silir ki sql sorgusu "where id = 40 or id =" olmasin
									$select_mehsullar = substr($select_mehsullar, 0, -9);
									$select_mehsullar .= " ORDER BY id DESC";
								}
							}
						}else{
							//databazaya baglanmayanda error verir
							echo "Xəta baş verdi!";
						}
					}
				?>
				<div class="col-md-9 col-sm-9 col-xs-12 sebetim_leftside">
					<div class="col-xs-12 sebetim_table_headers">
						<p class="col-md-4 col-sm-4 col-xs-3"></p>
						<p class="col-md-5 col-sm-5 col-xs-5">Məhsulun adı</p>
						<p class="col-md-2 col-sm-2 col-xs-2">Ədəd</p>
						<p class="col-md-1 col-sm-1 col-xs-1">Qİymət</p>
					</div>
					<?php
						//sebetde mehsul varsa mehsullari secib sehifede gosterir
						if($sebet_de_mehsul_var == true){
							//sebetdeki mehsullarin id adresine gore mehsullari secir
							$sebetdeki_mehsullar_netice = mysqli_query($conn,$select_mehsullar);
							
							while($row = mysqli_fetch_assoc($sebetdeki_mehsullar_netice)){
								//toplam tutari hesablayir 
								$toplam_tutar = $toplam_tutar + $row['qiymet'];
								if(isset($vals[$row['id']])){
									//tekrarlanan mehsuldan nece eded oldugunu gosterir, normaldan 1 eded az gosterdiyi ucun +1 edilir (arraydir 0dan baslayir).
									$eded = $vals[$row['id']] + 1;
									//yuxarida qiymet bir defe toplam tutarin ustune geldiyi ucun burda toplamtutar + 50*2 edib sonra qiymeti 1 defe cixiriq
									$toplam_tutar = $toplam_tutar + $row['qiymet'] * $eded - $row['qiymet'];
										echo "<div class='col-xs-12 sebetim_item'>
											<a href='../item/".$row['tmp']."' title='".$row['a_title']."'>
												<div class='col-md-3 col-sm-4 col-xs-3'>
													<img src='../item/".$row['tmp']."/image0.jpg' alt='".$row['img_alt']."'>
												</div>
												<div class='col-md-6 col-sm-5 col-xs-5'>
													<h2>".$row['basliq']."</h2>
												</div>
											</a>
											<div class='sebetim_eded col-md-1 col-sm-1 col-xs-1'>
												<p>".$eded."</p>
											</div>
											<div class='sebetim_qiymet col-md-2 col-sm-2 col-sm-push-1 col-xs-1 col-xs-push-1'>
												<p>".$row['qiymet']." AZN</p>
											</div>
											<button id='".$row['id']."' onclick='mehsul_sil(this.id)' class='btn remove_item'>SİL</button>
										</div>";
								}else{
									echo "<div class='col-xs-12 sebetim_item'>
										<a href='../item/".$row['tmp']."' title='".$row['a_title']."'>
											<div class='col-md-3 col-sm-4 col-xs-3'>
												<img src='../item/".$row['tmp']."/image0.jpg' alt='".$row['img_alt']."'>
											</div>
											<div class='col-md-6 col-sm-5 col-xs-5'>
												<h2>".$row['basliq']."</h2>
											</div>
										</a>
										<div class='sebetim_eded col-md-1 col-sm-1 col-xs-1'>
											<p>1</p>
										</div>
										<div class='sebetim_qiymet col-md-2 col-sm-2 col-sm-push-1 col-xs-1 col-xs-push-1'>
											<p>".$row['qiymet']." AZN</p>
										</div>
										<button id='".$row['id']."' onclick='mehsul_sil(this.id)' class='btn remove_item'>SİL</button>
									</div>";
								}
							}
							mysqli_close($conn);
						}else if($sebet_de_mehsul_var == false && isset($_SESSION['user_id'])){
							//eger daxil olubsa ama sebeti bosdursa "Səbətinizdə məhsul yoxdur." yazir ve table basliqlarini display none edir
							echo "<p class='sebet_bosdur'>Səbətinizdə məhsul yoxdur.</p>";
							echo "<script>$('.sebetim_table_headers').hide()</script>";
						}
						if($hesaba_daxil_olun == true){
							//eger hesaba daxil olunmayibsa daxil olmagini teleb edir ve table basliqlarini display none edir
							echo "<p class='sbt_daxil_olun'>Xahiş edirik hesabınıza daxil olun.Əgər hesabınız yoxdursa qeydiyyatdan keçin.</p>";
							echo "<script>$('.sebetim_table_headers').hide()</script>";
						}
					?>
				</div>

				<div class="sebetim_alisverisi_tamamla sebet_tamamla_md col-md-3 col-sm-3">
					<p class="toplam">Toplam</p>
					<p class="toplam_mehsul"></p>
					<p class="odenilecek_mebleg">Ödəniləcək məbləğ</p>
					<p class="odenilecek_mebleg_reqem"></p>
					<button class="btn btn-success" onclick="sifarisi_bitir()">Alış-verişi bitir<i class="fa fa-chevron-right" aria-hidden="true"></i></button>
					<div class="alert alert-warning alert-dismissible fade in col-xs-12 text-center sifarisiniz_baxilacaq" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
						Sifarişiniz ən yaxın zamanda baxılacaq. Hazır olduğunda mobil nömrəniz vasitəsilə sizinlə əlaqə saxlanılacaq. Təcili çatdırılmalar üçün bizimlə əlaqə saxlayın.
					</div>
					<div class="alert alert-success alert-dismissible fade in col-xs-12 text-center sifarisiniz_baxildi" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
						Sifarişiniz artıq hazırdır ən yaxın zamanda mobil nömrəniz vasitəsilə sizinlə əlaqə saxlanılacaq.
					</div>
				</div>
				
				<script type="text/javascript">
					<?php
						//eger sifaris tamamlanibsa bildiris cixir
						if(isset($sifaris_tamamlanib)){
							echo "$('.sifarisiniz_baxilacaq').show(1);";
						}
						//eger sifaris baxilibsa yasil bildiris show olur
						if(isset($sifarisiniz_baxildi)){
							echo "$('.sifarisiniz_baxildi').show(1);";
						}
					?>
					//toplam tutari yuxarida hesablayib burda elementin icine yazdirir
					$(".odenilecek_mebleg_reqem").html("<?php echo $toplam_tutar; ?> AZN");

					//toplam mehsul sayisini yuxarida hesablayib burda elementin icine yazdirir
					$(".toplam_mehsul").html("<?php echo $toplam_mehsul_sayisi; ?> Məhsul");

					//mehsul silmek ucun
					function mehsul_sil(this_id){
						var mehsul_id = this_id;
						$.ajax({
							type:"POST",
							url:"sil.php",
							data: {mehsul:mehsul_id},
							success:function(gelen){
								if(gelen == "Məhsul_silindi!"){
									$(".sifarish_oldu_bg,.mehsul_sil_popup").show(600);
								}else if(gelen == "xeta"){
									$(".sifarish_oldu_bg,.sifarish_xeta").show(600);
								}
							},
							error:function(err){
								alert("Xəta baş verdi!");
							}
						});
					}
					//sifarisi bitir funksiyasi
					function sifarisi_bitir(){
						$.ajax({
							type:"POST",
							url:"sifarisi_bitir.php",
							data:{
								user_id:"<?php if(isset($user_id)){echo $user_id;} ?>"
							},
							success:function(gelen){
								if(gelen == "sifaris_tamamlandi" && $(".sifarisiniz_baxildi").is(':hidden')){
									$(".sifarisiniz_baxilacaq").show(100);
								}
							},
							error:function(err){
								alert("Xəta baş verdi!");
							}
						});
					}
				</script>
				<?php 
					if($sebet_de_mehsul_var == false){
						//sebetde mehsul yoxdursa veya hesaba daxil olunmayibsa alis verisi bitir buttonunu disable edir
						echo "<script>$('.sebetim_alisverisi_tamamla button').attr('disabled','disabled');</script>";
					}
				?>
			</div>
		<!-- SEBETIM FINISH -->
		<?php include "../contactUs_information_footer.php"; ?>
	</div>
</body>
</html>