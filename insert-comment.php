<?php



// final/insert-comment.php
session_start(); // check/open the session
if(isset($_SESSION['userID']) == false) {
  header('Location: index.php');
}

$postID = $_GET['post_id'];

require 'db.php';
$db = new DB();

  $content = $_POST['content'];

  $stmt = $db->conn->prepare("INSERT INTO comments(content,user_id) VALUES(?, $_SESSION[userID])");
      if(!$stmt) die("Prepare failed: " . $db->conn->error);
  $bind = $stmt->bind_param("s", $content);
      if(!$bind) die("Bind failed: " . $stmt->error);
  $execute = $stmt->execute();
      if(!$execute) die("Execute failed: " . $stmt->error);

  $stmt->free_result();

  if(!$stmt) {
   die("Could not insert your comment: " . $conn->error);
  }

  $commentID = $db->conn->insert_id;

  $result = $db->conn->prepare("INSERT INTO posts_comments(post_id,comment_id) VALUES(?,?)");
    if(!$result) die("Prepare failed: " . $db->conn->error);
  $bind = $result->bind_param("ii", $postID,$commentID);
    if(!$bind) die("Bind failed: " . $result->error);
  $execute = $result->execute();
    if(!$execute) die("Execute failed: " . $result->error);

    if($result == true) {
      header("Location:" . $_SERVER['HTTP_REFERER']);
    } else {
        die("Could not insert your comment: " . $conn->error);
      }
