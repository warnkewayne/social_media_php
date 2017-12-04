<?php

$editID = $_GET['id'];

if($editID==false){
  header("Location:" . $_SERVER['HTTP_REFERER']);
}

session_start();
if(isset($_SESSION['userID']) == false|| $_SESSION['userID'] == null) {
  header('Location: index.php');
  return;
}

require 'db.php';
$db = new DB();

$stmt = $db->conn->prepare("SELECT content FROM comments WHERE id=?");
  if(!$stmt) die("Prepare failed: " . $db->conn->error);
$bind = $stmt->bind_param("i", $editID);
  if(!$bind) die("Bind failed: " . $stmt->error);
$execute = $stmt->execute();
  if(!$execute) die("Execute failed: " . $stmt->error);
$bindResult = $stmt->bind_result($content);
$stmt->fetch();


require 'header.php';
 ?>

 <link rel="stylesheet" type="text/css" href="styles.css"/>
 <div id="edit-comment">
     <form id="edit-comment" action="update-comment.php?id=<?php echo $editID; ?>" method="post">
       <input id="edit-comment" name="content" style="width:300px;" type="text" value="<?php echo $content; ?>"/>
       <br />
       <br />
       <input id="submit-update" name="submit_update" type="submit" value="Save"/>
     </form>
</div>




<?php require 'footer.php'; ?>
