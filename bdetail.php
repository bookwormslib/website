<?php

require_once("db.php");

$invno = $_REQUEST["invno"];

$ind=0;
if (strcmp($invno,""))
{
$ind++;
$query = "select * from inventory where inventory_no = '" . $invno . "'";
$query1 = "select * from inventory_social where source='GOG' and inventory_no = '" .  $invno . "'";
$result = mysqli_query($con,$query) or die('Query failed: ' . mysqli_error($con));
$result1 = mysqli_query($con,$query1) or die('Query failed: ' . mysqli_error($con));
}
$max=0;
if ($ind!=0)
{
$max = mysqli_num_rows($result);
}
if($max>0)
{
$line = mysqli_fetch_array($result, MYSQLI_ASSOC);
$auth=$line["author"];

$tit=$line["title"];

}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title><?php echo $tit; ?> @ bookworms' library : a nest too cosy to miss...</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<meta name="description" content="<?php echo $tit; ?> @ bookworms library by <?php echo $auth; ?>" />
<meta name="keywords" content="bookworms,library,chennai,online,mobile" />
<meta name="author" content="Your Name / Original design by Andreas Viklund - http://andreasviklund.com" />
<link rel="stylesheet" href="andreas09.css" type="text/css" media="screen" />
<link href="https://www.storieslibrary.in/cafe-logo.png" rel="shortcut icon">
  
<meta property="og:title" content="<?php echo $tit; ?> @ bookworms' library : a nest too cosy to miss..."/> 
<meta property="og:type" content="company" />
<meta property="og:image" content="http://www.bookwormslib.com/cafe-logo.pnf"/>
<meta property="og:url" content="http://www.bookwormslib.com/bdetail.php?invno=<?php echo $invno; ?>"/> 
<meta property="og:site_name" content="bookwormslibinv"/>
<meta property="og:ref" content="<?php echo $invno; ?>"/>

<meta property="fb:admins" content="100002881823921" />


</script>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

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
<script>
!function(d,s,id)
{var js,
fjs=d.getElementsByTagName(s)[0];
if(!d.getElementById(id)){
js=d.createElement(s);
js.id=id;js.src='//platform.twitter.com/widgets.js';
fjs.parentNode.insertBefore(js,fjs);}}
(document,'script','twitter-wjs');
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
</div>
<div id="content">

<center><h3>
<?php
if ($max == 0)
echo "No results found</h3></center>
</div>";
else 
{
echo "Details for Inventory";
echo "<br>"  . $invno;
echo <<<END
</h3></center>
</div><br>
<div id="content">
<table border="0" bordercolor="#4682B4" width="97%" >
<tr bgcolor = '#66ccff'>
<th>Title</th>
END;
$auth="";
$tit="";
echo "<td>" . $line["title"] . "</td>";
echo "</tr><tr bgcolor = '#66ccff'><th>Author</th>";
echo "<td>" . $line["author"] . "</td>";
echo "</tr><tr bgcolor = '#66ccff'><th>Publisher</th>";
echo "<td>" . $line["publisher"] . "</td>";
echo "</tr><tr bgcolor = '#66ccff'><th>Subject</th>";
echo "<td>" . $line["subject"] . "</td>";
echo "</tr><tr bgcolor = '#66ccff'><th>Age Group</th>";
echo "<td>" . $line["age_group"] . "</td>";
echo "</tr><tr bgcolor = '#66ccff'><th>Series</th>";
echo "<td>" . $line["series"] . "</td>";
echo "</tr><tr bgcolor = '#66ccff'><th>Language</th>";
echo "<td>" . $line["language"] . "</td>";
if ($line["available"]=="Y")
{
echo "</tr><tr bgcolor = '#66ccff'><th>Available</th>";
echo "<th>YES</th>";
}
else
{
echo "</tr><tr bgcolor = '#FAAFBE'><th>Available</th>";
echo "<th>NO</th>";
}
echo <<<END
</tr>
</table>
END;



echo "<div id='fb-root'></div><br>";
echo "<div class='fb-like' data-href='http://www.bookwormslib.com/bdetail.php?invno=" . $invno . "' data-layout='button_count' data-send='false' data-width='100' data-show-faces='false'>";
echo "</div>";
echo "<a href='https://twitter.com/share' class='twitter-share-button' data-related='bookworms2' data-hashtags='bookwormslib'>Tweet</a>";
echo "<br>";
echo "<br><a href='javascript:history.go(-1)'>Go Back</a>";
echo"</div><br>";

$max=0;
if ($ind!=0)
{
$max = mysqli_num_rows($result1);
}
if($max>0)
{
$line = mysqli_fetch_array($result1, MYSQLI_ASSOC);

echo <<<END
<div id='content'>
END;

echo "<h3>" . $line["title"] . "</h3>";

if(!is_null($line["author1"]))
{
echo "<h4>By " . $line["author1"];
}

if(!is_null($line["author2"]))
{
echo " and " . $line["author2"] . "</h4>";
}
else
{
echo "</h4>";
}

echo "<table><tr>";

if(!is_null($line["thumb_img"]))
{
echo "<td>";
echo "<img src='" . $line["thumb_img"] . "'/>";
echo "</td>";
}

if(!is_null($line["description"]))
{
echo "<td>";
echo "<span style='font-weight:bold;text-align:justify;'>" . $line["description"] . "</span>";
echo "</td>";
}

echo "</tr>";

if(!is_null($line["publisher"]))
{
echo "<tr><th>Publisher</th><td>" . $line["publisher"] . "</td></tr>";
}

if(!is_null($line["isbn_13"]))
{
echo "<tr><th>ISBN</th><td>" . $line["isbn_13"] . "</td></tr>";
}

if(!is_null($line["site_url"]))
{
echo "<tr><th>Google Link</th><td><a target='_blank' href='" . $line["site_url"] . "'> Click Here </a></td></tr>";
}

echo "</table>";

echo "<div style='float:clear;'>";
echo "<br>Powered by Google Books";
echo "</div>";
echo "</div>";

echo <<<END
<br>
<div id='content'>
<b>Note:&nbsp;</b>Information shown from third party webservices like Google, Amazon and WorldCat may not be accurate.
</div>
END;
}



$req = "http://ecs.amazonaws.com/onca/xml?Service=AWSECommerceService&Version=2005-03-23&Operation=ItemSearch&SubscriptionId=0525E2PQ81DD7ZTWTK82&AssociateTag=0EDWZKNFSWR2D923TT02&SearchIndex=Books&Author=" .urlencode($auth) . "&Title="  . urlencode($tit) ."&ResponseGroup=EditorialReview,Images,Small";
//echo $req;
$c   = curl_init($req);
curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
$xml = curl_exec($c);
curl_close($c);

$parser = xml_parser_create();
$titl;
$auth;
$img;
$no_res;
$raw=array();
$i=0;
$ele="";
$item=0;

function start($parser,$element_name,$element_attrs)
{
global $ele;
$ele=$element_name;
//echo $ele . "<br/>";
}

function stop($parser,$element_name)
{
global $ele;
$ele="";
}

function char($parser,$data)
{
global $ele,$i,$raw;
if ($ele=="TOTALRESULTS")
{
$raw[$i]=$data;
$i++;
}
if ($ele=="CONTENT")
{
$raw[$i]=$data;
$i++;
}

}

//Specify element handler
xml_set_element_handler($parser,"start","stop");

//Specify data handler
xml_set_character_data_handler($parser,"char");

xml_parse($parser,$xml);

xml_parser_free($parser);

if($raw[0]>1)
{
echo "<div id='content'>";
echo $raw[1] . "<br/><br/>";
echo "<b>Powered by Amazon Web Service</b>";
echo "</div>";
}
}


?>        

<div class="clearingdiv">&nbsp;</div>
</div>
</div>
<div id="footer">
<script src="scripts/copyright.js"></script>
</div>
