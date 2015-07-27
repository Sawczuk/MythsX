<!doctype html>
<html>
<head>
    <meta charset="utf-8" />
</head>
<body>

<?php

define( 'DIR_CFG', 'inc/config.php' );


if( !isset( $_POST['send'] ) )
{

    print 'Ustaw chmoody na '.DIR_CFG.' <br/>  na folder w którym będzie się znajdować 777<br />
    <form name="connect_db" method="post" aciton="">
        <input type="text" name="host" placeholder="host" />
        <input type="text" name="user" placeholder="user" />
        <input type="text" name="pass" placeholder="password" />
        <input type="text" name="dbname" placeholder="dbname" />
        <input type="text" name="mail" placeholder="admin mail" />
        <input type="submit" name="send" />
    </form>';
    
}
else
{
    $config['db'] = $_POST;

    $link = mysql_connect( $config['db']['host'], $config['db']['user'], $config['db']['pass'] );
    $db_selected = mysql_select_db( $config['db']['dbname'], $link );
mysql_query("SET NAMES 'utf8'");
    if($link && $db_selected)
    {
     
$insert = "<?php
error_reporting(0);
\$config['db']['host'] = '".$config['db']['host']."';
\$config['db']['user'] = '".$config['db']['user']."';
\$config['db']['pass'] = '".$config['db']['pass']."';
\$config['db']['dbname'] = '".$config['db']['dbname']."';

\$config['register'] = false;

\$adminMail = '".$config['db']['mail']."';

\$connect = mysql_connect(\$config['db']['host'], \$config['db']['user'], \$config['db']['pass']) or die('błąd połączenia z bazą') ;
mysql_select_db(\$config['db']['dbname'],\$connect) or die('błąd połączenia z bazą');
mysql_query(\"SET NAMES 'utf8'\") or die('błąd połączenia z bazą');

?>";
        
        file_put_contents( DIR_CFG, $insert );
        
   mysql_query("
CREATE TABLE `mythsx_nowosci` (
  `id` int(3) NOT NULL auto_increment,
  `nazwa` varchar(80) NOT NULL,
  `data` int(20) NOT NULL,
  `tresc` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;");      



   mysql_query("INSERT INTO `mythsx_nowosci` VALUES (5, 'Zakończenie prób', 1419537351, 'informujemy że otworzyliśmy rejestracje');");  
   mysql_query("INSERT INTO `mythsx_nowosci` VALUES (6, 'Dodano bank', 1419537386, 'Miło nam poinformować że dodaliśmy bank !!');");  




   mysql_query("CREATE TABLE `mythsx_poczta` (
  `id` int(11) NOT NULL auto_increment,
  `od` varchar(6) NOT NULL,
  `do` varchar(6) NOT NULL,
  `data` int(30) NOT NULL,
  `temat` varchar(50) NOT NULL,
  `tresc` text NOT NULL,
  `status` int(1) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;");  



   mysql_query("CREATE TABLE `mythsx_ustawienia` (
  `id` int(3) NOT NULL,
  `nazwa` varchar(50) NOT NULL,
  `tresc` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;");  


   mysql_query("INSERT INTO `mythsx_ustawienia` VALUES (1, 'nazwa', 'MythsX 1.0');");  
   mysql_query("INSERT INTO `mythsx_ustawienia` VALUES (2, 'opis na stronie', 'opis gry na stronie gł');");  
   mysql_query("INSERT INTO `mythsx_ustawienia` VALUES (3, 'opis dla google', 'opis gry w sekcji hed');");  


   mysql_query("CREATE TABLE `myths_gracze` (
  `gracz` int(11) NOT NULL auto_increment,
  `login` varchar(20) character set utf8 collate utf8_unicode_ci NOT NULL,
  `email` varchar(60) NOT NULL,
  `haslo` varchar(50) character set utf8 collate utf8_unicode_ci NOT NULL,
  `ranga` int(1) NOT NULL default '1',
  `status` int(11) NOT NULL default '1',
  `powodban` text NOT NULL,
  `bank` int(11) NOT NULL default '0',
  `bankczas` int(20) NOT NULL default '0',
  `banknast` int(20) NOT NULL default '0',
  `exp` int(11) NOT NULL,
  `expMax` int(11) NOT NULL default '25',
  `punkty` int(11) NOT NULL default '0',
  `poziom` int(11) NOT NULL default '1',
  `pum` int(11) NOT NULL default '0',
  `przedmioty` text character set utf8 collate utf8_unicode_ci NOT NULL,
  `atak` int(11) NOT NULL default '3',
  `pancerz` int(11) NOT NULL default '3',
  `zycie` int(11) NOT NULL default '10',
  `energia` int(11) NOT NULL default '100',
  `regeneracja` int(11) NOT NULL,
  `zloto` bigint(20) NOT NULL default '100',
  `helm` int(11) NOT NULL default '0',
  `zbroja` int(11) NOT NULL default '0',
  `bron` int(11) NOT NULL default '0',
  `tarcza` int(11) NOT NULL default '0',
  `buty` int(11) NOT NULL,
  `pierscien` int(11) NOT NULL default '0',
  `amulet` int(11) NOT NULL default '0',
  `praca` int(11) NOT NULL default '0',
  `pracaStart` int(11) NOT NULL default '0',
  `pracaKoniec` int(11) NOT NULL default '0',
  `monety` int(11) NOT NULL default '0',
  PRIMARY KEY  (`gracz`),
  UNIQUE KEY `login` (`login`),
  KEY `punkty` (`punkty`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;");  


   mysql_query("INSERT INTO `myths_gracze` VALUES (7, 'admin', 'degolapl@gmail.com', '76df5e41a66cd2d922becb2b05f5918a8dbcb0bd', 3, 1, '', 0, 1419536949, 1419540549, 0, 25, 0, 1, 10, '', 3, 3, 10, 100, 1419536949, 100, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);");  
   mysql_query("INSERT INTO `myths_gracze` VALUES (8, 'demo1', 'demo@demo.pl', 'c89f5e1a7c9856ba14a2397145b469bcb3ea270c', 1, 1, '', 0, 1419537009, 1419540609, 0, 25, 0, 1, 10, '', 3, 3, 10, 100, 1419537009, 100, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);");  

        print 'Sukces, usuń instalator.php';
        
    }
    else
    {
        
        print 'Nie połączono z bazą';
        
    }
    
}

?></body></html>