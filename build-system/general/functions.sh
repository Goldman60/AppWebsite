#!/bin/bash

#Sets up the directories in var that symfony writes to
SetupCachingDirectory() {
    if [ ! -d "$1" ]; then
        mkdir "$1"
        chgrp www-data "$1"
    fi

    chmod 777 "$1"

    return 0
}

#Sets the group to www-data excluding var
SetGroupWWWData() {
    find "$1" -name var -prune -o -print0 | xargs -0 chgrp www-data
}
