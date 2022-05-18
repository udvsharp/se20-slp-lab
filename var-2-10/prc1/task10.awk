#!/bin/awk -f

BEGIN {
    matches = match(ARGV[1], "^@?(\\w){1,15}$");
    print ARGV[1], "is", matches ? "valid" : "invalid";
}