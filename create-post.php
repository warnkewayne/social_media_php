<?php

// final/create-post.php

session_start(); // check/open the session
if(isset($_SESSION['userID']) == false) {
  header('Location: index.php');
}
require 'db.php';
$db = new DB();

// Make an insert
$post = $_POST['content'];

$result = $db->conn->prepare("INSERT INTO posts(content, user_id) VALUES(?, $_SESSION[userID])");
        if(!$result) die("Prepare failed: " . $db->conn->error);
$bind = $result->bind_param("s", $post);
        if(!$bind) die("Bind failed: " . $result->error);
$execute = $result->execute();
        if(!$execute) die("Execute failed: " . $result->error);

        if($result == true){
          header('Location: profile.php?id=' . $_SESSION['userID']);
        }
        else {
          die("Could not insert post: " . $conn->error);
        }








































//END OF FILE
