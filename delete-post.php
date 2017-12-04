<?php

$postIdToDelete = $_GET['id'];

// delete post
require 'db.php';
$db = new DB();

$stmt = $db->deleteCommentsFromPost($postIdToDelete);

if($stmt!=null) $stmt->free_result();


$result = $db->conn->query("DELETE FROM posts WHERE id = $postIdToDelete");

// success!
if($result == true){
  header('Location: profile.php?id='. $_SESSION['userID']);
}
else {
  die("Could not insert post: " . $db->conn->error);
}
