<?php
	if(isset($_POST["submit"])){
		$total = count($_FILES['image']['name']);
		$basliq = $_POST["basliq"];
		$basliq = trim($basliq);

		$qiymet = $_POST["qiymet"];
		$qiymet = trim($qiymet);

		if(isset($_POST["olcu"])){
			$olcu = $_POST["olcu"];
			$olcu = trim($olcu);
		}else{
			$olcu = "";
			$olcu = trim($olcu);
		}
		$ceki = $_POST["ceki"];
		$ceki = trim($ceki);

		if(isset($_POST["qas"]) && $_POST["qas"] == "var"){
			$qas = "Var";
			$qas = trim($qas);
		}else{
			$qas = "Yoxdur";
			$qas = trim($qas);
		}

		$kateqoriya = $_POST["kateqoriya"];
		$kateqoriya = trim($kateqoriya);

		$cins = $_POST["cins"];
		$cins = trim($cins);

		$yas_grupu = $_POST["yas_grupu"];
		$yas_grupu = trim($yas_grupu);

		$img_alt = $_POST["img_alt"];
		$img_alt = trim($img_alt);

		$a_title = $_POST["a_title"];
		$a_title = trim($a_title);
		
		$mehsulun_sahibi = $_POST['mehsulun_sahibi'];
		$mehsulun_sahibi = trim($mehsulun_sahibi);


		//azerbaycan srifti ile dropdownlar ve uzukden basqa olcunun index.php de gorunmemesi ucun start
			$kateqoriya_template = "";
			$k_href = "";
			$k_title = "";
			if($kateqoriya=="uzuk"){
				$kateqoriya_template = "Üzüklər";
				$k_href = "../../uzuk";
				$k_title = "gumus uzukler";
			}else if($kateqoriya=="sirga"){
				$kateqoriya_template = "Sırğalar";
				$k_href = "../../sirga";
				$k_title = "gumus sirgalar";
			}else if($kateqoriya=="qolbaq"){
				$kateqoriya_template = "Qolbaqlar";
				$k_href = "../../qolbaq";
				$k_title = "gumus qolbaqlar";
			}else if($kateqoriya=="boyunbagi"){
				$kateqoriya_template = "Boyunbağılar";
				$k_href = "../../boyunbagi";
				$k_title = "gumus boyunbagilar";
			}else if($kateqoriya=="komplekt"){
				$kateqoriya_template = "Komplektlər";
				$k_href = "../../komplekt";
				$k_title = "gumus komplektler";
			}
		//azerbaycan srifti ile dropdownlar ve uzukden basqa olcunun index.php de gorunmemesi ucun finish




		//item papkasinda yeni mehsul ucun papka yaradilir start
			function create_item_folder_by_basliq($text){
				$text = trim($text);
				$axtar = array('Ç','ç','Ğ','ğ','ı','İ','Ö','ö','Ş','ş','Ü','ü','Ə','ə',' ');
				$evez_et = array('c','c','g','g','i','i','o','o','s','s','u','u','E','e','-');
				$yeni_yol = str_replace($axtar, $evez_et, $text);
				return $yeni_yol;
			}
			$random_number_item_folder = rand(111111,999999);
			$item_folder = create_item_folder_by_basliq($basliq)."-".$random_number_item_folder;
			mkdir("../../../item/".$item_folder);
		//item papkasinda yeni mehsul ucun papka yaradilir finish




		//papkada index.php fayli yaradilir start
			//en axirinci mehsulun id alir (+1 edib item papkasinda yaradilan index.php icindeki buttonlarin mehsul id lerde sebete elave etde istifade olunur)
			include '../../../db-bakuweb/db.php';
			if($conn){
				$select_last_id = "SELECT id FROM mehsullar ORDER BY id DESC LIMIT 1";
				$netice_select_last_id = mysqli_query($conn,$select_last_id);
				while($row = mysqli_fetch_assoc($netice_select_last_id)){
					$last_id_of_mehsullar = $row['id']+1;
				}
			}

			$b='$b'; //fwrite'de problem cixdi deye index faylini yaradanda php deyiskenleri yaranmirdi ona gore bunu yaratdim.
			$scope='$scope'; //fwrite'de problem cixdi deye index faylini yaradanda php deyiskenleri yaranmirdi ona gore bunu yaratdim.
			$session_user_id = "$"."_SESSION"."["."'user_id'"."]";

			//Eyni kateqoriyadakı digər mallar bolmesini yaradiriq ve asagida sadece deyiseni cagiracayiq
			$conn = '$conn';
			$sec = '$sec';
			$netice = '$netice';
			$row = '$row';
			$eyni_kateqoriyadaki_diger_mallar = "include '../../db-bakuweb/db.php';
											if($conn){
												$sec = ".'"'."SELECT basliq,qiymet,tmp,img_alt,a_title FROM mehsullar WHERE kateqoriya = '".$kateqoriya."' ORDER BY RAND() LIMIT 15".'"'.";
												$netice = mysqli_query($conn,$sec);
												while($row = mysqli_fetch_assoc($netice)){
													echo ".'"'."<a href='../".'"'.".$row"."["."'tmp'].".'"'."' title='".'"'.".$row"."["."'a_title'].".'"'."'>
																<div class='benzer_mallar'>
																	<img src='../".'"'.".$row"."["."'tmp'].".'"'."/image0.jpg' alt='".'"'.".$row"."["."'img_alt'].".'"'."' width='170'>
																	<h3>".'"'.".$row"."["."'basliq'].".'"'."</h3>
																	<p>".'"'.".$row"."["."'qiymet'].".'"'." AZN</p>
																</div>
															</a>".'"'.";
												}
												mysqli_close($conn);
											}";
			
			if($olcu != ""){//eger olcu deyiskeninin deyeri bos deyilse, yeni ki uzukdurse


//burda en dibden baslamalidir yazmaga cunku eks halda session start error verir
				$content = "<?php session_start(); ?>
				<!DOCTYPE html>
				<html>
				<head>
					<style type='text/css'>
						body{
							overflow: hidden;
						}
						.container{
							display: none;
						}
					</style>
					<link rel='alternate' hreflang='az' href='http://gumush.az/item/".$item_folder."/index.php' />
					<link rel='stylesheet' type='text/css' href='../../css/item.css'>
					<meta charset='utf-8'/>
					<meta http-equiv='X-UA-Compatible' content='IE=edge'>
					<link rel='author' href='https://plus.google.com/108728687434805525511/posts'/>
				   	<meta name='viewport' content='width=device-width, initial-scale=1'>
				   	<meta property='og:url' content='http://gumush.az/item/".$item_folder."/' />
					<meta property='og:type' content='website' />
					<meta property='og:title' content='".$basliq."' />
					<meta property='og:description' content='".$ceki." Qram - ".$qiymet." AZN' />
					<meta property='og:image' content='http://gumush.az/item/".$item_folder."/image0.jpg' />
					<meta property='og:image:type' content='image/jpeg' />
					<meta property='og:image:width' content='400' />
					<meta property='og:image:height' content='300' />
					<meta property='fb:app_id' content='268883703487579' />
					<meta property='fb:admins' content='ideal.nasirzade' />
					<meta property='fb:admins' content='OrxanDWK' />
					<meta property='og:site_name' content='Gumush' />
   					<link rel='icon' href='../../img/favicon.png' type='image/png' sizes='16x16' />
					<link rel='stylesheet' type='text/css' href='../../bootstrap/css/bootstrap.min.css'>
					<link rel='stylesheet' type='text/css' href='../../bootstrap/css/font-awesome.css'>
					<link rel='stylesheet' type='text/css' href='../../css/normalize.css' />
					<link rel='stylesheet' type='text/css' href='../../css/style.css'>
					<link rel='stylesheet' type='text/css' href='../../css/ideal.css'>
					<script type='text/javascript' src='../../js/jquery.min.js'></script>
					<script type='text/javascript' src='../../bootstrap/js/bootstrap.min.js'></script>
					<script type='text/javascript' src='../../js/angular.min.js'></script>
				</head>
				<body>
					<div id='fb-root'></div>
					<script>
						(function(d, s, id) {
						  var js, fjs = d.getElementsByTagName(s)[0];
						  if (d.getElementById(id)) return;
						  js = d.createElement(s); js.id = id;
						  js.src = '//connect.facebook.net/az_AZ/sdk.js#xfbml=1&version=v2.6&appId=268883703487579';
						  fjs.parentNode.insertBefore(js, fjs);
						}(document, 'script', 'facebook-jssdk'));
					</script>
					<!-- SEHIFELER YUKLENMEDEN ONCE CIXAN LOADING START -->
						<div class='circle'></div>
						<div class='circle1'></div>
					<!-- SEHIFELER YUKLENMEDEN ONCE CIXAN LOADING FINISH -->
					<script type='text/javascript'>
						$(document).ready(function(){
						    document.title = '".$basliq."';
						    setTimeout(function(){
						    	$('.circle').hide();
						    	$('.circle1').hide();
						    	$('body').css('overflow','visible');
						    },450);
						    setTimeout(function(){
								$('.container').fadeIn('slow');
						    },455);
						});
					</script>
					<div class='container'>
						<?php
							function signed_in(){
								echo '<style>.header_top_right li:nth-child(3),.header_top_right li:nth-child(4){display:none !important;}</style>';
							}
							function signed_fail(){
								echo '<style>.header_top_right li:nth-child(2){display:none !important;}</style>';
							}
							if(isset($session_user_id)){
								signed_in();
							}else{
								signed_fail();
							}
						?>
						<!-- REGISTER AND SIGN UP START -->
							<div class='alert alert-success qeydiyyat_tamamlandi'>
								<a onclick='qeydiyyat_tamamlandi_alert_bagla()' class='close'>&times;</a>
								<strong>Qeydiyyat Tamamlandı!</strong>
								<p>Xahiş edirik e-mail adresinizə göndərilən linkə daxil olaraq hesabınızı aktivləşdirin, daha sonra hesabınıza daxil olun.</p>
							</div>
							<div class='alert alert-success sifre_berpa_tamamlandi'>
								<a onclick='sifre_berpa_tamamlandi_alert_bagla()' class='close'>&times;</a>
								<strong>Əməliyyat tamamlandı!</strong>
								<p>Xahiş edirik e-mail adresinizə göndərilən linkə daxil olaraq yeni şifrənizi daxil edin.</p>
							</div>

							<div class='regBackground'></div>
							<div class='regForm' ng-app='silverstore' ng-controller='qeydiyyat'>
								<form class='form-horizontal' novalidate='novalidate'>
									<p>Qeydiyyat</p>
									<div class='form-group'>
										<label class='col-md-4 control-label' for='signup_ad'>Ad</label>  
										<div class='col-md-5'>
											<input ng-focus='hide_validate_spans()' id='signup_ad' name='signup_ad' type='text' placeholder='adınız' class='form-control' required=''>
											<div class='alert alert-danger validate_spans ad_span'>
												<span></span>
											</div>
									    </div>
									</div>
									<div class='form-group'>
										<label class='col-md-4 control-label' for='signup_soyad'>Soyad</label>  
										<div class='col-md-5'>
											<input ng-focus='hide_validate_spans()' id='signup_soyad' name='signup_soyad' type='text' placeholder='soyadınız' class='form-control' required=''>
									    	<div class='alert alert-danger validate_spans soyad_span'>
												<span></span>
											</div>
									    </div>
									</div>
									<div class='form-group'>
										<label class='col-md-4 control-label' for='signup_email'>E-mail</label>  
										<div class='col-md-5'>
											<input ng-focus='hide_validate_spans()' id='signup_email' name='signup_email' type='email' placeholder='e-mail adresiniz' class='form-control' required=''>  
											<div class='alert alert-danger validate_spans email_span'>
												<span></span>
											</div>
										</div>
									</div>
									<div class='form-group'>
										<label class='col-md-4 control-label' for='sifre'>Şifrə</label>
										<div class='col-md-5'>
											<input ng-focus='hide_validate_spans()' id='sifre' name='sifre' type='password' placeholder='şifrəniz' class='form-control' required=''>  
											<div class='alert alert-danger validate_spans sifre_span'>
												<span></span>
											</div>
										</div>
									</div>
									<div class='form-group'>
										<label class='col-md-4 control-label' for='signup_sifre_tekrar'>Şifrə təsdiq</label>
										<div class='col-md-5'>
											<input ng-focus='hide_validate_spans()' id='signup_sifre_tekrar' name='signup_sifre_tekrar' type='password' placeholder='şifrənizi təsdiqləyin' class='form-control' required=''>  
											<div class='alert alert-danger validate_spans sifre_tekrar_span'>
												<span></span>
											</div>
										</div>
									</div>
									<div class='form-group'>
										<label class='col-md-4 control-label' for='signup_telefon'>Telefon</label>  
										<div class='col-md-5'>
											<input ng-focus='hide_validate_spans()' id='signup_telefon' name='signup_telefon' type='number' placeholder='nömrəniz' class='form-control' required=''>  
											<div class='alert alert-danger validate_spans telefon_span'>
												<span></span>
											</div>
										</div>
									</div>
									<div class='form-group'>
										<label class='col-md-4 control-label' for='signup'></label>
										<div class='col-md-5'>
											<button ng-click='qeydiyyat_submit()' id='signup' type='submit' class='btn btn-success'>Tamamla</button>
											<button id='cancel_reg' type='reset' onclick='none_register()' class='btn btn-success'>Ləğv et</button>
										</div>
									</div>
									<script type='text/javascript'>
										function registration_validation(){
											hide_validate_spans();
											var ad = $('#signup_ad').val();
											var soyad = $('#signup_soyad').val();
											var email = $('#signup_email').val();
											var parol = $('#sifre').val();
											var parol_tekrar = $('#signup_sifre_tekrar').val();
											var tel = $('#signup_telefon').val();
											if(ad == ''){
												$('.ad_span').fadeIn(200);
												$('.ad_span span').text('Adınızı daxil edin!');
											}else if(ad.length < 2){
												$('.ad_span').fadeIn(200);
												$('.ad_span span').text('Ad çox qısadır (min. 2)!');
											}else if(ad.length > 12){
												$('.ad_span').fadeIn(200);
												$('.ad_span span').text('Ad çox uzundur (max. 12)!');
											}else if(NameIsLetter(ad) == false){
												$('.ad_span').fadeIn(200);
												$('.ad_span span').text('Ad yalnız hərflərdən ibarət olmalıdır!');
											}else if(soyad == ''){
												$('.soyad_span').fadeIn(200);
												$('.soyad_span span').text('Soyadınızı daxil edin!');
											}else if(soyad.length < 3){
												$('.soyad_span').fadeIn(200);
												$('.soyad_span span').text('Soyad çox qısadır (min. 3)!');
											}else if(soyad.length > 15){
												$('.soyad_span').fadeIn(200);
												$('.soyad_span span').text('Soyad çox uzundur (max. 15)!');
											}else if(SurNameIsLetter(soyad) == false){
												$('.soyad_span').fadeIn(200);
												$('.soyad_span span').text('Soyad yalnız hərflərdən ibarət olmalıdır!');
											}else if(email == ''){
												$('.email_span').fadeIn(200);
												$('.email_span span').text('E-mail adresinizi daxil edin!');
											}else if(IsEmail(email) == false){
												$('.email_span').fadeIn(200);
												$('.email_span span').text('E-mail adresinizi düzgün yazın!');
											}else if(email.length < 8){
												$('.email_span').fadeIn(200);
												$('.email_span span').text('E-mail adresi çox qısadır (min. 8)!');
											}else if(email.length > 30){
												$('.email_span').fadeIn(200);
												$('.email_span span').text('E-mail adresi çox uzundur (max. 30)!');
											}else if(parol == ''){
												$('.sifre_span').fadeIn(200);
												$('.sifre_span span').text('Şifrənizi daxil edin!');
											}else if(IsParol(parol) == false || parol.match(/_/)){
												$('.sifre_span').fadeIn(200);
												$('.sifre_span span').text('Şifrə rəqəm və hərflərdən ibarət olmalıdır!');
											}else if(parol.length < 6){
												$('.sifre_span').fadeIn(200);
												$('.sifre_span span').text('Şifrə çox qısadır (min. 6)!');
											}else if(parol.length > 20){
												$('.sifre_span').fadeIn(200);
												$('.sifre_span span').text('Şifrə çox uzundur (max. 20)!');
											}else if(parol_tekrar == ''){
												$('.sifre_tekrar_span').fadeIn(200);
												$('.sifre_tekrar_span span').text('Şifrənizi təsdiq edin!');
											}else if(parol_tekrar != parol){
												$('.sifre_tekrar_span').fadeIn(200);
												$('.sifre_tekrar_span span').text('Şifrə eyni deyil!');
											}else if(tel == ''){
												$('.telefon_span').fadeIn(200);
												$('.telefon_span span').text('Telefon nömrənizi daxil edin!')
											}else if(tel.length < 10){
												$('.telefon_span').fadeIn(200);
												$('.telefon_span span').text('Nömrə çox qısadır (min. 10)!');
											}else if(tel.length > 10){
												$('.telefon_span').fadeIn(200);
												$('.telefon_span span').text('Nömrə çox uzundur (max. 10)!');
											}else{
												$.ajax({
													url:'../../register_bw/index.php',
													type:'POST',
													data:{
														a:ad,b:soyad,c:email,d:parol,e:tel
													},
													success:function(gelen){
														if(gelen == 'ok'){
															$('.regForm').find('input').val('');
															$('.regBackground').fadeOut('slow');
															$('.regForm').fadeOut('slow');
															setTimeout(function(){
																$('.qeydiyyat_tamamlandi').fadeIn(600);
															},1000)
														}else if(gelen == 'email_is_registered'){
															$('.email_span').fadeIn(200);
															$('.email_span span').text('Bu e-mail adresi artıq sistemimizdə mövcuddur!');
														}else{
															alert('Xəta baş verdi!Xahiş edirik bunu bizə bildirin!');
														}
													},
													error:function(){
														alert('Xəta baş verdi!Xahiş edirik bunu bizə bildirin!');
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
										angular.module('silverstore', [])
										.controller('qeydiyyat', function($scope){
											$scope.qeydiyyat_submit = function(){
												return registration_validation();
											}
											$scope.hide_validate_spans = function(){
												$('.validate_spans').fadeOut(400);
											}
										});
									</script>
								</form>
							</div>

							<div class='sign_in'>
								<p>Daxil Ol</p>
								<form class='form-horizontal' novalidate='novalidate'>
									<div class='form-group'>
										<label class='col-md-4 control-label' for='signin_email'>E-mail</label>  
										<div class='col-md-5'>
											<input onfocus='hide_validate_spans()' id='signin_email' name='signin_email' type='email' placeholder='e-mail adresiniz' class='form-control' required=''>
											<div class='alert alert-danger validate_spans sign_email_span'>
												<span></span>
											</div>
										</div>
									</div>
									<div class='form-group'>
										<label class='col-md-4 control-label' for='signin_password'>Şifrə</label>  
										<div class='col-md-5'>
											<input onfocus='hide_validate_spans()' id='signin_password' name='signin_password' type='password' placeholder='şifrəniz' class='form-control input-md' required=''>
											<div class='alert alert-danger validate_spans sign_sifre_span'>
												<span></span>
											</div>
									    </div>
									</div>
									<div class='form-group'>
										<label class='col-md-4 control-label'></label>
										<div class='col-md-5'>
											<button id='sifremi_unuttum_btn' type='reset' onclick='rec_pass_block()' class='btn btn-success'>Şifrəmi unuttum</button>
										</div>
									</div>
									<div class='form-group'>
										<label class='col-md-4 control-label' for='signin'></label>
										<div class='col-md-5'>
											<span id='signin' class='btn btn-success sign_in_submit_span' onclick='sign_in_validation_and_ajax()'>Daxil ol</span>
											<button id='cancel' type='reset' onclick='none_enter()' class='btn btn-success'>Geri</button>
										</div>
									</div>
								</form>
							</div>
							<script type='text/javascript'>
								$('.sign_in form').keyup(function(event){
								    if(event.keyCode == 13){
								        $('.sign_in_submit_span').click();
								    }
								});
								function sign_in_validation_and_ajax(){
									hide_validate_spans();
									var sign_email = $('#signin_email').val();
									var sign_password = $('#signin_password').val();

									if(sign_email == ''){
										$('.sign_email_span').fadeIn(200);
										$('.sign_email_span span').text('E-mail adresinizi daxil edin!');
									}else if(IsEmail(sign_email) == false){
										$('.sign_email_span').fadeIn(200);
										$('.sign_email_span span').text('E-mail adresinizi düzgün yazın!');
									}else if(sign_email.length < 8){
										$('.sign_email_span').fadeIn(200);
										$('.sign_email_span span').text('E-mail adresi çox qısadır (min. 8)!');
									}else if(sign_email.length > 30){
										$('.sign_email_span').fadeIn(200);
										$('.sign_email_span span').text('E-mail adresi çox uzundur (max. 30)!');
									}else if(sign_password == ''){
										$('.sign_sifre_span').fadeIn(200);
										$('.sign_sifre_span span').text('Şifrənizi daxil edin!');
									}else if(IsParol(sign_password) == false || sign_password.match(/_/)){
										$('.sign_sifre_span').fadeIn(200);
										$('.sign_sifre_span span').text('Şifrə rəqəm və hərflərdən ibarət olmalıdır!');
									}else if(sign_password.length < 6){
										$('.sign_sifre_span').fadeIn(200);
										$('.sign_sifre_span span').text('Şifrə çox qısadır (min. 6)!');
									}else if(sign_password.length > 20){
										$('.sign_sifre_span').fadeIn(200);
										$('.sign_sifre_span span').text('Şifrə çox uzundur (max. 20)!');
									}else{
												$.ajax({
													url:'../../sign_in_bw/index.php',
													type:'POST',
													data:{
														a:sign_email,b:sign_password
													},
													success:function(gelen){
														if(gelen == ''){
															$('.sign_email_span').fadeIn(200);
															$('.sign_email_span span').text('Bu e-mail adresi sistemimizdə mövcud deyil!');
														}else if(gelen == 'sifre_sehvdir'){
															$('.sign_sifre_span').fadeIn(200);
															$('.sign_sifre_span span').text('Şifrə yalnışdır!');
														}else if(gelen == 'hesab_aktiv_deyil'){
															$('.sign_email_span').fadeIn(200);
															$('.sign_email_span span').text('Hesabınız aktiv deyil ! E-mail adresinizə göndərilən linkə daxil olaraq hesabınızı aktivləşdirin.');
														}else if(gelen == 'signed_in'){
															$('.sign_in').find('input').val('');
															$('.regBackground').fadeOut('slow');
															$('.sign_in').fadeOut('slow');
															location.reload();
														}else{
															alert('Xəta baş verdi!Xahiş edirik bunu bizə bildirin!');
														}
													},
													error:function(){
														alert('Xəta baş verdi!Xahiş edirik bunu bizə bildirin!');
													}

												})
											}
								}
								function hide_validate_spans(){
									$('.validate_spans').fadeOut(400);
								}
							</script>


							<div class='recovery_password'>
								<p>Şifrə bərpa</p>
								<div class='form-horizontal'>
									<div class='form-group'>
										<label class='col-md-4 control-label' for='rec_pass'>E-mail</label>  
										<div class='col-md-5'>
											<input id='rec_pass' onclick='hide_validate_spans()' onkeydown='hide_validate_spans()' type='email' placeholder='e-mail adresiniz' class='form-control'>
											<div class='alert alert-danger validate_spans rec_pas_span'>
												<span></span>
											</div>
										</div>
									</div>
									<div class='form-group'>
										<label class='col-md-4 control-label' for='signin'></label>
										<div class='col-md-5'>
											<button id='signin' class='btn btn-success' onclick='my_recovery_password()'>Göndər</button>
											<button id='cancel' onclick='recovery_password_none()' class='btn btn-success'>Geri</button>
										</div>
									</div>
								</div>
							</div>
							<script type='text/javascript'>
								$('.recovery_password').keydown(function(knopka){
									if(knopka.keyCode == 13){
										my_recovery_password();
									}
								});
								function my_recovery_password(){
									var recovery_email = $('#rec_pass').val();
									if(recovery_email == ''){
										$('.rec_pas_span').fadeIn(200);
										$('.rec_pas_span span').text('E-mail adresinizi daxil edin!');
									}else if(IsEmail(recovery_email) == false){
										$('.rec_pas_span').fadeIn(200);
										$('.rec_pas_span span').text('E-mail adresinizi düzgün yazın!');
									}else if(recovery_email.length < 8){
										$('.rec_pas_span').fadeIn(200);
										$('.rec_pas_span span').text('E-mail adresi çox qısadır (min. 8)!');
									}else if(recovery_email.length > 30){
										$('.rec_pas_span').fadeIn(200);
										$('.rec_pas_span span').text('E-mail adresi çox uzundur (max. 30)!');
									}else{
										$.ajax({
											url:'../../password_recovery/index.php',
											type:'POST',
											data:{
												a:recovery_email
											},
											success:function(gelen){
												if(gelen == 'email_gonderildi'){
													$('.regBackground').fadeOut('fast');
													$('.recovery_password').fadeOut('fast');
													$('.sifre_berpa_tamamlandi').fadeIn(600);
													$('#rec_pass').val('');
												}else if(gelen == 'email_duzgun_daxil_edilmeyib'){
													$('.rec_pas_span').fadeIn(200);
													$('.rec_pas_span span').text('E-mail adresinizi düzgün yazın!');
												}else if(gelen == 'email_movcud_deyil'){
													$('.rec_pas_span').fadeIn(200);
													$('.rec_pas_span span').text('Bu e-mail adresi sistemimizdə mövcud deyil!');
												}
											},
											error:function(){
												alert('Xəta baş verdi!Xahiş edirik bunu bizə bildirin!');
											}
										});
									}
								}
								
								function qeydiyyat_tamamlandi_alert_bagla(){
									$('.qeydiyyat_tamamlandi').fadeOut(400);
								}
								function sifre_berpa_tamamlandi_alert_bagla(){
									$('.sifre_berpa_tamamlandi').fadeOut(400);
								}
								function block_register(){
									$('.regBackground').fadeIn('slow');
									$('.regForm').fadeIn('slow');
								}
								function none_register(){
									$('.regBackground').fadeOut('fast');
									$('.regForm').fadeOut('fast');
									$('.validate_spans').fadeOut(10);
								}
								function block_sign_in(){
									$('.regBackground').fadeIn('slow');
									$('.sign_in').fadeIn('slow');
								}
								function none_enter(){
									$('.regBackground').fadeOut('fast');
									$('.sign_in').fadeOut('fast');
									$('.validate_spans').fadeOut(10);
								}
								function rec_pass_block(){
									$('.sign_in').fadeOut('fast');
									$('.regBackground').fadeIn('slow');
									$('.recovery_password').fadeIn('slow');
								}
								function recovery_password_none(){
									$('.recovery_password').fadeOut('fast');
									$('.sign_in').fadeIn('slow');
									$('#rec_pass').val('');
									$('.validate_spans').fadeOut(10);
								}
								$('.regBackground').click(function(){
									$('.regBackground').fadeOut('fast');
									$('.regForm').fadeOut('fast');
									$('.sign_in').fadeOut('fast');
									$('.recovery_password').fadeOut('fast');
									$('.validate_spans').fadeOut(10);

									$('.regForm').find('input').val('');
									$('.sign_in').find('input').val('');
									$('.recovery_password').find('input').val('');
								});
							</script>
						<!-- REGISTER AND SIGN UP FINISH -->

						<!-- SIFARISH POP-UP'S START -->
							<div class='sifarish_oldu_bg'></div>
							<div class='sifarish_oldu'>
								<p>Məhsul səbətə əlavə olundu.</p>
								<button onclick='alish_verise_davam_et()'>Alış-verİşə davam et</button>
								<button onclick='alish_verisi_bitir()'>Alış-verİşİ bİtİr</button>
							</div>
							<div class='sifarish_limiti_dolub'>
								<p>Sifariş limitiniz dolub!</p>
								<p>Xahiş edirik, öncəki sifarişlərinizi tamamlayın!</p>
								<button onclick='alis_verisi_bitir_limit_dolub()'>Alış-verİşİ bİtİr</button>
							</div>
							<div class='sifarish_xeta'>
								<p>Xəta baş verdi! Xahiş edirik bunu bizə bildirin.</p>
								<button onclick='xetani_bildirin()'>Bİldİr</button>
								<button onclick='xeta_bagla()'>Bağla</button>
							</div>
							<div class='sifarish_ucun_daxil_olun'>
								<p>Sifariş vermək üçün hesabınıza daxil olun!</p>
								<button onclick='sifarish_daxil_ol()'>Daxİl ol</button>
								<button onclick='sifarish_qeydiyyatdan_kec()'>Qeydİyyatdan keç</button>
							</div>
							<div class='min_max_mehsul_sifaris'>
								<p>Ən az 1, ən çox 5 məhsul sifariş verə bilərsiniz.</p>
								<button onclick='alish_verise_davam_et()'>Alış-verİşə davam et</button>
								<button onclick='alish_verisi_bitir()'>Alış-verİşİ bİtİr</button>
							</div>
							<script type='text/javascript'>
								//alis verise davam edir
								function alish_verise_davam_et(){
									$('.sifarish_oldu_bg,.sifarish_oldu').hide(600);
									$('.sifarish_oldu_bg,.min_max_mehsul_sifaris').hide(600);
								}
								//alis verisi bitirmek ucun sebete gedir
								function alish_verisi_bitir(){
									$('.sifarish_oldu_bg,.sifarish_oldu').hide(600);
									$('.sifarish_oldu_bg,.min_max_mehsul_sifaris').hide(600);
									setTimeout(function(){
										//basqa sehifelerde istifade edende adresi uygun olaraq deyis
										window.location.href='../../sebetim';
									},600);
								}
								//alis verisi bitirmek ucun sebete gedir
								function alis_verisi_bitir_limit_dolub(){
									$('.sifarish_oldu_bg,.sifarish_limiti_dolub').hide(600);
									setTimeout(function(){
										//basqa sehifelerde istifade edende adresi uygun olaraq deyis
										window.location.href='../../sebetim';
									},600);
								}
								//xeta bas vererse bunu contact sehifesi vasitesile bildirir
								function xetani_bildirin(){
									$('.sifarish_oldu_bg,.sifarish_xeta').hide(600);
									setTimeout(function(){
										//basqa sehifelerde istifade edende adresi uygun olaraq deyis
										window.location.href='../../contact';
									},600);
								}
								//bildirmek istemese xeta bildiris penceresini baglayir
								function xeta_bagla(){
									$('.sifarish_oldu_bg,.sifarish_xeta').hide(600);
								}
								//daxil ol pop up display block olur ve sifaris ucun daxil ol pop up display none olur
								function sifarish_daxil_ol(){
									$('.sifarish_oldu_bg,.sifarish_ucun_daxil_olun').hide(600);
									setTimeout(function(){
										block_sign_in();
										$('html, body').animate({ scrollTop: 0 }, 'slow');
									},600);
								}
								//qeydiyyatdan kec pop up display block olur ve sifaris ucun daxil ol pop up display none olur
								function sifarish_qeydiyyatdan_kec(){
									$('.sifarish_oldu_bg,.sifarish_ucun_daxil_olun').hide(600);
									setTimeout(function(){
										block_register();
										$('html, body').animate({ scrollTop: 0 }, 'slow');
									},600);
								}
							</script>
						<!-- SIFARISH POP-UP'S FINISH -->

						<!-- SIFARISH START -->
							<script type='text/javascript'>
								function sifarish(this_id,item_eded){
									//gelen deyer mehsul9050 olarsa mehsul sozunu silib 9050 cixart ve sadece mehsulun id adresini al
									var mehsul_id = this_id.slice(6);
									$.ajax({
										type:'POST',
										url:'../../sebetim/elave_et.php',
										data: {mehsul:mehsul_id,eded:item_eded},
										success:function(gelen){
											if(gelen == 'limit_dolub'){
												$('.sifarish_oldu_bg,.sifarish_limiti_dolub').show(600)
											}else if(gelen == 'sifarish_oldu'){
												$('.sifarish_oldu_bg,.sifarish_oldu').show(600);
											}else if(gelen == 'xeta'){
												$('.sifarish_oldu_bg,.sifarish_xeta').show(600);
											}else if(gelen == 'daxil_olun'){
												$('.sifarish_oldu_bg,.sifarish_ucun_daxil_olun').show(600);
											}
										},
										error:function(err){
											$('.sifarish_oldu_bg,.sifarish_xeta').show(600);
										}
									});
								}
							</script>
						<!-- SIFARISH FINISH -->

						<!-- TOP HEADER START -->
								<div class='my_top_header'>
									<ul class='header_top_left'>
										<li><a href='../../' title='gumush.az'>Ana Səhifə</a></li>
										<li><a href='../../contact' title='bizimle elaqe'>Bizimlə Əlaqə</a></li>
									</ul>
									<script type='text/javascript'>
										function exit(){
											$.ajax({
												url:'../../exit.php',
												type:'POST',
												data:{
													exit:'exit'
												},
												success:function(gelen){
													location.reload();
												},
												error:function(){
													alert('Xəta baş verdi!Xahiş edirik bunu bizə bildirin!');
												}
											});
										}
									</script>
									<ul class='header_top_right'>
										<li><a href='../../sebetim' title='sebetim'>Səbətim</a></li>
										<li><button onclick='exit()'>Çıxış</button></li>
										<li><button onclick='block_sign_in()'>Daxil Ol</button></li>
										<li><button onclick='block_register()'>Qeydiyyat</button></li>
									</ul>
								</div>
						<!-- TOP HEADER FINISH -->

						<!-- HEADER START -->
							<div class='row'>
								<header class='col-xs-12 col-md-12'>
									<div class='logo col-md-8 col-xs-12'>
										<a href='../../' title='gumush.az'>
											<img src='../../img/silverstore.jpg' alt='gumush.az'>
										</a>
									</div>
									<div class='searchBox col-md-4 col-xs-12'>
										<div class='input-group'>
									  		<input type='text' class='form-control axtar_input' placeholder='Axtar'>
									      	<span class='input-group-btn'>
											    <button class='btn btn-default header_search_btn' onclick='axtar()'>
											    	<img src='../../img/axtar.png' alt='axtar'>
											    </button>
									      	</span>
									      	<script type='text/javascript'>
									      		$('.axtar_input').keydown(function(knopka){
													if(knopka.keyCode == 13){
														axtar();
													}
												});
									      		function axtar(){
									      			var axtar_input = $('.axtar_input').val();
									      			if(axtar_input != ''){
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
														                .replace(/\s/gi, '-') // bosluqlari- ile evezle
														                .replace(/[-]+/gi, '-') // tekrarlanan -- lari - ile evezle
														                .toLowerCase();
														}
														axtar_input = herfleri_deyis(axtar_input);
										      			window.location.href='../../axtaris.php?txt='+axtar_input;
									      			}
									      		}
									      	</script>
									    </div>
									</div>
								</header>
							</div>
						<!-- HEADER FINISH -->

						<!-- NAVBAR START -->
							<div class='row main_divs_space'>
								<div class='mynav_div col-xs-12'>
									<nav class='navbar col-xs-12'>
										<p class='closed_menu'></p>
										<ul> 
											<li>
												<a class='menu_before' href='../../uzuk' title='Üzüklər'>Üzüklər</a>
											</li>
											<li>
												<a class='menu_before' href='../../sirga' title='Sırqalar'>Sırğalar</a>
											</li>
											<li>
												<a class='menu_before' href='../../qolbaq' title='Qolbaqlar'>Qolbaqlar</a>
											</li>
											<li>
												<a class='menu_before' href='../../boyunbagi' title='Boyunbağılar'>Boyunbağılar</a>
											</li>	
											<li>
												<a class='menu_before' href='../../komplekt' title='Komplektlər'>Komplektlər</a>
											</li>
										</ul>
									</nav>
								</div>
							</div>
							<script type='text/javascript'>
								$('.closed_menu').after().click(function(){
									$('.navbar').find('ul').slideToggle(700);
								})
							</script>
						<!-- NAVBAR FINISH -->

						<!-- ITEM START -->
							<div class='row main_divs_space item_main'>
								<div class='col-xs-12 item-top-nav main_divs_space'>
									<a href='../../'><i class='fa fa-home' aria-hidden='true' title='ana sehife'></i></a>
									<a href='".$k_href."' title='".$k_title."'>".$kateqoriya_template."</a>
									<p>".$basliq."</p>
								</div>
								<div>
									<div class='item_img col-md-6 col-sm-5'>
										<img class='slider_img' src='image0.jpg' alt='".$img_alt."'>
										<div class='col-xs-12 tumb_main'>
											<?php
											for($b=0;$b<".$total.";$b++){
												echo ".'"'."
														<div class='col-xs-3 item_img_tumb'>
															<img onclick='change_img(this.src)' src='image".'"'.".$b.".'"'.".jpg' height='110' alt='".$img_alt."' />
														</div>
												".'"'.";
											}
											?>
										</div>
										<script type='text/javascript'>
											function change_img(src){
												$('.slider_img').css('opacity','0');
												setTimeout(function(){
													$('.slider_img').attr('src', src);
													$('.slider_img').css('opacity','1');
												},400)

											}
										</script>
									</div>
									<div class='item_info col-md-3 col-sm-4'>
										<h1>".$basliq."</h1>
										<p class='item_weight'>Çəki: <span>".$ceki."</span></p>
										<p class='item_olcu'>Ölçü: <span>".$olcu."</span></p>
										<p class='item_qas'>Qaş: <span>".$qas."</span></p>
										<p class='item_kateqoriya'>Kateqoriya: <span>".$kateqoriya_template."</span></p>
										<p class='item_veziyyeti'>Vəziyyəti: <span>YENİ</span></p>
										<p class='stokda_var'>Stokda var</p>
									</div>
									<div class='item_buy col-md-3 col-sm-3'>
										<p class='item_price'>".$qiymet." AZN</p>
										<div class='item_amount'>
											<p>Ədəd:</p>
											<input id='item_price_input' type='number' class='form-control item_eded' value='1'>
											<button onclick='price_minus()'><i class='fa fa-minus' aria-hidden='true'></i></button>
											<button onclick='price_plus()'><i class='fa fa-plus' aria-hidden='true'></i></button>
											<script type='text/javascript'>
												function price_minus(){
													a = $('#item_price_input').val();
													if(a > 1){
														a = a-1;
														$('#item_price_input').val(a)
													}
												}
												function price_plus(){
													b = $('#item_price_input').val();
													if(b > 0 && b < 5){
														b = parseInt(b)+1;
														$('#item_price_input').val(b);
													}
												}
												function nece_eded_sifarish(this__id){
													var item_eded = document.getElementsByClassName('item_eded')[0].value;
													if(item_eded < 1 || item_eded > 5){
														$('.sifarish_oldu_bg,.min_max_mehsul_sifaris').show(600);
													}else{
														sifarish(this__id,item_eded);
													}
												}
											</script>
										</div>
										<div class='item_btn_div'>
											<button onclick='nece_eded_sifarish(this.id)' id='mehsul".$last_id_of_mehsullar."' class='btn btn-success'>Səbətə əlavə et</button>
										</div>
									</div>
								</div>
								<div class='col-xs-12 oxsar_kat_basliq'>
									<h3>Eyni kateqoriyadakı digər mallar:</h3>
								</div>
								<div class='col-xs-12 item_oxsar_kateqoriya'>
									<button onclick='prev_items()' class='iox_btn-l'><i class='fa fa-arrow-left' aria-hidden='true'></i></button>
										<?php
											$eyni_kateqoriyadaki_diger_mallar
										?>
									<button onclick='next_items()' class='iox_btn-r'><i class='fa fa-arrow-right' aria-hidden='true'></i></button>
									<script type='text/javascript'>
										var current_place = 0;
										function prev_items(){
											if(current_place<0){
												current_place = current_place + 200;
												$('.item_oxsar_kateqoriya a').css('transform','translate('+current_place+'px,0px)');
											}							
										}
										function next_items(){
											t=-1800;
											if(window.innerWidth>992 && window.innerWidth<1200){
												t=-2000;
											}else if(window.innerWidth>768 && window.innerWidth<992){
												t=-2200;
											}else if(window.innerWidth<768){
												t=-2200;
											}
											if(current_place>t){
												current_place = current_place - 200;
												$('.item_oxsar_kateqoriya a').css('transform','translate('+current_place+'px,0px)');
											}
										}
									</script>
								</div>
							</div>
						<!-- ITEM FINISH -->

						<!-- CONTACT US START -->
							<div class='row main_divs_space'>
									<div class='contactUs col-xs-12'>
										<div class='contactFace col-md-4'>
											<h3>Bizi Facebook`da izləyin</h3>
											<div class='fb-page' data-href='https://www.facebook.com/gumush.az/' data-tabs='messages' data-width='270' data-height='350' data-small-header='false' data-adapt-container-width='false' data-hide-cover='false' data-show-facepile='true'><blockquote cite='https://www.facebook.com/gumush.az/' class='fb-xfbml-parse-ignore'><a href='https://www.facebook.com/gumush.az/'>Gumush.az</a></blockquote></div>
										</div>
										<div class='freeDelivery col-md-4'>
											<div class='my_box'>
												<div class='col-xs-2 my_truck'>
													
												</div>
												<div class='col-xs-10'>
													<h3>Pulsuz Çatdırılma</h3>
													<p>Bakı şəhəri daxilində sifariş verdiyiniz məhsulları istədiyiniz ünvana heç bir əlavə ödəniş tələb etmədən vaxtında çatdırırıq.</p>
												</div>
											</div>
											<div class='my_box'>
												<div class='col-xs-2 qapida_odeme'>
													
												</div>
												<div class='col-xs-10'>
													<h3>Qapıda Ödəmə</h3>
													<p>Ödənişi sizdən nağd və sifariş etdiyiniz məhsulları təhvil aldığınız zaman alırıq.</p>
												</div>
											</div>
											<div class='my_box'>
												<div class='col-xs-2 SSL_icon'>
													
												</div>
												<div class='col-xs-10'>
													<h3>Etibarlı Alış-Veriş</h3>
													<p>Alış-verişinizi daha etibarlı edə bilməyiniz üçün SSL təhlükəsizlik sertifikatından istifadə edirik.</p>
												</div>
											</div>
										</div>
										<div class='customBlock col-md-4'>
											<div class='my_box'>
												<div class='col-xs-2 SSL_icon'>
													
												</div>
												<div class='col-xs-10'>
													<h3>Şəxsi Məlumatlarınızın Təhlükəsizliyi</h3>
													<p>Gumush.az`a verdiyiniz bütün məlumatlar qətiliklə gizli tutulacaq. Şəxsi məlumatlarınız mövzusunda nə qədər həssas olduğunuzu bilirik. Məxfi məlumatlarınızı üçüncü şəxslər və ya firmamızın əməkdaşlarının bilməsi qeyri-mümkündür.</p>
												</div>
											</div>
										</div>
									</div>
							</div>
						<!-- CONTACT US FINISH -->

						<!-- INFORMATION START -->
							<div class='row main_divs_space'>
								<div class='allSection col-xs-12'>
									<div class='thirdSection'>
										<div class='cover_footer_top col-xs-12'> </div>
										<div class='leftSection col-md-4'>
											<h3>Əlaqə</h3>
											<ul> 
												<li><a>Mobil: <span>055 581 08 72</span></a></li>
												<li><a>E-mail: <span>support@gumush.az</span></a></li>
												<li><a href='../../contact'><strong>Əlaqə Formu</strong></a></li>
											</ul>
										</div>
										<div class='middleSection col-md-4'>
											<h3>Məhsullar</h3>
											<ul> 
												<li><a href='../../uzuk' title='gumus uzukler'>Gümüş Üzüklər</a></li>
												<li><a href='../../sirga' title='gumus sirgalar'>Gümüş Sırğalar</a></li>
												<li><a href='../../qolbaq' title='gumus qolbaqlar'>Gümüş Qolbaqlar</a></li>
												<li><a href='../../boyunbagi' title='gumus boyunbagilar'>Gümüş Boyunbağılar</a></li>
												<li><a href='../../komplekt' title='gumus komplektler'>Gümüş Komplektlər</a></li>
											</ul>
										</div>
										<div class='rightSection col-md-4'>
											<h3>bİzİ İzləyİn</h3>
											<ul> 
												<li><a href='https://www.facebook.com/' target='_blank'><i class='fa fa-facebook-official thirdSection_sosials'></i>Facebook</li></a>
												<li><a href='https://www.instagram.com' target='_blank'><i class='fa fa-instagram thirdSection_sosials'></i>Instagram</li></a>
												<li><a href='https://twitter.com/' target='_blank'><i class='fa fa-twitter-square thirdSection_sosials'></i>Twitter</li></a>
												<li><a href='https://www.youtube.com/' target='_blank'><i class='fa fa-youtube thirdSection_sosials'></i>Youtube</li></a>
											</ul>
										</div>
									</div>
								</div>
							</div>
							<script type='text/javascript'>
								$('.leftSection h3').after().click(function(){
									$('.leftSection ul').slideToggle(600);
								})
								$('.middleSection h3').after().click(function(){
									$('.middleSection ul').slideToggle(600);
								})
								$('.rightSection h3').after().click(function(){
									$('.rightSection ul').slideToggle(600);
								})
							</script>
						<!-- INFORMATION FINISH -->

						<!-- FOOTER START -->
							<div class='row'>
								<div class='col-xs-12'>
									<footer class='footer'>
										<p> Copyright © 2017 GUMUSH.AZ <br><br> Bütün Hüquqlar Qorunur.</p>
										<a class='webmaster' href='http://bakuweb.az/' target='_blank' title='Bakuweb web dizayn'>BY BakuWeb Studio</a>
									</footer>
								</div>
							</div>
						<!-- FOOTER FINISH -->
					</div>
				</body>
				</html>";
			}else{//eger olcu deyiskeninin deyeri bosdursa, yeni ki uzuk deyilse

//burda en dibden baslamalidir yazmaga cunku eks halda session start error verir
				$content = "<?php session_start(); ?>
				<!DOCTYPE html>
				<html>
				<head>
					<style type='text/css'>
						body{
							overflow: hidden;
						}
						.container{
							display: none;
						}
					</style>
					<link rel='alternate' hreflang='az' href='http://gumush.az/item/".$item_folder."/index.php' />
					<link rel='stylesheet' type='text/css' href='../../css/item.css'>
					<meta charset='utf-8'/>
					<meta http-equiv='X-UA-Compatible' content='IE=edge'>
					<link rel='author' href='https://plus.google.com/108728687434805525511/posts'/>
				   	<meta name='viewport' content='width=device-width, initial-scale=1'>
				   	<meta property='og:url' content='http://gumush.az/item/".$item_folder."/' />
					<meta property='og:type' content='website' />
					<meta property='og:title' content='".$basliq."' />
					<meta property='og:description' content='".$ceki." Qram - ".$qiymet." AZN' />
					<meta property='og:image' content='http://gumush.az/item/".$item_folder."/image0.jpg' />
					<meta property='og:image:type' content='image/jpeg' />
					<meta property='og:image:width' content='400' />
					<meta property='og:image:height' content='300' />
					<meta property='fb:app_id' content='268883703487579' />
					<meta property='fb:admins' content='ideal.nasirzade' />
					<meta property='fb:admins' content='OrxanDWK' />
					<meta property='og:site_name' content='Gumush' />
   					<link rel='icon' href='../../img/favicon.png' type='image/png' sizes='16x16' />
					<link rel='stylesheet' type='text/css' href='../../bootstrap/css/bootstrap.min.css'>
					<link rel='stylesheet' type='text/css' href='../../bootstrap/css/font-awesome.css'>
					<link rel='stylesheet' type='text/css' href='../../css/normalize.css' />
					<link rel='stylesheet' type='text/css' href='../../css/style.css'>
					<link rel='stylesheet' type='text/css' href='../../css/ideal.css'>
					<script type='text/javascript' src='../../js/jquery.min.js'></script>
					<script type='text/javascript' src='../../bootstrap/js/bootstrap.min.js'></script>
					<script type='text/javascript' src='../../js/angular.min.js'></script>
				</head>
				<body>
					<div id='fb-root'></div>
					<script>
						(function(d, s, id) {
						  var js, fjs = d.getElementsByTagName(s)[0];
						  if (d.getElementById(id)) return;
						  js = d.createElement(s); js.id = id;
						  js.src = '//connect.facebook.net/az_AZ/sdk.js#xfbml=1&version=v2.6&appId=268883703487579';
						  fjs.parentNode.insertBefore(js, fjs);
						}(document, 'script', 'facebook-jssdk'));
					</script>
					<!-- SEHIFELER YUKLENMEDEN ONCE CIXAN LOADING START -->
						<div class='circle'></div>
						<div class='circle1'></div>
					<!-- SEHIFELER YUKLENMEDEN ONCE CIXAN LOADING FINISH -->
					<script type='text/javascript'>
						$(document).ready(function(){
						    document.title = '".$basliq."';
						    setTimeout(function(){
						    	$('.circle').hide();
						    	$('.circle1').hide();
						    	$('body').css('overflow','visible');
						    },450);
						    setTimeout(function(){
								$('.container').fadeIn('slow');
						    },455);
						});
					</script>
					<div class='container'>
						<?php
							function signed_in(){
								echo '<style>.header_top_right li:nth-child(3),.header_top_right li:nth-child(4){display:none !important;}</style>';
							}
							function signed_fail(){
								echo '<style>.header_top_right li:nth-child(2){display:none !important;}</style>';
							}
							if(isset($session_user_id)){
								signed_in();
							}else{
								signed_fail();
							}
						?>
						<!-- REGISTER AND SIGN UP START -->
							<div class='alert alert-success qeydiyyat_tamamlandi'>
								<a onclick='qeydiyyat_tamamlandi_alert_bagla()' class='close'>&times;</a>
								<strong>Qeydiyyat Tamamlandı!</strong>
								<p>Xahiş edirik e-mail adresinizə göndərilən linkə daxil olaraq hesabınızı aktivləşdirin, daha sonra hesabınıza daxil olun.</p>
							</div>
							<div class='alert alert-success sifre_berpa_tamamlandi'>
								<a onclick='sifre_berpa_tamamlandi_alert_bagla()' class='close'>&times;</a>
								<strong>Əməliyyat tamamlandı!</strong>
								<p>Xahiş edirik e-mail adresinizə göndərilən linkə daxil olaraq yeni şifrənizi daxil edin.</p>
							</div>

							<div class='regBackground'></div>
							<div class='regForm' ng-app='silverstore' ng-controller='qeydiyyat'>
								<form class='form-horizontal' novalidate='novalidate'>
									<p>Qeydiyyat</p>
									<div class='form-group'>
										<label class='col-md-4 control-label' for='signup_ad'>Ad</label>  
										<div class='col-md-5'>
											<input ng-focus='hide_validate_spans()' id='signup_ad' name='signup_ad' type='text' placeholder='adınız' class='form-control' required=''>
											<div class='alert alert-danger validate_spans ad_span'>
												<span></span>
											</div>
									    </div>
									</div>
									<div class='form-group'>
										<label class='col-md-4 control-label' for='signup_soyad'>Soyad</label>  
										<div class='col-md-5'>
											<input ng-focus='hide_validate_spans()' id='signup_soyad' name='signup_soyad' type='text' placeholder='soyadınız' class='form-control' required=''>
									    	<div class='alert alert-danger validate_spans soyad_span'>
												<span></span>
											</div>
									    </div>
									</div>
									<div class='form-group'>
										<label class='col-md-4 control-label' for='signup_email'>E-mail</label>  
										<div class='col-md-5'>
											<input ng-focus='hide_validate_spans()' id='signup_email' name='signup_email' type='email' placeholder='e-mail adresiniz' class='form-control' required=''>  
											<div class='alert alert-danger validate_spans email_span'>
												<span></span>
											</div>
										</div>
									</div>
									<div class='form-group'>
										<label class='col-md-4 control-label' for='sifre'>Şifrə</label>
										<div class='col-md-5'>
											<input ng-focus='hide_validate_spans()' id='sifre' name='sifre' type='password' placeholder='şifrəniz' class='form-control' required=''>  
											<div class='alert alert-danger validate_spans sifre_span'>
												<span></span>
											</div>
										</div>
									</div>
									<div class='form-group'>
										<label class='col-md-4 control-label' for='signup_sifre_tekrar'>Şifrə təsdiq</label>
										<div class='col-md-5'>
											<input ng-focus='hide_validate_spans()' id='signup_sifre_tekrar' name='signup_sifre_tekrar' type='password' placeholder='şifrənizi təsdiqləyin' class='form-control' required=''>  
											<div class='alert alert-danger validate_spans sifre_tekrar_span'>
												<span></span>
											</div>
										</div>
									</div>
									<div class='form-group'>
										<label class='col-md-4 control-label' for='signup_telefon'>Telefon</label>  
										<div class='col-md-5'>
											<input ng-focus='hide_validate_spans()' id='signup_telefon' name='signup_telefon' type='number' placeholder='nömrəniz' class='form-control' required=''>  
											<div class='alert alert-danger validate_spans telefon_span'>
												<span></span>
											</div>
										</div>
									</div>
									<div class='form-group'>
										<label class='col-md-4 control-label' for='signup'></label>
										<div class='col-md-5'>
											<button ng-click='qeydiyyat_submit()' id='signup' type='submit' class='btn btn-success'>Tamamla</button>
											<button id='cancel_reg' type='reset' onclick='none_register()' class='btn btn-success'>Ləğv et</button>
										</div>
									</div>
									<script type='text/javascript'>
										function registration_validation(){
											hide_validate_spans();
											var ad = $('#signup_ad').val();
											var soyad = $('#signup_soyad').val();
											var email = $('#signup_email').val();
											var parol = $('#sifre').val();
											var parol_tekrar = $('#signup_sifre_tekrar').val();
											var tel = $('#signup_telefon').val();
											if(ad == ''){
												$('.ad_span').fadeIn(200);
												$('.ad_span span').text('Adınızı daxil edin!');
											}else if(ad.length < 2){
												$('.ad_span').fadeIn(200);
												$('.ad_span span').text('Ad çox qısadır (min. 2)!');
											}else if(ad.length > 12){
												$('.ad_span').fadeIn(200);
												$('.ad_span span').text('Ad çox uzundur (max. 12)!');
											}else if(NameIsLetter(ad) == false){
												$('.ad_span').fadeIn(200);
												$('.ad_span span').text('Ad yalnız hərflərdən ibarət olmalıdır!');
											}else if(soyad == ''){
												$('.soyad_span').fadeIn(200);
												$('.soyad_span span').text('Soyadınızı daxil edin!');
											}else if(soyad.length < 3){
												$('.soyad_span').fadeIn(200);
												$('.soyad_span span').text('Soyad çox qısadır (min. 3)!');
											}else if(soyad.length > 15){
												$('.soyad_span').fadeIn(200);
												$('.soyad_span span').text('Soyad çox uzundur (max. 15)!');
											}else if(SurNameIsLetter(soyad) == false){
												$('.soyad_span').fadeIn(200);
												$('.soyad_span span').text('Soyad yalnız hərflərdən ibarət olmalıdır!');
											}else if(email == ''){
												$('.email_span').fadeIn(200);
												$('.email_span span').text('E-mail adresinizi daxil edin!');
											}else if(IsEmail(email) == false){
												$('.email_span').fadeIn(200);
												$('.email_span span').text('E-mail adresinizi düzgün yazın!');
											}else if(email.length < 8){
												$('.email_span').fadeIn(200);
												$('.email_span span').text('E-mail adresi çox qısadır (min. 8)!');
											}else if(email.length > 30){
												$('.email_span').fadeIn(200);
												$('.email_span span').text('E-mail adresi çox uzundur (max. 30)!');
											}else if(parol == ''){
												$('.sifre_span').fadeIn(200);
												$('.sifre_span span').text('Şifrənizi daxil edin!');
											}else if(IsParol(parol) == false || parol.match(/_/)){
												$('.sifre_span').fadeIn(200);
												$('.sifre_span span').text('Şifrə rəqəm və hərflərdən ibarət olmalıdır!');
											}else if(parol.length < 6){
												$('.sifre_span').fadeIn(200);
												$('.sifre_span span').text('Şifrə çox qısadır (min. 6)!');
											}else if(parol.length > 20){
												$('.sifre_span').fadeIn(200);
												$('.sifre_span span').text('Şifrə çox uzundur (max. 20)!');
											}else if(parol_tekrar == ''){
												$('.sifre_tekrar_span').fadeIn(200);
												$('.sifre_tekrar_span span').text('Şifrənizi təsdiq edin!');
											}else if(parol_tekrar != parol){
												$('.sifre_tekrar_span').fadeIn(200);
												$('.sifre_tekrar_span span').text('Şifrə eyni deyil!');
											}else if(tel == ''){
												$('.telefon_span').fadeIn(200);
												$('.telefon_span span').text('Telefon nömrənizi daxil edin!')
											}else if(tel.length < 10){
												$('.telefon_span').fadeIn(200);
												$('.telefon_span span').text('Nömrə çox qısadır (min. 10)!');
											}else if(tel.length > 10){
												$('.telefon_span').fadeIn(200);
												$('.telefon_span span').text('Nömrə çox uzundur (max. 10)!');
											}else{
												$.ajax({
													url:'../../register_bw/index.php',
													type:'POST',
													data:{
														a:ad,b:soyad,c:email,d:parol,e:tel
													},
													success:function(gelen){
													if(gelen == 'ok'){
														$('.regForm').find('input').val('');
														$('.regBackground').fadeOut('slow');
														$('.regForm').fadeOut('slow');
														setTimeout(function(){
															$('.qeydiyyat_tamamlandi').fadeIn(600);
														},1000)
													}else if(gelen == 'email_is_registered'){
														$('.email_span').fadeIn(200);
														$('.email_span span').text('Bu E-mail adresi artıq qeydiyyatdan keçib!');
													}else{
														alert('Xəta baş verdi!Xahiş edirik bunu bizə bildirin!');
													}
												},
												error:function(){
													alert('Xəta baş verdi!Xahiş edirik bunu bizə bildirin!');
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
										angular.module('silverstore', [])
										.controller('qeydiyyat', function($scope){
											$scope.qeydiyyat_submit = function(){
												return registration_validation();
											}
											$scope.hide_validate_spans = function(){
												$('.validate_spans').fadeOut(400);
											}
										});
									</script>
								</form>
							</div>

							<div class='sign_in'>
								<p>Daxil Ol</p>
								<form class='form-horizontal' novalidate='novalidate'>
									<div class='form-group'>
										<label class='col-md-4 control-label' for='signin_email'>E-mail</label>  
										<div class='col-md-5'>
											<input onfocus='hide_validate_spans()' id='signin_email' name='signin_email' type='email' placeholder='e-mail adresiniz' class='form-control' required=''>
											<div class='alert alert-danger validate_spans sign_email_span'>
												<span></span>
											</div>
										</div>
									</div>
									<div class='form-group'>
										<label class='col-md-4 control-label' for='signin_password'>Şifrə</label>  
										<div class='col-md-5'>
											<input onfocus='hide_validate_spans()' id='signin_password' name='signin_password' type='password' placeholder='şifrəniz' class='form-control input-md' required=''>
											<div class='alert alert-danger validate_spans sign_sifre_span'>
												<span></span>
											</div>
									    </div>
									</div>
									<div class='form-group'>
										<label class='col-md-4 control-label'></label>
										<div class='col-md-5'>
											<button id='sifremi_unuttum_btn' type='reset' onclick='rec_pass_block()' class='btn btn-success'>Şifrəmi unuttum</button>
										</div>
									</div>
									<div class='form-group'>
										<label class='col-md-4 control-label' for='signin'></label>
										<div class='col-md-5'>
											<span id='signin' class='btn btn-success sign_in_submit_span' onclick='sign_in_validation_and_ajax()'>Daxil ol</span>
											<button id='cancel' type='reset' onclick='none_enter()' class='btn btn-success'>Geri</button>
										</div>
									</div>
								</form>
							</div>
							<script type='text/javascript'>
								$('.sign_in form').keyup(function(event){
								    if(event.keyCode == 13){
								        $('.sign_in_submit_span').click();
								    }
								});
								function sign_in_validation_and_ajax(){
									hide_validate_spans();
									var sign_email = $('#signin_email').val();
									var sign_password = $('#signin_password').val();

									if(sign_email == ''){
										$('.sign_email_span').fadeIn(200);
										$('.sign_email_span span').text('E-mail adresinizi daxil edin!');
									}else if(IsEmail(sign_email) == false){
										$('.sign_email_span').fadeIn(200);
										$('.sign_email_span span').text('E-mail adresinizi düzgün yazın!');
									}else if(sign_email.length < 8){
										$('.sign_email_span').fadeIn(200);
										$('.sign_email_span span').text('E-mail adresi çox qısadır (min. 8)!');
									}else if(sign_email.length > 30){
										$('.sign_email_span').fadeIn(200);
										$('.sign_email_span span').text('E-mail adresi çox uzundur (max. 30)!');
									}else if(sign_password == ''){
										$('.sign_sifre_span').fadeIn(200);
										$('.sign_sifre_span span').text('Şifrənizi daxil edin!');
									}else if(IsParol(sign_password) == false || sign_password.match(/_/)){
										$('.sign_sifre_span').fadeIn(200);
										$('.sign_sifre_span span').text('Şifrə rəqəm və hərflərdən ibarət olmalıdır!');
									}else if(sign_password.length < 6){
										$('.sign_sifre_span').fadeIn(200);
										$('.sign_sifre_span span').text('Şifrə çox qısadır (min. 6)!');
									}else if(sign_password.length > 20){
										$('.sign_sifre_span').fadeIn(200);
										$('.sign_sifre_span span').text('Şifrə çox uzundur (max. 20)!');
									}else{
												$.ajax({
													url:'../../sign_in_bw/index.php',
													type:'POST',
													data:{
														a:sign_email,b:sign_password
													},
													success:function(gelen){
														if(gelen == ''){
															$('.sign_email_span').fadeIn(200);
															$('.sign_email_span span').text('Bu e-mail adresi sistemimizdə mövcud deyil!');
														}else if(gelen == 'sifre_sehvdir'){
															$('.sign_sifre_span').fadeIn(200);
															$('.sign_sifre_span span').text('Şifrə yalnışdır!');
														}else if(gelen == 'hesab_aktiv_deyil'){
															$('.sign_email_span').fadeIn(200);
															$('.sign_email_span span').text('Hesabınız aktiv deyil ! E-mail adresinizə göndərilən linkə daxil olaraq hesabınızı aktivləşdirin.');
														}else if(gelen == 'signed_in'){
															$('.sign_in').find('input').val('');
															$('.regBackground').fadeOut('slow');
															$('.sign_in').fadeOut('slow');
															location.reload();
														}else{
															alert('Xəta baş verdi!Xahiş edirik bunu bizə bildirin!');
														}
													},
													error:function(){
														alert('Xəta baş verdi!Xahiş edirik bunu bizə bildirin!');
													}

												})
											}
								}
								function hide_validate_spans(){
									$('.validate_spans').fadeOut(400);
								}
							</script>


							<div class='recovery_password'>
								<p>Şifrə bərpa</p>
								<div class='form-horizontal'>
									<div class='form-group'>
										<label class='col-md-4 control-label' for='rec_pass'>E-mail</label>  
										<div class='col-md-5'>
											<input id='rec_pass' onclick='hide_validate_spans()' onkeydown='hide_validate_spans()' type='email' placeholder='e-mail adresiniz' class='form-control'>
											<div class='alert alert-danger validate_spans rec_pas_span'>
												<span></span>
											</div>
										</div>
									</div>
									<div class='form-group'>
										<label class='col-md-4 control-label' for='signin'></label>
										<div class='col-md-5'>
											<button id='signin' class='btn btn-success' onclick='my_recovery_password()'>Göndər</button>
											<button id='cancel' onclick='recovery_password_none()' class='btn btn-success'>Geri</button>
										</div>
									</div>
								</div>
							</div>
							<script type='text/javascript'>
								$('.recovery_password').keydown(function(knopka){
									if(knopka.keyCode == 13){
										my_recovery_password();
									}
								});
								function my_recovery_password(){
									var recovery_email = $('#rec_pass').val();
									if(recovery_email == ''){
										$('.rec_pas_span').fadeIn(200);
										$('.rec_pas_span span').text('E-mail adresinizi daxil edin!');
									}else if(IsEmail(recovery_email) == false){
										$('.rec_pas_span').fadeIn(200);
										$('.rec_pas_span span').text('E-mail adresinizi düzgün yazın!');
									}else if(recovery_email.length < 8){
										$('.rec_pas_span').fadeIn(200);
										$('.rec_pas_span span').text('E-mail adresi çox qısadır (min. 8)!');
									}else if(recovery_email.length > 30){
										$('.rec_pas_span').fadeIn(200);
										$('.rec_pas_span span').text('E-mail adresi çox uzundur (max. 30)!');
									}else{
										$.ajax({
											url:'../../password_recovery/index.php',
											type:'POST',
											data:{
												a:recovery_email
											},
											success:function(gelen){
												if(gelen == 'email_gonderildi'){
													$('.regBackground').fadeOut('fast');
													$('.recovery_password').fadeOut('fast');
													$('.sifre_berpa_tamamlandi').fadeIn(600);
													$('#rec_pass').val('');
												}else if(gelen == 'email_duzgun_daxil_edilmeyib'){
													$('.rec_pas_span').fadeIn(200);
													$('.rec_pas_span span').text('E-mail adresinizi düzgün yazın!');
												}else if(gelen == 'email_movcud_deyil'){
													$('.rec_pas_span').fadeIn(200);
													$('.rec_pas_span span').text('Bu e-mail adresi sistemimizdə mövcud deyil!');
												}
											},
											error:function(){
												alert('Xəta baş verdi!Xahiş edirik bunu bizə bildirin!');
											}
										});
									}
								}
								
								function qeydiyyat_tamamlandi_alert_bagla(){
									$('.qeydiyyat_tamamlandi').fadeOut(400);
								}
								function sifre_berpa_tamamlandi_alert_bagla(){
									$('.sifre_berpa_tamamlandi').fadeOut(400);
								}
								function block_register(){
									$('.regBackground').fadeIn('slow');
									$('.regForm').fadeIn('slow');
								}
								function none_register(){
									$('.regBackground').fadeOut('fast');
									$('.regForm').fadeOut('fast');
									$('.validate_spans').fadeOut(10);
								}
								function block_sign_in(){
									$('.regBackground').fadeIn('slow');
									$('.sign_in').fadeIn('slow');
								}
								function none_enter(){
									$('.regBackground').fadeOut('fast');
									$('.sign_in').fadeOut('fast');
									$('.validate_spans').fadeOut(10);
								}
								function rec_pass_block(){
									$('.sign_in').fadeOut('fast');
									$('.regBackground').fadeIn('slow');
									$('.recovery_password').fadeIn('slow');
								}
								function recovery_password_none(){
									$('.recovery_password').fadeOut('fast');
									$('.sign_in').fadeIn('slow');
									$('#rec_pass').val('');
									$('.validate_spans').fadeOut(10);
								}
								$('.regBackground').click(function(){
									$('.regBackground').fadeOut('fast');
									$('.regForm').fadeOut('fast');
									$('.sign_in').fadeOut('fast');
									$('.recovery_password').fadeOut('fast');
									$('.validate_spans').fadeOut(10);

									$('.regForm').find('input').val('');
									$('.sign_in').find('input').val('');
									$('.recovery_password').find('input').val('');
								});
							</script>
						<!-- REGISTER AND SIGN UP FINISH -->

						<!-- SIFARISH POP-UP'S START -->
							<div class='sifarish_oldu_bg'></div>
							<div class='sifarish_oldu'>
								<p>Məhsul səbətə əlavə olundu.</p>
								<button onclick='alish_verise_davam_et()'>Alış-verİşə davam et</button>
								<button onclick='alish_verisi_bitir()'>Alış-verİşİ bİtİr</button>
							</div>
							<div class='sifarish_limiti_dolub'>
								<p>Sifariş limitiniz dolub!</p>
								<p>Xahiş edirik, öncəki sifarişlərinizi tamamlayın!</p>
								<button onclick='alis_verisi_bitir_limit_dolub()'>Alış-verİşİ bİtİr</button>
							</div>
							<div class='sifarish_xeta'>
								<p>Xəta baş verdi! Xahiş edirik bunu bizə bildirin.</p>
								<button onclick='xetani_bildirin()'>Bİldİr</button>
								<button onclick='xeta_bagla()'>Bağla</button>
							</div>
							<div class='sifarish_ucun_daxil_olun'>
								<p>Sifariş vermək üçün hesabınıza daxil olun!</p>
								<button onclick='sifarish_daxil_ol()'>Daxİl ol</button>
								<button onclick='sifarish_qeydiyyatdan_kec()'>Qeydİyyatdan keç</button>
							</div>
							<div class='min_max_mehsul_sifaris'>
								<p>Ən az 1, ən çox 5 məhsul sifariş verə bilərsiniz.</p>
								<button onclick='alish_verise_davam_et()'>Alış-verİşə davam et</button>
								<button onclick='alish_verisi_bitir()'>Alış-verİşİ bİtİr</button>
							</div>
							<script type='text/javascript'>
								//alis verise davam edir
								function alish_verise_davam_et(){
									$('.sifarish_oldu_bg,.sifarish_oldu').hide(600);
									$('.sifarish_oldu_bg,.min_max_mehsul_sifaris').hide(600);
								}
								//alis verisi bitirmek ucun sebete gedir
								function alish_verisi_bitir(){
									$('.sifarish_oldu_bg,.sifarish_oldu').hide(600);
									$('.sifarish_oldu_bg,.min_max_mehsul_sifaris').hide(600);
									setTimeout(function(){
										//basqa sehifelerde istifade edende adresi uygun olaraq deyis
										window.location.href='../../sebetim';
									},600);
								}
								//alis verisi bitirmek ucun sebete gedir
								function alis_verisi_bitir_limit_dolub(){
									$('.sifarish_oldu_bg,.sifarish_limiti_dolub').hide(600);
									setTimeout(function(){
										//basqa sehifelerde istifade edende adresi uygun olaraq deyis
										window.location.href='../../sebetim';
									},600);
								}
								//xeta bas vererse bunu contact sehifesi vasitesile bildirir
								function xetani_bildirin(){
									$('.sifarish_oldu_bg,.sifarish_xeta').hide(600);
									setTimeout(function(){
										//basqa sehifelerde istifade edende adresi uygun olaraq deyis
										window.location.href='../../contact';
									},600);
								}
								//bildirmek istemese xeta bildiris penceresini baglayir
								function xeta_bagla(){
									$('.sifarish_oldu_bg,.sifarish_xeta').hide(600);
								}
								//daxil ol pop up display block olur ve sifaris ucun daxil ol pop up display none olur
								function sifarish_daxil_ol(){
									$('.sifarish_oldu_bg,.sifarish_ucun_daxil_olun').hide(600);
									setTimeout(function(){
										block_sign_in();
										$('html, body').animate({ scrollTop: 0 }, 'slow');
									},600);
								}
								//qeydiyyatdan kec pop up display block olur ve sifaris ucun daxil ol pop up display none olur
								function sifarish_qeydiyyatdan_kec(){
									$('.sifarish_oldu_bg,.sifarish_ucun_daxil_olun').hide(600);
									setTimeout(function(){
										block_register();
										$('html, body').animate({ scrollTop: 0 }, 'slow');
									},600);
								}
							</script>
						<!-- SIFARISH POP-UP'S FINISH -->

						<!-- SIFARISH START -->
							<script type='text/javascript'>
								function sifarish(this_id,item_eded){
									//gelen deyer mehsul9050 olarsa mehsul sozunu silib 9050 cixart ve sadece mehsulun id adresini al
									var mehsul_id = this_id.slice(6);
									$.ajax({
										type:'POST',
										url:'../../sebetim/elave_et.php',
										data: {mehsul:mehsul_id,eded:item_eded},
										success:function(gelen){
											if(gelen == 'limit_dolub'){
												$('.sifarish_oldu_bg,.sifarish_limiti_dolub').show(600)
											}else if(gelen == 'sifarish_oldu'){
												$('.sifarish_oldu_bg,.sifarish_oldu').show(600);
											}else if(gelen == 'xeta'){
												$('.sifarish_oldu_bg,.sifarish_xeta').show(600);
											}else if(gelen == 'daxil_olun'){
												$('.sifarish_oldu_bg,.sifarish_ucun_daxil_olun').show(600);
											}
										},
										error:function(err){
											$('.sifarish_oldu_bg,.sifarish_xeta').show(600);
										}
									});
								}
							</script>
						<!-- SIFARISH FINISH -->

						<!-- TOP HEADER START -->
								<div class='my_top_header'>
									<ul class='header_top_left'>
										<li><a href='../../' title='gumush.az'>Ana Səhifə</a></li>
										<li><a href='../../contact' title='bizimle elaqe'>Bizimlə Əlaqə</a></li>
									</ul>
									<script type='text/javascript'>
										function exit(){
											$.ajax({
												url:'../../exit.php',
												type:'POST',
												data:{
													exit:'exit'
												},
												success:function(gelen){
													location.reload();
												},
												error:function(){
													alert('Xəta baş verdi!Xahiş edirik bunu bizə bildirin!');
												}
											});
										}
									</script>
									<ul class='header_top_right'>
										<li><a href='../../sebetim' title='sebetim'>Səbətim</a></li>
										<li><button onclick='exit()'>Çıxış</button></li>
										<li><button onclick='block_sign_in()'>Daxil Ol</button></li>
										<li><button onclick='block_register()'>Qeydiyyat</button></li>
									</ul>
								</div>
						<!-- TOP HEADER FINISH -->

						<!-- HEADER START -->
							<div class='row'>
								<header class='col-xs-12 col-md-12'>
									<div class='logo col-md-8 col-xs-12'>
										<a href='../../' title='gumush.az'>
											<img src='../../img/silverstore.jpg' alt='gumush.az'>
										</a>
									</div>
									<div class='searchBox col-md-4 col-xs-12'>
										<div class='input-group'>
									  		<input type='text' class='form-control axtar_input' placeholder='Axtar'>
									      	<span class='input-group-btn'>
											    <button class='btn btn-default header_search_btn' onclick='axtar()'>
											    	<img src='../../img/axtar.png' alt='axtar'>
											    </button>
									      	</span>
									      	<script type='text/javascript'>
									      		$('.axtar_input').keydown(function(knopka){
													if(knopka.keyCode == 13){
														axtar();
													}
												});
									      		function axtar(){
									      			var axtar_input = $('.axtar_input').val();
									      			if(axtar_input != ''){
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
														                .replace(/\s/gi, '-') // bosluqlari- ile evezle
														                .replace(/[-]+/gi, '-') // tekrarlanan -- lari - ile evezle
														                .toLowerCase();
														}
														axtar_input = herfleri_deyis(axtar_input);
										      			window.location.href='../../axtaris.php?txt='+axtar_input;
									      			}
									      		}
									      	</script>
									    </div>
									</div>
								</header>
							</div>
						<!-- HEADER FINISH -->

						<!-- NAVBAR START -->
							<div class='row main_divs_space'>
								<div class='mynav_div col-xs-12'>
									<nav class='navbar col-xs-12'>
										<p class='closed_menu'></p>
										<ul> 
											<li>
												<a class='menu_before' href='../../uzuk' title='Üzüklər'>Üzüklər</a>
											</li>
											<li>
												<a class='menu_before' href='../../sirga' title='Sırqalar'>Sırğalar</a>
											</li>
											<li>
												<a class='menu_before' href='../../qolbaq' title='Qolbaqlar'>Qolbaqlar</a>
											</li>
											<li>
												<a class='menu_before' href='../../boyunbagi' title='Boyunbağılar'>Boyunbağılar</a>
											</li>	
											<li>
												<a class='menu_before' href='../../komplekt' title='Komplektlər'>Komplektlər</a>
											</li>
										</ul>
									</nav>
								</div>
							</div>
							<script type='text/javascript'>
								$('.closed_menu').after().click(function(){
									$('.navbar').find('ul').slideToggle(700);
								})
							</script>
						<!-- NAVBAR FINISH -->

						<!-- ITEM START -->
							<div class='row main_divs_space item_main'>
								<div class='col-xs-12 item-top-nav main_divs_space'>
									<a href='../../'><i class='fa fa-home' aria-hidden='true' title='ana sehife'></i></a>
									<a href='".$k_href."' title='".$k_title."'>".$kateqoriya_template."</a>
									<p>".$basliq."</p>
								</div>
								<div>
									<div class='item_img col-md-6 col-sm-5'>
										<img class='slider_img' src='image0.jpg' alt='".$img_alt."'>
										<div class='col-xs-12 tumb_main'>
											<?php
											for($b=0;$b<".$total.";$b++){
												echo ".'"'."
														<div class='col-xs-3 item_img_tumb'>
															<img onclick='change_img(this.src)' src='image".'"'.".$b.".'"'.".jpg' height='110' alt='".$img_alt."' />
														</div>
												".'"'.";
											}
											?>
										</div>
										<script type='text/javascript'>
											function change_img(src){
												$('.slider_img').css('opacity','0');
												setTimeout(function(){
													$('.slider_img').attr('src', src);
													$('.slider_img').css('opacity','1');
												},400)

											}
										</script>
									</div>
									<div class='item_info col-md-3 col-sm-4'>
										<h1>".$basliq."</h1>
										<p class='item_weight'>Çəki: <span>".$ceki."</span></p>
										<p class='item_olcu'>Ölçü: <span><i class='fa fa-minus' aria-hidden='true'></i></span></p>
										<p class='item_qas'>Qaş: <span>".$qas."</span></p>
										<p class='item_kateqoriya'>Kateqoriya: <span>".$kateqoriya_template."</span></p>
										<p class='item_veziyyeti'>Vəziyyəti: <span>YENİ</span></p>
										<p class='stokda_var'>Stokda var</p>
									</div>
									<div class='item_buy col-md-3 col-sm-3'>
										<p class='item_price'>".$qiymet." AZN</p>
										<div class='item_amount'>
											<p>Ədəd:</p>
											<input id='item_price_input' type='number' class='form-control item_eded' value='1'>
											<button onclick='price_minus()'><i class='fa fa-minus' aria-hidden='true'></i></button>
											<button onclick='price_plus()'><i class='fa fa-plus' aria-hidden='true'></i></button>
											<script type='text/javascript'>
												function price_minus(){
													a = $('#item_price_input').val();
													if(a > 1){
														a = a-1;
														$('#item_price_input').val(a)
													}
												}
												function price_plus(){
													b = $('#item_price_input').val();
													if(b > 0 && b < 5){
														b = parseInt(b)+1;
														$('#item_price_input').val(b);
													}
												}
												function nece_eded_sifarish(this__id){
													var item_eded = document.getElementsByClassName('item_eded')[0].value;
													if(item_eded < 1 || item_eded > 5){
														$('.sifarish_oldu_bg,.min_max_mehsul_sifaris').show(600);
													}else{
														sifarish(this__id,item_eded);
													}
												}
											</script>
										</div>
										<div class='item_btn_div'>
											<button onclick='nece_eded_sifarish(this.id)' id='mehsul".$last_id_of_mehsullar."' class='btn btn-success'>Səbətə əlavə et</button>
										</div>
									</div>
								</div>
								<div class='col-xs-12 oxsar_kat_basliq'>
									<h3>Eyni kateqoriyadakı digər mallar:</h3>
								</div>
								<div class='col-xs-12 item_oxsar_kateqoriya'>
									<button onclick='prev_items()' class='iox_btn-l'><i class='fa fa-arrow-left' aria-hidden='true'></i></button>
										<?php
											$eyni_kateqoriyadaki_diger_mallar
										?>
									<button onclick='next_items()' class='iox_btn-r'><i class='fa fa-arrow-right' aria-hidden='true'></i></button>
									<script type='text/javascript'>
										var current_place = 0;
										function prev_items(){
											if(current_place<0){
												current_place = current_place + 200;
												$('.item_oxsar_kateqoriya a').css('transform','translate('+current_place+'px,0px)');
											}							
										}
										function next_items(){
											t=-1800;
											if(window.innerWidth>992 && window.innerWidth<1200){
												t=-2000;
											}else if(window.innerWidth>768 && window.innerWidth<992){
												t=-2200;
											}else if(window.innerWidth<768){
												t=-2200;
											}
											if(current_place>t){
												current_place = current_place - 200;
												$('.item_oxsar_kateqoriya a').css('transform','translate('+current_place+'px,0px)');
											}
										}
									</script>
								</div>
							</div>
						<!-- ITEM FINISH -->

						<!-- CONTACT US START -->
							<div class='row main_divs_space'>
									<div class='contactUs col-xs-12'>
										<div class='contactFace col-md-4'>
											<h3>Bizi Facebook`da izləyin</h3>
											<div class='fb-page' data-href='https://www.facebook.com/gumush.az/' data-tabs='messages' data-width='270' data-height='350' data-small-header='false' data-adapt-container-width='false' data-hide-cover='false' data-show-facepile='true'><blockquote cite='https://www.facebook.com/gumush.az/' class='fb-xfbml-parse-ignore'><a href='https://www.facebook.com/gumush.az/'>Gumush.az</a></blockquote></div>
										</div>
										<div class='freeDelivery col-md-4'>
											<div class='my_box'>
												<div class='col-xs-2 my_truck'>
													
												</div>
												<div class='col-xs-10'>
													<h3>Pulsuz Çatdırılma</h3>
													<p>Bakı şəhəri daxilində sifariş verdiyiniz məhsulları istədiyiniz ünvana heç bir əlavə ödəniş tələb etmədən vaxtında çatdırırıq.</p>
												</div>
											</div>
											<div class='my_box'>
												<div class='col-xs-2 qapida_odeme'>
													
												</div>
												<div class='col-xs-10'>
													<h3>Qapıda Ödəmə</h3>
													<p>Ödənişi sizdən nağd və sifariş etdiyiniz məhsulları təhvil aldığınız zaman alırıq.</p>
												</div>
											</div>
											<div class='my_box'>
												<div class='col-xs-2 SSL_icon'>
													
												</div>
												<div class='col-xs-10'>
													<h3>Etibarlı Alış-Veriş</h3>
													<p>Alış-verişinizi daha etibarlı edə bilməyiniz üçün SSL təhlükəsizlik sertifikatından istifadə edirik.</p>
												</div>
											</div>
										</div>
										<div class='customBlock col-md-4'>
											<div class='my_box'>
												<div class='col-xs-2 SSL_icon'>
													
												</div>
												<div class='col-xs-10'>
													<h3>Şəxsi Məlumatlarınızın Təhlükəsizliyi</h3>
													<p>Gumush.az`a verdiyiniz bütün məlumatlar qətiliklə gizli tutulacaq. Şəxsi məlumatlarınız mövzusunda nə qədər həssas olduğunuzu bilirik. Məxfi məlumatlarınızı üçüncü şəxslər və ya firmamızın əməkdaşlarının bilməsi qeyri-mümkündür.</p>
												</div>
											</div>
										</div>
									</div>
							</div>
						<!-- CONTACT US FINISH -->

						<!-- INFORMATION START -->
							<div class='row main_divs_space'>
								<div class='allSection col-xs-12'>
									<div class='thirdSection'>
										<div class='cover_footer_top col-xs-12'> </div>
										<div class='leftSection col-md-4'>
											<h3>Əlaqə</h3>
											<ul> 
												<li><a>Mobil: <span>055 581 08 72</span></a></li>
												<li><a>E-mail: <span>support@gumush.az</span></a></li>
												<li><a href='../../contact'><strong>Əlaqə Formu</strong></a></li>
											</ul>
										</div>
										<div class='middleSection col-md-4'>
											<h3>Məhsullar</h3>
											<ul> 
												<li><a href='../../uzuk' title='gumus uzukler'>Gümüş Üzüklər</a></li>
												<li><a href='../../sirga' title='gumus sirgalar'>Gümüş Sırğalar</a></li>
												<li><a href='../../qolbaq' title='gumus qolbaqlar'>Gümüş Qolbaqlar</a></li>
												<li><a href='../../boyunbagi' title='gumus boyunbagilar'>Gümüş Boyunbağılar</a></li>
												<li><a href='../../komplekt' title='gumus komplektler'>Gümüş Komplektlər</a></li>
											</ul>
										</div>
										<div class='rightSection col-md-4'>
											<h3>bİzİ İzləyİn</h3>
											<ul> 
												<li><a href='https://www.facebook.com/' target='_blank'><i class='fa fa-facebook-official thirdSection_sosials'></i>Facebook</li></a>
												<li><a href='https://www.instagram.com' target='_blank'><i class='fa fa-instagram thirdSection_sosials'></i>Instagram</li></a>
												<li><a href='https://twitter.com/' target='_blank'><i class='fa fa-twitter-square thirdSection_sosials'></i>Twitter</li></a>
												<li><a href='https://www.youtube.com/' target='_blank'><i class='fa fa-youtube thirdSection_sosials'></i>Youtube</li></a>
											</ul>
										</div>
									</div>
								</div>
							</div>
							<script type='text/javascript'>
								$('.leftSection h3').after().click(function(){
									$('.leftSection ul').slideToggle(600);
								})
								$('.middleSection h3').after().click(function(){
									$('.middleSection ul').slideToggle(600);
								})
								$('.rightSection h3').after().click(function(){
									$('.rightSection ul').slideToggle(600);
								})
							</script>
						<!-- INFORMATION FINISH -->

						<!-- FOOTER START -->
							<div class='row'>
								<div class='col-xs-12'>
									<footer class='footer'>
										<p> Copyright © 2017 GUMUSH.AZ <br><br> Bütün Hüquqlar Qorunur.</p>
										<a class='webmaster' href='http://bakuweb.az/' target='_blank' title='Bakuweb web dizayn'>BY BakuWeb Studio</a>
									</footer>
								</div>
							</div>
						<!-- FOOTER FINISH -->
					</div>
				</body>
				</html>";
			}
			

			$fp = fopen("../../../item/".$item_folder."/index.php","wb");
			fwrite($fp,$content);
			fclose($fp);
		//papkada index.php fayli yaradilir finish



		
		$sekil_move_olub = false;

		if($total < 5){
			for($i=0; $i<$total; $i++) {
			  $yeri = $_FILES['image']['tmp_name'][$i];
			  $olcusu = $_FILES['image']['size'][$i];

			  //Make sure we have a filepath
			  if ($yeri != "" && $olcusu < 10000000){
			    //Setup our new file path
			    $yeni_yeri = "../../../item/".$item_folder."/image".$i.".jpg";
			    //Upload the file into the temp dir
			    if(move_uploaded_file($yeri, $yeni_yeri)) {
			    	$sekil_move_olub = true;
			    }
			  }else{
			  	echo "Faylın göndərilməsində problem yaşandı!";
			  }
			}
		}else{
			echo "<script>alert('Maksimum 4 şəkil yükləmək olar!');
					window.location.href='../admin.php';</script>";
		}
		if($sekil_move_olub == true){
	    	include '../../../db-bakuweb/db.php';
	    	if($conn){
	    		$insert = "INSERT INTO mehsullar (basliq,kateqoriya,qiymet,olcu,ceki,cins,yasgrupu,qas,tmp,img_alt,a_title,mehsulun_sahibi) VALUES ('$basliq','$kateqoriya','$qiymet','$olcu','$ceki','$cins','$yas_grupu','$qas','$item_folder','$img_alt','$a_title','$mehsulun_sahibi')";
				$netice = mysqli_query($conn,$insert);
	    		if($netice){
				//nece eded hansi mehsuldan qaldigini mueyyen edir, yoxdursa 0 yazir
				//butun kateqoriyalar
				$uzuk=0;
				$sirga=0;
				$qolbaq=0;
				$boyunbagi=0;
				$komplekt=0;

				//uzukler
				$u_qiymet_10_30 = 0;
				$u_qiymet_30_50 = 0;
				$u_qiymet_50_70 = 0;
				$u_qiymet_70_100 = 0;
				$u_qiymet_100_plus = 0;

				$u_olcu_16_minus = 0;
				$u_olcu_16_18 = 0;
				$u_olcu_18_20= 0;
				$u_olcu_20_22 = 0;
				$u_olcu_22_24 = 0;

				$u_ceki_1_5 = 0;
				$u_ceki_5_10 = 0;
				$u_ceki_10_20 = 0;
				$u_ceki_20_30 = 0;
				$u_ceki_30_plus = 0;

				$u_cins_kisi = 0;
				$u_cins_qadin = 0;

				$u_yasgrupu_usaq = 0;
				$u_yasgrupu_boyuk = 0;

				//sirga
				$s_qiymet_10_30 = 0;
				$s_qiymet_30_50 = 0;
				$s_qiymet_50_70 = 0;
				$s_qiymet_70_100 = 0;
				$s_qiymet_100_plus = 0;

				$s_ceki_1_5 = 0;
				$s_ceki_5_10 = 0;
				$s_ceki_10_20 = 0;
				$s_ceki_20_30 = 0;
				$s_ceki_30_plus = 0;

				$s_yasgrupu_usaq = 0;
				$s_yasgrupu_boyuk = 0;

				//qolbaq
				$q_qiymet_10_30 = 0;
				$q_qiymet_30_50 = 0;
				$q_qiymet_50_70 = 0;
				$q_qiymet_70_100 = 0;
				$q_qiymet_100_plus = 0;

				$q_ceki_1_5 = 0;
				$q_ceki_5_10 = 0;
				$q_ceki_10_20 = 0;
				$q_ceki_20_30 = 0;
				$q_ceki_30_plus = 0;

				$q_cins_kisi = 0;
				$q_cins_qadin = 0;

				$q_yasgrupu_usaq = 0;
				$q_yasgrupu_boyuk = 0;

				//boyunbagilar
				$b_qiymet_10_30 = 0;
				$b_qiymet_30_50 = 0;
				$b_qiymet_50_70 = 0;
				$b_qiymet_70_100 = 0;
				$b_qiymet_100_plus = 0;

				$b_ceki_1_5 = 0;
				$b_ceki_5_10 = 0;
				$b_ceki_10_20 = 0;
				$b_ceki_20_30 = 0;
				$b_ceki_30_plus = 0;

				$b_cins_kisi = 0;
				$b_cins_qadin = 0;

				$b_yasgrupu_usaq = 0;
				$b_yasgrupu_boyuk = 0;

				//komplektler
				$k_qiymet_10_30 = 0;
				$k_qiymet_30_50 = 0;
				$k_qiymet_50_70 = 0;
				$k_qiymet_70_100 = 0;
				$k_qiymet_100_plus = 0;

				$k_ceki_1_5 = 0;
				$k_ceki_5_10 = 0;
				$k_ceki_10_20 = 0;
				$k_ceki_20_30 = 0;
				$k_ceki_30_plus = 0;

				$k_cins_kisi = 0;
				$k_cins_qadin = 0;

				$k_yasgrupu_usaq = 0;
				$k_yasgrupu_boyuk = 0;

				if($conn){
					$select_all_for_mehsul_sayisi = "SELECT * FROM mehsullar";
					$mehsul_sayisi = mysqli_query($conn,$select_all_for_mehsul_sayisi);
					while($row = mysqli_fetch_assoc($mehsul_sayisi)){
						//butun kateqoriyalar
						if($row['kateqoriya']=="uzuk"){
							$uzuk++;
						}
						if($row['kateqoriya']=="sirga"){
							$sirga++;
						}
						if($row['kateqoriya']=="qolbaq"){
							$qolbaq++;
						}
						if($row['kateqoriya']=="boyunbagi"){
							$boyunbagi++;
						}
						if($row['kateqoriya']=="komplekt"){
							$komplekt++;
						}
						//uzukler
						if($row['kateqoriya']=="uzuk" && $row['qiymet']>=10 && $row['qiymet']<=30){
							$u_qiymet_10_30++;
						}
						if($row['kateqoriya']=="uzuk" && $row['qiymet']>=30 && $row['qiymet']<=50){
							$u_qiymet_30_50++;
						}
						if($row['kateqoriya']=="uzuk" && $row['qiymet']>=50 && $row['qiymet']<=70){
							$u_qiymet_50_70++;
						}
						if($row['kateqoriya']=="uzuk" && $row['qiymet']>=70 && $row['qiymet']<=100){
							$u_qiymet_70_100++;
						}
						if($row['kateqoriya']=="uzuk" && $row['qiymet']>100){
							$u_qiymet_100_plus++;
						}
						if($row['kateqoriya']=="uzuk" && $row['olcu']<16){
							$u_olcu_16_minus++;
						}
						if($row['kateqoriya']=="uzuk" && $row['olcu']>=16 && $row['olcu']<=18){
							$u_olcu_16_18++;
						}
						if($row['kateqoriya']=="uzuk" && $row['olcu']>=18 && $row['olcu']<=20){
							$u_olcu_18_20++;
						}
						if($row['kateqoriya']=="uzuk" && $row['olcu']>=20 && $row['olcu']<=22){
							$u_olcu_20_22++;
						}
						if($row['kateqoriya']=="uzuk" && $row['olcu']>=22 && $row['olcu']<=24){
							$u_olcu_22_24++;
						}
						if($row['kateqoriya']=="uzuk" && $row['ceki']>=1 && $row['ceki']<=5){
							$u_ceki_1_5++;
						}
						if($row['kateqoriya']=="uzuk" && $row['ceki']>=5 && $row['ceki']<=10){
							$u_ceki_5_10++;
						}
						if($row['kateqoriya']=="uzuk" && $row['ceki']>=10 && $row['ceki']<=20){
							$u_ceki_10_20++;
						}
						if($row['kateqoriya']=="uzuk" && $row['ceki']>=20 && $row['ceki']<=30){
							$u_ceki_20_30++;
						}
						if($row['kateqoriya']=="uzuk" && $row['ceki']>30){
							$u_ceki_30_plus++;
						}
						if($row['kateqoriya']=="uzuk" && $row['cins']=="kisi"){
							$u_cins_kisi++;
						}
						if($row['kateqoriya']=="uzuk" && $row['cins']=="qadin"){
							$u_cins_qadin++;
						}
						if($row['kateqoriya']=="uzuk" && $row['yasgrupu']=="usaq"){
							$u_yasgrupu_usaq++;
						}
						if($row['kateqoriya']=="uzuk" && $row['yasgrupu']=="boyuk"){
							$u_yasgrupu_boyuk++;
						}
						//sirgalar
						if($row['kateqoriya']=="sirga" && $row['qiymet']>=10 && $row['qiymet']<=30){
							$s_qiymet_10_30++;
						}
						if($row['kateqoriya']=="sirga" && $row['qiymet']>=30 && $row['qiymet']<=50){
							$s_qiymet_30_50++;
						}
						if($row['kateqoriya']=="sirga" && $row['qiymet']>=50 && $row['qiymet']<=70){
							$s_qiymet_50_70++;
						}
						if($row['kateqoriya']=="sirga" && $row['qiymet']>=70 && $row['qiymet']<=100){
							$s_qiymet_70_100++;
						}
						if($row['kateqoriya']=="sirga" && $row['qiymet']>100){
							$s_qiymet_100_plus++;
						}
						if($row['kateqoriya']=="sirga" && $row['ceki']>=1 && $row['ceki']<=5){
							$s_ceki_1_5++;
						}
						if($row['kateqoriya']=="sirga" && $row['ceki']>=5 && $row['ceki']<=10){
							$s_ceki_5_10++;
						}
						if($row['kateqoriya']=="sirga" && $row['ceki']>=10 && $row['ceki']<=20){
							$s_ceki_10_20++;
						}
						if($row['kateqoriya']=="sirga" && $row['ceki']>=20 && $row['ceki']<=30){
							$s_ceki_20_30++;
						}
						if($row['kateqoriya']=="sirga" && $row['ceki']>30){
							$s_ceki_30_plus++;
						}
						if($row['kateqoriya']=="sirga" && $row['yasgrupu']=="usaq"){
							$s_yasgrupu_usaq++;
						}
						if($row['kateqoriya']=="sirga" && $row['yasgrupu']=="boyuk"){
							$s_yasgrupu_boyuk++;
						}
						//qolbaqlar
						if($row['kateqoriya']=="qolbaq" && $row['qiymet']>=10 && $row['qiymet']<=30){
							$q_qiymet_10_30++;
						}
						if($row['kateqoriya']=="qolbaq" && $row['qiymet']>=30 && $row['qiymet']<=50){
							$q_qiymet_30_50++;
						}
						if($row['kateqoriya']=="qolbaq" && $row['qiymet']>=50 && $row['qiymet']<=70){
							$q_qiymet_50_70++;
						}
						if($row['kateqoriya']=="qolbaq" && $row['qiymet']>=70 && $row['qiymet']<=100){
							$q_qiymet_70_100++;
						}
						if($row['kateqoriya']=="qolbaq" && $row['qiymet']>100){
							$q_qiymet_100_plus++;
						}
						if($row['kateqoriya']=="qolbaq" && $row['ceki']>=1 && $row['ceki']<=5){
							$q_ceki_1_5++;
						}
						if($row['kateqoriya']=="qolbaq" && $row['ceki']>=5 && $row['ceki']<=10){
							$q_ceki_5_10++;
						}
						if($row['kateqoriya']=="qolbaq" && $row['ceki']>=10 && $row['ceki']<=20){
							$q_ceki_10_20++;
						}
						if($row['kateqoriya']=="qolbaq" && $row['ceki']>=20 && $row['ceki']<=30){
							$q_ceki_20_30++;
						}
						if($row['kateqoriya']=="qolbaq" && $row['ceki']>30){
							$q_ceki_30_plus++;
						}
						if($row['kateqoriya']=="qolbaq" && $row['cins']=="kisi"){
							$q_cins_kisi++;
						}
						if($row['kateqoriya']=="qolbaq" && $row['cins']=="qadin"){
							$q_cins_qadin++;
						}
						if($row['kateqoriya']=="qolbaq" && $row['yasgrupu']=="usaq"){
							$q_yasgrupu_usaq++;
						}
						if($row['kateqoriya']=="qolbaq" && $row['yasgrupu']=="boyuk"){
							$q_yasgrupu_boyuk++;
						}
						//boyunbagilar
						if($row['kateqoriya']=="boyunbagi" && $row['qiymet']>=10 && $row['qiymet']<=30){
							$b_qiymet_10_30++;
						}
						if($row['kateqoriya']=="boyunbagi" && $row['qiymet']>=30 && $row['qiymet']<=50){
							$b_qiymet_30_50++;
						}
						if($row['kateqoriya']=="boyunbagi" && $row['qiymet']>=50 && $row['qiymet']<=70){
							$b_qiymet_50_70++;
						}
						if($row['kateqoriya']=="boyunbagi" && $row['qiymet']>=70 && $row['qiymet']<=100){
							$b_qiymet_70_100++;
						}
						if($row['kateqoriya']=="boyunbagi" && $row['qiymet']>100){
							$b_qiymet_100_plus++;
						}
						if($row['kateqoriya']=="boyunbagi" && $row['ceki']>=1 && $row['ceki']<=5){
							$b_ceki_1_5++;
						}
						if($row['kateqoriya']=="boyunbagi" && $row['ceki']>=5 && $row['ceki']<=10){
							$b_ceki_5_10++;
						}
						if($row['kateqoriya']=="boyunbagi" && $row['ceki']>=10 && $row['ceki']<=20){
							$b_ceki_10_20++;
						}
						if($row['kateqoriya']=="boyunbagi" && $row['ceki']>=20 && $row['ceki']<=30){
							$b_ceki_20_30++;
						}
						if($row['kateqoriya']=="boyunbagi" && $row['ceki']>30){
							$b_ceki_30_plus++;
						}
						if($row['kateqoriya']=="boyunbagi" && $row['cins']=="kisi"){
							$b_cins_kisi++;
						}
						if($row['kateqoriya']=="boyunbagi" && $row['cins']=="qadin"){
							$b_cins_qadin++;
						}
						if($row['kateqoriya']=="boyunbagi" && $row['yasgrupu']=="usaq"){
							$b_yasgrupu_usaq++;
						}
						if($row['kateqoriya']=="boyunbagi" && $row['yasgrupu']=="boyuk"){
							$b_yasgrupu_boyuk++;
						}
						//komplektler
						if($row['kateqoriya']=="komplekt" && $row['qiymet']>=10 && $row['qiymet']<=30){
							$k_qiymet_10_30++;
						}
						if($row['kateqoriya']=="komplekt" && $row['qiymet']>=30 && $row['qiymet']<=50){
							$k_qiymet_30_50++;
						}
						if($row['kateqoriya']=="komplekt" && $row['qiymet']>=50 && $row['qiymet']<=70){
							$k_qiymet_50_70++;
						}
						if($row['kateqoriya']=="komplekt" && $row['qiymet']>=70 && $row['qiymet']<=100){
							$k_qiymet_70_100++;
						}
						if($row['kateqoriya']=="komplekt" && $row['qiymet']>100){
							$k_qiymet_100_plus++;
						}
						if($row['kateqoriya']=="komplekt" && $row['ceki']>=1 && $row['ceki']<=5){
							$k_ceki_1_5++;
						}
						if($row['kateqoriya']=="komplekt" && $row['ceki']>=5 && $row['ceki']<=10){
							$k_ceki_5_10++;
						}
						if($row['kateqoriya']=="komplekt" && $row['ceki']>=10 && $row['ceki']<=20){
							$k_ceki_10_20++;
						}
						if($row['kateqoriya']=="komplekt" && $row['ceki']>=20 && $row['ceki']<=30){
							$k_ceki_20_30++;
						}
						if($row['kateqoriya']=="komplekt" && $row['ceki']>30){
							$k_ceki_30_plus++;
						}
						if($row['kateqoriya']=="komplekt" && $row['cins']=="kisi"){
							$k_cins_kisi++;
						}
						if($row['kateqoriya']=="komplekt" && $row['cins']=="qadin"){
							$k_cins_qadin++;
						}
						if($row['kateqoriya']=="komplekt" && $row['yasgrupu']=="usaq"){
							$k_yasgrupu_usaq++;
						}
						if($row['kateqoriya']=="komplekt" && $row['yasgrupu']=="boyuk"){
							$k_yasgrupu_boyuk++;
						}
					}
					$update_mehsul_sayisi = '[{"uzuk":"'.$uzuk.'","sirga":"'.$sirga.'","qolbaq":"'.$qolbaq.'","boyunbagi":"'.$boyunbagi.'","komplekt":"'.$komplekt.'","u_qiymet_10_30":"'.$u_qiymet_10_30.'","u_qiymet_30_50":"'.$u_qiymet_30_50.'","u_qiymet_50_70":"'.$u_qiymet_50_70.'","u_qiymet_70_100":"'.$u_qiymet_70_100.'","u_qiymet_100_plus":"'.$u_qiymet_100_plus.'","u_olcu_16_minus":"'.$u_olcu_16_minus.'","u_olcu_16_18":"'.$u_olcu_16_18.'","u_olcu_18_20":"'.$u_olcu_18_20.'","u_olcu_20_22":"'.$u_olcu_20_22.'","u_olcu_22_24":"'.$u_olcu_22_24.'","u_ceki_1_5":"'.$u_ceki_1_5.'","u_ceki_5_10":"'.$u_ceki_5_10.'","u_ceki_10_20":"'.$u_ceki_10_20.'","u_ceki_20_30":"'.$u_ceki_20_30.'","u_ceki_30_plus":"'.$u_ceki_30_plus.'","u_cins_kisi":"'.$u_cins_kisi.'","u_cins_qadin":"'.$u_cins_qadin.'","u_yasgrupu_usaq":"'.$u_yasgrupu_usaq.'","u_yasgrupu_boyuk":"'.$u_yasgrupu_boyuk.'","s_qiymet_10_30":"'.$s_qiymet_10_30.'","s_qiymet_30_50":"'.$s_qiymet_30_50.'","s_qiymet_50_70":"'.$s_qiymet_50_70.'","s_qiymet_70_100":"'.$s_qiymet_70_100.'","s_qiymet_100_plus":"'.$s_qiymet_100_plus.'","s_ceki_1_5":"'.$s_ceki_1_5.'","s_ceki_5_10":"'.$s_ceki_5_10.'","s_ceki_10_20":"'.$s_ceki_10_20.'","s_ceki_20_30":"'.$s_ceki_20_30.'","s_ceki_30_plus":"'.$s_ceki_30_plus.'","s_yasgrupu_usaq":"'.$s_yasgrupu_usaq.'","s_yasgrupu_boyuk":"'.$s_yasgrupu_boyuk.'","q_qiymet_10_30":"'.$q_qiymet_10_30.'","q_qiymet_30_50":"'.$q_qiymet_30_50.'","q_qiymet_50_70":"'.$q_qiymet_50_70.'","q_qiymet_70_100":"'.$q_qiymet_70_100.'","q_qiymet_100_plus":"'.$q_qiymet_100_plus.'","q_ceki_1_5":"'.$q_ceki_1_5.'","q_ceki_5_10":"'.$q_ceki_5_10.'","q_ceki_10_20":"'.$q_ceki_10_20.'","q_ceki_20_30":"'.$q_ceki_20_30.'","q_ceki_30_plus":"'.$q_ceki_30_plus.'","q_cins_kisi":"'.$q_cins_kisi.'","q_cins_qadin":"'.$q_cins_qadin.'","q_yasgrupu_usaq":"'.$q_yasgrupu_usaq.'","q_yasgrupu_boyuk":"'.$q_yasgrupu_boyuk.'","b_qiymet_10_30":"'.$b_qiymet_10_30.'","b_qiymet_30_50":"'.$b_qiymet_30_50.'","b_qiymet_50_70":"'.$b_qiymet_50_70.'","b_qiymet_70_100":"'.$b_qiymet_70_100.'","b_qiymet_100_plus":"'.$b_qiymet_100_plus.'","b_ceki_1_5":"'.$b_ceki_1_5.'","b_ceki_5_10":"'.$b_ceki_5_10.'","b_ceki_10_20":"'.$b_ceki_10_20.'","b_ceki_20_30":"'.$b_ceki_20_30.'","b_ceki_30_plus":"'.$b_ceki_30_plus.'","b_cins_kisi":"'.$b_cins_kisi.'","b_cins_qadin":"'.$b_cins_qadin.'","b_yasgrupu_usaq":"'.$b_yasgrupu_usaq.'","b_yasgrupu_boyuk":"'.$b_yasgrupu_boyuk.'","k_qiymet_10_30":"'.$k_qiymet_10_30.'","k_qiymet_30_50":"'.$k_qiymet_30_50.'","k_qiymet_50_70":"'.$k_qiymet_50_70.'","k_qiymet_70_100":"'.$k_qiymet_70_100.'","k_qiymet_100_plus":"'.$k_qiymet_100_plus.'","k_ceki_1_5":"'.$k_ceki_1_5.'","k_ceki_5_10":"'.$k_ceki_5_10.'","k_ceki_10_20":"'.$k_ceki_10_20.'","k_ceki_20_30":"'.$k_ceki_20_30.'","k_ceki_30_plus":"'.$k_ceki_30_plus.'","k_cins_kisi":"'.$k_cins_kisi.'","k_cins_qadin":"'.$k_cins_qadin.'","k_yasgrupu_usaq":"'.$k_yasgrupu_usaq.'","k_yasgrupu_boyuk":"'.$k_yasgrupu_boyuk.'"}]';
					
					$mehsul = fopen("mehsul_sayisi.json","wb");
					fwrite($mehsul,$update_mehsul_sayisi);
					fclose($mehsul);
				}
	    			//top12.json faylini update ederek en son elave edilen 12 mehsulu secirik
	    			$select_top_12 = "SELECT * FROM mehsullar ORDER BY id DESC LIMIT 12";
					$netice_top_12 = mysqli_query($conn,$select_top_12);
					$update_top_12 = "[";
					while($row = mysqli_fetch_assoc($netice_top_12)) {
					    if ($update_top_12 != "[") {
					    	$update_top_12 .= ",";
					    }
					    $update_top_12 .= '{"id":"'.$row['id'].'","basliq":"'.$row['basliq'].'","kateqoriya":"'.$row['kateqoriya'].'","qiymet":"'.$row['qiymet'].'","olcu":"'.$row['olcu'].'","ceki":"'.$row['ceki'].'","cins":"'.$row['cins'].'","yasgrupu":"'.$row['yasgrupu'].'","qas":"'.$row['qas'].'","tmp":"'.$row['tmp'].'","img_alt":"'.$row['img_alt'].'","a_title":"'.$row['a_title'].'"}';
					}
					$update_top_12 .="]";
					$fp = fopen("top12.json","wb");
					fwrite($fp,$update_top_12);
					fclose($fp);

					mysqli_close($conn);
	    			echo "<script>window.location.href='../admin.php';</script>";
	    		}else{
	    			echo "Məlumatlar databazaya yazılmadı!";
	    		}
			}
		}
	}else{
		header('Location: ../../farajov');
	}
?>