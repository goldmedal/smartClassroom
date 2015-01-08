#!/usr/bin/python

print "Content-Type: text/html"
print

import bluetooth
import cgi , cgitb
import MySQLdb

form = cgi.FieldStorage()
classID = "CIAlab"
deviceID = str(form.getvalue('devId'))
#deviceID = "54"
db = MySQLdb.connect(host="localhost", user="root", passwd="1234", db="smart_classroom")
cursor = db.cursor()

sql = "SELECT dev.group, bt.id, bt.MacAddress FROM " + classID + "Equip dev, btDevice bt WHERE dev.id = '" + deviceID + "'"
cursor.execute(sql)

result = cursor.fetchall()

for record in result :
	if record[0] == record[1] :
		bd_addr = record[2]
port = 1

sock = bluetooth.BluetoothSocket ( bluetooth.RFCOMM )
sock.connect ((bd_addr, port))
sock.send("111111")
sock.close

