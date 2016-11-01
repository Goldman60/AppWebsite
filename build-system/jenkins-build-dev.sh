#!/bin/bash
#Build script for jenkins

#Send files to dev directory
rsync -a --delete --exclude /var/cache/ --exclude /var/logs/ --exclude /var/sessions/ $WORKSPACE/ /www/aprogrammingpodcast.com/bleeding/ --no-perms --no-owner --no-group

#Copy in special config from Jenkins
cp $YML_PARAMS /www/aprogrammingpodcast.com/bleeding/app/config/

#Set group perms on everything but the caching directory
find /www/aprogrammingpodcast.com/bleeding/ -name var -prune -o -print0 | xargs -0 chgrp www-data

#Sets up the directories in var that symfony writes to
SetupCachingDirectory() {
    if [ ! -d "$1" ]; then
        mkdir "$1"
        chgrp www-data "$1"
    fi

    chmod 777 "$1"

    return 0
}

#run the setups
SetupCachingDirectory /www/aprogrammingpodcast.com/bleeding/var
SetupCachingDirectory /www/aprogrammingpodcast.com/bleeding/var/cache
SetupCachingDirectory /www/aprogrammingpodcast.com/bleeding/var/logs
SetupCachingDirectory /www/aprogrammingpodcast.com/bleeding/var/sessions