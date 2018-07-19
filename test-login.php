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

$oidc = new OpenIDConnectClient(
    'https://accounts.google.com',
    getenv('CLIENT_ID'),
    getenv('CLIENT_SEC')
);

foreach (getallheaders() as $name => $value) {
    echo "$name: $value\n";
}

$oidc->authenticate();
$name = $oidc->requestUserInfo('given_name');

echo $oidc->getIdToken();

foreach (getallheaders() as $name => $value) {
    echo "$name: $value\n";
}

?>

<?php echo $name; ?>
<?php echo $_GET['hehe']; ?>
