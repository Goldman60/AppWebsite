#!/bin/bash
#TODO: eventually all but the deployment location for dev should be the same
composer install

#Send files to dev directory
rsync -a --delete --exclude /var/cache/ --exclude /var/logs/ --exclude /var/sessions/ $WORKSPACE/ /www/aprogrammingpodcast.com/bleeding/ --no-perms --no-owner --no-group

#Copy in special config from Jenkins
cp $YML_PARAMS /www/aprogrammingpodcast.com/bleeding/app/config/parameters.yml

#Set group perms on everything but the caching directory
SetGroupWWWData /www/aprogrammingpodcast.com/bleeding/

#run the setups
SetupCachingDirectory /www/aprogrammingpodcast.com/bleeding/var
SetupCachingDirectory /www/aprogrammingpodcast.com/bleeding/var/cache
SetupCachingDirectory /www/aprogrammingpodcast.com/bleeding/var/logs
SetupCachingDirectory /www/aprogrammingpodcast.com/bleeding/var/sessions

cd /www/aprogrammingpodcast.com/bleeding/

#Clear out the database to populate it with crap for dev
/usr/bin/php7.1 bin/console cache:clear
/usr/bin/php7.1 bin/console doctrine:database:drop --force
/usr/bin/php7.1 bin/console doctrine:database:create
/usr/bin/php7.1 bin/console doctrine:schema:update --force
/usr/bin/php7.1 bin/console PopulateDatabaseDev