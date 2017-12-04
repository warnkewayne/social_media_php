<?php

session_start();

if(isset($_SESSION['userID']) == false) {
  header('Location: index.php');
  return;
}

session_destroy();
$_SESSION = array();
header("Location: index.php");
