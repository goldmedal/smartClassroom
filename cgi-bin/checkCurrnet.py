#!/usr/bin/python
#
# Send switch num and get the state

import bluetooth
import cgi , cgitb
import MySQLdb

classID = "CIAlab"
sensorID = form.getvalue('id')

db = MySQLdb.connect(host="localhost", user="root", passwd="1234", db="smart_classroom")
cursor = db.cursor()

sql = "SELECT * FROM `" + classID + "Equip` WHERE `id` = '" + deviceID + "'"
cursor.execute(sql)

result = cursor.fetchall()

for record in result :
	bd_addr = record[2]
	state = record[3]
	switchNum = record[4]

port = 1

sock = bluetooth.BluetoothSocket ( bluetooth.RFCOMM )
sock.connect ((bd_addr, port))

if switchNum == 1 :
	sock.send('a')
elif switchNum == 2 :
	sock.send('s')
elif switchNum == 3:
	sock.send('d')

time.sleep(1)
data = sock.recv(100)
data = sock.recv(100)

sock.close()

if data > 20 :
	state = 1
else :
	state = 0

# write back to data base

sql = "UPDATE `" + classID + "Equip` SET `status` = '"+ state +"' WHERE `id` = '" + deviceID + "'"
cursor.execute(sql)

print "%s" % state