<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>bookworms' library : a nest too cosy to miss...</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<meta name="description" content="bookworms library chennai" />
<meta name="keywords" content="bookworms,library,chennai,mobile,online" />
<meta name="author" content="Your Name / Original design by Andreas Viklund - http://andreasviklund.com" />
<link rel="stylesheet" href="andreas09.css" type="text/css" media="screen" />
</head>

<body>
<?php

include("db.php");

$invno = $_REQUEST["invno"];

$ind=0;
if (strcmp($invno,""))
{
$ind++;
$query = "select * from inventory where inventory_no like '" . $invno . "'";
$result = mysql_query($query) or die('Query failed: ' . mysql_error());
}
?>
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
<?php
include("include/login.html");
?>
<br>
<?php
include("include/snippet.html");
?>
</div>
<div id="content">
<center><h3>
<?php
$max=0;
if ($ind!=0)
{
$max = mysql_num_rows($result);
}
if ($max == 0)
echo "Inventory Not Found</h3></center>
</div>";
else 
{
echo "You Requested for Inventory";
echo "<br>"  . $invno;
echo "<br>(service available only for mobile customers)";
echo <<<END
</h3></center>
</div><br>
<div id="content">
<table border="0" bordercolor="#4682B4" width="97%" >
<tr bgcolor = '#66ccff'>
<th>Title</th>
END;
while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
echo "<td>" . $line["title"] . "</td>";
echo "</tr><tr bgcolor = '#66ccff'><th>Author</th>";
echo "<td>" . $line["author"] . "</td>";
echo "</tr><tr bgcolor = '#66ccff'><th>Publisher</th>";
echo "<td>" . $line["publisher"] . "</td></tr></table></div>";
if ($line["available"]=="Y")
{
echo <<<END
<br><div id='content'>
<form method='POST' action = 'mail.php'>
<table border="0">
<tr>
<th>Name</th>
<td><input type='text' name='name' ></td>
</tr>
<tr>
<th>Customer No.</th>
<td><input type='text' name='cusno' ></td>
</tr><tr>
<th>Area</th>
<td><input type='text' name='area' ></td>
</tr>
</table>
END;
echo "<input type='hidden' name='invno' value='" . $invno . "'>" ;
echo "<input type='hidden' name='title' value='" . $line["title"] . "'>" ;
echo <<<END
<br>
<center>
<input type="submit" class="searchbutton" value="Submit">
<input type="reset" class="searchbutton" value="Reset&nbsp">
</center>
<br>
</form>
</div>
END;
}
else
echo <<<END
<br><div id='content'>
<center><h3>Inventory not Available</h3></center>
</div>


END;
}

}
?>        
<div class="clearingdiv">&nbsp;</div>
</div>
</div>
<div id="footer">&copy; 2006-2010 bookworms' library | Design by <a href="http://www.sayee.no-ip.com">Seshasayee Gopi</a> | Tech Support by <a href="http://www.fourvees.com">Vishnu Vijayaraghavan</a></div>
