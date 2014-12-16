#!/usr/bin/python

print "Content-Type: text/html"
print

import bluetooth
import cgi , cgitb


port = 1
bd_addr = "98:D3:31:B4:09:A9"

sock = bluetooth.BluetoothSocket ( bluetooth.RFCOMM )
sock.connect ((bd_addr, port))
sock.send('111')
sock.close

