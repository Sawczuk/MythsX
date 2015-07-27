<?php
$gra = "<div  style='background:url(img/dataBG.png); padding:10px'><center><font color='orange'>Edytuj ustawienia gry<br></font>";
########################################################
		if (isset($_POST['bezpiecznik']) && $_POST['bezpiecznik'] == "ok"){
			if(!empty($_POST['reg'])){
				$query = mysql_query("select * from mythsx_ustawienia ORDER BY id  LIMIT 100");
				while($dane = mysql_fetch_array($query)){
					$wartosc = filter_var(trim($_POST[$dane['id']]), FILTER_SANITIZE_STRING);
					$id = intval($dane['id']);
					$zapytanie = "update mythsx_ustawienia set tresc='".$_POST[$dane['id']]."' where id =".$id;
					mysql_query($zapytanie);
				
				}
			}
				$gra = $gra."<font color='grenn'>Zmiany zostały zapisane poprawnie</font>";			
		}
########################################################
			$query = mysql_query("select * from mythsx_ustawienia ORDER BY id  LIMIT 100");
			if(mysql_num_rows($query)>0){
				$gra = $gra."
					<form action='admin-cp.php?str=ustawienia' method='post'>
					<table style='background:#777777;'>
				";
					
				
				while($dane = mysql_fetch_array($query)){
					$gra = $gra."
						<tr>
							<td width='150px'>".$dane['nazwa']."</td>
							<td width='250px'><input style='width:400px' type='text' name='".$dane['id']."' value='".$dane['tresc']."'/></td>			
						</tr>
						";
				}
				$gra = $gra."
						</table>
						<input type='hidden' name='bezpiecznik' value='ok'>
						<input type='submit' name='reg' value='zapisz'/>
						</form>
				";

			}

	

$gra = $gra."</div>";
?>