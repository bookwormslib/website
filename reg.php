<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>bookworms' library : a nest too cosy to miss...</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<meta name="description" content="Your description goes here." />
<meta name="keywords" content="your,keywords,goes,here" />
<meta name="author" content="Your Name / Original design by Andreas Viklund - http://andreasviklund.com" />
<link rel="stylesheet" href="andreas09.css" type="text/css" media="screen" />
</head>

<body>
<?php
require_once "mai.php";
require_once("db.php");
$initial  = $_REQUEST["initial"];
$name = $_REQUEST["name"];
$password=$_REQUEST["password"];
$dob=$_REQUEST["dob"];
$apart_no=$_REQUEST["apart_no"];
$block_no=$_REQUEST["block_no"];
$apart_name=$_REQUEST["apart_name"];
$door_no= $_REQUEST["door_no"];
$street= $_REQUEST["street"];
$town= $_REQUEST["town"];
$pincode= $_REQUEST["pincode"];
$phone= $_REQUEST["phone"];
$mobile= $_REQUEST["mobile"];
$mail= $_REQUEST["mail"];
$office= $_REQUEST["office"];
$off_town= $_REQUEST["off_town"];
$off_phone= $_REQUEST["off_phone"];

$initial  = mysqli_real_escape_string($con,$initial);
$name = mysqli_real_escape_string($con,$name);
$password= mysqli_real_escape_string($con,$password);
$dob=mysqli_real_escape_string($con,$dob);
$apart_no=mysqli_real_escape_string($con,$apart_no);
$block_no=mysqli_real_escape_string($con,$block_no);
$apart_name=mysqli_real_escape_string($con,$apart_name);
$door_no= mysqli_real_escape_string($con,$door_no);
$street= mysqli_real_escape_string($con,$street);
$town= mysqli_real_escape_string($con,$town);
$pincode= mysqli_real_escape_string($con,$pincode);
$phone= mysqli_real_escape_string($con,$phone);
$mobile= mysqli_real_escape_string($con,$mobile);
$mail= mysqli_real_escape_string($con,$mail);
$office= mysqli_real_escape_string($con,$office);
$off_town= mysqli_real_escape_string($con,$off_town);
$off_phone= mysqli_real_escape_string($con,$off_phone);

$ind=0;
if (strcmp($name,""))
$ind++;
if (strcmp($password,""))
$ind++;
if (strcmp($door_no,""))
$ind++;
if (strcmp($street,""))
$ind++;
if (strcmp($town,""))
$ind++;
if (strcmp($pincode,""))
$ind++;
if (strcmp($phone,""))
$ind++;
if (strcmp($mail,""))
$ind++;
?>

<?php
function concat($str)
{
$str = "'" . $str . "'";
return $str;
}

function dateconvert($date) {
list($day, $month, $year) = explode('[/.-]', $date);
$date = "$year-$month-$day";
return $date;
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
<br>

<br>
<?php
include("include/snippet.html");
?>
</div>

<?php
if ($ind < 8)
{
echo <<<END
<div id="content">
<center><h3>Key Fields Missing</h3></center>
</div>
END;
}
else 
{
$query = "select count(1) as count from customer_reg where email='" . $mail .	"'";
$result = mysqli_query($con,$query)  or die('Query failed: ' . mysqli_error($con));
$line = mysqli_fetch_array($result, MYSQLI_ASSOC);
$period = $line['count'];
if($period == 0)
{
$query = "insert into customer_reg values(null,''," . concat($initial) . "," . concat($name) . ",md5(" . concat($password) . ")," . concat($apart_no) .
"," . concat($block_no) . ","  . concat($apart_name) . "," . concat($door_no) . "," . concat($street) . "," . concat($town) .
"," . concat($pincode) . "," . concat($phone) . "," . concat($mobile) . "," . concat($mail) .
", " . concat(dateconvert($dob)) . "," . concat($office) . "," . concat($off_town) . "," . concat($off_phone) . ",'U','0001-01-01')" ;
//echo $query;
$result = mysqli_query($con,$query)  or die('Query failed: ' . mysqli_error($con));
if(!$result)
{
echo <<<END
<div id="content"

<center><h3>Error in Processing - Try again Latter</h3></center>
</div>
END;
mysqli_query($con,"COMMIT");
}
else
{

$query= "select reg_id as reg_id from customer_reg where email= '" . $mail . "'";
$result = mysqli_query($con,$query)  or die('Query failed: ' . mysqli_error($con));
$line = mysqli_fetch_array($result, MYSQLI_ASSOC);
$regid = $line['reg_id'];

$to = $mail;
$subject = "Your Registration @ bookworms' library";
$msg =  "Hi " . $name . ",<br><br>Welcome to bookworms' library.<br><br><b> Thank you for subscribing to the Online version of bookworms'.</b><br><br>Please kindly confirm your E-Mail Id to further process your subscription.";
$msg .= "<br><br>Please <a href='http://www.bookwormslib.com/verify.php?mail=" . urlencode($mail) . "&regid=" . $regid . "'> click here </a> to verify your E-Mail id for further procesing.";
$msg .= "<br><br>Thanks,<br><b>bookworms'</b>";

$nameto = $name;  
$from = "info@bookwormslibrary.com";  
$namefrom = "Bookworms Registration";  
$newLine = "\r\n";  

$headers = "MIME-Version: 1.0" . $newLine;  
$headers .= "Content-type: text/html; charset=iso-8859-1" . $newLine;  
$headers .= "To: $nameto <$to>" . $newLine;  
$headers .= "From: $namefrom <$from>" . $newLine;  

//if(mail($to,$subject,$msg,$headers))
if(Send_Mail($to, $nameto, $subject, $msg))
{
echo <<<END
<div id="content">
<center><h3>Thank you for Subscribing @bookworms'</h3>
<h4>A verification mail has been sent to your E-Mail inbox. Please kindly confirm it to complete the subscription.</h4>
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
}
else
{
echo <<<END
<div id='content'>
<center><h3>This E-Mail Id is already taken</h3></center>
</div>
END;
}
}
?>        
<div class="clearingdiv">&nbsp;</div>
</div>
</div>
<?php
include("include/copyright.html");
?>
