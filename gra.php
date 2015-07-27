<?php
require_once('inc/system.php');
 if(empty($oUser['gracz'])) header('location: index.php');
 
	$spr= 'user';
	//nowoczesne i bardzo dobre filtrowanie treści
  	$_GET['str'] = filter_var(trim($_GET['str']), FILTER_SANITIZE_STRING);
#####zamiast crona użyawamy obliczeń do aktualizowania banku	
	$bank = time()-$oUser['bankczas'];
	if($bank >= 3600){
	$bank2 = $bank/3600;
	$bank3 = $bank2*0.05;
	$bank4 = $bank3*$oUser['bank'];
	$bank5 = $bank4+$oUser['bank'];
	mysql_query("update myths_gracze set bank='".$bank5."',bankczas= '".time()."',banknast = 3600+'".time()."' where gracz='".$oUser['gracz']."'");
	}
//jesli nie ma ?str to ustawiamy strone główną	
	if(empty($_GET['str'])) $_GET['str'] = 'postac';
//zamiast tysiąca ifów lepszą funkcją jest switch optymalniejsza
/*
aby dodać strone  dodaj plik do odpowiedniego katalogu i dodaj po switchu 
		
		case'nazwa twoje strony'; to będzie w ?str=
		 $nazwa = $_GET['str'];
		 require_once('strony/gra/postac.php');//załączanie pliku
		break;
*/	
	switch($_GET['str']){
		
		case'postac';
		 $nazwa = $_GET['str'];
		 require_once('strony/gra/postac.php');
		break;
		
		case'bank';
		 $nazwa = $_GET['str'];
		 require_once('strony/gra/bank.php');
		break;
		
		case'poczta';
		 $nazwa = $_GET['str'];
		 require_once('strony/gra/poczta.php');
		break;		
		
		case'handlarz';
		 $nazwa = $_GET['str'];
		 require_once('strony/gra/handlarz.php');
		break;
				
		case'misje';
		 $nazwa = $_GET['str'];
		 require_once('strony/gra/misje.php');
		break;
						
		case'ranking';
		 $nazwa = $_GET['str'];
		 require_once('strony/gra/ranking.php');
		break;
						
		case'vip';
		 $nazwa = $_GET['str'];
		 require_once('strony/gra/vip.php');
		break;
								
		case'konto';
		 $nazwa = $_GET['str'];
		 require_once('strony/gra/konto.php');
		break;
								
		case'wyloguj';
		 $nazwa = $_GET['str'];
		 require_once('strony/gra/wyloguj.php');
		break;
		
	}
	
require_once('inc/szablon.php');

?>