#!/usr/bin/env bash

if [ -z $1 ];
then 
	echo "Container name is not specified";

	exit
fi

docker-compose -p wikiparser exec ${1} bash
