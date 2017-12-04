<?php
// final/update-user.php

session_start();
if(isset($_SESSION['userID']) == false|| $_SESSION['userID'] == null) {
  header('Location: index.php');
  return;
}

require 'header.php';
 ?>
<link rel="stylesheet" type="text/css" href="styles.css"/>
<div id="edit-user">
    <form id="edit-user" action="update-user.php" method="post">
      <label for="first_name">First Name:</label>
      <input name="first_name" style="width:300px;" type="text" value="<?php echo $_SESSION['first_name']; ?>"/>
      <br />
      <label for="last_name">Last Name:</label>
      <input name="last_name" style="width:300px;" type="text" value="<?php echo $_SESSION['last_name']; ?>"/>
      <br />
      <label for="profile_picture">Profile Picture Link:</label>
      <input name="profile_picture" style="width:300px;" type="text" value="<?php echo $_SESSION['profile_pic']; ?>"/>
      <br />
      <input id="submit-update" name="submit_update" type="submit" value="Save"/>
    </form>
<form action="<?php echo "delete-user.php?id=" . $_SESSION['userID'] ?>" method="post">
  <button>Delete Account</button>
</form>
</div>
