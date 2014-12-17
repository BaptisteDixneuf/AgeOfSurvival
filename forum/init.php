<?php
	if(isset($_SESSION['login'])){
	$cnn = mysql_query('select id from users where username="'.mysql_real_escape_string($_SESSION['login']).'"');
	$data= mysql_fetch_assoc($cnn);

	
		$_SESSION['login'] = $_SESSION['login'];
		$_SESSION['userid'] = $data['id'];
		}
?>