=== Post Star ===
Contributors: leobaiano
Donate link: http://lbideias.com.br/donate
Tags: maps, google maps
Requires at least: 3.8
Tested up to: 3.9.1
Stable tag: 1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Plugin allows users to mark the number of stars of each post and display the average.

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

<?php
if ( function_exists( 'display_map' ) ) {
    display_map();
}
?>

== Screenshots ==

1. Initial options, the center of the map and zoom

2. Registration pin

3. Displaying the map on the site

== Changelog ==

= 1.0 2014-08-02 =

* Creation of the plugin, the initial version.