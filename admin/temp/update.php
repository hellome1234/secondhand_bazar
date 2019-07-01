<?php

  include 'conn.php';

  if(isset($_POST['done'])){

  $idUsers = $_GET['idUsers'];
 $username = $_POST['uid'];
 $password = $_POST['pwd'];
 $q = " update crudtable set idUsers=$idUsers, uidUsers='$uid', pwdUsers='$pwd' where idUsers=$idUsers  ";

  $query = mysqli_query($con,$q);

  header('location:userdisplay.php');
 }

?>

<!DOCTYPE html>
<html>
<head>

 <title>secondHandBazar</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <link rel="stylesheet" type="text/css" href="CSS/AddAdmin.css">

  <style>

 body {
font-family: Agency FB;
}

</style>

</head>
<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">secondHandBazar.Com</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="AdminMagane.php"><b>&nbsp&nbsp&nbsp&nbspHome</b></a></li>
        <li><a href="userdisplay.php"><b>Users</b></a></li>
      <li class="active"><a href="update.php"><b>User update</b></a></li>
      <li><a href="AddAdmin.php"><b>Add Admin</b></a></li>
      <li><a href="ANotification.php"><b>Notification</b></a></li>
    </ul>

   <ul class="nav navbar-nav navbar-right">
      <li><a href="../includes/logout.inc.php"><span class="glyphicon glyphicon-user"></span> <b>Logout</b></a></li>
     
    </ul>
  </div>
</nav>




<div class="container">
    <div class="row main">
        <div class="main-login main-center">
            <h3>Update Users</h3>
            <form  method="post">
                <div class="form-group">
                            
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="uid" id="uname"  placeholder="Username"/>

                                </div>
                            </div>
                        </div>
                  

                        <div class="form-group">
                            
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                    <input type="password" class="form-control" name="pwd" id="password"  placeholder="Enter Password"/>
                                </div>
                            </div>

                        </div>
                       
                        
                         
                        
                        <button class="btn" type="submit" name="done">Submit</button>

            </form>
  
        </div>
    </div>
</div>


</body>
</html>


<!-- 
  <div class="col-lg-6 m-auto">
 
 <form method="post">
 
 <br><br><div class="card">
 
 <div class="card-header bg-dark">
 <h1 class="text-white text-center">  Update Operation </h1>
 </div><br>

  <label> Username: </label>
 <input type="text" name="username" class="form-control"> <br>

  <label> Password: </label>
 <input type="text" name="password" class="form-control"> <br>

  <button class="btn btn-success" type="submit" name="done"> Submit </button><br>

  </div>
 </form>
 </div>