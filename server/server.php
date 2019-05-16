<?php
header('Access-Control-Allow-Origin: *');

require 'vendor/autoload.php';

$client = new MongoDB\Client;
$db = $client->olimpiada;
$collection = $db->olimpiada;

$phase = $collection->findOne(['_id' => 'phase']);
$mode = $collection->findOne(['_id' => 'mode']);
$lead = $collection->findOne(['_id' => 'lead']);
$category = $collection->findOne(['_id' => 'category']);
$mandatoryBach = $collection->findOne(['_id' => 'mandatoryBach']);
$generalBach = $collection->findOne(['_id' => 'generalBach']);
$mandatoryCycl = $collection->findOne(['_id' => 'mandatoryCycl']);
$generalCycl = $collection->findOne(['_id' => 'generalCycl']);
$play = $collection->findOne(['_id' => 'play']);
$time = $collection->findOne(['_id' => 'timer']);
$option = $collection->findOne(['_id' => 'option']);
$solution = $collection->findOne(['_id' => 'solution']);
$lock = $collection->findOne(['_id' => 'lock']);
$turn = $collection->findOne(['_id' => 'turn']);
$teamBachA = $collection->findOne(['_id' => 'teamBachA']);
$teamBachB = $collection->findOne(['_id' => 'teamBachB']);
$teamBachC = $collection->findOne(['_id' => 'teamBachC']);
$teamCyclA = $collection->findOne(['_id' => 'teamCyclA']);
$teamCyclB = $collection->findOne(['_id' => 'teamCyclB']);
$teamCyclC = $collection->findOne(['_id' => 'teamCyclC']);
$sfx = $collection->findOne(['_id' => 'sfx']);
$spectators = $collection->findOne(['_id' => 'spectators']);

if (isset($_POST['phase'])) {
  $phase = $_POST['phase'];
  $result = $collection->updateOne(
    ['_id' => 'phase'],
    ['$set' => ['value' => $phase]]
  );
} else {
  $phase = iterator_to_array($phase);
  $phaseAux = $phase['value'];
  $dir = "/Applications/MAMP/htdocs/client/media/questions/$phaseAux";
}

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

$mandatoryBach = iterator_to_array($mandatoryBach);
$mandatoryCycl = iterator_to_array($mandatoryCycl);
if ($phase['value'] == "bach") {
  if ($mandatoryBach['value'][1] == null) {
    $total  = count(glob("$dir/mandatory/*"), GLOB_ONLYDIR);
    $result = $collection->updateOne(
      ['_id' => 'mandatoryBach'],
      ['$set' => ['value.1' => $total]]
    );
  }
} elseif ($phase['value'] == "cycl") {
  if ($mandatoryCycl['value'][1] == null) {
    $total  = count(glob("$dir/mandatory/*"), GLOB_ONLYDIR);
    $result = $collection->updateOne(
      ['_id' => 'mandatoryCycl'],
      ['$set' => ['value.1' => $total]]
    );
  }
}

if (isset($_POST['mandatoryBach'])) {
  $mandatoryBach = $_POST['mandatoryBach'];
  $result = $collection->updateOne(
    ['_id' => 'mandatoryBach'],
    ['$set' => ['value.0' => $mandatoryBach]]
  );
}

if (isset($_POST['mandatoryCycl'])) {
  $mandatoryCycl = $_POST['mandatoryCycl'];
  $result = $collection->updateOne(
    ['_id' => 'mandatoryCycl'],
    ['$set' => ['value.0' => $mandatoryCycl]]
  );
}

$generalBach = iterator_to_array($generalBach);
$generalCycl = iterator_to_array($generalCycl);
if ($phase['value'] == "bach") {
  if ($generalBach['value'][1] == null) {
    $total  = count(glob("$dir/general/*"), GLOB_ONLYDIR);
    $result = $collection->updateOne(
      ['_id' => 'generalBach'],
      ['$set' => ['value.1' => $total]]
    );
  }
} elseif ($phase['value'] == "cycl") {
  if ($generalCycl['value'][1] == null) {
    $total  = count(glob("$dir/general/*"), GLOB_ONLYDIR);
    $result = $collection->updateOne(
      ['_id' => 'generalCycl'],
      ['$set' => ['value.1' => $total]]
    );
  }
}

if (isset($_POST['generalBach'])) {
  $generalBach = $_POST['generalBach'];
  $result = $collection->updateOne(
    ['_id' => 'generalBach'],
    ['$set' => ['value.0' => $generalBach]]
  );
}

if (isset($_POST['generalCycl'])) {
  $generalCycl = $_POST['generalCycl'];
  $result = $collection->updateOne(
    ['_id' => 'generalCycl'],
    ['$set' => ['value.0' => $generalCycl]]
  );
}

if (isset($_POST['previous'])) {
  $category = $_POST['category'];
  if ($category == "mandatory") {
    if ($phase['value'] == "bach") {
      $result = $collection->updateOne(
        ['_id' => 'mandatoryBach'],
        ['$set' => ['value.0' => $mandatoryBach['value'][0] - 1]]
      );
    } elseif ($phase['value'] == "cycl") {
      $result = $collection->updateOne(
        ['_id' => 'mandatoryCycl'],
        ['$set' => ['value.0' => $mandatoryCycl['value'][0] - 1]]
      );
    }
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
    if ($phase['value'] == "bach") {
      $result = $collection->updateOne(
        ['_id' => 'generalBach'],
        ['$set' => ['value.0' => $generalBach['value'][0] - 1]]
      );
    } elseif ($phase['value'] == "cycl") {
      $result = $collection->updateOne(
        ['_id' => 'generalCycl'],
        ['$set' => ['value.0' => $generalCycl['value'][0] - 1]]
      );
    }
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
    if ($phase['value'] == "bach") {
      $result = $collection->updateOne(
        ['_id' => 'mandatoryBach'],
        ['$set' => ['value.0' => $mandatoryBach['value'][0] + 1]]
      );
    } elseif ($phase['value'] == "cycl") {
      $result = $collection->updateOne(
        ['_id' => 'mandatoryCycl'],
        ['$set' => ['value.0' => $mandatoryCycl['value'][0] + 1]]
      );
    }
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
    if ($phase['value'] == "bach") {
      $result = $collection->updateOne(
        ['_id' => 'generalBach'],
        ['$set' => ['value.0' => $generalBach['value'][0] + 1]]
      );
    } elseif ($phase['value'] == "cycl") {
      $result = $collection->updateOne(
        ['_id' => 'generalCycl'],
        ['$set' => ['value.0' => $generalCycl['value'][0] + 1]]
      );
    }
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

if (isset($_POST['add5A'])) {
  $teamBachA = iterator_to_array($teamBachA);
  $teamCyclA = iterator_to_array($teamCyclA);
  if ($phase['value'] == "bach") {
    $result = $collection->updateOne(
      ['_id' => 'teamBachA'],
      ['$set' => ['value.1' => $teamBachA['value'][1] + 5]]
    );
  } elseif ($phase['value'] == "cycl") {
    $result = $collection->updateOne(
      ['_id' => 'teamCyclA'],
      ['$set' => ['value.1' => $teamCyclA['value'][1] + 5]]
    );
  }
}

if (isset($_POST['sub5A'])) {
  $teamBachA = iterator_to_array($teamBachA);
  $teamCyclA = iterator_to_array($teamCyclA);
  if ($phase['value'] == "bach") {
    $result = $collection->updateOne(
      ['_id' => 'teamBachA'],
      ['$set' => ['value.1' => $teamBachA['value'][1] - 5]]
    );
  } elseif ($phase['value'] == "cycl") {
    $result = $collection->updateOne(
      ['_id' => 'teamCyclA'],
      ['$set' => ['value.1' => $teamCyclA['value'][1] - 5]]
    );
  }
}

if (isset($_POST['add5B'])) {
  $teamBachB = iterator_to_array($teamBachB);
  $teamCyclB = iterator_to_array($teamCyclB);
  if ($phase['value'] == "bach") {
    $result = $collection->updateOne(
      ['_id' => 'teamBachB'],
      ['$set' => ['value.1' => $teamBachB['value'][1] + 5]]
    );
  } elseif ($phase['value'] == "cycl") {
    $result = $collection->updateOne(
      ['_id' => 'teamCyclB'],
      ['$set' => ['value.1' => $teamCyclB['value'][1] + 5]]
    );
  }
}

if (isset($_POST['sub5B'])) {
  $teamBachB = iterator_to_array($teamBachB);
  $teamCyclB = iterator_to_array($teamCyclB);
  if ($phase['value'] == "bach") {
    $result = $collection->updateOne(
      ['_id' => 'teamBachB'],
      ['$set' => ['value.1' => $teamBachB['value'][1] - 5]]
    );
  } elseif ($phase['value'] == "cycl") {
    $result = $collection->updateOne(
      ['_id' => 'teamCyclB'],
      ['$set' => ['value.1' => $teamCyclB['value'][1] - 5]]
    );
  }
}

if (isset($_POST['add5C'])) {
  $teamBachC = iterator_to_array($teamBachC);
  $teamCyclC = iterator_to_array($teamCyclC);
  if ($phase['value'] == "bach") {
    $result = $collection->updateOne(
      ['_id' => 'teamBachC'],
      ['$set' => ['value.1' => $teamBachC['value'][1] + 5]]
    );
  } elseif ($phase['value'] == "cycl") {
    $result = $collection->updateOne(
      ['_id' => 'teamCyclC'],
      ['$set' => ['value.1' => $teamCyclC['value'][1] + 5]]
    );
  }
}

if (isset($_POST['sub5C'])) {
  $teamBachC = iterator_to_array($teamBachC);
  $teamCyclC = iterator_to_array($teamCyclC);
  if ($phase['value'] == "bach") {
    $result = $collection->updateOne(
      ['_id' => 'teamBachC'],
      ['$set' => ['value.1' => $teamBachC['value'][1] - 5]]
    );
  } elseif ($phase['value'] == "cycl") {
    $result = $collection->updateOne(
      ['_id' => 'teamCyclC'],
      ['$set' => ['value.1' => $teamCyclC['value'][1] - 5]]
    );
  }
}

if (isset($_POST['add10A'])) {
  $teamBachA = iterator_to_array($teamBachA);
  $teamCyclA = iterator_to_array($teamCyclA);
  if ($phase['value'] == "bach") {
    $result = $collection->updateOne(
      ['_id' => 'teamBachA'],
      ['$set' => ['value.1' => $teamBachA['value'][1] + 10]]
    );
  } elseif ($phase['value'] == "cycl") {
    $result = $collection->updateOne(
      ['_id' => 'teamCyclA'],
      ['$set' => ['value.1' => $teamCyclA['value'][1] + 10]]
    );
  }
}

if (isset($_POST['sub10A'])) {
  $teamBachA = iterator_to_array($teamBachA);
  $teamCyclA = iterator_to_array($teamCyclA);
  if ($phase['value'] == "bach") {
    $result = $collection->updateOne(
      ['_id' => 'teamBachA'],
      ['$set' => ['value.1' => $teamBachA['value'][1] - 10]]
    );
  } elseif ($phase['value'] == "cycl") {
    $result = $collection->updateOne(
      ['_id' => 'teamCyclA'],
      ['$set' => ['value.1' => $teamCyclA['value'][1] - 10]]
    );
  }
}

if (isset($_POST['add10B'])) {
  $teamBachB = iterator_to_array($teamBachB);
  $teamCyclB = iterator_to_array($teamCyclB);
  if ($phase['value'] == "bach") {
    $result = $collection->updateOne(
      ['_id' => 'teamBachB'],
      ['$set' => ['value.1' => $teamBachB['value'][1] + 10]]
    );
  } elseif ($phase['value'] == "cycl") {
    $result = $collection->updateOne(
      ['_id' => 'teamCyclB'],
      ['$set' => ['value.1' => $teamCyclB['value'][1] + 10]]
    );
  }
}

if (isset($_POST['sub10B'])) {
  $teamBachB = iterator_to_array($teamBachB);
  $teamCyclB = iterator_to_array($teamCyclB);
  if ($phase['value'] == "bach") {
    $result = $collection->updateOne(
      ['_id' => 'teamBachB'],
      ['$set' => ['value.1' => $teamBachB['value'][1] - 10]]
    );
  } elseif ($phase['value'] == "cycl") {
    $result = $collection->updateOne(
      ['_id' => 'teamCyclB'],
      ['$set' => ['value.1' => $teamCyclB['value'][1] - 10]]
    );
  }
}

if (isset($_POST['add10C'])) {
  $teamBachC = iterator_to_array($teamBachC);
  $teamCyclC = iterator_to_array($teamCyclC);
  if ($phase['value'] == "bach") {
    $result = $collection->updateOne(
      ['_id' => 'teamBachC'],
      ['$set' => ['value.1' => $teamBachC['value'][1] + 10]]
    );
  } elseif ($phase['value'] == "cycl") {
    $result = $collection->updateOne(
      ['_id' => 'teamCyclC'],
      ['$set' => ['value.1' => $teamCyclC['value'][1] + 10]]
    );
  }
}

if (isset($_POST['sub10C'])) {
  $teamBachC = iterator_to_array($teamBachC);
  $teamCyclC = iterator_to_array($teamCyclC);
  if ($phase['value'] == "bach") {
    $result = $collection->updateOne(
      ['_id' => 'teamBachC'],
      ['$set' => ['value.1' => $teamBachC['value'][1] - 10]]
    );
  } elseif ($phase['value'] == "cycl") {
    $result = $collection->updateOne(
      ['_id' => 'teamCyclC'],
      ['$set' => ['value.1' => $teamCyclC['value'][1] - 10]]
    );
  }
}

if (isset($_POST['add20A'])) {
  $teamBachA = iterator_to_array($teamBachA);
  $teamCyclA = iterator_to_array($teamCyclA);
  if ($phase['value'] == "bach") {
    $result = $collection->updateOne(
      ['_id' => 'teamBachA'],
      ['$set' => ['value.1' => $teamBachA['value'][1] + 20]]
    );
  } elseif ($phase['value'] == "cycl") {
    $result = $collection->updateOne(
      ['_id' => 'teamCyclA'],
      ['$set' => ['value.1' => $teamCyclA['value'][1] + 20]]
    );
  }
}

if (isset($_POST['sub20A'])) {
  $teamBachA = iterator_to_array($teamBachA);
  $teamCyclA = iterator_to_array($teamCyclA);
  if ($phase['value'] == "bach") {
    $result = $collection->updateOne(
      ['_id' => 'teamBachA'],
      ['$set' => ['value.1' => $teamBachA['value'][1] - 20]]
    );
  } elseif ($phase['value'] == "cycl") {
    $result = $collection->updateOne(
      ['_id' => 'teamCyclA'],
      ['$set' => ['value.1' => $teamCyclA['value'][1] - 20]]
    );
  }
}

if (isset($_POST['add20B'])) {
  $teamBachB = iterator_to_array($teamBachB);
  $teamCyclB = iterator_to_array($teamCyclB);
  if ($phase['value'] == "bach") {
    $result = $collection->updateOne(
      ['_id' => 'teamBachB'],
      ['$set' => ['value.1' => $teamBachB['value'][1] + 20]]
    );
  } elseif ($phase['value'] == "cycl") {
    $result = $collection->updateOne(
      ['_id' => 'teamCyclB'],
      ['$set' => ['value.1' => $teamCyclB['value'][1] + 20]]
    );
  }
}

if (isset($_POST['sub20B'])) {
  $teamBachB = iterator_to_array($teamBachB);
  $teamCyclB = iterator_to_array($teamCyclB);
  if ($phase['value'] == "bach") {
    $result = $collection->updateOne(
      ['_id' => 'teamBachB'],
      ['$set' => ['value.1' => $teamBachB['value'][1] - 20]]
    );
  } elseif ($phase['value'] == "cycl") {
    $result = $collection->updateOne(
      ['_id' => 'teamCyclB'],
      ['$set' => ['value.1' => $teamCyclB['value'][1] - 20]]
    );
  }
}

if (isset($_POST['add20C'])) {
  $teamBachC = iterator_to_array($teamBachC);
  $teamCyclC = iterator_to_array($teamCyclC);
  if ($phase['value'] == "bach") {
    $result = $collection->updateOne(
      ['_id' => 'teamBachC'],
      ['$set' => ['value.1' => $teamBachC['value'][1] + 20]]
    );
  } elseif ($phase['value'] == "cycl") {
    $result = $collection->updateOne(
      ['_id' => 'teamCyclC'],
      ['$set' => ['value.1' => $teamCyclC['value'][1] + 20]]
    );
  }
}

if (isset($_POST['sub20C'])) {
  $teamBachC = iterator_to_array($teamBachC);
  $teamCyclC = iterator_to_array($teamCyclC);
  if ($phase['value'] == "bach") {
    $result = $collection->updateOne(
      ['_id' => 'teamBachC'],
      ['$set' => ['value.1' => $teamBachC['value'][1] - 20]]
    );
  } elseif ($phase['value'] == "cycl") {
    $result = $collection->updateOne(
      ['_id' => 'teamCyclC'],
      ['$set' => ['value.1' => $teamCyclC['value'][1] - 20]]
    );
  }
}

if (isset($_POST['sfx'])) {
  $sfx = $_POST['sfx'];
  $result = $collection->updateOne(
    ['_id' => 'sfx'],
    ['$set' => ['value' => $sfx]]
  );
}

if (isset($_POST['submit1'])) {
  $aliasBachA = $_POST['aliasBachA'];
  $aliasBachB = $_POST['aliasBachB'];
  $aliasBachC = $_POST['aliasBachC'];
  $result = $collection->updateOne(
    ['_id' => 'teamBachA'],
    ['$set' => ['value.0' => $aliasBachA]]
  );
  $result = $collection->updateOne(
    ['_id' => 'teamBachB'],
    ['$set' => ['value.0' => $aliasBachB]]
  );
  $result = $collection->updateOne(
    ['_id' => 'teamBachC'],
    ['$set' => ['value.0' => $aliasBachC]]
  );
}

if (isset($_POST['submit2'])) {
  $aliasCyclA = $_POST['aliasCyclA'];
  $aliasCyclB = $_POST['aliasCyclB'];
  $aliasCyclC = $_POST['aliasCyclC'];
  $result = $collection->updateOne(
    ['_id' => 'teamCyclA'],
    ['$set' => ['value.0' => $aliasCyclA]]
  );
  $result = $collection->updateOne(
    ['_id' => 'teamCyclB'],
    ['$set' => ['value.0' => $aliasCyclB]]
  );
  $result = $collection->updateOne(
    ['_id' => 'teamCyclC'],
    ['$set' => ['value.0' => $aliasCyclC]]
  );
}

if (isset($_POST['submit3'])) {
  $spect1 = $_POST['spect1'];
  $spect2 = $_POST['spect2'];
  $spect3 = $_POST['spect3'];
  $result = $collection->updateOne(
    ['_id' => 'spectators'],
    ['$set' => ['value' => [$spect1, $spect2, $spect3]]]
  );
}

$jsono = array($phase, $mode,  $lead,  $category,  $mandatoryBach,  $generalBach,  $mandatoryCycl,  $generalCycl, $play,  $time,  $option,  $solution,  $lock,  $turn,  $teamBachA,  $teamBachB,  $teamBachC,  $teamCyclA,  $teamCyclB,  $teamCyclC,  $sfx,  $spectators);
echo json_encode($jsono);
