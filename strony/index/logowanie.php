<?php
if (isset($_POST['bezpiecznik']) && $_POST['bezpiecznik'] == "ok"){
if(!empty($_POST['reg'])){
	$_POST['login'] = filter_var(trim($_POST['login']), FILTER_SANITIZE_STRING);
	$_POST['haslo'] = filter_var(trim($_POST['haslo']), FILTER_SANITIZE_STRING);
		$_SESSION = array();
		$sol = 'wadsaAWsffafa134112';
		$haslo = sha1( $_POST['haslo'] . $sol );
		$user = mysql_fetch_array(mysql_query("SELECT * FROM myths_gracze WHERE login = '".$_POST['login']."' AND haslo = '".$haslo."' LIMIT 1"));

	if(empty($_POST['login'])) $blad = "podaj login!";
	elseif(empty($_POST['login'])) $blad = "podaj login!";	
	elseif(empty($user['gracz'])) $blad = "Podane dane są błędne";
	elseif($user['status'] != 1) $blad = "Twoje konto zostało zbanowane.<br />Powód blokady:< br />".$user['powodban'];
	if(empty($blad)){
			$_SESSION['gracz'] = $user['gracz'];
			header('location: gra.php?str=postac');
		}
		
	}

}

$gra = "
<div  style='background:url(img/dataBG.png); padding:10px'>
<form action='index.php?str=logowanie' method='post'>
<h3>Logowanie</h3>
	<center>
	<table>
	<tr>
		<td>login:</td>
		<td width='105px'><input type='text' name='login' value=''/></td>
	</tr>
	<tr>
		<td>hasło:</td>
		<td><input type='password' name='haslo' value=''/></td>
	</tr>
	</table>
		<input type='hidden' name='bezpiecznik' value='ok'>
		<input type='submit' name='reg' value='zaloguj'/>
</form>
	</center>
</div>

";

?>
