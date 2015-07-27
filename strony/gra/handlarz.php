<?php

if($oUser['pracaKoniec'] > 0) header('location: gra.php?str=postac');



		switch($_GET['akcja']){
			case 'kup':
				if(empty($przedmioty[$_GET['co']])) $data['error'] = "nie ma takiego przedmiotu";
				else {
					if($przedmioty[$_GET['co']]->cena > $oUser['zloto']) $data['error'] = "nie masz tyle złota";
					else {
						
						$items = str_replace('::',':',$oUser['przedmioty'].$_GET['co']);
						$query = "
							UPDATE myths_gracze 
							SET zloto = zloto - ".$przedmioty[$_GET['co']]->cena.",
							przedmioty = '".$items.":'
							WHERE gracz = ".$oUser['gracz']."
							AND zloto >= ".$przedmioty[$_GET['co']]->cena."
							LIMIT 1
						";
						$q = mysql_query($query);
						if(mysql_affected_rows() == 0) $data['error'] = "nieoczekiwany błąd";
						else {
							$data['error'] = "kupiłeś przedmiot";
							$przedmioty[$_GET['co']]->ile++;
							$oUser['zloto'] -= $przedmioty[$_GET['co']]->cena;
						}
					}
					
				}
			break;
			case 'sprzedaj':
				if(empty($przedmioty[$_GET['co']])) $data['error'] = "nie ma takiego przedmiotu";
				elseif(empty($przedmioty[$_GET['co']]->ile)) $data['error'] = "nie masz takiego przedmiotu";
				else {
					$items = explode(':',$oUser['przedmioty']);
					foreach($items as $key => $item){
						if($item == $_GET['co']) { unset($items[$key]); break; }
					}
					$items = implode(':',$items);
					$items = str_replace('::',':',$items);
						$query = "
							UPDATE myths_gracze 
							SET zloto = zloto + ".$przedmioty[$_GET['co']]->wartosc.",
							przedmioty = '".$items.":'
							WHERE gracz = ".$oUser['gracz']."
							LIMIT 1
						";
						$q = mysql_query($query);
						if(mysql_affected_rows() == 0) $data['error'] = "nieoczekiwany błąd";
						else {
							$data['error'] = "sprzedałeś przedmiot";
							$przedmioty[$_GET['co']]->ile--;
							$oUser['zloto'] += $przedmioty[$_GET['co']]->wartosc;
						}
					
				}
			break;
		}
		$gra = '
		<div  style="background:url(img/dataBG.png); padding:10px; margin-bottom:20px;"><b>Posiadasz: '.$oUser['zloto'].' złota</b>
		<p>
			Witaj w moim sklepie. Mam tu coś specjalnie dla Ciebie!<br/>
			Im więcej masz punktów tym lepsze przedmioty możesz u mnie kupić!
		</p>
		</div>
		';
		$out = "<div id='itemsAll' style='background:url(img/dataBG.png); border:solid 1px #ccc; text-align:center; width:240px; height:350px;; overflow:auto'>";

		foreach($przedmioty as $item){
			$out .="
			<div class='item'  title='".$item->nazwa."<hr/>atak: ".$item->atak."<br/>pancerz: ".$item->pancerz."<br/>życie: ".$item->zycie."<br/>energia: ".$item->energia."<hr/>cena: ".$item->cena."'>
				<img src='img/przedmioty/".$item->id.".jpg'  alt=''/><br/>
				<a href='gra.php?str=handlarz&akcja=kup&co=".$item->id."'>kup</a>
			</div>
			";
		}
		$out .= "</div>";

		$gra .= $out;
		
		$out = "";
		foreach($przedmioty as $item){
			if($item->ile > 0)
			$out .="
			<div class='item'  title='".$item->nazwa."<hr/>atak: ".$item->atak."<br/>pancerz: ".$item->pancerz."<br/>życie: ".$item->zycie."<br/>energia: ".$item->energia."<hr/>wartość: ".$item->wartosc."<hr/>ilość: ".$item->ile."'>
				<img src='img/przedmioty/".$item->id.".jpg'  alt=''/><br/>
				<a href='gra.php?str=handlarz&akcja=sprzedaj&co=".$item->id."'>sprzedaj</a>
			</div>
			";
		}
		$gra .= "<div id='itemsBackpack' style='background:url(img/dataBG.png); border:solid 1px #ccc; text-align:center;width:240px; height:350px;; overflow:auto'>".$out."</div>
		";
		


		


?>
