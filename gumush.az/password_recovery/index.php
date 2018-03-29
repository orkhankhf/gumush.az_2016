<?php
	//eger a varsa ve bos deyilse
	if(isset($_POST['a']) && !empty($_POST['a'])){

		//filter olunmamis deyiskeni a'ya berabet et
		$un_filtered_email = $_POST['a'];

		//filter olunmamis deyiskeni filter et.
		$un_filtered_email = trim($un_filtered_email);
		$un_filtered_email = htmlspecialchars($un_filtered_email);
		$un_filtered_email = filter_var($un_filtered_email, FILTER_SANITIZE_EMAIL);


		if(!filter_var($un_filtered_email,FILTER_VALIDATE_EMAIL) === false){
			//mail(-) funksiyasinda istifade edilecek adresi al
			$to_email = $un_filtered_email;

			//eger email duzgundurse, un_filtered_email deyiskenini md5 e cevir email deyiskenine beraber et
			$email = md5($un_filtered_email);
			$email = filter_var($email, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);

			if(!filter_var($email, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH) === false){
				include "../db-bakuweb/db.php";
				if($conn){
					//eger email movcuddursa asagida deyer false olur
					$email_movcud_deyil = true;

					$select = "SELECT email FROM userler_bw WHERE email='$email'";
					$netice = mysqli_query($conn,$select);
					while($row = mysqli_fetch_assoc($netice)){
						if(isset($row['email'])){

							//eger email movcuddursa deyiskeni false edir
							$email_movcud_deyil = false;

							if($row['email'] == $email){
								//mail adresine gonderilecek mail sifrelenir
								function sifreleme(){
									global $email;
									//emailin sifrelenmis hali
									global $sifrelenmis_email;
									$sifrelenmis_email = "";
									//random herf ve reqemimiz
									$random_sifre = "";

									//elifbadaki herflerin hamisi var burda
									$herfler = "vejklmpzdhxnkcsitrabyuvfwg";

									for($a=0; $a<strlen($email); $a++){
										//dongude her defe 0-25 arasi reqem random edirik ve o sirada olan herfi secirik herfler deyisgeninden
										for($b=0; $b<2; $b++){
											//random herf al
											$rand_herf = rand(0,25);
											$random_sifre .= $herfler[$rand_herf];
											//random reqem al
											$rand_reqem = rand(0,9);
											$random_sifre .= $rand_reqem;
										}
										$sifrelenmis_email .= $random_sifre.$email[$a];
										$random_sifre = "";
									}
								}
								sifreleme();
								$basliq = "GUMUSH.AZ Şifrə Bərpa";
								$mesaj = "
<!DOCTYPE html>
<html>
<head>
	<meta charset='utf-8'/>
	<meta http-equiv='X-UA-Compatible' content='IE=edge'>
   	<meta name='viewport' content='width=device-width, initial-scale=1'>
</head>
<body>
    <table style='width:100%;'>
        <tr>
            <td align='center' style='background-color: #eeeeee;' bgcolor='#eeeeee'>
                <table align='center' border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                        <td align='center' valign='top' style='font-size:0; padding: 35px;' bgcolor='#3f3f45'>
                            <table align='center' border='0' cellpadding='0' cellspacing='0'>
                                <tr>
                                    <td align='left' valign='top' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 36px; font-weight: 800; line-height: 48px;' style='text-align: center !important;'>
                                        <h1 style='font-size: 36px; font-weight: 800; margin: 0; color: #ffffff;'>G U M U S H . A Z</h1>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    <tr>
                        <td align='center' style='padding: 35px; background-color: #ffffff;' bgcolor='#ffffff'>
                            <table align='center' border='0' cellpadding='0' cellspacing='0' width='100%'>
                                <tr>
                                    <td align='left' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-bottom: 15px; border-bottom: 3px solid #eeeeee;'>
                                        <p style='font-size: 16px; font-weight: 800; line-height: 24px; color: #333333;'>
                                            Salam,
                                        </p>
                                        <p style='font-size: 14px; font-weight: 400; line-height: 24px; color: #777777; text-align: justify;'>
                                            Bu mail hesabınızın şifrəsini dəyişdirməyiniz üçün göndərilmişdir.
                                            </p>
    										
    										<p style='font-size: 14px; font-weight: 400; line-height: 24px; color: #777777;'>Şifrənizi dəyişdikdən sonra, hesabınıza daxil olub alış-verişinizə davam edə bilərsiniz.
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                   <td align='center' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 25px;'>  
                                    <p style='font-size: 16px; font-weight: 400; line-height: 24px; color: #777777;'>
                                        Hesabınızın şifrəsini dəyişmək üçün aşağıdakı <br>“Şifrəni dəyiş” düyməsinə klikləyin və açılan səhifədə yeni şifrənizi daxil edin.
                                    </p>
                                   </td>
                                </tr>
                                <tr>
                                    <td align='center' style='padding: 10px 0 25px 0;'>
                                        <table border='0' cellspacing='0' cellpadding='0'>
                                            <tr>
                                                <td align='center' style='border-radius: 5px;' bgcolor='#ed8e20'>
                                                  <a href='http://www.gumush.az/password_recovery/npw.php?f85v4d6d7e8fd521c4d5s96we5d21s=".$sifrelenmis_email."' target='_blank' style='font-size: 18px; font-family: Open Sans, Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; background-color: #ED5258; padding: 15px 30px; border: 1px solid #ed8e20; display: block;'>Şifrəni dəyiş</a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td align='center' style=' padding: 35px; background-color: #1b9ba3;' bgcolor='#1b9ba3'>
                            <table align='center' border='0' cellpadding='0' cellspacing='0' width='100%'>
                                <tr>
                                    <td align='center'>
                                        <table>
                                            <tr>
                                                <td style='padding: 0 10px;'>
                                                    <a href='https://www.facebook.com/gumush.az/' target='_blank'><img src='http://gumush.az/img/facebookicon.png' alt='Facebook' width='35' height='35' style='display: block; border: 0px;border-radius:5px;' /></a>
                                                </td>  
                                                <td style='padding: 0 10px;'>
                                                    <a href='https://www.instagram.com/gumush_az/' target='_blank'><img src='http://gumush.az/img/instagramicon.png' alt='Instagram' width='35' height='35' style='display: block; border: 0px; border-radius:5px;' /></a>
                                                </td>
                                                <td style='padding: 0 10px;'>
                                                    <a href='https://twitter.com/gumush_az/' target='_blank'><img src='http://gumush.az/img/twittericon.png' alt='Twitter' width='35' height='35' style='display: block; border: 0px;border-radius:5px;' /></a>
                                                </td>  
                                                <td style='padding: 0 10px;'>
                                                    <a href='https://www.youtube.com/channel/UCFDdBQEIqQRLwWiTNDQ2IEA' target='_blank'><img src='http://gumush.az/img/youtubeicon.jpg' alt='Youtube' width='35' height='35' style='display: block; border: 0px; border-radius:5px;' /></a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td align='center' style='padding: 35px; background-color: #ffffff;' bgcolor='#ffffff'>
                            <table align='center' border='0' cellpadding='0' cellspacing='0' width='100%'>
                                <tr>
                                    <td align='left' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 24px;'>
                                        <p style='font-size: 14px; font-weight: 400; line-height: 20px; color: #777777;text-align: center;'>
                                            Bu e-mail avtomatik olaraq göndərilmişdir. Xahiş edirik cavablandırmayın.
                                            Sual və təkliflərinizi <a href='http://gumush.az/contact' target='_blank' style='color: #000000; font-size: 14px; font-weight: 600; text-decoration: none;'>GUMUSH.AZ Əlaqə Bölməsinə </a> yaza bilərsiniz.
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
";
								$headers = "From: GUMUSH.AZ@gumush.az\r\n";
								$headers .= "Reply-To: support@gumush.az\r\n";
								$headers .= "MIME-Version: 1.0\r\n";
								$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

								//emaili gonderir
								$gonderildi = mail($to_email, $basliq, $mesaj, $headers);
								
								if($gonderildi){
									//email gonderildise 
									echo "email_gonderildi";
								}else{
									//email gonderilmedise
									echo "email_gonderilmedi";
								}
							}
						}
					}
					//eger deyer false olmayibsa yuxarida, yeni eger email movcud deyilse ve deyer helede truedirse echo edir
					if($email_movcud_deyil == true){
						echo "email_movcud_deyil";
					}
                    mysqli_close($conn);
				}
			}else{
				echo "email_duzgun_daxil_edilmeyib";
			}
		}else{
			echo "email_duzgun_daxil_edilmeyib";
		}
	}else{
		echo "email_duzgun_daxil_edilmeyib";
	}
?>