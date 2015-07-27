<?php


switch($_GET['akcja']){
	case 'trenuj':
		switch($_GET['co']){
			case 'atak':
				if($oUser['pum'] < 1 ) $blad = "nie masz PUM";
				else {
					$oUser['atak']++;
					$oUser['pum']--;
					$query = "
							UPDATE myths_gracze
							SET pum = pum - 1,
							atak = atak + 1
							WHERE gracz = ".$oUser['gracz']."
							AND zloto >= atak + 10
							LIMIT 1
					";
					$q = mysql_query($query);
					if(mysql_affected_rows() == 0) $blad = "nieznany błąd";

				}
			break;
			case 'pancerz':
				if($oUser['pum'] < 1 ) $blad = "nie masz PUM";
				else {
					$oUser['pancerz']++;
					$oUser['pum']--;

					$query = "
								UPDATE myths_gracze
								SET pum = pum - 1,
								pancerz = pancerz + 1
								WHERE gracz = ".$oUser['gracz']."
								AND zloto >= pancerz + 10
								LIMIT 1
					";
					$q = mysql_query($query);
					if(mysql_affected_rows() == 0) $blad = "nieznany błąd";

				}
			break;
			case 'zycie':
				if($oUser['pum'] < 1 ) $blad = "nie masz PUM";
				else {
					$oUser['zycie'] +=5;
					$oUser['pum']--;

					$query = "
								UPDATE myths_gracze
								SET pum = pum - 1,
								zycie = zycie + 5
								WHERE gracz = ".$oUser['gracz']."
								AND zloto >= zycie + 10
								LIMIT 1
					";
					$q = mysql_query($query);
					if(mysql_affected_rows() == 0) $blad = "nieznany błąd";
				}
			break;
		}
	break;
	case 'zaloz':
		if(empty($przedmioty[$_GET['co']])) $blad =  "nie ma takiego przedmiotu";
		elseif(empty($przedmioty[$_GET['co']]->ile)) $blad =  "nie masz takiego przedmiotu";
		else {
			$mozna = 0;
			$zalozCo = '';
			switch($przedmioty[$_GET['co']]->typ){
				case 'bron':
					if($oUser['bron'] > 0) $blad =  "nosisz broń";
					else {
						$mozna = 1;
						$zalozCo = ', bron = '.$_GET['co'];
					}
				break;
				case 'helm':
					if($oUser['helm'] > 0) $blad =  "nosisz hełm";
					else {
						$mozna = 1;
						$zalozCo = ', helm = '.$_GET['co'];
					}
				break;
				case 'zbroja':
					if($oUser['zbroja'] > 0) $blad =  "nosisz zbroję";
					else {
						$mozna = 1;
						$zalozCo = ', zbroja = '.$_GET['co'];
					}
				break;
				case 'tarcza':
					if($oUser['tarcza'] > 0) $blad =  "nosisz tarczę";
					else {
						$mozna = 1;
						$zalozCo = ', tarcza = '.$_GET['co'];
					}
				break;
				case 'pierscien':
					if($oUser['pierscien'] > 0) $blad =  "nosisz pierścień";
					else {
						$mozna = 1;
						$zalozCo = ', pierscien = '.$_GET['co'];
					} 
				break;
				case 'amulet':
					if($oUser['amulet'] > 0) $blad =  "nosisz amulet";
					else {
						$mozna = 1;
						$zalozCo = ', amulet = '.$_GET['co'];
					} 
				break;
				case 'buty':
					if($oUser['buty'] > 0) $blad =  "nosisz buty";
					else {
						$mozna = 1;
						$zalozCo = ', buty = '.$_GET['co'];
					} 
				break;
			}

			if($mozna == 1){
				
				$items = explode(':',$oUser['przedmioty']);

				foreach($items as $key => $item){
					if($item == $_GET['co']) { unset($items[$key]); break; }
				}
				$items = implode(':',$items);
				$items = str_replace('::',':',$items);
				$query = "
					UPDATE myths_gracze 
					SET przedmioty = '".$items.":' ".$zalozCo.",
					atak = atak + ".$przedmioty[$_GET['co']]->atak.",
					pancerz = pancerz + ".$przedmioty[$_GET['co']]->pancerz.",
					zycie = zycie + ".$przedmioty[$_GET['co']]->zycie."
					WHERE gracz = ".$oUser['gracz']."
					LIMIT 1
				";
				$q = mysql_query($query);
				
				if(mysql_affected_rows() == 0) $blad =  "nieoczekiwany błąd";
				else header('location: gra.php?str=postac');
			}
		}
	break;
	case 'zdejmij':
		
		switch($_GET['co']){
			case 'bron':
				if($oUser['bron'] == 0) $blad =  "nie masz broni na sobie";
				else {
					$zdejmij = "przedmioty = '".$oUser['przedmioty'].$oUser['bron'].":' , bron = 0";
					$item = $przedmioty[$oUser['bron']];
				}
			break;
			case 'tarcza':
				if($oUser['tarcza'] == 0) $blad =  "nie masz tarczy na sobie";
				else {
					$zdejmij = "przedmioty = '".$oUser['przedmioty'].$oUser['tarcza'].":' , tarcza = 0";
					$item = $przedmioty[$oUser['tarcza']];
				}
			break;
			case 'helm':
				if($oUser['helm'] == 0) $blad =  "nie masz hełmu na sobie";
				else {
					$zdejmij = "przedmioty = '".$oUser['przedmioty'].$oUser['helm'].":' , helm = 0";
					$item = $przedmioty[$oUser['helm']];
				}
			
			break;
			case 'zbroja':
				if($oUser['zbroja'] == 0) $blad =  "nie masz zbroji na sobie";
				else {
					$zdejmij = "przedmioty = '".$oUser['przedmioty'].$oUser['zbroja'].":' , zbroja = 0";
					$item = $przedmioty[$oUser['zbroja']];
				}
			break;
			case 'pierscien':
				if($oUser['pierscien'] == 0) $blad =  "nie masz tego przedmiotu na sobie";
				else {
					$zdejmij = "przedmioty = '".$oUser['przedmioty'].$oUser['pierscien'].":' , pierscien = 0";
					$item = $przedmioty[$oUser['pierscien']];
				}
			break;
			case 'amulet':
				if($oUser['amulet'] == 0) $blad =  "nie masz przedmiotu na sobie";
				else {
					$zdejmij = "przedmioty = '".$oUser['przedmioty'].$oUser['amulet'].":' , amulet = 0";
					$item = $przedmioty[$oUser['amulet']];
				}
			break;
			case 'buty':
				if($oUser['buty'] == 0) $blad =  "nie masz przedmiotu na sobie";
				else {
					$zdejmij = "przedmioty = '".$oUser['przedmioty'].$oUser['buty'].":' , buty = 0";
					$item = $przedmioty[$oUser['buty']];
				}
			break;
			default: $blad =  "nie wybrano opcji"; break;
		}
		
		if(!empty($item)){
			$query = "
				UPDATE myths_gracze 
				SET ".$zdejmij.",
				atak = atak - ".$item->atak.",
				pancerz = pancerz - ".$item->pancerz.",
				zycie = zycie - ".$item->zycie."
				WHERE gracz = ".$oUser['gracz']."
				LIMIT 1
			";
			$q = mysql_query($query);
			if(mysql_affected_rows() == 0) $blad =  "nieoczekiwany błąd";
			else header('location: gra.php?str=postac');
		} else $blad =  "nieoczekiwany błąd";
	break;
	case 'przerwij':
		if($oUser['praca'] == 0) $blad =  "nie jesteś w pracy";
		else {
			$query = "
				UPDATE myths_gracze 
				SET praca = 0, pracaStart = 0, pracaKoniec = 0
				WHERE gracz = ".$oUser['gracz']."
				LIMIT 1
			";
			$q = mysql_query($query);
				
			if(mysql_affected_rows() == 0) $blad =  "nieoczekiwany błąd";
			else header('location: gra.php?str=postac');
		}
	break;
	case 'zakoncz':
		if($oUser['pracaKoniec'] < time()){
			$query = "
				UPDATE myths_gracze 
				SET zloto = zloto + praca * 100, praca = 0, pracaStart = 0, pracaKoniec = 0
				WHERE gracz = ".$oUser['gracz']."
				LIMIT 1
			";
			$q = mysql_query($query);
		}
		header('location: gra.php?str=postac');
	break;
}
if(!empty($_POST['praca'])){
	$arr = array(1,2,4,6,8,10,12);
	if(!in_array($_POST['praca'], $arr)) $blad =  "niewłaściwa wartość";
	elseif($oUser->praca > 0) $blad =  "już jesteś w pracy";
	else {
		$query = "
			UPDATE myths_gracze 
			SET praca = ".$_POST['praca'].", pracaStart = ".time().", pracaKoniec = ".(time() + $_POST['praca']*3600)."
			WHERE gracz = ".$oUser['gracz']."
			LIMIT 1
		";
		$q = mysql_query($query);
				
		if(mysql_affected_rows() == 0) $blad =  "nieoczekiwany błąd";
		else header('location: gra.php?str=postac');
	}

}


$gra = '';

		
if($oUser['pracaKoniec'] == 0){
	$gra .= "

	<div  style='background:url(img/dataBG.png); padding:10px; margin-bottom:20px;'>
		Możesz zdobyć dodatkowe złoto pracując w stajni. Jeżeli przerwiesz pracę, nie otrzymasz wynagrodzenia. Za każdą godzinę pracy otrzymasz 100 złota<br/><br/>
		<form action='gra.php?str=postac' method='POST' style='margin:0 auto; width:170px;'>
		<select name='praca'>
			<option value='1'>1h</option>
			<option value='2'>2h</option>
			<option value='4'>4h</option>
			<option value='6'>6h</option>
			<option value='8'>8h</option>
			<option value='10'>10h</option>
			<option value='12'>12h</option>
		</select>
		<input type='submit' name='submit' value='pracuj' />
		</form>
	</div>
	";
} elseif($oUser['pracaKoniec'] > time()){
	$gra .= "
	<div style='background:#000; border:solid 1px #ccc; width: 300px; height: 45px; margin:0 auto;position:relative;'>
		<div id='postep' style='background:#00cc00; width: 0px; height: 45px; float:left;'>
		</div>
		<div id='czas' style='color:#fff; position:absolute; top:5px; left:110px; text-align:center; font-weight:bold;'></div>
	</div>

	<script type='text/javascript'>
	var czasPracy = ".($oUser['pracaKoniec'] - $oUser['pracaStart']).";
	var pozostalo = ".($oUser['pracaKoniec'] - time()).";
	var start = 300 - Math.floor(pozostalo / czasPracy * 300);
	var w = start;
	var przerwij = '<br/><a href=\'gra.php?str=postac&akcja=przerwij\'>przerwij pracę</a>';
	$('#postep').animate({
	width: '+='+start
	}, 500, function() {}
	);
	function praca() {
		godzin = Math.floor(pozostalo / 3600);
		minut = Math.floor((pozostalo - godzin * 3600) / 60);
		sekund = pozostalo - minut * 60 - godzin * 3600;
		if (godzin < 10){  godzin = '0'+ godzin; }
		if (minut < 10){  minut = '0' + minut; }
		if (sekund < 10){  sekund = '0' + sekund; }
		pozostalo--;
		if (pozostalo > 0) {
			document.getElementById('czas').innerHTML = godzin + ':' + minut + ':' + sekund + przerwij;
			w = 300 - Math.floor(pozostalo / czasPracy * 300);
			if(w > start){
				w2 = w - start;
				$('#postep').animate({
					width: '+='+w2
				 }, 500, function() {}
				);
				start = w;
				w = 0;
				w2 = 0;
			}
			setTimeout('praca()', 1000);
		} 
	}
	praca();
</script>

	
";
} else {
	//skończył pracę
	$gra .= "
	<div  style='background:url(img/dataBG.png); padding:10px; margin-bottom:20px;'>
		<a href='gra.php?str=postac&akcja=zakoncz'>Odbierz wynagrodzenie za pracę, ".($oUser['praca'] * 100)."złota</a>
	</div>
	";
}

$gra .='

<table>
<tr>
	<td>

<div id="gracz_avatar"><div id="avatar">';

if(file_exists('img/avatary/'.$oUser['gracz'].'.jpg')) $av = './img/avatary/'.$oUser['gracz'].'.jpg';
else $av = './img/avatar.png';


		$perc = floor($oUser['energia'] / 100 * 118);


		$gra .= '<img src="'.$av.'" alt="" style="width:128px; height:121px;"/>
		</div>
			<div class="statusBar right">
				<div class="energyBar" id="energy" style="height:'.$perc.'px; top:'.(119 - $perc).'px" title="pozostało Ci '.$oUser['energia'].' punktów energii">
				</div>
			</div>
		</div>
	</td>
	<td>
			<table>
			<tr>
				<td>
					<div class="stat" id="atak" title="atak">
						<a href="gra.php?str=postac&akcja=trenuj&co=atak" class="dodaj" title="trenuj za 1PUM"></a>
					</div>
				</td>
				<td>
					<div class="stat" id="">'.$oUser['atak'].'</div>
				</td>
				<td>
					<div class="stat" id="pum" title="Punkty Umiejętności PUM"></div>
				</td>
				<td>
					<div class="stat" id="">'.$oUser['pum'].'</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="stat" id="pancerz" title="pancerz">
						<a href="gra.php?str=postac&akcja=trenuj&co=pancerz" class="dodaj" title="trenuj za 1PUM"></a>
					</div>
				</td>
				<td>
					<div class="stat" id="">'.$oUser['pancerz'].'</div>
				</td>
				<td>
					<div class="stat" id="punkty" title="punkty doświadczenia"></div>
				</td>
				<td>
					<div class="stat" id="">'.$oUser['exp'].' / '.$oUser['expMax'].'</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="stat" id="zycie" title="zycie">
						<a href="gra.php?str=postac&akcja=trenuj&co=zycie" class="dodaj" title="trenuj za 1PUM"></a>
					</div>
				</td>
				<td>
					<div class="stat" id="">'.$oUser['zycie'].'</div>
				</td>
				<td>
					<div class="stat" id="punkty" title="punkty doświadczenia (razem)"></div>
				</td>
				<td>
					<div class="stat" id="">'.$oUser['punkty'].'</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="stat" id="energia" title="energia"></div>
				</td>
				<td>
					<div class="stat" id="">'.$oUser['energia'].'</div>
				</td>
				<td>
					<div class="stat" id="zloto" title="złoto"></div>
				</td>
				<td>
					<div class="stat" id="">'.$oUser['zloto'].'</div>
				</td>
			</tr>
			</table>
	</td>
</tr>

</table>

<table>
<tr>
	<td>
		<div id="gracz_postac" class="clear">
			'.((!empty($oUser['helm'])) ? '<div id="helm" class="item"  title="'.$przedmioty[$oUser['helm']]->nazwa.'<hr/>atak: '.$przedmioty[$oUser['helm']]->atak.'<br/>pancerz: '.$przedmioty[$oUser['helm']]->pancerz.'<br/>życie: '.$przedmioty[$oUser['helm']]->zycie.'<hr/>wartość: '.$przedmioty[$oUser['helm']]->wartosc.'" style="width:32px;margin:0"><a href="gra.php?str=postac&akcja=zdejmij&co=helm"><img src="img/przedmioty/'.$oUser['helm'].'.jpg" alt=""/></a></div>' : '').'
			
			'.((!empty($oUser['bron'])) ? '<div id="bron" class="item"  title="'.$przedmioty[$oUser['bron']]->nazwa.'<hr/>atak: '.$przedmioty[$oUser['bron']]->atak.'<br/>pancerz: '.$przedmioty[$oUser['bron']]->pancerz.'<br/>życie: '.$przedmioty[$oUser['bron']]->zycie.'<hr/>wartość: '.$przedmioty[$oUser['bron']]->wartosc.'" style="width:32px;margin:0"><a href="gra.php?str=postac&akcja=zdejmij&co=bron"><img src="img/przedmioty/'.$oUser['bron'].'.jpg" alt=""/></a></div>' : '').'

			'.((!empty($oUser['zbroja'])) ? '<div id="zbroja" class="item"  title="'.$przedmioty[$oUser['zbroja']]->nazwa.'<hr/>atak: '.$przedmioty[$oUser['zbroja']]->atak.'<br/>pancerz: '.$przedmioty[$oUser['zbroja']]->pancerz.'<br/>życie: '.$przedmioty[$oUser['zbroja']]->zycie.'<hr/>wartość: '.$przedmioty[$oUser['zbroja']]->wartosc.'" style="width:32px;margin:0"><a href="gra.php?str=postac&akcja=zdejmij&co=zbroja"><img src="img/przedmioty/'.$oUser['zbroja'].'.jpg" alt=""/></a></div>' : '').'
			
			'.((!empty($oUser['tarcza'])) ? '<div id="tarcza" class="item"  title="'.$przedmioty[$oUser['tarcza']]->nazwa.'<hr/>atak: '.$przedmioty[$oUser['tarcza']]->atak.'<br/>pancerz: '.$przedmioty[$oUser['tarcza']]->pancerz.'<br/>życie: '.$przedmioty[$oUser['tarcza']]->zycie.'<hr/>wartość: '.$przedmioty[$oUser['tarcza']]->wartosc.'" style="width:32px;margin:0"><a href="gra.php?str=postac&akcja=zdejmij&co=tarcza"><img src="img/przedmioty/'.$oUser['tarcza'].'.jpg" alt=""/></a></div>' : '').'
			
			'.((!empty($oUser['pierscien'])) ? '<div id="pierscien" class="item"  title="'.$przedmioty[$oUser['pierscien']]->nazwa.'<hr/>atak: '.$przedmioty[$oUser['pierscien']]->atak.'<br/>pancerz: '.$przedmioty[$oUser['pierscien']]->pancerz.'<br/>życie: '.$przedmioty[$oUser['pierscien']]->zycie.'<hr/>wartość: '.$przedmioty[$oUser['pierscien']]->wartosc.'" style="width:32px;margin:0"><a href="gra.php?str=postac&akcja=zdejmij&co=pierscien"><img src="img/przedmioty/'.$oUser['pierscien'].'.jpg" alt=""/></a></div>' : '').'
			
			'.((!empty($oUser['amulet'])) ? '<div id="amulet" class="item"  title="'.$przedmioty[$oUser['amulet']]->nazwa.'<hr/>atak: '.$przedmioty[$oUser['amulet']]->atak.'<br/>pancerz: '.$przedmioty[$oUser['amulet']]->pancerz.'<br/>życie: '.$przedmioty[$oUser['amulet']]->zycie.'<hr/>wartość: '.$przedmioty[$oUser['amulet']]->wartosc.'" style="width:32px;margin:0"><a href="gra.php?str=postac&akcja=zdejmij&co=amulet"><img src="img/przedmioty/'.$oUser['amulet'].'.jpg" alt=""/></a></div>' : '').'
			
			'.((!empty($oUser['buty'])) ? '<div id="buty" class="item"  title="'.$przedmioty[$oUser['buty']]->nazwa.'<hr/>atak: '.$przedmioty[$oUser['buty']]->atak.'<br/>pancerz: '.$przedmioty[$oUser['buty']]->pancerz.'<br/>życie: '.$przedmioty[$oUser['buty']]->zycie.'<hr/>wartość: '.$przedmioty[$oUser['buty']]->wartosc.'" style="width:32px;margin:0"><a href="gra.php?str=postac&akcja=zdejmij&co=buty"><img src="img/przedmioty/'.$oUser['buty'].'.jpg" alt=""/></a></div>' : '').'
			
		</div>
		
	</td>
	<td>
	';
$out = "";
foreach($przedmioty as $item){
	if($item->ile > 0)
	$out .="
	<div class='item'  title='".$item->nazwa."<hr/>atak: ".$item->atak."<br/>pancerz: ".$item->pancerz."<br/>życie: ".$item->zycie."<br/>energia: ".$item->energia."<hr/>wartość: ".$item->wartosc."<hr/>ilość: ".$item->ile."'>
		<img src='img/przedmioty/".$item->id.".jpg' alt=''/><br/>
		<a href='gra.php?str=postac&akcja=zaloz&co=".$item->id."'>załóż</a>
	</div>
	";
}

$gra .= "<div id='itemsAll' style='background:url(img/dataBG.png); border:solid 1px #ccc; text-align:center; width:170px; height:280px; overflow:auto'>";

if(!empty($out))
$gra .= $out;
else $gra .= "Masz pusty plecak";
$gra .='
</div>
</td>
</tr>
</table>';




?>
