<?php

require_once("../db.php");

$pincode = $_REQUEST["pincode"];

$rate = 0;

if(strlen($pincode)>0)

{

$query = "select rate from online_tariff where pincode=" . $pincode ;

$result = mysql_query($query)  or die('Query failed: ' . mysql_error());

if($line = mysql_fetch_array($result, MYSQL_ASSOC))
{
$rate = $line['rate'];
}

}

echo $rate;

?>