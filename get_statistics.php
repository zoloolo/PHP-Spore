<?php
require_once 'vendor/autoload.php';

/** auth **/

$res = $client->get_statistics([
  'format'     => 'json',
  'dimensions' => json_encode(['channel', 'project', 'insertion', 'creative']),
  'metrics'    => json_encode(['impression', 'click', 'unique_frequency']),
  'account_id' => $account_id,
  'start_date' => date('Y-m-d 00:00:00', strtotime($_GET['start_date'])),
  'end_date'   => date('Y-m-d 23:59:59', strtotime($_GET['end_date'])),
]);

print_r($res->body);
