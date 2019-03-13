import serial

arduino = serial.Serial('/dev/ttyACM0', 9600)

while 1:
    x = arduino.readline()
    print x

arduino.close()
