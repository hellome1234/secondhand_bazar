<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head> 
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="CSS/userReg.css">
  <title>SecondHandBazar</title>

</head>
<body>
<header>
<!--  this is navigation bar on top ..........................................................................................-->
  <nav >
  <div>
    <div>
      <a href="../index.php">secondHandBazar.Com</a>
    </div>
   
    
    
   <ul>

         <?php
                              if(isset($_SESSION['userUid'])){
                             
                             echo '
                             <form action="../includes/logout.inc.php" method="post">
                                
                                
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


<!-- place this in side..................................................................... -->
 <ul>
            <li>Products</li>
            <li><a href="uploadproduct.php">Add product</a> </li>
            <li><a href="#"><b>&nbsp&nbspCatagories</b><span ></span></a></li>

              <?php 

                     include 'conn.php'; 
                     $q = "select * from catagories ";
                     $query = mysqli_query($con,$q);
                     while($res = mysqli_fetch_array($query)){ ?>
                      <li><?php echo'<a href="';echo $res["cname"];echo'.php">';?> <?php echo $res['cname']; echo'</a>'?> </li>


               <?php 
                   }
                    ?>

            <form>
            <div>
                  <input type="text" placeholder="Search" size="40">
                  <div>
                          <button  type="submit">
                            <i></i>
                          </button>
                  </div>
            </div>
          </form>
    </ul>
<!-- search the product that this user uploaded ..............................................................................................................-->


    
<!--  main filed .............................................................................................................................................-->
