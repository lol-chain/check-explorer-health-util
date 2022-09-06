#!/bin/bash
while true; do
        begin=`date +%s`
        php shell.php
        end=`date +%s`
        if [ $(($end - $begin)) -lt 90 ]; then
	    sleep $(($begin + 90 - $end))
	fi
done
