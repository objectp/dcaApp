<?php 

class Enroutes{
    public $enrouteTimes;
    
    public function __construct(){
        
        $this->enrouteTimes = self::getEnroutesTimes();
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

        $counter = 0;
        foreach($trimedTimes as $key => $value){
            if($key % 2 != 0){
                $odds[] = $value;
            }
            $counter++;
            if($counter == 40){
                break;
            }
        }
        return $odds;
    }
    
    public function toString(){
        foreach($this->enrouteTimes as $t){
           echo $t ."<br>";
        }
    }
}




