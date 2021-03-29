<?php
require_once 'vendor/autoload.php';


$authClient = new Spore(__DIR__ . '/config/auth.yaml');
$client = new Spore(__DIR__ . '/config/list_route_config.yaml');


$auth = $authClient->get_authentication_api_jwt_token([
	'format'   => 'json',
	'email'    => 'xxx',
	'password' => 'xxx'
]);


$client->enable('AddHeader', [
	'header_name' => 'X-Weborama-JWTUserAuthToken',
	'header_value' => $auth->body->jwt_token
]);


$res = $client->get_wcm_accounts_from_authentication_user([
	'format' => 'json',
]);
print_r($res);
