<?php
session_start();
if(isset($_SESSION['loggedin']))
{
require_once("db.php");
require_once("functions.php");	
$keyword = $_REQUEST[keyword];
$auth = $_REQUEST[author];
$subj = $_REQUEST[subject];
$page = $_REQUEST[page];
$function = $_REQUEST['function'];
$invno = $_REQUEST['invno'];
$ind=0;
if (strcmp($function,""))
$ind++;
if (strcmp($invno,""))
$ind++;
$res=false;
if ($ind ==2)
{
if($function=="add")
{
if($_SESSION['ltflg'])
if($_SESSION['incart']<$_SESSION['cc'])
{
$query = "select count(*) as inc from customer_request where inventory_no like " . concat($invno) . " and status like 'I' 
and extract(day_hour from date) like extract(day_hour from now())";
//echo $query;
$res1 = mysql_query($query) or die('Query failed: ' . mysql_error());
$line = mysql_fetch_array($res1, MYSQL_ASSOC);
if ($line['inc']==0)
{
$domain = $_SERVER["REMOTE_ADDR"]; 
$query = "insert into customer_request values(" . concat($_SESSION['id']) . ",null," . concat($_SESSION['cusno']).
"," . concat($invno) . "," . concat($domain) .",now(),'I')";
//echo $query;
$res = mysql_query($query) or die('Query failed: ' . mysql_error());
if($res)
$_SESSION['incart']++;
}
}	
}
}
$ind=0;
if (strcmp($keyword,""))
{
$a[$ind] = "(title like '%" . $keyword  . "%')";
$c[$ind] = "keyword=". str_replace(" ","+",$keyword) ;
$ind++;
}
if (strcmp($auth,""))
{
$a[$ind] = "(author like '%". $auth   . "%')";
$c[$ind] = "author=". str_replace(" ","+",$auth) ;
$ind++;
}
if (strcmp($subj,""))
{
$a[$ind] = "(subject like '%" . $subj   . "%' or subject2 like '%" . $subj . "%' or subject3 like '%" . $subj . "%')";
$c[$ind] = "subject=". str_replace(" ","+",$subj) ;
$ind++;
}

if (strcmp($a[0],""))
{
$query = "select * from inventory where " . $a[0];
$link = "searchonline.php?" . $c[0];
for($j=1;$j<$ind;$j++)
{
$b = $b . " and " . $a[$j];
$d = $d . "&" . $c[$j];
}
$query = $query . $b;
$link = $link . $d;
//echo $query;
//echo $link;
$result1 = mysql_query($query) or die('Query failed: ' . mysql_error());
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>bookworms' library : a nest too cosy to miss...</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<meta name="description" content="bookworms library chennai search online" />
<meta name="keywords" content="bookworms,library,chennai,online,search" />
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
<form method="GET" action="searchonline.php">
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
$query = "select title, inventory.inventory_no as invno from customer_request,inventory where customer_request.inventory_no like inventory.inventory_no and customer_request.status like 'I' and extract(day_hour from date) like extract(day_hour from now()) and
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
if ($function=="add")
{
?>
<div id="content">
<center><h3>
<?php
if($res)
echo "Book added to cart";
else
echo "Book cannot be added to cart";
echo "</h3></center></div>";
}
?>

<div id="content">
<center><h3>
<?php
$limit = 10;
$max=0;
$lt1=0;
$lt2=0;
$ty=0;
if ($ind!=0)
{
$max = mysql_num_rows($result1);
$lt1 = ($page - 1) * $limit;
$lt2 = $page * $limit;
$ty = $lt1 + 1;
}
if ($max == 0)
echo "No results found</h3></center>
</div>";
else 
{
if ($max > $lt2)
echo "Results " . $ty. " - " . $lt2 . " of about " . $max;
else
echo "Results " . $ty. " - " . $max . " of about " . $max;
echo <<<END
</h3></center>
</div><br>
<div id="content">
<table border="1" bordercolor="#4682B4" width="97%" >
<tr bgcolor='#f0f0f0'>
<th>&nbsp</th>
<th align="center">Title</th>
<th align="center">Author</th>
<th align="center">Action</th>
</tr>
END;
$i=0;
$tot = ceil($max/$limit);
while ($line = mysql_fetch_array($result1, MYSQL_ASSOC)) {
$i++;
if ($i > $lt1 && $i <= $lt2)
{
if ($line["available"] == "Y")
echo "<tr bgcolor = '#66ccff'>";
else
echo "<tr bgcolor = '#FAAFBE'>";
echo "<td>" . $i . "</td>";
echo "<th align='center'>" . $line["title"] . "</th>";
echo "<td align='center'>" . $line["author"] . "</td>";
if ($line["available"] == "Y")
echo "<td align='center'><a class='nav sub1' href='bdetailonline.php?invno=" . $line["inventory_no"]  .   "'>Details</a>
<a class='nav sub1' href='" . $link . "&page=" . $page . "&function=add&invno=" .  $line["inventory_no"] ."'>Add</a></td>";
else
echo "<td><a class='nav sub1' href='bdetailonline.php?invno=" .   $line["inventory_no"] . "'>Details</a></td>";
echo "</tr>";
}
}
echo <<<END
</table>
</div><br/>
<div id="content">
<center>
END;
$prv = $page-1;
$nxt = $page+1;
$kwd = str_replace(" ","+",$keyword);
if ($page != 1)
echo "<a href=" . $link ."&page=".$prv."><</a>&nbsp&nbsp&nbsp";
$r = ceil($page/10);
//echo $r;
for ($j=(10*$r)-9;$j<=$tot;$j++)
{
if ($j <= (10*$r))
{
if ($j != $page)
echo "<a href=" . $link . "&page=".$j.">".$j."</a>&nbsp&nbsp&nbsp";
else
echo "<font size=5>". $j ."</font>&nbsp&nbsp&nbsp";
}
}
if ($page != $tot)
echo "<a href=" . $link ."&page=".$nxt.">></a>&nbsp&nbsp&nbsp";
echo "</center></div>";
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
