import serial
import time

arduino = serial.Serial('/dev/ttyACM0', 9600)

while 1:
    if(arduino.in_waiting > 0):
        x = arduino.readline()
        print x
        arduino.reset_input_buffer
        time.sleep(10)

arduino.close()
