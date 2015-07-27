<?php
$query = mysql_query("select * from mythsx_nowosci ORDER BY data DESC LIMIT 100");
			if(mysql_num_rows($query)>0){
				$gra2 = $gra2."<center><font color='orange'><h2>Nowości w grze</h2></font></center>
					<table>";
					
				$row = 0;
				
				while($dane = mysql_fetch_array($query)){
					if($row==0) $style ='border-width: thin;border-style: solid;border-color: orange;background:#777777;';
					else $style ='border-width: thin;border-style: solid;border-color: orange;background:#444444;';
					$gra2 = $gra2."
						<tr style='".$style."'>
							<td width='250px'>".$dane['nazwa']."</td>
							<td width='250px'>".date( 'd.m.Y G:i:s' , $dane['data'] )."</td>
					</tr>
						<tr>	
							<td style='".$style."' colspan='2'>".$dane['tresc']."</td>
						</tr>
						";
					$row = !$row;
				}
				$gra2 = $gra2."</table><hr/>";

			}






$gra = "
<div  style='background:url(img/dataBG.png); padding:10px'>
<center><font color='orange'><h2>MythsX</h2></font></center>

Jest to modyfikacja silnika Myths nazwana potocznie MythsX, twórcą jej jest Sawczuk.Modyfikacja wniosła przede wszystkim poprawki likwidujące bugi jakie napotkałem ,następnie został przebudowany  system plików stron oraz dodane nowe funkcje jak Bank,Panel Administratora czy System PW, gruntownej modyfikacji uległa zakładka konto , można powiedzieć mało który plik silnika nie został dotknięty przez mojego n++ :).<br>
Jako że nie chce mieć do czynienia z administracją gvw kończę modyfikacje tego silnika a w zamian rusza projekt silnika NewRPG . Oceniajcie komentujcie i proponujcie :).
Nowy projekt dostępny będzie na stronie <a href='http://centrummmo.eu'>http://www.centrummmo.eu</a><br><br>
<br>".ustawienia('opis na stronie')."<br><br>
".$gra2."
<br><br>
Orginalny Silnik gry 'Myths' można pobrać stronie internetowej <a href='http://gryviawww.pl'>http://gryviawww.pl</a><br/><br/>
<br/><br/><br><br>
<table style='width:500px; margin:0 auto;'>
<tr>
	<td>
<a href='img/myths1.jpg' target='_blank'>
	<img src='img/myths1.jpg' alt='' width='150px;'/>
</a></td>
	<td>
<a href='img/myths2.jpg' target='_blank'>
	<img src='img/myths2.jpg' alt='' width='150px;'/>
</a></td>
	<td>
<a href='img/myths3.jpg' target='_blank'>
	<img src='img/myths3.jpg' alt='' width='150px;'/>
</a></td>
</tr>
</table>
</div>
";
?>
