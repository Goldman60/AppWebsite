#!/bin/sh
#Build script for jenkins
rsync -a --delete --exclude /var/cache/ --exclude /var/logs/ --exclude /var/sessions/ $WORKSPACE/ /www/aprogrammingpodcast.com/bleeding/ --no-perms --no-owner --no-group
cp $YML_PARAMS /www/aprogrammingpodcast.com/bleeding/app/config/
find /www/aprogrammingpodcast.com/bleeding/ -name var -prune -o -print0 | xargs -0 chgrp www-data
chmod 777 /www/aprogrammingpodcast.com/bleeding/var
chmod 777 /www/aprogrammingpodcast.com/bleeding/var/cache
chmod 777 /www/aprogrammingpodcast.com/bleeding/var/logs
chmod 777 /www/aprogrammingpodcast.com/bleeding/var/sessions