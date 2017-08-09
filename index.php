<?php
include 'vendor/autoload.php';

use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\ValidationData;

$the_jwt_token = $_GET['sso_token'];
$sercret_key = "insert_SecretKey_from_sso_settings";


$token = (new Parser())->parse((string) $the_jwt_token);
$signer = new Sha256();


$data = new ValidationData(); // It will use the current time to validate (iat, nbf and exp)
$data->setIssuer('https://SCHOOLNAME.myschoolapp.com'); // School's app domain
$data->setAudience('https://thirdpartyappdomain.com'); // Third-party app domain



if ($token->verify($signer, $sercret_key)) {
  if ($token->validate($data)) {
  	/**
  	*
  	* Safe to log user into your app
  	*
  	**/
    echo "Valid token and safe to use." ;
    echo "UserId = " . $token->getClaim('uid');
	echo "<br>";
	echo "HostId (if set) = " . $token->getClaim('hid');
	echo "<br>";
	echo "API route for user = " . $token->getClaim('onapi');
	echo "<br>";
  } else {
  	/**
  	*
  	* Bad token end request
  	*
  	**/
    die("Token was created with the SecretKey, but isn't valid.");
  }
} else {
	/**
  	*
  	* Bad token end request
  	*
  	**/
	die("Signed with wrong SecretKey.");
}
