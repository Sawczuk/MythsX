<?php
$gra = "<div  style='background:url(img/dataBG.png); padding:10px'><center><font color='orange'>Poczta<br></font>
					<a href='gra.php?str=poczta'><font color='grenn'>odebarane</font></a> | <a href='gra.php?str=poczta&akcja=nowa'><font color='grenn'>Nowa wiadomość</font></a>
"; 
 $_GET['akcja'] = filter_var(trim($_GET['akcja']), FILTER_SANITIZE_STRING);
	
	if(empty($_GET['akcja'])) $_GET['akcja'] = 'start';
	
	switch($_GET['akcja']){
		  
		case'start';
			$query = mysql_query("select * from mythsx_poczta where do='".$oUser['gracz']."' ORDER BY id LIMIT 100");

				$gra = $gra."
					<table>
					<tr>
						<td width='150px'>temat</td>
						<td width='150px'>od</td>
						<td width='150px'>data</td>					
					</tr>";
					
				$row = 0;
				
				while($dane = mysql_fetch_array($query)){
					if($row==0) $style ='border-width: thin;border-style: solid;border-color: orange;background:#777777;';
					else $style ='border-width: thin;border-style: solid;border-color: orange;background:#444444;';
						if($dane['status'] == 1) $temat = "<font color='grenn'>".$dane['temat']."</font>";
						else $temat = $dane['temat'];
						
						$od = mysql_fetch_array(mysql_query("SELECT login FROM myths_gracze WHERE gracz = '".$dane['od']."' LIMIT 1"));

						$gra = $gra."
								<td><a href='gra.php?str=poczta&akcja=czytaj&id=".$dane['id']."'>".$temat."</a></td>
								<td>".$od['login']."</td>
								<td>".date( 'd.m.Y G:i:s' , $dane['data'] )."</td>
								</tr>
						";
					}
					$row = !$row;					
				
				
				
				$gra = $gra."</table><hr/>";

			

		break;
		
		case'czytaj';
			$_GET['id'] = intval($_GET['id']);
			$pw = mysql_fetch_array(mysql_query("SELECT * FROM mythsx_poczta WHERE do='".$oUser['gracz']."' and id=".$_GET['id']));
			$od = mysql_fetch_array(mysql_query("SELECT login FROM myths_gracze WHERE gracz = '".$pw['od']."'"));
			if(!empty($pw['id'])){
				$gra = $gra."
				<table style='width:450px;border-style: solid;border-color: orange;background:#777777;'>
					<tr>
						<td>".$od['login']."</td>
						<td>".date( 'd.m.Y G:i:s' , $pw['data'] )."</td>
					<tr>
					<tr>
						<td>temat</td>					
						<td> ".$pw['tresc']." </td>
					<tr>
					<tr>
						<td colspan='2'> ".$pw['tresc']." </td>
					</tr>
				</table>
					<a href='gra.php?str=poczta&akcja=usun&id=".$_GET['id']."'><font color='red'>usun</font></a> | <a href='gra.php?str=poczta&akcja=nowa&id=".$_GET['id']."'><font color='grenn'>odpowiedz</font></a>
				";
			
			
				mysql_query("update mythsx_poczta set status='2' WHERE do='".$oUser['gracz']."' and id=".$_GET['id']);

			}
		break;

		case'usun';
			$_GET['id'] = intval($_GET['id']);
			$pw = mysql_fetch_array(mysql_query("SELECT id FROM mythsx_poczta WHERE do='".$oUser['gracz']."' and id = '".$_GET['id']."' LIMIT 1"));
			if(!empty($pw['id'])){
			mysql_query("DELETE FROM mythsx_poczta WHERE id='".$_GET['id']."' and do='".$oUser['gracz']."'");
			header('location: gra.php?str=poczta');
			}
		break;
		
		case'nowa';
			if (isset($_POST['bezpiecznik']) && $_POST['bezpiecznik'] == "ok"){
			if(!empty($_POST['reg'])){
				$_POST['do'] = filter_var(trim($_POST['do']), FILTER_SANITIZE_STRING);
				$_POST['temat'] = filter_var(trim($_POST['temat']), FILTER_SANITIZE_STRING);
				$_POST['tresc'] = filter_var(trim($_POST['tresc']), FILTER_SANITIZE_STRING);
	
				if(empty($_POST['do'])) $blad = "podaj login!";
				elseif(strlen($_POST['do']) < 5 || strlen($_POST['do']) > 20) $blad = "pole login może zawierać od 5 do 20 znaków!";
				elseif(empty($_POST['temat'])) $blad = "wpisz hasło!";
				elseif(empty($_POST['tresc'])) $blad = "wpisz tresc!";
		

	
	
			if(empty($blad)){
				$user = mysql_fetch_array(mysql_query("SELECT gracz FROM myths_gracze WHERE login = '".$_POST['do']."'"));
				if(empty($user['gracz'])) $blad = "odbiorca nie istnieje";
				else {
					mysql_query("INSERT INTO mythsx_poczta set od='".$oUser['gracz']."',do='".$user['gracz']."',temat='".$_POST['temat']."',tresc='".$_POST['tresc']."',data=".time()."");	
					header('location: gra.php?str=poczta');
		}
	}
}
}

$gra = $gra."
<div  style='background:url(img/dataBG.png); padding:10px'>
<form action='gra.php?str=poczta&akcja=nowa' method='post'>
<h3>Napisz nową wiadomość</h3>
	<center>
			<table>
			<tr>
				<td>Do:</td>
				<td width='105px'><input type='text' name='do' value=''/></td>
			</tr>
			<tr>
				<td>Temat:</td>
				<td width='400px'><input style='width:400px;' type='text' name='temat' value=''/></td>
			</tr>
			<tr>
				<td>Treść:</td>
				<td><textarea style='width:400px' name='tresc'></textarea></td>
			</tr>
			</table>
	    <input type='hidden' name='bezpiecznik' value='ok'>
		<input type='submit' name='reg' value='napisz'/>
</form>
	</center>
</div>

";
		break;
		
	}
?>