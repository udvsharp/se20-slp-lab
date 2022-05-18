#!/bin/bash

exec 3<> $1 # open descriptor
echo $2 >&3
exec 3>&- # close descriptor
cat $1