<?php require_once('functions.php')?>
<!DOCTYPE html>
<html>
    <head>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    </head>
<body>

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
                  foreach (getArrivalsCode() as $code) {
                     echo "<tr>";
                      echo "<td>";
                        echo "<strong>".$code . "<strong>";
                      echo "</td>";
                     echo '</tr>';
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
                  foreach (getArrivalsTime() as $time) {
                     echo "<tr>";
                      echo "<td>";
                        echo $time ;
                      echo "</td>";
                     echo '</tr>';
                  }
              /*echo "<pre>";
              echo var_dump(findPersentage());*/
			  ?>
			  
			</table>
        </div>
          
        <div class="col-sm-3">
          <h3>Count:</h3> 
          <?php echo findPersentage();?>
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
</body>
</html>