var score = document.getElementById("score");
var videomarker = 0;

$(document).ready(function () {
  readTextFile("/media/pi/DATA/config.txt");
  runPoll();
});

function runPoll() {
  setTimeout(function () {
    $.ajax({
      url: 'http://olistreaming.ddns.net:8888/server/server.php',
      success: function (response) {
        score.innerHTML = response[2].value;
      },
      dataType: "json",
      complete: function () {
        runPoll();
      }
    })
  }, 100);
};

function readTextFile(file) {
  var rawFile = new XMLHttpRequest();
  rawFile.open("GET", file, false);
  rawFile.onreadystatechange = function ()
  {
    if(rawFile.readyState === 4)
    {
      if(rawFile.status === 200 || rawFile.status == 0)
      {
        var allText = rawFile.responseText;
        alert(allText);
      }
    }
  }
  rawFile.send(null);
}
