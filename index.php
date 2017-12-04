<?php
// final/index.php

if(isset($_GET['error'])){
  //echo "<p style='color:red'>You have an error: $_GET[error]</p>";
  switch($_GET['error']) {
    case 'not_from_login':
      echo "<p style='color:red'>Your request is not from our login</p>";
      break;
    case 'user_not_found':
      echo "<p style='color:red'>User Not Found</p>";
      break;
    case 'wrong_password':
      echo "<p style='color:red'>Wrong Password</p>";
      break;
    case 'user_already_exists':
      echo "<p style='color:red'>User Already Exists</p>";
      break;
  }

}

 ?>
 <link rel="stylesheet" type="text/css" href="styles.css"/>

 <nav id="login">
   <ul id="login">
     <li><img src="logo.png" width="45px" height="25px" /></li>
     <form id="login" action="check-login.php" method="post">
       <input id="login" placeholder="E-mail" name="email" type="text" required/>
       <input id="login" placeholder="Password" name="password" type="password" required/>
       <button id="login" name="submit">Login</button>
     </form>
   </ul>
 </nav>

 <div id="signup">
   <h2>Sign up</h2>
   <form id="signup" action="register-user.php" method="post">
     <input id="first" required name="first_name" type="text" placeholder="First Name..."/>
     <input id="last" name="last_name" type="text" placeholder="Last Name..."/>
     <br />
     <input id="email" required name="email" type="text" placeholder="E-mail"/>
     <br />
     <input id="pw" required name="password" type="password" placeholder="Password"/>
     <input id="confirmPW" required name="confirmPW" type="password" placeholder="Confirm Password"/>
     <br />
     <button id="signup">Create User</button>
   </form>
 </div>

 <div id="info">
   <h2> Laboris in cupidatat </h2>
   <p>Culpa aliquip proident cupidatat sit cupidatat eu duis magna consectetur ipsum sint exercitation enim nulla sint. Aliquip non cillum cupidatat dolore esse excepteur cillum in tempor labore duis aliqua. Reprehenderit pariatur elit aliqua officia veniam esse consequat aute. Ea laboris magna pariatur culpa nostrud exercitation labore culpa cillum culpa esse officia ex proident enim officia. Duis amet eu nisi labore ullamco cupidatat nostrud. Voluptate magna exercitation minim qui magna et Lorem ex laborum anim quis sint cupidatat occaecat tempor. Laboris in cupidatat aliqua commodo magna fugiat tempor voluptate aliqua veniam esse ex ullamco officia dolore sint.</p>
 </div>

<!--
<script>
var password = document.getElementById("password")
  , confirmPW = document.getElementById("confirmPW");

function validatePassword(){
  if(password.value != confirmPW.value) {
    confirmPW.setCustomValidity("Passwords Don't Match");
  } else {
    confirmPW.setCustomValidity('');
  }
}

password.onchange = validatePassword;
confirmPW.onkeyup = validatePassword;
</script>
-->

 <!-- END OF FILE -->
