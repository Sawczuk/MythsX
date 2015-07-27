<?php
$potwory = array();
$i = 0;


$i++;
$p->id = $i;
$p->nazwa = 'Rozbójnik';
$p->atak = 5;
$p->pancerz = 3;
$p->zycie = 10;
$potwory[$i] = $p;
unset($p);

$i++;
$p->id = $i;
$p->nazwa = 'Herszt złodzieji';
$p->atak = 8;
$p->pancerz = 3;
$p->zycie = 24;
$potwory[$i] = $p;
unset($p);

$i++;
$p->id = $i;
$p->nazwa = 'Wojownik';
$p->atak = 22;
$p->pancerz = 13;
$p->zycie = 40;
$potwory[$i] = $p;
unset($p);

$i++;
$p->id = $i;
$p->nazwa = 'Zabójca';
$p->atak = 20;
$p->pancerz = 30;
$p->zycie = 40;
$potwory[$i] = $p;
unset($p);

$i++;
$p->id = $i;
$p->nazwa = 'Czarny Rycerz';
$p->atak = 42;
$p->pancerz = 23;
$p->zycie = 74;
$potwory[$i] = $p;
unset($p);

$i++;
$p->id = $i;
$p->nazwa = 'Nieumarły';
$p->atak = 60;
$p->pancerz = 33;
$p->zycie = 40;
$potwory[$i] = $p;
unset($p);
?>