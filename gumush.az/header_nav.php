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
									url:"../register_bw/index.php",
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
											$(".email_span span").text("Bu e-mail adresi artıq sistemimizdə mövcuddur!!");
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
									url:"../sign_in_bw/index.php",
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
							url:"../password_recovery/index.php",
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
						<li><a href="../" title="gumush.az">Ana Səhifə</a></li>
						<li><a href="../contact" title="bizimle elaqe">Bizimlə Əlaqə</a></li>
					</ul>
					<script type="text/javascript">
						function exit(){
							$.ajax({
								url:"../exit.php",
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
						<li><a href="../sebetim" title="sebetim">Səbətim</a></li>
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
						<a href="../" title="gumush.az">
							<img src="../img/silverstore.jpg" alt="gumush.az">
						</a>
					</div>
					<div class="searchBox col-md-4 col-xs-12">
						<div class="input-group">
					  		<input type="text" class="form-control axtar_input" placeholder="Axtar">
					      	<span class="input-group-btn">
							    <button class="btn btn-default header_search_btn" onclick="axtar()">
							    	<img src="../img/axtar.png" alt="axtar">
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
						      			window.location.href="../axtaris.php?txt="+axtar_input;
					      			}
					      		}
					      	</script>
					    </div>
					</div>
				</header>
			</div>
		<!-- HEADER FINISH -->
		
		<!-- NAVBAR START -->
			<div class="row main_divs_space">
				<div class="mynav_div col-xs-12">
					<nav class="navbar col-xs-12">
						<p class="closed_menu"></p>
						<ul> 
							<li>
								<a class="menu_before" href="../uzuk" title="Üzüklər">Üzüklər</a>
							</li>
							<li>
								<a class="menu_before" href="../sirga" title="Sırğalar">Sırğalar</a>
							</li>
							<li>
								<a class="menu_before" href="../qolbaq" title="Qolbaqlar">Qolbaqlar</a>
							</li>
							<li>
								<a class="menu_before" href="../boyunbagi" title="Boyunbağılar">Boyunbağılar</a>
							</li>	
							<li>
								<a class="menu_before" href="../komplekt" title="Komplektlər">Komplektlər</a>
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
