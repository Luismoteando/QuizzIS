<?php
header('Access-Control-Allow-Origin: *');

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
  $play = $_POST['play'];
  $result = $collection->updateOne(
    ['_id' => 'play'],
    ['$set' => ['value' => $play]]
  );
  $result = $collection->updateOne(
    ['_id' => 'option'],
    ['$set' => ['value' => 0]]
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
  $play = $_POST['play'];
  $result = $collection->updateOne(
    ['_id' => 'play'],
    ['$set' => ['value' => $play]]
  );
  $result = $collection->updateOne(
    ['_id' => 'option'],
    ['$set' => ['value' => 0]]
  );
}

if(isset($_POST['add'])) {
  $videomarker = $collection ->findOne(
    ['_id' => 'videomarker']);
  $videomarker = iterator_to_array($videomarker);
  $result = $collection->updateOne(
    ['_id' => 'videomarker'],
    ['$set' => ['value' => $videomarker['value'] + 1]]
  );
}

if(isset($_POST['substract'])) {
  $videomarker = $collection ->findOne(
    ['_id' => 'videomarker']);
  $videomarker = iterator_to_array($videomarker);
  $result = $collection->updateOne(
    ['_id' => 'videomarker'],
    ['$set' => ['value' => $videomarker['value'] - 1]]
  );
}

if(isset($_POST['option1'])) {
  $result = $collection->updateOne(
    ['_id' => 'option'],
    ['$set' => ['value' => 1]]
  );
}

if(isset($_POST['option2'])) {
  $result = $collection->updateOne(
    ['_id' => 'option'],
    ['$set' => ['value' => 2]]
  );
}

if(isset($_POST['option3'])) {
  $result = $collection->updateOne(
    ['_id' => 'option'],
    ['$set' => ['value' => 3]]
  );
}

if(isset($_POST['option4'])) {
  $result = $collection->updateOne(
    ['_id' => 'option'],
    ['$set' => ['value' => 4]]
  );
}

$play = $collection->findOne(
  ['_id' => 'play']
);
$state = $collection->findOne(
  ['_id' => 'state']
);
$videomarker = $collection ->findOne(
  ['_id' => 'videomarker']
);
$option = $collection ->findOne(
  ['_id' => 'option']
);

$jsono = array($play, $state, $videomarker, $option);

echo json_encode($jsono);
