<?php 
    $servername = "xxx.ipagemysql.com";
    $username = "xxx";
    $password = "xxx";
    $dbname = "xxx";
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
   /* if($conn){
        echo "connected <br />";
    }else{
        echo "not connected"; 
    }*/
   
?>
