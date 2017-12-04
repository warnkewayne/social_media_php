<?php

require 'db.php';

$db = new DB();

$email = md5($_POST['email']);
$password = md5($_POST['password']);

//find user
$user = $db->conn->prepare("SELECT * FROM users WHERE email=?");
        if(!$user) die("Prepare failed : " . $db->conn->error);

$bind = $user->bind_param("s", $email);
        if(!$bind) die("Bind failed: " . $user->error);

$execute = $user->execute();
        if(!$execute) die("Execute failed: " . $user->error);

$bResult = $user->bind_result($first_name,$last_name,$em,$pw,$profile_pic,$userID);
$user->fetch();


if(isset($_POST['submit']) == false) {
  header('Location: index.php?error=not_from_login');
  //redirects user to login.php with error Query
  return;
}
//check if sent a username and password
if($email == false || $email == '') {
  header('Location: index.php?error=missing_email');
  //redirects user to login.php with error Query
  return;
}
if($password == false || $password == '') {
  header('Location: index.php?error=missing_password');
  //redirects user to login.php with error Query
  return;
}
//see if credentials are valid
if($email!= $em) {
  header('Location: index.php?error=user_not_found');
  return;
}
if($password!= $pw) {
  header('Location: index.php?error=wrong_password');
  return;
}
else {
  // TODO: Create Session!!!
  session_start();
  $_SESSION['first_name'] = $first_name;
  $_SESSION['last_name'] = $last_name;
  $_SESSION['email'] = $email;
  $_SESSION['profile_pic'] = $profile_pic;
  $_SESSION['userID'] = $userID;

  header('Location: home.php?id=' . $userID);
}
