<?php

// final/profile.php
session_start();

if(isset($_SESSION['userID']) == false|| $_SESSION['userID'] == null) {
  header('Location: index.php');
  return;
}

require 'header.php';


// User Posts!
require 'db.php';
$db = new DB();
$id = $_SESSION['userID'];

$stmt = $db->conn->prepare("SELECT * FROM posts WHERE user_id = ? ORDER BY id DESC");
          if(!$stmt) die("Prepare failed : " . $db->conn->error);
$bind = $stmt->bind_param("i", $id);
          if(!$bind) die("Bind failed: " . $stmt->error);
$execute = $stmt->execute();
          if(!$execute) die("Execute failed: " . $stmt->error);
//$bindResult = $stmt->bind_result($content);
$result = $stmt->get_result();

$posts = [];

while($row = $result->fetch_assoc()){
  $posts[] = $row;
  // var_dump($row);
}


//$db->conn->close();
 ?>

 <link rel="stylesheet" type="text/css" href="styles.css"/>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


<?php include "notification.php"; ?>


 <div id="photo_name">
   <img id="photo_name" height="500" width="1000" src="<?php echo $_SESSION['profile_pic']; ?>"/>
   <p id="name"><?php echo $_SESSION['first_name']; ?></p>
 </div>

<div id="create-post">
  <form id="create-post" method="post" action="create-post.php">
    <textarea id="create-post" name="content" type="text" placeholder="Create a post..."></textarea> <button id="create-post">Create</button>
  </form>
</div>

 <div id="posts">
   <!-- Div that is containing posts -->
   <ul id="posts">
     <?php foreach($posts as $item){
       $comments = [];
       //die(var_dump($db->getCommentsForPost((int)$post['id'])));
       $comments = $db->getCommentsForPost((int)$item['id']);
       ?>
     <li id="single-post"><?php echo $item['content']; ?>
       <br />
       <br />
       <form id="update-post" action="<?php echo "edit-post.php?id=" . $item['id']; ?>" method="post">
         <button id="update-post">Edit</button>

       </form>
       <form id="delete-post" action="<?php echo "delete-post.php?id=" . $item['id'];?>"  method="post">
         <button id="delete-post">Delete</button>
       </form>
       <br />
       <!-- Comments -->
       <div class="comments">
          <input id="post-<?php echo $item['id'] ?>" class="toggle" type="checkbox"/>
          <label for="post-<?php echo $item['id'] ?>">Comments</label>
          <div class="expand">
            <ul class="ul">


              <?php
              if($comments!=false){
                  foreach($comments as $comment){ ?>
              <li class="li" id="post-<?php echo $item['id'] ?>"><?php echo $comment['content'] ?>
                  <?php if($comment['user_id'] == $_SESSION['userID'] || $item['user_id'] == $_SESSION['userID']){ ?>
                  <form class="delete-comment" action="delete-comment.php?id=<?php echo $comment['id'] ?>" method="post">
                    <button><i class="fa fa-close" style="font-size:12px;"></i></button>
                  </form>
                  <?php } ?>
                  <?php if($comment['user_id'] == $_SESSION['userID']){ ?>
                  <form class="edit-comment" action="edit-comment.php?id=<?php echo $comment['id'] ?>" method="post">
                    <button><i class="material-icons" style="font-size:12px;">mode_edit</i></button>
                  </form>
                <?php } ?>
              </li>
              <br />
              <?php }} ?>
       <!---------------->
              <li>
                <form class="create-comment" method="post" action="insert-comment.php?post_id=<?php echo $item['id'] ?>">
                  <input type="text" name="content"/><button class="create-comment">Post</button>
                </form>
              </li>
              <br />
            </ul>
          </div>
        </div>
       <!-- End Comments -->
     </li>
     <?php } ?>
   </ul>
 </div>

















<?php require 'footer.php'; ?>
 <!-- END OF FILE -->
