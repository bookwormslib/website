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
require_once "mai.php";
$type = $_REQUEST["type"];
$about = $_REQUEST["about"];
$name = $_REQUEST["name"];
$feedback = $_REQUEST["feedback"];
$email = $_REQUEST["email"];
$phone = $_REQUEST["phone"];
$mobile = $_REQUEST["mobile"];
srand((double)microtime()*1000000); 
$docno = rand(0,100); 

$ind=0;
if (strcmp($type,""))
$ind++;
if (strcmp($about,""))
$ind++;
if (strcmp($name,""))
$ind++;
if (strcmp($feedback,""))
$ind++;
if (strcmp($email,""))
$ind++;
if (strcmp($phone,""))
$ind++;

?>
<div id="container">

<?php
include("include/banner.html");
include("include/mainmenu.html");
?>
 
<div id="wrap">

<div id="leftside">
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
if ($ind!=6)
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
$to = "info@bookwormslibrary.com";
$subject = "Feedback from " . $name . " regarding " . $about . " " . $type . " (Docket No. " . $docno . ")";
$msg = "Feedback Type : " . $type . "\n" ;
$msg = $msg . "About : " . $about . "\n" ;
$msg = $msg . "Name : " . $name . "\n" ;
$msg = $msg . "Email : " . $email . "\n" ;
$msg = $msg . "Phone : " . $phone ."\n";
$msg = $msg . "Mobile : " . $mobile ."\n\n";
$msg = $msg . "Feedback : " . $feedback ."\n\n";
$msg = $msg . "Date : " . date("j-n-Y") ."\n";
$msg = $msg . "Docket No : " . $docno ."\n";
//echo $subject;
//echo $msg;
if(Send_Mail($to,$name,$subject,$msg))
{
echo <<<END
<div id='content'>
<center><h3>Thanks for your feedback</h3>
<br>Your docket No. is &nbsp;
END;
echo $docno;
echo <<<END
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

?>        
<div class="clearingdiv">&nbsp;</div>
</div>
</div>
<div id="footer">&copy; 2006-2010 bookworms' library | Design by <a href="http://www.sayee.no-ip.com">Seshasayee Gopi</a> | Tech Support by <a href="http://www.fourvees.com">Vishnu Vijayaraghavan</a></div>
