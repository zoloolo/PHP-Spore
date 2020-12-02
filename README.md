# install

```sh
$ composer install
```

## Simple usage

### Auth (basic)
```php
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
```

### Auth (jwt)
```php
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
$auth = $client->get_authentication_api_jwt_token([
  'format'   => 'json',
  'email'    => $settings['email'],
  'password' => $settings['password']
]);
$client->enable('AddHeader', [
  'header_name' => 'X-Weborama-JWTUserAuthToken',
  'header_value' => $auth->body->jwt_token
]);
// end auth
```


### Campaign info
```php

$res = $client->get_campaign([
	'format' => 'json',
	'account_id' => $account_id,
	'id' => 1234
]);

print_r($res);
```

### Custom events
```php

$res = $client->get_statistics([
  'format'     => 'json',
  'dimensions' => json_encode(['campaign', 'custom_event']),
  'metrics'    => json_encode(['event']),
  'account_id' => $account_id,
]);

print_r($res);
```
