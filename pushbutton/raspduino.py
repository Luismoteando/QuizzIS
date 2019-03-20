import serial
import requests
import time

arduino = serial.Serial('/dev/ttyACM0', 9600)

while 1:
    print(arduino.read())

arduino.close()
