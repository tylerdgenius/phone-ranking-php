<?php 
session_start();

$_SESSION = [];

session_destroy();

header("Location: home");

exit;

?>