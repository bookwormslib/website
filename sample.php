<?php

// please use the sha256 from: http://www.nanolink.ca/pub/sha256/

include("aws_signed_request.php");

$public_key = "0EDWZKNFSWR2D923TT02"; //your public AWS key
$private_key = "QeScZuP7bM7s7e376P4nLQhfGBobKjt5apUxMg3m"; //your private AWS key
$PartnerId = "bookwormslibc-20"; //your PartnerId (ending in -20 or -21 or -22)



echo("<br/><br/>");


//$ASIN = B0002V7YSA; //invalid ASIN
$pxml = aws_signed_request("com", array("Operation"=>"ItemSearch","Title"=>"TINTIN IN TIBET","SearchIndex"=>"Books","Author"=>"HERGE","ResponseGroup"=>"Small,Images",ItemPage=>"1","AssociateTag"=>"$PartnerId"), $public_key, $private_key);
//echo("DD: " . $pxml);
$result = FormatSearchResp($pxml);
var_dump($result);
echo($result["ASIN"]);
echo("<br/>");
echo($result["Title"]);
echo("<br/>");
echo('<a href="' . $result["URL"] . '">' . $result["URL"] . '</a><br>');
echo($result["Author"]);
echo($result["Description"]);
echo("<br/>");

echo($result["Errors"]["Error"]["Code"]);
echo("<br/>");
echo($result["Errors"]["Error"]["Message"]);
?>
