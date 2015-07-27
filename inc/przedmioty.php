<?php
$przedmioty = array();
$i = 0;


$i++;
$p->id = $i;
$p->nazwa = 'Toporek';
$p->typ = 'bron';
$p->energia = 0;
$p->atak = 2;
$p->pancerz = 0;
$p->zycie = 0;
$p->cena = 100;
$p->wartosc = floor($p->cena * 0.70);
$p->punkty = 0;
if($oUser['punkty'] >= $p->punkty)	$przedmioty[$i] = $p;
unset($p);


$i++;
$p->id = $i;
$p->nazwa = 'Sztylety';
$p->typ = 'bron';
$p->energia = 0;
$p->atak = 3;
$p->pancerz = 0;
$p->zycie = 0;
$p->cena = 150;
$p->wartosc = floor($p->cena * 0.70);
$p->punkty = 0;
if($oUser['punkty'] >= $p->punkty)	$przedmioty[$i] = $p;
unset($p);


$i++;
$p->id = $i;
$p->nazwa = 'Krótki miecz';
$p->typ = 'bron';
$p->energia = 0;
$p->atak = 5;
$p->pancerz = 0;
$p->zycie = 0;
$p->cena = 250;
$p->wartosc = floor($p->cena * 0.70);
$p->punkty = 0;
if($oUser['punkty'] >= $p->punkty)	$przedmioty[$i] = $p;
unset($p);


$i++;
$p->id = $i;
$p->nazwa = 'Tasak';
$p->typ = 'bron';
$p->energia = 0;
$p->atak = 10;
$p->pancerz = 0;
$p->zycie = 0;
$p->cena = 500;
$p->wartosc = floor($p->cena * 0.70);
$p->punkty = 5;
if($oUser['punkty'] >= $p->punkty)	$przedmioty[$i] = $p;
unset($p);


$i++;
$p->id = $i;
$p->nazwa = 'Zatrute sztylety';
$p->typ = 'bron';
$p->energia = 0;
$p->atak = 20;
$p->pancerz = 0;
$p->zycie = 0;
$p->cena = 1000;
$p->wartosc = floor($p->cena * 0.70);
$p->punkty = 10;
if($oUser['punkty'] >= $p->punkty)	$przedmioty[$i] = $p;
unset($p);


$i++;
$p->id = $i;
$p->nazwa = 'Długi miecz';
$p->typ = 'bron';
$p->energia = 0;
$p->atak = 25;
$p->pancerz = 0;
$p->zycie = 0;
$p->cena = 1500;
$p->wartosc = floor($p->cena * 0.70);
$p->punkty = 25;
if($oUser['punkty'] >= $p->punkty)	$przedmioty[$i] = $p;
unset($p);


$i++;
$p->id = $i;
$p->nazwa = 'Katana';
$p->typ = 'bron';
$p->energia = 0;
$p->atak = 50;
$p->pancerz = 0;
$p->zycie = 0;
$p->cena = 10000;
$p->wartosc = floor($p->cena * 0.70);
$p->punkty = 50;
if($oUser['punkty'] >= $p->punkty)	$przedmioty[$i] = $p;
unset($p);


$i++;
$p->id = $i;
$p->nazwa = 'Ogromny miecz';
$p->typ = 'bron';
$p->energia = 0;
$p->atak = 60;
$p->pancerz = 0;
$p->zycie = 0;
$p->cena = 15000;
$p->wartosc = floor($p->cena * 0.70);
$p->punkty = 100;
if($oUser['punkty'] >= $p->punkty)	$przedmioty[$i] = $p;
unset($p);


$i++;
$p->id = $i;
$p->nazwa = 'Zaklęte ostrze';
$p->typ = 'bron';
$p->energia = 0;
$p->atak = 100;
$p->pancerz = 0;
$p->zycie = 0;
$p->cena = 25000;
$p->wartosc = floor($p->cena * 0.70);
$p->punkty = 100;
if($oUser['punkty'] >= $p->punkty)	$przedmioty[$i] = $p;
unset($p);


$i++;
$p->id = $i;
$p->nazwa = 'Drewniana tarcza';
$p->typ = 'tarcza';
$p->energia = 0;
$p->atak = 0;
$p->pancerz = 10;
$p->zycie = 0;
$p->cena = 500;
$p->wartosc = floor($p->cena * 0.70);
$p->punkty = 0;
if($oUser['punkty'] >= $p->punkty)	$przedmioty[$i] = $p;
unset($p);


$i++;
$p->id = $i;
$p->nazwa = 'Puklerz';
$p->typ = 'tarcza';
$p->energia = 0;
$p->atak = 0;
$p->pancerz = 20;
$p->zycie = 0;
$p->cena = 1000;
$p->wartosc = floor($p->cena * 0.70);
$p->punkty = 5;
if($oUser['punkty'] >= $p->punkty)	$przedmioty[$i] = $p;
unset($p);


$i++;
$p->id = $i;
$p->nazwa = 'Tarcza';
$p->typ = 'tarcza';
$p->energia = 0;
$p->atak = 0;
$p->pancerz = 40;
$p->zycie = 0;
$p->cena = 2500;
$p->wartosc = floor($p->cena * 0.70);
$p->punkty = 20;
if($oUser['punkty'] >= $p->punkty)	$przedmioty[$i] = $p;
unset($p);


$i++;
$p->id = $i;
$p->nazwa = 'Tarcza rycerska';
$p->typ = 'tarcza';
$p->energia = 0;
$p->atak = 0;
$p->pancerz = 50;
$p->zycie = 0;
$p->cena = 5000;
$p->wartosc = floor($p->cena * 0.70);
$p->punkty = 50;
if($oUser['punkty'] >= $p->punkty)	$przedmioty[$i] = $p;
unset($p);


$i++;
$p->id = $i;
$p->nazwa = 'Tarcza niebios';
$p->typ = 'tarcza';
$p->energia = 0;
$p->atak = 0;
$p->pancerz = 75;
$p->zycie = 100;
$p->cena = 20000;
$p->wartosc = floor($p->cena * 0.70);
$p->punkty = 100;
if($oUser['punkty'] >= $p->punkty)	$przedmioty[$i] = $p;
unset($p);



$i++;
$p->id = $i;
$p->nazwa = 'Kaptur';
$p->typ = 'helm';
$p->energia = 0;
$p->atak = 0;
$p->pancerz = 2;
$p->zycie = 0;
$p->cena = 50;
$p->wartosc = floor($p->cena * 0.70);
$p->punkty = 0;
if($oUser['punkty'] >= $p->punkty)	$przedmioty[$i] = $p;
unset($p);



$i++;
$p->id = $i;
$p->nazwa = 'Hełm';
$p->typ = 'helm';
$p->energia = 0;
$p->atak = 0;
$p->pancerz = 10;
$p->zycie = 0;
$p->cena = 400;
$p->wartosc = floor($p->cena * 0.70);
$p->punkty = 5;
if($oUser['punkty'] >= $p->punkty)	$przedmioty[$i] = $p;
unset($p);




$i++;
$p->id = $i;
$p->nazwa = 'Hełm rycerski';
$p->typ = 'helm';
$p->energia = 0;
$p->atak = 0;
$p->pancerz = 25;
$p->zycie = 0;
$p->cena = 5000;
$p->wartosc = floor($p->cena * 0.70);
$p->punkty = 25;
if($oUser['punkty'] >= $p->punkty)	$przedmioty[$i] = $p;
unset($p);



$i++;
$p->id = $i;
$p->nazwa = 'Płachta';
$p->typ = 'zbroja';
$p->energia = 0;
$p->atak = 0;
$p->pancerz = 5;
$p->zycie = 20;
$p->cena = 1250;
$p->wartosc = floor($p->cena * 0.70);
$p->punkty = 10;
if($oUser['punkty'] >= $p->punkty)	$przedmioty[$i] = $p;
unset($p);



$i++;
$p->id = $i;
$p->nazwa = 'Zbroja skórzana';
$p->typ = 'zbroja';
$p->energia = 0;
$p->atak = 0;
$p->pancerz = 10;
$p->zycie = 40;
$p->cena = 2500;
$p->wartosc = floor($p->cena * 0.70);
$p->punkty = 10;
if($oUser['punkty'] >= $p->punkty)	$przedmioty[$i] = $p;
unset($p);



$i++;
$p->id = $i;
$p->nazwa = 'Kolczuga';
$p->typ = 'zbroja';
$p->energia = 0;
$p->atak = 0;
$p->pancerz = 20;
$p->zycie = 80;
$p->cena = 5000;
$p->wartosc = floor($p->cena * 0.70);
$p->punkty = 20;
if($oUser['punkty'] >= $p->punkty)	$przedmioty[$i] = $p;
unset($p);



$i++;
$p->id = $i;
$p->nazwa = 'Zbroja płytowa';
$p->typ = 'zbroja';
$p->energia = 0;
$p->atak = 0;
$p->pancerz = 50;
$p->zycie = 200;
$p->cena = 15000;
$p->wartosc = floor($p->cena * 0.70);
$p->punkty = 40;
if($oUser['punkty'] >= $p->punkty)	$przedmioty[$i] = $p;
unset($p);



$i++;
$p->id = $i;
$p->nazwa = 'Zbroja tytanów';
$p->typ = 'zbroja';
$p->energia = 0;
$p->atak = 0;
$p->pancerz = 50;
$p->zycie = 500;
$p->cena = 25000;
$p->wartosc = floor($p->cena * 0.70);
$p->punkty = 50;
if($oUser['punkty'] >= $p->punkty)	$przedmioty[$i] = $p;
unset($p);



$i++;
$p->id = $i;
$p->nazwa = 'Buty';
$p->typ = 'buty';
$p->energia = 0;
$p->atak = 0;
$p->pancerz = 2;
$p->zycie = 0;
$p->cena = 100;
$p->wartosc = floor($p->cena * 0.70);
$p->punkty = 0;
if($oUser['punkty'] >= $p->punkty)	$przedmioty[$i] = $p;
unset($p);



$i++;
$p->id = $i;
$p->nazwa = 'Nagolennice';
$p->typ = 'buty';
$p->energia = 0;
$p->atak = 0;
$p->pancerz = 10;
$p->zycie = 0;
$p->cena = 1000;
$p->wartosc = floor($p->cena * 0.70);
$p->punkty = 10;
if($oUser['punkty'] >= $p->punkty)	$przedmioty[$i] = $p;
unset($p);



$i++;
$p->id = $i;
$p->nazwa = 'Nagollennice wędrowca';
$p->typ = 'buty';
$p->energia = 0;
$p->atak = 0;
$p->pancerz = 20;
$p->zycie = 0;
$p->cena = 5000;
$p->wartosc = floor($p->cena * 0.70);
$p->punkty = 20;
if($oUser['punkty'] >= $p->punkty)	$przedmioty[$i] = $p;
unset($p);



$i++;
$p->id = $i;
$p->nazwa = 'Pierścień siły';
$p->typ = 'pierscien';
$p->energia = 0;
$p->atak = 20;
$p->pancerz = 0;
$p->zycie = 0;
$p->cena = 5000;
$p->wartosc = floor($p->cena * 0.70);
$p->punkty = 10;
if($oUser['punkty'] >= $p->punkty)	$przedmioty[$i] = $p;
unset($p);



$i++;
$p->id = $i;
$p->nazwa = 'Pierścień witalności';
$p->typ = 'pierscien';
$p->energia = 0;
$p->atak = 0;
$p->pancerz = 0;
$p->zycie = 100;
$p->cena = 5000;
$p->wartosc = floor($p->cena * 0.70);
$p->punkty = 20;
if($oUser['punkty'] >= $p->punkty)	$przedmioty[$i] = $p;
unset($p);



$i++;
$p->id = $i;
$p->nazwa = 'Amulet witalności';
$p->typ = 'amulet';
$p->energia = 0;
$p->atak = 0;
$p->pancerz = 0;
$p->zycie = 100;
$p->cena = 10000;
$p->wartosc = floor($p->cena * 0.70);
$p->punkty = 10;
if($oUser['punkty'] >= $p->punkty)	$przedmioty[$i] = $p;
unset($p);



$i++;
$p->id = $i;
$p->nazwa = 'Wisior zdobywcy';
$p->typ = 'amulet';
$p->energia = 0;
$p->atak = 50;
$p->pancerz = 0;
$p->zycie = 0;
$p->cena = 25000;
$p->wartosc = floor($p->cena * 0.70);
$p->punkty = 20;
if($oUser['punkty'] >= $p->punkty)	$przedmioty[$i] = $p;
unset($p);
?>