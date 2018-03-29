<?php
session_start();
if(isset($_POST['exit']) && $_POST['exit'] == "exit"){
	unset($_SESSION["login"]);
	unset($_SESSION["password"]);
	echo "admin_exit";
}
?>