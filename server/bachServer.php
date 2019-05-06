<?php
header('Access-Control-Allow-Origin: *');

require 'vendor/autoload.php';

$client = new MongoDB\Client;
$db = $client->olimpiada;
$collection = $db->bach;
$dir = "/Applications/MAMP/htdocs/client/media/questions/bach";

$play = $collection->findOne(['_id' => 'play']);
$mandatory = $collection->findOne(['_id' => 'mandatory']);
$lead = $collection->findOne(['_id' => 'lead']);
$teamA = $collection->findOne(['_id' => 'teamA']);
$teamB = $collection->findOne(['_id' => 'teamB']);
$teamC = $collection->findOne(['_id' => 'teamC']);
$option = $collection->findOne(['_id' => 'option']);
$time = $collection->findOne(['_id' => 'timer']);
$turn = $collection->findOne(['_id' => 'turn']);
$lock = $collection->findOne(['_id' => 'lock']);
$sfx = $collection->findOne(['_id' => 'sfx']);
$solution = $collection->findOne(['_id' => 'solution']);
$mode = $collection->findOne(['_id' => 'mode']);
$category = $collection->findOne(['_id' => 'category']);
$general = $collection->findOne(['_id' => 'general']);

$mandatory = iterator_to_array($mandatory);
if($mandatory['value'][1] == null) {
  $total  = count(glob("$dir/mandatory/*"), GLOB_ONLYDIR);
  $result = $collection->updateOne(
    ['_id' => 'mandatory'],
    ['$set' => ['value.1' => $total]]
  );
}

$general = iterator_to_array($general);
if($general['value'][1] == null) {
  $total  = count(glob("$dir/general/*"), GLOB_ONLYDIR);
  $result = $collection->updateOne(
    ['_id' => 'general'],
    ['$set' => ['value.1' => $total]]
  );
}

if(isset($_POST['mode'])) {
  $mode = $_POST['mode'];
  $result = $collection->updateOne(
    ['_id' => 'mode'],
    ['$set' => ['value' => $mode]]
  );
}

if(isset($_POST['lead'])) {
  $lead = $_POST['lead'];
  $result = $collection->updateOne(
    ['_id' => 'lead'],
    ['$set' => ['value' => $lead]]
  );
}

if(isset($_POST['category'])) {
  $category = $_POST['category'];
  $result = $collection->updateOne(
    ['_id' => 'category'],
    ['$set' => ['value' => $category]]
  );
}

if(isset($_POST['mandatory'])) {
  $mandatory = $_POST['mandatory'];
  $result = $collection->updateOne(
    ['_id' => 'mandatory'],
    ['$set' => ['value.0' => $mandatory]]
  );
}

if(isset($_POST['general'])) {
  $general = $_POST['general'];
  $result = $collection->updateOne(
    ['_id' => 'general'],
    ['$set' => ['value.0' => $general]]
  );
}

if(isset($_POST['previous'])) {
  $category = $_POST['category'];
  if($category == "mandatory") {
    $result = $collection->updateOne(
      ['_id' => 'mandatory'],
      ['$set' => ['value.0' => $mandatory['value'][0] - 1]]
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
      ['$set' => ['value' => [null, null, null]]]
    );
  } elseif($category == "general") {
    $result = $collection->updateOne(
      ['_id' => 'general'],
      ['$set' => ['value.0' => $general['value'][0] - 1]]
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
      ['$set' => ['value' => [null, null, null]]]
    );
  }
}

if(isset($_POST['play'])) {
  $play = $_POST['play'];
  $result = $collection->updateOne(
    ['_id' => 'play'],
    ['$set' => ['value' => $play]]
  );
}

if(isset($_POST['next'])) {
  $category = $_POST['category'];
  if($category == "mandatory") {
    $result = $collection->updateOne(
      ['_id' => 'mandatory'],
      ['$set' => ['value.0' => $mandatory['value'][0] + 1]]
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
      ['$set' => ['value' => [null, null, null]]]
    );
  } elseif($category == "general") {
    $result = $collection->updateOne(
      ['_id' => 'general'],
      ['$set' => ['value.0' => $general['value'][0] + 1]]
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
      ['$set' => ['value' => [null, null, null]]]
    );
  }
}

if(isset($_POST['timer'])) {
  $time = $_POST['timer'];
  $result = $collection->updateOne(
    ['_id' => 'timer'],
    ['$set' => ['value' => $time]]
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

if(isset($_POST['solution'])) {
  $solution = $_POST['solution'];
  $result = $collection->updateOne(
    ['_id' => 'solution'],
    ['$set' => ['value' => $solution]]
  );
}

if(isset($_POST['sfx'])) {
  $sfx = $_POST['sfx'];
  $result = $collection->updateOne(
    ['_id' => 'sfx'],
    ['$set' => ['value' => $sfx]]
  );
}

if(isset($_POST['lock'])) {
  $lock = $_POST['lock'];
  $result = $collection->updateOne(
    ['_id' => 'lock'],
    ['$set' => ['value' => $lock]]
  );
}

if(isset($_POST['turn'])) {
  $lock = iterator_to_array($lock);
  $serial = $_POST['turn'];
  $turn = iterator_to_array($turn);
  $buffer = $turn['buffer'];
  $value = $turn['value'];
  if($lock['value'] == 'false') {
    $buffer1 = str_split($serial, 1);
    $buffer2 = str_split($buffer, 1);
    $diff = array_diff_assoc($buffer1, $buffer2);
    if($value[0] == null) {
      if($first = reset($diff)) {
        $result = $collection->updateOne(
          ['_id' => 'turn'],
          ['$set' => ['value.0' => $first, 'buffer' => $serial]]
        );
      }
    } elseif($value[1] == null) {
      if($second = reset($diff)) {
        $result = $collection->updateOne(
          ['_id' => 'turn'],
          ['$set' => ['value.1' => $second, 'buffer' => $serial]]
        );
      }
    } elseif($value[2] == null) {
      if($third = reset($diff)) {
        $result = $collection->updateOne(
          ['_id' => 'turn'],
          ['$set' => ['value.2' => $third, 'buffer' => $serial]]
        );
      }
    }
  } else {
    if($value[0] == null) {
      $result = $collection->updateOne(
        ['_id' => 'turn'],
        ['$set' => ['value' => [null, null, null], 'buffer' => $serial]]
      );
    }
  }
}

if(isset($_POST['turnAux'])) {
  $turnAux = $_POST['turnAux'];
  if($turnAux != "") {
    $result = $collection->updateOne(
      ['_id' => 'turn'],
      ['$set' => ['value.0' => $turnAux]]
    );
  } else {
    $result = $collection->updateOne(
      ['_id' => 'turn'],
      ['$set' => ['value' => [null, null, null]]]
    );
  }
}

if(isset($_POST['addA'])) {
  $teamA = iterator_to_array($teamA);
  $result = $collection->updateOne(
    ['_id' => 'teamA'],
    ['$set' => ['value' => $teamA['value'] + 10]]
  );
}

if(isset($_POST['substractA'])) {
  $teamA = iterator_to_array($teamA);
  $result = $collection->updateOne(
    ['_id' => 'teamA'],
    ['$set' => ['value' => $teamA['value'] - 10]]
  );
}

if(isset($_POST['addB'])) {
  $teamB = iterator_to_array($teamB);
  $result = $collection->updateOne(
    ['_id' => 'teamB'],
    ['$set' => ['value' => $teamB['value'] + 10]]
  );
}

if(isset($_POST['substractB'])) {
  $teamB = iterator_to_array($teamB);
  $result = $collection->updateOne(
    ['_id' => 'teamB'],
    ['$set' => ['value' => $teamB['value'] - 10]]
  );
}

if(isset($_POST['addC'])) {
  $teamC = iterator_to_array($teamC);
  $result = $collection->updateOne(
    ['_id' => 'teamC'],
    ['$set' => ['value' => $teamC['value'] + 10]]
  );
}

if(isset($_POST['substractC'])) {
  $teamC = iterator_to_array($teamC);
  $result = $collection->updateOne(
    ['_id' => 'teamC'],
    ['$set' => ['value' => $teamC['value'] - 10]]
  );
}

$jsono = array($play, $mandatory, $option, $teamA, $teamB, $teamC, $time, $turn, $lock, $sfx, $solution, $mode, $lead, $category, $general);
echo json_encode($jsono);
