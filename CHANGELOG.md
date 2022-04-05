# Changelog

## 3.3.3 - 2022-02-24

- Made the Font BBCode more customizable and compatible for all users:
  - Added Google font support to the font BBCode; add Google fonts via the ABBC3 settings in the ACP.
  - Removed non-universal font styles from the font BBCode menu.
  - These changes will not break existing posts.
- Switched the text scrolling BBCode (marquee effect) to an HTML-valid CSS-only method.
- Various minor code updates.

## 3.3.2 - 2021-01-16

- Fixed compatibility issues with PHP 8.
- Fixed compatibility issues with MSSQL databases.
- Fixed an issue with missing BBCode icons in front-end controllers such as the Knowledge Base extension.
- Updated the TableDnD plugin to 1.0.5.

## 3.3.1 - 2020-11-07

- Fixed missing IMG, URL and FLASH BBCode buttons from Quick Reply.
- Fixed issues with duplication of BBCode button bars in Quick Reply when using Quick Reply Reloaded and other Quick Reply extensions.
- Fixed the names of example sites in the BBVideo/Media Embed Wizard.
- Added European Portuguese translation

## 3.3.0 - 2020-09-11

- Replaced the antiquated, pixelated GIF BBCode icons with two new SVG and PNG icon sets.
- Added BBCodes to Quick Reply.
- Added an all new ACP settings section to the Extensions tab of the ACP:
  - Toggle between SVG or PNG icon sets for the ABBC3 Icon bar.
  - Enable or disable the ABBC3 Icon bar.
  - Enable or disable the Quick Reply BBCodes.
  - Enable or disable the Pipe Tables plugin.
- Created an ABBC3 folder in phpBB's images folder. Now you can add your BBCode icons to this folder which won't be deleted when updating ABBC3.
- BBCodes with no associated icon image will display like a standard phpBB BBCode.
- BBVideo deprecation continues: 
  - If you have the phpBB Media Embed PlugIn installed, its `[media]` BBCode button now behaves just like the `[bbvideo]` button and opens the BBVideo wizard. You may now hide the `[bbvideo]` BBCode if you prefer to use the `[media]` BBCode (or vice versa) by turning off its display on posting page setting.
- Added Open Sans to font BBCodes list since it is part of phpBB Prosilver.

## 3.2.4 - 2020-08-10

- Fixed an issue causing circular dependency errors when co-installed with mChat in phpBB 3.3.1.

## 3.2.3 - 2020-03-13

- Minor fixes that might cause unexpected JavaScript behaviors in phpBB 3.3.x using jQuery 3.

## 3.2.2 - 2019-04-29

- BBCode URL/BBVideo Wizard is now a modal/overlay, to solve some issues where it might have been obscured from view.
- Ensure BBVideos are sorted alphabetically in the BBCode Wizard's examples drop down menu.
- Added Slovak translation.
- Additional minor code improvements.

## 3.2.1 - 2018-06-07

- Improved BBVideo's compatibility with phpBB Media Embed PlugIn extension. For best results, install phpBB Media Embed Plugin extension to have the ability to manage which sites area allowed and to control parsing plain URLs.
- ABBC3 now has a BBCode entry in the ACP for the Pipe Tables plugin. This way you can arrange where you want the Pipe Tables BBCode to appear in the BBCode bar. You may also choose to not display the Pipe Table BBCode on the posting page, or you can delete the BBCode to remove the Pipe Tables functionality.
- Fixed an issue since 3.2.0 where deleting the `[BBVideo]` and `[hidden]` BBCodes did not stop them from still being *secretly* available to continue being used. Now, if they get deleted, they are functionally gone (unless you completely reinstall ABBC3).

## 3.2.0 - 2018-01-20

- Documentation for Advanced BBCodes added to the BBCode FAQ page
- Added Tables support in posts (using s9e/TextFormatter's Pipe Tables plugin)
- Compatible with phpBB Media Embed extension, added a BBCode button for [MEDIA] tag.
- [BBVideo] deprecated:
    - BBVideo is now an alias for the [MEDIA] tag, part of the Media Embed feature bundled with phpBB (you do NOT need to install phpBB Media Embed extension to work).
    - Many more sites and media services are supported through the Media Embed feature bundled with phpBB.
    - Many old BBVideo exclusive sites are no longer supported (most of which are dead and gone anyways). `5min.com, allocine.fr, clipfish.de, clipmoon.com, cnet.com, colbertnation.com, crackle.com, dotsub.com, ebaumsworld.com, g4tv.com, gameprotv.com, howcast.com, maker.tv, moddb.com, mpora.com, myspace.com, myvideo.de, on.aol.com, photobucket.com, sapo.pt, screenr.com, snotr.com, spike.com, streetfire.net, thedailyshow.cc.com, tu.tv, tudou.com, viddler.com, videogamer.com`
    - Custom video sizing is no longer available. phpBB's bundled Media embedding has predetermined hard-coded video sizes.
    - Raw URLs for compatible media sites will automatically be converted into content even without being wrapped in the BBVideo tag.
    - The original URLs will no longer display if they can be converted to embedded content.
    - All Posts and PM's will be re-parsed after updating, over time using CRON jobs to fix broken posts with BBVideos.
    - Incompatible BBVideos will remain broken (sorry 'bout that, but moving on usually means leaving old stuff behind).
- Improved align BBCode when used on non-text like images, videos, etc.
- Show AJAX loading indicators while loading BBCode wizards
- Improved ABBC3 deletion. Now if you delete ABBC3, all the BBCodes it installed will no longer be displayed on the posting pages, returning the BBCodes toolbar to the default appearance. You may then choose to manually display or delete each of the BBCodes in the ACP Posting page.
- Internal improvements for phpBB 3.2 and 3.3
- End of compatibility for phpBB 3.1
- Added Vietnamese translation

## 3.1.4 - 2017-01-10

- Update styling for spoil, mod, offtopic, nfo BBCodes
- Added maker.tv BBVideo
- Updated break.com BBVideo
- Updated cnet.com BBVideo
- Removed blip.tv BBVideo
- Removed godtube.com BBVideo
- Removed sevenload.com BBVideo
- Removed twitvid.com BBVideo
- Removed wat.tv BBVideo
- Added Finnish translation
- Added Brazilian-Portuguese translation
- Various code fixes and improvements

## 3.1.3 - 2016-03-19

- Fix an issue where BBCodes could break after updating phpBB 3.1.x to 3.2.x
- Fix move up/down buttons for arranging BBCodes (AJAX wasn't working)
- Lots of code improvements under the hood

## 3.1.2 - 2015-12-01

- Includes compatibility with phpBB 3.2.0-a1
- Updated soundcloud.com BBcode
- Updated facebook.com BBVideo
- Updated gamespot.com BBVideo
- Updated veoh.com BBVideo
- Removed gametrailers.com BBVideo
- Added the URL BBcode wizard to subsilver2
- Complete conversion to TWIG syntax
- Template events added to the ABBC3's bbcode button bars
- Improve CSS for drop down menus (Font Name and Font Size select menus)
- Installer removes BBcodes with negative IDs from the database (leftover from ABBC3.0)
- Added Estonian language
- Added Swedish language
- Added Turkish language
- Added Ukrainian language

## 3.1.1 - 2015-04-26

- Fixed a bug where usernames with quotations would break BBCode buttons
- Added a BBCode wizard for the URL BBCode button
- Disable BBCode wizards for touch devices
- Updated myspace.com BBVideo
- Removed videu.de BBVideo (no longer in service)
- Fixed a bug where new installations set the legacy YouTube BBCode to be displayed
- Major coding improvements
- Added Croatian language
- Added Greek language
- Added Italian language
- Added Mandarin Chinese languages
- Added Russian language

## 3.1.0 - 2014-11-26

- Fix issues with responsive BBVideo size calculations
- Minor code base improvements and updates

## 3.1.0-b3 - 2014-11-12

- fade bbcode is CSS only now
- BBVideos are all mobile device friendly
- Updated several BBVideos
- Added new BBVideos: Instagram, tu.tv, revision3.com, testtube.com, kickstarter.com
- Arabic and Dutch translations added
- Better backwards compatibility - most BBCodes will continue to work even after disabling or uninstalling ABBC3

## 3.1.0-b2 - 2014-07-12

- Updated for compatibility with phpBB 3.1.0-RC2
- Added Persian language pack

## 3.1.0-b1 - 2014-06-06

- First beta release of the phpBB 3.1 extension version of Advanced BBCode Box 3
