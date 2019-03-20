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
    $result = $collection->updateOne(
      ['_id' => 'turn'],
      ['$set' => ['value' => [null,null]]]
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
    $result = $collection->updateOne(
      ['_id' => 'turn'],
      ['$set' => ['value' => [null,null]]]
    );
}

if(isset($_POST['addA'])) {
  $teamA = $collection ->findOne(
    ['_id' => 'teamA']);
    $teamA = iterator_to_array($teamA);
    $result = $collection->updateOne(
      ['_id' => 'teamA'],
      ['$set' => ['value' => $teamA['value'] + 10]]
    );
  }

if(isset($_POST['substractA'])) {
  $teamA = $collection ->findOne(
    ['_id' => 'teamA']);
    $teamA = iterator_to_array($teamA);
    $result = $collection->updateOne(
      ['_id' => 'teamA'],
      ['$set' => ['value' => $teamA['value'] - 10]]
    );
  }

if(isset($_POST['addB'])) {
  $teamB = $collection ->findOne(
    ['_id' => 'teamB']);
    $teamB = iterator_to_array($teamB);
    $result = $collection->updateOne(
      ['_id' => 'teamB'],
      ['$set' => ['value' => $teamB['value'] + 10]]
    );
  }

if(isset($_POST['substractB'])) {
  $teamB = $collection ->findOne(
    ['_id' => 'teamB']);
    $teamB = iterator_to_array($teamB);
    $result = $collection->updateOne(
      ['_id' => 'teamB'],
      ['$set' => ['value' => $teamB['value'] - 10]]
    );
  }

if(isset($_POST['addC'])) {
  $teamC = $collection ->findOne(
    ['_id' => 'teamC']);
    $teamC = iterator_to_array($teamC);
    $result = $collection->updateOne(
      ['_id' => 'teamC'],
      ['$set' => ['value' => $teamC['value'] + 10]]
    );
  }

if(isset($_POST['substractC'])) {
$teamC = $collection ->findOne(
  ['_id' => 'teamC']);
  $teamC = iterator_to_array($teamC);
  $result = $collection->updateOne(
    ['_id' => 'teamC'],
    ['$set' => ['value' => $teamC['value'] - 10]]
  );
}

if(isset($_POST['option1in4'])) {
  $result = $collection->updateOne(
    ['_id' => 'option'],
    ['$set' => ['value' => 14]]
  );
}

if(isset($_POST['option2in4'])) {
  $result = $collection->updateOne(
    ['_id' => 'option'],
    ['$set' => ['value' => 24]]
  );
}

if(isset($_POST['option3in4'])) {
  $result = $collection->updateOne(
    ['_id' => 'option'],
    ['$set' => ['value' => 34]]
  );
}

if(isset($_POST['option4in4'])) {
  $result = $collection->updateOne(
    ['_id' => 'option'],
    ['$set' => ['value' => 44]]
  );
}

if(isset($_POST['option1in3'])) {
  $result = $collection->updateOne(
    ['_id' => 'option'],
    ['$set' => ['value' => 13]]
  );
}

if(isset($_POST['option2in3'])) {
  $result = $collection->updateOne(
    ['_id' => 'option'],
    ['$set' => ['value' => 23]]
  );
}

if(isset($_POST['option3in3'])) {
  $result = $collection->updateOne(
    ['_id' => 'option'],
    ['$set' => ['value' => 33]]
  );
}

if(isset($_POST['timer'])) {
  $time = $_POST['timer'];
  $result = $collection->updateOne(
    ['_id' => 'timer'],
    ['$set' => ['value' => $time]]
  );
}

if(isset($_POST['turn'])) {
  $turn = $_POST['turn'];
  $result = $collection->updateOne(
    ['_id' => 'turn'],
    ['$set' => ['value' => [$turn[0],null]]]
  );
  if(substr($turn,1,1) != "") {
    $result = $collection->updateOne(
      ['_id' => 'turn'],
      ['$set' => ['value' => [$turn[0], $turn[1]]]]
    );
  }
}

if(isset($_POST['lock'])) {
  $lock = $_POST['lock'];
  $result = $collection->updateOne(
    ['_id' => 'lock'],
    ['$set' => ['value' => $lock]]
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
$time = $collection ->findOne(
  ['_id' => 'timer']
);
$turn = $collection ->findOne(
  ['_id' => 'turn']
);
$lock = $collection ->findOne(
  ['_id' => 'lock']
);

$jsono = array($play, $state, $option, $teamA, $teamB, $teamC, $time, $turn, $lock);

echo json_encode($jsono);
