<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="alternate" hreflang="az" href="http://gumush.az/contact/index.php" />
	<meta http-equiv="content-language" content="az" />
	<meta name="keywords" content="gumush.az elaqe,gumuslerin satisi,gumuslerin sifarisi,bizimle elaqe" />
	<meta name="description" content="Bizimlə Əlaqə." />
	<link rel="author" href="https://plus.google.com/108728687434805525511/posts"/>
	<meta name="abstract" content="Qadın Və Kişi Gümüşlərinin Onlayn Satışı" />
	<meta name="copyright" content="Bakuweb Dizayn Studiyası" />
	<meta name="robots" content="index, follow" />
	<meta property="og:url" content="http://gumush.az/contact/" />
	<meta property="og:type" content="website" />
	<meta property="og:title" content="GUMUSH.AZ Əlaqə" />
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
	<link rel="stylesheet" type="text/css" href="../css/contact.css">
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
		    document.title = "Əlaqə";
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
		<h1 class="seo_h1">Gumush.az Əlaqə Gumush.az Elaqe Gümüş Üzüklər Gumus Uzukler Kişi Gümüşləri Kisi Gumusleri Qadın Gümüşləri Qadin Gumusleri</h1>
		<div class="alert alert-success muraciet_gonderildi">
			<a onclick="muraciet_gonderildi_alert_bagla()" class="close">&times;</a>
			<strong>Müraciətiniz qeydə alındı!</strong>
			<p>Sizin müraciətiniz bizim üçün çox önəmlidir! Ən qısa zamanda qeyd etdiyiniz mail adresi və ya mobil nömrəniz vasitəsilə əlaqə saxlayacayıq.</p>
		</div>
		<div class="alert alert-danger muraciet_gonderilmedi">
			<a onclick="muraciet_gonderilmedi_alert_bagla()" class="close">&times;</a>
			<strong>Xəta baş verdi!</strong>
			<p>Xahiş edirik bunu bizə bildirin, bizimlə 055 581 08 72 nömrəsindən əlaqə saxlaya bilərsiniz.</p>
		</div>
		<script type="text/javascript">
			$("a[href='../contact']").css({
				backgroundColor:'#ED5258',
				color:'white'
			})
			function muraciet_gonderildi_alert_bagla(){
				$(".muraciet_gonderildi").fadeOut(400);
			}
			function muraciet_gonderilmedi_alert_bagla(){
				$(".muraciet_gonderilmedi").fadeOut(400);
			}
		</script>
			<div class="row main_divs_space">
				<div class="contact_main col-xs-12">
					<div class="col-xs-12 contact_h2_div">
						<p class="col-xs-3">Bİzİmlə Əlaqə</p>
					</div>
					<div class="col-xs-12 col-md-3 input-group">
						<label>Ad<br>
							<input onfocus="hide_validate_spans()" id="elaqe_ad" type="text" placeholder="adınız" class="form-control" />
						</label>
						<div class="col-xs-12 alert alert-danger validate_spans elaqe_ad_span">
							<span></span>
						</div>
						<label>Soyad<br>
							<input onfocus="hide_validate_spans()" id="elaqe_soyad" type="text" placeholder="soyadınız" class="form-control" />
						</label>
						<div class="col-xs-12 alert alert-danger validate_spans elaqe_soyad_span">
							<span></span>
						</div>
						<label>E-mail<br>
							<input onfocus="hide_validate_spans()" id="elaqe_email" type="email" placeholder="e-mail adresiniz" class="form-control" />
						</label>
						<div class="col-xs-12 alert alert-danger validate_spans elaqe_email_span">
							<span></span>
						</div>
						<label>Telefon<br>
							<input onfocus="hide_validate_spans()" id="elaqe_telefon" type="number" placeholder="nömrəniz" class="form-control" />
						</label>
						<div class="col-xs-12 alert alert-danger validate_spans elaqe_telefon_span">
							<span></span>
						</div>
						<br>
					</div>
					<div class="col-xs-12 col-md-9">
						<label>Müraciət<textarea onfocus="hide_validate_spans()" id="muraciet" placeholder="müraciətiniz"></textarea></label>
						<div class="alert alert-danger validate_spans elaqe_muraciet_span">
							<span></span>
						</div>
					</div>
					<div class="col-xs-12 elaqe_form_btn_div">
						<button class="btn btn-success" onclick="elaqe_form_validation()">Göndər</button>
					</div>
					<script type="text/javascript">
						function elaqe_form_validation(){
							hide_validate_spans();

							var ad = $("#elaqe_ad").val();
							var soyad = $("#elaqe_soyad").val();
							var email = $('#elaqe_email').val();
							var tel = $("#elaqe_telefon").val();
							var muraciet = $("#muraciet").val();
							if(ad == ""){
								$(".elaqe_ad_span").fadeIn(200);
								$(".elaqe_ad_span span").text("Adınızı daxil edin!");
							}else if(ad.length < 2){
								$(".elaqe_ad_span").fadeIn(200);
								$(".elaqe_ad_span span").text("Ad çox qısadır (min. 2)!");
							}else if(ad.length > 12){
								$(".elaqe_ad_span").fadeIn(200);
								$(".elaqe_ad_span span").text("Ad çox uzundur (max. 12)!");
							}else if(NameIsLetter(ad) == false){
								$(".elaqe_ad_span").fadeIn(200);
								$(".elaqe_ad_span span").text("Ad yalnız hərflərdən ibarət olmalıdır!");
							}else if(soyad == ""){
								$(".elaqe_soyad_span").fadeIn(200);
								$(".elaqe_soyad_span span").text("Soyadınızı daxil edin!");
							}else if(soyad.length < 3){
								$(".elaqe_soyad_span").fadeIn(200);
								$(".elaqe_soyad_span span").text("Soyad çox qısadır (min. 3)!");
							}else if(soyad.length > 15){
								$(".elaqe_soyad_span").fadeIn(200);
								$(".elaqe_soyad_span span").text("Soyad çox uzundur (max. 15)!");
							}else if(SurNameIsLetter(soyad) == false){
								$(".elaqe_soyad_span").fadeIn(200);
								$(".elaqe_soyad_span span").text("Soyad yalnız hərflərdən ibarət olmalıdır!");
							}else if(email == ""){
								$(".elaqe_email_span").fadeIn(200);
								$(".elaqe_email_span span").text("E-mail adresinizi daxil edin!");
							}else if(IsEmail(email) == false){
								$(".elaqe_email_span").fadeIn(200);
								$(".elaqe_email_span span").text("E-mail adresinizi düzgün yazın!");
							}else if(email.length < 8){
								$(".elaqe_email_span").fadeIn(200);
								$(".elaqe_email_span span").text("E-mail adresi çox qısadır (min. 8)!");
							}else if(email.length > 30){
								$(".elaqe_email_span").fadeIn(200);
								$(".elaqe_email_span span").text("E-mail adresi çox uzundur (max. 30)!");
							}else if(tel == ""){
								$(".elaqe_telefon_span").fadeIn(200);
								$(".elaqe_telefon_span span").text("Telefon nömrənizi daxil edin!")
							}else if(tel.length < 10){
								$(".elaqe_telefon_span").fadeIn(200);
								$(".elaqe_telefon_span span").text("Nömrə çox qısadır (min. 10)!");
							}else if(tel.length > 10){
								$(".elaqe_telefon_span").fadeIn(200);
								$(".elaqe_telefon_span span").text("Nömrə çox uzundur (max. 10)!");
							}else if(muraciet.length < 50){
								$(".elaqe_muraciet_span").fadeIn(200);
								$(".elaqe_muraciet_span span").text("Müraciətinizin məzmunu çox qısadır (min. 50)!");
							}else if(muraciet.length > 2000){
								$(".elaqe_muraciet_span").fadeIn(200);
								$(".elaqe_muraciet_span span").text("Müraciətinizin məzmunu çox uzundur (max. 2000)!");
							}else{
								$.ajax({
									url:"elaqe_email.php",
									type:"POST",
									data:{
										a:ad,b:soyad,c:email,d:tel,e:muraciet
									},
									success:function(gelen){
										if(gelen == "email_gonderildi"){
											$(".muraciet_gonderildi").fadeIn(600);
											$(".validate_spans").fadeOut(400);
											$(".contact_main input,.contact_main textarea").val("");
										}else if(gelen == "xeta"){
											$(".muraciet_gonderilmedi").fadeIn(600);
										}
									},
									error:function(){
										$(".muraciet_gonderilmedi").fadeIn(600);
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
						function hide_validate_spans(){
							$(".validate_spans").fadeOut(400);
						}
						$(".contact_main input").keypress(function(knopka){
							if(knopka.which == 13 && $(".regBackground").css('display') == "none"){
								elaqe_form_validation();
							}
						});
					</script>
				</div>
			</div>




		<?php include "../contactUs_information_footer.php"; ?>
	</div>
</body>
</html>
