<?php
require_once("OpenIDConnectClient.php");
use Jumbojett\OpenIDConnectClient;

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

foreach (getallheaders() as $name => $value) {
    echo "$name: $value\n";
}

?>

<?php echo $name; ?>
<?php echo $_GET['hehe']; ?>
