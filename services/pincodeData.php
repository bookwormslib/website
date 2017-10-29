<?php

require_once("../db.php");

$query = "select pincode, areaname from online_tariff";

$result = mysqli_query($con,$query)  or die('Query failed: ' . mysqli_error($con));

$final = '[';


while($line = mysqli_fetch_array($result, MYSQLI_ASSOC))
{

if($final=='[')
$final = $final . '"' . $line['pincode'] . '-' . $line['areaname'] . '"';
else
$final = $final . ',"' . $line['pincode'] . "-" . $line['areaname'] . '"';


}
$final = $final . ']';

echo $final;

?>
