<?php
require_once("oidc/vendor/autoload.php");
use Jumbojett\OpenIDConnectClient;

if (!function_exists('getallheaders')) {
    function getallheaders() {
    $headers = [];
    foreach ($_SERVER as $name => $value) {
        if (substr($name, 0, 5) == 'HTTP_') {
            $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
        }
    }
    return $headers;
    }
}

/*$oidc = new OpenIDConnectClient(
    'https://accounts.google.com',
    getenv('CLIENT_ID'),
    getenv('CLIENT_SEC')
);


$oidc->authenticate();
$name = $oidc->requestUserInfo('given_name');
$sub = $oidc->getVerifiedClaims('sub');

echo $oidc->getIdToken();
echo $sub;

foreach (getallheaders() as $name => $value) {
    echo "$name: $value\n";
}*/

$oidc = new OpenIDConnectClient("https://www.peercraft.com/");
$oidc->setClientName("stories library");
$oidc->register();
$client_id = $oidc->getClientID();
$client_secret = $oidc->getClientSecret();

echo $client_id;
echo "-----------------------------------------";
echo $client_secret;


?>


