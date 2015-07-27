<?php
$misje = array();
$i = 0;


$i++;
$m->id = $i;
$m->nazwa = 'Obozowisko łotrów';
$m->opis = 'Rozgoń zbiorowisko łajdaków w pobliżu miasta';
$m->punkty = 1;
$m->zloto = 50;
$m->energia = 5;
$m->potwory = array(1,1,1,1,1,1,1,2,2,2,3,3,3,3);
$misje[$i] = $m;
unset($m);

$i++;
$m->id = $i;
$m->nazwa = 'Niekończące się zmagania';
$m->opis = 'Powstrzymaj atak na miasto';
$m->punkty = 3;
$m->zloto = 130;
$m->energia = 10;
$m->potwory = array(2,2,2,3,3,3,3,4,4,5,5);
$misje[$i] = $m;
unset($m);

$i++;
$m->id = $i;
$m->nazwa = 'Mroczne widmo';
$m->opis = 'Zwalcz sługi zła';
$m->punkty = 5;
$m->zloto = 300;
$m->energia = 20;
$m->potwory = array(3,3,3,3,4,4,5,5,6);
$misje[$i] = $m;
unset($m);



?>