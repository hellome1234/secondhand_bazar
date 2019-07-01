 <?php
  session_start();
  //call date
  date_default_timezone_set('Europe/Copenhagen');
  include 'conn.php';
  include 'comments.inc.php';


?><!DOCTYPE html>
<html lang="en">
  <head> 
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" type="text/css" href="css/Productstyle.css">

        <title>SecondHandBazar</title>


</head>
<body>
<header>
<!--  this is navigation bar on top ..........................................................................................-->
  <nav >
  <div>
    <div>
      <a href="index.php">secondHandBazar.Com</a>
    </div>
   
    
    
   <ul>

         <?php
                              if(isset($_SESSION['userUid'])){
                             
                             echo '
                             <form action="	includes/logout.inc.php" method="post">
                                
                                
                                    <li><button type="submit" name="logout-submit">logout</button></li>
                                  </form>';

                                  
                              
                              }
                              
                               elseif(!isset($_SESSION['userUid'])){
                                echo '<form action="includes/login.inc.php" method="post">
                                      <li> <input type="text" name="mailuid" placehoder="Username/E-mail.."></li>
                                      <li><input type="password" name="pwd" placehoder="password.."></li>
                                      <li><button type="submit" name="login-submit">login</button><li>
                                  </form>
                                    <li><a href="signup.php">Signup</a></li>'; 
                              }
                            ?>
            
     
    </ul>
  </div>
</nav>
</header>  
<main>
<div>
                        
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

             <div class='image'><img src='users/$res[img1]'></div>
      <!-- ............................................ item information ............................................................................-->       
                          <div >                      
                              <p>Name: $res[iname] </p>
                              <p>Brand: $res[idbrand]</p>
                              <p>Product Conditon:$res[cond]</p>
                              <p>Price:$res[iprice]</p>
                              <p>ADD Expiration Date:$res[adexpdate]</p>
                          </div> "; 
        echo "
                                        
        <!-- ............................................user information .......................................................................................-->
                  <div>
                              <p>Owner's Name: $resuser[uidUsers]</p>  
                               <p>Owner's email: $resuser[emailUsers]</p>
                                <p>Phone Number:$resuser[phoneUsers] </p>
                                 <p>City:$resuser[addresscity]</p>
                                  <p>Street:$resuser[addresstreet]</p>

                         </div>   

      </div> ";
   ?>

</div>

<!--  ...............................................comment section ........................................................ -->

		<?php 
    $cid = $_POST['cid']; 
    $iid = $_POST['iid']; 
    $uidUsers =  $_POST['uidUsers'];
    $date = $_POST['date'];
    $iid = $_POST['iid']; 
    $message= $_POST['message']; 










			if(isset($_SESSION['userUid'])){
			 echo"
			<form method='POST' action='".editComment()."'>	
        <input type='hidden' name = 'cid' value='".$cid."'> 
        <input type='hidden' name = 'iid' value='".$iid."'> 
        <input type='hidden' name = 'uid' value='".$uidUsers."'>      
				<input type='hidden' name='date' value='".$date."'>
				<textarea name='message' class = 'commenttextarea'>".$message."</textarea><br>
				<button type = 'submit' name = 'commentSubmit' class='commentbutton'>Edit</button>
			</form>

		" ;  }
		getComments();


		 ?>

</main>
<!--..................................................................................................footer ........................... -->  
<footer>
</footer>

</body>
</html>