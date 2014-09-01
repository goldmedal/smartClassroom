import bluetooth
import cgi , cgitb
import MySQLdb

form = cgi.FieldStorage()
classID = form.getvalue('classID')
deviceID = form.getvalue('blueID')


db = MySQLdb.connect(host="localhost", user="root", passwd="1234", db="smart_classroom")
cursor = db.cursor()

sql = "SELECT * FROM `" + classID + "Equip` WHERE `name` = '" + deviceID + "'"
cursor.execute(sql)

result = cursor.fetchall()

for record in result :
	bd_addr = record[2]
	state = record[3]
	switchNum = record[4]

port = 1

sock = bluetooth.BluetoothSocket ( bluetooth.RFCOMM )
sock.connect ((bd_addr, port))

state = ~state

if state == 0 :
	meg = switchNum
else :
	meg = switchNum | 4

sock.send(meg)

sock.close