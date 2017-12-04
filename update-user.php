<?php

session_start();
if(isset($_SESSION['userID']) == false|| $_SESSION['userID'] == null) {
  header('Location: index.php');
  return;
}


require 'db.php';
$db = new DB();

      $first_name = $_POST['first_name'];
      $last_name = $_POST['last_name'];
      $profile_picture = $_POST['profile_picture'];
      $id = $_SESSION['userID'];


$statement = $db->conn->prepare("UPDATE users SET first_name=?, last_name=?, profile_picture=? WHERE id=$id");
  if(!$statement) die("Prepare failed: " . $db->conn->error);
$bind = $statement->bind_param("sss", $first_name, $last_name, $profile_picture);
  if(!$bind) die("Bind failed: " . $statement->error);
$execute = $statement->execute();
  if(!$execute) die("Execute failed: " . $statement->error);


  if($execute) {
    $_SESSION['first_name'] = $first_name;
    $_SESSION['last_name'] = $last_name;
    $_SESSION['profile_pic'] = $profile_picture;

    header('Location: profile.php?id=' . $_SESSION['userID']);
  } else {
    die('Could not update user: ' . $db->conn->error);
  }
