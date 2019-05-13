from serial import *
from threading import Thread
import requests

last_received = ''

def receiving(ser):
    global last_received

    buffer_string = ''
    while True:
        buffer_string = buffer_string + ser.read(ser.inWaiting())
        if '\n' in buffer_string:
            lines = buffer_string.split('\n')
            last_received = lines[-2]
            buffer_string = lines[-1]
        requests.post(url = "http://169.254.215.26:8888/server/bachServer.php", data = {'turn' : buffer_string})
        # if len(buffer_string) > 2:
        #     buffer_string = ''

if __name__ ==  '__main__':
    ser = Serial(
        port='/dev/ttyACM0',
        baudrate=9600,
        bytesize=EIGHTBITS,
        parity=PARITY_NONE,
        stopbits=STOPBITS_ONE,
        timeout=0.1,
        xonxoff=0,
        rtscts=0,
        interCharTimeout=None
    )

    Thread(target=receiving, args=(ser,)).start()
