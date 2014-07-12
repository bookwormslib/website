<?php
session_start();
if(isset($_SESSION['loggedin']))
{
require_once("db.php");	
require_once("functions.php");
$succ=0;
$query = "select count(*) as limits from customer_check_out where customer_no like " . concat($_SESSION['cusno']) . " and status not in ('0','4') and
extract(year_month from check_out_date) = extract(year_month from now())";
//echo $query;
$result = mysql_query($query)  or die('Query failed: ' . mysql_error());
$line = mysql_fetch_array($result, MYSQL_ASSOC);
$curlimit = $line['limits'];
$query = "select count(*) as lim from customer_check_out where customer_no like " . concat($_SESSION['cusno']) . " and status like '0'";
//echo $query;
$result = mysql_query($query)  or die('Query failed: ' . mysql_error());
$line = mysql_fetch_array($result, MYSQL_ASSOC);
$req = $line['lim'];
$lim = $curlimit + $req;
//echo $curlimit;
$query = "select count(*) as inhand from customer_check_out where customer_no like " . concat($_SESSION['cusno']). " and status like '1'";
$result = mysql_query($query)  or die('Query failed: ' . mysql_error());
$line = mysql_fetch_array($result, MYSQL_ASSOC);
$inhand = $line['inhand'];
if($_SESSION['ltflg'])
if($_SESSION['incart']!=0)
if($_SESSION['incart'] <= ($_SESSION['maxlt'] - $lim))
if($lim < $_SESSION['maxlt'])
{
$query = "select title,inventory.inventory_no as invno from customer_request,inventory where customer_request.inventory_no like inventory.inventory_no  and customer_request.status like 'I' and extract(day_hour from date) like extract(day_hour from now()) and
customer_request.cus_no like " . concat($_SESSION['cusno']) . " and session_id like " . concat($_SESSION['id']);
$res = mysql_query($query)  or die('Query failed: ' . mysql_error());
$num = mysql_num_rows($result);
if($num>0)
{
$re=mysql_query("START TRANSACTION");	
while ($line = mysql_fetch_array($res, MYSQL_ASSOC)) 
{
$query1 = "insert into customer_check_out values(null," . concat($_SESSION['cusno']) . "," . concat($line['invno']) . ",now(),'0001-01-01',date_add(now(),interval 14 day),'0')";
$query2 = "update inventory set available='R' where inventory_no like " . concat($line['invno']);
$query3 = "update customer_request set status='C' where session_id like " . concat($_SESSION['id']) . " and cus_no like " . concat($_SESSION['cusno']);
$res2 = mysql_query($query1)  or die('Query failed: ' . mysql_error());
if ($res2)
$succ=1;
else
{
$succ=0;
break;
}
$res2 = mysql_query($query2)  or die('Query failed: ' . mysql_error());
if ($res2)
$succ=1;
else
{
$succ=0;
break;
}
$res2 = mysql_query($query3)  or die('Query failed: ' . mysql_error());
if ($res2)
$succ=1;
else
{
$succ=0;
break;
}
}
if ($succ=1)
$re=mysql_query("COMMIT");
else
$re=mysql_query("ROLLBACK");
}
else
$succ = 2;
}
if($succ==1)
{
$_SESSION['limit2'] = $_SESSION['limit2'] + $_SESSION['incart'];	
//$_SESSION['limit'] = $_SESSION['limit1'] + $_SESSION['limit2'];
//echo $lim;
$curlimit = $lim + $_SESSION['incart'];
//echo $curlimit;
//$_SESSION['inhand'] = $inhand + $_SESSION['incart'];
$_SESSION['cc'] = $_SESSION['maxlt'] - $curlimit;
$_SESSION['incart'] = 0;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-28933931-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<head>
<title>bookworms' library : a nest too cosy to miss...</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<meta name="description" content="bookworms library chennai" />
<meta name="keywords" content="bookworms,library,chennai,mobile,online" />
<meta name="author" content="Your Name / Original design by Andreas Viklund - http://andreasviklund.com" />
<link rel="stylesheet" href="andreas09.css" type="text/css" media="screen" />
</head>

<body>

<div id="container">

<?php
include("include/banner.html");
include("include/mainmenu.html");
?>

<div id="wrap">

<div id="leftside">
<h1><a href="online.php">My Library</a></h1>
<p>
<a class="nav" href="mybooks.php">My Books (<?php echo $_SESSION['inhand'];?>)</a><span class="hide"> | </span>

<a class="nav" href="thismonth.php">This Month (<?php echo $_SESSION['limit1'];?>)</a><span class="hide"> | </span>

<a class="nav" href="mycheckouts.php">My Checkouts (<?php echo $_SESSION['limit2'];?>)</a><span class="hide"> | </span>

<a class="nav" href="myreturns.php">My Returns</a><span class="hide"> | </span>

<a class="nav" href="profile.php">My Profile</a><span class="hide"> | </span>

<a class="nav" href="changepasswd.php">Change Password</a><span class="hide"> | </span>

<a class="nav" href="latest.php">New Additions</a><span class="hide"> | </span>

<a class="nav" href="logout.php">Logout</a><span class="hide"> | </span>

</p>

<?php
include("include/top3.html");
?>

</div>

<div id="rightside">
<h1>Search</h1>
<p class="searchform" >
<form method="get" action="searchonline.php">
<input type="text" alt="Search" class="searchbox" name="keyword" />
<input type="hidden" name="page" value="1"/>
<input type="submit" value="Go!" class="searchbutton" />
</form>
</p>
<br>
<?php
$query = "select title,inventory.inventory_no as invno from customer_request,inventory where customer_request.inventory_no like inventory.inventory_no and customer_request.status like 'I'and
customer_request.cus_no like " . concat($_SESSION['cusno']) . " and session_id like " . concat($_SESSION['id']);
//echo $query;
$result = mysql_query($query)  or die('Query failed: ' . mysql_error());
$num = mysql_num_rows($result);
if ($num > 0)
{
?>
<h1><a href="mycart.php">My Cart (<?php echo $num; ?>)</a></h1>
<p>
<a class="nav" href="mycart.php">Check Out</a><span class="hide"> | </span>
<?php
while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) 
{
?>
<a class="nav sub" href="bdetailonline.php?invno=<?php echo $line['invno'];?>"><?php echo $line['title'];?></a><span class="hide"> | </span>
<?php
}
echo "</p>";
}
?>
<br>
<?php
include("include/snippet.html");
?>
</div>
<?php
if ($succ==0)
{
?>	
<div id="content">
<center><h3>Your Transaction Failed, Try again latter</h3>
</center>
</div>
<?php
}
else
{
?>
<div id="content">
<center><h3>Transaction Successful,</h3>
<br>
You will be getting your inventory with in 2 business days
</center>
</div>
<?php
}
?>

<div class="clearingdiv">&nbsp;</div>
</div>
</div>
<div id="footer">&copy; 2006-2010 bookworms' library | Design by <a href="http://www.sayee.no-ip.com">Seshasayee Gopi</a> | Tech Support by <a href="http://www.fourvees.com">Vishnu Vijayaraghavan</a></div>

<?php
}
else
include("sessionexpire.php");
?>
