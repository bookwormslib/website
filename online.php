<?php
session_start();

if(isset($_SESSION["loggedin"]))
{
//include("main.php");
header("Location: main.php");
}
else
{
$email = $_REQUEST["username"];
$password = $_REQUEST["password"];
$password = md5($password);
if (!empty($email) && !empty($password))
{
require_once("db.php");
require_once "m1.php";

$email = mysqli_real_escape_string($con,$email);
$password = mysqli_real_escape_string($con,$password);
 
$query = "select * from customer_reg where email like " . concat($email) . " and password like " . concat($password) . " and cus_no is not null";
$result = mysqli_query($con,$query)  or die('Query failed: ' . mysqli_error($con));
$num = mysqli_num_rows($result);
if($num > 0)
{
$line = mysqli_fetch_array($result, MYSQLI_ASSOC);
$name = $line['name'];
$stat = $line['status'];
$cusno = $line['cus_no'];
//echo $stat;
if ( $stat == 'A')
{
//Check for Payment
$query = "select max(pay_date) as pay from payment where customer_no like " . concat($cusno);
//echo $query;
$result = mysqli_query($con,$query)  or die('Query failed: ' . mysqli_error($con));
$num = mysqli_num_rows($result);
if($num > 0)
{
$line = mysqli_fetch_array($result, MYSQLI_ASSOC);
$max_date = $line['pay'];
$query= "select period_diff(DATE_FORMAT(now(),'%Y%m'),DATE_FORMAT(" . concat($max_date) . ",'%Y%m')) as period" ;
$result = mysqli_query($query)  or die('Query failed: ' . mysqli_error($con));
$line = mysqli_fetch_array($result, MYSQLI_ASSOC);
$period = $line['period'];
if($period <= 12)
{
//Check for month limit
$query="update customer_request set status = 'D' where cus_no like '" . $cusno ."' and status like 'I'";
$result = mysqli_query($con,$query)  or die('Query failed: ' . mysqli_error($con));
$query = "select count(*) as limits from customer_check_out where customer_no like " . concat($cusno) . " and status like '1' and
extract(year_month from check_out_date) = extract(year_month from now())";
//echo $query;
$result = mysqli_query($con,$query)  or die('Query failed: ' . mysqli_error($con));
$line = mysqli_fetch_array($result, MYSQLI_ASSOC);
$limit1 = $line['limits'];
$query = "select count(*) as limits2 from customer_check_out where customer_no like " . concat($cusno) . " and status like '0'"; 
$result = mysqli_query($con,$query)  or die('Query failed: ' . mysqli_error($con));
$line = mysqli_fetch_array($result, MYSQLI_ASSOC);
$limit2 = $line['limits2'];
$query = "select count(*) as lim from customer_check_out where customer_no like " . concat($cusno) . " and
extract(year_month from check_out_date) = extract(year_month from now()) and status not in ('0','4')"; 
$result = mysqli_query($con,$query)  or die('Query failed: ' . mysqli_error($con));
$line = mysqli_fetch_array($result, MYSQLI_ASSOC);
$curlimit = $line['lim'] + $limit2;
$this1 = $line['lim'];
//echo $curlimit;
$query = "select count(*) as inhand from customer_check_out where customer_no like " . concat($cusno). " and status like '1'";
$result = mysqli_query($con,$query)  or die('Query failed: ' . mysqli_error($con));
$line = mysqli_fetch_array($result, MYSQLI_ASSOC);
$inhand = $line['inhand'];
$ts = time();
$id = $ts . $cusno;
$maxlt = 25;
if($curlimit >= $maxlt)
{
$_SESSION['loggedin'] = true;
$_SESSION['id'] = $id;
$_SESSION['cusno'] = $cusno;
$_SESSION['name'] = $name;
$_SESSION['dues'] = true;
$_SESSION['ltflg'] = false;
$_SESSION['limit'] = $this1;
$_SESSION['inhand'] = $inhand;
$_SESSION['maxlt'] = $maxlt;
$_SESSION['cc'] = $maxlt - $curlimit;
$_SESSION['incart'] = 0;
$_SESSION['limit1'] = $limit1;
$_SESSION['limit2'] = $limit2;
//include("main.php");
header("Location: main.php");
}
else
{
$_SESSION['loggedin'] = true;
$_SESSION['id'] = $id;
$_SESSION['cusno'] = $cusno;
$_SESSION['name'] = $name;
$_SESSION['dues'] = true;
$_SESSION['ltflg'] = true;
$_SESSION['limit'] = $this1;
$_SESSION['inhand'] = $inhand;
$_SESSION['maxlt'] = $maxlt;
$_SESSION['cc'] = $maxlt - $curlimit;
$_SESSION['incart'] = 0;
$_SESSION['limit1'] = $limit1;
$_SESSION['limit2'] = $limit2;
//include("main.php");
header("Location: main.php");
}
}
else
{
$query = "update customer_reg set status='L' where cus_no like " . concat($cusno);
$result = mysqli_query($con,$query)  or die('Query failed: ' . mysqli_error($con));
include("paymentdue.php");
}
}
else
include("nopay.php");
}
else if ($stat == 'N' || $stat =='P')
{
include ("inactive.php");
$to = "vishnu.vijayaraghavan@gmail.com";
$subject = "Alert - Web";
$msg =  "User with E-Mail Id " . $email . " tried to login.<br><br>";
$msg .= "It is to be noted that his status is 'N' or 'P' - aka inactive.";

$nameto = "Vishnu";
$from = "info@bookwormslib.com";  
$namefrom = "bookworm's library";  
$newLine = "\r\n";  

$headers = "MIME-Version: 1.0" . $newLine;  
$headers .= "Content-type: text/html; charset=iso-8859-1" . $newLine;  
$headers .= "To: $nameto <$to>" . $newLine;  
$headers .= "From: $namefrom <$from>" . $newLine;  
authSendEmail($from, $namefrom, $to, $nameto, $subject, $msg);
}
else if ($stat == 'L')
include ("activelock.php");
}
else
include("loginerror.php");
}
else
include("loginempty.php");
}
?>

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
