<?php
$gra = "<div  style='background:url(img/dataBG.png); padding:10px'><center><font color='orange'>Zarządzanie użytkownikami<br></font>"; 
 $_GET['akcja'] = filter_var(trim($_GET['akcja']), FILTER_SANITIZE_STRING);
	
	if(empty($_GET['akcja'])) $_GET['akcja'] = 'start';
	
	switch($_GET['akcja']){
		  
		case'start';
			$query = mysql_query("select * from myths_gracze ORDER BY gracz LIMIT 100");

				$gra = $gra."
					<table>
					<tr>
						<td width='150px'>login</td>
						<td width='150px'>e-mail</td>	
						<td></td>
						<td></td>
						<td></td>						
					</tr>";
					
				$row = 0;
				
				while($dane = mysql_fetch_array($query)){
					if($row==0) $style ='border-width: thin;border-style: solid;border-color: orange;background:#777777;';
					else $style ='border-width: thin;border-style: solid;border-color: orange;background:#444444;';
					if($dane['ranga'] == 3){
						$gra = $gra."
							<tr style='".$style."'>
								<td><font color='grenn'>".$dane['login']."</FONT></td>
								<td>".$dane['email']."</td>";
					}
					else{
						$gra = $gra."
							<tr style='".$style."'>
								<td>".$dane['login']."</FONT></td>
								<td>".$dane['email']."</td>";
					}
					if($dane['status'] == 1){
						$gra = $gra."
								<td><a href='admin-cp.php?str=gracze&akcja=banuj&id=".$dane['gracz']."'><font color='red'>Banuj</font></a></td>
								<td><a href='admin-cp.php?str=gracze&akcja=usun&id=".$dane['gracz']."'><font color='orange'>Usun</font></a></td>
								<td><a href='admin-cp.php?str=gracze&akcja=mianuj&id=".$dane['gracz']."'><font color='grenn'>Admin</font></a></td>
							</tr>
							";

					}
					else{
						$gra = $gra."
								<td><a href='admin-cp.php?str=gracze&akcja=odbanuj&id=".$dane['gracz']."'><font color='red'>Odbanuj</font></a></td>
								<td><a href='admin-cp.php?str=gracze&akcja=usun&id=".$dane['gracz']."'><font color='orange'>Usun</font></a></td>
								<td><a href='admin-cp.php?str=gracze&akcja=mianuj&id=".$dane['gracz']."'><font color='grenn'>Admin</font></a></td>
							</tr>
						";
					}
					$row = !$row;					
				}
				
				
				$gra = $gra."</table><hr/>";

			

		break;
		
		case'mianuj';
			$_GET['id'] = intval($_GET['id']);
			$gracz = mysql_fetch_array(mysql_query("SELECT gracz FROM myths_gracze WHERE gracz = '".$_GET['id']."' LIMIT 1"));
			if(!empty($gracz['gracz'])){
			mysql_query("update myths_gracze set ranga='3' WHERE gracz=".$gracz['gracz']);
			 header('location: admin-cp.php?str=gracze');
			}
			else header('location: admin-cp.php?str=gracze');
		break;

		case'usun';
			$_GET['id'] = intval($_GET['id']);
			$gracz = mysql_fetch_array(mysql_query("SELECT gracz FROM myths_gracze WHERE gracz = '".$_GET['id']."' LIMIT 1"));
			if(!empty($gracz['gracz'])){
			mysql_query("DELETE FROM myths_gracze WHERE gracz=".$gracz['gracz']);
			 header('location: admin-cp.php?str=gracze');
			}
			else header('location: admin-cp.php?str=gracze');
		break;
		
		case'banuj';
			$_GET['id'] = intval($_GET['id']);
			$gracz = mysql_fetch_array(mysql_query("SELECT gracz FROM myths_gracze WHERE gracz = '".$_GET['id']."' LIMIT 1"));
			if(!empty($gracz['gracz'])){
			if (isset($_POST['bezpiecznik']) && $_POST['bezpiecznik'] == "ok"){
				if(!empty($_POST['reg'])){
				
					$_POST['tresc'] = filter_var(trim($_POST['tresc']), FILTER_SANITIZE_STRING);
					
					if(empty($_POST['tresc'])) $blad = "napisz treść!";	
						
					if(empty($blad)){
						mysql_query("update myths_gracze set status='2',powodban='".$_POST['tresc']."' WHERE gracz =".$_GET['id']);	
									header('location: admin-cp.php?str=gracze&akcja=start');
					}
				}
			}
				$gra = $gra."

				<form action='admin-cp.php?str=gracze&akcja=banuj&id=".$_GET['id']."' method='post'>
				<h3>Banuj Użytkownika</h3>
					<center>
					<table>
						<tr>
							<td>powód:</td>
							<td><textarea style='width:400px' name='tresc'></textarea></td>
						</tr>
					</table>
				<input type='hidden' name='bezpiecznik' value='ok'>
				<input type='submit' name='reg' value='zbanuj'/>
			</form>
				</center>
			</div>";
			}
		break;
				
		case'odbanuj';
			$_GET['id'] = intval($_GET['id']);
			$gracz = mysql_fetch_array(mysql_query("SELECT gracz FROM myths_gracze WHERE gracz = '".$_GET['id']."' LIMIT 1"));
			if(!empty($gracz['gracz'])){
			mysql_query("update myths_gracze set status='1' WHERE gracz=".$gracz['gracz']);
			 header('location: admin-cp.php?str=gracze');
			}
			else header('location: admin-cp.php?str=gracze');
		break;
	}
?>