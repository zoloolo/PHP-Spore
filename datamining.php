<?php
require_once 'vendor/autoload.php';

/** auth **/

$res = $client->datamining_file_list([
  'format' => 'json',
  'month' => '2019-02',
  'account_id' => $account_id,
]);


foreach ($res->body->list as $obj) {
  echo "http://cstatic.weborama.fr/{$obj->file_path}\n";
}
