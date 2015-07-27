<?php
require_once('inc/system.php');
if(empty($oUser['gracz'])) header('location: index.php');


if(!empty($_POST['check'])){
	$id = 1;        
	$code = "AAA";    
	$type = "sms";       
	$page = "vip";  
	$del=1;   
			  
				
	$array = array();
 	$array['code'] = $code;
	$array['check']= $_POST['check'];
	$array['id']   = $id;
	$array['type'] = $type;
	$array['del']  = $del;
	$ch = curl_init ();
	curl_setopt ($ch, CURLOPT_URL, "https://ssl.dotpay.pl/check_code.php");
	curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 2);
	@curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);   //wyłączamy obsługę błędów na serwerach jak xaa.pl
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt ($ch, CURLOPT_TIMEOUT, 100);
	curl_setopt ($ch, CURLOPT_POST, 1);
	curl_setopt ($ch, CURLOPT_POSTFIELDS, $array);
	$recv = curl_exec ($ch);
	curl_close ($ch);

	$dane = explode("\n", $recv);
	$status = $dane[0];
	$czas_zycia = $dane[1];


	if ($status == 0)  $error =  "wprowadzononiepoprawny kod";
	else { 
		$query = "
			update myths_gracze 
			set monety = monety + 100 
			where gracz = ".$oUser['gracz']." 
			limit 1
		";
		$q = mysql_query($query);
		$oUser['monety'] += 100;
		$error = "dodano 100 Monet";
	}
}

switch($_GET['akcja']){
	case 'vip1':
		if($oUser['monety'] < 10) $error = "brakuje Ci Monet";
		else {					
			$query = "
				update myths_gracze 
				set monety = monety - 10,
				zloto = zloto + 1000
				where gracz = ".$oUser['gracz']." 
				and monety >= 10
				limit 1
			";
			$q = mysql_query($query);
			$oUser['monety'] -= 10;
			$oUser['zloto'] += 1000;
			$error = "dodano 1000 złota";
		}
	break;
	case 'vip2':
		if($oUser['monety'] < 40) $error = "brakuje Ci Monet";
		else {					
			$query = "
				update myths_gracze 
				set monety = monety - 40,
				zloto = zloto + 5000
				where gracz = ".$oUser['gracz']." 
				and monety >= 40
				limit 1
			";
			$q = mysql_query($query);
			$oUser['monety'] -= 40;
			$oUser['zloto'] += 5000;
			$error = "dodano 5000 złota";
		}
	break;
	case 'vip3':
		if($oUser['monety'] < 50) $error = "brakuje Ci Monet";
		else {					
			$query = "
				update myths_gracze 
				set monety = monety - 50,
				energia = 100
				where gracz = ".$oUser['gracz']." 
				and monety >= 50
				limit 1
			";
			$q = mysql_query($query);
			$oUser['monety'] -= 50;
			$oUser['energia'] = 100;
			$error = "dodano energii";
		}
	break;
}

		
$gra = '
<div  style="background:url(img/dataBG.png); padding:10px">
	Posiadasz: <b>'.$oUser['monety'].'</b> Monet<hr/>
	1 SMS = 100 monet, koszt XXXzł z VAT<br><br>
	Wyślij SMSa o treści <b>XXXX</b> na nr <b>XXXX</b>, otrzymasz kod potwierdzenia, który musisz wpisać poniżej:
			<form action="vip.php" method=post>
			kod: <input type=text name="check">	
			<input type=submit value="użyj">
			</form>
			<hr class="clear"/>
			<ul>
				<li><a href="vip.php?akcja=vip1">dodaj 1000 złota za 10 monet</a>
				<li><a href="vip.php?akcja=vip2">dodaj 5000 złota za 40 monet</a>
				<li><a href="vip.php?akcja=vip3">przywróć 100 energii za 50 monet</a>
			</ul>
</div>
		';
		

require_once('inc/szablon.php');

?>
