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
$ref= $_SERVER['HTTP_REFERER'];
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
<div id="content">
<center><h3>E-Mail and Password Mismatch</h3>
<br>
Please try again
</center>
</div>
<div id="content">
<p class="searchform">
<form method="POST" action="online.php">
<center>
E-Mail : <br><input type="text" alt="username" name=username class="loginbox" /> <br> <br>
Password : <br><input type="password"  name=password class="loginbox"> <br> <br>
<input type="submit" value="Go!" class="searchbutton" /> <br> <br>
<?php
if (strpos($ref,'online.php')!= false)
{
echo "<a href='forgot.php'>Forgot Password</a>";
}
?>
</center>
</form>
</p>
</center>
</div>
<div class="clearingdiv">&nbsp;</div>
</div>
</div>
<?php
include("include/copyright.html");
?>