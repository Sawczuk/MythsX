<?php
require_once('inc/system.php');
 if(empty($oUser['gracz'])) header('location: index.php');
 if($oUser['ranga'] != 3) header('location: index.php');
	
	 $spr = 'adm';
	 
  	$_GET['str'] = filter_var(trim($_GET['str']), FILTER_SANITIZE_STRING);
	
	if(empty($_GET['str'])) $_GET['str'] = 'start';
	
	switch($_GET['str']){
		  
		case'start';
		 $nazwa = $_GET['str'];
		 require_once('strony/admin-cp/start.php');
		break;
		
		case'newsy';
		 $nazwa = $_GET['str'];
		 require_once('strony/admin-cp/newsy.php');
		break;
		

		case'ustawienia';
		 $nazwa = $_GET['str'];
		 require_once('strony/admin-cp/ustawienia.php');
		break;
		

		case'gracze';
		 $nazwa = $_GET['str'];
		 require_once('strony/admin-cp/gracze.php');
		break;
		

		
	}

require_once('inc/szablon.php');

?>