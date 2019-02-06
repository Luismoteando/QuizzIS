#!/bin/bash
file="/media/pi/DATA/config.txt"

while [ ! -f "$file" ]; do
  sleep 2
done

while IFS=" " read -r role team; do
done < "$file"

if [ $role == "streaming" ] ; then
  /usr/bin/chromium-browser --kiosk --disable-restore-session-state --app="http://localhost/streaming/streaming.html"
elif [ $role == "videomarker" ] ; then
  /usr/bin/chromium-browser --kiosk --disable-restore-session-state --app="http://localhost/streaming/videomarker.html?team=$team"
fi
