#!/usr/bin/python

print "Content-Type: text/html"
print

import bluetooth
import cgi , cgitb
import MySQLdb

form = cgi.FieldStorage()
#classID = str(form.getvalue('classID'))
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
if state == 1:
	state = 0
else :
	state = 1

# meg format :  num state
# 				01  1

if state == 0 :  
	meg = switchNum 
else :
	meg = switchNum | 4
sock.send(str(meg))
sock.close

# write back to data base
sql = "UPDATE `" + classID + "Equip` SET `status` = '" + str(state) + "' WHERE `id` = '" + deviceID + "'"
cursor.execute(sql)
db.commit()
print "%s" % state
