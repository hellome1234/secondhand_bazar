 <?php
  session_start();
  //call date
  date_default_timezone_set('Europe/Copenhagen');
  include 'conn.php';
  include 'comments.inc.php';


?><!DOCTYPE html>
<html lang="en">
  <head> 
       <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
   <link rel="stylesheet" type="text/css" href="css/Product.css">
        <title>SecondHandBazar</title>


</head>
<body>
<header>
<!--  this is navigation bar on top ..........................................................................................-->
 <nav class="main-nav">
  <div class="nav-section">
    <ul>
    <li><a href="index.php" class="active"><i class="fa fa-home "></i></a></li>
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
<a href="users/index.php">Profile Page</a>
<a href="includes/logout.inc.php">Log Out</a>
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
    <form>
    <input type="text" placeholder="Search for Products">
  </form>
</div>
<div class="search-bar-1">
  
    <button type="submit" >
      <i class="fa fa-search"></i>
    </button>

</div>

<!-- search bar ends -->

</nav> <!-- navigation ends -->
</header>  
<main>
<div>
                        
<?php

include 'conn.php'; 
$items = $_SESSION['itemid'];
echo $items;
$qitem = "SELECT * FROM items WHERE iid = $items";
$queryitem = mysqli_query($con,$qitem);
$res = mysqli_fetch_array($queryitem);
$idUsers  = $res['idUsers'];

$quser = "SELECT * FROM users WHERE idUsers = $idUsers ";
$queryuser = mysqli_query($con,$quser);
$resuser = mysqli_fetch_array($queryuser);
  
  echo "
      <div class='product'>

             <div class='image'><img src='users/$res[img1]'></div>
      <!-- ............................................ item information ............................................................................-->       
                          <div >                      
                              <p>Name: $res[iname] </p>
                              <p>Brand: $res[idbrand]</p>
                              <p>Product Conditon:$res[cond]</p>
                              <p>Price:$res[iprice]</p>
                              <p>ADD Expiration Date:$res[adexpdate]</p>
                          </div> "; 
        echo "
                                        
        <!-- ............................................user information .......................................................................................-->
                  <div>
                              <p>Owner's Name: $resuser[uidUsers]</p>  
                               <p>Owner's email: $resuser[emailUsers]</p>
                                <p>Phone Number:$resuser[phoneUsers] </p>
                                 <p>City:$resuser[addresscity]</p>
                                  <p>Street:$resuser[addresstreet]</p>

                         </div>   

      </div> ";
   ?>

</div>

<!--  ...............................................comment section ........................................................ -->

		<?php 
    $cid = $_POST['cid']; 
    $iid = $_POST['iid']; 
    $uidUsers =  $_POST['uidUsers'];
    $date = $_POST['date'];
    $iid = $_POST['iid']; 
    $message= $_POST['message']; 
			if(isset($_SESSION['userUid'])){
			 echo"
			<form method='POST' action='".editComment()."'>	
        <input type='hidden' name = 'cid' value='".$cid."'> 
        <input type='hidden' name = 'iid' value='".$iid."'> 
        <input type='hidden' name = 'uid' value='".$uidUsers."'>      
				<input type='hidden' name='date' value='".$date."'>
				<textarea name='message' class = 'commenttextarea'>".$message."</textarea><br>
				<button type = 'submit' name = 'commentSubmit' class='commentbutton'>Edit</button>
			</form>

		" ;  }
		getComments();


		 ?>

</main>
<!--..................................................................................................footer ........................... -->  
<footer>
</footer>

</body>
</html>