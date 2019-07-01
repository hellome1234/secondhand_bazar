<?php 



function similarity_distance($matrix,$person1,$Person2)
{

	$similar = array();
	$sum = 0;

	foreach($matrix[$person1] as $key=>$value)
	 {
		

	 	if(array_key_exists($key, $matrix[$Person2]))
	 	{
	 		$similar[$key] = 1;

	 	}

	} 	
	 	if($similar == 0)
	 	{
	 		return 0;
	 	}


	 	foreach ($matrix[$person1] as $key=>$value)
	 	{
		

	 	if(array_key_exists($key, $matrix[$Person2]))
	 	{
	 		$sum = $sum + pow($value-$matrix[$Person2][$key],2);
	 		
	 	} 

	}
		return 1/(1+sqrt($sum));


	}












function getRecommendation($matrix,$person)
{
	$total =array();
	$simsums  = array();
	$ranks = array();

	foreach($matrix as $otherPerson=>$value)
	{
		if ($otherPerson!=$person) {    //checks if the other user is not the user requested
			
			$sim = similarity_distance($matrix,$person,$otherPerson); //calls the similarity_distance function 

			//var_dump($sim);
			foreach($matrix[$otherPerson] as $key =>$value)        
			{
				if (!array_key_exists($key, $matrix[$person])) {     //checks is the item rating is already placed by user
					

					if (!array_key_exists($key, $total)) {
						$total[$key] = 0;                      
					}
					$total[$key] += $matrix[$otherPerson] [$key] * $sim ;   //$matrix[$otherPerson] [$key] part is basically the other person rating on the same movie. 
					
					if (!array_key_exists($key, $simsums)){
						$simsums[$key] = 0;
					}
					
					 $simsums[$key] += $sim ;	


				}
			}
		}





	} //foreach end

	foreach ($total as $key => $value) {
		$ranks[$key] = $value/$simsums[$key];	
		
	}
		array_multisort($ranks,SORT_DESC); // sort the items in descinding order
		return $ranks;

} //function  getRecommendation end




 ?>