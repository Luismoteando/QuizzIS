<?php
header('Access-Control-Allow-Origin: *');

require 'vendor/autoload.php';

$client = new MongoDB\Client;
$db = $client->olimpiada;
$collection = $db->cycl;
$dir = "/Applications/MAMP/htdocs/client/media/questions/cycl";

$mode = $collection->findOne(['_id' => 'mode']);
$lead = $collection->findOne(['_id' => 'lead']);
$category = $collection->findOne(['_id' => 'category']);
$mandatory = $collection->findOne(['_id' => 'mandatory']);
$general = $collection->findOne(['_id' => 'general']);
$play = $collection->findOne(['_id' => 'play']);
$time = $collection->findOne(['_id' => 'timer']);
$option = $collection->findOne(['_id' => 'option']);
$solution = $collection->findOne(['_id' => 'solution']);
$lock = $collection->findOne(['_id' => 'lock']);
$turn = $collection->findOne(['_id' => 'turn']);
$teamA = $collection->findOne(['_id' => 'teamA']);
$teamB = $collection->findOne(['_id' => 'teamB']);
$teamC = $collection->findOne(['_id' => 'teamC']);
$sfx = $collection->findOne(['_id' => 'sfx']);
$spectators = $collection->findOne(['_id' => 'spectators']);

if (isset($_POST['mode'])) {
  $mode = $_POST['mode'];
  $result = $collection->updateOne(
    ['_id' => 'mode'],
    ['$set' => ['value' => $mode]]
  );
}

if (isset($_POST['lead'])) {
  $lead = $_POST['lead'];
  $result = $collection->updateOne(
    ['_id' => 'lead'],
    ['$set' => ['value' => $lead]]
  );
}

if (isset($_POST['category'])) {
  $category = $_POST['category'];
  $result = $collection->updateOne(
    ['_id' => 'category'],
    ['$set' => ['value' => $category]]
  );
}

$mandatory = iterator_to_array($mandatory);
if ($mandatory['value'][1] == null) {
  $total  = count(glob("$dir/mandatory/*"), GLOB_ONLYDIR);
  $result = $collection->updateOne(
    ['_id' => 'mandatory'],
    ['$set' => ['value.1' => $total]]
  );
}

if (isset($_POST['mandatory'])) {
  $mandatory = $_POST['mandatory'];
  $result = $collection->updateOne(
    ['_id' => 'mandatory'],
    ['$set' => ['value.0' => $mandatory]]
  );
}

if (isset($_POST['general'])) {
  $general = $_POST['general'];
  $result = $collection->updateOne(
    ['_id' => 'general'],
    ['$set' => ['value.0' => $general]]
  );
}

$general = iterator_to_array($general);
if ($general['value'][1] == null) {
  $total  = count(glob("$dir/general/*"), GLOB_ONLYDIR);
  $result = $collection->updateOne(
    ['_id' => 'general'],
    ['$set' => ['value.1' => $total]]
  );
}

if (isset($_POST['previous'])) {
  $category = $_POST['category'];
  if ($category == "mandatory") {
    $result = $collection->updateOne(
      ['_id' => 'mandatory'],
      ['$set' => ['value.0' => $mandatory['value'][0] - 1]]
    );
    $play = $_POST['play'];
    $play = filter_var($play, FILTER_VALIDATE_BOOLEAN);
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
  } elseif ($category == "general") {
    $result = $collection->updateOne(
      ['_id' => 'general'],
      ['$set' => ['value.0' => $general['value'][0] - 1]]
    );
    $play = $_POST['play'];
    $play = filter_var($play, FILTER_VALIDATE_BOOLEAN);
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

if (isset($_POST['play'])) {
  $play = $_POST['play'];
  $play = filter_var($play, FILTER_VALIDATE_BOOLEAN);
  $result = $collection->updateOne(
    ['_id' => 'play'],
    ['$set' => ['value' => $play]]
  );
}

if (isset($_POST['next'])) {
  $category = $_POST['category'];
  if ($category == "mandatory") {
    $result = $collection->updateOne(
      ['_id' => 'mandatory'],
      ['$set' => ['value.0' => $mandatory['value'][0] + 1]]
    );
    $play = $_POST['play'];
    $play = filter_var($play, FILTER_VALIDATE_BOOLEAN);
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
  } elseif ($category == "general") {
    $result = $collection->updateOne(
      ['_id' => 'general'],
      ['$set' => ['value.0' => $general['value'][0] + 1]]
    );
    $play = $_POST['play'];
    $play = filter_var($play, FILTER_VALIDATE_BOOLEAN);
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

if (isset($_POST['timer'])) {
  $time = $_POST['timer'];
  $result = $collection->updateOne(
    ['_id' => 'timer'],
    ['$set' => ['value' => $time]]
  );
}

if (isset($_POST['option1p4'])) {
  $result = $collection->updateOne(
    ['_id' => 'option'],
    ['$set' => ['value' => 14]]
  );
}

if (isset($_POST['option2p4'])) {
  $result = $collection->updateOne(
    ['_id' => 'option'],
    ['$set' => ['value' => 24]]
  );
}

if (isset($_POST['option3p4'])) {
  $result = $collection->updateOne(
    ['_id' => 'option'],
    ['$set' => ['value' => 34]]
  );
}

if (isset($_POST['option4p4'])) {
  $result = $collection->updateOne(
    ['_id' => 'option'],
    ['$set' => ['value' => 44]]
  );
}

if (isset($_POST['option1p3'])) {
  $result = $collection->updateOne(
    ['_id' => 'option'],
    ['$set' => ['value' => 13]]
  );
}

if (isset($_POST['option2p3'])) {
  $result = $collection->updateOne(
    ['_id' => 'option'],
    ['$set' => ['value' => 23]]
  );
}

if (isset($_POST['option3p3'])) {
  $result = $collection->updateOne(
    ['_id' => 'option'],
    ['$set' => ['value' => 33]]
  );
}

if (isset($_POST['solution'])) {
  $solution = $_POST['solution'];
  $solution = filter_var($solution, FILTER_VALIDATE_BOOLEAN);
  $result = $collection->updateOne(
    ['_id' => 'solution'],
    ['$set' => ['value' => $solution]]
  );
}

if (isset($_POST['lock'])) {
  $lock = $_POST['lock'];
  $lock = filter_var($lock, FILTER_VALIDATE_BOOLEAN);
  $result = $collection->updateOne(
    ['_id' => 'lock'],
    ['$set' => ['value' => $lock]]
  );
}

if (isset($_POST['turn'])) {
  $lock = iterator_to_array($lock);
  $serial = $_POST['turn'];
  $turn = iterator_to_array($turn);
  $buffer = $turn['buffer'];
  $value = $turn['value'];

  if ($lock['value'] == false) {
    $buffer1 = str_split($serial, 1);
    $buffer2 = str_split($buffer, 1);
    $diff = array_diff_assoc($buffer1, $buffer2);
    if ($value[0] == null) {
      if ($first = reset($diff)) {
        $result = $collection->updateOne(
          ['_id' => 'turn'],
          ['$set' => ['value.0' => $first, 'buffer' => $serial]]
        );
        $result = $collection->updateOne(
          ['_id' => 'play'],
          ['$set' => ['value' => false]]
        );
        $result = $collection->updateOne(
          ['_id' => 'sfx'],
          ['$set' => ['value' => 3]]
        );
      }
    } elseif ($value[1] == null) {
      if ($second = reset($diff)) {
        $result = $collection->updateOne(
          ['_id' => 'turn'],
          ['$set' => ['value.1' => $second, 'buffer' => $serial]]
        );
        $result = $collection->updateOne(
          ['_id' => 'play'],
          ['$set' => ['value' => false]]
        );
        $result = $collection->updateOne(
          ['_id' => 'sfx'],
          ['$set' => ['value' => 3]]
        );
      }
    } elseif ($value[2] == null) {
      if ($third = reset($diff)) {
        $result = $collection->updateOne(
          ['_id' => 'turn'],
          ['$set' => ['value.2' => $third, 'buffer' => $serial]]
        );
        $result = $collection->updateOne(
          ['_id' => 'play'],
          ['$set' => ['value' => false]]
        );
        $result = $collection->updateOne(
          ['_id' => 'sfx'],
          ['$set' => ['value' => 3]]
        );
      }
    }
  } else {
    $result = $collection->updateOne(
      ['_id' => 'turn'],
      ['$set' => ['buffer' => $serial]]
    );
  }
}

if (isset($_POST['turnAux'])) {
  $turn = iterator_to_array($turn);
  $value = iterator_to_array($turn['value']);
  $turnAux = $_POST['turnAux'];

  if(isset($_POST['sfx'])) {
    $sfx = $_POST['sfx'];
    if ($sfx == 4) {
      array_shift($value);
      array_push($value, null);
      $result = $collection->updateOne(
        ['_id' => 'turn'],
        ['$set' => ['value' => $value]]
      );
    } elseif ($sfx == 5) {
      $result = $collection->updateOne(
        ['_id' => 'turn'],
        ['$set' => ['value' => [null, null, null]]]
      );
    }
  } else {
    if ($turnAux == "") {
      array_shift($value);
      array_push($value, null);
      $result = $collection->updateOne(
        ['_id' => 'turn'],
        ['$set' => ['value' => $value]]
      );
    } else {
      $result = $collection->updateOne(
        ['_id' => 'turn'],
        ['$set' => ['value.0' => $turnAux]]
      );
    }
  }
}

if (isset($_POST['team'])) {
  $team = $_POST['team'];
  $alias = $_POST['alias'];
  if ($team == "teamA") {
    $result = $collection->updateOne(
      ['_id' => 'teamA'],
      ['$set' => ['value.0' => $alias]]
    );
  } elseif ($team == "teamB") {
    $result = $collection->updateOne(
      ['_id' => 'teamB'],
      ['$set' => ['value.0' => $alias]]
    );
  } elseif ($team == "teamC") {
    $result = $collection->updateOne(
      ['_id' => 'teamC'],
      ['$set' => ['value.0' => $alias]]
    );
  }
}

if (isset($_POST['add5A'])) {
  $teamA = iterator_to_array($teamA);
  $result = $collection->updateOne(
    ['_id' => 'teamA'],
    ['$set' => ['value.1' => $teamA['value'][1] + 5]]
  );
}

if (isset($_POST['sub5A'])) {
  $teamA = iterator_to_array($teamA);
  $result = $collection->updateOne(
    ['_id' => 'teamA'],
    ['$set' => ['value.1' => $teamA['value'][1] - 5]]
  );
}

if (isset($_POST['add5B'])) {
  $teamB = iterator_to_array($teamB);
  $result = $collection->updateOne(
    ['_id' => 'teamB'],
    ['$set' => ['value.1' => $teamB['value'][1] + 5]]
  );
}

if (isset($_POST['sub5B'])) {
  $teamB = iterator_to_array($teamB);
  $result = $collection->updateOne(
    ['_id' => 'teamB'],
    ['$set' => ['value.1' => $teamB['value'][1] - 5]]
  );
}

if (isset($_POST['add5C'])) {
  $teamC = iterator_to_array($teamC);
  $result = $collection->updateOne(
    ['_id' => 'teamC'],
    ['$set' => ['value.1' => $teamC['value'][1] + 5]]
  );
}

if (isset($_POST['sub5C'])) {
  $teamC = iterator_to_array($teamC);
  $result = $collection->updateOne(
    ['_id' => 'teamC'],
    ['$set' => ['value.1' => $teamC['value'][1] - 5]]
  );
}

if (isset($_POST['add10A'])) {
  $teamA = iterator_to_array($teamA);
  $result = $collection->updateOne(
    ['_id' => 'teamA'],
    ['$set' => ['value.1' => $teamA['value'][1] + 10]]
  );
}

if (isset($_POST['sub10A'])) {
  $teamA = iterator_to_array($teamA);
  $result = $collection->updateOne(
    ['_id' => 'teamA'],
    ['$set' => ['value.1' => $teamA['value'][1] - 10]]
  );
}

if (isset($_POST['add10B'])) {
  $teamB = iterator_to_array($teamB);
  $result = $collection->updateOne(
    ['_id' => 'teamB'],
    ['$set' => ['value.1' => $teamB['value'][1] + 10]]
  );
}

if (isset($_POST['sub10B'])) {
  $teamB = iterator_to_array($teamB);
  $result = $collection->updateOne(
    ['_id' => 'teamB'],
    ['$set' => ['value.1' => $teamB['value'][1] - 10]]
  );
}

if (isset($_POST['add10C'])) {
  $teamC = iterator_to_array($teamC);
  $result = $collection->updateOne(
    ['_id' => 'teamC'],
    ['$set' => ['value.1' => $teamC['value'][1] + 10]]
  );
}

if (isset($_POST['sub10C'])) {
  $teamC = iterator_to_array($teamC);
  $result = $collection->updateOne(
    ['_id' => 'teamC'],
    ['$set' => ['value.1' => $teamC['value'][1] - 10]]
  );
}

if (isset($_POST['add20A'])) {
  $teamA = iterator_to_array($teamA);
  $result = $collection->updateOne(
    ['_id' => 'teamA'],
    ['$set' => ['value.1' => $teamA['value'][1] + 20]]
  );
}

if (isset($_POST['sub20A'])) {
  $teamA = iterator_to_array($teamA);
  $result = $collection->updateOne(
    ['_id' => 'teamA'],
    ['$set' => ['value.1' => $teamA['value'][1] - 20]]
  );
}

if (isset($_POST['add20B'])) {
  $teamB = iterator_to_array($teamB);
  $result = $collection->updateOne(
    ['_id' => 'teamB'],
    ['$set' => ['value.1' => $teamB['value'][1] + 20]]
  );
}

if (isset($_POST['sub20B'])) {
  $teamB = iterator_to_array($teamB);
  $result = $collection->updateOne(
    ['_id' => 'teamB'],
    ['$set' => ['value.1' => $teamB['value'][1] - 20]]
  );
}

if (isset($_POST['add20C'])) {
  $teamC = iterator_to_array($teamC);
  $result = $collection->updateOne(
    ['_id' => 'teamC'],
    ['$set' => ['value.1' => $teamC['value'][1] + 20]]
  );
}

if (isset($_POST['sub20C'])) {
  $teamC = iterator_to_array($teamC);
  $result = $collection->updateOne(
    ['_id' => 'teamC'],
    ['$set' => ['value.1' => $teamC['value'][1] - 20]]
  );
}

if (isset($_POST['sfx'])) {
  $sfx = $_POST['sfx'];
  $result = $collection->updateOne(
    ['_id' => 'sfx'],
    ['$set' => ['value' => $sfx]]
  );
}

if (isset($_POST['submit'])) {
  $spect1 = $_POST['spect1'];
  $spect2 = $_POST['spect2'];
  $spect3 = $_POST['spect3'];
  $result = $collection->updateOne(
    ['_id' => 'spectators'],
    ['$set' => ['value' => [$spect1, $spect2, $spect3]]]
  );
}

$jsono = array($mode, $lead, $category, $mandatory, $general, $play, $time, $option, $solution, $lock, $turn, $teamA, $teamB, $teamC, $sfx, $spectators);
echo json_encode($jsono);
