<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html class="cufon-active cufon-ready" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
<title>Bookworms Library - Search result</title>
<meta name="Robot" content="ALL">
<meta name="distribution" content="Global">
<meta name="revisit-after" content="2 days">
<meta name="language" content="english">
<meta name="expires" content="Never">
<meta name="country" content="in, India">
<meta name="rating" content="general">
<link href="style.css" rel="stylesheet" type="text/css">

<!--ram-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<script src="js/jquery-1.6.1.min.js" type="text/javascript"></script>
		<!--script src="js/jquery.lint.js" type="text/javascript" charset="utf-8"></script-->
		<link rel="stylesheet" href="css/prettyPhoto.css" type="text/css" media="screen" title="prettyPhoto main stylesheet" charset="utf-8" />
		<script src="js/jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"></script>
		
		<style type="text/css" media="screen">
			
			
			p { font-size: 1.2em; }
			
		
			
			.wide {
				border-bottom: 1px #000 solid;
				width: 4000px;
			}
			
			.fleft { float: left; margin: 0 20px 0 0; }
			
			.cboth { clear: both; }
			
			#main {
				background: #fff;
				margin: 0 auto;
				padding: 30px;
				width: 1000px;
			}
		</style>
		


<!--ram-->
</head>
<body id="index_page">
<div id="shadow_bottom">
<div id="bg_design">
<div id="page_layout" align="center">


    <script src="js/header.js" type="text/javascript"></script>
	
	
    <div class="gallery clearfix"  id="book_review_body_content_main">
        <!-- body left -->
        <div id="body_content">
		
		<div class="home_cont1">
			<br/><center><h2>SEARCH RESULTS</h2></center><br/>
						
<br>		
<!-- Start of Result -->	
<!-- <div style="overflow:auto;" height="150px" style="position:fixed;top:10px;height:150px;"> -->
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
$link = "search_result.php?" . $c[0];
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
<br>
<?php
$limit = 20;
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
echo "<center><div><h3>No results found</h3></center></div>";
else 
{
if ($max > $lt2)
echo "Results " . $ty. " - " . $lt2 . " of about " . $max;
else
echo "Results " . $ty. " - " . $max . " of about " . $max;
echo <<<END
<br>
<div id="content" style="overflow:auto;height:480px;" >
<table border="1" bordercolor="#FFDAB9" width="97%" >
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
echo "<tr bgcolor = '#6B4017'>";
else
echo "<tr bgcolor = '#491F07'>";
echo "<td style='color:#C0914D'>" . $i . "</td>";
echo "<th align='center' style='color:#C0914D'>" . $line["title"] . "</th>";
echo "<td align='center' style='color:#C0914D'>" . $line["author"] . "</td>";
if ($line["available"] == "Y")
echo "<td align='center'><a class='nav sub1' href='bdetail.php?invno=" . $line["inventory_no"]  .   "'>Details</a>
<a class='nav sub1' style='color:#C0914D' href='mailrequest.php?invno=" .  $line["inventory_no"] ."'>Request</a></td>";
else
echo "<td><a class='nav sub1' href='bdetail.php?invno=" .   $line["inventory_no"] . "'>Details</a></td>";
echo "</tr>";
}
}
echo <<<END
</table>
</div><br/>
<div id="content" style="overflow:auto;">
<center>
END;
$prv = $page-1;
$nxt = $page+1;
$kwd = str_replace(" ","+",$keyword);
if ($page != 1)
echo "<a href=" . $link ."&page=".$prv."><</a>&nbsp&nbsp&nbsp";
$r = ceil($page/$limit);
//echo $r;
for ($j=($limit*$r)-($limit-1);$j<=$tot;$j++)
{
if ($j <= ($limit*$r))
{
if ($j != $page)
echo "<a href=" . $link . "&page=".$j." style='color:#491F07;'>".$j."</a>&nbsp&nbsp&nbsp";
else
echo "<font size=5 color='#491F07'>". $j ."</font>&nbsp&nbsp&nbsp";
}
}
if ($page != $tot)
echo "<a href=" . $link ."&page=".$nxt.">></a>&nbsp&nbsp&nbsp";
echo "</center></div>";
}
?>        
</div>	    
		   <!--content 1-->
		  		  
		  	<div class="home_cont4">
			  <div id="footer">
  
               <div  id="body_left">
			 <br><br>
     <a href="#condition" rel="prettyPhoto[inline]"  class="footerlink">Terms & Conditions</a> 	<br />
      <a href="#copyright" rel="prettyPhoto[inline]"  class="footerlink">Copyright information and disclaimer</a>
			   </div>
    <div id="body_right">
	<p style="float:left;color:#C0914D;line-height:20px; font-size:12px; padding-left:20px; padding-top:25px;">
	LIBRARY <br />CORNER</p>  
	<div id="footer_left"><br><br>
     <ul >
		<li><a href="medicine.html" title="Medicine for the Soul"><b>M.F.S.</b></a></li>
        
<li><a href="faq.html" title="Frequently Asked Questions"><b>FAQs</b></a></li>
		<li><a href="#contact" rel="prettyPhoto[inline]" title="Contact us"><b>Contact us</b></a></li>
		<li><a href="#corporate" rel="prettyPhoto[inline]" title="Corporates"><b>Corporates</b></a></li>
	</ul>
	</div>
	      
	</div>
 
   
</div>
		  </div>

