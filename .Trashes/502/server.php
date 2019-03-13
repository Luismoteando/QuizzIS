<?php
require 'vendor/autoload.php';

$client = new MongoDB\Client;
$db = $client->streaming;
$collection = $db->streaming;

if(isset($_POST['previous'])) {
  $state = $collection ->findOne(
    ['_id' => 'state']);
  $state = iterator_to_array($state);
  $result = $collection->updateOne(
    ['_id' => 'state'],
    ['$set' => ['value' => $state['value'] - 1]]
  );
}

if(isset($_POST['play'])) {
  $play = $_POST['play'];
  $result = $collection->updateOne(
    ['_id' => 'play'],
    ['$set' => ['value' => $play]]
  );
}

if(isset($_POST['next'])) {
  $state = $collection ->findOne(
    ['_id' => 'state']);
  $state = iterator_to_array($state);
  $result = $collection->updateOne(
    ['_id' => 'state'],
    ['$set' => ['value' => $state['value'] + 1]]
  );
}

$play = $collection->findOne(
  ['_id' => 'play']
);
$state = $collection->findOne(
  ['_id' => 'state']
);

$jsono = array($play, $state);

echo json_encode($jsono);
