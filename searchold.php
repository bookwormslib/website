<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>bookworms'</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<meta name="description" content="Your description goes here." />
<meta name="keywords" content="your,keywords,goes,here" />
<meta name="author" content="Your Name / Original design by Andreas Viklund - http://andreasviklund.com" />
<link rel="stylesheet" href="andreas09.css" type="text/css" media="screen" />
</head>

<body>
<div id="container">
<?php

$link = mysql_connect("www.freesql.org","fourvees","vishnu879") or die("ERROR");
//echo "OK";
mysql_select_db("bookworms") or die("Error");
//echo "OK";

$keyword = $_REQUEST[keyword];
$key2 = $_REQUEST[author];
$page = $_REQUEST[page];

$query = "select * from inventory where title like '%" . $keyword . "%'";

$result = mysql_query($query) or die('Query failed: ' . mysql_error());
?>
<div id="sitename">
<table width="100%">
<tr>
<td>
<h1>bookworms'</h1>
<h2>Enrich Enter</h2>
</td>
<td align="right" >
<img src="index4.png" align"right">
</td>
</tr>
</table>
</div>

<div id="mainmenu">
<ul>
<li><a class="current" href="index.html">Home</a></li>
<li><a href="green.html">Products</a></li>
<li><a href="orange.html">Membership Tariff</a></li>
<li><a href="purple.html">FAQ</a></li>
<li><a href="red.html">Contact Us</a></li>
</ul>
</div>
 
<div id="wrap">

<div id="leftside">
<h1>Included layouts</h1>
<p>
<a class="nav active" href="index.html">Home</a> <span class="hide"> | </span>
<a class="nav" href="2col.html">Products</a><span class="hide"> | </span>
<a class="nav sub" href="#">Static Library</a><span class="hide"> | </span>
<a class="nav sub" href="#">Online Library</a><span class="hide"> | </span>
<a class="nav sub" href="#">Mobile Library</a>
<a class="nav" href="no-img.html">Membership Tarrif</a><span class="hide"> | </span>
<a class="nav" href="#">FAQ</a><span class="hide"> | </span>
<a class="nav" href="#">Contact Us</a><span class="hide"> | </span>
</p>

<h1>Included colors</h1>
<img src="img/colors.jpg" height="104" width="125" class="thumbnail" alt="Included colors" />
</div>

<div id="rightside">
<h1>Search</h1>
<form action="search.php" method="get">
<p>
<input type="text" alt="Search" class="searchbox" name="keyword"/>
<input type="hidden" name="page" value="1"/>
<input type="submit" value="Go!" class="searchbutton" />
</p>
</form>



<h1>Login:</h1>
<form action="login.php" method="POST">
<p>
<input type="text" alt="Search" class="searchbox" name="uname"/>
<input type="password" alt="Search" class="searchbox" name="pword"/>
<select class="searchbox">
<option>Online</option>
<option>Mobile</option>
<option>Static</option>
</select><input type="submit" value="Go!" class="searchbutton" />
</p>
</form>
<h1>Links:</h1>
<ul class="linklist">
<li><a href="http://andreasviklund.com">Register (Online Members)</a></li>
<li><a href="http://andreasviklund.com/templates">Advanced Search</a></li>
</ul>
</div>

<div id="content">
<center><h3>
<?php
$limit = 10;
$max = mysql_num_rows($result);
$lt1 = ($page - 1) * $limit;
$lt2 = $page * $limit;
$ty = $lt1 + 1;
if ($max == 0)
echo "No results found";
else 
{
if ($max > $lt2)
echo "Results " . $ty. " - " . $lt2 . " of about " . $max;
else
echo "Results " . $ty. " - " . $max . " of about " . $max;
echo <<<END
</center></h3>
</div><br>
<div id="content">
<table border="1" bordercolor="#4682B4" width="100%" >
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
echo "<td align='center'><a class='nav sub1' href=''>Check</a>
<a class='nav sub1' href=''>Reserve</a></td>";
else
echo "<td><a class='nav sub1' href=''>Reserve</a></td>";
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
echo "<a href=search.php?keyword=" . $kwd."&page=".$prv."><</a>&nbsp&nbsp&nbsp";
$r = ceil($page/10);
//echo $r;
for ($j=(10*$r)-9;$j<=$tot;$j++)
{
if ($j <= (10*$r))
{
if ($j != $page)
echo "<a href=search.php?keyword=" . $kwd."&page=".$j.">".$j."</a>&nbsp&nbsp&nbsp";
else
echo "<font size=5>". $j ."</font>&nbsp&nbsp&nbsp";
}
}
if ($page != $tot)
echo "<a href=search.php?keyword=" . $kwd."&page=".$nxt.">></a>&nbsp&nbsp&nbsp";
echo "</center>";
}
?>        
</div>
<div class="clearingdiv">&nbsp;</div>
</div>
</div>
<div id="footer">&copy; 2005 bookworms' | Design by <a href="http://andreasviklund.com">Andreas Viklund</a></div>
</body>
</html>
