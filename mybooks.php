<?php
session_start();
if(isset($_SESSION['loggedin']))
{
require_once("db.php");	
require_once("functions.php");

$function = $_REQUEST['function'];
$invno = $_REQUEST['invno'];
$ind=0;
if (strcmp($function,""))
$ind++;
if (strcmp($invno,""))
$ind++;
$mmflg=false;
if ($ind ==2)
{
if($function=="return")
{
$query = "select * from customer_check_out where customer_no like " . concat($_SESSION['cusno']) . 
" and inventory_no like " . concat($invno) . " and status like '1' and 
extract(year_month from check_out_date) = extract(year_month from now())";
$res1 = mysql_query($query) or die('Query failed: ' . mysql_error());
$max1 = mysql_num_rows($res1);	
if($max1>0)
$mmflag=true;
$query = "select * from customer_check_out where customer_no like " . concat($_SESSION['cusno']) . 
" and inventory_no like " . concat($invno) . " and status like '1' " ;
$res2 = mysql_query($query) or die('Query failed: ' . mysql_error());
$max2 = mysql_num_rows($res2);
if($max2 > 0)
{
$query = "update customer_check_out set status = '2' where customer_no like " . concat($_SESSION['cusno']) .
" and inventory_no like " . concat($invno) . " and status like '1'";
$res1 = mysql_query($query) or die('Query failed: ' . mysql_error());
$_SESSION['inhand']--;
if($mmflag)
$_SESSION['limit1']--;
}
}
}



$query = "select customer_check_out.inventory_no as invno, (to_days(now()) - to_days(due_date)) as differ,title,author,date_format(check_out_date,'%d-%m-%Y') as chk,date_format(due_date,'%d-%m-%Y') as due from customer_check_out,inventory where inventory.inventory_no like customer_check_out.inventory_no and customer_check_out.customer_no like " . concat($_SESSION['cusno']) . 
" and customer_check_out.status like '1'";
$res = mysql_query($query) or die('Query failed: ' . mysql_error());
$max = mysql_num_rows($res);
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
<?php
if ($max > 0)
{
$_SESSION['inhand'] = $max;	
?>
<div id="content">
<center><h3>Your books in hand</h3></center>
</div><br>
<div id="content">
<table width="97%" border="1" bordercolor="#4682B4">
<tr bgcolor = '#f0f0f0'>
<th>Title</th>
<th>Fine</th>
<th>Check Out</th>
<th>Due Date</th>
<th>Action</th>
</tr>
<tr>
<?php
$totfine=0;
while ($line = mysql_fetch_array($res, MYSQL_ASSOC))
{
$fine = 0;	
if ($line['differ'] <= 0)
echo "<tr bgcolor = '#66ccff'>";
else
{
echo "<tr bgcolor = '#FAAFBE'>";
$fine = $line['differ'] * 2;
$totfine = $totfine + $fine;
}
?>
<th><?php echo $line['title'];?></th>
<td><?php echo $fine;?></td>
<td><?php echo $line['chk'];?></td>
<td><?php echo $line['due'];?></td>
<td>
<a class="nav sub1" href="bdetailonline.php?invno=<?php echo $line['invno'];?>">Details</a>
<a class="nav sub1" href="mybooks.php?function=return&invno=<?php echo $line['invno'];?>">Return</a>
</td>
</tr>
<?php
}
?>
</table></div>
<br><div id="content">
<center><h5>Your Total Fine is Rs. <?php echo $totfine; ?> </h5></center>
</div>
<?php
}
else
{
?>
<div id="content">
<center><h3>You currently have no books in your hand</h3></center>
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
