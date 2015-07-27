<?php
if (isset($_POST['bezpiecznik']) && $_POST['bezpiecznik'] == "ok"){//jesli wszystko ok
if(!empty($_POST['reg'])){
	$_POST['login'] = filter_var(trim($_POST['login']), FILTER_SANITIZE_STRING);//filtrowanie
	$_POST['email'] = filter_var(trim($_POST['email']), FILTER_SANITIZE_STRING);
	$_POST['haslo'] = filter_var(trim($_POST['haslo']), FILTER_SANITIZE_STRING);
	$_POST['haslo2'] = filter_var(trim($_POST['haslo2']), FILTER_SANITIZE_STRING);
//sprawdzanie popraawności danych
	if(empty($_POST['login'])) $blad = "podaj login!";
	elseif(strlen($_POST['login']) < 5 || strlen($_POST['login']) > 20) $blad = "pole login może zawierać od 5 do 20 znaków!";
	elseif(empty($_POST['haslo'])) $blad = "podaj hasło!";
	elseif(strlen($_POST['haslo']) < 5 || strlen($_POST['haslo']) > 20) $blad = "pole hasła może zawierać od 5 do 20 znaków!";
	elseif(empty($_POST['haslo2'])) $blad = "podaj hasło!";
	elseif(strlen($_POST['haslo2']) < 5 || strlen($_POST['haslo2']) > 20) $blad = "pole hasła może zawierać od 5 do 20 znaków!";
	elseif($_POST['haslo'] != $_POST['haslo2']) $blad = "podaj poprawne hasło!";
	elseif(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) $blad = "podaj poprawny adres mail!";
	
	
	if(empty($blad)){
		$_SESSION = array();
		$user = mysql_fetch_array(mysql_query("SELECT * FROM myths_gracze WHERE login = '".$_POST['login']."' AND email = '".$_POST['email']."' LIMIT 1"));
		if(!empty($user['gracz'])) $blad = "login lub e-mail jest zajęte";
		else {
			$_SESSION = array();
			$sol = 'wadsaAWsffafa134112';
			$haslo = sha1( $_POST['haslo'] . $sol );
			mysql_query("INSERT INTO myths_gracze set login='".$_POST['login']."',email='".$_POST['email']."',haslo='".$haslo."',regeneracja=".time().",pum='10'");	
			$user = mysql_fetch_array(mysql_query("SELECT * FROM myths_gracze WHERE login = '".$_POST['login']."' AND email = '".$_POST['email']."' LIMIT 1"));
			$_SESSION['gracz'] = $user['gracz'];
			header('location: gra.php?str=postac');
		}
	}
}
}

$gra = "
<div  style='background:url(img/dataBG.png); padding:10px'>
<form action='index.php?str=rejestracja' method='post'>
<h3>Rejestracja</h3>
	<center>
	<table>
	<tr>
		<td>login:</td>
		<td width='105px'><input type='text' name='login' value=''/></td>
	</tr>
	<tr>
		<td>e-mail:</td>
		<td width='105px'><input type='text' name='email' value=''/></td>
	</tr>
	<tr>
		<td>hasło:</td>
		<td><input type='password' name='haslo' value=''/></td>
	</tr>
	<tr>
		<td>powtórz:</td>
		<td><input type='password' name='haslo2' value=''/></td>
	</tr>
	</table>
	    <input type='hidden' name='bezpiecznik' value='ok'>
		<input type='submit' name='reg' value='załóż konto'/>
</form>
	</center>
</div>

";

?>
