<?php
if(isset($_POST['a']) && isset($_POST['b']) && isset($_POST['c']) && isset($_POST['d']) && isset($_POST['e'])){
	include "../db-bakuweb/db.php";


	//PHP filterleri
	$ad = trim($_POST['a']);
	$soyad = trim($_POST['b']);
	$email = trim($_POST['c']);
	$to = trim($_POST['c']);
	$parol = trim($_POST['d']);
	$tel = (int)$_POST['e'];
	$ip = trim($_SERVER['REMOTE_ADDR']);

	$ad = htmlspecialchars($ad);
	$soyad = htmlspecialchars($soyad);
	$email = htmlspecialchars($email);
	$to = htmlspecialchars($to);
	$parol = htmlspecialchars($parol);
	$tel = htmlspecialchars($tel);
	$ip = htmlspecialchars($ip);
	

	$ad = filter_var($ad, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
	$soyad = filter_var($soyad, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
	$email = filter_var($email, FILTER_SANITIZE_EMAIL);
	if(!filter_var($email, FILTER_VALIDATE_EMAIL) === false){
		//md5 olmadan evvelki halini yaziriq (elaqe ucun aciq sekilde olmalidir)
		$email_no_md5 = $email;
		//tesdiqleme punktlarinda tehlukesizlik ucun md5 olmalidir
		$email = md5($email);
		$email = filter_var($email, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
	}else{
		echo "Xəta baş verdi!Xahiş edirik bunu bizə bildirin!";
	}

	$parol = filter_var($parol, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
	if(!filter_var($parol, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH) === false){
		$parol = md5($parol);
		$parol = filter_var($parol, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
	}else{
		echo "Xəta baş verdi!Xahiş edirik bunu bizə bildirin!";
	}

	$tel = filter_var($tel, FILTER_VALIDATE_INT);
	$ip = filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4);
	
	//aktivasiya ucun
	$aktivasiya = rand(111111111,999999999);

	if($conn){
		if(!filter_var($ad, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW) === false && !filter_var($soyad, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW) === false && !filter_var($email, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH) === false && !filter_var($parol, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH) === false && !filter_var($tel, FILTER_VALIDATE_INT) === false && !filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) === false){

			$registered_mail = false;

			$select_mail = mysqli_query($conn,"SELECT email FROM userler_bw");
			while($row = mysqli_fetch_assoc($select_mail)){
				if($row['email'] != $email && $registered_mail != true){
					$registered_mail = false;
				}else{
					$registered_mail = true;
				}
			}
			if($registered_mail == false){
				$insert = "INSERT INTO userler_bw (ip,ad,soyad,email_no_md5,email,sifre,tel,aktivasiya) VALUES ('$ip','$ad','$soyad','$email_no_md5','$email','$parol','$tel','$aktivasiya')";
				$netice = mysqli_query($conn,$insert);
				if($netice){
					$email_subject = "GUMUSH.AZ Aktivasiya";
					$email_body = "
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
                                            Siz GUMUSH.AZ saytından qeydiyyatdan keçdiniz. Bu mail yalnız e-mail təsdiqləmə əməliyyatı üçün göndərilmişdir.
                                            </p>
    										
    										<p style='font-size: 14px; font-weight: 400; line-height: 24px; color: #777777;'>E-mail ünvanınızı təsdiqləyərək, hesabınıza daxil olub alış-verişinizə dərhal başlaya bilərsiniz.
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                   <td align='center' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 25px;'>  
                                    <p style='font-size: 16px; font-weight: 400; line-height: 24px; color: #777777;'>
                                        E-mail adresinizi təsdiqləmək üçün aşağıdakı <br>“Hesabı aktivləşdir” düyməsinə klikləyin.
                                    </p>
                                   </td>
                                </tr>
                                <tr>
                                    <td align='center' style='padding: 10px 0 25px 0;'>
                                        <table border='0' cellspacing='0' cellpadding='0'>
                                            <tr>
                                                <td align='center' bgcolor='#ed8e20'>
                                                  <a href='http://gumush.az/aktivasiya/index.php?fgb65fd1xgf5641fb6818b5f151fg65n1f6g51n8562=".$aktivasiya."&6gn16fx41nxn8df56b18df1b5fgx1n6886ngf1n=".$email."' target='_blank' style='font-size: 18px; font-family: Open Sans, Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; border-radius: 5px; background-color: #ED5258; padding: 15px 30px; border: 1px solid #ed8e20; display: block;'>Hesabı aktivləşdir</a>
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
					$send = mail($to,$email_subject,$email_body,$headers);
					if($send){
						echo "ok";
					}
				}
			}else{
				echo "email_is_registered";
			}
		}else{
			echo "Xəta baş verdi!Xahiş edirik bunu bizə bildirin!";
		}
        mysqli_close($conn);
	}else{
		echo "Databazaya baglanmadi";
	}
}
?>