<?php
session_start();
if(isset($_SESSION['loggedin']))
{
require_once("db.php");	
require_once("functions.php");
$invno = $_REQUEST["invno"];
$function = $_REQUEST["function"];
if(strcmp($function,"") && strcmp($invno,""))
{
if($function=="remove")
{
$query = "update customer_request set status = 'D' where session_id like " . concat($_SESSION['id']) . 
" and cus_no like " . concat($_SESSION['cusno']) . " and inventory_no like " . concat($invno);
//echo $query;
$res = mysql_query($query) or die('Query failed: ' . mysql_error());
if($res)
{
if ($_SESSION > 0)	
$_SESSION['incart']--;
}
}
}
//$ind=0;
//if (strcmp($invno,""))
//{
$query = "select inventory.title as title, inventory.author as auth, 
customer_request.inventory_no as inv_no 
from inventory,customer_request 
where inventory.inventory_no like customer_request.inventory_no 
and customer_request.status like 'I' and customer_request.session_id like "  . concat($_SESSION['id']) .
" and extract(day_hour from date) like extract(day_hour from now()) and customer_request.cus_no like " . concat($_SESSION['cusno']) ;
//echo $query;
$result1 = mysql_query($query) or die('Query failed: ' . mysql_error());
//}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>bookworms' library : a nest too cosy to miss...</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<meta name="description" content="bookworms library chennai cart" />
<meta name="keywords" content="bookworms,library,chennai,online,cart,mobile" />
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
$query = "select title,inventory.inventory_no as invno from customer_request,inventory where customer_request.inventory_no like inventory.inventory_no  and customer_request.status like 'I' and extract(day_hour from date) like extract(day_hour from now())and
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
<center><h3>My Cart</h3>
</div>
<br>
<?php	
$max = mysql_num_rows($result1);
$_SESSION['incart'] = $max;
if($max>0)
{
?>
<div id="content">
<table border="1" bordercolor="#4682B4" width="97%" >
<tr>
<th align="center">Title</th>
<th align="center">Author</th>
<th align="center">&nbsp;</th>
</tr>
<?php
while ($line = mysql_fetch_array($result1, MYSQL_ASSOC)) 
{
?>
<tr bgcolor = '#66ccff'>
<th><? echo $line['title'];?> </th>
<td><? echo $line['auth'];?> </td>
<td><a class="nav sub1" href='mycart.php?function=remove&invno=<?php echo $line['inv_no'];?>'>Remove</a></td>
</tr>
<?php
}
?>
</table></div>
<br>
<div id='content'>
<center>
<form method="POST" action="checkout.php">
<input type="hidden" name="function" value="Checkout"/><br>
<input type="submit" class="searchbutton" value="CheckOut"/>
</form>
</center>
</div>
<?php
}
else
{
?>
<div id='content'>
<center><h3>Cart is Empty</h3></center>
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
