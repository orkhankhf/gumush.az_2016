<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Adminpanel</title>
	<meta charset="utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../../js/jquery-ui/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="../../bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../../bootstrap/css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="../../css/normalize.css" />
	<link rel="stylesheet" type="text/css" href="../../css/style.css">
	<script type="text/javascript" src="../../js/jquery.min.js"></script>
	<script type="text/javascript" src="../../js/jquery-ui/jquery-ui.min.js"></script>
	<script type="text/javascript" src="../../bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../../js/angular.js"></script>
	<script>
	  $(function(){
	    $( "#tabs" ).tabs();
	  });
	</script>
</head>
<body>
	<script type="text/javascript">
		$(document).ready(function(){
			$(".admin_panel_main_div").show();
		})
	</script>
	<div class="container admin_panel_main_div">
	<?php
		if(isset($_SESSION['login']) && isset($_SESSION['password'])){
			include "../../db-bakuweb/db.php";
		}else{
			echo "<script>window.location.href='../farajov';</script>";
		}
	?>
		<div id='tabs'>
		  <ul>
		    <li><a href='#mehsul-elave-et'>Məhsul əlavə et</a></li>
		    <li><a href="#mehsul-sil" onclick="mehsul_sil()">Məhsul sil</a></li>
		    <li><a href='#slidere-foto-elave-et'>Sliderə foto əlavə et</a></li>
		    <li><a href='#sliderden-foto-sil' onclick="slider_fotolarini_getir()">Sliderdən foto sil</a></li>
		    <li><a href='#uzvler' onclick="uzvleri_getir()">Üzvlər</a></li>
		    <li><a href='#sifarisler' onclick='sifarisleri_getir()'>Sifarişlər</a></li>
		  </ul>




<!-- MEHSUL ELAVE ET START -->
		  	<div id='mehsul-elave-et'>
		    	<div class='row'>
		    		<div class='admin_tabs col-xs-12'>
		    			<form action="mehsul-elave-et/jhbgfvhfusrhbguyes.php" method='post' enctype="multipart/form-data">
			    			<div class="col-xs-12 col-sm-6">
			    				<p class="small text-primary">Qiymətləndirmə: -3 gram 2 AZN, 3-6 gram 1.50 AZN, 6+ gram 1 AZN</p>
			    				<input type='text' class="form-control" minlength="10" maxlength="80" placeholder='başlıq' name="basliq" required="required" />
								<input type='number' class="form-control" min="1" max="2000" placeholder='qiymət' name="qiymet" required="required" />
								<input type='hidden' class="form-control olcu" min="13" max="24" placeholder='ölçü' name="olcu" required="required" disabled="disabled" />
								<input type='number' step="any" class="form-control" min="1" max="250" placeholder='çəki' name="ceki" required="required" />
								<select class="selectpicker" name='qas' required="required">
									<option selected disabled>Qaş</option>
								    <option value='var'>Var</option>
								    <option value='yoxdur'>Yoxdur</option>
								</select>
								<select class="selectpicker kateqoriya_select" name='kateqoriya' required="required" />
			    					<option selected disabled>Kateqoriya</option>
								    <option value='uzuk'>Üzüklər</option>
								    <option value='sirga'>Sırğalar</option>
								    <option value='qolbaq'>Qolbaqlar</option>
								    <option value='boyunbagi'>Boyunbağılar</option>
								    <option value='komplekt'>Komplektlər</option>
								</select>
								<select class="selectpicker" name='cins' required="required">
									<option selected disabled>Cins</option>
								    <option value='kisi'>Kişi</option>
								    <option value='qadin' class="cins_qadin">Qadın</option>
								</select>
								<select class="selectpicker" name='yas_grupu' required="required">
									<option selected disabled>Yaş Qrupu</option>
									<option value='usaq'>Uşaqlar</option>
								    <option value='boyuk'>Böyüklər</option>
								</select>
							</div>
							<div class="col-xs-12 col-sm-6">
								<label for='image'> Şəkil (JPG) </label>
								<input type='file' class="form-control" id='image' name="image[]" required="required" multiple="multiple" />

								<input type='text' class="form-control" minlength="10" maxlength="30" placeholder='img alt' name="img_alt" required="required" />
								<input type='text' class="form-control" minlength="10" maxlength="30" placeholder='a title' name="a_title" required="required" />
								<input type="number" class="form-control" min="0100000000" max="0999999999" name="mehsulun_sahibi" placeholder="məhsulun sahibi" required="required" />
							</div>
			    			<div class="col-xs-12">
			    				<input class="btn btn-success" type="submit" name="submit" value="Əlavə et" />
			    			</div>
		    			</form>
		    		</div>
		    	</div>
		  	</div>
<!-- MEHSUL ELAVE ET FINISH -->

<!-- MEHSUL SIL START -->
			<div id="mehsul-sil">
				<div class="row">
					<div class="admin_tabs col-xs-12">
						<div class="mehsul_sil_main"></div>
					</div>
				</div>
			</div>
			<script type="text/javascript">
				var mehsul_sil_gelib = false;
				//"Mehsul Sil"-e klik etdiyin zaman bu funksiya ise dusur
				function mehsul_sil(){
					//eger mehsul_sil_gelib deyiseni falsedirse databazadan melumatlari cekir
					if(!mehsul_sil_gelib){
						$.ajax({
							url:"mehsul-sil/hsbdkhbsdhbsduybsd.php",
							type:"POST",
							success:function(gelen){
								//php den echo olan tepmlateni div icine yazdirir
								$(".mehsul_sil_main").html(gelen);
							}
						});
					}
					//eger melumatlar gelibse true olur ki, ikinci defe "Mehsul Sil"-e klik edende funksiya ise dusmesin
					mehsul_sil_gelib = true;
				}

				//phpden gelen template icerisindeki buttona klik edende bu funksiya ise dusur
				function db_mehsul_id_sil(this_id){
					//gelen deyer mehsul9050 olarsa mehsul sozunu silib 9050 cixart ve sadece mehsulun id adresini al
					var mehsul_id = this_id.slice(6);
					$.ajax({
						type:"POST",
						url:"mehsul-sil/db_mehsul_id_sil.php",
						data: {mehsul:mehsul_id},
						success:function(gelen){
							if(gelen == "silindi"){
								//mehsul silindise deyisen false olur ve mehsul_sil() funksiyasi ise duserek databazadan en son datani cekir
								mehsul_sil_gelib = false;
								return mehsul_sil();
							}
						},
						error:function(err){
							alert("Xəta baş verdi!");
						}
					});
				}
			</script>
<!-- MEHSUL SIL FINISH -->

<!-- SLIDERƏ FOTO ƏLAVƏ ET START -->
		  <div id='slidere-foto-elave-et'>
			    <div class='row'>
			    		<div class='admin_tabs col-xs-12'>
			    			<form action="slidere-foto-elave-et/dsfbfdsbdksmbdfjisnbdfjnbdfsb.php" method='post' enctype="multipart/form-data">
			    				<div class="col-xs-12 col-sm-6">
			    					<p class="small text-primary">Qeyd: Sliderə əlavə edilən şəkillərin ölçüsü 450x450 piksel olmalıdır (məhsulun şəklin mərkəzində olması vacibdir).</p>
				    				<input type='text' class="form-control" minlength="10" maxlength="30" placeholder='başlıq' name="basliq_slider" required="required" />
				    				<input type='text' class="form-control" minlength="10" maxlength="80" placeholder='açıqlama' name="aciqlama_slider" required="required" />
				    				<input type='number' class="form-control" min="1" max="2000" placeholder='qiymət' name="qiymet_slider" required="required" />
				    				<input type='text' class="form-control" minlength="10" maxlength="150" placeholder='məhsulun linki' name="mehsulun_linki_slider" required="required" />
				    				<input type='text' class="form-control" minlength="10" maxlength="30" placeholder='img alt' name="img_alt_slider" required="required" />
									<input type='text' class="form-control" minlength="10" maxlength="30" placeholder='a title' name="a_title_slider" required="required" />
									<label for='image_slider'> Şəkil (JPG) </label>
									<input type='file' class="form-control" id='image_slider' name="image_slider" required="required" />
			    				</div>
			    				<div class="col-xs-12">
				    				<input class="btn btn-success" type="submit" name="submit" value="Əlavə et">
				    				<button class='btn btn-danger' onclick="exit_adminpanel()">Çıx</button>
				    			</div>
			    			</form>
			    		</div>
			    </div>
		  </div>
<!-- SLIDERƏ FOTO ƏLAVƏ ET FINISH -->

<!-- SLIDERDEN FOTO SIL START -->
		<div id="sliderden-foto-sil">
			<div class="row">
				<div class="admin_tabs col-xs-12">
					<div class="slider_foto__sil_main"></div>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			var slider_foto_sil_gelib = false;
			//"Sliderdən foto sil"-e klik etdiyin zaman bu funksiya ise dusur
			function slider_fotolarini_getir(){
				//eger slider_foto_sil_gelib deyiseni falsedirse databazadan melumatlari cekir
				if(!slider_foto_sil_gelib){
					$.ajax({
						url:"slider-foto-sil/dsjhdsbcvjuhdsfbvuhjsdf.php",
						type:"POST",
						success:function(gelen){
							//php den echo olan tepmlateni div icine yazdirir
							$(".slider_foto__sil_main").html(gelen);
						}
					});
				}
				//eger melumatlar gelibse true olur ki, ikinci defe "Sliderdən foto sil"-e klik edende funksiya ise dusmesin
				slider_foto_sil_gelib = true;
			}
			//phpden gelen template icerisindeki buttona klik edende bu funksiya ise dusur
			function db_slider_foto_id_sil(this_id){
				//gelen deyer mehsul9050 olarsa mehsul sozunu silib 9050 cixart ve sadece mehsulun id adresini al
				var mehsul_id = this_id.slice(6);
				$.ajax({
					type:"POST",
					url:"slider-foto-sil/db_slider_foto_id_sil.php",
					data: {mehsul:mehsul_id},
					success:function(gelen){
						if(gelen == "foto_silindi"){
							//sliderden foto silindise deyisen false olur ve slider_fotolarini_getir() funksiyasi ise duserek databazadan en son datani cekir
							slider_foto_sil_gelib = false;
							return slider_fotolarini_getir();
						}
					},
					error:function(err){
						alert("Xəta baş verdi!");
					}
				});
			}
		</script>
<!-- SLIDERDEN FOTO SIL FINISH -->

<!-- UZVLER START -->
		<div id="uzvler">
			<div class="row">
				<div class="admin_tabs col-xs-12">
					<div class="uzvler_main"></div>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			var uzvler_gelib = false;
			//"Üzvlər"-e klik etdiyin zaman bu funksiya ise dusur
			function uzvleri_getir(){
				//eger uzvler_gelib deyiseni falsedirse databazadan melumatlari cekir
				if(!uzvler_gelib){
					$.ajax({
						url:"uzvler/hdsvbbvhjfddfvsdvbds.php",
						type:"POST",
						success:function(gelen){
							//php den echo olan tepmlateni div icine yazdirir
							$(".uzvler_main").html(gelen);
						}
					});
				}
				//eger melumatlar gelibse true olur ki, ikinci defe "Üzvlər"-e klik edende funksiya ise dusmesin
				uzvler_gelib = true;
			}
			//phpden gelen template icerisindeki buttona klik edende bu funksiya ise dusur
			function db_uzv_id_sil(this_id){
				var uzv_id = this_id;
				$.ajax({
					type:"POST",
					url:"uzvler/db_uzv_id_sil.php",
					data: {uzv_id:uzv_id},
					success:function(gelen){
						if(gelen == "uzv_silindi"){
							//uzv silindise deyisen false olur ve uzvleri_getir() funksiyasi ise duserek databazadan en son datani cekir
							uzvler_gelib = false;
							return uzvleri_getir();
						}
					},
					error:function(err){
						alert("Xəta baş verdi!");
					}
				});
			}
		</script>
<!-- UZVLER FINISH -->

<!-- SIFARISLER START -->
		<!-- Modal Window-->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-body">

		      </div>
		      <div class="modal-footer">
		      	<div class="text-center">
		       		<button type="button" class="btn btn-primary btn-lg" data-dismiss="modal"><strong>Bağla</strong></button>
		       	</div>
		      </div>
		    </div>
		  </div>
		</div>
		<div id="sifarisler">
			<div class="row">
				<div class="admin_tabs col-xs-12">
					<div class="sifarisler_main"></div>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			var sifarisler_gelib = false;
			//"Sifarişlər"-e klik etdiyin zaman bu funksiya ise dusur
			function sifarisleri_getir(){
				//eger sifarisler_gelib deyiseni falsedirse databazadan melumatlari cekir
				if(!sifarisler_gelib){
					$.ajax({
						url:"sifarisler/hjsbdvhvbfdsvbfdsuygvbeytrw.php",
						type:"POST",
						success:function(gelen){
							//php den echo olan tepmlateni div icine yazdirir
							$(".sifarisler_main").html(gelen);
						}
					});
				}
				//eger melumatlar gelibse true olur ki, ikinci defe "Sifarişlər"-e klik edende funksiya ise dusmesin
				sifarisler_gelib = true;
			}
			//bu funksiya databazada sifaris_gorulub sutununun deyerini deyisir ve gorulmus kimi deyisir
			function sifarisi_al(this_id){
				var user_id_sifarisi_al = this_id;
				$.ajax({
					url:"sifarisler/sifarisi_al.php",
					type:"POST",
					data:{user_id_sifarisi_al:user_id_sifarisi_al},
					success:function(gelen){
						if(gelen == "sifaris_alindi"){
							sifarisler_gelib = false;
							return sifarisleri_getir();
						}
					}
				});
			}
			//bu funksiya databazada sebet, sifaris_tamamlandi ve sifaris_gorulub sutunlarinin deyerini deyisir ve sifirlayir
			function verildi(this_id){
				var user_id_sifaris_verildi = this_id;
				$.ajax({
					url:"sifarisler/verildi.php",
					type:"POST",
					data:{user_id_sifaris_verildi:user_id_sifaris_verildi},
					success:function(gelen){
						if(gelen == "sifarisler_verildi"){
							sifarisler_gelib = false;
							return sifarisleri_getir();
						}
					}
				});
			}
			//bu funksiya secilen userin id adresine gore sebetindeki mehsullari gosterir
			function userin_sifarislerine_bax(this_id){
				var user_id_sifarisleri = this_id;
				$.ajax({
					url:"sifarisler/userin_sifarislerine_bax.php",
					type:"POST",
					data:{user_id_sifarisleri:user_id_sifarisleri},
					success:function(gelen){
						if(gelen){
							$(".modal-body").html(gelen);
							sifarisler_gelib = false;
							return sifarisleri_getir();
						}
					}
				});
			}
		</script>
<!-- SIFARISLER FINISH -->

		</div>
		<div class="col-xs-12 row">
			<button class='btn btn-danger admin_exit' onclick="exit_adminpanel()">Çıx</button>
		</div>


		<script type="text/javascript">
			function exit_adminpanel(){
				var exit = "exit";
				$.ajax({
					url:"exit_adminpanel.php",
					type:"POST",
					data:{exit:exit},
					success:function(gelen){
						if(gelen == "admin_exit"){
							window.location = "index.php";
						}
					},
					error:function(){
						alert("Xəta baş verdi!");
					}
				});
			}
			$(".kateqoriya_select").on("change", function(){
				var if_kateqoriya_uzuk_enable_size = $(".kateqoriya_select").val();
				if(if_kateqoriya_uzuk_enable_size == "uzuk"){
					$(".olcu").removeAttr("disabled");
					$(".olcu").val("Hər ölçüdə var");
				}else{
					$(".olcu").val("");
					$(".olcu").prop('disabled', true);
				}
			});
			$(".kateqoriya_select").on("change", function(){
				var if_kateqoriya_sirga_disable_cins = $(".kateqoriya_select").val();
				if(if_kateqoriya_sirga_disable_cins == "sirga"){
					$('.cins_qadin').attr("selected",true);
				}
			});
		</script>
	</div>
</body>
</html>