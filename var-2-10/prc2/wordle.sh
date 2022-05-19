#!/bin/bash
url="https://raw.githubusercontent.com/dolph/dictionary/master/popular.txt"
words=($(curl -s $url | grep '^\w\w\w\w\w$' | tr '[a-z]' '[A-Z]')) 
actual=${words[$[$RANDOM % ${#words[@]}]]}
guess_count=1
max_guess=6
left=ABCDEFGHIJKLMNOPQRSTUVWXYZ
if [[ $1 == "unlimit" ]]; then
    max_guess=999999
fi
while [[ $guess_count -le $max_guess ]]; do
    echo "Enter your guess ($guess_count / $max_guess):"
    read guess
    guess=$(echo $guess | tr '[a-z]' '[A-Z]')
    if [[ " ${words[*]} " =~ " $guess " ]]; then
        guess_count=$(( $guess_count + 1 ))
        remaining=""
        for ((i = 0; i < ${#actual}; i++)); do
            if [[ "${actual:$i:1}" != "${guess:$i:1}" ]]; then
                remaining+=${actual:$i:1}
            fi
        done
        for ((i = 0; i < ${#actual}; i++)); do
            if [[ "${actual:$i:1}" != "${guess:$i:1}" ]]; then
                if [[ "$remaining" == *"${guess:$i:1}"* ]]; then
                        color="33"
                        remaining=${remaining/"${guess:$i:1}"/}
                else
                        color="70"
                fi
            else
                    color="22"
            fi
            printf "\033[30;10${color:0:1}m ${guess:$i:1} \033[0m"
            left=${left/${guess:$i:1}/\\033[30;10${color:1:1}m${guess:$i:1}\\033[0m}
        done
        printf "     [${left}]\n"
        if [[ $actual == $guess ]]; then
            exit
        fi
    else
        echo "Please enter a valid word with 5 letters!";
    fi
done
echo "You lose! The word was  $actual"