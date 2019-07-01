<?php
  session_start();
  

?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="css/uploadproduct.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
</head>
<body>
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
<a href="index.php">Profile Page</a>
<a href="../includes/logout.inc.php">Log Out</a>
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




  <div class="form-box">
<form method="POST" action="productupload.php" enctype="multipart/form-data">

  <!-- description product -->
    <div class="desc-product">
    <label for="product">Enter Product Name:</label>
    <input type="text" name="iname" placeholder="Descibe the product" >
    </div>
<!-- end of desc product -->
<!-- porduct-brand -->
    <div class="product-brand">
    <label for="brand">Product Brand:</label>
    <input type="text" name="idbrand" placeholder="Product brand">
</div>
  

<!-- expiration date  -->
    <div class="exp-date">
    <label for="availabledate">Add Expiration Date :</label>
    <input type="date" name="adexpdate" placeholder="Last buying date">
    </div>
    <!-- end of expiraton date -->

    <!-- book-condition -->

    <div class="book-condition">
    <label for="conditon">Product Condition: </label>
    <input type="text" name="cond" placeholder="Descibe product conditon">
</div>
<!-- end of book condition -->
 
<!-- price of book  -->
<div class="book-price">
    <label for="conditon">Price :</label>
    <input type="text" name="iprice" placeholder="Insert Price">
  </div>
    <!-- end of book price  -->

        <!-- front image -->
    <div class="front-image">
    <label for="frontimg">Product Front Image:</label>  
       <input type="file" name="myimage1" placeholder="product image from front">
        </div>
       <!-- end of front image -->


       <!-- back-image -->
       <div class="back-image">
       <label for="backimg">Product Back Image</label>  
    <input type="file" name="myimage2" placeholder="product image from back">
           </div>

           <div class="back-image">
       <label for="backimg">Product Additional Image</label>  
    <input type="file" name="myimage3" placeholder="product Additional Image">
           </div>
<div class="back-image">
       <label for="backimg">Product Additional Image</label>  
    <input type="file" name="myimage4" placeholder="product Additional Image">
           </div>


               <!--end of back image  -->
               <!-- catagories page -->
               <div class="catagories">
     <label>Catagories</label>
         
           
                    <input type="radio" name="catagories" value="3">Cars<br>
                    <input type="radio" name="catagories" value="7">Books<br>
                    <input type="radio" name="catagories" value="8">Mobile accessories<br>
                    <input type="radio" name="catagories" value="9">Computer accessories<br>
                    <input type="radio" name="catagories" value="10">Electronics<br>
                    <input type="radio" name="catagories" value="11">Sport and Fitness<br>
         </div>
<!-- end of catagories -->
    <input  type="submit" name="submit" value="Upload"/>

  </form>
  </div>







</body>
</html>