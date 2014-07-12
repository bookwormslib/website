<?php
function concat($str)
{
$str = "'" . $str . "'";
return $str;
}

function dateconvert($date) {
list($day, $month, $year) = split('[/.-]', $date);
$date = "$year-$month-$day";
return $date;
} 
?>
