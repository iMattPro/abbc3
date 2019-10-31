#!/bin/bash
#
# Advanced BBCode Box
#
# @copyright (c) 2016 Matt Friedman
# @license GNU General Public License, version 2 (GPL-2.0)
#
set -e
set -x

DB=$1
TRAVIS_PHP_VERSION=$2
EXTNAME=$3

if [ "$TRAVIS_PHP_VERSION" == "7.2" ] && [ "$DB" == "mysqli" ]
then
	phpBB/vendor/bin/phpunit --configuration phpBB/ext/"$EXTNAME"/travis/phpunit-"$DB"-travis.xml --bootstrap ./tests/bootstrap.php --coverage-clover build/logs/clover.xml
else
	phpBB/vendor/bin/phpunit --configuration phpBB/ext/"$EXTNAME"/travis/phpunit-"$DB"-travis.xml --bootstrap ./tests/bootstrap.php
fi
