<?php
/*Get arrivals code */
function getArrivalsCode(){
    $url = 'https://flightaware.com/live/airport/KDCA/arrivals';
    $content = file_get_contents($url);
    preg_match_all('%[A-Z]{3}[0-9]{3,4}%', $content, $codes);

    $codes = array_unique($codes);

    $trimedCodes = array();
    foreach($codes as $code){
        foreach($code as $c){
            $trimedCodes[] = $c;
        }
    }
    return array_unique($trimedCodes);
}
/*Get arrival times*/
function getArrivalsTime(){
    $url = 'https://flightaware.com/live/airport/KDCA/arrivals';
    $content = file_get_contents($url); 
    preg_match_all('%[A-Z]{1}[a-z]{2}\s[0-9]{1,2}:[0-9]{2}(AM|PM)%', $content, $times);

    $trimedTimes = array();
    foreach($times as $time){
        foreach($time as $t){
            $trimedTimes[] = $t;
        }
    }
        
    $odds = array();
	foreach ($trimedTimes as $key => $value) {
		if($key % 2 != 0){
			$odds[] = $value;
        }
    }
    
    $finalCodes = array();
    for($i = 0; $i<20; $i++){
        $finalCodes[$i] = $odds[$i];
    }

    return $finalCodes;

}

function findTerminal1(){
   $terminal1 = array('AWI', 'RPA', 'JPA', 'ASA', 'VRD', 'EGF', 'ASQ', 'PDT', 'VRD', 'AAL');
   $codes = getArrivalsCode();
   $codes = array_slice($codes, 9);
   $charCodes = array();
   foreach($codes as $code){
        $trimed = preg_replace('%[0-9]%', '' , $code); 
        $charCodes[] = $trimed;  
   }
   
   $count = 0;
   
   //$charCodes = array();
   foreach($charCodes as $code){
   			if (in_array($code, $terminal1)) {
      		 $count++;
   			}
    } 
    $persent = ($count/10)*100;
    $persent = $persent . "%";
   return $persent;
}

function findTerminal2(){
   $terminal2 = array('TCF', 'ASH', 'ASQ'); 
   $codes = getArrivalsCode();
   $codes = array_slice($codes, 9);
   $charCodes = array();
   foreach($codes as $code){
        $trimed = preg_replace('%[0-9]%', '' , $code); 
        $charCodes[] = $trimed;  
   }
   
   $count = 0;
   
   //$charCodes = array();
   foreach($charCodes as $code){
   			if (in_array($code, $terminal2)) {
      		 $count++;
   			}
    } 
   $persent = ($count/10)*100;
    $persent = $persent . "%";
   return $persent;
}
function findTerminal3(){
    $terminal3 = array('FLG', 'LOF', 'GJS', 'SKW', 'JBU', 'DAL', 'UAL'); 
    $codes = getArrivalsCode();
    $codes = array_slice($codes, 9);
   $charCodes = array();
   foreach($codes as $code){
        $trimed = preg_replace('%[0-9]%', '' , $code); 
        $charCodes[] = $trimed;  
   }
   
   $count = 0;
   
   //$charCodes = array();
   foreach($charCodes as $code){
   			if (in_array($code, $terminal3)) {
      		 $count++;
   			}
    } 
   $persent = ($count/10)*100;
    $persent = $persent . "%";
   return $persent;

}
function findTerminal4(){
    $terminal4 = array('JZA', 'FFT', 'SKV', 'SWA', 'SCX');
    $codes = getArrivalsCode();
    $codes = array_slice($codes, 9);
   $charCodes = array();
   foreach($codes as $code){
        $trimed = preg_replace('%[0-9]%', '' , $code); 
        $charCodes[] = $trimed;  
   }
   
   $count = 0;
   
   //$charCodes = array();
   foreach($charCodes as $code){
   			if (in_array($code, $terminal4)) {
      		 $count++;
   			}
    } 
   $persent = ($count/10)*100;
    $persent = $persent . "%";
   return $persent;
    
}

function findPersentage(){
    $terminal1 = findTerminal1();
    $terminal2 = findTerminal2();
    $terminal3 = findTerminal3();
    $terminal4 = findTerminal4();
    
    //$total = $terminal1 + $terminal2 + $terminal3 + $terminal4;
   
    
    return  "Tremianl 1: ". $terminal1. "<br />"
           ."Tremianl 2: ". $terminal2. "<br />"
           ."Tremianl 3: ". $terminal3. "<br />"
           ."Tremianl 4: ". $terminal4. "</ br>";
    
}







    

    
?>