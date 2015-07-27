<?php
require_once('inc/system.php');
$_SESSION = array();
session_destroy();
header('location: index.php');
?>
