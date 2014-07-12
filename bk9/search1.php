<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>bookworms' library : a nest too cosy to miss...</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<meta name="description" content="bookworms library chennai" />
<meta name="keywords" content="bookwomrs,library,chennai,online,mobile" />
<meta name="author" content="Your Name / Original design by Andreas Viklund - http://andreasviklund.com" />
<link rel="stylesheet" href="andreas09.css" type="text/css" media="screen" />
</head>

<body>
<?php

require_once("db.php");

$keyword = $_REQUEST[keyword];
$auth = $_REQUEST[author];
$subj = $_REQUEST[subject];
$page = $_REQUEST[page];
//$a = array("AS","AS","AS");

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
$link = "search1.php?" . $c[0];
for($j=1;$j<$ind;$j++)
{
$b = $b . " and " . $a[$j];
$d = $d . "&" . $c[$j];
}
$query = $query . $b;
$link = $link . $d;
//echo $query;
//echo $link;
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

<a class="nav" href="memb.html">Member Recommends</a><span class="hide"> | </span>

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
<p>
<a class="nav" href="asearch.html">Advance Search</a><span class="hide"> | </span>
</p>
<br>
<?php
include("include/login.html");
?>
<br>
<h1>Gossip</h1>
<p><strong>HP 7</strong>
Book completed by JKR and stowed away safely in a bank vault.</p>
 
<h1>Ads</h1>
<script type="text/javascript"><!--
google_ad_client = "pub-8624485313351209";
google_ad_width = 120;
google_ad_height = 240;
google_ad_format = "120x240_as";
google_ad_type = "text";
google_ad_channel ="7188527101";
google_color_border = "66B5FF";
google_color_bg = "F0F0F0";
google_color_link = "E1771E";
google_color_text = "000000";
google_color_url = "008000";
//--></script>
<script type="text/javascript"
  src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>

</div>
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
$max = mysql_num_rows($result);
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
<tr>
<th>&nbsp</th>
<th align="center">Title</th>
<th align="center">Author</th>
<th align="center">C/R</th>
</tr>
END;
$i=0;
$tot = ceil($max/$limit);
while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
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
echo "<td align='center'><a class='nav sub1' href='bdetail.php?invno=" . $line["inventory_no"]  .   "'>Details</a>
<a class='nav sub1' href='mailrequest.php?invno=" .  $line["inventory_no"] ."'>Request</a></td>";
else
echo "<td><a class='nav sub1' href='bdetail.php?invno=" .   $line["inventory_no"] . "'>Details</a></td>";
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
