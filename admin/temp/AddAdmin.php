<?php session_start() ?>

<!DOCTYPE html>
<html lang="en">
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
      <li class="active"><a href="AddAdmin.php"><b>Add Admin</b></a></li>
      
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
            <h3>Admin Registration Form</h3>
            <form  action="adminsignup.inc.php"  method="post">
                <div class="form-group">
                            
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="uid" id="uname"  placeholder="Enter Admin Name"/>

                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="mail" id="email"  placeholder="Enter Admin Email"/>
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
                        <div class="form-group">
                            
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                    <input type="password" class="form-control" name="pwd-repeat" id="password"  placeholder="Repeat Password"/>
                                </div>
                            </div>
                            
                        </div>
                        <div class="form-group">
                            
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="phone"  placeholder="Enter Admin Phone Number"/>
                                </div>
                            </div>
                        </div>
                         <div class="form-group">
                            
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="address-city" placeholder=" city Address" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="address-street" placeholder=" street Address" />
                                </div>
                            </div>
                        </div>
                        <button class="btn" type="submit" name="signup-submit">Signup</button>

            </form>
  
        </div>
    </div>
</div>














</body>
</html>

