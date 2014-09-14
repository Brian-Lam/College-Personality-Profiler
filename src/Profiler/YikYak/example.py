import pyak
import sys
#This registers a new user. 
#In practice, you will want to save and re-use a single user ID.
#The constructor can be called with an optional astring argument for user ID.
def main(argv) :
	yakker = pyak.Yakker()

	ut = pyak.Location(argv[1], argv[2])

	yakker.update_location(ut)

	yaks = yakker.get_yaks()
	counter = 0
	for yak in yaks:
		counter = counter + 1
		yak.print_yak()
		print "<br>"
		if (counter > 15):
			break;
if __name__ == "__main__":
    main(sys.argv)