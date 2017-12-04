<?php

// final/edit-post.php

session_start();
if(isset($_SESSION['userID']) == false|| $_SESSION['userID'] == null) {
  header('Location: index.php');
  return;
}


$postID = $_GET['id'];

if($postID==false){
  header('Location: profile.php?id=' . $_SESSION['userID']);
}

require 'db.php';
$db = new DB();

$stmt = $db->conn->prepare("SELECT content FROM posts WHERE id=?");
  if(!$stmt) die("Prepare failed: " . $db->conn->error);
$bind = $stmt->bind_param("i", $postID);
  if(!$bind) die("Bind failed: " . $stmt->error);
$execute = $stmt->execute();
  if(!$execute) die("Execute failed: " . $stmt->error);
$bindResult = $stmt->bind_result($content);
$stmt->fetch();

require 'header.php'
 ?>
<link rel="stylesheet" type="text/css" href="styles.css"/>
<div id="edit-post">
 <form id="edit-post" action="update-post.php?id=<?php echo $postID; ?>" method="post">
    <textarea id="edit-post" name="content" ><?php echo $content; ?></textarea>
    <button>Save</button>
 </form>
<!-- Delete comments of the post -->
</div>
