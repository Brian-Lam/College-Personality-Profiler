import pyak

#This registers a new user. 
#In practice, you will want to save and re-use a single user ID.
#The constructor can be called with an optional astring argument for user ID.
yakker = pyak.Yakker()

ut = pyak.Location("35.943356", "-83.938699")

yakker.update_location(ut)

yaks = yakker.get_yaks()
print("hi")
for yak in yaks:
	yak.print_yak()
	print "<br>"
