<?php
include 'vendor/autoload.php';
include 'header.php';

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

use GuzzleHttp\Client;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\ValidationData;

$secret_key = getenv('SECRET_KEY');
$issuer     = getenv('ISSUER_DOMAIN');
$token_name = getenv('TOKEN_NAME');
$audience   = getenv('AUDIENCE_DOMAIN');
$sso_path   = getenv('SSO_PATH');

try {

$the_jwt_token = $_GET[$token_name];

$token  = (new Parser())->parse((string) $the_jwt_token);
$signer = new Sha256();

$data = new ValidationData(); // It will use the current time to validate (iat, nbf and exp)

$data->setIssuer($issuer);
//$data->setIssuer('https://SCHOOLNAME.myschoolapp.com'); // School's app domain
$data->setAudience($audience); // Third-party app domain
if ($token->verify($signer, $secret_key)) {
    if ($token->validate($data)) {
        /**
         *
         * Safe to log user into your app
         *
         **/
        ?>

      <div class="alert alert-success">Token is Valid and safe to use.</div>
      <br>
      <h6>Token Data</h6>
      <ul class="list-group">
        <li class="list-group-item"><strong>UserID:</strong> <?php echo $token->getClaim('uid'); ?></li>
        <li class="list-group-item"><strong>HostID:</strong> <?php echo $token->getClaim('hid'); ?></li>
      </ul>
      <br>
      <?php

        $client = new Client([
            // You can set any number of default request options.
            'timeout' => 5.0,
        ]);
        try {
            $keys      = hash('sha512', $secret_key . $the_jwt_token);
            $uri       = $token->getClaim('post_url');
            $post_data = array(
                'key' => $keys,
                'jwt' => $the_jwt_token,
            );
            echo '<h6>Token Based API Request</h6>';
            echo '<ul class="list-group"><li class="list-group-item"><strong>Url</strong>: ' . $token->getClaim('post_url') . '</li>';
            echo "<li class='list-group-item'><strong>Post Data:</strong><pre><code>";
            print_r(json_encode($post_data, JSON_PRETTY_PRINT));
            echo "</code></pre></li>";
            $response = $client->post($uri, [
                'headers' => ['Content-Type' => 'application/json','User-Agent' => 'Blackbaud SSO DEMO/ 1.0'],
                'body'    => json_encode($post_data),
                'debug'   => false,
            ]);

            $body = $response->getBody();
            // Implicitly cast the body to a string and echo it
            echo "<li class='list-group-item'><strong>Response Data:</strong><pre><code>";
            echo json_encode(json_decode($body), JSON_PRETTY_PRINT);
            echo "</code></pre></li>";
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            echo "<li class='list-group-item'><strong>Error Data:</strong><pre><code>";
            print_r($e);
            print_r(json_encode(json_decode($e->getResponse()->getBody()->getContents()), JSON_PRETTY_PRINT));
            echo "</code></pre></li>";
        } catch (Exception $e) {
            echo "<li class='list-group-item'><strong>Error Data:</strong><pre><code>";
            print_r($e);
            echo "</code></pre></li>";
        }

        echo '<ul>';

    } else {
        /**
         *
         * Bad token end request
         *
         **/
        echo "<div class='alert alert-danger' role'alert'>Token was created with the correct SecretKey, but isn't valid. ie: expired, bad issuer or audience</div>";
    }
} else {
    /**
     *
     * Bad token end request
     *
     **/
    echo "<div class='alert alert-danger' role'alert'>Signed with wrong SecretKey.</div>";
}

}catch (Exception $e) {
   echo "<div class='alert alert-warning' role'alert'>";
           
            ?>
            Whoops. Looks like you may not have a token.<br>Try again: <a href="<?php echo $issuer . $sso_path; ?>"><?php echo $issuer . $sso_path; ?></a>
            <?php
           
            echo "</div>";
}
include 'footer.php';