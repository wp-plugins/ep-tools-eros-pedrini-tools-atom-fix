=== EP Tools (Eros Pedrini Tools) - Atom Fix ===
Contributors: Eros Pedrini
Tags: atom, feed, fix, RFC, 4685, thr:total
Requires at least: 2.1
Tested up to: 2.6
Stable tag: 2.0

This plugin fixes a validation problem related with RFC 4685 atom feed extension.

== Description ==

This plugin fixes a validation problem related with RFC 4685 atom feed extension: some validators (e.g., w3c) don't like the thr:total extension.
Therefore, this plugin fixes this problem removing the <thr:total> tag from the atom feed without any hack to wordpress code.

== Installation ==
After long time, I'm ready to release the new version of my first WordPress plugin: Atom Fix.
This new version doesn't improve original plugin features, but make possible to use WordPress auto-upgrade functionality.

In order to support WordPress auto-upgrade functionality, the new versione is not compatible with the old one :( :
this happens because the original plugin was composed (effectively) from two plugins:
 - EP_Tools (Eros Pedrini Tools) - Administrative GUI that manages my plugins' GUI;
 - and EP_Tools (Eros Pedrini Tools) - Atom Fix that is the true plugin.
In this new release EP_Tools (Eros Pedrini Tools) - Administrative GUI has been removed in favor of
EP Tools Plugins GUI) that has the same functionalities (and some others ;) ) and it's a standalone plugin.
This means that in order to config this plugin you need to download and install EP Tools Plugins GUI before.
You can find this plugin here: http://wordpress.org/extend/plugins/ep-tools-eros-pedrini-tools-gui/

In order to install this plugin, please follow the next steps:
 1. remove EP_Tools (Eros Pedrini Tools) - Atom Fix, if it is installed;
 2. remove EP_Tools (Eros Pedrini Tools) - Administrative GUI, if it is installed and if its version is below 1.3;
 3. copy the ep-tools-eros-pedrini-tools-atom-fix folder in the WordPressfolder wp-content/plugins;
 4. active the plugin from the WordPress plugin interfece;
 5. configure the plugin using the interface under the Manage page in WordPress Administration.

== Frequently Asked Questions ==

= Should I modify any code in wordpress? =
Not needed. You have to just upload the files

= If I de-activate this plugin will it affect my blog? =
No. This plugin uses some of function of wordpress. Wordpress has nothing to with plugin. So de-activating this plugin is 100% safe.

== Screenshots ==

No Screenshots avaiable.