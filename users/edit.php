 <?php
  session_start();

  include 'conn.php';
  include 'comments.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head> 
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
   <link rel="stylesheet" type="text/css" href="css/Product.css">

        <title>SecondHandBazar</title>


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

<div class="product-page">
                        
<?php

  include 'conn.php'; 

$item = $_GET['item'];
$_SESSION['itemid'] = $item;
$items = $_SESSION['itemid'];
$qitem = "SELECT * FROM items WHERE iid = $items";
$queryitem = mysqli_query($con,$qitem);
$res = mysqli_fetch_array($queryitem);
$idUsers  = $res['idUsers'];

$quser = "SELECT * FROM users WHERE idUsers = $idUsers ";
$queryuser = mysqli_query($con,$quser);
$resuser = mysqli_fetch_array($queryuser);
  
  echo "
      <div class='product'>

             <div class='img'><img src='users/$res[img1]' height='200px' ></div>
      <!-- ............................................ item information ............................................................................--> 
       <div class='prod-info'>     
                          <div class ='desc'>
                          <p>                      
                              <li>Name: $res[iname] </li>
                              <li>Brand: $res[idbrand]</li>
                              <li>Product Conditon:$res[cond]</li>
                              <li>Price:$ $res[iprice]</li>
                              <li>ADD Expiration Date:$res[adexpdate]</li>
             
                              <li>Owner's Name: $resuser[uidUsers]</li>  
                               <li>Owner's email: $resuser[emailUsers]</li>
                                <li>Phone Number:$resuser[phoneUsers] </li>
                                 <li>City:$resuser[addresscity]</li>
                                  <li>Street:$resuser[addresstreet]</li>
                                  </p>
</div>
                         </div>   

      </div> ";
   ?>
<!-- recommendation items -->
	<div class="product-page-1">
		<h1 class="logo-1">Recommended post</h1>
		<?php
			
			include("conn.php");
			include("recommendation/recommend.php");
			require_once 'recommendation/content_based.php';



			$items = mysqli_query($con,"SELECT * FROM items");

			$matrix = array();

			while ($item = mysqli_fetch_array($items)) {
				
				
			

				$item1 = mysqli_query($con,"SELECT * FROM items WHERE iid = $item[iid]");
				$itemname = mysqli_fetch_array($item1);

				
				$query = mysqli_query($con,"SELECT cid FROM items WHERE iid = $item[iid]");
				$catagory = mysqli_fetch_array($query);

				$catagoryquery =mysqli_query($con,"SELECT cname FROM catagories WHERE cid = $catagory[cid]");
				$catagoryname = mysqli_fetch_array($catagoryquery);

				$i = 0;
				$matrix  [$itemname['iname']]  [$i]= $catagoryname['cname']; 
				$i = $i +1;
				$matrix  [$itemname['iname']]  [$i]= $itemname['idbrand']; 
				$i = $i +1;
				$matrix  [$itemname['iname']]  [$i]= $itemname['cond']; 
				}

				// fetching catagory item
				$catagory =mysqli_query($con,"SELECT cname FROM catagories WHERE cid = $res[cid]");
				$catagoryName = mysqli_fetch_array($catagory);
				// crating a array of information to calculate similarity
				$user = [$res['cond'],$catagoryName['cname']];

	 			$engine = new ContentBasedRecommend($user, $matrix);
	 			$recomnedationitem	= $engine->getRecommendation();
	 			foreach ($recomnedationitem as $item => $result) {
	 				if ($result > 0 ){
	 				include 'conn.php'; 
                	$q = "SELECT * FROM items WHERE iname='$item'";
                  	$query = mysqli_query($con,$q);
                  	$res = mysqli_fetch_array($query); ?>
                  	
                  	<div class="card">
					<a href="product.php?item=<?php echo $res['iid'];?>">  <img  src='users/<?php  echo $res['img1']; ?>' width="100%" height="200px"></a>
					<div class="desc-1">
					<p><?php echo $res["iname"]; ?></p>
					<br>
					<p><?php echo 'Rs '.$res["iprice"]; ?></p>
					</div>
					</div>
	<?php } } ?>				

	<!--end of class product page1  -->
	</div>


<!-- end of class product page -->
</div>

<!-- .....................................................................recomendation query ................................. -->

			<?php
		//check if user have already placed the rating
					

			if(isset($_SESSION['userUid'])){

				 include 'conn.php'; 
				 $flag = 0 ;
				 if (isset($_POST["addrating"])) {

				 	$ratting = $_POST["rating"];
				 	$itemid = $_SESSION['itemid'];
				 	$userid= $_SESSION[userId];
				 	$q = "INSERT INTO  user_items(idusers,iid,item_rating) VALUES ('$_SESSION[userId]','$_SESSION[itemid]','$ratting')";
				 	$query = mysqli_query($con, $q);
				 	if($query){
				 		$flag = 1; 
				 		
				 	}
				 }
			 	?>
			 	<!--  ...............................................comment section ........................................................ -->
	
		<?php 
			if(isset($_SESSION['userUid'])){

				
			 echo"
			 <div class='comment-box'>
			<form method='POST' action='".setComment()."'>
				<input type='hidden' name='date' value='".date('Y-m-d H:i:s')."'>
				<textarea  name='message' class = 'cmnt-section'></textarea><br>
				<button type = 'submit' name = 'commentSubmit' class='btn-1'>Comment</button>
			</form>
			</div>
		" ; 
    }
		

		 ?>



			<?php  } ?>



<?php  getComments();?>

<!--..................................................................................................footer ........................... -->  
<footer>
</footer>

</body>
</html>