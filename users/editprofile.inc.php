<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/profile.css?<?=filemtime("css/profile.css")?>">
<?php 
function getprofile(){
  include 'conn.php';
  $user = $_SESSION['userId'];
  $sql = "SELECT * FROM users WHERE idUsers = $user";
  $query = mysqli_query($con,$sql);
// display user Information
  while ($row = mysqli_fetch_array($query)) {
    echo "<h2>User Profile</h2>";
  	echo "<div class=''>";
  	echo "<h3>Full Name</h3>";
  	echo "<p>".$row['uidUsers']."</p>";
  	echo "</div>";

	echo "<div class=''>";
  	echo "<h3>Email</h3>";
  	echo "<p>".$row['emailUsers']."</p>";
  	echo "</div>";
	
	echo "<div class=''>";
 	echo "<h3>phone Number</h3>";
 	echo "<p>".$row['phoneUsers']."</p>";
 	echo "</div>";
 	
 	echo "<div class=''>";
	echo "<h3>city Address</h3>";
    echo "<p>".$row['addresscity']."</p>";
    echo "</div>";
	
	echo "<div class=''>";
    echo "<h3>Street Address</h3>";
    echo "<p>".$row['addresstreet']."</p>";
    echo "</div>";

	echo "<div class=''>";
    echo "<h3>User Access</h3>";
    echo "<p>".$row['userType']."</p>";
    echo "</div>";
    
    echo " <a href='editprofile.php'>Update</a>
			";	   
       
         
        
       
  }

}

function editprofile(){
	 include 'conn.php';
  $user = $_SESSION['userId'];
  $sql = "SELECT * FROM users WHERE idUsers = $user";
  $query = mysqli_query($con,$sql);
// display user Information
  while ($row = mysqli_fetch_array($query)) {
    
  echo "<form class='edit-user' method='POST' action = '".updateprofile()."'>
        <input type='hidden' name = 'idUsers'  value='".$row['idUsers']."'>
        <div class='textarea'>
        <p>Username</p>
        <textarea name='uidUsers' class='username'>".$row['uidUsers']."</textarea><br>        
        </div>
         <div class='textarea'>
        <p>email</p>
        <textarea name='emailUsers' class='email'>".$row['emailUsers']."</textarea><br>        
        </div>
        
        <input type='hidden' name = 'pwdUsers'     value='".$row['pwdUsers']."'>

        <div class='textarea'>
        <p>Phone Number</p>
        <textarea name='phoneUsers' class='username'>".$row['phoneUsers']."</textarea><br>        
        </div>
        
         <div class='textarea'>
        <p>city address</p>
        <textarea name='addresscity' class='addresscity'>".$row['addresscity']."</textarea><br>        
        </div>
        <div class='textarea'>
        <p>Street address</p>
        <textarea name='addresstreet' class='addresstreet'>".$row['addresstreet']."</textarea><br>        
        </div>
        
        <input type='hidden' name ='userType' value='".$row['userType']."'>

        <button type='submit' name='updateprofile'>Update Profile</button>
      </form>";
  }
}

  

function updateprofile(){ 
	if(isset($_POST['updateprofile'])){
	include 'conn.php';
	$idUsers = $_POST['idUsers'];
	$uidUsers = $_POST['uidUsers'];
	$emailUsers = $_POST['emailUsers'];
	$pwdUsers =  $_POST['pwdUsers'];
	$phoneUsers =  $_POST['phoneUsers'];
	$addresscity = $_POST['addresscity'];
	$addresstreet =   $_POST['addresstreet'];
	$userType= $_POST['userType'];

	$sql  = "UPDATE users SET uidUsers='$uidUsers',emailUsers='$emailUsers',pwdUsers='$pwdUsers',phoneUsers='$phoneUsers',addresscity='$addresscity',addresstreet='$addresstreet',userType='$userType' WHERE idUsers=$idUsers";
	$query  = mysqli_query($con,$sql);
  $_SESSION['userUid'] = $_POST['uidUsers'];
	header("Location:profile.php");	
}	
}