#!/usr/bin/python

print "Content-Type: text/html\n\n"
import bluetooth
import cgi
bd_addr = "98:D3:31:B4:09:A9"

port = 1

sock = bluetooth.BluetoothSocket (bluetooth.RFCOMM )
sock.connect((bd_addr, port))
sock.send('1')

sock.close()
