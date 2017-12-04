<?php

require 'db.php';
$db = new DB();

$deleteID = $_GET['id'];
$delete = $db->conn->prepare("DELETE FROM comments WHERE id = ?");
  if(!$delete) die("Prepare failed: " . $db->conn->error);
$bind = $delete->bind_param("i", $deleteID);
  if(!$bind) die("Bind failed: " . $delete->error);
$execute = $delete->execute();
  if(!$execute) die("Execute failed: " . $delete->error);

if($execute == true) {

    $delete->free_result();
    $stmt = $db->query("DELETE FROM posts_comments WHERE comment_id = $deleteID");


  header("Location:" . $_SERVER['HTTP_REFERER']);
} else {
  echo "Could not delete comment: " . $db->error;
}


























// END OF FILE
