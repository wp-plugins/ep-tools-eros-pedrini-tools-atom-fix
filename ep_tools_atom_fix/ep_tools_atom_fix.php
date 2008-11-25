<?php
/*
Plugin Name: EP_Tools (Eros Pedrini Tools) - Atom Fix
Plugin URI: http://www.contezero.net/
Description: This plugin fixs a validation problem related with RFC 4685 atom feed (<thr:total> tag)
Author: Eros Pedrini
Version: 1.1
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

define( 'EP_TOOLS_SHARED_DIR', dirname(__FILE__) . '/../ep_tools_shared' );

require_once(EP_TOOLS_SHARED_DIR . '/wordpress_pre2.6.inc');

class ep_tools_atom_fix {
    var $DefaultOptionValue = 'true';
    
    function ep_tools_atom_fix() {
        if( false == get_option('ep_tools__plugin_Atom_Fix') ){
		    add_option('ep_tools__plugin_Atom_Fix', $this->DefaultOptionValue);
		}
		
		remove_action('do_feed_atom', 'do_feed_atom', 10, 1);
        add_action('do_feed_atom', array(&$this,'doFeedAtom') );		
    }
    
    function doFeedAtom($for_comments) {
        $AtomFixEnabled = get_option('ep_tools__plugin_Atom_Fix');
        
        if ('true' == $AtomFixEnabled && !$for_comments) {
            load_template( WP_PLUGIN_DIR . '/ep_tools_atom_fix/ep_tools_feed-atom.php' );
        } else {
            do_feed_atom($for_comments);
        }
    }
}

$ep_tools__AtomFixInstance = new ep_tools_atom_fix();

?>