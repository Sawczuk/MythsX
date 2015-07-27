<?php
if (isset($_POST['bezpiecznik1']) && $_POST['bezpiecznik1'] == "ok"){
if(!empty($_POST['reg1'])){
	$_POST['wplac'] = intval($_POST['wplac']);


	if($_POST['wplac'] > $oUser['zloto']) $blad = 'nie masz tyle złota';

	

	if(empty($blad)){
		mysql_query("update myths_gracze set bankczas=3600+'".time()."',banknast = 3600+'".time()."',bank=bank+'".$_POST['wplac']."',zloto=zloto-'".$_POST['wplac']."' where gracz='".$oUser['gracz']."'");	
		$gra = $gra."<font color='grenn'>wpłacono<br></font>";
		header('location: gra.php?str=bank');		
	}

}}

if (isset($_POST['bezpiecznik2']) && $_POST['bezpiecznik2'] == "ok"){
if(!empty($_POST['reg2'])){
	$_POST['wyplac'] = intval($_POST['wyplac']);


	if($_POST['wyplac'] > $oUser['bank']) $blad = 'nie masz tyle złota w banku';

	

	if(empty($blad)){
		mysql_query("update myths_gracze set bank=bank-'".$_POST['wplac']."',zloto=zloto+'".$_POST['wplac']."' where gracz='".$oUser['gracz']."'");	
		$gra = $gra."<font color='grenn'>wypłacono<br></font>"; 
		header('location: gra.php?str=bank');		
	}

}}
$nast = $oUser['banknast']-time();


$gra = "
<div  style='background:url(img/dataBG.png); padding:10px'>
<center><font color='orange'><h2>Bank</h2></font>
					<div style='margin-bottom:10px'>nastempne rozliczenie za : <span id='t'></span>
					<script type='text/javascript'>liczCzas('t','".$nast."');</script>
					</div>

W banku możesz ulokować pieniądze dzięki czemu co godzine dostaniesz 5% kapitału dodatkowo<br>
<font color='gold'>w banku posiadasz: <b>".$oUser['bank']."$</b></font><br><br>

<form action='gra.php?str=bank' method='post'>
<font color='grenn'><b>wpłać</b></font><br><br>
<input type='text' name='wplac' value='".$oUser['zloto']."'/>
	    <input type='hidden' name='bezpiecznik1' value='ok'><br>
		<input type='submit' name='reg1' value='wpłać'/><br><br>
</form>

	
<form action='gra.php?str=bank' method='post'>
<font color='orange'><b>wypłać</b></font><br><br>
<input type='text' name='wplac' value='".$oUser['bank']."'/><br>
	    <input type='hidden' name='bezpiecznik2' value='ok'>
		<input type='submit' name='reg2' value='wypłać'/><br><br>
</form>
	
</div>
";
?>
