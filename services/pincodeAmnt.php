<?php

require_once("../db.php");

$pincode = $_REQUEST["pincode"];

$rate = 0;

if(strlen($pincode)>0)

{

$query = "select rate from online_tariff where pincode=" . $pincode ;

$result = mysqli_query($con,$query)  or die('Query failed: ' . mysqli_error($con));

if($line = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
$rate = $line['rate'];
}

}

echo $rate;

?>
