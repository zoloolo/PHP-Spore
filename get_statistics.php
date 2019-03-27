<?php
require_once 'vendor/autoload.php';

$settings = [
  'application_key' => '***',
  'private_key'     => '***',
  'email'           => '***',
  'password'        => '***',
];

$account_id = '***';


$client = new Spore('config/route_config.desktop.yaml');

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


$res = $client->get_statistics([
  'format'     => 'json',
  'dimensions' => json_encode(['channel', 'project', 'insertion', 'creative']),
  'metrics'    => json_encode(['impression', 'click', 'unique_frequency']),
  'account_id' => $account_id,
  'start_date' => date('Y-m-d 00:00:00', strtotime($_GET['start_date'])),
  'end_date'   => date('Y-m-d 23:59:59', strtotime($_GET['end_date'])),
]);

print_r($res->body);