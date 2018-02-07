<?php 

class Enroutes{
    public $enrouteTimes;
    public $enrouteElaspe;
    
    public function __construct(){
        
        //$this->enrouteTimes = array('A', 'B', 'C');
        $this->enrouteTimes = self::getEnroutesTimes();
        $this->enrouteElaspe = self::findTimeElapseForFutureTimes();
    }

     //Get enrout content
    public function getContent(){
        $url = "http://flightaware.com/live/airport/KDCA/enroute";
        return file_get_contents($url);
    }

    //Get enrout time
    public function getEnroutesTimes(){
        $patern = '%[A-Z]{1}[a-z]{2}\s[0-9]{1,2}:[0-9]{2}(AM|PM)%';
        preg_match_all($patern, self::getContent(), $times);

        foreach($times as $time){
            foreach($time as $t){
                $trimedTimes[] = $t;
            }
        }
        for ($i = 0; $i < 40; $i++) {
        	$trimedTimes2[$i] = $trimedTimes[$i];
        }
        return $trimedTimes2;
    }
    
    // Convert date to string 
    function dateToString($time){
        $d = date ('Y-m-d ');
        $t = substr($time, 4, 7);
        $dtString = $d.$t;
        return $dtString;
    }
    
    //Find future times
    function findFutureTimes(){
        $enroutTimes = self::getEnroutesTimes();

        foreach($enroutTimes as $t){
            $tString = self::dateToString($t);
            $futureTime = strtotime($tString);
            $nowTime = time();
            if($futureTime > $nowTime){
                $futureTimesArray[] = $t;
            }
            
        }
        return $futureTimesArray;
    }
    //Calculate time
    function timeElapse($s){  
        
        $time = "";
        $h = floor($s / 3600);
        $s -= $h * 3600;
        $m = floor($s / 60);
        $s -= $m * 60;

        if($h > 0){
            $time = $h.'h ';
        }
        if($m > 0){
            $time = $time. $m.'m ';
        }
        /*if($s > 0){
            $time = $time. $s.'s ';
        }*/
        //return $h.':'.sprintf('%02d', $m).':'.sprintf('%02d', $s);
        return 'After '.$time;
    }
    
    //Find future elapsed times
    function findTimeElapseForFutureTimes(){
        $futureTimes = self::findFutureTimes();
        foreach($futureTimes as $ft){
           $tString = self::dateToString($ft);
           $fTime = strtotime($tString); 
           $currentTime = time();
            
           $elapse = self::timeElapse($fTime - $currentTime);
           $elaspeArray[] = $elapse;
        }
        return $elaspeArray;
    }

}

$enroutesObject = new Enroutes();

// convert to json
$json = json_encode($enroutesObject);

// echo the json string
echo $json;




