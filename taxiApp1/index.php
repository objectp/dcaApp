<?php 
    try{
        require_once('databaseConnection.php');
        require_once('classes/enter_transaction.php');
        require_once('classes/display_transaction.php');
    }catch (Exception $e){
        $error = $e->getMessage();
    }

    if(isset($_POST['fare'])){
        $fare = $_POST['fare'];
    }
    if(isset($_POST['credit_cash'])){
        $cashOrCredit = $_POST['credit_cash'];
    }
    if(isset($_POST['airport_city'])){
        $airportOrCity = $_POST['airport_city'];
    }
    

    
    if(isset($_POST['fare']) && ($_POST['fare'] != "")){
        $t = new EnterTransaction($fare, $cashOrCredit, $airportOrCity);
        //clear memory to avoid duplicate entry
        $_POST['fare'] = "";
    }
    
    


    $display = new DisplayTransaction();
    
    
    if(isset($_GET['name'])){
    	$display->updateToNewDailyIncome();
    }
  
?>
<!DOCTYPE html>
    <html>
        <head>
            <!-- Latest compiled and minified CSS -->
            <!--<link rel="stylesheet" type="text/css" href="styles/main.css">-->
            <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
            <meta name="viewport" content="width=device-width, initial-scale=1">
        
        </head>
        <body>
            <div class="container">
                <div class="row"> 
                    <form onsubmit="return confirm('Do you want to enter the amount?');" class="form-group" method="post" action="index.php" >
                        <div class="form-group">
                            <label for="usr">Fare:</label>
                            <input id="fareid" class="form-control input-lg" type="number" name="fare"><br>
                        </div>
                          <select name="credit_cash">
                              <option value="Credit">Credit</option>
                              <option value="Cash">Cash</option>
                          </select>  
                          <select name="airport_city">
                              <option value="Airport">Airport</option>
                              <option value="City">City</option>
                          </select> 
                          <input class="btn btn-primary" type="submit" value="Save">
                    </form>
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table" border="1px">
                                <thead>
                                    <tr>
                                        <th>ToInc</th>
                                        <th>TranFee</th>
                                        <th>TriCou</th>
                                        <th>AirFee</th>
                                        <th>LastAmt</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?php echo $display->totalDailyIncome;?></td>
                                        <td><?php echo $display->totalDailyTransactionFee;?></td>
                                        <td><?php echo $display->totalDailyTripCount;?></td>
                                        <td><?php echo $display->totalDailyAirportFee;?></td>
                                        <td><?php echo $display->lastTransactionAmount;?></td>

                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <h6><a onclick="return confirm('Do you want new entries?')" href="index.php?name=new_entry">New Entry</a></h6>
            
        </body>
    </html>
