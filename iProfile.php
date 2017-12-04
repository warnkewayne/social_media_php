<?php //final/iProfile.php
session_start();
if(isset($_SESSION['userID']) == false|| $_SESSION['userID'] == null) {
  header('Location: index.php');
  return;
}

$id = $_GET['id'];

if($_SESSION['userID'] == $id){
  header("Location: profile.php?id=" . $id);
}


require 'header.php';


// User Posts!
require 'db.php';
$db = new DB();

    $stmt = $db->conn->prepare("SELECT * FROM posts WHERE user_id = ? ORDER BY id DESC");
              if(!$stmt) die("Prepare failed : " . $db->conn->error);
    $bind = $stmt->bind_param("i", $id);
              if(!$bind) die("Bind failed: " . $stmt->error);
    $execute = $stmt->execute();
              if(!$execute) die("Execute failed: " . $stmt->error);
    //$bindResult = $stmt->bind_result($content);
    $result = $stmt->get_result();
    $num_of_rows = $result->num_rows;

    $posts = [];

    while($row = $result->fetch_assoc()){
      $post[] = $row;
      //var_dump($post);
    }

    $stmt->free_result();

///////////////////////////////////////////////////////////////////////////////
    $sql = $db->conn->prepare("SELECT first_name, last_name, profile_picture FROM users WHERE id = ? ORDER BY id DESC");
          if(!$sql) die("Prepare failed : " . $db->conn->error);
    $bind = $sql->bind_param("i", $id);
          if(!$bind) die("Bind failed: " . $sql->error);
    $execute = $sql->execute();
          if(!$execute) die("Execute failed: " . $sql->error);
    $bindResult = $sql->bind_result($first_name, $last_name, $profile_pic);
    $sql->fetch();


    $sql->free_result();
//$db->conn->close();
 ?>

  <link rel="stylesheet" type="text/css" href="styles.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


<?php include "notification.php"; ?>


  <div id="photo_name">
    <img id="photo_name" height="500" width="1000" src="<?php echo $profile_pic; ?>"/>
    <p id="name"><?php echo $first_name; ?></p>
  </div>


  <div id="posts" style="margin-top:100px;">
    <!-- Div that is containing posts -->
    <ul id="posts">
      <?php foreach($post as $item){
        $comments = [];
        //die(var_dump($db->getCommentsForPost((int)$post['id'])));
        $comments = $db->getCommentsForPost((int)$item['id']);
        ?>
      <li id="single-post"><?php echo $item['content']; ?>
        <br />
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
                 <form method="post" action="insert-comment.php?post_id=<?php echo $item['id'] ?>">
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
