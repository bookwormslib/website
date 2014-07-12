<?php

require_once("../db.php");

$query = "select pincode, areaname from online_tariff";

$result = mysql_query($query)  or die('Query failed: ' . mysql_error());

$final = '[';


while($line = mysql_fetch_array($result, MYSQL_ASSOC))
{

if($final=='[')
$final = $final . '"' . $line['pincode'] . '-' . $line['areaname'] . '"';
else
$final = $final . ',"' . $line['pincode'] . "-" . $line['areaname'] . '"';


}
$final = $final . ']';

echo $final;

?>