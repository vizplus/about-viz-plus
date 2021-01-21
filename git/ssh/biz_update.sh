#!/bin/bash
cd /var/www/vizplus/about.viz.plus/git/viz-biz/
var=`git pull`
check="Already up-to-date."
echo "$var"
if [ "$var" == "$check" ]; then
        echo "nothing new";
else
        rm /var/www/vizplus/about.viz.plus/biz.cache
fi