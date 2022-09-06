#!/bin/bash
#[[ $(sh ./stop.sh) == "ok" ]] && echo "match"
command="sh ./run_stop.sh"
log="stop.log"
match="ok"

$command > "$log" 2>&1 &
pid=$!

while sleep 3
do
    if fgrep --quiet "$match" "$log"
    then
        kill $pid
        rm -rf stop.log
        exit 0
    fi
done
