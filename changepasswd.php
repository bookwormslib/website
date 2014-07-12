<?php
session_start();
if(isset($_SESSION['loggedin']))
{
require_once("db.php");	
require_once("functions.php");

$query = "select count(*) as lim from customer_check_out where customer_no like " . concat($_SESSION['cusno']) . " and
extract(year_month from check_out_date) = extract(year_month from now()) and status not in ('0','4')"; 
$result = mysql_query($query)  or die('Query failed: ' . mysql_error());
$line = mysql_fetch_array($result, MYSQL_ASSOC);
$this = $line['lim'];
//echo $this;
if($_SESSION['limit'] != $this)
$_SESSION['limit'] = $this;

$query = "select count(*) as limits from customer_check_out where customer_no like " . concat($_SESSION['cusno']) . " and status like '1' and
extract(year_month from check_out_date) = extract(year_month from now())";
//echo $query;
$result = mysql_query($query)  or die('Query failed: ' . mysql_error());
$line = mysql_fetch_array($result, MYSQL_ASSOC);
$limit1 = $line['limits'];
if ($_SESSION['limit1'] != $limit1)
$_SESSION['limit1'] = $limit1;

$query = "select count(*) as limits2 from customer_check_out where customer_no like " . concat($_SESSION['cusno']) . " and status like '0'"; 
$result = mysql_query($query)  or die('Query failed: ' . mysql_error());
$line = mysql_fetch_array($result, MYSQL_ASSOC);
$limit2 = $line['limits2'];
if ($_SESSION['limit2'] != $limit2)
$_SESSION['limit2'] = $limit2;

$query = "select count(*) as inhand from customer_check_out where customer_no like " . concat($_SESSION['cusno']). " and status like '1'";
$result = mysql_query($query)  or die('Query failed: ' . mysql_error());
$line = mysql_fetch_array($result, MYSQL_ASSOC);
$inhand = $line['inhand'];
if($_SESSION['inhand'] != $inhand)
$_SESSION['inhand'] = $inhand;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>bookworms' library : a nest too cosy to miss...</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<meta name="description" content="bookworms library chennai online" />
<meta name="keywords" content="bookworms,library,chennai,mobile,online" />
<meta name="author" content="Your Name / Original design by Andreas Viklund - http://andreasviklund.com" />
<link rel="stylesheet" href="andreas09.css" type="text/css" media="screen" />
 <script type="text/javascript" src="js/yav.js"></script>
    <script type="text/javascript" src="js/yav-config.js"></script>
<script type="text/javascript" language="javascript">
    var rules=new Array();
    rules[0]='old_pass:Old Password|required';
    rules[1]='old_pass:Old Password|minlength|5';
    rules[2]='new_pass:New Password|required';
    rules[3]='new_pass:New Password|minlength|5';    
    rules[4]='conf_pass:Confirm Password|required';
     rules[5]='old_pass:Confirm Password|notequal|$new_pass|Old Password & New Password should not be same';    
     rules[6]='conf_pass:Confirm Password|equal|$new_pass|Confirm Password & New Password not Same';
</script>    
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
$query = "select title,inventory.inventory_no as invno from customer_request,inventory where customer_request.inventory_no like inventory.inventory_no and customer_request.status like 'I'and extract(day_hour from date) like extract(day_hour from now()) and 
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
<div id="content">
<center><h3>Change Password</h3></center>
</div><br>
<div id="content">
<div id="errorsDiv"></div>
<form name="reg" onsubmit="return performCheck('reg',rules,'innerHtml');"  method="POST"  action="passchange.php" >
<table width="95%">
<tr>
<th><font color="red">Old Password</font></th>
<td><input type="password" class="searchbox1"  name="old_pass"></td>
</tr><tr>
<th><font color="red">New Password</font></th>
<td><input type="password" class="searchbox1" name="new_pass"></td>
</tr><tr>
<th><font color="red">Confirm Password</font></th>
<td><input type="password" class="searchbox1" name="conf_pass"></td>
</tr>
</table>
<br>
<center>
<input type="submit" class="searchbutton" value="Submit">
<input type="reset" class="searchbutton" value="Reset&nbsp">
</center>
<br>
<p>*Fields in <font color="red">RED</font> are mandatory<br>
*New Password Change will be affected only during next login</p>
</form>
</div>

<div class="clearingdiv">&nbsp;</div>
</div>
</div>
<div id="footer">&copy; 2006-2010 bookworms' library | Design by <a href="http://www.sayee.no-ip.com">Seshasayee Gopi</a> | Tech Support by <a href="http://www.fourvees.com">Vishnu Vijayaraghavan</a></div>

<?php
}
else
include("sessionexpire.php");
?>
