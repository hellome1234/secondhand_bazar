<?php

$con = mysqli_connect('localhost','root',"",'loginsystem');

if (!$con) {
	die("COnnection failed:".mysqli_connect_error());
}


