<?php 

include 'conn.php';

$cid = $_GET['cid'];

$q = "select * from items ";
$query = mysqli_query($con,$q);










while($res = mysqli_fetch_array($query)){
	$iid = $res['iid'];
	$qitem = "DELETE FROM 'items' WHERE iid = $iid";
	if ($res['cid'] == $cid) {	
		mysqli_query($con,$qitem);
	}
}

$qcatagory = "DELETE FROM `catagories` WHERE cid=$cid";
mysqli_query($con,$qcatagory);





header('Location:catagories.php');
?>


