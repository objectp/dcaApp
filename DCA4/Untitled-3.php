<?php 
$new = time();
$old = '2016-03-10 1:00am';

$old = strtotime($old);

$second = $new - $old;

function etime($s)
{    
    $time = "";
    $h = floor($s / 3600);
    $s -= $h * 3600;
    $m = floor($s / 60);
    $s -= $m * 60;
    
    if($h > 0){
        $time = $h.'h ';
    }
    if($m > 0){
        $time = $time. $m.'m ';
    }
    if($s > 0){
        $time = $time. $s.'s ';
    }
    //return $h.':'.sprintf('%02d', $m).':'.sprintf('%02d', $s);
    return $time;
}

echo etime($second);

//$date = new DateTime('Y-m-d');
//echo "<br />";

//echo date ('Y-m-d');


function dateToString($time){
    $d = date ('Y-m-d ');
    $t = substr($time, 4, 7);
    $dtString = $d.$t;
    echo $dtString;
}

//dateToString('Thu 12:47AM');