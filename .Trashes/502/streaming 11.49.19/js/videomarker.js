var score = document.getElementById("score");
var videomarker = 0;

$(document).ready(function () {
  runPoll();
});

function runPoll() {
  setTimeout(function () {
    $.ajax({
      url: 'http://olistreaming.ddns.net:8888/server/server.php',
      success: function (response) {
        score.innerHTML = "PUNTUACIÓN: " + response[2].value;
      },
      dataType: "json",
      complete: function () {
        runPoll();
      }
    })
  }, 100);
};
