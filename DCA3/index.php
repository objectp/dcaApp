<?php require_once('init.php');?>
<!DOCTYPE html>
<html ng-app="myModule">
    <head>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
					#one {
					    color: blue;
					    font-family: verdana;
					    font-size: 200%;
					}
            .st{
                color: green;
            }
            
            tr:nth-child(even) {background: #CCC}
            tr:nth-child(odd) {background: #FFF}
            
            	
       </style>
    </head>
    
    <body onload="JavaScript:AutoRefresh(100000);" >


        <?php 

            $arrivalsObject = new Arrivals();
        ?>

        <div class="container">
            
            <div class="row"> 
                <div class="col-sm-12">

                  <table class="table">
                    <thead>
                      <tr>
                        <th>Code</th>
                        <th>Time</th>

                      </tr>
                    </thead>
                    <tbody>
                        <?php
                            $counter = 0;
                            foreach($arrivalsObject->combinedArray as $key => $value){
                                echo '<tr>';
                                    echo '<td>'.'<strong><a href="'.$arrivalsObject->codeUrls[$counter].'">'.$key.'</a></strong>'.'</td>';
                                    echo '<td>'.$value.'</td>';
                                echo '</tr>';
                                $counter++;
                            }

                        ?>


                    </tbody>
                  </table>
                </div>
            </div>
            <!------------------------------------------------>

         <!-- <div class="jumbotron">
            <h1>My First Bootstrap Page</h1>
            <p>Resize this responsive page to see the effect!</p> 
          </div>-->
            <div class="row"> 
                <div class="col-sm-3">
                  <?php $arrivalsObject->toString();?>
                </div>



                <div class="col-sm-9">

                    <h2>En route:</h2>
                  <?php 
                     $enroutesObject = new Enroutes();
                     echo '<strong>'; 
                         $enroutesObject->toString();
                     echo '</strong>';
                  ?>
                </div>
            </div>
        </div>

        <!-------------------AngjlarJS div----------------------------->
             <div ng-controller="myController">
                {{  }}
             </div>
        <!----------------------------------------------------------------->

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <!-- Latest compiled JavaScript -->
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <!--AngualrJs framework-->
        <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
        <!--AngularJS script-->
        <script src="javascript/angularJsScript.js"></script>
        <!--Javascript Page out refresh-->
        <script type="text/JavaScript">
                function AutoRefresh( t ) {setTimeout("location.reload(true);", t);}
        </script>

    </body>
</html>
