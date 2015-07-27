<?php
$gra = "<div  style='background:url(img/dataBG.png); padding:10px'><center><font color='orange'>Edycja konta<br></font>"; 
###avatar
if(!empty($_FILES)){
	if ((($_FILES["avatar"]["type"] == "image/gif")
	|| ($_FILES["avatar"]["type"] == "image/jpeg")
	|| ($_FILES["avatar"]["type"] == "image/png")
	|| ($_FILES["avatar"]["type"] == "image/pjpeg"))
	&& ($_FILES["avatar"]["size"] < 1000000)) {
		if ($_FILES["avatar"]["blad"] == 0) {
			$blad = "poprawnie zzmieniono avatar";
			move_uploaded_file($_FILES["avatar"]["tmp_name"], "img/avatary/" . $oUser['gracz'].".jpg");
		} else $blad = "plik jest za duży";
	} else $blad = "plik jest niewłaściwy";
}
//edycja danych
if (isset($_POST['bezpiecznik']) && $_POST['bezpiecznik'] == "ok"){
if(!empty($_POST['reg'])){
	$_POST['email'] = filter_var(trim($_POST['email']), FILTER_SANITIZE_STRING);//filtrowanie trści
	$_POST['haslo'] = filter_var(trim($_POST['haslo']), FILTER_SANITIZE_STRING);
	$_POST['haslo2'] = filter_var(trim($_POST['haslo2']), FILTER_SANITIZE_STRING);

	if($_POST['email'] == $oUser['email']) $_POST['email'] = $_POST['email'];
	else{
		if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) $blad = "podaj poprawny adres mail!";
		else{
			$user = mysql_fetch_array(mysql_query("SELECT gracz,haslo FROM myths_gracze WHERE email = '".$_POST['email']."' LIMIT 1"));
			if(!empty($user['gracz'])) $blad = " e-mail jest zajęte";
		}
	}
	
	if(empty($_POST['haslo'])) $haslo = $user['haslo'];
	else{
		if(empty($_POST['haslo2'])) $blad = "podwtóż hasło!";
		elseif(strlen($_POST['haslo2']) < 5 || strlen($_POST['haslo2']) > 20) $blad = "pole hasła może zawierać od 5 do 20 znaków!";
		elseif($_POST['haslo'] != $_POST['haslo2']) $blad = "haasła różnią się od siebie!";
		else{
		$sol = 'wadsaAWsffafa134112';
		$haslo = sha1( $_POST['haslo'] . $sol );
		}
	
	}
	if(empty($blad)){
		mysql_query("update myths_gracze set email='".$_POST['email']."',haslo='".$haslo."' where gracz='".$oUser['gracz']."'");	
		$gra = $gra."<font color='grenn'>Zapisano zmiany<br></font>"; 	
	}

}}

$gra = $gra."
Zmień avatar:
<form enctype='multipart/form-data' action='gra.php?str=konto' method='POST'>
<input type='hidden' name='MAX_FILE_SIZE' value='100000' />
<input type='file' name='avatar' /> 
<input type='submit' name='submit' value='zmień avatar' />
</form>

<form action='gra.php?str=konto' method='post'>
<h3>edycja danych</h3>
	<table>
	<tr>
		<td>e-mail:</td>
		<td width='105px'><input type='text' name='email' value='".$oUser['email']."'/></td>
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
		<input type='submit' name='reg' value='zapisz'/>
</form>
";

?>
