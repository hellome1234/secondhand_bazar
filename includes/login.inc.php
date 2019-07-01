<?php 

if (isset($_POST['login-submit'])) {
	
	require 'dbh.inc.php'; #we require connection from the database from this file

	$mailuid =$_POST['mailuid'];
	$password =$_POST['pwd'];

	if (empty($mailuid) || empty($password)) { #to check if the user left the field empty 
		header("Location: ../index.php?error=emptyfields");
		exit();
	}
	else{
		$sql = "SELECT * FROM users WHERE uidUsers=? OR emailUsers=?;";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) { #to check the connection 
			header("Location: ../index.php?error=sqlerror");
			exit();
		}
		else{

			mysqli_stmt_bind_param($stmt,"ss", $mailuid, $mailuid); #take the data from the $sql above and check the database
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt); #raw data we got from database
			if ($row = mysqli_fetch_assoc($result)) {  #chanfe the raw result data to associative array
				$pwdCheck  = password_verify($password, $row['pwdUsers']);  #compares the typed pwd and database pwd 
				if ($pwdCheck == false) {
					header("Location: ../index.php?error=wrongpassword"); #if pwd not same back to index page 
					exit();
				}
				else if($pwdCheck == true){
					if($row['userType'] == 'admin')
					{
						session_start();
						$_SESSION['userId'] = $row['idUsers'];
						$_SESSION['userUid'] = $row['uidUsers'];
						$_SESSION['emailUsers'] = $row['emailUsers'];
						$_SESSION['userType'] = $row['userType'];
					
						header("Location: ../index.php?login=success");
					   exit();
					}
					else if($row['userType'] == 'customer'){
					 	session_start();
						$_SESSION['userId'] = $row['idUsers'];
						$_SESSION['userUid'] = $row['uidUsers'];
						$_SESSION['userType'] = $row['userType'];
						$_SESSION['emailUsers'] = $row['emailUsers'];
 					header("Location: ../index.php?login=success");
					exit();
					}
				}

 				
				else{
					header("Location: ../index.php?error=wrongpassword"); #if pwd not same back to index page 
					exit();
				}
			}
				
				else{ #if we dont get any data from the database 
					header("Location: ../index.php?error=nouser");
					exit();

				}

		}

	}

}
else{
	header("Location: ../index.php");
	exit();
}