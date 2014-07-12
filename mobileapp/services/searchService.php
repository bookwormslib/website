<?php

require_once('JSON.php');
require_once('db.php');

$json = new Services_JSON();

$a = array();

$q = $_REQUEST["query"];

$query = "select count(title) count,title,inventory_no,subject,author from inventory where title like '" . $q . "%' or author like '" . $q . "%' or subject like '" . $q . "%'  group by title limit 500"; 

$result = mysql_query($query) or die('Query failed: ' . mysql_error());

while($row = mysql_fetch_array($result, MYSQL_ASSOC))
{

array_push($a,$row);

}

echo $json->encode($a);

?>