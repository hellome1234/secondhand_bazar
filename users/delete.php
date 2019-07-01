<?php 

 include 'conn.php';
if ( ! empty( $_GET['item'] ) ) {
	 
				$item = $_GET['item'];

				$sql = "DELETE FROM items WHERE iid = $item";


				mysqli_query($con,$sql);
				header('Location:index.php');
			

}
?>