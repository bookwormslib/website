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
</head>

<body>

<div id="container">

<?php
include("include/banner.html");
include("include/mainmenu.html");
require_once("db.php");
require_once "m1.php";
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
<?php
include("include/snippet.html");
?>
</div>

<?php
$email  = $_REQUEST["mail"];
$regid = $_REQUEST["regid"];

$query = "select count(1) as count,name from customer_reg where email='" . $email .	"' and reg_id=" . $regid . " and status='U' group by email";
//echo $query;
$result = mysql_query($query)  or die('Query failed: ' . mysql_error());
$line = mysql_fetch_array($result, MYSQL_ASSOC);
$period = $line['count'];
$name = $line['name'];
if($period == 0)
{
echo <<<END
<div id="content">
<center><h3>Invalid E-Mail Id or Registrtion Id</h3>
<br>
Unable to Process
</center>
</div>
END;
}else if($period == 1)
{

$query = "update customer_reg set status='N' where email='" . $email .	"' and reg_id=" . $regid . " and status='U'";
$result = mysql_query($query)  or die('Query failed: ' . mysql_error());
if(!$result)
{
echo <<<END
<div id="content">
<center><h3>Error in Processing</h3>
<br>
Please check with bookworms'
</center>
</div>
END;
}
else
{
echo <<<END
<div id="content">
<center><h3>Thank you for your online subscription with bookworm's library</h3>
<br>
You will be contacted by our customer care shortly
</center>
</div>
END;
$to = $email;
$subject = "Welcome to bookworm's library";
$msg =  "Hi " . $name . ",<br><br>Welcome to the online edition of bookworms' library.<br><br><b> Your registration is verified and you will be contacted by our customer care shortly.</b><br><br>";
$msg .= "If you have any queries on your subscription, Please don't hesitate to contact us @ 044-24899779 or 044-42698327.<br><br>";
$msg .= "Don't forgot to drop us an e-mail to info@bookwormslib.com.<br><br>";
$msg .= "Get latest updates from our twitter stream @bookworms2.<br><br>";
$msg .= "If you like us. Please 'Like Us' or '+1' us on our Facebook and G+ Fan page. Also, please don't forget to join and follows us on our FB and G+ pages.<br><br>";
$msg .= "<br><br>Thanks,<br><b>bookworms'</b>";

$nameto = $name;  
$from = "info@bookwormslib.com";  
$namefrom = "bookworm's library";  
$newLine = "\r\n";  

$headers = "MIME-Version: 1.0" . $newLine;  
$headers .= "Content-type: text/html; charset=iso-8859-1" . $newLine;  
$headers .= "To: $nameto <$to>" . $newLine;  
$headers .= "From: $namefrom <$from>" . $newLine;  
authSendEmail($from, $namefrom, $to, $nameto, $subject, $msg);
}
}


?>
<div class="clearingdiv">&nbsp;</div>
</div>
</div>
<div id="footer">&copy; 2006-2010 bookworms' library | Design by <a href="http://www.sayee.no-ip.com">Seshasayee Gopi</a> | Tech Support by <a href="http://www.fourvees.com">Vishnu Vijayaraghavan</a></div>
