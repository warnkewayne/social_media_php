<?php


require 'db.php';
$db = new DB();

$deleteID = $_GET['id'];
$delete = $db->conn->prepare("DELETE FROM users WHERE id = ?");
  if(!$delete) die("Prepare failed: " . $db->conn->error);
$bind = $delete->bind_param("i", $deleteID);
  if(!$bind) die("Bind failed: " . $delete->error);
$execute = $delete->execute();
  if(!$execute) die("Execute failed: " . $delete->error);

if($execute == true) {
  session_destroy();
  $_SESSION = array();

$delete->free_result();
$stmt = $db->query("DELETE FROM posts WHERE user_id = $deleteID");


  header("Location: index.php");
} else {
  echo "Could not delete user: " . $db->error;
}
