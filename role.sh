#!/bin/bash
file="/media/pi/DATA/config.txt"

while [[ ! -f "$file" ]]; do
  sleep 2
done

while IFS=" " read -r role team; do
  if [[ $role == "videoplayer" ]]; then
    /usr/bin/chromium-browser --kiosk --disable-restore-session-state --app="http://localhost/client/videoplayer.html"
  elif [[ $role == "videomarker" ]]; then
    if [[ $team == "teamA" || $team == "teamB" || $team == "teamC" ]]; then
      /usr/bin/chromium-browser --kiosk --disable-restore-session-state --app="http://localhost/client/videomarker.html?team=$team"
    fi
  fi
done < "$file"
