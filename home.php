<?php
// home.php
session_start();

if(isset($_SESSION['userID']) == false || $_SESSION['userID'] == null) {
  header('Location: index.php');
  return;
}

require 'header.php';


// recent posts
require 'db.php';
$db = new DB();

$result = $db->conn->query("SELECT * FROM posts ORDER BY id DESC");

$posts = [];
while($row = $result->fetch_assoc()) {
  $posts[]= $row;
}

$result->free_result();

//$db->conn->close();
 ?>

 <link rel="stylesheet" type="text/css" href="styles.css"/>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<?php include "notification.php"; ?>


 <div id="posts">
   <!-- Div that is containing posts -->
   <ul id="posts">
     <?php foreach($posts as $post){
       $comments = [];
       //die(var_dump($db->getCommentsForPost((int)$post['id'])));
       $comments = $db->getCommentsForPost((int)$post['id']);

       //die(var_dump($comments));

      ?>
     <li id="single-post"><?php echo $post['content']; ?>
       <br />
       <br />
       <!-- Comments -->
       <div class="comments">
          <input id="post-<?php echo $post['id'] ?>" class="toggle" type="checkbox"/>
          <label for="post-<?php echo $post['id'] ?>">Comments</label>
          <div class="expand">
            <ul class="ul">


              <?php
              if($comments!=false){
                  foreach($comments as $comment){ ?>
              <li class="li" id="post-<?php echo $post['id'] ?>"><?php echo $comment['content'] ?>
                  <?php if($comment['user_id'] == $_SESSION['userID'] || $post['user_id'] == $_SESSION['userID']){ ?>
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
                <form method="post" action="insert-comment.php?post_id=<?php echo $post['id'] ?>">
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
