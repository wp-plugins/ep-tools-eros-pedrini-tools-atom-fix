=== EP Tools (Eros Pedrini Tools) - Atom Fix ===
Contributors: Eros Pedrini
Tags: atom, feed, fix, RFC, 4685, thr:total
Requires at least: 2.1
Tested up to: 2.6
Stable tag: 1.2

This plugin fixes a validation problem related with RFC 4685 atom feed extension.

== Description ==

This plugin fixes a validation problem related with RFC 4685 atom feed extension: some validators (e.g., w3c) don't like the thr:total extension.
Therefore, this plugin fixes this problem removing the <thr:total> tag from the atom feed without any hack to wordpress code.

== Installation ==
The .zip file contains two distinct directory: (a) ep_tools_atom_fix and (b) ep_tools_shared; the first one contains the plugin itself, the second one contains the common framework for all my plugins.
If you have all ready the ep_tools_shared folder, *don't delete it*, but only copy in it the files enclosed within this plugin.
 
1. Copy the two directories to wordpress wp-content/plugins folder.

2. Goto to Plugins page in wordpress and activate the Wordpress EP Tools plugins:
 (a) "EP_Tools (Eros Pedrini Tools) - Administrative GUI" for the common administrative configuration interface:
 (b) "EP_Tools (Eros Pedrini Tools) - Atom Fix" to use the fix

3. Once the plugins are activated you will able to turn on (or off) the fix using the configuration interface under the *Manage* page.

== Frequently Asked Questions ==

= Should I modify any code in wordpress? =
Not needed. You have to just upload the files

= If I de-activate this plugin will it affect my blog? =
No. This plugin uses some of function of wordpress. Wordpress has nothing to with plugin. So de-activating this plugin is 100% safe.

== Screenshots ==

No Screenshots avaiable.