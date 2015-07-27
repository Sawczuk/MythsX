<?php
ob_start();
session_start();
require('inc/config.php');



function tekst($tekst){ 	
	$search = array('@<script[^>]*?>.*?</script>@si', '@<[\/\!]*?[^<>]*?>@si', '@<style[^>]*?>.*?</style>@siU', '@<![\s\S]*?--[ \t\n\r]*>@'); 
	$text = preg_replace($search, '', $tekst);
	$arr = array('"',"'","#","//","--");
	$tekst = str_replace($arr, '', $tekst);
	return $tekst = trim(mysql_real_escape_string(nl2br(htmlspecialchars(trim($tekst))))); 
}


if(!isset($_SESSION['gracz'])) $_SESSION['gracz'] = 0;
$_SESSION['gracz'] = (int)$_SESSION['gracz'];
$oUser =  mysql_fetch_array(mysql_query("select * from myths_gracze where gracz = ".$_SESSION['gracz']));

if(!empty($oUser['exp']) && ($oUser['exp'] >= $oUser['expMax'])){
	mysql_query("update myths_gracze set poziom = poziom + 1, pum = pum + 5, exp = exp - expMax, expMax = expMax * 1.3 where gracz = ".$oUser['gracz']." limit 1");
	 header('location: postac.php');
}
if(!empty($oUser['gracz'])){
	require('inc/przedmioty.php');

	$ex = explode(":",$oUser['przedmioty']);
	if(!empty($ex)){
		foreach($ex as $p){
			if(!empty($p) && is_numeric($p)){
				if(empty($przedmioty[$p]->ile)) { $przedmioty[$p]->ile = 1; }
				else { $przedmioty[$p]->ile++; }
			}
		}
	}

}

function ustawienia($nazwa){
$ustawienia = mysql_fetch_array(mysql_query("SELECT tresc FROM mythsx_ustawienia WHERE nazwa = '".$nazwa."' LIMIT 1"));
return $ustawienia['tresc'];
}

	
mysql_query("update myths_gracze set energia = energia + 1, regeneracja = regeneracja + 900 where regeneracja + 900 < ".time());
mysql_query("update myths_gracze set energia = 100 where energia > 100");


$gra = "";
$menu = "";
$h1 = "";
$msg = "";
$menu = "";
?>