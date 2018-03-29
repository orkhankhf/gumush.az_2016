<?php
session_start();
if(isset($_POST['exit']) && $_POST['exit'] == "exit"){
	unset($_SESSION['user_id']);
}
session_destroy();
?>