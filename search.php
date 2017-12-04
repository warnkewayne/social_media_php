<?php //final/search.php

session_start();
if(isset($_SESSION['userID']) == false|| $_SESSION['userID'] == null) {
  header('Location: index.php');
  return;
}

if(isset($_POST['search'])) header("Location:" . $_SERVER['HTTP_REFERER']);

require 'db.php';
$db = new DB();

$searchItem = $_POST['search'];



$search = $db->conn->prepare("SELECT first_name, last_name, id FROM users WHERE first_name=? || last_name=?");
  if(!$search) die("Prepare failed: " . $search->conn->error);

$bind = $search->bind_param("ss", $searchItem, $searchItem);
  if(!$bind) die("Bind failed: " . $search->error);

$execute = $search->execute();

$bindResult = $search->bind_result($first_name, $last_name, $id);
$search->fetch();

if($search){
  header("Location: search-result.php?id=$id&first_name=$first_name&last_name=$last_name");
}
