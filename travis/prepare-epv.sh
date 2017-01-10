#!/bin/bash
#
# Advanced BBCode Box
#
# @copyright (c) 2016 Matt Friedman
# @license GNU General Public License, version 2 (GPL-2.0)
#
set -e
set -x

NOTESTS=$1

if [ "$NOTESTS" == "1" ]
then
	cd phpBB
	composer require phpbb/epv:dev-master --dev --no-interaction
	cd ../
fi
