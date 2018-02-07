<?php 

class DcaArrivals{
    
     
    /*public function __constract(){*/


    public static function getContent(){
        $contentUrl = 'https://flightaware.com/live/airport/KDCA/arrivals';
        $arrivalsContent = file_get_contents($contentUrl);
        return $arrivalsContent;
    }

    public static function getArrivalsTrimedCodes($content){
        preg_match_all('%[A-Z]{3}[0-9]{2,4}%', $content, $codes);
        $codes = array_unique($codes);

        $trimedCodes = array();
        
        foreach($codes as $code){
            foreach($code as $c){
   
                $trimedCodes[] = $c;
                
            }
        }
        /*$theCode = array_unique($trimedCodes);
        $trimedCodes2 = array();
        for ($i = 0; $i < 10; $i++) {
        	$trimedCodes2[$i] = $theCode[$i];
        }*/
        return array_unique($trimedCodes);
    }

    public static function getArrivalsTrimedTimes($content){
        preg_match_all('%[A-Z]{1}[a-z]{2}\s[0-9]{1,2}:[0-9]{2}(AM|PM)%', $content, $times);

        $trimedTimes = array();
        foreach($times as $time){
            foreach($time as $t){
                $trimedTimes[] = $t;
            }
        }

        $odds = array();
        foreach($trimedTimes as $key => $value){
            if($key % 2 != 0){
                $odds[] = $value;
            }
        }

        
        return $odds;
    }

    public function appebdTerminalToCode($trimedCods){
        $newArray = array();
        $terminal1Codes = array('AWI', 'RPA', 'JPA', 'ASA', 'VRD', 'EGF', 'ASQ', 'PDT', 'VRD', 'AAL');
        $terminal2Codes = array('TCF', 'ASH', 'ASQ', 'JBU');
        $terminal3Codes = array('FLG', 'LOF', 'GJS', 'SKW', 'DAL', 'UAL');
        $terminal4Codes = array('JZA', 'FFT', 'SKV', 'SWA', 'SCX');
        
        foreach ($trimedCods as $trimedCode) {
        
           if(in_array($trimedCode, $terminal1Codes)){
                $newArray[] = 1.$trimedCode;
            }else {
            	  $newArray[] = $trimedCode;
            }
            if(in_array($trimedCode, $terminal2Codes)){
                $newArray[] = 2.$trimedCode;
            }else {
            	  $newArray[] = $trimedCode;
            }
            
        }
    	
    }
    public static function findAterminalPersentage($terminalCodes, $trimedCodes){
        $codes = array_slice($trimedCodes, 9);

        $charCodes = array();
        foreach($codes as $code){
            $trimed = preg_replace('%[0-9]%', '', $code);
            $charCodes[] = $trimed;
            
        }

        $counter = 0;
        foreach($charCodes as $code){
            if(in_array($code, $terminalCodes)){
                $counter++;
            }
        }

        $persentage = ($counter/10)*100;
        $persentage = $persentage . "%";
        return $persentage;

    }
    

    public static function toString(){
        $terminal1Codes = array('AWI', 'RPA', 'JPA', 'ASA', 'VRD', 'EGF', 'ASQ', 'PDT', 'VRD', 'AAL');
        $terminal2Codes = array('TCF', 'ASH', 'ASQ', 'JBU');
        $terminal3Codes = array('FLG', 'LOF', 'GJS', 'SKW', 'DAL', 'UAL');
        $terminal4Codes = array('JZA', 'FFT', 'SKV', 'SWA', 'SCX');
        
        $string  = "Terminal 1: ".self::findAterminalPersentage($terminal1Codes, self::getArrivalsTrimedCodes(self::getContent()))."<br />";
        $string .= "Terminal 2: ".self::findAterminalPersentage($terminal2Codes, self::getArrivalsTrimedCodes(self::getContent()))."<br />";
        $string .= "Terminal 3: ".self::findAterminalPersentage($terminal3Codes, self::getArrivalsTrimedCodes(self::getContent()))."<br />";
        $string .= "Terminal 4: ".self::findAterminalPersentage($terminal4Codes, self::getArrivalsTrimedCodes(self::getContent()))."<br />";
        return $string;
    }
}

    
?>
