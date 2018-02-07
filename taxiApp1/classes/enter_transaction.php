<?php

class EnterTransaction{

    public $fare;
    public $DCTCFEE = 0.25;
    public $AIRPORTFEE = 3.00;
    public $transactionFee;
    public $cashOrCredit;
    public $airPortOrCity;
    public $dateAndTime;
    public $today_or_old;
    
    public function __construct($fa, $cashOrCredit, $apOrCt){
        if(($cashOrCredit == "Credit") && ($apOrCt == "Airport")){ 
            
            $this->fare = (self::findAirportFare($fa)) - (self::findTransactionFee($fa));
            $this->transactionFee = self::findTransactionFee($fa);
            
        }elseif(($cashOrCredit == "Cash") && ($apOrCt == "Airport")){
            $this->fare = self::findAirportFare($fa); 
            $this->transactionFee = 0.0;
        }elseif(($cashOrCredit == "Credit") && ($apOrCt == "City")){
            $this->fare = (self::findCityFare($fa)) - (self::findTransactionFee($fa));
            $this->transactionFee = self::findTransactionFee($fa);
        }elseif(($cashOrCredit == "Cash") && ($apOrCt == "City")){
            $this->fare = self::findCityFare($fa);
            $this->transactionFee = 0.0;
            $this->AIRPORTFEE = 0.0;
        }
       
        $this->cashOrCredit = $cashOrCredit;
        $this->airPortOrCity = $apOrCt;
        $this->dateAndTime = date('Y-m-d H:i:s', time());
        $this->today_or_old = 1;
        //insert the data
        $this->insert($this->fare, $this->DCTCFEE, $this->AIRPORTFEE, $this->transactionFee, $this->cashOrCredit, $this->airPortOrCity, $this->dateAndTime, $this->today_or_old);
        
    }
    
    public function findAirportFare($f){
        return $f - (3.25);
    }
    
    public function findCityFare($f){
        return $f - 0.25;
    }
    
    public function findTransactionFee($fare){
        return $fare * 0.0399; 
    }
    
    public function insert($f, $d_fee, $a_fee, $tf, $c_or_r, $a_or_c, $d, $t){
        global $conn;
         try{
        // prepare sql and bind parameters
        $stmt = $conn->prepare("INSERT INTO transactions(total_fare, dctc_fee, airport_fee, transaction_fee, cash_or_credit, airport_or_city, date_time, today_or_old) 
        VALUES (:ttotal_fare, :ddctc_fee, :aairport_fee, :ttransaction_fee, :ccash_or_credit, :aairport_or_city, :ddate_time, :ttoday_or_old)");
        $stmt->bindParam(':ttotal_fare', $f);
        $stmt->bindParam(':ddctc_fee', $d_fee);
        $stmt->bindParam(':aairport_fee', $a_fee);
        $stmt->bindParam(':ttransaction_fee', $tf);
        $stmt->bindParam(':ccash_or_credit', $c_or_r);
        $stmt->bindParam(':aairport_or_city', $a_or_c);
        $stmt->bindParam(':ddate_time', $d);
        $stmt->bindParam(':ttoday_or_old', $t);
        
        $stmt->execute();
       
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();

        }
    }
}