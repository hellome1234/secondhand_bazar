   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
   <link rel="stylesheet" type="text/css" href="css/Product.css">
<?php

function setComment(){  #place the data into data base
if (isset($_POST['commentSubmit'])) {
	include 'conn.php';
	$iid =$_SESSION['itemid'];	
	$idUsers= $_SESSION['userId'];	
	$date=$_POST['date'];
	$message=$_POST['message'];



	$sql = "INSERT INTO comments (iid,idUsers,date,message) VALUES ('$iid','$idUsers','$date','$message')";
	$query = mysqli_query($con, $sql);
	
}
}
// end of setcomment

function getComments(){
	include 'conn.php';
	$iid =$_SESSION['itemid'];
	$sql = "SELECT * FROM comments WHERE iid = $iid"; //shows comment for only the selected item
	$query = mysqli_query($con,$sql);

	while ($row = mysqli_fetch_array($query)) {
		$idUsers = $row['idUsers'];//select the user id of the comment 
		$quser = "SELECT * FROM users WHERE idUsers = $idUsers "; //select the username of comment
		$queryuser = mysqli_query($con,$quser);
		$resuser = mysqli_fetch_array($queryuser);
		//display in front end
			echo "<div class='comment-box-3'>";
			echo "<h1 class='comment-name'>";
			echo $resuser['uidUsers'];
			echo "</h1>";
			echo "<p class='comment-date'>";
			echo $row['date']."</p>";
			echo "<p class='comment-message'>";
			echo nl2br($row['message']); //checks for nl tag
			echo "</p>"; 
		echo "
			<form class='edit-form' method='POST' action = 'editcomment.php'>
				<input type='hidden' name = 'cid'      value='".$row['cid']."'>
				<input type='hidden' name = 'iid'      value='".$row['iid']."'>
				<input type='hidden' name = 'uidUsers' value='".$resuser['idUsers']."'>
				<input type='hidden' name = 'date'     value='".$row['date']."'>
				<input type='hidden' name = 'message'  value='".$row['message']."'>
			";	
			if (isset($_SESSION['userId'])) {
				if($row['idUsers']==$_SESSION['userId']){
				echo "	<button><i class='fas fa-pen-square'></i></button>
						
				</form>
			</div>";
			}
		
			}
		
	}
	
	
}



function editComment(){  #place the data into data base
if (isset($_POST['commentSubmit'])) {
	include 'conn.php';
	$cid = $_POST['cid'];
	$iid =$_SESSION['itemid'];	
	$idUsers= $_SESSION['userId'];	
	$date=$_POST['date'];
	$message=$_POST['message'];



	$sql = "UPDATE comments SET message='$message' WHERE cid='$cid'";
	$query = mysqli_query($con, $sql);
	header("Location:product.php?item=$iid");
	
}
}	