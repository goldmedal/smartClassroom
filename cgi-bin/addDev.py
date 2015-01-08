#!/usr/bin/python

print "Content-Type: application/json"
print

import json
import cgi , cgitb
import MySQLdb

form = cgi.FieldStorage()
#classID = str(form.getvalue('classID'))
classID = "CIAlab"
name = form.getvalue('name')
e_type = str(form.getvalue('type'))
group = str(form.getvalue('group'))
g_num = str(form.getvalue('g_num'))
show = str(form.getvalue('open'))

db = MySQLdb.connect(host="localhost", user="root", passwd="1234", db="smart_classroom")
cursor = db.cursor()

try:
# write back to data base
	sql = "INSERT INTO `CIAlabEquip`(`name`, `type`, `group`, `g_num`, `open`) VALUES('"+name+"', '"+e_type+"', '"+group+"', '"+g_num+"', '"+show+"')"
	cursor.execute(sql)
	last_id = cursor.lastrowid
	db.commit()

	print json.dumps({"result":"1", "last_id": last_id})
except:
	print json.dumps({"result":"0"})
