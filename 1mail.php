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
<?php

$name = $_REQUEST["name"];
$invno = $_REQUEST["invno"];
$cusno = $_REQUEST["cusno"];
$area = $_REQUEST["area"];
$title = $_REQUEST["title"];

$ind=0;
if (strcmp($invno,""))
$ind++;
if (strcmp($name,""))
$ind++;
if (strcmp($cusno,""))
$ind++;
if (strcmp($area,""))
$ind++;
if (strcmp($title,""))
$ind++;

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
<?php
if ($ind!=5)
{
echo <<<END
<div id="content">
<center><h3>
END;
echo "Required Fields Missing</h3>
<br><a href='javascript:history.go(-1)'>Go Back</a>
</center>
</div>";
}
else 
{
if(strlen($cusno)==10)
{
$to = "mobile@bookwormslib.com";
$subject = "Request from " . $name;
$msg = "Name : " . $name . "\n" ;
$msg = $msg . "Customer No : " . $cusno . "\n" ;
$msg = $msg . "Inventory : " . $invno ."\n";
$msg = $msg . "Title : " . $title ."\n";
$msg = $msg . "Area : " . $area ."\n";

if(mail($to,$subject,$msg))
{
echo <<<END
<div id='content'>
<center><h3>You will be receiving it shortly</h3>
<br>Thank you for using this service
</center>
</div>
END;
}
else
{
echo <<<END
<div id='content'>
<center><h3>Error in processing try again later</h3></center>
</div>
END;
}
}
else
{
echo <<<END
<div id='content'>
<center><h3>Invalid Entry</h3></center>
</div>
END;
}
}
?>        
<div class="clearingdiv">&nbsp;</div>
</div>
</div>
<div id="footer">&copy; 2006-2010 bookworms' library | Design by <a href="http://www.sayee.no-ip.com">Seshasayee Gopi</a> | Tech Support by <a href="http://www.fourvees.com">Vishnu Vijayaraghavan</a></div>
