<?php
require_once('inc/system.php');
if(empty($oUser['gracz'])) header('location: index.php');
if($oUser['pracaKoniec'] > 0) header('location: postac.php');



$start = (int)$_GET['start'];
if($start < 0) $start = 0;
$lp = $start+1;

$limit = 10;


$query = "
	SELECT * FROM myths_gracze
	ORDER BY punkty DESC
	LIMIT ".$start.", ".$limit."
";
$q = mysql_query($query);
$tabela = "
	<table>
	<tr align='center' style='background:url(img/dataBG.png);'>
		<td>Lp</td>
		<td>gracz</td>
		<td>punkty</td>
		<td>poziom</td>
	</tr>
";

$styl = false;
while($row = mysql_fetch_array($q)){
	$ok = 1;

	$styl = !$styl;
	if($styl == false) $styl2 = " style='background:url(img/dataBG.png);'";
	else $styl2 = "";
	$tabela .= "
	<tr ".$styl2.">
		<td>".$lp."</td>
		<td>".$row['login']."</td>
		<td align='center'>".$row['punkty']."</td>
		<td align='center'>".$row['poziom']."</td>
	</tr>

	";
	$lp++;
}
$tabela .= "</table><div>";

$max = mysql_num_rows(mysql_query("SELECT * FROM myths_gracze"));

$j= 0;
for($i = 0; $i < $max; $i = $i + $limit){
	$j++;
	$tabela .="<a href='ranking.php?start=".$i."'>[".($j)."]</a>";
}
$tabela .="</div>";

if(empty($ok)) {
	header('location: ranking.php');
}
$gra .= $tabela;

require_once('inc/szablon.php');

?>
