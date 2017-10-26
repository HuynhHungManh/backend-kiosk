=== WP WORDTOPDF Converter Widget ===
Contributors: investintech
Donate link: none
Tags: pdf, converter, widget, web service, word, doc, docx
Requires at least: 3.0.1
Tested up to: 3.1
Stable tag: 0.1

Integrate WORD to PDF converter widgets, using Web Service, into any wordpress website

== Description ==

This plugin will enable you to add WORD to PDF converter widgets to your sidebars.
The new widget, called "WP WORDTOPDF Converter Widget", can be easily added once the plugin is downloaded. Each of these widgets can hold one WORD to PDF converter. For each widget/converter you will have the option to control the widget’s skin and the maximum file size accepted for input file.
Global Options page, "WP WORD to PDF Converter Widget", holds global skin and max file size settings, and affiliate ID field. Each skin has a customizable "skin.css" file with style definition, using some custom templating tokens for element IDs.


*  You can add multiple converter widgets.
*  Each widget can have different settings.
*  Each widget can have a different CSS style/skin.
*  You can specify global settings that will apply for all widgets by default.
*  Affiliate links are included, you can add your affiliate ID on global settings page. 
*  Widget settings will override global settings for WP WORD to PDF Converter.
*  Converter uses Investintech free Web Service to function.
*  Uploaded files are stored inside plugin directory and cleaned up using WP cron job each day


== Installation ==


1. Download the plugin zip file, and unzip the content.
2. Upload the content of the downloaded zip file to the `/wp-content/plugins/` directory
3. Activate the plugin through the 'Plugins' menu in WordPress
4. Go to Settings->WP WORD to PDF Converter Widget page to select your global options and submit your Affiliate ID.
5. Go to Widgets page, and add your "WP WORDTOPDF Converter Widget" widgets in any sidebar

== Frequently Asked Questions ==

= Conversion gets stuck on "Uploading file..." =

Make sure you have the maximum file size setting defined. 
The converter will not work on localhost servers, since the web service it uses is unable to access uploaded file.

= How do I make new skin ? =

Create a new folder in `/wp-content/plugins/wp-doctopdf-widget/skins` and name it in any way you would like your new skin to be called. Copy skin.css from default skin into the newly created folder and edit the CSS rules. Add your images if you like.

= Browse button is not working on my website ? =

This plugin uses the latest mootools javascript library, so please make sure you don't have mootools already included in your website, by some other plugin.


== Screenshots ==

1. Global options page
2. Global options page link
3. Widgets page
4. Front End look - idle
5. Front End look - file converted

== Changelog ==

= 0.1 =
* Initial release

== Upgrade Notice ==

= 0.1 =
* Initial release