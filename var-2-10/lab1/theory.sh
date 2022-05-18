#!/bin/bash

echo "First 3 args: " $1 $2 $3

index=0
number=$(($#-1))

args=( "$@" )

echo "Loop demo:"
while [ $index -le $number ]
do
    end=$(( $number - $index ))
    echo "args["$index"] = "${args[$index]}
    index=$(( $index + 1 ))
done

dosomenonsense() {
    echo "Files by pattern *.txt:"
    ls -d -- *.txt | cat && echo "Redirecting output to file..." >> test2.txt 
}

dosomenonsense