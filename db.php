<?php

$host = getenv('REMOTE_HOST');
$dbuser = getenv('REMOTE_USER');
$dbpass = getenv('REMOTE_PASS');

$con = mysql_connect($host, $dbuser, $dbpass) or  
    die("Could not connect: " . mysql_error()); 

mysql_select_db("online");  

?>


                  
