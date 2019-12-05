<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>bookworms' library : a nest too cosy to miss...</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<meta name="description" content="bookworms library chennai registration" />
<meta name="keywords" content="bookworms,library,chennai,mobile,online,registration" />
<meta name="author" content="Your Name / Original design by Andreas Viklund - http://andreasviklund.com" />
<link rel="stylesheet" href="andreas09.css" type="text/css" media="screen" />
  <script type="text/javascript" src="js/yav.js"></script>
    <script type="text/javascript" src="js/yav-config.js"></script>
    <script type="text/javascript" src="js/xmlhttprequest.js"></script>
<script type="text/javascript" language="javascript">
    var rules=new Array();
    rules[0]='name:Name|required';
    rules[1]='name:Name|minlength|4';
    rules[2]='name:Name|alphaspace';
    rules[3]='password:Password|required';
    rules[4]='password:Password|minlength|5';
     rules[5]='conf_pass:Confirm Password|required';
     rules[6]='conf_pass:Confirm Password|equal|$password|Confirm Password & Given Password not Same';
    rules[7]='dob:Date Of Birth|required';
    rules[8]='dob:Date Of Birth|date';
    rules[9]='door_no:Door No|required|Door No required';
    rules[10]='door_no:Door No|minlength|1|Door No should be atleast 1 letters';
    rules[11]='street:Street|required';
    rules[12]='street:Street|alphanumeric';
    rules[13]='town:Town|required';
    rules[14]='town:Town|alphaspace';
    rules[15]='pincode:Pincode|required';
    rules[16]='pincode:Pincode|numeric';
    rules[17]='pincode:Pincode|minlength|6';
    rules[18]='phone:Phone|required';
     rules[19]='phone:Phone|numeric';
    rules[20] ='phone:Phone|minlength|8';
    rules[21]='mobile:Mobile|numeric';
     rules[22]='mail:E-Mail|required';
     rules[23]='mail:E-Mail|email';
    rules[24]='office:Office|alphaspace';
    rules[25]='off_town:Office Town|alphaspace';
    rules[26]='off_phone:Office Phone|numeric';
    
   

</script>

<style>
.row:hover {background:Beige;}
</style>

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

<div id="sitename">
<table width="100%">
<tr>
<td>
<h1>bookworms' library</h1>
<b>Nest unsurpassable for bookworms...clean...cozy...cavernous</b>
</td>
<td align="right" >
<img src="book.gif" align"right">

</td>
</tr>
</table>
</div>

<div id="mainmenu">
<script src="scripts/mainmenu.js"></script>
</div>
 
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

<script>
function validate()
{
if(performCheck('reg',rules,'innerHtml'))
{
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
var f = "?mail=" + document.getElementById("mail").value;
xmlhttp.open("GET","validate.php" + f,false);
xmlhttp.send('');
xmlDoc=xmlhttp.responseText;
console.log(xmlDoc);
if(xmlDoc.includes("OK"))
{
return true;
}
else
{
alert(xmlDoc);
return false;
}
}
else
{
return false;
}
}
</script>

</div>
<!--
<div id="content">
<center><h4>Step 5 : Fill in the Registration Form (For ONLINE MEMBERSHIP)</h4></center>
</div><br> -->
<div id="content">
<div id="errorsDiv"></div>
<form name="reg" onsubmit="return validate();"  method="POST"  action="reg.php" autocomplete="off" >
<table width="55%">
<tr class="row">
<th>Initial</th>
<td><input type="text" class="searchbox12" size="3" name="initial"></td>
</tr><tr class="row">
<th><font color="red">Name</font></th>
<td><input type="text" class="searchbox1" name="name"></td>
</tr>
<tr class="row">
<th><font color="red">Password (Minimum 5 chars)</font></th>

<td><input type="password" class="searchbox1" name="password"></td>
</tr>
<tr class="row">
<th><font color="red">Confirm Password</font></th>
<td><input type="password" class="searchbox1" name="conf_pass"></td>
</tr>
<tr class="row">
<th><font color="red">D.O.B. (dd-MM-yyyy)</font></th>
<td><input type="text" class="searchbox1" name="dob"></td>
</tr>
<tr class="row">
<th>Apartment No.</th>
<td><input type="text" class="searchbox1" name="apart_no"></td>
</tr>

<tr class="row">
<th>Block No.</th>
<td><input type="text" class="searchbox1" name="block_no"></td>
</tr>
<tr class="row">
<th>Apartment Name</th>
<td><input type="text" class="searchbox1" name="apart_name"></td>
</tr>
<tr class="row">
<th><font color="red">Door No.</font></th>
<td><input type="text" class="searchbox1" name="door_no"></td>
</tr>

<tr class="row">
<th>Landmark</th>
<td><input type="text" class="searchbox1" name="off_town"></td>
</tr>

<tr class="row">
<th><font color="red">Street</font></th>

<td><input type="text" class="searchbox1" name="street"></td>
</tr>
<tr class="row">
<th><font color="red">Area</font></th>
<td><input type="text" class="searchbox1" name="town"  value='<?php echo $_POST["areaHidden"] ?>' ></td>
</tr>
<tr class="row">
<th><font color="red">Pincode</font></th>
<td><input type="text" class="searchbox1" name="pincode" disabled="true" value='<?php echo $_POST["pincodeHidden"] ?>' ></td>
</tr>
<tr class="row">
<th><font color="red">Phone</font></th>
<td><input type="text" class="searchbox1" name="phone"></td>
</tr>

<tr class="row">
<th>Mobile</th>
<td><input type="text" class="searchbox1" name="mobile"></td>
</tr>
<tr class="row">
<th><font color="red">E-Mail</font></th>
<td><input id="mail" type="text" class="searchbox1" name="mail"></td>
</tr>

<!--

<tr class="row">
<th>Office Name</th>
<td><input type="text" class="searchbox1" name="office"></td>
</tr>
<tr class="row">
<th>Office Town</th>

<td><input type="text" class="searchbox1" name="off_town"></td>
</tr>
<tr class="row">
<th>Office Phone</th>
<td><input type="text" class="searchbox1" name="off_phone"></td>
</tr>

-->

</table>
<br>
<center>
<input type="submit" class="searchbutton" value="Submit">
<input type="reset" class="searchbutton" value="Reset&nbsp">
</center>
<br>
<p>*Fields in <font color="red">RED</font> are mandatory</p>

</form>
</div>
<div class="clearingdiv">&nbsp;</div>
</div>
</div>
<div id="footer">
<script src="scripts/copyright.js"></script>
</div>
