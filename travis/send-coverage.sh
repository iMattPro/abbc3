#!/bin/bash
#
# This file is part of the Advanced BBCode Box 3.1 package.
#
# @copyright (c) 2015 Matt Friedman
# @license GNU General Public License, version 2 (GPL-2.0)
#
set -e
set -x

DB=$1
TRAVIS_PHP_VERSION=$2

if [ "$TRAVIS_PHP_VERSION" == "5.3.3" -a "$DB" == "mysqli" ]
then
    cd ../VSEphpbb/abbc3
    - wget https://scrutinizer-ci.com/ocular.phar
    - php ocular.phar code-coverage:upload --format=php-clover ../../phpBB3/coverage.clover
fi
