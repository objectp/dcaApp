<?php
    
    class DisplayTransaction{
        public $totalDailyIncome;
        public $totalDailyAirportFee;
        public $totalDailyTransactionFee;
        public $totalDailyTripCount;
        public $lastTransactionAmount;
        
        
        public function __construct(){
            $this->totalDailyIncome = self::findTotalDailyIncome();
            $this->totalDailyAirportFee = self::findTotalDailyAirportFee();
            $this->totalDailyTransactionFee = self::findTotalDailyTransactionFee();
            $this->totalDailyTripCount = self::findTotalDailyTripCount();
            $this->lastTransactionAmount = self::findLastTransactionAmount();
        }
        
        public function findTotalDailyIncome(){
            global $conn;
            $sql = 'SELECT SUM(total_fare) FROM transactions WHERE today_or_old = 1'; 
            $results = $conn->query($sql);
            $row = $results->fetch();
            return "$".number_format($row['SUM(total_fare)'], 2);
        }
        
        public function findTotalDailyAirportFee(){
            global $conn;
            $sql = 'SELECT SUM(airport_fee) FROM transactions WHERE today_or_old = 1'; 
            $results = $conn->query($sql);
            $row = $results->fetch();
            return "$".number_format($row['SUM(airport_fee)'], 2);
        }
        
        public function findTotalDailyTransactionFee(){
            global $conn;
            $sql = 'SELECT SUM(transaction_fee) FROM transactions WHERE today_or_old = 1'; 
            $results = $conn->query($sql);
            $row = $results->fetch();
            return "$".number_format($row['SUM(transaction_fee)'], 2);
        }
        
        public function findTotalDailyTripCount(){
           global $conn;
            $sql = 'SELECT COUNT(today_or_old) FROM transactions WHERE today_or_old = 1'; 
            $results = $conn->query($sql);
            $row = $results->fetch();
            return $row['COUNT(today_or_old)']; 
        }
        
        public function findLastTransactionAmount(){
            global $conn;
            $last_id = $conn->lastInsertId();
            $sql = 'SELECT total_fare FROM transactions WHERE id = '.$last_id; 
            $results = $conn->query($sql);
            $row = $results->fetch();
            return $row['total_fare'];
            
        }
        
        public function updateToNewDailyIncome(){
            global $conn;
            $sql = 'UPDATE transactions SET today_or_old = 0 WHERE today_or_old = 1';
            $conn->query($sql);
        }
        
        public function deleteLastEntry()() {
        	global $conn;
            $last_id = $conn->lastInsertId();
            $sql = 'DELETE FROM transactions WHERE id = '.$last_id; 
            $result = $conn->query($sql);
            if ($result) {
            	
            }
            return 
        }
        
     /* function findFareAndTranFee(){
            try{
            global $conn; 
                $sql = 'SELECT total_fare, transaction_fee FROM transactions';
                $result = $conn->query($sql);
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
        }*/
    }