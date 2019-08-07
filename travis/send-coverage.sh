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
GITREPO=$3

if [ "$TRAVIS_PHP_VERSION" == "7.2" ] && [ "$DB" == "mysqli" ]
then
    cd ../"$GITREPO"
    wget https://scrutinizer-ci.com/ocular.phar
    php ocular.phar code-coverage:upload --format=php-clover ../../phpBB3/build/logs/clover.xml
fi
