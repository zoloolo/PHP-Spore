<?php
require_once 'vendor/autoload.php';

$settings = [
	'application_key' => '***',
	'private_key'     => '***',
	'email'           => '***',
	'password'        => '***',
];

$account_id = 123;
$client = new Spore(__DIR__ . '/config/route_config.desktop.yaml');

// auth
$client->enable('AddHeader', [
	'header_name'  => 'X-Weborama-Account_Id',
	'header_value' => $account_id
]);
$client->enable('Spore_Middleware_Weborama_Authentication', [
	'application_key' => $settings['application_key'],
	'private_key'     => $settings['private_key'],
	'user_email'      => $settings['email']
]);
$auth = $client->get_authentication_token([
	'format'   => 'json',
	'email'    => $settings['email'],
	'password' => $settings['password']
]);
$client->enable('AddHeader', [
	'header_name'  => 'X-Weborama-UserAuthToken',
	'header_value' => $auth->body->token,
]);
// end auth


$clientList = new Spore(__DIR__ . '/config/list_route_config.yaml');
$clientList->enable('AddHeader', [
	'header_name'  => 'X-Weborama-UserAuthToken',
	'header_value' => $auth->body->token,
]);


$res = $clientList->get_wcm_accounts_from_authentication_user([
	'format' => 'json',
]);
print_r($res);
