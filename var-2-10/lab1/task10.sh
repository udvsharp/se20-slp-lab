#!/bin/bash

exec 3<> ./test.txt # open descriptor
echo "Hello, World!" >&3
exec 3>&- # close descriptor
cat ./test.txt
