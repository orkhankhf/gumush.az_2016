<?php session_start(); 
	include "db-bakuweb/db.php"; 
?>
<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
		body{
			overflow: hidden;
		}
		.container{
			display: none;
		}
	</style>
	<meta charset="utf-8"/>
	<link rel="author" href="https://plus.google.com/108728687434805525511/posts"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta property="og:url" content="http://gumush.az/axtaris.php" />
	<meta property="og:type" content="website" />
	<meta property="og:title" content="Qadın Və Kişi Gümüşlərinin Onlayn Satışı" />
	<meta property="og:description" content="Axtarış Nəticələri" />
	<meta property="og:image" content="http://gumush.az/img/silverstorexl.jpg" />
	<meta property="og:image:type" content="image/jpeg" />
	<meta property="og:image:width" content="400" />
	<meta property="og:image:height" content="300" />
	<meta property="fb:app_id" content="268883703487579" />
	<meta property="fb:admins" content="ideal.nasirzade" />
	<meta property="fb:admins" content="OrxanDWK" />
	<meta property="og:site_name" content="Gumush" />
   	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="alternate" hreflang="az" href="http://gumush.az/axtaris.php" />
   	<link rel="icon" href="img/favicon.png" type="image/png" sizes="16x16">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="css/normalize.css" />
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/ideal.css">
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/angular.min.js"></script>
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
		    document.title = "Axtarış nəticələri";
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
		<?php
			function signed_in(){
				echo "<style>.header_top_right li:nth-child(3),.header_top_right li:nth-child(4){display:none !important;}</style>";
			}
			function signed_fail(){
				echo "<style>.header_top_right li:nth-child(2){display:none !important;}</style>";
			}
			if(isset($_SESSION['user_id'])){
				signed_in();
			}else{
				signed_fail();
			}
		?>
		<!-- REGISTER AND SIGN UP START -->
			<div class="alert alert-success qeydiyyat_tamamlandi">
				<a onclick="qeydiyyat_tamamlandi_alert_bagla()" class="close">&times;</a>
				<strong>Qeydiyyat Tamamlandı!</strong>
				<p>Xahiş edirik e-mail adresinizə göndərilən linkə daxil olaraq hesabınızı aktivləşdirin, daha sonra hesabınıza daxil olun.</p>
			</div>
			<div class="alert alert-success sifre_berpa_tamamlandi">
				<a onclick="sifre_berpa_tamamlandi_alert_bagla()" class="close">&times;</a>
				<strong>Əməliyyat tamamlandı!</strong>
				<p>Xahiş edirik e-mail adresinizə göndərilən linkə daxil olaraq yeni şifrənizi daxil edin.</p>
			</div>

			<div class="regBackground"></div>
			<div class='regForm' ng-app="silverstore" ng-controller="qeydiyyat">
				<form class="form-horizontal" novalidate="novalidate">
					<p>Qeydiyyat</p>
					<div class="form-group">
						<label class="col-md-4 control-label" for="signup_ad">Ad</label>  
						<div class="col-md-5">
							<input ng-focus="hide_validate_spans()" id="signup_ad" name="signup_ad" type="text" placeholder="adınız" class="form-control" required="">
							<div class="alert alert-danger validate_spans ad_span">
								<span></span>
							</div>
					    </div>
					</div>
					<div class="form-group">
						<label class="col-md-4 control-label" for="signup_soyad">Soyad</label>  
						<div class="col-md-5">
							<input ng-focus="hide_validate_spans()" id="signup_soyad" name="signup_soyad" type="text" placeholder="soyadınız" class="form-control" required="">
					    	<div class="alert alert-danger validate_spans soyad_span">
								<span></span>
							</div>
					    </div>
					</div>
					<div class="form-group">
						<label class="col-md-4 control-label" for="signup_email">E-mail</label>  
						<div class="col-md-5">
							<input ng-focus="hide_validate_spans()" id="signup_email" name="signup_email" type="email" placeholder="e-mail adresiniz" class="form-control" required="">  
							<div class="alert alert-danger validate_spans email_span">
								<span></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 control-label" for="sifre">Şifrə</label>
						<div class="col-md-5">
							<input ng-focus="hide_validate_spans()" id="sifre" name="sifre" type="password" placeholder="şifrəniz" class="form-control" required="">  
							<div class="alert alert-danger validate_spans sifre_span">
								<span></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 control-label" for="signup_sifre_tekrar">Şifrə təsdiq</label>
						<div class="col-md-5">
							<input ng-focus="hide_validate_spans()" id="signup_sifre_tekrar" name="signup_sifre_tekrar" type="password" placeholder="şifrənizi təsdiqləyin" class="form-control" required="">  
							<div class="alert alert-danger validate_spans sifre_tekrar_span">
								<span></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 control-label" for="signup_telefon">Telefon</label>  
						<div class="col-md-5">
							<input ng-focus="hide_validate_spans()" id="signup_telefon" name="signup_telefon" type="number" placeholder="nömrəniz" class="form-control" required="">  
							<div class="alert alert-danger validate_spans telefon_span">
								<span></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 control-label" for="signup"></label>
						<div class="col-md-5">
							<button ng-click="qeydiyyat_submit()" id="signup" type="submit" class="btn btn-success">Tamamla</button>
							<button id="cancel_reg" type="reset" onclick="none_register()" class="btn btn-success">Ləğv et</button>
						</div>
					</div>
					<script type="text/javascript">
						function registration_validation(){
							hide_validate_spans();
							var ad = $("#signup_ad").val();
							var soyad = $("#signup_soyad").val();
							var email = $('#signup_email').val();
							var parol = $('#sifre').val();
							var parol_tekrar = $("#signup_sifre_tekrar").val();
							var tel = $("#signup_telefon").val();
							if(ad == ""){
								$(".ad_span").fadeIn(200);
								$(".ad_span span").text("Adınızı daxil edin!");
							}else if(ad.length < 2){
								$(".ad_span").fadeIn(200);
								$(".ad_span span").text("Ad çox qısadır (min. 2)!");
							}else if(ad.length > 12){
								$(".ad_span").fadeIn(200);
								$(".ad_span span").text("Ad çox uzundur (max. 12)!");
							}else if(NameIsLetter(ad) == false){
								$(".ad_span").fadeIn(200);
								$(".ad_span span").text("Ad yalnız hərflərdən ibarət olmalıdır!");
							}else if(soyad == ""){
								$(".soyad_span").fadeIn(200);
								$(".soyad_span span").text("Soyadınızı daxil edin!");
							}else if(soyad.length < 3){
								$(".soyad_span").fadeIn(200);
								$(".soyad_span span").text("Soyad çox qısadır (min. 3)!");
							}else if(soyad.length > 15){
								$(".soyad_span").fadeIn(200);
								$(".soyad_span span").text("Soyad çox uzundur (max. 15)!");
							}else if(SurNameIsLetter(soyad) == false){
								$(".soyad_span").fadeIn(200);
								$(".soyad_span span").text("Soyad yalnız hərflərdən ibarət olmalıdır!");
							}else if(email == ""){
								$(".email_span").fadeIn(200);
								$(".email_span span").text("E-mail adresinizi daxil edin!");
							}else if(IsEmail(email) == false){
								$(".email_span").fadeIn(200);
								$(".email_span span").text("E-mail adresinizi düzgün yazın!");
							}else if(email.length < 8){
								$(".email_span").fadeIn(200);
								$(".email_span span").text("E-mail adresi çox qısadır (min. 8)!");
							}else if(email.length > 30){
								$(".email_span").fadeIn(200);
								$(".email_span span").text("E-mail adresi çox uzundur (max. 30)!");
							}else if(parol == ""){
								$(".sifre_span").fadeIn(200);
								$(".sifre_span span").text("Şifrənizi daxil edin!");
							}else if(IsParol(parol) == false || parol.match(/_/)){
								$(".sifre_span").fadeIn(200);
								$(".sifre_span span").text("Şifrə rəqəm və hərflərdən ibarət olmalıdır!");
							}else if(parol.length < 6){
								$(".sifre_span").fadeIn(200);
								$(".sifre_span span").text("Şifrə çox qısadır (min. 6)!");
							}else if(parol.length > 20){
								$(".sifre_span").fadeIn(200);
								$(".sifre_span span").text("Şifrə çox uzundur (max. 20)!");
							}else if(parol_tekrar == ""){
								$(".sifre_tekrar_span").fadeIn(200);
								$(".sifre_tekrar_span span").text("Şifrənizi təsdiq edin!");
							}else if(parol_tekrar != parol){
								$(".sifre_tekrar_span").fadeIn(200);
								$(".sifre_tekrar_span span").text("Şifrə eyni deyil!");
							}else if(tel == ""){
								$(".telefon_span").fadeIn(200);
								$(".telefon_span span").text("Telefon nömrənizi daxil edin!")
							}else if(tel.length < 10){
								$(".telefon_span").fadeIn(200);
								$(".telefon_span span").text("Nömrə çox qısadır (min. 10)!");
							}else if(tel.length > 10){
								$(".telefon_span").fadeIn(200);
								$(".telefon_span span").text("Nömrə çox uzundur (max. 10)!");
							}else{
								$.ajax({
									url:"register_bw/index.php",
									type:"POST",
									data:{
										a:ad,b:soyad,c:email,d:parol,e:tel
									},
									success:function(gelen){
										if(gelen == "ok"){
											$(".regForm").find('input').val("");
											$(".regBackground").fadeOut("slow");
											$(".regForm").fadeOut("slow");
											setTimeout(function(){
												$(".qeydiyyat_tamamlandi").fadeIn(600);
											},1000)
										}else if(gelen == "email_is_registered"){
											$(".email_span").fadeIn(200);
											$(".email_span span").text("Bu e-mail adresi artıq sistemimizdə mövcuddur!");
										}else{
											alert("Xəta baş verdi!Xahiş edirik bunu bizə bildirin!");
										}
									},
									error:function(){
										alert("Xəta baş verdi!Xahiş edirik bunu bizə bildirin!");
									}

								})
							}
						}
						function NameIsLetter(ad){
							var herf_yoxla = /^([a-zA-Z\ə\ö\ç\ş\ı\ğ\ü\Ə\Ö\Ç\Ş\I\İ\Ğ\Ü]+)$/;
							if(!herf_yoxla.test(ad)){
						       	return false;
						       }else{
						       	return true;
						       }
						}
						function SurNameIsLetter(soyad){
							var herf_yoxla = /^([a-zA-Z\ə\ö\ç\ş\ı\ğ\ü\Ə\Ö\Ç\Ş\İ\I\Ğ\Ü]+)$/;
							if(!herf_yoxla.test(soyad)){
						       	return false;
						       }else{
						       	return true;
						       }
						}
						function IsEmail(email){
						    var email_yoxla = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
						    if(!email_yoxla.test(email)){
						    	return false;
						    }else{
						    	return true;
						    }
						}
						function IsParol(parol){
							var parol_yoxla = /^\w+$/;
							if(!parol_yoxla.test(parol)){
						    	return false;
						    }else{
						    	return true;
						    }
						}
						angular.module("silverstore", [])
						.controller("qeydiyyat", function($scope){
							$scope.qeydiyyat_submit = function(){
								return registration_validation();
							}
							$scope.hide_validate_spans = function(){
								$(".validate_spans").fadeOut(400);
							}
						});
					</script>
				</form>
			</div>

			<div class="sign_in">
				<p>Daxil Ol</p>
				<form class="form-horizontal" novalidate="novalidate">
					<div class="form-group">
						<label class="col-md-4 control-label" for="signin_email">E-mail</label>  
						<div class="col-md-5">
							<input onfocus="hide_validate_spans()" id="signin_email" name="signin_email" type="email" placeholder="e-mail adresiniz" class="form-control" required="">
							<div class="alert alert-danger validate_spans sign_email_span">
								<span></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 control-label" for="signin_password">Şifrə</label>  
						<div class="col-md-5">
							<input onfocus="hide_validate_spans()" id="signin_password" name="signin_password" type="password" placeholder="şifrəniz" class="form-control input-md" required="">
							<div class="alert alert-danger validate_spans sign_sifre_span">
								<span></span>
							</div>
					    </div>
					</div>
					<div class="form-group">
						<label class="col-md-4 control-label"></label>
						<div class="col-md-5">
							<button id="sifremi_unuttum_btn" type="reset" onclick="rec_pass_block()" class="btn btn-success">Şifrəmi unuttum</button>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 control-label" for="signin"></label>
						<div class="col-md-5">
							<span id="signin" class="btn btn-success sign_in_submit_span" onclick="sign_in_validation_and_ajax()">Daxil ol</span>
							<button id="cancel" type="reset" onclick="none_enter()" class="btn btn-success">Geri</button>
						</div>
					</div>
				</form>
			</div>
			<script type="text/javascript">
				$(".sign_in form").keyup(function(event){
				    if(event.keyCode == 13){
				        $(".sign_in_submit_span").click();
				    }
				});
				function sign_in_validation_and_ajax(){
					hide_validate_spans();
					var sign_email = $("#signin_email").val();
					var sign_password = $("#signin_password").val();

					if(sign_email == ""){
						$(".sign_email_span").fadeIn(200);
						$(".sign_email_span span").text("E-mail adresinizi daxil edin!");
					}else if(IsEmail(sign_email) == false){
						$(".sign_email_span").fadeIn(200);
						$(".sign_email_span span").text("E-mail adresinizi düzgün yazın!");
					}else if(sign_email.length < 8){
						$(".sign_email_span").fadeIn(200);
						$(".sign_email_span span").text("E-mail adresi çox qısadır (min. 8)!");
					}else if(sign_email.length > 30){
						$(".sign_email_span").fadeIn(200);
						$(".sign_email_span span").text("E-mail adresi çox uzundur (max. 30)!");
					}else if(sign_password == ""){
						$(".sign_sifre_span").fadeIn(200);
						$(".sign_sifre_span span").text("Şifrənizi daxil edin!");
					}else if(IsParol(sign_password) == false || sign_password.match(/_/)){
						$(".sign_sifre_span").fadeIn(200);
						$(".sign_sifre_span span").text("Şifrə rəqəm və hərflərdən ibarət olmalıdır!");
					}else if(sign_password.length < 6){
						$(".sign_sifre_span").fadeIn(200);
						$(".sign_sifre_span span").text("Şifrə çox qısadır (min. 6)!");
					}else if(sign_password.length > 20){
						$(".sign_sifre_span").fadeIn(200);
						$(".sign_sifre_span span").text("Şifrə çox uzundur (max. 20)!");
					}else{
								$.ajax({
									url:"sign_in_bw/index.php",
									type:"POST",
									data:{
										a:sign_email,b:sign_password
									},
									success:function(gelen){
										if(gelen == ""){
											$(".sign_email_span").fadeIn(200);
											$(".sign_email_span span").text("Bu e-mail adresi sistemimizdə mövcud deyil!");
										}else if(gelen == "sifre_sehvdir"){
											$(".sign_sifre_span").fadeIn(200);
											$(".sign_sifre_span span").text("Şifrə yalnışdır!");
										}else if(gelen == "hesab_aktiv_deyil"){
											$(".sign_email_span").fadeIn(200);
											$(".sign_email_span span").text("Hesabınız aktiv deyil ! E-mail adresinizə göndərilən linkə daxil olaraq hesabınızı aktivləşdirin.");
										}else if(gelen == "signed_in"){
											$(".sign_in").find('input').val("");
											$(".regBackground").fadeOut("slow");
											$(".sign_in").fadeOut("slow");
											location.reload();
										}else{
											alert("Xəta baş verdi!Xahiş edirik bunu bizə bildirin!");
										}
									},
									error:function(){
										alert("Xəta baş verdi!Xahiş edirik bunu bizə bildirin!");
									}

								})
							}
				}
				function hide_validate_spans(){
					$(".validate_spans").fadeOut(400);
				}
			</script>

			<div class="recovery_password">
				<p>Şifrə bərpa</p>
				<div class="form-horizontal">
					<div class="form-group">
						<label class="col-md-4 control-label" for="rec_pass">E-mail</label>  
						<div class="col-md-5">
							<input id="rec_pass" onclick="hide_validate_spans()" onkeydown="hide_validate_spans()" type="email" placeholder="e-mail adresiniz" class="form-control">
							<div class="alert alert-danger validate_spans rec_pas_span">
								<span></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 control-label" for="signin"></label>
						<div class="col-md-5">
							<button id="signin" class="btn btn-success" onclick="my_recovery_password()">Göndər</button>
							<button id="cancel" onclick="recovery_password_none()" class="btn btn-success">Geri</button>
						</div>
					</div>
				</div>
			</div>
			<script type="text/javascript">
				$(".recovery_password").keydown(function(knopka){
					if(knopka.keyCode == 13){
						my_recovery_password();
					}
				});
				function my_recovery_password(){
					var recovery_email = $("#rec_pass").val();
					if(recovery_email == ""){
						$(".rec_pas_span").fadeIn(200);
						$(".rec_pas_span span").text("E-mail adresinizi daxil edin!");
					}else if(IsEmail(recovery_email) == false){
						$(".rec_pas_span").fadeIn(200);
						$(".rec_pas_span span").text("E-mail adresinizi düzgün yazın!");
					}else if(recovery_email.length < 8){
						$(".rec_pas_span").fadeIn(200);
						$(".rec_pas_span span").text("E-mail adresi çox qısadır (min. 8)!");
					}else if(recovery_email.length > 30){
						$(".rec_pas_span").fadeIn(200);
						$(".rec_pas_span span").text("E-mail adresi çox uzundur (max. 30)!");
					}else{
						$.ajax({
							url:"password_recovery/index.php",
							type:"POST",
							data:{
								a:recovery_email
							},
							success:function(gelen){
								if(gelen == "email_gonderildi"){
									$(".regBackground").fadeOut("fast");
									$(".recovery_password").fadeOut("fast");
									$(".sifre_berpa_tamamlandi").fadeIn(600);
									$("#rec_pass").val("");
								}else if(gelen == "email_duzgun_daxil_edilmeyib"){
									$(".rec_pas_span").fadeIn(200);
									$(".rec_pas_span span").text("E-mail adresinizi düzgün yazın!");
								}else if(gelen == "email_movcud_deyil"){
									$(".rec_pas_span").fadeIn(200);
									$(".rec_pas_span span").text("Bu e-mail adresi sistemimizdə mövcud deyil!");
								}
							},
							error:function(){
								alert("Xəta baş verdi!Xahiş edirik bunu bizə bildirin!");
							}
						});
					}
				}

				function qeydiyyat_tamamlandi_alert_bagla(){
					$(".qeydiyyat_tamamlandi").fadeOut(400);
				}
				function sifre_berpa_tamamlandi_alert_bagla(){
					$(".sifre_berpa_tamamlandi").fadeOut(400);
				}
				function block_register(){
					$(".regBackground").fadeIn("slow");
					$(".regForm").fadeIn("slow");
				}
				function none_register(){
					$(".regBackground").fadeOut("fast");
					$(".regForm").fadeOut("fast");
					$(".validate_spans").fadeOut(10);
				}
				function block_sign_in(){
					$(".regBackground").fadeIn("slow");
					$(".sign_in").fadeIn("slow");
				}
				function none_enter(){
					$(".regBackground").fadeOut("fast");
					$(".sign_in").fadeOut("fast");
					$(".validate_spans").fadeOut(10);
				}
				function rec_pass_block(){
					$(".sign_in").fadeOut("fast");
					$(".regBackground").fadeIn("slow");
					$(".recovery_password").fadeIn("slow");
				}
				function recovery_password_none(){
					$(".recovery_password").fadeOut("fast");
					$(".sign_in").fadeIn("slow");
					$("#rec_pass").val("");
					$(".validate_spans").fadeOut(10);
				}
				$(".regBackground").click(function(){
					$(".regBackground").fadeOut("fast");
					$(".regForm").fadeOut("fast");
					$(".sign_in").fadeOut("fast");
					$(".recovery_password").fadeOut("fast");
					$(".validate_spans").fadeOut(10);

					$(".regForm").find('input').val("");
					$(".sign_in").find('input').val("");
					$(".recovery_password").find('input').val("");
				});
			</script>
		<!-- REGISTER AND SIGN UP FINISH -->

		<!-- TOP HEADER START -->
				<div class="my_top_header">
					<ul class="header_top_left">
						<li><a href="." title="gumush.az">Ana Səhifə</a></li>
						<li><a href="contact" title="bizimle elaqe">Bizimlə Əlaqə</a></li>
					</ul>
					<script type="text/javascript">
						function exit(){
							$.ajax({
								url:"exit.php",
								type:"POST",
								data:{
									exit:"exit"
								},
								success:function(gelen){
									location.reload();
								},
								error:function(){
									alert("Xəta baş verdi!Xahiş edirik bunu bizə bildirin!");
								}
							});
						}
					</script>
					<ul class="header_top_right">
						<li><a href="sebetim" title="sebetim">Səbətim</a></li>
						<li><button onclick="exit()">Çıxış</button></li>
						<li><button onclick="block_sign_in()">Daxil Ol</button></li>
						<li><button onclick="block_register()">Qeydiyyat</button></li>
					</ul>
				</div>
		<!-- TOP HEADER FINISH -->
		
		<!-- HEADER START -->
			<div class="row">
				<header class="col-xs-12 col-md-12">
					<div class="logo col-md-8 col-xs-12">
						<a href="." title="gumush.az">
							<img src="img/silverstore.jpg" alt="gumush.az">
						</a>
					</div>
					<div class="searchBox col-md-4 col-xs-12">
						<div class="input-group">
					  		<input type="text" class="form-control axtar_input" placeholder="Axtar">
					      	<span class="input-group-btn">
							    <button class="btn btn-default header_search_btn" onclick="axtar()">
							    	<img src="img/axtar.png" alt="axtar">
							    </button>
					      	</span>
					      	<script type="text/javascript">
					      		$(".axtar_input").keydown(function(knopka){
									if(knopka.keyCode == 13){
										axtar();
									}
								});
					      		function axtar(){
					      			var axtar_input = $(".axtar_input").val();
					      			if(axtar_input != ""){
					      				//axtarisa yazilan texti urla uygun hala getirir
						      			function herfleri_deyis(text){
										    var herfler = {
										        'çÇ':'c',
										        'ğĞ':'g',
										        'şŞ':'s',
										        'üÜ':'u',
										        'ıİI':'i',
										        'öÖ':'o',
										        'əƏ':'e'
										    };
										    for(var acar in herfler) {
										        text = text.replace(new RegExp('['+acar+']','g'), herfler[acar]);
										    }
										    return  text.trim()
										    			.replace(/[^-a-zA-Z0-9\s]+/ig, '') // herf ve reqemden basqa herseyi sil
										                .replace(/\s/gi, "-") // bosluqlari- ile evezle
										                .replace(/[-]+/gi, "-") // tekrarlanan -- lari - ile evezle
										                .toLowerCase();
										}
										axtar_input = herfleri_deyis(axtar_input);
						      			window.location.href="axtaris.php?txt="+axtar_input;
					      			}
					      		}
					      	</script>
					    </div>
					</div>
				</header>
			</div>
		<!-- HEADER FINISH -->
		<h1 class="seo_h1">Qadın Gümüşləri Kişi Gümüşləri Qadin Gumusleri Kisi Gumusleri Qadin Və Kisi Gumusleri Ucuz Gumusler</h1>
		<!-- NAVBAR START -->
			<div class="row main_divs_space">
				<div class="mynav_div col-xs-12">
					<nav class="navbar col-xs-12">
						<p class="closed_menu"></p>
						<ul> 
							<li>
								<a class="menu_before" href="uzuk" title="Üzüklər">Üzüklər</a>
							</li>
							<li>
								<a class="menu_before" href="sirga" title="Sırqalar">Sırğalar</a>
							</li>
							<li>
								<a class="menu_before" href="qolbaq" title="Qolbaqlar">Qolbaqlar</a>
							</li>
							<li>
								<a class="menu_before" href="boyunbagi" title="Boyunbağılar">Boyunbağılar</a>
							</li>	
							<li>
								<a class="menu_before" href="komplekt" title="Komplektlər">Komplektlər</a>
							</li>
						</ul>
					</nav>
				</div>
			</div>
			<script type="text/javascript">
				$(".closed_menu").after().click(function(){
					$(".navbar").find("ul").slideToggle(700);
				})
			</script>
		<!-- NAVBAR FINISH -->

		<!-- SIFARISH POP-UP'S START -->
			<div class="sifarish_oldu_bg"></div>
			<div class="sifarish_oldu">
				<p>Məhsul səbətə əlavə olundu.</p>
				<button onclick="alish_verise_davam_et()">Alış-verİşə davam et</button>
				<button onclick="alish_verisi_bitir()">Alış-verİşİ bİtİr</button>
			</div>
			<div class="sifarish_limiti_dolub">
				<p>Sifariş limitiniz dolub!</p>
				<p>Xahiş edirik, öncəki sifarişlərinizi tamamlayın!</p>
				<button onclick="alis_verisi_bitir_limit_dolub()">Alış-verİşİ bİtİr</button>
			</div>
			<div class="sifarish_xeta">
				<p>Xəta baş verdi! Xahiş edirik bunu bizə bildirin.</p>
				<button onclick="xetani_bildirin()">Bİldİr</button>
				<button onclick="xeta_bagla()">Bağla</button>
			</div>
			<div class="sifarish_ucun_daxil_olun">
				<p>Sifariş vermək üçün hesabınıza daxil olun!</p>
				<button onclick="sifarish_daxil_ol()">Daxİl ol</button>
				<button onclick="sifarish_qeydiyyatdan_kec()">Qeydİyyatdan keç</button>
			</div>
			<script type="text/javascript">
				//alis verise davam edir
				function alish_verise_davam_et(){
					$(".sifarish_oldu_bg,.sifarish_oldu").hide(600);
				}
				//alis verisi bitirmek ucun sebete gedir
				function alish_verisi_bitir(){
					$(".sifarish_oldu_bg,.sifarish_oldu").hide(600);
					setTimeout(function(){
						//basqa sehifelerde istifade edende adresi uygun olaraq deyis
						window.location.href="sebetim";
					},600);
				}
				//alis verisi bitirmek ucun sebete gedir
				function alis_verisi_bitir_limit_dolub(){
					$(".sifarish_oldu_bg,.sifarish_limiti_dolub").hide(600);
					setTimeout(function(){
						//basqa sehifelerde istifade edende adresi uygun olaraq deyis
						window.location.href="sebetim";
					},600);
				}
				//xeta bas vererse bunu contact sehifesi vasitesile bildirir
				function xetani_bildirin(){
					$(".sifarish_oldu_bg,.sifarish_xeta").hide(600);
					setTimeout(function(){
						//basqa sehifelerde istifade edende adresi uygun olaraq deyis
						window.location.href="contact";
					},600);
				}
				//bildirmek istemese xeta bildiris penceresini baglayir
				function xeta_bagla(){
					$(".sifarish_oldu_bg,.sifarish_xeta").hide(600);
				}
				//daxil ol pop up display block olur ve sifaris ucun daxil ol pop up display none olur
				function sifarish_daxil_ol(){
					$(".sifarish_oldu_bg,.sifarish_ucun_daxil_olun").hide(600);
					setTimeout(function(){
						block_sign_in();
						$("html, body").animate({ scrollTop: 0 }, "slow");
					},600);
				}
				//qeydiyyatdan kec pop up display block olur ve sifaris ucun daxil ol pop up display none olur
				function sifarish_qeydiyyatdan_kec(){
					$(".sifarish_oldu_bg,.sifarish_ucun_daxil_olun").hide(600);
					setTimeout(function(){
						block_register();
						$("html, body").animate({ scrollTop: 0 }, "slow");
					},600);
				}
			</script>
		<!-- SIFARISH POP-UP'S FINISH -->

		<!-- SIFARISH FUNKSIYASI START -->
			<script type="text/javascript">
				function sifarish(this_id){
					//gelen deyer mehsul9050 olarsa mehsul sozunu silib 9050 cixart ve sadece mehsulun id adresini al
					var mehsul_id = this_id.slice(6);
					$.ajax({
						type:"POST",
						url:"sebetim/elave_et.php",
						data: {mehsul:mehsul_id},
						success:function(gelen){
							if(gelen == "limit_dolub"){
								$(".sifarish_oldu_bg,.sifarish_limiti_dolub").show(600)
							}else if(gelen == "sifarish_oldu"){
								$(".sifarish_oldu_bg,.sifarish_oldu").show(600);
							}else if(gelen == "xeta"){
								$(".sifarish_oldu_bg,.sifarish_xeta").show(600);
							}else if(gelen == "daxil_olun"){
								$(".sifarish_oldu_bg,.sifarish_ucun_daxil_olun").show(600);
							}
						},
						error:function(err){
							alert("Xəta baş verdi!");
							my_correct_url();
						}
					});
				}
			</script>
		<!-- SIFARISH FUNKSIYASI FINISH -->

		<!-- AXTARIS NETICELERI START -->
			<div class="row main_divs_space">
					<div class="sellList col-xs-12">
						<div class="row">
							<div id="en_yeniler" class="tab-pane fade in active">
								<?php
									//urldan axtarilan kelimeleri alir
									if(isset($_GET['txt']) && !empty($_GET['txt'])){
										//kenarindaki bosluqlari temizleyir sonra filter edir
										$axtarilan = trim($_GET['txt']);
										$axtarilan = filter_var($axtarilan,FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_LOW);
										//linkdeki deyer eger orxan-ideal-merve olsa onu arraya atir
										$axtarilan = explode("-", $axtarilan);
										//select sorgusunu duzeldir
										$select = "SELECT id,basliq,qiymet,tmp,img_alt,a_title FROM mehsullar WHERE ";

										//eger linkde kisi veya qadin sozu varsa eks cinsin neticelerini gosterme, meselen: "kisi gumus uzuk" yazsa gumus ve uzuk neticelerine uygun qadin cinsine aid mehsullari getirme
										//kisi sozu varsa indeksini al
										$index_of_kisi = array_search("kisi", $axtarilan, TRUE);
										//qadin sozu varsa indeksini al
										$index_of_qadin = array_search("qadin", $axtarilan, TRUE);
										$kisi_qadin = false;
										if($axtarilan[$index_of_kisi] == "kisi" && count($axtarilan) > 1){
											$select .= "id not in (select id from mehsullar WHERE cins LIKE '%qadin%') AND cins='kisi' AND ( ";
											$kisi_qadin = true;
										}else if($axtarilan[$index_of_qadin] == "qadin" && count($axtarilan) > 1){
											$select .= "id not in (select id from mehsullar WHERE cins LIKE '%kisi%') AND cins='qadin' AND ( ";
											$kisi_qadin = true;
										}
										for($a=0;$a<count($axtarilan);$a++){
											$select .= "tmp LIKE '%$axtarilan[$a]%' ";
											$select .= " OR ";
										}
										$select = substr($select, 0, -4);
										if($kisi_qadin == true){
											$select .= " ) ORDER BY id DESC LIMIT 60";
										}else{
											$select .= " ORDER BY id DESC LIMIT 60";
										}
										if($conn){
											$netice_var = false;

											$netice = mysqli_query($conn,$select);
											while($row = mysqli_fetch_assoc($netice)){
												$netice_var = true;

												echo "<div class='sellone col-md-3 col-sm-4 col-xs-12'>
														<div class='imgBox col-xs-12'>
															<img src='item/".$row['tmp']."/image0.jpg' alt='".$row['img_alt']."'>
														</div>
														<h2>".$row['basliq']."</h2>
														<p>".$row['qiymet']." AZN</p>
														<a class='add_a_btn' title='".$row['a_title']."'>
															<button class='btn btn-success' onclick='sifarish(this.id)' id='mehsul".$row['id']."'>Sİfarİş</button>
														</a>
														<a class='more_a_btn' href='item/".$row['tmp']."' title='".$row['a_title']."'>
															<button class='btn btn-success'>Ətraflı</button>
														</a>
													</div>";
											}
											if(!$netice_var){
												echo "<div class='col-xs-12'><p class='netice_tapilmadi alert alert-info' role='alert'>Axtardığınız məhsul taplılmadı!</p></div>";
											}
										}
										mysqli_close($conn);
									}else{
										echo "<div class='col-xs-12'><p class='netice_tapilmadi alert alert-info' role='alert'>Axtardığınız məhsul taplılmadı!</p></div>";
									}
									
								?>
							</div>
						</div>
					</div>
			</div>
		<!-- AXTARIS NETICELERI FINISH -->

		<!-- CONTACT US START -->
			<div class="row main_divs_space">
					<div class="contactUs col-xs-12">
						<div class="contactFace col-md-4">
							<h3>Bizi Facebook`da izləyin</h3>
							<div class="fb-page" data-href="https://www.facebook.com/gumush.az/" data-tabs="messages" data-width="270" data-height="350" data-small-header="false" data-adapt-container-width="false" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/gumush.az/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/gumush.az/">Gumush.az</a></blockquote></div>
						</div>
						<div class="freeDelivery col-md-4">
							<div class="my_box">
								<div class="col-xs-2 my_truck">
									
								</div>
								<div class="col-xs-10">
									<h3>Pulsuz Çatdırılma</h3>
									<p>Bakı şəhəri daxilində sifariş verdiyiniz məhsulları istədiyiniz ünvana heç bir əlavə ödəniş tələb etmədən vaxtında çatdırırıq.</p>
								</div>
							</div>
							<div class="my_box">
								<div class="col-xs-2 qapida_odeme">
									
								</div>
								<div class="col-xs-10">
									<h3>Qapıda Ödəmə</h3>
									<p>Ödənişi sizdən nağd və sifariş etdiyiniz məhsulları təhvil aldığınız zaman alırıq.</p>
								</div>
							</div>
							<div class="my_box">
								<div class="col-xs-2 SSL_icon">
									
								</div>
								<div class="col-xs-10">
									<h3>Etibarlı Alış-Veriş</h3>
									<p>Alış-verişinizi daha etibarlı edə bilməyiniz üçün SSL təhlükəsizlik sertifikatından istifadə edirik.</p>
								</div>
							</div>
						</div>
						<div class="customBlock col-md-4">
							<div class="my_box">
								<div class="col-xs-2 SSL_icon">
									
								</div>
								<div class="col-xs-10">
									<h3>Şəxsi Məlumatlarınızın Təhlükəsizliyi</h3>
									<p>Gumush.az`a verdiyiniz bütün məlumatlar qətiliklə gizli tutulacaq. Şəxsi məlumatlarınız mövzusunda nə qədər həssas olduğunuzu bilirik. Məxfi məlumatlarınızı üçüncü şəxslər və ya firmamızın əməkdaşlarının bilməsi qeyri-mümkündür.</p>
								</div>
							</div>
						</div>
					</div>
			</div>
		<!-- CONTACT US FINISH -->

		<!-- INFORMATION START -->
			<div class="row main_divs_space">
				<div class="allSection col-xs-12">
					<div class="thirdSection">
						<div class="cover_footer_top col-xs-12"> </div>
						<div class="leftSection col-md-4">
							<h3>Əlaqə</h3>
							<ul> 
								<li><a>Mobil: <span>055 581 08 72</span></a></li>
								<li><a>E-mail: <span>support@gumush.az</span></a></li>
								<li><a href="contact"><strong>Əlaqə Formu</strong></a></li>
							</ul>
						</div>
						<div class="middleSection col-md-4">
							<h3>Məhsullar</h3>
							<ul> 
								<li><a href="uzuk" title="gumus uzukler">Gümüş Üzüklər</a></li>
								<li><a href="sirga" title="gumus sirgalar">Gümüş Sırğalar</a></li>
								<li><a href="qolbaq" title="gumus qolbaqlar">Gümüş Qolbaqlar</a></li>
								<li><a href="boyunbagi" title="gumus boyunbagilar">Gümüş Boyunbağılar</a></li>
								<li><a href="komplekt" title="gumus komplektler">Gümüş Komplektlər</a></li>
							</ul>
						</div>
						<div class="rightSection col-md-4">
							<h3>bİzİ İzləyİn</h3>
							<ul> 
								<li><a href="https://www.facebook.com/gumush.az/" target="_blank"><i class="fa fa-facebook-official thirdSection_sosials"></i>Facebook</li></a>
								<li><a href="https://www.instagram.com/gumush_az/" target="_blank"><i class="fa fa-instagram thirdSection_sosials"></i>Instagram</li></a>
								<li><a href="https://twitter.com/gumush_az/" target="_blank"><i class="fa fa-twitter-square thirdSection_sosials"></i>Twitter</li></a>
								<li><a href="https://www.youtube.com/channel/UCFDdBQEIqQRLwWiTNDQ2IEA" target="_blank"><i class="fa fa-youtube thirdSection_sosials"></i>Youtube</li></a>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<script type="text/javascript">
				$(".leftSection h3").after().click(function(){
					$(".leftSection ul").slideToggle(600);
				})
				$(".middleSection h3").after().click(function(){
					$(".middleSection ul").slideToggle(600);
				})
				$(".rightSection h3").after().click(function(){
					$(".rightSection ul").slideToggle(600);
				})
			</script>
		<!-- INFORMATION FINISH -->

		<!-- FOOTER START -->
			<div class="row">
				<div class="col-xs-12">
					<footer class="footer">
						<p> Copyright © 2016 GUMUSH.AZ <br><br> Bütün Hüquqlar Qorunur.</p>
						<a class="webmaster" href="http://bakuweb.az/" target="_blank" title="Bakuweb web dizayn">BY BakuWeb Studio</a>
					</footer>
				</div>
			</div>
		<!-- FOOTER FINISH -->
	</div>
</body>
</html>
