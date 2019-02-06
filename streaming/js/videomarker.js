var score = document.getElementById("score");
var videomarker = 0;
var team;
$(document).ready(function () {
  runPoll();
  team = getParameterByName("team");
  document.getElementById("team").innerHTML = team;
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

function getParameterByName(name) {
  name = name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
  var regexS = "[\\?&]"+name+"=([^&#]*)";
  var regex = new RegExp( regexS );
  var results = regex.exec( window.location.href );
  if(results == null) {
    return "";
  } else {
    if ((results[1].indexOf('?')) > 0) {
      return decodeURIComponent(results[1].substring(0,results[1].indexOf('?')).replace(/\+/g, " "));
    } else {
      return decodeURIComponent(results[1].replace(/\+/g, " "));
    }
  }
}
