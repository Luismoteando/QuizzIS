#!/bin/bash
file="/media/pi/DATA/config.txt"

while [[ ! -f "$file" ]]; do
  sleep 2
done

while IFS=" " read -r role category team alias; do
  if [[ $role == "streaming" ]]; then
    if [[ $category ==  "bach" ]]; then
      /usr/bin/chromium-browser --kiosk --disable-restore-session-state --app="http://localhost/streaming/bachStreaming.html"
    elif [[ $category == "cycl"]]; then
      /usr/bin/chromium-browser --kiosk --disable-restore-session-state --app="http://localhost/streaming/cyclStreaming.html"
    fi
  elif [[ $role == "videomarker" ]]; then
    if [[ $category == "bach" ]]; then
      if [[ $team == "teamA" ] ||  [ $team == "teamB" ] || [ $team == "teamC" ]]; then
        if [[ $alias !=  "" ]]; then
          /usr/bin/chromium-browser --kiosk --disable-restore-session-state --app="http://localhost/streaming/bachVideomarker.html?team=$team&alias=$alias"
        fi
      fi
    elif [[ $category == "cycl" ]]; then
      if [[ $team == "teamA" ] ||  [ $team == "teamB" ] || [ $team == "teamC" ]]; then
        if [[ $alias !=  "" ]]; then
          /usr/bin/chromium-browser --kiosk --disable-restore-session-state --app="http://localhost/streaming/videomarker.html?alias=$alias"
        fi
      fi
    fi
  fi
done < "$file"
