<?php 

include 'conn.php';

$idUsers = $_GET['idUsers'];

$q = "DELETE FROM `users` WHERE idUsers = $idUsers";


mysqli_query($con,$q);
header('Location:userdisplay.php');
?>