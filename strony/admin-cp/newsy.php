<?php
  	$_GET['akcja'] = filter_var(trim($_GET['akcja']), FILTER_SANITIZE_STRING);
	
	if(empty($_GET['akcja'])) $_GET['akcja'] = 'start';
	
	$gra = "<div  style='background:url(img/dataBG.png); padding:10px'><center>
			<a href='admin-cp.php?str=newsy&akcja=start'><font color='orange'>Lista Newsów</font></a> | <a href='admin-cp.php?str=newsy&akcja=dodaj'><font color='orange'>Dodaj Nowy News</font></a>
	
	
	";
	
	switch($_GET['akcja']){
		  
		case'start';
			$query = mysql_query("select * from mythsx_nowosci ORDER BY data DESC LIMIT 100");
			if(mysql_num_rows($query)>0){
				$gra = $gra."
					<table>
					<tr>
						<td width='150px'>nazwa</td>
						<td width='150px'>data</td>	
						<td></td>
						<td></td>
					</tr>";
					
				$row = 0;
				
				while($dane = mysql_fetch_array($query)){
					if($row==0) $style ='border-width: thin;border-style: solid;border-color: orange;background:#777777;';
					else $style ='border-width: thin;border-style: solid;border-color: orange;background:#444444;';
					$gra = $gra."
						<tr style='".$style."'>
							<td>".$dane['nazwa']."</td>
							<td>".date( 'd.m.Y G:i:s' , $dane['data'] )."</td>
							<td><a href='admin-cp.php?str=newsy&akcja=edytuj&id=".$dane['id']."'><font color='grenn'>Edytuj</font></a></td>
							<td><a href='admin-cp.php?str=newsy&akcja=usun&id=".$dane['id']."'><font color='red'>Usun</font></a></td>
						</tr>
						<tr>	
							<td style='".$style."' colspan='4'>".substr($dane['tresc'], 0, 100)."</td>
						</tr>
						";
					$row = !$row;
				}
				$gra = $gra."</table><hr/>";

			}

		break;
		

		case'dodaj';
			if (isset($_POST['bezpiecznik']) && $_POST['bezpiecznik'] == "ok"){
				if(!empty($_POST['reg'])){
					$_POST['nazwa'] = filter_var(trim($_POST['nazwa']), FILTER_SANITIZE_STRING);
					$_POST['tresc'] = filter_var(trim($_POST['tresc']), FILTER_SANITIZE_STRING);
					if(empty($_POST['nazwa'])) $blad = "podaj nazwe!";
					if(empty($_POST['tresc'])) $blad = "napisz treść!";	
						
					if(empty($blad)){
						mysql_query("INSERT INTO mythsx_nowosci set nazwa='".$_POST['nazwa']."',tresc='".$_POST['tresc']."',data=".time()."");	
									header('location: admin-cp.php?str=newsy&akcja=start');
					}
				}
			}
				$gra = $gra."
				<form action='admin-cp.php?str=newsy&akcja=dodaj' method='post'>
				<h3>Dodaj Newsa</h3>
					<center>
					<table>
						<tr>
							<td>nazwa:</td>
							<td width='205px'><input style='width:400px' type='text' name='nazwa' value=''/></td>
						</tr>
						<tr>
							<td>treść:</td>
							<td><textarea style='width:400px' name='tresc'></textarea></td>
						</tr>
					</table>
				<input type='hidden' name='bezpiecznik' value='ok'>
				<input type='submit' name='reg' value='napisz'/>
			</form>
				</center>
			</div>";

		break;
		
		case'usun';
			$_GET['id'] = intval($_GET['id']);
			$news = mysql_fetch_array(mysql_query("SELECT id FROM mythsx_nowosci WHERE id = '".$_GET['id']."' LIMIT 1"));
			if(!empty($news['id'])){
			mysql_query("DELETE FROM mythsx_nowosci WHERE id=".$news['id']);
			 header('location: admin-cp.php?str=newsy');
			}
			else header('location: admin-cp.php?str=newsy');
		break;
		
		case'edytuj';
			$_GET['id'] = intval($_GET['id']);
			$news = mysql_fetch_array(mysql_query("SELECT * FROM mythsx_nowosci WHERE id = '".$_GET['id']."' LIMIT 1"));
			if(!empty($news['id'])){
			if (isset($_POST['bezpiecznik']) && $_POST['bezpiecznik'] == "ok"){
				if(!empty($_POST['reg'])){
					$_POST['nazwa'] = filter_var(trim($_POST['nazwa']), FILTER_SANITIZE_STRING);
					$_POST['tresc'] = filter_var(trim($_POST['tresc']), FILTER_SANITIZE_STRING);
					if(empty($_POST['nazwa'])) $blad = "podaj nazwe!";
					if(empty($_POST['tresc'])) $blad = "napisz treść!";	
						
					if(empty($blad)){
						mysql_query("update mythsx_nowosci set nazwa='".$_POST['nazwa']."',tresc='".$_POST['tresc']."' WHERE id =".$_GET['id']);	
									header('location: admin-cp.php?str=newsy&akcja=start');
					}
				}
			}
				$gra = $gra."

				<form action='admin-cp.php?str=newsy&akcja=edytuj&id=".$_GET['id']."' method='post'>
				<h3>Dodaj Newsa</h3>
					<center>
					<table>
						<tr>
							<td>nazwa:</td>
							<td width='205px'><input style='width:400px' type='text' name='nazwa' value='".$news['nazwa']."'/></td>
						</tr>
						<tr>
							<td>treść:</td>
							<td><textarea style='width:400px' name='tresc'>".$news['tresc']."</textarea></td>
						</tr>
					</table>
				<input type='hidden' name='bezpiecznik' value='ok'>
				<input type='submit' name='reg' value='napisz'/>
			</form>
				</center>
			</div>";

		break;
		
	}}
?>