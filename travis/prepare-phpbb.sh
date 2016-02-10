#!/bin/bash
#
# This file is part of the phpBB Forum Software package.
#
# @copyright (c) phpBB Limited <https://www.phpbb.com>
# @license GNU General Public License, version 2 (GPL-2.0)
#
# For full copyright and license information, please see
# the docs/CREDITS.txt file.
#
set -e
set -x

EXTNAME=$1
BRANCH=$2
EPV=$3
TRAVIS_PHP_VERSION=$4

# Copy extension to a temp folder
mkdir ../../tmp
cp -R . ../../tmp
cd ../../

# Clone phpBB
git clone --depth=1 "git://github.com/phpbb/phpbb.git" "phpBB3" --branch=$BRANCH

# Clone EPV tool
if [ "$TRAVIS_PHP_VERSION" == "5.3.3" -a "$EPV" == "1" ]
then
	git clone --depth=1 "git://github.com/phpbb/epv.git" "phpBB3/phpBB/ext/phpbb/epv"
fi
