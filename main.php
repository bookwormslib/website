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
<p>
<a class="nav" href="asearch.php">Advance Search</a><span class="hide"> | </span>
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
<center><h3>Welcome <?echo $_SESSION['name'];?></h3>
<br>
<?php
$query = "select last_login from customer_reg where cus_no like " . concat($_SESSION['cusno']);
$result = mysql_query($query)  or die('Query failed: ' . mysql_error());
$line = mysql_fetch_array($result, MYSQL_ASSOC);
$lastlogin = $line['last_login'];
$query = "SELECT Date_Format(DATE_ADD(max(pay_date),INTERVAL 1 YEAR),'%d-%m-%Y') as exp from payment where customer_no like " . concat($_SESSION['cusno']);
$result = mysql_query($query)  or die('Query failed: ' . mysql_error());
$line = mysql_fetch_array($result, MYSQL_ASSOC);
$exp = $line['exp'];
?>
Your last login was on <?php echo $lastlogin; ?>
</center>
</div>
<br>
<div id="content">
<b>Total Books in Hand : </b> <?php echo $_SESSION['inhand']; ?> <br>
<b>Books in Hand this Month :</b> <?php echo $_SESSION['limit1'];?> <br>
<b>Total this Month :</b> <?php echo $_SESSION['limit'];?> <br>
<b>Total Requested :</b> <?php echo $_SESSION['limit2'];?> <br>
<b>Your Cart Capacity :</b> <?php echo $_SESSION['cc'] - $_SESSION['incart']; ?> <br>
Your account expires on <?php echo $exp; ?>
</div>
<br>
<div id="content">
<center><h3>Please Help Yourself</h3></center>
<b>How do I borrow my books?</b>
<ul>
<li>Search the book from the search box on the right side corner</li>
<li>Add your book from the listed search result to your cart</li>
<li>Your cart is displayed on the right side below the search box</li>
<li>Once you are satisfied with your cart, Please click the <b>CHECK OUT</b> link above your cart contents</li>
<li>Once the <b>CHECK OUT</b> button is clicked, you will be displayed with your cart page where you can manage your cart.</li>
<li>Proceed to check out by clicking <b>CheckOut</b> button on the cart page.</li>
<li>That's it. You will get your books delivered within 2 working days</li>
</ul>
<br>
<b>What are the Navigation Links on the left side of the page?</b>
<ul>
<li><b>MY BOOKS</b> - List the number of books in hand</li>
<li><b>THIS MONTH</b> - List the books borrowed by you this month</li>
<li><b>MY CHECKOUTS</b> - List the current checked out books which you are yet to read</li>
<li><b>MY RETURNS</b> - List the books returned by you and which is pending to be picked up from you</li>
<li><b>MY PROFILE</b> - Displays your user profile</li>
<li><b>CHANGE PASSWORD</b> - Allows you to change your current password</li>
<li><b>NEW ADDITIONS</b> - List of 10 recent books added to the library</li>
<li><b>LOGOUT</b> - Allows you to logout from the library</li>
</ul>
<br>
<center><b>If you have any discrepancies please don't hesitate to call us.</b></center>
<br>
<center><b>You can always send in your feedback from the Contact page and by clicking <a href="feedback.html">Feedback</a> link on the right side below the search box.</b></center>
</div>
<?php
if ($_SESSION['cc']==0)
{
?>
<br>
<div id="content">
<center><h3>You cannot borrow any further books</h3>
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
