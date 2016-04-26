<?php
session_start();
$_SESSION = array();
session_destroy();
header('Location: http://localhost/suplencias');
echo "<script languaje='javascript' type='text/javascript'>window.close();</script>";
//header('Location: http://www.mp.gob.ve');

?>
