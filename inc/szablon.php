<?php
if($spr == 'adm'){
	$menu = "
		<a href='admin-cp.php?str=start'>start</a>
		<a href='admin-cp.php?str=newsy'>newsy</a>
		<a href='admin-cp.php?str=ustawienia'>ustawienia</a>
		<a href='admin-cp.php?str=gracze'>gracze</a>		
		<a href='gra.php'><font color='orange'><b>Gra</b></font></a>
	";

}
else{

if(empty($oUser['gracz'])){
	$menu = "
		<a href='?str=start'>nowości</a>
		<hr/>
		<a href='?str=logowanie'>logowanie</a>
		<a href='?str=rejestracja'>rejestracja</a>
		<hr/>
		<a href='?str=regulamin'>regulamin</a>
	";
} 
else {
	
		$menu = '
			<a href="gra.php?str=postac">Postać</a>
			<a href="gra.php?str=poczta">Poczta</a>
			<a href="gra.php?str=bank">Bank</a>
			<a href="gra.php?str=handlarz">Handlarz</a>
			<a href="gra.php?str=misje">Misje</a>

			<a href="gra.php?str=ranking">Ranking</a>

			<a href="gra.php?str=vip">Premium</a>
			<a href="gra.php?str=konto">Konto</a>
			';
	if($oUser['ranga'] == 3) $menu = $menu.'<a href="admin-cp.php"><font color="orange"><b>Admin CP</b></font></a>';
		$menu = $menu.'<a href="gra.php?str=wyloguj">Wyloguj</a>';

}
			}

$szablon = "
<!DOCTYPE>
<html>
<head>
	<title>".ustawienia('nazwa')." || ".$nazwa."</title>
	<meta name='Description' content='".ustawienia('opis dla google')."' />
	<meta http-equiv='Content-type' content='text/html; charset=utf-8' />
	<link rel='stylesheet' type='text/css' href='img/main.css' />
	<link rel='stylesheet' type='text/css' href='img/tooltip.css' />
	<script type='text/javascript' src='img/jq.js'></script>
	<script type='text/javascript' src='img/tooltip.js'></script>
	<script type='text/javascript' src='img/dimensions.js'></script>
	<script type='text/javascript'>		
					
						function liczCzas(tid,ile) {
							

							godzin = Math.floor(ile / 3600);
							minut = Math.floor((ile - godzin * 3600) / 60);
							sekund = ile - minut * 60 - godzin * 3600;
							if (godzin < 10){  godzin = '0'+ godzin; }
							if (minut < 10){  minut = '0' + minut; }
							if (sekund < 10){  sekund = '0' + sekund; }
							
							if (ile > 0) {
								ile--;
								document.getElementById(tid).innerHTML = godzin + ':' + minut + ':' + sekund;
								setTimeout('liczCzas('+tid+',+ile+ )', 1000);
							} 
						}
						
						</script>
	<script>
	  $(document).ready(function(){
		$('.item').tooltip();
		$('#energy').tooltip();
	  });
	  </script>
	  <script type='text/javascript'>
		function liczCzas(tid,ile) {
			godzin = Math.floor(ile / 3600);
			minut = Math.floor((ile - godzin * 3600) / 60);
			sekund = ile - minut * 60 - godzin * 3600;
			if (godzin < 10){  godzin = '0'+ godzin; }
			if (minut < 10){  minut = '0' + minut; }
			if (sekund < 10){  sekund = '0' + sekund; }
			ile--;
			if (ile > 0) {
				document.getElementById(tid).innerHTML = godzin + ':' + minut + ':' + sekund;
				setTimeout(\"liczCzas('\"+tid+\"', \"+ile+\" )\", 1000);
			} else {		
				document.getElementById(tid).innerHTML = 'zakończono';
			}
		}
	</script>

	</head>
	<body>
		<div id='page'>
			<section id='logo'></section>

			<section id='menu'>
				<div id='menuBG'>
					<div id='menuH'></div>
					".$menu."
					
					<div id='menuFClear'></div>
					<div id='menuF'></div>
				</div>
			</section>
			
			<section id='content'>
				<div id='contentBG'>
					<div id='contentH'></div>
						".((!empty($blad)) ? '<div id="error">'.$blad.'</div>' : '')."
						<div id='game' style='padding-top:30px;'>
						".$gra."
						</div>
					<div id='contentFClear'></div>
					<div id='contentF'></div>
				</div>
				
			</section>
		</div>
	</body>
	</html>
";

echo $szablon;
?>