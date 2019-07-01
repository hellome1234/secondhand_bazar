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

  <style>

 body {
font-family: Agency FB;
}


    table {
      margin: auto;
      font-family: "Lucida Sans Unicode", "Lucida Grande", "Segoe Ui";
      font-size: 12px;
    }

    h1 {
      margin: 25px auto 0;
      text-align: center;
      text-transform: uppercase;
      font-size: 17px;
    }

    table td {
      transition: all .5s;
    }
    
    /* Table */
    .data-table {
      border-collapse: collapse;
      font-size: 14px;
      min-width: 537px;
    }

    .data-table th, 
    .data-table td {
      border: 1px solid #e1edff;
      padding: 7px 17px;
    }
    .data-table caption {
      margin: 7px;
    }

    /* Table Header */
    .data-table thead th {
      background-color: #508abb;
      color: #FFFFFF;
      border-color: #6ea1cc !important;
      text-transform: uppercase;
    }

    /* Table Body */
    .data-table tbody td {
      color: #353535;
    }
    .data-table tbody td:first-child,
    .data-table tbody td:nth-child(4),
    .data-table tbody td:last-child {
      text-align: right;
    }

    .data-table tbody tr:nth-child(odd) td {
      background-color: #f4fbff;
    }
    .data-table tbody tr:hover td {
      background-color: lightgray;
      border-color: #ffff0f;
    }

    /* Table Footer */
    .data-table tfoot th {
      background-color: #e5f5ff;
      text-align: right;
    }
    .data-table tfoot th:first-child {
      text-align: left;
    }
    .data-table tbody td:empty
    {
      background-color: #ffcccc;
    }



</style>

<script type="text/javascript">

function delete(idUsers)
{
  if(confirm('Are Your Sure Delete This User?'))
  {
    
    window.location='AUserDelete.php?Delete='+idUsers;
  }
}

</script>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">seconHandBazar.Com</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="AdminMagane.php"><b>&nbsp&nbsp&nbsp&nbspHome</b></a></li>
      <li class="active"><a href="userdisplay.php"><b>User</b></a></li>

      <li><a href="AddAdmin.php"><b>Add Admin</b></a></li>
      <li><a href="ADeletePost.php"><b>Delete Post</b></a></li>
      <li><a href="ANotification.php"><b>Notification</b></a></li>
    </ul>

   <ul class="nav navbar-nav navbar-right">
      <li><a href="ULogout.php"><span class="glyphicon glyphicon-user"></span> <b>Logout</b></a></li>
     
    </ul>
  </div>
</nav>


<form action="" method="POST">
<table class="data-table">
 <thead>
     <tr>
      <th>Users ID</th>    
      <th>Name</th>
      <th>Email</th>
      <th>phone</th>
      <th>City Address</th>
      <th>Street Address</th>
      <th>Delete</th>
      <th>Update</th>
    </tr>
  </thead>

<tbody>

<?php

  include 'conn.php'; 
 $q = "select * from users ";

  $query = mysqli_query($con,$q);

  while($res = mysqli_fetch_array($query)){
 ?>
 <tr class="text-center">
 <td> <?php echo $res['idUsers'];  ?> </td>
 <td> <?php echo $res['uidUsers'];  ?> </td>
 <td> <?php echo $res['emailUsers'];  ?> </td>
 <td> <?php echo $res['phoneUsers'];  ?> </td>
 <td> <?php echo $res['addresscity'];  ?> </td>
 <td> <?php echo $res['addresstreet'];  ?> </td>
 <td> <button > <a href="delete.php?idUsers=<?php echo $res['idUsers']; ?>" > Delete </a>  </button> </td>
 <td> <button > <a href="update.php?idUsers=<?php echo $res['idUsers']; ?>" > Update </a> </button> </td>

  </tr>

  <?php 
 }
  ?>
</tbody>
</table>
</form>
 <script type="text/javascript">
 
 $(document).ready(function(){
 $('#tabledata').DataTable();
 }) 
 
 </script>

</body>
</html>

<!-- class="btn-danger btn"
  class="btn-primary btn"
  class="text-white"
  class="text-white"  