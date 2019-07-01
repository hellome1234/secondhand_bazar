<?php
if (isset($_POST["signup-submit"])) {

	require 'dbh.inc.php';

	$username = $_POST['uid'];
	$email = $_POST['mail'];
	$password = $_POST['pwd'];
	$passwordRepeat = $_POST['pwd-repeat'];
	$mobileNumber = $_POST['phone'];
	$cityName = $_POST['address-city'];
	$streetName = $_POST['address-street'];

	if (empty($username) || empty($email) || empty($password) || empty($passwordRepeat) || empty($mobileNumber
	) || empty($cityName) || empty($streetName) ){
		header("Location:../signup.php?error=emptyfields&uid=".$username."&mail=".$email."&phone=".$mobileNumber."&city=".$cityName."&street=".$streetName);
		exit();
	}
	elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username) ){
		header("Location:../signup.php?error=invalidmailuid");
	}
	elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {  #filter_validate_email checks if email is valid or not
		header("Location:../signup.php?error=invalidmail&uid=".$username);
		exit(); 
	}
	elseif (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {  #filter_validate_email checks if email is valid or not
		header("Location:../signup.php?error=invaliduid&mail=".$email);
		exit();
	}
	elseif (!preg_match("/^[0-9]*$/", $mobileNumber)) {  #checks if the mobile number is valid or not
		header("Location:../signup.php?error=invalidphone&mail=".$email."&uid=".$username);
		exit();
	}
	elseif ($password !== $passwordRepeat) {
		header("Location:../signup.php?error=passwordcheck&mail=".$email."&uid=".$username);
		exit();
		# code...
	}
	else {
		$sql = "SELECT uidUsers FROM users WHERE uidUsers=?";
		$stmt = mysqli_stmt_init($conn); #check connection between database and user login
		if (!mysqli_stmt_prepare($stmt,$sql)) {
			header("Location:../signup.php?error=sqlerror");
			exit();
		}
		else {
			mysqli_stmt_bind_param($stmt,"s",$username);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);
			$resultCheck = mysqli_stmt_num_rows($stmt);	
			if ($resultCheck > 0) {
				header("Location:../signup.php?error=usertaken&mail=".$email);
				exit();

			}
			else{
				$sql = "INSERT INTO users (uidUsers, emailUsers, pwdUsers, phoneUsers, addresscity, addresstreet) VALUES (?, ?, ?, ?, ?, ?)"; #insert value in table in sql
				$stmt = mysqli_stmt_init($conn);
				if (!mysqli_stmt_prepare($stmt,$sql)) {
					header("Location:../signup.php?error=sqlerror"); #checkks if stmt and sql statement works together 
					exit();
			}
				else {
					$hashedpwd = password_hash($password, PASSWORD_DEFAULT);
					mysqli_stmt_bind_param($stmt,"sssiss",$username, $email, $hashedpwd, $mobileNumber, $cityName, $streetName );
					mysqli_stmt_execute($stmt);
					header("Location:../signup.php?signup=success"); 
					exit();

				}
			}		
		}

	}
	mysqli_stmt_close($stmt);
	mysqli_close($conn);

} 
else {
	header("Location: ../signup.php");
	exit();
}