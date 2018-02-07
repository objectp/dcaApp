<?php require_once('dcac.php');?>
<!DOCTYPE html>
<html>
    <head>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <style>
					#one {
					    color: blue;
					    font-family: verdana;
					    font-size: 300%;
					}
					
				</style>
    </head>
<body onload="JavaScript:AutoRefresh(100000);">

    <div class="container">
     <!-- <div class="jumbotron">
        <h1>My First Bootstrap Page</h1>
        <p>Resize this responsive page to see the effect!</p> 
      </div>-->
        
      <div class="row">
        <div class="col-sm-1">
          <table border="1px">
			  <tr>
			    <th>Code:</th>
			  </tr>

			  <?php
             
                  $codes = DcaArrivals::getArrivalsTrimedCodes(DcaArrivals::getContent());
                  $counter = 0;
                  foreach ($codes as $code) {
                 // for ($i = 0; $i < 10; $i++) {
                  	if($counter == 10){
                  	   break;
                  	}
                  
                     echo "<tr>";
                      echo "<td>";
                        echo "<strong>".$code . "</strong>";
                      echo "</td>";
                     echo '</tr>';
                     $counter++;
                  }
			  ?>
			  
			</table>
        </div>
          
        <div class="col-sm-2">
          <table border="1px">
			  <tr>
			    <th>Time:</th>
			  </tr>
			  <?php 
			           $counter2 =0;
                  foreach (DcaArrivals::getArrivalsTrimedTimes(DcaArrivals::getContent()) as $time) {
                     
                     if ($counter2 == 10) {
                     	   break;
                     }
                     echo "<tr>";
                      echo "<td>";
                        echo $time ;
                      echo "</td>";
                     echo '</tr>';
                     $counter2++;
                  }
              
			  ?>
			  
			</table>
        </div>
          
        <div id="one"bclass="col-sm-3">
          <?php echo DcaArrivals::toString();
           
            ?>
            
        </div>
          <!--
        <div class="col-sm-3">
          <h3>Column 4</h3> 
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit...</p>
          <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris...</p>
        </div-->
          
      </div>
    </div>
    
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script type="text/JavaScript">
         <!--
            function AutoRefresh( t ) {
               setTimeout("location.reload(true);", t);
            }
         //-->
      </script>
</body>
</html>
