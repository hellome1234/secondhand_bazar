<?php
/**
 * PHP item based filtering
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * @package   PHP item based filtering
 */



	include("../conn.php");
	include("recommend.php");
	require_once 'content_based.php';



	$items = mysqli_query($con,"SELECT * FROM items");

	$matrix = array();

	while ($item = mysqli_fetch_array($items)) {
		
		
	

		$item1 = mysqli_query($con,"SELECT * FROM items WHERE iid = $item[iid]");
		$itemname = mysqli_fetch_array($item1);

		
		$query = mysqli_query($con,"SELECT cid FROM items WHERE iid = $item[iid]");
		$catagory = mysqli_fetch_array($query);

		$catagoryquery =mysqli_query($con,"SELECT cname FROM catagories WHERE cid = $catagory[cid]");
		$catagoryname = mysqli_fetch_array($catagoryquery);

		$i = 0;
		$matrix  [$itemname['iname']]  [$i]= $catagoryname['cname']; 
		$i = $i +1;
		$matrix  [$itemname['iname']]  [$i]= $itemname['idbrand']; 
		$i = $i +1;
		$matrix  [$itemname['iname']]  [$i]= $itemname['cond']; 

		//$matrix[$username['uidUsers']] [$itemname['iname']] = $item['item_rating']; 
	}

	echo "<pre>";
		print_r($matrix);

	echo "</pre>";

	$product = ['Mobile accessories','New','Samsung'];
$engine = new ContentBasedRecommend($product, $matrix);
var_dump($engine->getRecommendation());




?>