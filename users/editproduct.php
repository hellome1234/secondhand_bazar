<?php
  session_start();
  

?>
<!DOCTYPE html>
<html>
<head>
 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/index.css">
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
<?php if(isset($_SESSION['userUid'])){ 
        if($_SESSION['userType'] == 'admin'){       
  ?>
  <a href="admin/index.php">Profile Info</a>
<?php }?>
<a href="uploadproduct.php">Upload Product</a>  
<a href="profile.php">Profile Info</a>
<a href="../includes/logout.inc.php">Log Out</a>
<a href="#"><?php echo $_SESSION['userUid'];?></a>
<?php  }?>


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
  <a href="catagory.php?cid=<?php echo $res['cid'];?>"><?php echo $res['cname'];  ?></a>
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
<!-- edit product -->
<?php 
  include 'conn.php';
  $item = $_GET['item'];
  echo $item;
  $sql = "SELECT * FROM items WHERE iid = $item";
  $query = mysqli_query($con,$sql);
// display Displays Information

while ($row = mysqli_fetch_array($query)) {
    
  echo "<form class='edit-user' method='POST' action = '".updateprofile()."'>
        <input type='hidden' name = 'iid'  value='".$row['iid']."'>
        <input type='hidden' name = 'idUsers'  value='".$row['idUsers']."'>
        <input type='hidden' name = 'cid'  value='".$row['cid']."'>
        <div class='textarea'>
        <p>Item Name</p>
        <textarea name='iname' class='username'>".$row['iname']."</textarea><br>        
        </div>
         <div class='textarea'>
        <p>Item Brand</p>
        <textarea name='idbrand' class='itembrand'>".$row['idbrand']."</textarea><br>        
        </div>
        <div class='textarea'>
        <p>Add Expiration</p>
        <textarea name='adexpdate' class='addExpirationn'>".$row['adexpdate']."</textarea><br>        
        </div>
        <div class='textarea'>
        <p>Condtion</p>
        <textarea name='cond' class='condition'>".$row['cond']."</textarea><br>        
        </div>
        <input type='hidden' name = 'pwdUsers'     value='".$row['pwdUsers']."'>

        <div class='textarea'>
        <p>Phone Number</p>
        <textarea name='phoneUsers' class='username'>".$row['phoneUsers']."</textarea><br>        
        </div>
        
         <div class='textarea'>
        <p>city address</p>
        <textarea name='addresscity' class='addresscity'>".$row['addresscity']."</textarea><br>        
        </div>
        <div class='textarea'>
        <p>Street address</p>
        <textarea name='addresstreet' class='addresstreet'>".$row['addresstreet']."</textarea><br>        
        </div>
        
        <input type='hidden' name ='userType' value='".$row['userType']."'>

        <button type='submit' name='updateprofile'>Update Profile</button>
      </form>";
  }


?>
<!-- display recently added items  -->

</main>

</body>
</html>