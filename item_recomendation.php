<?php
	
	include("conn.php");
	include("recommend.php");



	$items = mysqli_query($con,"SELECT * FROM user_items");

	$matrix = array();

	while ($item = mysqli_fetch_array($items)) {

		$users = mysqli_query($con,"SELECT uidUsers FROM users WHERE idUsers = $item[idusers]");
		$username = mysqli_fetch_array($users);

		$item1 = mysqli_query($con,"SELECT iname FROM items WHERE iid = $item[iid]");
		$itemname = mysqli_fetch_array($item1);

		//$matrix  [$itemname['iname']]  [$username['uidUsers']]= $item['item_rating']; lets use this for item rating


		$matrix[$username['uidUsers']] [$itemname['iname']] = $item['item_rating']; 
	}


	echo "<pre>";
		print_r($matrix);

	echo "</pre>";


	var_dump(getRecommendation($matrix,"hman"));




?>