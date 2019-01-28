var streaming_even = document.getElementById("streaming_even");
var streaming_odd = document.getElementById("streaming_odd");
var state = 0;

$(document).ready(function () {
  runPoll();
});

function runPoll() {
  setTimeout(function () {
    $.ajax({
      url: 'http://olistreaming.ddns.net:8888/server/server.php',
      success: function (response) {
        checkPlay(response[0]);
        if(state != response[1].value) {
          changeState(response);
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
  if(streaming_even.style.display != "none") {
    if(response.value == "true") {
      if(streaming_even.paused) {
        streaming_even.play();
      }
    } else if(response.value == "false"){
      if(!streaming_even.paused) {
        streaming_even.pause();
      }
    }
  } else if(streaming_odd.style.display != "none") {
    if(response.value == "true") {
      if(streaming_odd.paused) {
        streaming_odd.play();
      }
    } else if(response.value == "false"){
      if(!streaming_odd.paused) {
        streaming_odd.pause();
      }
    }
  }
}

function changeState(response) {
  video = response[1].value;
  opcion = response[2].value;
  if(opcion % 2 == 0 && video % 2 != 0) {
    streaming_even.src = "/media/video" + response[1].value + "/opcion" + response[2].value + ".mp4";
    setTimeout(function() {
      streaming_odd.style.display = "none";
      streaming_even.style.display = "block";
    }, 500);
  } else {
    streaming_odd.src = "/media/video" + response[1].value + "/opcion" + response[2].value + ".mp4";
    setTimeout(function() {
      streaming_even.style.display = "none";
      streaming_odd.style.display = "block";
    }, 500);
  }
}
