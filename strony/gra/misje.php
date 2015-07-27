<?php
require_once('inc/system.php');
if(empty($oUser['gracz'])) header('location: index.php');
if($oUser['pracaKoniec'] > 0) header('location: postac.php');

$h1 = "Misje";


$mid = (int)$_GET['mid'];

require_once('inc/misje.php');

if(empty($mid)){
	foreach($misje as $misja){
		$out .="
		<div class='clear'>
			<h4 style='background:url(img/dataBG.png); padding:5px;'>".$misja->nazwa."</h4>
			<p style='background:url(img/dataBG.png); padding:5px;'>".$misja->opis."</p>
			<table>
			<tr align='center'>
				<td style='background:url(img/dataBG.png);'><img src='img/coin.png' /></td>
				<td style='background:url(img/dataBG.png);'><img src='img/punkty.png'  /></td>
				<td style='background:url(img/dataBG.png);'><img src='img/energia.png'  /></td>
				<td rowspan='2'><a href='gra.php?str=misje&mid=".$misja->id."' style='background:url(img/dataBG.png); padding:25px;'>wykonaj</a></td>
			</tr>
			<tr align='center'>
				<td style='background:url(img/dataBG.png);'>".$misja->zloto."</td>
				<td style='background:url(img/dataBG.png);'>".$misja->punkty."</td>
				<td style='background:url(img/dataBG.png);'>".$misja->energia."</td>
			</tr>
			</table>
			
		</div>
		";
	}
	$gra .= $out;
} elseif(empty($misje[$mid])) {
	$gra = 'Nie ma tkaiej misji!!';
} elseif($oUser['energia'] < $misje[$mid]->energia) {
	$gra = 'Masz za mało energii!!';
} else {
	$rand = array_rand($misje[$mid]->potwory);
	$pid = $misje[$mid]->potwory[$rand];
	require('inc/potwory.php');
	$potwor = $potwory[$pid];
	if(file_exists('img/avatary/'.$oUser['gracz'].'.jpg')) $av = './img/avatary/'.$oUser['gracz'].'.jpg';
	else $av = './img/avatar.png';
	$out = "
		<table align='center' style='width:340px'>
			<tr>
				<td align='left'>".$oUser['login']."</td>
				<td align='right'>".$potwor->nazwa."</td>
			</tr>
			<tr align='center'>
				<td>
					<div id='avatar' style='margin: 0px'><img src='".$av."' alt='' style='width:128px; height:121px;'/></div>
					<div class='statusBar right'>
						<div class='zycieBar' id='gracz'></div>
					</div>
				</td>
				<td>
					<div class='statusBar left'>
						<div class='zycieBar' id='potwor'></div>
					</div>
					<div id='avatgar' style='margin-left:25px;'><img src='img/potwory/".$potwor->id.".jpg' alt='' style='width:128px; height:121px'/></div>
					
				</td>
			</tr>
			<tr>
				<td align='left'>
					<table>
					<tr>
						<td>
							<div class='stat' id='atak' title='atak'></div>
						</td>
						<td>
							<div class='stat' id=''>".$oUser['atak']."</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class='stat' id='pancerz' title='pancerz'></div>
						</td>
						<td>
							<div class='stat' id=''>".$oUser['pancerz']."</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class='stat' id='zycie' title='zycie'></div>
						</td>
						<td>
							<div class='stat' id=''>".$oUser['zycie']."</div>
						</td>
					</tr>
					</table>
				</td>
				<td align='right'>
					<table>
					<tr>
						<td>
							<div class='stat' id='atak' title='atak'></div>
						</td>
						<td>
							<div class='stat' id=''>".$potwor->atak."</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class='stat' id='pancerz' title='pancerz'></div>
						</td>
						<td>
							<div class='stat' id=''>".$potwor->pancerz."</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class='stat' id='zycie' title='zycie'></div>
						</td>
						<td>
							<div class='stat' id=''>".$potwor->zycie."</div>
						</td>
					</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td colspan='2' style='background:#000; border: solid 1px #ccc; padding:10px;'>
					<div id='walka_tekst' style='height:180px; overflow:auto;'>Walka rozpoczęta...</div>
				</td>
			</tr>
			</table>
			<script type='text/javascript'>
			var id = 0;
			function walcz(){
				var info = document.getElementById('walka_tekst');
				id = id + 1;
				if(typ[id] != undefined){
					if(typ[id] == 1){
						info.innerHTML = teksty[id]  + '<br/>' +  info.innerHTML;
						if(kto[id] == 1){
							$('#potwor').animate({
								top: '+='+wartosci[id],
								height: '-='+wartosci[id]
							 }, 1000, function() {}
							);
						} else {
							$('#gracz').animate({
								top: '+='+wartosci[id],
								height: '-='+wartosci[id]
							 }, 1000, function() {}
							);
						}
					} else {
						info.innerHTML = teksty[id]  + '<br/>' +  info.innerHTML;
					}

		        }
				if(typ[id+1]) {
					var t=setTimeout('walcz()',1500);
				}
			}
			var teksty=new Array(); 
			var obrazenia=new Array(); 
			var wartosci=new Array(); 
			var kto=new Array(); 
			var typ=new Array(); 
			
	";
	$id = 0;
	$oUser['zycieMax'] = $oUser['zycie'];
	$potwor->zycieMax = $potwor->zycie;
	$oUser['zycieB'] = $oUser['zycie'];
	$potwor->zycieB = $potwor->zycie;
	while($oUser['zycieB'] > 0 && $potwor->zycieB > 0){
		$id++;
		$cios = $oUser['atak'] - $potwor->pancerz;
		if($cios > 1) $cios = rand(1,$cios);
		else $cios = 1;
		if($cios > $potwor->zycieB) $cios = $potwor->zycieB;
		
		$wartosc = round($cios/$potwor->zycieMax * 118);
		if($wartosc < 1) $wartosc = 1;

		$sz = $oUser['atak'] / ($potwor->zycie + 1);
		if($sz > 25) $sz = 25;
		$r = rand(1,100);
		if($sz > $r) {
			$out .= "
				teksty[".$id."] = '<b>".$oUser['login']."</b> uderza ale przeciwnik robi unik';
				obrazenia[".$id."] = 0;
				kto[".$id."] = 1;
				typ[".$id."] = 3;
				wartosci[".$id."] = 0;
			";

		} else {
			$potwor->zycieB -= $cios;
			$out .= "
				teksty[".$id."] = '<b>".$oUser['login']."</b> uderza i zadaje ".$cios." obrażeń';
				obrazenia[".$id."] = ".$cios.";
				kto[".$id."] = 1;
				typ[".$id."] = 1;
				wartosci[".$id."] = ".$wartosc.";
			";
		}

		if($potwor->zycieB < 1) {
			$wygral = 1;
			$id++;
			$out .= "
				teksty[".$id."] = '<b>Przeciwnik pada martwy! Wygrywasz!</b>';
				obrazenia[".$id."] = 0;
				kto[".$id."] = 1;
				typ[".$id."] = 2;
				wartosci[".$id."] = 0;
			";
		} else {
			$id++;
			$cios = $potwor->atak - $oUser['pancerz'];
			if($cios > 1) $cios = rand(1,$cios);
			else $cios = 1;
			if($cios > $oUser['zycieB']) $cios = $oUser['zycieB'];
			
			$wartosc = round($cios/$oUser['zycieMax'] * 118);
			if($wartosc < 1) $wartosc = 1;

			
			$sz = $potwor->atak / ($oUser['zycie'] + 1);
			if($sz > 25) $sz = 25;
			$r = rand(1,100);
			if($sz > $r) {
				$out .= "
					teksty[".$id."] = '<b>".$potwor->nazwa."</b> uderza ale robisz unik';
					obrazenia[".$id."] = 0;
					kto[".$id."] = 2;
					typ[".$id."] = 3;
					wartosci[".$id."] = 0;
				";

			} else {
				$oUser['zycieB'] -= $cios;
				$out .= "
					teksty[".$id."] = '<b>".$potwor->nazwa."</b> uderza i zadaje ".$cios." obrażeń';
					obrazenia[".$id."] = ".$cios.";
					kto[".$id."] = 2;
					typ[".$id."] = 1;
					wartosci[".$id."] = ".$wartosc.";
				";
			}
			
			if($oUser['zycieB'] < 1) {
				$wygral = 2;
				$id++;
				$out .= "
					teksty[".$id."] = '<b>Padasz martwy! Przegrywasz!</b>';
					obrazenia[".$id."] = 0;
					kto[".$id."] = 1;
					typ[".$id."] = 2;
					wartosci[".$id."] = 0;
				";
			} 
		}
	}
	$out .= "
		var t=setTimeout('walcz()',1500);
		</script>";

	if(!empty($wygral) && $wygral == 1){
		$query = "
			UPDATE myths_gracze
			SET energia = energia - ".$misje[$mid]->energia.",
			zloto = zloto + ".$misje[$mid]->zloto.",
			punkty = punkty  + ".$misje[$mid]->punkty.",
			exp = exp  + ".$misje[$mid]->punkty."
			WHERE gracz = ".$oUser['gracz']."
			LIMIT 1
		";
		$q = mysql_query($query);
				
		$oUser['energia'] -= $misje[$mid]->energia;
			
	} else {
		$query = "
			UPDATE myths_gracze
			SET energia = energia - ".$misje[$mid]->energia."
			WHERE gracz = ".$oUser['gracz']."
			LIMIT 1
		";
		$q = mysql_query($query);
		$oUser['energia'] -= $misje[$mid]->energia;
	}

			
	$gra = $out;
}
require_once('inc/szablon.php');

?>
