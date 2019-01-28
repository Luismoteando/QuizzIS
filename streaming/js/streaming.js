var player1 = document.getElementById("player1");
var player2 = document.getElementById("player2");
var video = 1;
var opcion = 0;

$(document).ready(function () {
  runPoll();
});

function runPoll() {
  setTimeout(function () {
    $.ajax({
      url: 'http://olistreaming.ddns.net:8888/server/server.php',
      success: function (response) {
        checkPlay(response[0]);
        if(video != response[1].value || opcion != response[3].value) {
          changeVideo(response);
        }
      },
      dataType: "json",
      complete: function () {
        runPoll();
      }
    })
  }, 100);
};

function checkPlay(response) {
  if(player1.style.display != "none") {
    if(response.value == "true") {
      if(player1.paused) {
        player1.play();
      }
    } else if(response.value == "false"){
      if(!player1.paused) {
        player1.pause();
      }
    }
  } else if(player2.style.display != "none") {
    if(response.value == "true") {
      if(player2.paused) {
        player2.play();
      }
    } else if(response.value == "false"){
      if(!player2.paused) {
        player2.pause();
      }
    }
  }
}

function changeVideo(response) {
  video = response[1].value;
  opcion = response[3].value;
  if(video % 2 == 0) {
    if(opcion % 2 == 0) {
      player1.src = "media/video" + response[1].value + "/opcion" + response[3].value + ".mp4";
      setTimeout(function() {
        player2.style.display = "none";
        player1.style.display = "block";
      }, 500);
    } else {
      player2.src = "media/video" + response[1].value + "/opcion" + response[3].value + ".mp4";
      setTimeout(function() {
        player1.style.display = "none";
        player2.style.display = "block";
      }, 500);
    }
  } else {
    if(opcion % 2 == 0) {
      player2.src = "media/video" + response[1].value + "/opcion" + response[3].value + ".mp4";
      setTimeout(function() {
        player1.style.display = "none";
        player2.style.display = "block";
      }, 500);
    } else {
      player1.src = "media/video" + response[1].value + "/opcion" + response[3].value + ".mp4";
      setTimeout(function() {
        player2.style.display = "none";
        player1.style.display = "block";
      }, 500);
    }
  }
}
