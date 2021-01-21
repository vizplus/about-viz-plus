#!/bin/bash
cd /var/www/vizplus/about.viz.plus/git/viz-invest/
var=`git pull`
check="Already up-to-date."
echo "$var"
if [ "$var" == "$check" ]; then
        echo "nothing new";
else
        rm /var/www/vizplus/about.viz.plus/invest.cache
fi