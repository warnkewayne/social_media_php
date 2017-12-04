<?php
// final/register-user.php

// connect to DB
require 'db.php';
$db = new DB();

$email= md5($_POST['email']);

//$user = $db->queryOne("SELECT * FROM users WHERE email = '$_POST[email]'");

$user = $db->conn->prepare("SELECT id FROM users WHERE email=?");
        if(!$user) die("Prepare failed : " . $db->conn->error);

$bind = $user->bind_param("s", $email);
        if(!$bind) die("Bind failed: " . $user->error);

$execute = $user->execute();
        if(!$execute) die("Execute failed: " . $user->error);

$bResult = $user->bind_result($id);
$user->fetch();
/////////////////////////////////////////////////////////////////////////////////

// CHECK IF USER EXISTS

      if(!$id){
      $user->free_result();
        //$pw = md5($_POST['password']);
      //  $db->query("INSERT INTO users (name, email, aka, password)
                  //  VALUES('$_POST[name]','$_POST[email]','$_POST[aka]','$pw')");
      $statement = $db->conn->prepare("INSERT INTO users (first_name, last_name, email, password, profile_picture)
                            VALUES(?, ?, ? ,?, ?)");

                            if(!$statement) die("Prepare failed: " . $db->conn->error);

                            $first_name = $_POST['first_name'];
                            $last_name = $_POST['last_name'];
                            $email = md5($_POST['email']);
                            $password = md5($_POST['password']);
                            $profile_picture = "#";
                            $id = $_POST['id'];

      $bind1 = $statement->bind_param("sssss", $first_name, $last_name, $email, $password, $profile_picture);
                            if(!$bind1) die("Bind failed: " . $statement->error);

      $execute1 = $statement->execute();
                            if(!$execute1) die("Execute failed: " . $statement->error);

/////////////////////////////////////////////////////////////////////////////////////////////////

// TODO: Create Session!!!
session_start();
$_SESSION['first_name'] = $first_name;
$_SESSION['last_name'] = $last_name;
$_SESSION['email'] = $email;
$_SESSION['profile_pic'] = $profile_picture;
$_SESSION['userID'] = $id;

header('Location: home.php?id=' . $_SESSION['userID']);  // Individual's homepage
} else {
  //if user exists return to index.php
  //with message

header('Location: index.php?error=user_already_exists');
}


























// END of FILE
