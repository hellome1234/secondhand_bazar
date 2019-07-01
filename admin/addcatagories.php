<?php

	include 'conn.php';
if (isset($_POST["addcatagories"])) {

	

	$catagoryname  = $_POST['Catagory'];

	if (empty($catagoryname)) {
		header("Location:catagories.php?error=fillcatagoryfield");

	}
	elseif (!preg_match("/^[a-zA-Z]*$/", $username) ) {
		header("Location:catagories.php?error=onlylettersareallowed");
	}
	else {
		$q = "INSERT INTO  catagories(cname) VALUES ('$catagoryname')";
		$query = mysqli_query($con, $q);
		header("Location:catagories.php?catagoriesadd=sucess");

	}

}
