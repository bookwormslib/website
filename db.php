<?php

$host = getenv('REMOTE_HOST');
$dbuser = getenv('REMOTE_USER');
$dbpass = getenv('REMOTE_PASS');
$db =  getenv('REMOTE_DB');

$con = mysqli_connect($host, $dbuser, $dbpass) or  
    die("Could not connect: " . mysql_error()); 

mysqli_select_db($con,$db);  

?>


                  
