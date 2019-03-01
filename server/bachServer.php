<?php
header('Access-Control-Allow-Origin: *');

require 'vendor/autoload.php';

$client = new MongoDB\Client;
$db = $client->streaming;
$collection = $db->bachStreaming;

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

if(isset($_POST['addA'])) {
  $teamA = $collection ->findOne(
    ['_id' => 'teamA']);
  $teamA = iterator_to_array($teamA);
  $result = $collection->updateOne(
    ['_id' => 'teamA'],
    ['$set' => ['value' => $teamA['value'] + 1]]
  );
}

if(isset($_POST['substractA'])) {
  $teamA = $collection ->findOne(
    ['_id' => 'teamA']);
  $teamA = iterator_to_array($teamA);
  $result = $collection->updateOne(
    ['_id' => 'teamA'],
    ['$set' => ['value' => $teamA['value'] - 1]]
  );
}

if(isset($_POST['addB'])) {
  $teamB = $collection ->findOne(
    ['_id' => 'teamB']);
  $teamB = iterator_to_array($teamB);
  $result = $collection->updateOne(
    ['_id' => 'teamB'],
    ['$set' => ['value' => $teamB['value'] + 1]]
  );
}

if(isset($_POST['substractB'])) {
  $teamB = $collection ->findOne(
    ['_id' => 'teamB']);
  $teamB = iterator_to_array($teamB);
  $result = $collection->updateOne(
    ['_id' => 'teamB'],
    ['$set' => ['value' => $teamB['value'] - 1]]
  );
}

if(isset($_POST['addC'])) {
  $teamC = $collection ->findOne(
    ['_id' => 'teamC']);
  $teamC = iterator_to_array($teamC);
  $result = $collection->updateOne(
    ['_id' => 'teamC'],
    ['$set' => ['value' => $teamC['value'] + 1]]
  );
}

if(isset($_POST['substractC'])) {
  $teamC = $collection ->findOne(
    ['_id' => 'teamC']);
  $teamC = iterator_to_array($teamC);
  $result = $collection->updateOne(
    ['_id' => 'teamC'],
    ['$set' => ['value' => $teamC['value'] - 1]]
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
$teamA = $collection ->findOne(
  ['_id' => 'teamA']
);
$teamB = $collection ->findOne(
  ['_id' => 'teamB']
);
$teamC = $collection ->findOne(
  ['_id' => 'teamC']
);
$option = $collection ->findOne(
  ['_id' => 'option']
);

$jsono = array($play, $state, $option, $teamA, $teamB, $teamC);

echo json_encode($jsono);
