<?php
/*
Plugin Name: EP_Tools (Eros Pedrini Tools) - Atom Fix
Plugin URI: http://www.contezero.net/sites/contezero/index.php/2008/12/01/atom-fix-plugin/
Description: This plugin fixs a validation problem related with RFC 4685 atom feed (<thr:total> tag)
Author: Eros Pedrini
Version: 2.0
Author URI: http://www.contezero.net/


Copyright 2008  Eros Pedrini  (email : contezero74@yahoo.it)


This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

define( 'EP_TOOLS_GUI_DIR', get_option('ep_tools_plugins_gui_dir') );

require_once(EP_TOOLS_GUI_DIR . '/lib/wordpress_pre2.6.inc');


class ep_tools_atom_fix {
    function ep_tools_atom_fix() {		
		remove_action('do_feed_atom', 'do_feed_atom', 10, 1);
        add_action('do_feed_atom', array(&$this,'doFeedAtom') );		
    }
    
    function doFeedAtom($for_comments) {
        $AtomFixEnabled = get_option('ep_tools_plugin_Atom_Fix_Enable');
        
        if ('true' == $AtomFixEnabled && !$for_comments) {
            load_template( WP_PLUGIN_DIR . '/ep_tools_atom_fix/ep_tools_feed-atom.php' );
        } else {
            do_feed_atom($for_comments);
        }
    }
}


/*
This function registers/unregisters the GUI for this plugin
*/
function ept_atom_fix_install() {
    global $wpdb;
    
    $plugin_name    = 'ep_tools_atom_fix_gui';
    $plugin_dir     = mysql_real_escape_string(dirname(__FILE__) . '/ep_tools_atom_fix.gui');
    
    $table_name     = $wpdb->prefix . "ept_registered_plugins";
    
    $sql =  'INSERT INTO ' . $table_name . '(PluginName, PluginDir) ' .
            "VALUES('" . $plugin_name . "', '" . $plugin_dir . "');";
                
    $wpdb->query($sql);
    
    
    if( false == get_option('ep_tools_plugin_Atom_Fix_Enable') ) {
        add_option('ep_tools_plugin_Atom_Fix_Enable', 'true');
	}
}

function ept_atom_fix_uninstall() {
    global $wpdb;
    
    $plugin_name    = 'ep_tools_atom_fix_gui';
        
    $table_name     = $wpdb->prefix . "ept_registered_plugins";
    
    $sql =  'DELETE FROM ' . $table_name . ' ' .
            "WHERE PluginName = '" . $plugin_name . "';";
                
    $wpdb->query($sql);
    
    if( false != get_option('ep_tools_plugin_Atom_Fix_Enable') ) {
        delete_option('ep_tools_plugin_Atom_Fix_Enable');
	}
}


register_activation_hook(__FILE__, 'ept_atom_fix_install');
register_deactivation_hook(__FILE__, 'ept_atom_fix_uninstall');

$ep_tools_AtomFixInstance = new ep_tools_atom_fix();

?>