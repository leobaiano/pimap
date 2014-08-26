=== Pimap ===
Contributors: leobaiano, valeriosza
Donate link: http://lbideias.com.br/donate
Tags: maps, google maps, shortcode, local, contact, map, map info
Requires at least: 3.8
Tested up to: 4.0
Stable tag: 1.2.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A plugin that allows users to record information that will be displayed on the google maps pins.

== Description ==

A plugin that allows users to record information that will be displayed on the google maps pins.

= Credits =

* Odin Framework [wp-brasil](https://github.com/wpbrasil/odin)

= Contribute =

You can contribute to the source code in our [GitHub](https://github.com/leobaiano/pimap) page.

== Installation ==

To install just follow the installation steps of most WordPress plugin's:

e.g.

1. Download the file lb-back-to-top.zip;
2. Unzip the file on your computer;
3. Upload folder post-ranking-view, you just unzip to `/wp-content/plugins/` directory;
4. Activate the plugin through the `Plugins` menu in WordPress;
5. Be happy.

Displaying the map on the site
Add the code below where you want the map to appear:

`<?php
if ( function_exists( 'display_map' ) ) {
    display_map();
}
?>
`
For include in your post, page and etc, use shortcode

`[pimap]`


== Screenshots ==

1. Initial options, the center of the map and zoom

2. Registration pin

3. Displaying the map on the site

4. Displaying image and content in infobox

== Changelog ==

= 1.2.0 2014-08-25 =

* Create shortcode [pimap], active scroll on mouse and change icon wp-admin.

= 1.1.1 2014-08-24 =

* Fix bug in the display of pins without image

= 1.1.0 2014-08-21 =

* Displaying image and content in infobox.
* Translation into Portuguese of Brazil

= 1.0.0 2014-08-02 =

* Creation of the plugin, the initial version.


== Upgrade Notice ==

= 1.2.0 2014-08-25 =

* Create shortcode [pimap], active scroll on mouse and change icon wp-admin.