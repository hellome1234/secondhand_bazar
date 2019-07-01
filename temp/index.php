<?php
  session_start();
  

?>
<html>
<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="css/custom.css">
  <title></title>
</head>
<body>
  <!-- header section -->

<!-- ........................................navigation bar ............................................. -->
  <nav class="main-nav">
	  <div class="nav-section">
	    <ul>
	    <li><a href="#" class="active"><i class="fa fa-home "></i></a></li>
		</ul>

	</div>
	
<div class="btn">                       
  <?php
                  if(isset($_SESSION['userUid'])){
                    echo '
                      <form action="includes/logout.inc.php" method="post">
                        <button type="submit" name="logout-submit" class="btn-2">logout</button>
                      </form>
                      <button class="btn-1"><a href="users/uploadproduct.php">Upload</a></button>';

                     }
   ?>

  <?php if(!isset($_SESSION['userUid'])){

    echo '<button class="btn-1">Sign In</button>';
    echo '<button class="btn-2"><a href="login.php"> LOg in </a></button>';
        }
   ?>

  </div>
<!-- ............................display catagory dropdown...................... -->
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
    <input type="text" placeholder="Search..">
  </form>
</div>
<div class="search-bar-1">
  <form>
    <button type="submit" >
      <i class="fa fa-search"></i>
    </button>
  </form>
</div>
<!-- search bar ends -->

</nav> <!-- navigation ends -->
<!-- ......................................................displayy recommendation product..................................................................-->

        
        <?php

if(isset($_SESSION['userUid'])){ 
  if($_SESSION['userType']=="customer")  
  {
          include "conn.php";
          include "recommend.php";
          $items = mysqli_query($con,"SELECT * FROM user_items");
          $matrix = array();
          while ($item = mysqli_fetch_array($items)) {

            $users = mysqli_query($con,"SELECT uidUsers FROM users WHERE idUsers = '$item[idusers]'");
            $username = mysqli_fetch_array($users);

            $item1 = mysqli_query($con,"SELECT iname FROM items WHERE iid = '$item[iid]'");
            $itemname = mysqli_fetch_array($item1);



            $matrix[$username['uidUsers']] [$itemname['iname']] = $item['item_rating']; 
          }   
             

                 echo'<section>
              <div class="product-page">
                        <div class="logo-2">
                        <h1 style="text-decoration: underline;">Recommended products</h1>
                        <br>
                      </div>';


                $user = $_SESSION['userUid'];
                $recomnedationitem = array();
                $recomnedationitem = getRecommendation($matrix,$user);

                foreach ($recomnedationitem as $item => $rating) {
                  include 'conn.php'; 
                  $q = "SELECT * FROM items WHERE iname='$item'";
                  $query = mysqli_query($con,$q);
                  $res = mysqli_fetch_array($query); ?>
                  <div class="card">
                           <a href="product.php?item=<?php echo $res['iid'];?>">  <img  src='users/<?php  echo $res['img1']; ?>' width="100%" height="200px"  ></a>
                            <div class="container">
                              <h1><?php echo $res["iname"]; ?></h1>
                              <br>
                              <p><?php echo 'Rs '.$res["iprice"]; ?></p>
                            </div>
                  </div>
                  <?php } 
                  echo '</div>
                  </section>';
            }
         }
            
            ?> 






<section>
<div class="product-page-1">
  <div class="logo-3">
  <h1 style="text-decoration: underline;">products</h1>
  <br>
</div>
      <?php

      include 'conn.php'; 
     $q = "select * from items ";
     $query = mysqli_query($con,$q);

      while($res = mysqli_fetch_array($query)){
     
     ?>
  <div class="card">
    <a href="product.php?item=<?php echo $res['iid'];?>"> <img src='users/<?php  echo $res['img1']; ?>'width="100%" height="200px"></a>
    <div class="container">
      <h1><?php echo $res['iname'] ?></h1>
      <br>
      <p>Price <?php echo $res['iprice'] ?></p>
    </div>
  </div>
   <?php 
     }
      ?>
</div>
</section>




</body>
</html>