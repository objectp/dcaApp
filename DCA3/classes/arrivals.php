<?php 

class Arrivals{
    //public $content;
    public $flightCodes;
    public $flightTimes;
    public $codeUrls;
    public $combinedArray;
    public $persentage1,$persentage2,$persentage3,$persentage4;
    public $terminal1 = array('AWI', 'RPA', 'JPA', 'ASA', 'VRD', 'EGF', 'PDT', 'VRD', 'AAL', 'JIA');
    public $terminal2 = array('JBU');
    public $terminal3 = array('ASH', 'FLG', 'TCF', 'LOF', 'GJS', 'SKW', 'DAL', 'UAL', 'ASQ');
    public $terminal4 = array('JZA', 'FFT', 'SKV', 'SWA', 'SCX');
    //public $terminalPersentage; 

    //Constract object
    public function __construct(){
        //$this->content = self::getContent();
        $this->flightCodes = self::getArrivalsCodes();
        $this->flightTimes = self::getArrivalsTimes();
        $this->codeUrls = self::getUrl();
        $this->combinedArray = self::combineCodeTime();
        
        $this->persentage1 = self::findAterminalPersentage($this->terminal1);
        $this->persentage2 = self::findAterminalPersentage($this->terminal2);
        $this->persentage3 = self::findAterminalPersentage($this->terminal3);
        $this->persentage4 = self::findAterminalPersentage($this->terminal4);

    }
    //Get content
    public function getContent(){
        $url = "http://flightaware.com/live/airport/KDCA/arrivals";
        return file_get_contents($url);
    }
    //Get codes
    public function getArrivalsCodes(){
        $patern = '%[A-Z]{3}[0-9]{2,4}%';
        preg_match_all($patern, self::getContent(), $codes);
        $codes = array_unique($codes);
        
      
        foreach($codes as $code){
            foreach($code as $c){
                $trimedCodes[] = $c;
            }
        }
        $trimedCodes = array_unique($trimedCodes);
        $counter = 0;
        foreach($trimedCodes as $tmc){
            $finalCodes[] = $tmc;
            $counter++;
            if($counter == 10){
                break;
            }
        }
        return $finalCodes;
    }
    //Get time
    public function getArrivalsTimes(){
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
            if($counter == 20){
                break;
            }
        }
        return $odds;
    }
    
    //Combine code and time as key value
    public function combineCodeTime(){
       return array_combine(self::assignCodeToTerminal(), $this->flightTimes); 
    }
    //Get each url
    public function getUrl(){
        
        $codes = self::getArrivalsCodes();
        
        $pattern = '%\/live\/flight\/id\/[A-Z]{1,3}[0-9]{2,5}\-[0-9]+\-[a-zA-Z0-9]+\-[0-9]+%';
        preg_match_all($pattern, self::getContent(), $matches);
        
        foreach($matches as $match){
            foreach($match as $m){
                $matchedArray[] = $m;
            }
        }
        
        $urlsArray = array();
        foreach($matchedArray as $match){
            $url = 'http://flightaware.com'.$match;
            $urlsArray[] = $url;
        }
        
        $counter = 0;
        foreach($urlsArray as $ul){
           $urlsArray10[] = $ul;
           $counter++;
           if($counter == 10){
               break;
           }
        }
        return $urlsArray10;
    }
    //Get persentage 
    public function findAterminalPersentage($tm){
       
        
        $codes = self::getArrivalsCodes();

        foreach($codes as $code){
            $trimed = preg_replace('%[0-9]%', '', $code);
            $charCodes[] = $trimed;

        }

        $counter = 0;
        foreach($charCodes as $code){
            if(in_array($code, $tm)){
                $counter++;
            }
        }

        $persentage = ceil(($counter/9)*100);
        $persentage = $persentage . "%";
        return $persentage;

    }
    //Gets string version of the object
    public function toString(){
        
        echo 'Terminal 1: <strong class="st">'. $this->persentage1.'</strong>'.': Gate 35-45'.'<br />';
        echo 'Terminal 2: <strong class="st">'. $this->persentage2.'</strong>'.': Gate 23-34'.'<br />';
        echo 'Terminal 3: <strong class="st">'. $this->persentage3.'</strong>'.': Gate 10-22'.'<br />';
        echo 'Terminal 4: <strong class="st">'. $this->persentage4.'</strong>'.': Gate 10-22'.'<br />';
    }
    
    //Assign flight code to terminal
    public function assignCodeToTerminal(){
        
        $codes = self::getArrivalsCodes();
        $counter = 0;
       
        foreach($codes as $code){
            $sub = substr($code, 0, 3);
            
            if(in_array($sub, $this->terminal1)){
               $codes[$counter] = $code . ' (T1)';
               $counter++;
            }elseif(in_array($sub, $this->terminal2)){
               $codes[$counter] = $code . ' (T2)';
               $counter++;
            }elseif(in_array($sub, $this->terminal3)){
               $codes[$counter] = $code . ' (T3)';
               $counter++;
            }elseif(in_array($sub, $this->terminal4)){
               $codes[$counter] = $code . ' (T4)';
               $counter++;
            }
        }
        return $codes;
    }
    
   
}
    

/*$x = new Arrivals();


echo "<pre>";
print_r($x->assignCodeToTerminal());*/


   

?>