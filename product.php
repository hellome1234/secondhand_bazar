 <?php
  session_start();
  //call date
  date_default_timezone_set('Europe/Copenhagen');
  include 'conn.php';
  include 'comments.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
	<head> 
    <meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
   	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
   	<link rel="stylesheet" type="text/css" href="css/Product.css?<?=filemtime("css/Product.css")?>">

    <title>SecondHandBazar</title>
	</head>

<body> 

<!-- nnav  bar start -->
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
						<!-- when Logged In option -->
			<?php if(isset($_SESSION['userUid'])){ 
            if($_SESSION['userType']=='admin'){  ?>
              <a href="admin/index.php">Admin Page</a>
      <?php } else{ ?>        
					<a href="users/index.php">Profile Page</a>
      <?php }?>    
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
      			while($res = mysqli_fetch_array($query)){ ?>
  				<a href="catagory.php?cid=<?php echo $res['cid'];?>"><?php echo $res['cname'];  ?></a>
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
      			<div class='prod-info'>     
                    <div class ='desc'>
                        <h1> $res[iname] </h1>
						<p>                      
                        <li>Brand: $res[idbrand]</li>
                        <li>Product Conditon:$res[cond]</li>
                        <li>ADD Expiration Date:$res[adexpdate]</li>
           				<li>Owner's Name: $resuser[uidUsers]</li>  
                        <li>Owner's email: $resuser[emailUsers]</li>
                        <li>Phone Number:$resuser[phoneUsers] </li>
                        <li>City:$resuser[addresscity]</li>
                        <li>Street:$resuser[addresstreet]</li>
                        </p>
                        <p class='price'>Price:$ $res[iprice]</p>
					</div>
         			<div class='img-1'>
                         <a href='users/$res[img2]' target='_blank'><img src='users/$res[img2]' width='100%' height='126px'>
                    </div>
                    <div class='img-2'>
                         <a href='users/$res[img3]' target='_blank'><img src='users/$res[img3]' width='100%'height='126px'></a>
                    </div>
                    <div class='img-3'>
                         <a href='users/$res[img4]' target='_blank'><img src='users/$res[img4]' width='100%'height='126px'>
                    </div>
               	</div> 
		</div> ";
?>
<!-- recommendation items -->
	<div class="product-page-1">
		<p class="logo-1">User who are intrested in this are also intrested In</p>
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

	
	</div><!--end of class product page1  -->
</div><!-- end of class product page -->

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
			if(!isset($_POST['editComment'])){
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
		}

		 ?>
<?php 
	if(isset($_POST['commentSubmit'])){
    $cid = $_POST['cid']; 
    $iid = $_POST['iid']; 
    $idUsers =  $_SESSION['userId'];
    $date = $_POST['date'];
    $iid = $_POST['iid']; 
    $message= $_POST['message']; 
			
			 echo"
			<form method='POST' action='".editComment()."'>	
        	<input type='hidden' name = 'cid' value='".$cid."'> 
        	<input type='hidden' name = 'iid' value='".$iid."'> 
        	<input type='hidden' name = 'uid' value='".$idUsers."'>      
				<input type='hidden' name='date' value='".$date."'>
				<textarea name='message' class = 'commenttextarea'>".$message."</textarea><br>
				<button type = 'submit' name = 'commentSubmit' class='commentbutton'>Edit</button>
			</form>

		" ;  }
		?>

<!-- check if the user has already posted the rating -->
<?php  
	include 'conn.php'; 
	$user = $_SESSION['userId']; 
	$items =  $_GET['item'];
	$query = "SELECT * FROM user_items WHERE iid = $items AND idusers = $user";
	$queryitem = mysqli_query($con,$query);
	$res = mysqli_fetch_array($queryitem); 
 	if(count($res) < 1){  ?>
 			<div  class="rating">
				<h2>To help us make your browsing experience better Please rate this add</h2>
				<?php if($flag) { ?>
					<div id="alert-success">Rating sucessfully Inserted</div>
				<?php } ?>
				<form action="addrating.php" method="post" >
					<input type="radio" name="rating" value="10" checked>Very Intrested<br>
					<input type="radio" name="rating" value="7">Midly Intrested<br>
					<input type="radio" name="rating" value="5">Not That Intrested<br>
					<input type="radio" name="rating" value="0">Not Intrested at all<br>
					<input id="rating-button" type="submit"  name = "addrating">	
				</form>
			</div>

<?php	}
 	
		} ?>  <!-- end of sesssion if  -->
<!-- retrieve commentSubmit -->
<div class="comments1">
	<?php  getComments();?>
</div>
<!--..................................................................................................footer ........................... -->  
<footer>
</footer>

</body>
</html>