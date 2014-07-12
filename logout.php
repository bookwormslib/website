<?php
session_start();
require_once("db.php");
$query="update customer_reg set last_login = now() where cus_no like '" . $_SESSION['cusno'] ."'";
$result = mysql_query($query)  or die('Query failed: ' . mysql_error());
$query="update customer_request set status = 'D' where cus_no like '" . $_SESSION['cusno'] ."' and status like 'I'";
$result = mysql_query($query)  or die('Query failed: ' . mysql_error());
$_SESSION['loggedin'] = '';	
$_SESSION['cusno'] ='';
$_SESSION['name'] = '';
$_SESSION['dues'] = '';
$_SESSION['ltflg'] = '';
$_SESSION['limit'] = '';
session_destroy();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>bookworms' library : a nest too cosy to miss...</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<meta name="description" content="bookworms library chennai" />
<meta name="keywords" content="bookworms,library,chennai,online,mobile" />
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
<h1>Literary Corner</h1>
<p>
<a class="nav" href="staff.html">Staff Recommends</a><span class="hide"> | </span>

<a class="nav" href="new.html">New Additions</a><span class="hide"> | </span>

<a class="nav" href="reviews.html">Book Reviews</a><span class="hide"> | </span>

</p>

<?php
include("include/top3.html");
?>
</div>

<div id="rightside">
<h1>Search</h1>
<p class="searchform" >
<form method="post" action="search1.php">
<input type="text" alt="Search" class="searchbox" name="keyword" />
<input type="hidden" name="page" value="1"/>
<input type="submit" value="Go!" class="searchbutton" />
</form>
</p>
<br>
<h1>Member Login</h1>
<p class="searchform">
<form method="POST" action="online.php">
Username : <br><input type="text" alt="username" name=username class="searchbox" /> <br>
Password : <br><input type="password"  name=password class="searchbox">
<input type="submit" value="Go!" class="searchbutton" />
</form>
</p>
<br>
<?php
include("include\snippet.html");
?>
</div>
<div id="content">
<center><h3>Your have successfully logged out</h3>
<br>
Have a nice time
</center>
</div>
<div class="clearingdiv">&nbsp;</div>
</div>
</div>
<div id="footer">&copy; 2006-2010 bookworms' library | Design by <a href="http://www.sayee.no-ip.com">Seshasayee Gopi</a> | Tech Support by <a href="http://www.fourvees.com">Vishnu Vijayaraghavan</a></div>
