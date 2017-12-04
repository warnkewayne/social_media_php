<?php // final/search-result.php

session_start();
if(isset($_SESSION['userID']) == false|| $_SESSION['userID'] == null) {
  header('Location: index.php');
  return;
}

$id = $_GET['id'];
$first_name = $_GET['first_name'];
$last_name = $_GET['last_name'];

if(!$id) header("Location:" . $_SERVER['HTTP_REFERER']);


require 'header.php';
 ?>

<div id="search-result">
 <ul id="search-result">
   <li><a href="<?php echo "iProfile.php?id=" . $id;  ?>"><?php echo $first_name," ", $last_name; ?></a></li>
   <hr />
   <li>Example Search Result</li>
   <hr />
   <li>Example Search Result</li>
   <hr />
   <li>Example Search Result</li>
   <hr />
   <li>Example Search Result</li>
   <hr />
  </ul>
</div>





<?php require 'footer.php' ?>
