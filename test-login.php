<?php
require __DIR__ . '/vendor/autoload.php';
use Jumbojett\OpenIDConnectClient;

$oidc = new OpenIDConnectClient(
    'https://accounts.google.com',
    getenv('CLIENT_ID'),
    getenv('CLIENT_SEC')
);
$oidc->authenticate();
$name = $oidc->requestUserInfo('given_name');


?>

<?php echo $name; ?>
