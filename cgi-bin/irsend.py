#!/usr/bin/python

print "Content-Type: text/html"
print

import bluetooth
import cgi , cgitb
import MySQLdb

form = cgi.FieldStorage()
sign = str(form.getvalue('sign'))
deviceID = str(form.getvalue('id'))

db = MySQLdb.connect(host="localhost", user="root", passwd="1234", db="smart_classroom")
cursor = db.cursor()

sql = "SELECT * FROM `" + classID + "Equip` WHERE `id` = '" + deviceID + "'"
cursor.execute(sql)

result = cursor.fetchall()

for record in result :
	bd_addr = record[4]

port = 1

sock = bluetooth.BluetoothSocket ( bluetooth.RFCOMM )
sock.connect ((bd_addr, port))
sock.send(sign)

sock.close()