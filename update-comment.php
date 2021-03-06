<?php

session_start();
if(isset($_SESSION['userID']) == false|| $_SESSION['userID'] == null) {
  header('Location: index.php');
  return;
}

$editID = $_GET['id'];
$content = $_POST['content'];

require 'db.php';
$db = new DB();

$stmt = $db->conn->prepare("UPDATE comments SET content=? WHERE id=?");
  if(!$stmt) die("Prepare failed: " . $db->conn->error);
$bind = $stmt->bind_param("si", $content, $editID);
  if(!$bind) die("Bind failed: " . $stmt->error);
$execute = $stmt->execute();
  if(!$execute) die("Execute failed: " . $stmt->error);

  if($execute){
    header("Location: home.php?id=" . $_SESSION['userID']);
  } else {
    die('Could not update the comment: ' . $db->conn->error);
  }
