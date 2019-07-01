<?php
session_start();
    if(!isset($_SESSION['userType'])){
        header('location: ../index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>secondHandBazar</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <style>

 body {
font-family: Agency FB;

 background-image: url("Background/back3.jpg");
}

</style>


</head>
<body>

<nav >
  <div >
    <div>
      <a href="../index.php">secondHandBazar.Com</a>
    </div>
    <ul>
      <li><a href="AdminMagane.php"><b>&nbsp&nbsp&nbsp&nbspHome</b></a></li>
  
      <li><a href="userdisplay.php"><b>Users</b></a></li>
      <li><a href="ADeletePost.php"><b>Delete Post</b></a></li>
      <li><a href="ANotification.php"><b>Notification</b></a></li>
    </ul>

   <ul>
      <li><a href="../includes/logout.inc.php"><span></span> <b>Logout</b></a></li>
     
    </ul>
  </div>
</nav>
  

</body>
</html>

