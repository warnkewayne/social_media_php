<?php
// nav.php

 ?>
 <link rel="stylesheet" type="text/css" href="styles.css"/>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

 <nav>
   <ul id="navbar">

       <li id="navbar"><a href=<?php echo "home.php?id=" . $_SESSION['userID']; ?>>Home</a></li>
       <li id="navbar">
        <div class="dropdownProfile">
         <a class="dropbtn">Profile</a>
         <div class="dropdown-content">
           <a id="dropdown-content" style="color:black;" href ="<?php echo "profile.php?id=" . $_SESSION['userID']; ?>">Profile</a>
           <a id="dropdown-content" style="color:black;" href="<?php echo "edit-user.php?id=" . $_SESSION['userID']; ?>">Edit Profile</a>
         </div>
        </div>
       </li>
       <li id="navbar"><a href ="#">*NAV*</a></li>
       <li id="navbar"><a href ="friends.php">Friends</a></li>
       <li id="navbar"><a href ="sign-out.php">Sign out</a></li>

       <form id="search" action=<?php echo "search.php?go" ?> method="post">
         <input id="search" type="text" name="search" placeholder=" Search..."/>
         <button id="search_submit" type="submit">
          <i class="fa fa-search"></i>
         </button>
       </form>

   </ul>
 </nav>
