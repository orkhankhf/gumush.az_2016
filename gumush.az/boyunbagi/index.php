<?php
	session_start();
	include "../db-bakuweb/db.php";
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="alternate" hreflang="az" href="http://gumush.az/boyunbagi/index.php" />
	<meta http-equiv="content-language" content="az" />
	<meta name="keywords" content="gumus boyunbağılar,gümüş boyunbagilar,gumus sepler,qadin gumusleri,kisi gumusleri,usaq gumusleri,gumus satisi,gumus satisi bakida,boyunbagi,sep,qadın və kişi gümüşləri,online gumus satisi" />
	<meta name="description" content="Qadın və Kişi gümüşlərinin satışı. Bakı şəhəri daxilində çatdırılma pulsuzdur. Qapıda ödəmə." />
	<link rel="author" href="https://plus.google.com/108728687434805525511/posts"/>
	<meta name="abstract" content="Qadın Və Kişi Gümüşlərinin Onlayn Satışı" />
	<meta name="copyright" content="Bakuweb Dizayn Studiyası" />
	<meta name="robots" content="index, follow" />
	<meta property="og:url" content="http://gumush.az/boyunbagi/" />
	<meta property="og:type" content="website" />
	<meta property="og:title" content="Qadın Və Kişi Gümüş Boyunbağılarının Onlayn Satışı" />
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
	<link rel="stylesheet" type="text/css" href="../css/uzukler.css">
	<?php include "../head.php"; ?>
</head>
<body onload="pagination_sayisi()">
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
		    document.title = "Gümüş Boyunbağılar";
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
		<h1 class="seo_h1">Gümüş Seplər Gumus Sepler Gümüş Boyunbağılar Gumus Boyunbagilar Qadın Gümüşləri Qadin Gumusleri Kişi Gümüşləri Kisi Gumusleri Qadın Boyunbağıları Qadin Boyunbagilari Qadın Sepləri Qadin Sepleri Kişi Boyunbağıları Kisi Boyunbagilari Kişi Sepləri Kisi Sepleri</h1>
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
				function alis_verisi_bitir_limit_dolub(){
					$(".sifarish_oldu_bg,.sifarish_limiti_dolub").hide(600);
					setTimeout(function(){
						//basqa sehifelerde istifade edende adresi uygun olaraq deyis
						window.location.href="../sebetim";
					},600);
				}
				//alis verisi bitirmek ucun sebete gedir
				function alish_verisi_bitir(){
					$(".sifarish_oldu_bg,.sifarish_oldu").hide(600);
					setTimeout(function(){
						//basqa sehifelerde istifade edende adresi uygun olaraq deyis
						window.location.href="../sebetim";
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
		<script type="text/javascript">
			$("a[href='../boyunbagi']").css("background-color","#ED5258");
		</script>
			<div class="row main_divs_space">
		<!-- FILTER START -->
					<div class="filter_main col-xs-12 col-sm-3">
						<p class="goster">Göstər</p>
						<script type="text/javascript">
						//mehsullardan nece eded qaldigini gosterir
								var mehsul_eded = [];
								// asagida istifade edeceyim bir deyiskendir
								var mehsul_sayisi_pagination;
								//bu funksiya ise dusur, mehsul_sayisi_pagination adli deyiskenin deyeri teyin olunur ve sonra pagination_sayisi() funksiyasi ise dusur, funksiya asagilarda bir yerdedir.
									$.ajax({
									    type: 'POST',
									    url: '../bakuweb/farajov/mehsul-elave-et/mehsul_sayisi.json',
									    data: {get_param: 'value'},
									    dataType: 'json',
									    success: function (data){
									        mehsul_eded = data;
									        $(".mehsul_eded-uzuk").html("("+mehsul_eded[0].uzuk+")");
									        $(".mehsul_eded-sirga").html("("+mehsul_eded[0].sirga+")");
									        $(".mehsul_eded-qolbaq").html("("+mehsul_eded[0].qolbaq+")");
									        $(".mehsul_eded-boyunbagi").html("("+mehsul_eded[0].boyunbagi+")");
									        $(".mehsul_eded-komplekt").html("("+mehsul_eded[0].komplekt+")");

									        $(".b_qiymet_10_30").html(" ("+mehsul_eded[0].b_qiymet_10_30+")");
									        $(".b_qiymet_30_50").html(" ("+mehsul_eded[0].b_qiymet_30_50+")");
									        $(".b_qiymet_50_70").html(" ("+mehsul_eded[0].b_qiymet_50_70+")");
									        $(".b_qiymet_70_100").html(" ("+mehsul_eded[0].b_qiymet_70_100+")");
									        $(".b_qiymet_100_plus").html(" ("+mehsul_eded[0].b_qiymet_100_plus+")");

									        $(".b_ceki_1_5").html(" ("+mehsul_eded[0].b_ceki_1_5+")");
									        $(".b_ceki_5_10").html(" ("+mehsul_eded[0].b_ceki_5_10+")");
									        $(".b_ceki_10_20").html(" ("+mehsul_eded[0].b_ceki_10_20+")");
									        $(".b_ceki_20_30").html(" ("+mehsul_eded[0].b_ceki_20_30+")");
									        $(".b_ceki_30_plus").html(" ("+mehsul_eded[0].b_ceki_30_plus+")");

									        $(".b_cins_kisi").html(" ("+mehsul_eded[0].b_cins_kisi+")");
									        $(".b_cins_qadin").html(" ("+mehsul_eded[0].b_cins_qadin+")");

									        $(".b_yasgrupu_usaq").html(" ("+mehsul_eded[0].b_yasgrupu_usaq+")");
									        $(".b_yasgrupu_boyuk").html(" ("+mehsul_eded[0].b_yasgrupu_boyuk+")");
									    }
									});
						</script>
						<p class="filter_headers">Kateqoriya<i class="toggle_kateqoriya fa fa-plus-circle" aria-hidden="true"></i></p>
						<div class="filter_divs kateqoriya col-xs-12">
							<a href="../uzuk" title="gumus Uzukler">Üzüklər <span class="mehsul_eded-uzuk"></span></a>
							<a href="../sirga" title="gumus Sirgalar">Sırğalar <span class="mehsul_eded-sirga"></span></a>
							<a href="../qolbaq" title="gumus Qolbaqlar">Qolbaqlar <span class="mehsul_eded-qolbaq"></span></a>
							<a href="." title="gumus Boyunbagilar">Boyunbağılar <span class="mehsul_eded-boyunbagi"></span></a>
							<a href="../komplekt" title="gumus Komplektler">Komplektlər <span class="mehsul_eded-komplekt"></span></a>
						</div>

						<p class="filter_headers">Qiymət<i class="toggle_qiymet fa fa-plus-circle" aria-hidden="true"></i></p>
						<div class="filter_divs qiymet col-xs-12">
							<p class="on-otuz">10 <i class="fa fa-arrows-h" aria-hidden="true"></i> 30 AZN<span class="b_qiymet_10_30"></span></p>
							<p class="otuz-elli">30 <i class="fa fa-arrows-h" aria-hidden="true"></i> 50 AZN<span class="b_qiymet_30_50"></span></p>
							<p class="elli-yetmis">50 <i class="fa fa-arrows-h" aria-hidden="true"></i> 70 AZN<span class="b_qiymet_50_70"></span></p>
							<p class="yetmis-yuz">70 <i class="fa fa-arrows-h" aria-hidden="true"></i> 100 AZN<span class="b_qiymet_70_100"></span></p>
							<p class="yuz-plus"><i class="fa fa-plus" aria-hidden="true"></i> 100 AZN<span class="b_qiymet_100_plus"></span></p>
						</div>

						<p class="filter_headers">Çəki<i class="toggle_ceki fa fa-plus-circle" aria-hidden="true"></i></p>
						<div class="filter_divs ceki col-xs-12">
							<p class="bir-bes">1 <i class="fa fa-arrows-h" aria-hidden="true"></i> 5<span class="b_ceki_1_5"></span></p>
							<p class="bes-on">5 <i class="fa fa-arrows-h" aria-hidden="true"></i> 10<span class="b_ceki_5_10"></span></p>
							<p class="on-iyirmi">10 <i class="fa fa-arrows-h" aria-hidden="true"></i> 20<span class="b_ceki_10_20"></span></p>
							<p class="iyirmi-otuz">20 <i class="fa fa-arrows-h" aria-hidden="true"></i> 30<span class="b_ceki_20_30"></span></p>
							<p class="otuz-plus"><i class="fa fa-plus" aria-hidden="true"></i>  30 <span class="b_ceki_30_plus"></span></p>
						</div>

						<p class="filter_headers">Cins<i class="toggle_cins fa fa-plus-circle" aria-hidden="true"></i></p>
						<div class="filter_divs cins col-xs-12">
							<p class="kisi">Kişilər üçün <span class="b_cins_kisi"></span></p>
							<p class="qadin">Qadınlar üçün <span class="b_cins_qadin"></span></p>
						</div>

						<p class="filter_headers">Yaş grupu<i class="toggle_age_grupu fa fa-plus-circle" aria-hidden="true"></i></p>
						<div class="filter_divs age_grupu col-xs-12">
							<p class="usaq">Uşaqlar üçün <span class="b_yasgrupu_usaq"></span></p>
							<p class="boyuk">Böyüklər üçün <span class="b_yasgrupu_boyuk"></span></p>
						</div>
		<!-- ƏN ÇOX SATILANLAR VƏ ƏN YENİLƏR xsden boyuk ekranlar ucun START -->
						<div class="col-xs-12 filterTop_main_div boyuk_ekran">
							<p class="filterTop">Ən çox satılanlar</p>
							<?php
								if($conn){
									$select_top_sell = "SELECT basliq,qiymet,tmp,a_title,img_alt FROM mehsullar ORDER BY RAND() LIMIT 5";
									$netice_top_sell = mysqli_query($conn,$select_top_sell);
									while($row = mysqli_fetch_assoc($netice_top_sell)){
										echo "<a href='../item/".$row['tmp']."' title='".$row['a_title']."'>
												<div class='col-xs-12 filterTop_imgbox'>
													<div class='col-xs-6 col-sm-12 col-md-6'>
														<img src='../item/".$row['tmp']."/image0.jpg' alt='".$row['img_alt']."'>
													</div>
													<div class='col-xs-6 col-sm-12 col-md-6'>
														<h2>".$row['basliq']."</h2>
														<p>".$row['qiymet']." AZN</p>
													</div>
												</div>
											</a>";
									}
								}
							?>
							<p class="filterTop">Ən Yenİlər</p>
							<?php
								//md ekranlar ucun $top5_class vasitesile a taglarina 0,1,2,... class veririk ve asagida ajax ile top top12.json faylindan gelen melumatlari 
								//a tagina attr,img taginada attr ve h2 ile p taglarina html vasitesile basliq ve qiymeti yaziriq.
								$top5_class = 0;
								for($a=0;$a<5;$a++){
									echo "<a class='top5-".$top5_class."'>
											<div class='col-xs-12 filterTop_imgbox'>
												<div class='col-xs-6 col-sm-12 col-md-6'>
													<img>
												</div>
												<div class='col-xs-6 col-sm-12 col-md-6'>
													<h2></h2>
													<p></p>
												</div>
											</div>
										</a>";
										$top5_class++;
								}
							?>
							<script type="text/javascript">
								var top5 = [];
								$.ajax({
								    type: 'POST',
								    url: '../bakuweb/farajov/mehsul-elave-et/top12.json',
								    data: {get_param: 'value'},
								    dataType: 'json',
								    success: function (data){
								        top5 = data;
								        for(a=0;a<5;a++){
								        	$(".top5-"+a).attr({
								        		href:"../item/"+top5[a].tmp,
								        		title:top5[a].a_title
								        	});
								        	$(".top5-"+a+" div div img").attr({
								        		src:"../item/"+top5[a].tmp+"/image0.jpg",
								        		alt:top5[a].img_alt
								        	});
								        	$(".top5-"+a+" div div h2").html(top5[a].basliq);
								        	$(".top5-"+a+" div div p").html(top5[a].qiymet+" AZN");
								        }
								    }
								});
							</script>
						</div>
		<!-- ƏN ÇOX SATILANLAR VƏ ƏN YENİLƏR xsden boyuk ekranlar ucun FINISH -->
					</div>
		<!-- FILTER FINISH -->




		<!-- SELLLIST START -->
					<div class="sellList uzukler_main col-xs-12 col-sm-9">
						<div class="row uzukler_ajax sell_list_opacity">
							<script type="text/javascript">
								//qiymet
								var on_otuz = "";
								var otuz_elli = "";
								var elli_yetmis = "";
								var yetmis_yuz = "";
								var yuz_plus = "";
								//ceki
								var bir_bes_gram = "";
								var bes_on_gram = "";
								var on_iyirmi_gram = "";
								var iyirmi_otuz_gram = "";
								var otuz_plus = "";
								//cins
								var kisi = "";
								var qadin = "";
								//yas
								var usaq = "";
								var boyuk = "";
								//pagination

								//link duzgun deyilse veya pis meqsedlidirse o zaman 1-ci sehifeye yonlendirir
								function my_correct_url(){
									var noCorrectUrl = window.location.href;
									var noCorrectUrl_last_slash = window.location.href.lastIndexOf("/");
									var full_length_of_url = noCorrectUrl.length;
									var bla = full_length_of_url - noCorrectUrl_last_slash;
									myCorrectUrl = noCorrectUrl.slice(0, -bla);
									window.location.replace(myCorrectUrl);
								}

								var sehife = 1;
								var st = 0;
								var lm = 12;
								var yoxla_sehife_coxdursa = false;

								//eger biri birbasa link ile girerse o zaman linkdeki sehifenin sayisini gotursun
								var myurl = window.location.href.indexOf("sehife=");
								if(myurl != "-1"){
									sehife = window.location.href.slice(myurl + 7);
									if(sehife == 0){
										my_correct_url();
									}
									var reqem_regex=/^[0-9]+$/;
								    if (sehife.match(reqem_regex)){
								        st = sehife * 12 - 12;
										if(sehife > 0){
											yoxla_sehife_coxdursa = true;
										}
								    }else{
								    	sehife = 1;
								    	st = sehife * 12 - 12;
										if(sehife > 0){
											yoxla_sehife_coxdursa = true;
										}
										my_correct_url();
								    }
								}else{
									sehife = 1;
								}
								function sifarish(this_id){
									//gelen deyer mehsul9050 olarsa mehsul sozunu silib 9050 cixart ve sadece mehsulun id adresini al
									var mehsul_id = this_id.slice(6);
									$.ajax({
										type:"POST",
										url:"../sebetim/elave_et.php",
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
					            function ajax(){
					            	$.ajax({
						                type: "POST",
						                url: "boyunbagi_db.php",
						                data: { a: '',b: kisi,c: qadin,d:usaq,e:boyuk,f:bir_bes_gram,g:bes_on_gram,h:on_iyirmi_gram,i:iyirmi_otuz_gram,j:otuz_plus,p:on_otuz,q:otuz_elli,r:elli_yetmis,s:yetmis_yuz,t:yuz_plus,u:st,v:lm},
						                success: function(gelen) {
						                	//istifadeci sol terefdeki filterlerden istifade edende birden cox ozellik secende bele uygun mehsullarin sayisini mueyyen edir
						                	var position_of_dwkfilter = gelen.lastIndexOf("dwkfilter-");
						                	var filterlenmis_mehsul_sayisi = gelen.slice( position_of_dwkfilter + 10 );
						                	//gelen deyerin axirindaki mehsul sayisi olan reqemi silib gelen deyiskeninin deyerini uzukler_ajax divinin icine atiriq
						                	gelen = gelen.slice(0,position_of_dwkfilter);
						                	//cem mehsul sayisini 12 ye boluruk (tam olsa ust reqem hesablanir yeni 3.2 olsa 4 hesablanir)
						                	mehsul_sayisi_pagination = Math.ceil(filterlenmis_mehsul_sayisi / 12);

						                	if(mehsul_sayisi_pagination == 0){
						                		$(".uzukler_ajax").html("<div class='col-xs-12'><p class='netice_tapilmadi alert alert-info' role='alert'>Axtardığınız nəticəyə uyğun məhsul taplılmadı!</p></div>");
						                		mehsul_sayisi_pagination = "neticeTapilmadi";
						                	}else{
						                		$(".uzukler_ajax").html(gelen);
						                	}
						                },
						                error: function(msg) {
						                    alert("Xəta baş verdi!");
						                    my_correct_url();
						                }
						            });
					            }
					            ajax();

					            $(".on-otuz").click(function(){
					            	st = 0;
					            	current_page = 1;
					            	sehife = 1;
					            	if(on_otuz==""){
										on_otuz = "1";
										otuz_elli = "";
										elli_yetmis = "";
										yetmis_yuz = "";
										yuz_plus = "";
										$(".on-otuz").addClass("selected_filter");
										$(".otuz-elli,.elli-yetmis,.yetmis-yuz,.yuz-plus").removeClass("selected_filter");
										ajax();
										setTimeout(function(){
											pagination_sayisi();
										},50);
									}else{
										on_otuz = "";
										$(".on-otuz").removeClass("selected_filter");
										ajax();
										setTimeout(function(){
											pagination_sayisi();
										},50);
									}
					            });
					            $(".otuz-elli").click(function(){
					            	st = 0;
					            	current_page = 1;
					            	sehife = 1;
					            	if(otuz_elli==""){
										on_otuz = "";
										otuz_elli = "1";
										elli_yetmis = "";
										yetmis_yuz = "";
										yuz_plus = "";
										$(".otuz-elli").addClass("selected_filter");
										$(".on-otuz,.elli-yetmis,.yetmis-yuz,.yuz-plus").removeClass("selected_filter");
										ajax();
										setTimeout(function(){
											pagination_sayisi();
										},50);
									}else{
										otuz_elli = "";
										$(".otuz-elli").removeClass("selected_filter");
										ajax();
										setTimeout(function(){
											pagination_sayisi();
										},50);
									}
					            });
					            $(".elli-yetmis").click(function(){
					            	st = 0;
					            	current_page = 1;
					            	sehife = 1;
					            	if(elli_yetmis==""){
										on_otuz = "";
										otuz_elli = "";
										elli_yetmis = "1";
										yetmis_yuz = "";
										yuz_plus = "";
										$(".elli-yetmis").addClass("selected_filter");
										$(".on-otuz,.otuz-elli,.yetmis-yuz,.yuz-plus").removeClass("selected_filter");
										ajax();
										setTimeout(function(){
											pagination_sayisi();
										},50);
									}else{
										elli_yetmis = "";
										$(".elli-yetmis").removeClass("selected_filter");
										ajax();
										setTimeout(function(){
											pagination_sayisi();
										},50);
									}
					            });
					            $(".yetmis-yuz").click(function(){
					            	st = 0;
					            	current_page = 1;
					            	sehife = 1;
					            	if(yetmis_yuz==""){
										on_otuz = "";
										otuz_elli = "";
										elli_yetmis = "";
										yetmis_yuz = "1";
										yuz_plus = "";
										$(".yetmis-yuz").addClass("selected_filter");
										$(".on-otuz,.otuz-elli,.elli-yetmis,.yuz-plus").removeClass("selected_filter");
										ajax();
										setTimeout(function(){
											pagination_sayisi();
										},50);
									}else{
										yetmis_yuz = "";
										$(".yetmis-yuz").removeClass("selected_filter");
										ajax();
										setTimeout(function(){
											pagination_sayisi();
										},50);
									}
					            });
					            $(".yuz-plus").click(function(){
					            	st = 0;
					            	current_page = 1;
					            	sehife = 1;
					            	if(yuz_plus==""){
										on_otuz = "";
										otuz_elli = "";
										elli_yetmis = "";
										yetmis_yuz = "";
										yuz_plus = "1";
										$(".yuz-plus").addClass("selected_filter");
										$(".on-otuz,.otuz-elli,.elli-yetmis,.yetmis-yuz").removeClass("selected_filter");
										ajax();
										setTimeout(function(){
											pagination_sayisi();
										},50);
									}else{
										yuz_plus = "";
										$(".yuz-plus").removeClass("selected_filter");
										ajax();
										setTimeout(function(){
											pagination_sayisi();
										},50);
									}
					            });
					            $(".bir-bes").click(function(){
					            	st = 0;
					            	current_page = 1;
					            	sehife = 1;
					            	if(bir_bes_gram==""){
										bir_bes_gram = "1";
										bes_on_gram = "";
										on_iyirmi_gram = "";
										iyirmi_otuz_gram = "";
										otuz_plus = "";
										$(".bir-bes").addClass("selected_filter");
										$(".bes-on,.on-iyirmi,.iyirmi-otuz,.otuz-plus").removeClass("selected_filter");
										ajax();
										setTimeout(function(){
											pagination_sayisi();
										},50);
									}else{
										bir_bes_gram = "";
										$(".bir-bes").removeClass("selected_filter");
										ajax();
										setTimeout(function(){
											pagination_sayisi();
										},50);
									}
					            });
					            $(".bes-on").click(function(){
					            	st = 0;
					            	current_page = 1;
					            	sehife = 1;
					            	if(bes_on_gram==""){
										bir_bes_gram = "";
										bes_on_gram = "1";
										on_iyirmi_gram = "";
										iyirmi_otuz_gram = "";
										otuz_plus = "";
										$(".bes-on").addClass("selected_filter");
										$(".bir-bes,.on-iyirmi,.iyirmi-otuz,.otuz-plus").removeClass("selected_filter");
										ajax();
										setTimeout(function(){
											pagination_sayisi();
										},50);
									}else{
										bes_on_gram = "";
										$(".bes-on").removeClass("selected_filter");
										ajax();
										setTimeout(function(){
											pagination_sayisi();
										},50);
									}
					            });
					            $(".on-iyirmi").click(function(){
					            	st = 0;
					            	current_page = 1;
					            	sehife = 1;
					            	if(on_iyirmi_gram==""){
										bir_bes_gram = "";
										bes_on_gram = "";
										on_iyirmi_gram = "1";
										iyirmi_otuz_gram = "";
										otuz_plus = "";
										$(".on-iyirmi").addClass("selected_filter");
										$(".bir-bes,.bes-on,.iyirmi-otuz,.otuz-plus").removeClass("selected_filter");
										ajax();
										setTimeout(function(){
											pagination_sayisi();
										},50);
									}else{
										on_iyirmi_gram = "";
										$(".on-iyirmi").removeClass("selected_filter");
										ajax();
										setTimeout(function(){
											pagination_sayisi();
										},50);
									}
					            });
					            $(".iyirmi-otuz").click(function(){
					            	st = 0;
					            	current_page = 1;
					            	sehife = 1;
					            	if(iyirmi_otuz_gram==""){
										bir_bes_gram = "";
										bes_on_gram = "";
										on_iyirmi_gram = "";
										iyirmi_otuz_gram = "1";
										otuz_plus = "";
										$(".iyirmi-otuz").addClass("selected_filter");
										$(".bir-bes,.bes-on,.on-iyirmi,.otuz-plus").removeClass("selected_filter");
										ajax();
										setTimeout(function(){
											pagination_sayisi();
										},50);
									}else{
										iyirmi_otuz_gram = "";
										$(".iyirmi-otuz").removeClass("selected_filter");
										ajax();
										setTimeout(function(){
											pagination_sayisi();
										},50);
									}
					            });
					            $(".otuz-plus").click(function(){
					            	st = 0;
					            	current_page = 1;
					            	sehife = 1;
					            	if(otuz_plus==""){
										bir_bes_gram = "";
										bes_on_gram = "";
										on_iyirmi_gram = "";
										iyirmi_otuz_gram = "";
										otuz_plus = "1";
										$(".otuz-plus").addClass("selected_filter");
										$(".bir-bes,.bes-on,.on-iyirmi,.iyirmi-otuz").removeClass("selected_filter");
										ajax();
										setTimeout(function(){
											pagination_sayisi();
										},50);
									}else{
										otuz_plus = "";
										$(".otuz-plus").removeClass("selected_filter");
										ajax();
										setTimeout(function(){
											pagination_sayisi();
										},50);
									}
					            });
					            $(".kisi").click(function(){
					            	st = 0;
					            	current_page = 1;
					            	sehife = 1;
					            	if(kisi==""){
										kisi = "1";
										qadin = "";
										$(".kisi").addClass("selected_filter");
										$(".qadin").removeClass("selected_filter");
										ajax();
										setTimeout(function(){
											pagination_sayisi();
										},50);
									}else{
										kisi = "";
										$(".kisi").removeClass("selected_filter");
										ajax();
										setTimeout(function(){
											pagination_sayisi();
										},50);
									}
					            });
					            $(".qadin").click(function(){
					            	st = 0;
					            	current_page = 1;
					            	sehife = 1;
					            	if(qadin==""){
										qadin = "1";
										kisi = "";
										$(".qadin").addClass("selected_filter");
										$(".kisi").removeClass("selected_filter");
										ajax();
										setTimeout(function(){
											pagination_sayisi();
										},50);
									}else{
										qadin = "";
										$(".qadin").removeClass("selected_filter");
										ajax();
										setTimeout(function(){
											pagination_sayisi();
										},50);
									}
					            });
					            $(".usaq").click(function(){
					            	st = 0;
					            	current_page = 1;
					            	sehife = 1;
					            	if(usaq==""){
										usaq = "1";
										boyuk = "";
										$(".usaq").addClass("selected_filter");
										$(".boyuk").removeClass("selected_filter");
										ajax();
										setTimeout(function(){
											pagination_sayisi();
										},50);
									}else{
										usaq = "";
										$(".usaq").removeClass("selected_filter");
										ajax();
										setTimeout(function(){
											pagination_sayisi();
										},50);
									}
					            });
					            $(".boyuk").click(function(){
					            	st = 0;
					            	current_page = 1;
					            	sehife = 1;
					            	if(boyuk==""){
										boyuk = "1";
										usaq = "";
										$(".boyuk").addClass("selected_filter");
										$(".usaq").removeClass("selected_filter");
										ajax();
										setTimeout(function(){
											pagination_sayisi();
										},50);
									}else{
										boyuk = "";
										$(".boyuk").removeClass("selected_filter");
										ajax();
										setTimeout(function(){
											pagination_sayisi();
										},50);
									}
					            });

							</script>
						</div>

						<div class="pagination">
							
						</div>

						<script type="text/javascript">
							var current_page = sehife;
							
							function pagination_sayisi(){
								if(sehife > mehsul_sayisi_pagination || sehife == 0){
									my_correct_url();
								}

								//linkden index.php?sehife.... ni silir.
								window.history.pushState("", "", ".");


								//eger sehife sayi 7 den azdirsa o zaman nece sehifedirse o qeder yarat, eger sehife sayi 7 den coxdursa o zaman prev ve next de olmaqla sehifeleri yarat (netice tapilmasa 5 saniye sonra sehifeni yenile eger filterlere klik etse yenileme)
								if(mehsul_sayisi_pagination == "neticeTapilmadi"){
									$(".pagination").html("");
									var netice_yoxdursa_sehifeni_yenile = setTimeout(function(){
										location.reload();
									},5000);
									$(".filter_divs").click(function(){
										clearTimeout(netice_yoxdursa_sehifeni_yenile);
									})
								}else if(mehsul_sayisi_pagination > 7){
									$(".pagination").html('<i onselectstart="return false;" onclick="prev_page()" class="fa fa-arrow-left" aria-hidden="true"></i><p onselectstart="return false;" onclick="pagination(this.id)" id="1" class="pagination_prev_3">1</p><p onselectstart="return false;" onclick="pagination(this.id)" id="2" class="pagination_prev_2">2</p><p onselectstart="return false;" onclick="pagination(this.id)" id="3" class="pagination_prev_1">3</p><p onselectstart="return false;" onclick="pagination(this.id)" id="4" class="active_page">4</p><p onselectstart="return false;" onclick="pagination(this.id)" id="5" class="pagination_next_1">5</p><p onselectstart="return false;" onclick="pagination(this.id)" id="6" class="pagination_next_2">6</p><p onselectstart="return false;" onclick="pagination(this.id)" id="7" class="pagination_next_3">7</p><i onselectstart="return false;" onclick="next_page()" class="fa fa-arrow-right" aria-hidden="true"></i>');
								}else if(mehsul_sayisi_pagination == 7){
									$(".pagination").html('<p onselectstart="return false;" onclick="yeddiden_Az_sehife_ucun(this.id)" id="1" class="pagination_prev_3">1</p><p onselectstart="return false;" onclick="yeddiden_Az_sehife_ucun(this.id)" id="2" class="pagination_prev_2">2</p><p onselectstart="return false;" onclick="yeddiden_Az_sehife_ucun(this.id)" id="3" class="pagination_prev_1">3</p><p onselectstart="return false;" onclick="yeddiden_Az_sehife_ucun(this.id)" id="4" class="active_page">4</p><p onselectstart="return false;" onclick="yeddiden_Az_sehife_ucun(this.id)" id="5" class="pagination_next_1">5</p><p onselectstart="return false;" onclick="yeddiden_Az_sehife_ucun(this.id)" id="6" class="pagination_next_2">6</p><p onselectstart="return false;" onclick="yeddiden_Az_sehife_ucun(this.id)" id="7" class="pagination_next_3">7</p>')
								}
								else if(mehsul_sayisi_pagination == 6){
									$(".pagination").html('<p onselectstart="return false;" onclick="yeddiden_Az_sehife_ucun(this.id)" id="1" class="pagination_prev_3">1</p><p onselectstart="return false;" onclick="yeddiden_Az_sehife_ucun(this.id)" id="2" class="pagination_prev_2">2</p><p onselectstart="return false;" onclick="yeddiden_Az_sehife_ucun(this.id)" id="3" class="pagination_prev_1">3</p><p onselectstart="return false;" onclick="yeddiden_Az_sehife_ucun(this.id)" id="4" class="active_page">4</p><p onselectstart="return false;" onclick="yeddiden_Az_sehife_ucun(this.id)" id="5" class="pagination_next_1">5</p><p onselectstart="return false;" onclick="yeddiden_Az_sehife_ucun(this.id)" id="6" class="pagination_next_2">6</p>')
								}else if(mehsul_sayisi_pagination == 5){
									$(".pagination").html('<p onselectstart="return false;" onclick="yeddiden_Az_sehife_ucun(this.id)" id="1" class="pagination_prev_3">1</p><p onselectstart="return false;" onclick="yeddiden_Az_sehife_ucun(this.id)" id="2" class="pagination_prev_2">2</p><p onselectstart="return false;" onclick="yeddiden_Az_sehife_ucun(this.id)" id="3" class="pagination_prev_1">3</p><p onselectstart="return false;" onclick="yeddiden_Az_sehife_ucun(this.id)" id="4" class="active_page">4</p><p onselectstart="return false;" onclick="yeddiden_Az_sehife_ucun(this.id)" id="5" class="pagination_next_1">5</p>');
								}else if(mehsul_sayisi_pagination == 4){
									$(".pagination").html('<p onselectstart="return false;" onclick="yeddiden_Az_sehife_ucun(this.id)" id="1" class="pagination_prev_3">1</p><p onselectstart="return false;" onclick="yeddiden_Az_sehife_ucun(this.id)" id="2" class="pagination_prev_2">2</p><p onselectstart="return false;" onclick="yeddiden_Az_sehife_ucun(this.id)" id="3" class="pagination_prev_1">3</p><p onselectstart="return false;" onclick="yeddiden_Az_sehife_ucun(this.id)" id="4" class="active_page">4</p>');
								}else if(mehsul_sayisi_pagination == 3){
									$(".pagination").html('<p onselectstart="return false;" onclick="yeddiden_Az_sehife_ucun(this.id)" id="1" class="pagination_prev_3">1</p><p onselectstart="return false;" onclick="yeddiden_Az_sehife_ucun(this.id)" id="2" class="pagination_prev_2">2</p><p onselectstart="return false;" onclick="yeddiden_Az_sehife_ucun(this.id)" id="3" class="pagination_prev_1">3</p>');
								}else if(mehsul_sayisi_pagination == 2){
									$(".pagination").html('<p onselectstart="return false;" onclick="yeddiden_Az_sehife_ucun(this.id)" id="1" class="pagination_prev_3">1</p><p onselectstart="return false;" onclick="yeddiden_Az_sehife_ucun(this.id)" id="2" class="pagination_prev_2">2</p>');
								}else if(mehsul_sayisi_pagination == 1){
									$(".pagination").html('<p onselectstart="return false;" onclick="yeddiden_Az_sehife_ucun(this.id)" id="1" class="pagination_prev_3">1</p>');
								}
								$("#"+sehife).css({
									background:"white",
									color:"#ED5258",
									border:"1px solid #ED5258"
								});
								$("#"+sehife).siblings().css({
									background:"#ED5258",
									border:"0",
									color:"white"
								});
								if(yoxla_sehife_coxdursa == true){
									if(mehsul_sayisi_pagination > 7){
										return pagination(sehife);
									}else{
										return yeddiden_Az_sehife_ucun(sehife);
									}
								}
							}
							function prev_page(){
								if(current_page > 1){
									current_page--;
									return pagination(current_page);
								}
							}
							function next_page(){
								if(current_page < mehsul_sayisi_pagination){
									current_page++;
									return pagination(current_page);
								}
							}
							function yeddiden_Az_sehife_ucun(bu){
								current_page = bu;
								if(st == 0){
									st + 1;
								}
								st = current_page * 12 - 12;
								$("#"+current_page).css({
								background:"white",
								color:"#ED5258",
								border:"1px solid #ED5258"
								});
								$("#"+current_page).siblings().css({
									background:"#ED5258",
									border:"0",
									color:"white"
								});
								ajax();
							}
							function pagination(bu){
								$(".sell_list_opacity").fadeTo(600,0.01);
								setTimeout(function(){
									$(".sell_list_opacity").fadeTo(450,1);
								},800);
								setTimeout(function(){
									current_page = bu;
									if(st == 0){
										st + 1;
									}
									st = current_page * 12 - 12;
									if(current_page == 3){
										$(".pagination_prev_3").text(current_page - 2);
										$(".pagination_prev_3").attr("id",current_page - 2);

										$(".pagination_prev_2").text(current_page - 1);
										$(".pagination_prev_2").attr("id",current_page - 1);

										$(".pagination_prev_1").text(current_page);
										$(".pagination_prev_1").attr("id",current_page);

										$(".active_page").text(parseInt(current_page)+1);
										$(".active_page").attr("id",parseInt(current_page)+1);

										$(".pagination_next_1").text(parseInt(current_page)+2);
										$(".pagination_next_1").attr("id",parseInt(bu)+2);
										
										$(".pagination_next_2").text(parseInt(current_page)+3);
										$(".pagination_next_2").attr("id",parseInt(current_page)+3);

										$(".pagination_next_3").text(parseInt(current_page)+4);
										$(".pagination_next_3").attr("id",parseInt(current_page)+4);

										$("#"+current_page).css({
										background:"white",
										color:"#ED5258",
										border:"1px solid #ED5258"
										});
										$("#"+current_page).siblings().css({
											background:"#ED5258",
											border:"0",
											color:"white"
										});
									}else if(current_page == 2){
										$(".pagination_prev_3").text(current_page - 1);
										$(".pagination_prev_3").attr("id",current_page - 1);

										$(".pagination_prev_2").text(current_page);
										$(".pagination_prev_2").attr("id",current_page);

										$(".pagination_prev_1").text(parseInt(current_page)+1);
										$(".pagination_prev_1").attr("id",parseInt(current_page)+1);

										$(".active_page").text(parseInt(current_page)+2);
										$(".active_page").attr("id",parseInt(current_page)+2);

										$(".pagination_next_1").text(parseInt(current_page)+3);
										$(".pagination_next_1").attr("id",parseInt(current_page)+3);
										
										$(".pagination_next_2").text(parseInt(current_page)+4);
										$(".pagination_next_2").attr("id",parseInt(current_page)+4);

										$(".pagination_next_3").text(parseInt(current_page)+5);
										$(".pagination_next_3").attr("id",parseInt(current_page)+5);

										$("#"+current_page).css({
										background:"white",
										color:"#ED5258",
										border:"1px solid #ED5258"
										});
										$("#"+current_page).siblings().css({
											background:"#ED5258",
											border:"0",
											color:"white"
										});
									}else if(current_page == 1){
										$(".pagination_prev_3").text(current_page);
										$(".pagination_prev_3").attr("id",current_page);

										$(".pagination_prev_2").text(parseInt(current_page)+1);
										$(".pagination_prev_2").attr("id",parseInt(current_page)+1);

										$(".pagination_prev_1").text(parseInt(current_page)+2);
										$(".pagination_prev_1").attr("id",parseInt(current_page)+2);

										$(".active_page").text(parseInt(current_page)+3);
										$(".active_page").attr("id",parseInt(current_page)+3);

										$(".pagination_next_1").text(parseInt(current_page)+4);
										$(".pagination_next_1").attr("id",parseInt(current_page)+4);
										
										$(".pagination_next_2").text(parseInt(current_page)+5);
										$(".pagination_next_2").attr("id",parseInt(current_page)+5);

										$(".pagination_next_3").text(parseInt(current_page)+6);
										$(".pagination_next_3").attr("id",parseInt(current_page)+6);

										$("#"+current_page).css({
										background:"white",
										color:"#ED5258",
										border:"1px solid #ED5258"
										});
										$("#"+current_page).siblings().css({
											background:"#ED5258",
											border:"0",
											color:"white"
										});
									}else if(current_page == mehsul_sayisi_pagination-3){
										$(".pagination_prev_3").text(current_page - 3);
										$(".pagination_prev_3").attr("id",current_page - 3);

										$(".pagination_prev_2").text(current_page - 2);
										$(".pagination_prev_2").attr("id",current_page - 2);

										$(".pagination_prev_1").text(current_page - 1);
										$(".pagination_prev_1").attr("id",current_page - 1);

										$(".active_page").text(current_page);
										$(".active_page").attr("id",current_page);

										$(".pagination_next_1").text(parseInt(current_page)+1);
										$(".pagination_next_1").attr("id",parseInt(current_page)+1);
										
										$(".pagination_next_2").text(parseInt(current_page)+2);
										$(".pagination_next_2").attr("id",parseInt(current_page)+2);

										$(".pagination_next_3").text(parseInt(current_page)+3);
										$(".pagination_next_3").attr("id",parseInt(current_page)+3);

										$("#"+current_page).css({
										background:"white",
										color:"#ED5258",
										border:"1px solid #ED5258"
										});
										$("#"+current_page).siblings().css({
											background:"#ED5258",
											border:"0",
											color:"white"
										});
									}else if(current_page == mehsul_sayisi_pagination-2){
										$(".pagination_prev_3").text(current_page - 4);
										$(".pagination_prev_3").attr("id",current_page - 4);

										$(".pagination_prev_2").text(current_page - 3);
										$(".pagination_prev_2").attr("id",current_page - 3);

										$(".pagination_prev_1").text(current_page - 2);
										$(".pagination_prev_1").attr("id",current_page - 2);

										$(".active_page").text(current_page - 1);
										$(".active_page").attr("id",current_page - 1);

										$(".pagination_next_1").text(current_page);
										$(".pagination_next_1").attr("id",current_page);
										
										$(".pagination_next_2").text(parseInt(current_page)+1);
										$(".pagination_next_2").attr("id",parseInt(current_page)+1);

										$(".pagination_next_3").text(parseInt(current_page)+2);
										$(".pagination_next_3").attr("id",parseInt(current_page)+2);

										$("#"+current_page).css({
										background:"white",
										color:"#ED5258",
										border:"1px solid #ED5258"
										});
										$("#"+current_page).siblings().css({
											background:"#ED5258",
											border:"0",
											color:"white"
										});
									}else if(current_page == mehsul_sayisi_pagination-1){
										$(".pagination_prev_3").text(current_page - 5);
										$(".pagination_prev_3").attr("id",current_page - 5);

										$(".pagination_prev_2").text(current_page - 4);
										$(".pagination_prev_2").attr("id",current_page - 4);

										$(".pagination_prev_1").text(current_page - 3);
										$(".pagination_prev_1").attr("id",current_page - 3);

										$(".active_page").text(current_page - 2);
										$(".active_page").attr("id",current_page - 2);

										$(".pagination_next_1").text(current_page - 1);
										$(".pagination_next_1").attr("id",current_page - 1);
										
										$(".pagination_next_2").text(current_page);
										$(".pagination_next_2").attr("id",current_page);

										$(".pagination_next_3").text(parseInt(current_page)+1);
										$(".pagination_next_3").attr("id",parseInt(current_page)+1);

										$("#"+current_page).css({
										background:"white",
										color:"#ED5258",
										border:"1px solid #ED5258"
										});
										$("#"+current_page).siblings().css({
											background:"#ED5258",
											border:"0",
											color:"white"
										});
									}else if(current_page == mehsul_sayisi_pagination){
										$(".pagination_prev_3").text(current_page - 6);
										$(".pagination_prev_3").attr("id",current_page - 6);

										$(".pagination_prev_2").text(current_page - 5);
										$(".pagination_prev_2").attr("id",current_page - 5);

										$(".pagination_prev_1").text(current_page - 4);
										$(".pagination_prev_1").attr("id",current_page - 4);

										$(".active_page").text(current_page - 3);
										$(".active_page").attr("id",current_page - 3);

										$(".pagination_next_1").text(current_page - 2);
										$(".pagination_next_1").attr("id",current_page - 2);
										
										$(".pagination_next_2").text(current_page - 1);
										$(".pagination_next_2").attr("id",current_page - 1);

										$(".pagination_next_3").text(current_page);
										$(".pagination_next_3").attr("id",current_page);

										$("#"+current_page).css({
										background:"white",
										color:"#ED5258",
										border:"1px solid #ED5258"
										});
										$("#"+current_page).siblings().css({
											background:"#ED5258",
											border:"0",
											color:"white"
										});
									}else{
										$(".active_page").css({
										background:"white",
										color:"#ED5258",
										border:"1px solid #ED5258"
										});
										$(".active_page").siblings().css({
											background:"#ED5258",
											border:"0",
											color:"white"
										});
										$(".active_page").text(current_page);
										$(".active_page").attr("id",current_page);

										$(".pagination_prev_3").text(current_page - 3);
										$(".pagination_prev_3").attr("id",current_page - 3);

										$(".pagination_prev_2").text(current_page - 2);
										$(".pagination_prev_2").attr("id",current_page - 2);

										$(".pagination_prev_1").text(current_page - 1);
										$(".pagination_prev_1").attr("id",current_page - 1);

										$(".pagination_next_1").text(parseInt(current_page)+1);
										$(".pagination_next_1").attr("id",parseInt(current_page)+1);
										
										$(".pagination_next_2").text(parseInt(current_page)+2);
										$(".pagination_next_2").attr("id",parseInt(current_page)+2);

										$(".pagination_next_3").text(parseInt(current_page)+3);
										$(".pagination_next_3").attr("id",parseInt(current_page)+3);
									}
									ajax();
								},800);
							}
						</script>

					</div>
			</div>
			<script type="text/javascript">
				$(".toggle_kateqoriya").click(function(){
					$(this).toggleClass("fa-minus-circle");
					$(".kateqoriya").slideToggle(600);/*menu 5 denedirse 600(+1), 3 denedirse 400, 2 denedirse 300 yaz*/
				})
				$(".toggle_qiymet").click(function(){
					$(this).toggleClass("fa-minus-circle");
					$(".qiymet").slideToggle(600);/*menu 5 denedirse 600(+1), 3 denedirse 400, 2 denedirse 300 yaz*/
				})
				$(".toggle_ceki").click(function(){
					$(this).toggleClass("fa-minus-circle");
					$(".ceki").slideToggle(600);/*menu 5 denedirse 600(+1), 3 denedirse 400, 2 denedirse 300 yaz*/
				})
				$(".toggle_cins").click(function(){
					$(this).toggleClass("fa-minus-circle");
					$(".cins").slideToggle(400);/*menu 5 denedirse 600(+1), 3 denedirse 400, 2 denedirse 300 yaz*/
				})
				$(".toggle_age_grupu").click(function(){
					$(this).toggleClass("fa-minus-circle");
					$(".age_grupu").slideToggle(400);/*menu 5 denedirse 600(+1), 3 denedirse 400, 2 denedirse 300 yaz*/
				})
			</script>
		<!-- SELLLIST FINISH -->

		<!-- ƏN ÇOX SATILANLAR VƏ ƏN YENİLƏR xsden kisik ekranlar ucun START -->
			<div class="col-xs-12 filterTop_main_div kicik_ekran">
				<p class="filterTop">Ən çox satılanlar</p>
				<?php
					if($conn){
						$select_top_sell = "SELECT basliq,qiymet,tmp,a_title,img_alt FROM mehsullar ORDER BY RAND() LIMIT 9";
						$netice_top_sell = mysqli_query($conn,$select_top_sell);
						while($row = mysqli_fetch_assoc($netice_top_sell)){
						echo "<a href='../item/".$row['tmp']."' class='col-xs-4 XS_anchor' title='".$row['a_title']."'>
								<div class='col-xs-12 filterTop_imgbox'>
									<div class='col-xs-12 col-sm-12 col-md-6 en_cox_satilanlar_xs_image_div'>
										<img src='../item/".$row['tmp']."/image0.jpg' alt='".$row['img_alt']."'>
									</div>
									<div class='col-xs-12 col-sm-12 col-md-6'>
										<h2>".$row['basliq']."</h2>
										<p>".$row['qiymet']." AZN</p>
									</div>
								</div>
							</a>";
						}
					}
					mysqli_close($conn);
				?>
				<p class="filterTop">Ən Yenİlər</p>
					<?php
						//xs ekranlar ucun $top9_class vasitesile a taglarina 0,1,2,... class veririk ve asagida ajax ile top top12.json faylindan gelen melumatlari 
						//a tagina attr,img taginada attr ve h2 ile p taglarina html vasitesile basliq ve qiymeti yaziriq.
						$top9_class = 0;
						for($a=0;$a<9;$a++){
							echo "<a class='col-xs-4 XS_anchor top9-".$top9_class."'>
									<div class='col-xs-12 filterTop_imgbox'>
										<div class='col-xs-12 col-sm-12 col-md-6 en_yeniler_xs_image_div'>
											<img>
										</div>
										<div class='col-xs-12 col-sm-12 col-md-6'>
											<h2></h2>
											<p></p>
										</div>
									</div>
								</a>";
								$top9_class++;
						}
					?>
					<script type="text/javascript">
						var top9 = [];
						$.ajax({
						    type: 'POST',
						    url: '../bakuweb/farajov/mehsul-elave-et/top12.json',
						    data: {get_param: 'value'},
						    dataType: 'json',
						    success: function (data){
						        top9 = data;
						        for(a=0;a<9;a++){
						        	$(".top9-"+a).attr({
						        		href:"../item/"+top9[a].tmp,
						        		title:top9[a].a_title
						        	});
						        	$(".top9-"+a+" div div img").attr({
						        		src:"../item/"+top9[a].tmp+"/image0.jpg",
						        		alt:top9[a].img_alt
						        	});
						        	$(".top9-"+a+" div div h2").html(top9[a].basliq);
						        	$(".top9-"+a+" div div p").html(top9[a].qiymet+" AZN");
						        }
						    }
						});
					</script>
			</div>
		<!-- ƏN ÇOX SATILANLAR VƏ ƏN YENİLƏR xsden kicik ekranlar ucun FINISH -->

		<?php include "../contactUs_information_footer.php"; ?>
	</div>
</body>
</html>
