<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>#stories library cafe: a nest too cosy to miss...</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<meta name="description" content="stories library cafe chennai official site" />
<meta name="keywords" content="stories,library,cafe,chennai,official,mobile,online,static,kknagar" />
<meta name="author" content="Your Name / Original design by Andreas Viklund - http://andreasviklund.com" />
<link href="https://www.storieslibrary.in/cafe-logo.png" rel="shortcut icon">
<META name="verify-v1" content="ZIXoeLZau3BY7h6PfJ96xd1qOxyDW3/WNkHZ7U6oe08=" />

<meta property="og:title" content="bookworm library chennai - Your online neighbourhood library"/> 
<meta property="og:type" content="company" />
<meta property="og:image" content="https://www.storieslibrary.in/cafe-logo.png"/> 
<meta property="og:url" content="https://www.storieslibrary.in/"/> 
<meta property="og:site_name" content="storieslibrary"/> 
<meta property="og:url" content="https://www.storieslibrary.in/"/> 
<link rel="stylesheet" href="andreas09.css" type="text/css" media="screen" />
  
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-28933931-1']);
  _gaq.push(['_trackPageview','/search1.php?keyword=<?php echo $_REQUEST[keyword];?>']);
//  _gaq.push(['_trackEvent', 'search', '<?php echo $_REQUEST[keyword];?>']);"
  _gaq.push(['_trackEvent','search','action1','<?php echo $_REQUEST[keyword];?>',0]);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

<style>
.aa:hover {
border-right: 3px solid #2b2b2b;
border-bottom: 3px solid #2b2b2b;
background: pink;
}

.aa {
background:SkyBlue;opacity:0.80;-moz-opacity:0.80;
height:55px;border-radius: 10px;border: 1px solid;-moz-border-radius: 10px;-webkit-border-radius: 10px;
border-left: 3px solid #2b2b2b;
border-top: 3px solid #2b2b2b;
}

.bb:hover {
background:Snow;
border-right: 3px solid #2b2b2b;
border-bottom: 3px solid #2b2b2b;
}

.bb {
background:#FAAFBE;
height:55px;border-radius: 10px;border: 1px solid;-moz-border-radius: 10px;-webkit-border-radius: 10px;
border-left: 3px solid #2b2b2b;
border-top: 3px solid #2b2b2b;
}

#dwrap {
width: 100%;
float: left;
border-right:thick double black;
} 

#head1 {
width: 100%;
float: left;
height:55px;border-radius: 10px;border: 1px solid;-moz-border-radius: 10px;-webkit-border-radius: 10px;
border-left: 3px solid #2b2b2b;
border-top: 3px solid #2b2b2b;
background: SkyBlue;opacity:0.80;-moz-opacity:0.80;
}

#head1:hover {
width: 100%;
float: left;
height:55px;border-radius: 10px;border: 1px solid;-moz-border-radius: 10px;-webkit-border-radius: 10px;
border-right: 3px solid #2b2b2b;
border-bottom: 3px solid #2b2b2b;
background: snow;
}

#head2 {
width: 100%;
float: left;
height:55px;border-radius: 10px;border: 1px solid;-moz-border-radius: 10px;-webkit-border-radius: 10px;
border-left: 3px solid #2b2b2b;
border-top: 3px solid #2b2b2b;
background: #FAAFBE;
}

#head2:hover {
width: 100%;
float: left;
height:55px;border-radius: 10px;border: 1px solid;-moz-border-radius: 10px;-webkit-border-radius: 10px;
border-right: 3px solid #2b2b2b;
border-bottom: 3px solid #2b2b2b;
background: snow;
}


</style>

</head>

<style>
a.gg:hover {color:orange;}
a.gg:link {color:black;}
a.gg:visited {color:black;}

a.tooltip span {display:none; padding:2px 3px; margin-left:8px; width:130px;}
a.tooltip:hover span{display:inline; position:absolute; background:#ffffff; border:1px solid #cccccc; color:#6c6c6c;}

</style>

<body>
<?php

require_once("db.php");

$keyword = $_REQUEST[keyword];
$auth = $_REQUEST[author];
$subj = $_REQUEST[subject];
$page = $_REQUEST[page];
//$a = array("AS","AS","AS");

$keyword = mysqli_real_escape_string($con,$keyword)
  
$ind=0;
if (strcmp($keyword,""))
{
$a[$ind] = "(inventory.title like '%" . $keyword  . "%')";
$c[$ind] = "keyword=". str_replace(" ","+",$keyword) ;
$ind++;
}
if (strcmp($auth,""))
{
$a[$ind] = "(inventory.author like '%". $auth   . "%')";
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
$query = "select inventory.inventory_no inventory_no,inventory.title title,inventory.author,smallthumb_img,available from inventory left join inventory_social on inventory.inventory_no = inventory_social.inventory_no where  " . $a[0];
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
$result = mysqli_query($con,$query) or die('Query failed: ' . mysqli_error($con));
}
?>
<div id="container">

<?php
include("include/banner.html");
include("include/mainmenu.html");
?>


 
<div id="wrap">

<div id="leftside">
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
$max = mysqli_num_rows($result);
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
<div>
END;
$i=0;
$tot = ceil($max/$limit);
while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
$i++;
if ($i > $lt1 && $i <= $lt2)
{
if ($line["available"] == "Y")
echo "<div id='head1'>";
else
echo "<div id='head2'>";


echo "<div id='dwrap' style='width:10%;height:95%;'>";

if(is_null($line["smallthumb_img"]))
{
echo "<img alt='Select title to see the book details' style=border-style:none;border:none' src='book-icon.png' width='30%'/></div>";
}else{
echo "<img alt='Select title to see the book details' style=border-style:none;border:none' src='" . $line["smallthumb_img"] . "' width='30%' height='75%'/></div>";
}
echo "<div id='dwrap' style='width:75%;height:95%;'><div><a class='gg' style='font-size:150%;font-weight:bold;' href='bdetail.php?invno=" . $line["inventory_no"]  . "'>" . $line["title"] . "</a><br> By <a href='search1.php?author=" . urlencode ($line[author]) . "&page=1'>" . $line[author] ."</a><br><br></div></div>";

if ($line["available"] == "Y")
echo "<div id='dwrap' style='width:10%;height:95%;border-right:none'><a align='center' class='tooltip' href='mailrequest.php?invno=" .  $line["inventory_no"] ."'><span>Book Request for Mobile Members Only.</span><img align='center' alt='Request for Mobile Members' src='tick.png' width='20%'/></a></div>";
else
echo "<div id='dwrap' style='width:10%;height:95%;border-right:none'></div>";
echo "</div>";
}
}
echo <<<END
<div style="clear:both"></div>
</div>
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
<?php
include("include/copyright.html");
?>
