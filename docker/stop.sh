#!/usr/bin/env bash

echo -e "\033[1;33mGracefully stopping docker containers\033[m";

docker-compose -p wikiparser stop

if hash docker-machine 2>/dev/null
then
    echo -e "\033[1;33mDocker machine detected. Shutdown...\033[m";

    docker-machine stop
fi

echo -e "\033[1;31mSystem down\033[m"

exit
