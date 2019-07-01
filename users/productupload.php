
<?php
	session_start();

						
						include 'conn.php'; 
						
						if (isset($_POST['submit'])) {

								$iname = $_POST['iname'] ;
								$idbrand = $_POST['idbrand'] ;
								$adexpdate = $_POST['adexpdate'] ;
								$cond = $_POST['cond'] ;	
								$idUsers = $_SESSION['userId'];
								$cid  = $_POST["catagories"] ;
								$iprice = $_POST["iprice"];

								$imagename1=$_FILES["myimage1"];
								$imagename2=$_FILES["myimage2"];
								$imagename3=$_FILES["myimage3"];
								$imagename4=$_FILES["myimage4"];

								$fileimagename1 = $imagename1['name']	;
								$fileimagename2 = $imagename2['name']	;
								$fileimagename3 = $imagename3['name']	;
								$fileimagename4 = $imagename4['name']	;

								$fileerror1 = $imagename1['error'];
								$fileerror2 = $imagename2['error'];
								$fileerror3 = $imagename3['error'];
								$fileerror4 = $imagename4['error'];

								$filetmp1 = $imagename1['tmp_name'];
								$filetmp2 = $imagename2['tmp_name'];
								$filetmp3 = $imagename3['tmp_name'];
								$filetmp4 = $imagename4['tmp_name'];


								$fileext1 = explode('.', $fileimagename1);
								$filecheck1 =  strtolower(end($fileext1));

								$fileext2 = explode('.', $fileimagename2);
								$filecheck2 =  strtolower(end($fileext2));

								$fileext3 = explode('.', $fileimagename3);
								$filecheck3 =  strtolower(end($fileext3));

								$fileext4 = explode('.', $fileimagename4);
								$filecheck4 =  strtolower(end($fileext4));

								
								$fileextstored =  array('png','jpg','jpeg');
								# check in the file is in defined extension and save in uploadimages folder
								if (in_array($filecheck1, $fileextstored) and in_array($filecheck2, $fileextstored) and in_array($filecheck3, $fileextstored) and in_array($filecheck4, $fileextstored) ) {


									$destinationfile1 = 'uploadimages/product/'.$fileimagename1;
									move_uploaded_file($filetmp1,$destinationfile1 );

									$destinationfile2 = 'uploadimages/product/'.$fileimagename2;
									move_uploaded_file($filetmp2,$destinationfile2 );

									$destinationfile3 ='uploadimages/product/'.$fileimagename3;
									move_uploaded_file($filetmp3,$destinationfile3 );

									$destinationfile4 ='uploadimages/product/'.$fileimagename4;
									move_uploaded_file($filetmp4,$destinationfile4 );




									$q = "INSERT INTO items (idUsers, cid, iname, idbrand , adexpdate, cond , img1 , img2, img3, img4,iprice) VALUES('$idUsers', '$cid', '$iname', '$idbrand', '$adexpdate' ,'$cond' , '$destinationfile1' , '$destinationfile2' , '$destinationfile3' , '$destinationfile4', '$iprice')";
									$query = mysqli_query($con , $q);

									header("Location:users.php?productadd=success"); 

								}
								







							}	





					 ?>
