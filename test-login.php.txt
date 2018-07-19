<?php
// please use the sha256 from: http://www.nanolink.ca/pub/sha256/
include("OpenIDConnectClient.php");

$oidc = new OpenIDConnectClient(
    'https://accounts.google.com',
    getenv('CLIENT_ID'),
    getenv('CLIENT_SEC')
);
$oidc->authenticate();
$name = $oidc->requestUserInfo('given_name');


?>

<?php echo $name; ?>