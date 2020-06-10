# Advanced BBCode Box

Replace phpBB3's BBCode buttons with icons in an attractive and customizable toolbar. This extension also adds many new and useful custom BBCodes giving users more ways to customize their posts, including BBvideo (embed videos from dozens of media sites). Custom BBCodes can be arranged and sorted in any order and assigned to specific usergroups (such as Moderators and Admins only).

[![Build Status](https://img.shields.io/travis/iMattPro/abbc3/master.svg?style=flat)](https://travis-ci.org/iMattPro/abbc3)
[![Scrutinizer Code Quality](https://img.shields.io/scrutinizer/g/iMattPro/abbc3/master.svg?style=flat)](https://scrutinizer-ci.com/g/iMattPro/abbc3/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/iMattPro/abbc3/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/iMattPro/abbc3/?branch=master)
[![Dev dependencies](https://img.shields.io/david/dev/iMattPro/abbc3.svg)](https://david-dm.org/iMattPro/abbc3?type=dev)
[![Latest Stable Version](https://poser.pugx.org/vse/abbc3/v/stable)](https://www.phpbb.com/customise/db/extension/advanced_bbcode_box/)

## Features:
* Customizable icon-based BBCode toolbar
* Custom BBCode sorting/arrangement
* BBCodes can be assigned to certain usergroups for private use.
* Supports phpBB3’s custom BBCodes.
* New BBCodes:

		Copy, Paste, Plain, Font Family, Highlight text, Strike through text,
		Superscript, Subscript, Glow text, Shadow text, Dropshadow text, Blur
		text, Fade In/Out, Align (Left, Right Center, Justify), Float (Left,
		Right), LTR/RTL Direction, Preformatted text, Marquee scroll, Spoiler,
		Hidden, Moderator Message, Off Topic, NFO/ascii text, SoundCloud, BBvideo

* Embed video from dozens of popular media content sites with BBvideo. Also raw URLs will automatically be converted to embedded content.

* Multiple languages are supported. View the pre-installed [localizations](https://github.com/iMattPro/abbc3/tree/master/language).

## Minimum Requirements
* phpBB 3.2.2 or higher
* PHP 5.4 or higher

**Note: Only official release versions validated by the phpBB Extensions Team should be installed on a live forum. Pre-release (beta, dev) versions downloaded from this repository are only to be used for testing on offline/development forums and are not officially supported.**

## Install
1. [Download the latest validated release](https://www.phpbb.com/customise/db/extension/advanced_bbcode_box/).
2. Unzip the downloaded release and copy it to the `ext` directory of your phpBB board.
3. Navigate in the ACP to `Customise -> Manage extensions`.
4. Look for `Advanced BBCode Box` under the Disabled Extensions list and click its `Enable` link.

## Uninstall
1. Navigate in the ACP to `Customise -> Manage extensions`.
2. Click the `Disable` link for Advanced BBCode Box.
3. To permanently uninstall, click `Delete Data`, then delete the `abbc3` folder from `phpBB/ext/vse/`.

## Customizing:
1. Custom BBCode Icons: You can give your custom BBCodes icons by simply adding a GIF image named after your BBCode (e.g.: center.gif) to the `images/icons` directory. There are tons of extra BBCode icons included in the `contrib` directory.
2. BBCode Toolbar: You can change the look of the BBCode toolbar using any of the extra toolbar background images located in the `contrib` directory. Just copy one of the alternative toolbar images to `styles/all/theme/images/abbc3_bg.gif` (and refresh your browser). To assign custom toolbar images for each style, replace "all" with the name of your style.
3. NOTE: When making any of these customizations to ABBC3, be sure to note/backup your changes, as you may need to reproduce them after updating this extension, in case any of your added image files is overwritten or erased.

## License
[GNU General Public License v2](http://opensource.org/licenses/GPL-2.0)

© 2013 - Matt Friedman
