#!/usr/bin/python

print "Content-Type: application/json"
print

import json
import cgi , cgitb
import MySQLdb

form = cgi.FieldStorage()
#classID = str(form.getvalue('classID'))
classID = "CIAlab"
devId = form.getvalue('devId')

db = MySQLdb.connect(host="localhost", user="root", passwd="1234", db="smart_classroom")
cursor = db.cursor()

try:
# write back to data base
	sql = "DELETE FROM CIAlabEquip WHERE id = '"+ devId +"'"
	cursor.execute(sql)
	db.commit()

	print json.dumps({"result":"1"})
except:
	print json.dumps({"result":"0"})
