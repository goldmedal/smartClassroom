import bluetooth
import cgi , cgitb
import MySQLdb

form = cgi.FieldStorage()
classId = form.getvalue('classId')
deviceID = form.getvalue('blueId')

db = MySQLdb.connect(host="localhost", user="root", passwd="1234", db="smart_classroom")
cursor = db.cursor()

cursor.execute("SELECT * FROM ")