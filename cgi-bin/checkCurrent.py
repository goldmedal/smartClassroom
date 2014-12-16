#!/usr/bin/python
#
# Send switch num and get the state

print "Content-Type: text/html"
print

import bluetooth
import cgi , cgitb
import MySQLdb

form = cgi.FieldStorage()
classID = "CIAlab"
deviceID = str(form.getvalue('id'))

db = MySQLdb.connect(host="localhost", user="root", passwd="1234", db="smart_classroom")
cursor = db.cursor()

sql = "SELECT * FROM `" + classID + "Equip` WHERE `id` = '" + deviceID + "'"
cursor.execute(sql)

result = cursor.fetchall()

for record in result :
	bd_addr = record[4]
	state = record[5]
	switchNum = record[2]

port = 1

sock = bluetooth.BluetoothSocket ( bluetooth.RFCOMM )
sock.connect ((bd_addr, port))
if switchNum == 1 :
	sock.send('a')
elif switchNum == 2 :
	sock.send('s')
elif switchNum == 3:
	sock.send('d')

data = sock.recv(100)
data = sock.recv(100)

sock.close()

if float(data) > 28.0:
	state = 0
else :
	state = 1
# write back to data base
sql = "UPDATE `" + classID + "Equip` SET `status` = '"+ str(state) +"' WHERE `id` = '" + deviceID + "'"
cursor.execute(sql)
db.commit()
print "%s" % state
