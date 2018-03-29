<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="alternate" hreflang="az" href="http://gumush.az/password_recovery/npw.php" />
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
		    document.title = "Şifrəni Dəyiş";
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
		<div class="alert alert-success sifre_deyisdirildi">
			<a onclick="sifre_yenilendi_bagla()" class="close">&times;</a>
			<strong>Şifrəniz müvəffəqiyyətlə dəyişdirildi!</strong>
			<p>Xahiş edirik yeni şifrənizlə hesabınıza daxil olun.</p>
		</div>
		<script type="text/javascript">
			function sifre_yenilendi_bagla(){
				$(".sifre_deyisdirildi").fadeOut(400);
				setTimeout(function(){
					location.href = "../";
				},400);
			}
		</script>
		<?php include "../header_nav.php"; ?>
		
		<!-- SIFRENI DEYIS START -->
			<?php
				//eger user hesabina daxil olub ve bu linke gelibse ana sehifeye yonlendir
				if(!isset($_SESSION['user_id'])){
					echo "<style type='text/css'>.header_top_right{display: none;}</style>";
					//eger linkde f85v4d6d7e8fd521c4d5s96we5d21s deyisgeni varsa ve bos deyilse
					if(isset($_GET['f85v4d6d7e8fd521c4d5s96we5d21s']) && !empty($_GET['f85v4d6d7e8fd521c4d5s96we5d21s'])){
						//linkdeki deyeri deyisgene veririk
						$link = $_GET['f85v4d6d7e8fd521c4d5s96we5d21s'];
						//deyisgeni filter edirik
						if(!filter_var($link, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW) === false && !filter_var($link, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH) === false){
							$email = "";
							//linkden lazim olan reqem ve herfleri alib email deyisgenine beraber edirik databazadaki ile qarsilasdirmaq ucun
							for($a=4; $a<160; $a+=5){
								$email .= $link[$a];
							}
							//alinan herf ve reqemler 32 ededdirse
							if(strlen($email) == 32){
								include "../db-bakuweb/db.php";
								if($conn){
									//emailin databazada olub olmamagini mueyyen edeceyik asagida
									$mail_movcud_deyil = true;
									//bele bir emailin movcudlugunu yoxlayiriq
									$select = "SELECT email FROM userler_bw WHERE email='$email'";
									$netice = mysqli_query($conn,$select);
									while($setir = mysqli_fetch_assoc($netice)){
										//eger email movcuddursa yuxaridaki deyisgeni false edir
										$mail_movcud_deyil = false;
									}
									//eger deyisgen true'dirse yeni bele email movcud deyilse databazada
									if($mail_movcud_deyil == true){
										echo "E-mail adresi yalnışdır.";
									}
									mysqli_close($conn);
								}
							}else{
								echo "Link yalnışdır.Xahiş edirik bunu bizə bildirin.";
							}
						}else{
							echo "Link yalnışdır.Xahiş edirik bunu bizə bildirin.";
						}
					}else{
						echo "Link yalnışdır.Xahiş edirik bunu bizə bildirin.";
					}
				}else{
					echo "<script>location.href = '../';</script>";
				}
			?>
			<div class="row main_divs_space sebetim_main">
				<div class="col-xs-6 col-xs-push-3 col-md-4 col-md-push-4 col-lg-4 col-lg-push-4">
					<?php
						//eger mail databazada movcuddursa, deyisgenin deyeri false olubsa yuxarida o zaman inputlari cixarir
						if(isset($mail_movcud_deyil) && $mail_movcud_deyil == false){
							echo "<div class='form-group'>
										<label for='sifre1'>Yeni Şifrə:</label>
										<input onfocus='hide_validate_spans()' type='password' class='form-control' id='sifre1'>
										<div class='alert alert-danger validate_spans sifre_span'>
											<span></span>
										</div>
									</div>
									<div class='form-group'>
										<label for='sifre2'>Şifrə təsdiq:</label>
										<input onfocus='hide_validate_spans()' type='password' class='form-control' id='sifre2'>
										<div class='alert alert-danger validate_spans sifre_tekrar_span'>
											<span></span>
										</div>
									</div>
									<div class='form-group'>
										<button onclick='sifreni_yenile()' id='signup' class='btn btn-success'>Tamamla</button>
									</div>";
						}
					?>
					<script type="text/javascript">
						$(".form-control").keydown(function(knopka){
							if(knopka.keyCode == 13){
								sifreni_yenile();
							}
						});
						function sifreni_yenile(){
							hide_validate_spans();
							var email = "<?php echo $email; ?>";
							var parol = $('#sifre1').val();
							var parol_tekrar = $("#sifre2").val();
							if(parol == ""){
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
							}else{
								$.ajax({
									url:"unp.php",
									type:"POST",
									data:{a:parol,b:email},
									success:function(gelen){
										if(gelen == "deyisdi"){
											$(".sifre_deyisdirildi").fadeIn(600);
											$("#sifre1,#sifre2").val("");
										}
									},
									error:function(){

									}
								});
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
						function hide_validate_spans(){
							$(".validate_spans").fadeOut(400);
						}
					</script>
				</div>
			</div>
		<!-- SIFRENI DEYIS FINISH -->
		<?php include "../contactUs_information_footer.php"; ?>
	</div>
</body>
</html>