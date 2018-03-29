<?php
	session_start();
	$login = htmlentities($_POST["login"], ENT_QUOTES, 'UTF-8');
	$password = htmlentities($_POST["password"], ENT_QUOTES, 'UTF-8');

	$input = $login.$password;
	$login_password_counter = 0;

	for($i=0;$i<strlen($input);$i++){
		if($input[$i] == "\\" || $input[$i] == "-" || $input[$i] == "+" || $input[$i] == "*" || $input[$i] == "/" || $input[$i] == "." || $input[$i] == "|" || $input[$i] == "=" || $input[$i] == "_" || $input[$i] == ")" || $input[$i] == "(" || $input[$i] == "&" || $input[$i] == "^" || $input[$i] == "%" || $input[$i] == "$" || $input[$i] == "#" || $input[$i] == "@" || $input[$i] == "!" || $input[$i] == "`" || $input[$i] == "~" || $input[$i] == "}" || $input[$i] == "]" || $input[$i] == "{" || $input[$i] == "[" || $input[$i] == "'" || $input[$i] == '"' || $input[$i] == ";" || $input[$i] == ":" || $input[$i] == "/" || $input[$i] == "?" || $input[$i] == ">" || $input[$i] == "<" || $input[$i] == "," || $input[$i] == " " || $input[$i] == "" ){
			$_SESSION['login_atack'] = $login;
			$_SESSION['password_atack'] = $password;
			header('Location: ../security');
			break;
		}else{
			$login_password_counter++;
		}
	}

	if($login_password_counter == strlen($input)){
		include "../../db-bakuweb/db.php";
		if($conn){
			$select = "SELECT * FROM bakuweb";
			$result = mysqli_query($conn,$select);
			while($row = mysqli_fetch_assoc($result)){
				$loginDB = $row['login_bw'];
				$passwordDB = $row['password_bw'];
			}
			if($login == $loginDB && $password == $passwordDB){
				$_SESSION["login"] = $login;
				$_SESSION["password"] = $password;
				header('Location: admin.php');
			}else{
				header('Location: ../farajov');
			}
			mysqli_close($conn);
		}
	}
?>