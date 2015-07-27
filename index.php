<?php
require_once('inc/system.php');
 
	$spr = 'gosc';
  	$_GET['str'] = filter_var(trim($_GET['str']), FILTER_SANITIZE_STRING);
	
	if(empty($_GET['str'])) $_GET['str'] = 'start';
	
	switch($_GET['str']){
		  
		case'start';
		 $nazwa = $_GET['str'];
		 require_once('strony/index/start.php');
		break;
		
		case'logowanie';
		 $nazwa = $_GET['str'];
		 require_once('strony/index/logowanie.php');
		break;
		
		case'rejestracja';
		 $nazwa = $_GET['str'];
		 require_once('strony/index/rejestracja.php');
		break;
				
		case'regulamin';
		 $nazwa = $_GET['str'];
		 require_once('strony/index/regulamin.php');
		break;
		
	}

require_once('inc/szablon.php');

?>