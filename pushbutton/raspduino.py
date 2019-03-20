import serial
import requests
import time

def serial_data(port, baudrate)
    ser = serial.Serial(port, baudrate)

    while True:
        yield ser.readline()

    ser.close()

for line in serial_data('/dev/ttyACM0', 9600):
    data += line.strip()

print(data)
requests.post(url = 'http://olistreaming:8888/server/bachServer.php', data = {'turn': data})
