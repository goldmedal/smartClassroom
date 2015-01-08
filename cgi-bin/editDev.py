#!/usr/bin/python

print "Content-Type: application/json"
print

import json
import cgi , cgitb
import MySQLdb

form = cgi.FieldStorage()
#classID = str(form.getvalue('classID'))
classID = "CIAlab"
devId = str(form.getvalue('devId'))
name = form.getvalue('name')
e_type = str(form.getvalue('type'))
group = str(form.getvalue('group'))
g_num = str(form.getvalue('g_num'))
show = str(form.getvalue('open'))

db = MySQLdb.connect(host="localhost", user="root", passwd="1234", db="smart_classroom")
cursor = db.cursor()

try:
# write back to data base
	sql = "UPDATE `CIAlabEquip` SET `name` = '"+name+"', `type` = '"+e_type+"', `group` = '"+group+"', `g_num` = '"+g_num+"', `open` = '"+show+"' WHERE `id` = '"+devId+"'"
	cursor.execute(sql)
	db.commit()

	print json.dumps({"result":"1"})
except:
	print json.dumps({"result":"0"})
