
<?php
  session_start();

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
 		header("Location:product.php?item=$itemid");
 	}
 }
 	?>
