<?php
  session_start();
  include 'editprofile.inc.php';

?>
<!DOCTYPE html>
<html>
<head>
 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/editprofile.css">
  <title></title>
</head>
<body>
  <!-- header section -->

<!-- ........................................navigation bar ............................................. -->
  

  <nav class="main-nav">
  <div class="nav-section">
    <ul>
    <li><a href="../index.php" class="active"><i class="fa fa-home "></i></a></li>
</ul>

</div>
<div class="bar-section">
<input type="checkbox" id="chk">
<label for="chk" class="show-menu-btn">
  <i class="fas fa-bars"></i>
</label>


<ul class="btn">
  <!-- when Logged In option -->
<?php if(isset($_SESSION['userUid'])){ ?>
<a href="uploadproduct.php">Upload Product</a>  
<a href="users.php">Profile Page</a>
<a href="editprofile.php">Edit Profile</a>
<a href="../includes/logout.inc.php">Log Out</a>
<a href="#"><?php echo $_SESSION['userUid'];?></a>
<?php } ?>


  <!-- signIn and Login   -->
  <?php if(!isset($_SESSION['userUid'])){ ?>
<a href="">Sign in</a>
 <a href="login.php">LOg in</a>
<?php } ?>
  <label for="chk" class="hide-menu-btn">
  <i class="fas fa-times"></i>
</label>
 </ul>
</div>

    <div class="dropdown">
  <button class="dropbtn">Catagories</button>
  <div class="dropdown-content">
    <?php
      include 'conn.php'; 
      $q = "select * from catagories ";
      $query = mysqli_query($con,$q);
      while($res = mysqli_fetch_array($query)){
                                           
      ?>
  <a href="catagory.php"><?php echo $res['cname'];  ?></a>
  <?php } ?>
   
  </div>
  </div>

  <!-- search bar -->

  <div class="search-bar">
    <form method="POST" action="search.php">
    <input type="text"  name = "search" placeholder="Search for Products">
  </form>
</div>
<div class="search-bar-1">
  
    <button type="submit" name="submit-search">
      <i class="fa fa-search"></i>
    </button>

</div>

<!-- search bar ends -->

</nav> <!-- navigation ends -->

<main>
<!-- edit profile -->
<?php 
  editprofile();
?> 

</main>

</body>
</html>