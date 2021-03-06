<?php
session_start();
if(isset($_SESSION['loggedin']))
{
require_once("db.php");	
require_once("functions.php");

$query = "select * from customer_reg where cus_no like " . concat($_SESSION['cusno']);
$res = mysql_query($query) or die('Query failed: ' . mysql_error());


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>bookworms' library : a nest too cosy to miss...</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<meta name="description" content="Your description goes here." />
<meta name="keywords" content="your,keywords,goes,here" />
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
<div id="content">
<center><h3>
<?php
$max = mysql_num_rows($res);
if ($max == 0)
echo "No such profile found</h3></center>
</div>";
else 
{
echo "Details for Customer";
echo "<br>"  . $_SESSION['cusno'];
echo <<<END
</h3></center>
</div><br>
<div id="content">
<table border="0" bordercolor="#4682B4" width="97%" >
<tr bgcolor = '#66ccff'>
<th>Name</th>
END;
while ($line = mysql_fetch_array($res, MYSQL_ASSOC)) {
echo "<td>" . $line["name"] . "</td>";
echo "</tr><tr bgcolor = '#66ccff'><th>Apartment No.</th>";
echo "<td>" . $line["apartment_no"] . "</td>";
echo "</tr><tr bgcolor = '#66ccff'><th>Apartment Name</th>";
echo "<td>" . $line["apartment_name"] . "</td>";
echo "</tr><tr bgcolor = '#66ccff'><th>Block No.</th>";
echo "<td>" . $line["block_no"] . "</td>";
echo "</tr><tr bgcolor = '#66ccff'><th>Door No.</th>";
echo "<td>" . $line["door_no"] . "</td>";
echo "</tr><tr bgcolor = '#66ccff'><th>Street</th>";
echo "<td>" . $line["street"] . "</td>";
echo "</tr><tr bgcolor = '#66ccff'><th>Town</th>";
echo "<td>" . $line["town"] . "</td>";
echo "</tr><tr bgcolor = '#66ccff'><th>Pincode</th>";
echo "<td>" . $line["pincode"] . "</td>";
echo "</tr><tr bgcolor = '#66ccff'><th>Phone</th>";
echo "<td>" . $line["phone"] . "</td>";
echo "</tr><tr bgcolor = '#66ccff'><th>Mobile</th>";
echo "<td>" . $line["mobile"] . "</td>";
echo "</tr><tr bgcolor = '#66ccff'><th>E-Mail</th>";
echo "<td>" . $line["email"] . "</td>";
echo "</tr><tr bgcolor = '#66ccff'><th>D.O.B.</th>";
echo "<td>" . $line["dob"] . "</td>";
}
echo <<<END
</tr>
</table>
<br><a href='javascript:history.go(-1)'>Go Back</a>
</div>
END;
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
