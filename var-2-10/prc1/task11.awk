#!/bin/awk -f

BEGIN {
    matches = match(ARGV[1], "^[0-9]{5}$");
    if (matches) {
        if(match($0, /^9[1-4][\d]{3}$/))
        {
            print "Luganskaya oblast"
        }
        else if(match($0, /^9[5-8][\d]{3}$/))
        {
            print "Republic of Crimea"
        }
        else if(match($0, /^99[\d]{3}$/))
        {
            print "Sevostopol"
        }
    } else {
        print "Invalid postal code!"
    }
}