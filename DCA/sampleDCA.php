<?php
	function arrivalsUrl(){
		return 'https://flightaware.com/live/airport/KDCA/arrivals';

		/*http://flightaware.com/live/airport/KDCA/arrivals?;offset=20;order=actualarrivaltime;sort=DESC
		http://flightaware.com/live/airport/KDCA/arrivals?;offset=40;order=actualarrivaltime;sort=DESC*/
	}

	function getCSVFile($url, $outputFile){


		$content = file_get_contents($url);
		//$content = str_replace(search, replace, subject)

		file_put_contents($outputFile, $content);
		
	}

	//getCSVFile(arrivalsurl(), 'outputFile.php');
	$url = 'https://flightaware.com/live/airport/KDCA/arrivals';

	$content = file_get_contents($url);
	
	preg_match_all('%[A-Z]{3}[0-9]{3,4}%', $content, $results);

	/*echo "<pre>";
    print_r($results);
    die();*/
    $results = array_unique($results);
   
	$codes = array();
	foreach ($results as $result) {
		foreach ($result as $found) {
			//echo $found . "<br /><br />";	
			$codes[] = $found;

		}
	}

	$codes = array_unique($codes);

	/*foreach ($codes as $code) {
		echo $code . "<br /><br />";
	}*/


	preg_match_all('%[A-Z]{1}[a-z]{2}\s[0-9]{1,2}:[0-9]{2}(AM|PM)%', $content, $results2);

	$times = array();
	foreach ($results2 as $result2) {
		foreach ($result2 as $found2) {
			//echo $found . "<br /><br />";	
			$times[] = $found2;

		}
	}

	$times = array_unique($times);

	$odds = array();
	foreach ($times as $key => $value) {
		if($key % 2 != 0){
			$odds[] = $value;
		}
	}

/*	foreach ($odds as $odd) {
		echo $odd. "<br /><br />";
	}*/

?>
<!DOCTYPE html>
<html>
<head>
	<style>
		table, th, td {
	    border: 1px solid black;
	    
		}
		table {
			border-collapse: collapse;
		}
		.floatybox {
     display: inline-block;
     float: left;
}
	</style>
</head>
<body>


		  <div class="floatybox">
		    <table>
			  <tr>
			    <th>Code:</th>
			    
			  </tr>
			  <?php
			  
			 foreach ($codes as $code) {
				 echo "<tr>";
				  echo "<td>";
				 	echo $code ;
				  echo "</td>";
				 echo '</tr>';
			 }

			
			 
			  ?>
			  
			</table>
		</div>
		<div class="floatybox">
			 <table>
			  <tr>
			   
			    <th>Time:</th>
			  </tr>
			  <?php
			  
			 foreach ($odds as $odd) {
				 echo "<tr>";
				  echo "<td>";
				 	echo $odd ;
				  echo "</td>";
				 echo '</tr>';
			 }

			
			 
			  ?>
			  
			</table>
		</div>





</body>
</html>