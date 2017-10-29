<?php

require_once("db.php");
$mail= $_REQUEST["mail"];
$query = "select count(1) as count from customer_reg where email='" . $mail .	"'";
$result = mysqli_query($con,$query)  or die('Query failed: ' . mysqli_error($con));
$line = mysqli_fetch_array($result, MYSQLI_ASSOC);
$period = $line['count'];
if($period == 0)
{
echo "OK";
}
else
{
echo 'E-Mail Id Already Registered';
}
?>
