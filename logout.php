<?php
session_start();
$_SESSION = array();
session_destroy();
$msg = "logout";
$msg = urlencode($msg);
header("location: index.php?msg=$msg");
exit();
?>