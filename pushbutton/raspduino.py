import serial
import requests
import time

arduino = serial.Serial('/dev/ttyACM0', 9600)

while 1:
    if(arduino.in_waiting > 0):
        x = arduino.readline().strip()
        data = {'turn': x}
        requests.post(url = "http://olistreaming.ddns.net:8888/server/bachServer.php", data = data)

        time.sleep(10)
        arduino.reset_input_buffer()

arduino.close()
