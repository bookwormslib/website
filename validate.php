<?php

require_once("db.php");
$mail= $_REQUEST["mail"];
$query = "select count(1) as count from customer_reg where email='" . $mail .	"'";
$result = mysql_query($query)  or die('Query failed: ' . mysql_error());
$line = mysql_fetch_array($result, MYSQL_ASSOC);
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