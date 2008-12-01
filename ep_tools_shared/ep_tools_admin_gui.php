<?php
/*
Plugin Name: EP_Tools (Eros Pedrini Tools) - Administrative GUI
Plugin URI: http://www.contezero.net/
Description: This plugin is the common GUI for manage EP_Tools.
Author: Eros Pedrini
Version: 1.2
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

define( 'EP_TOOLS_SHARED_DIR', dirname(__FILE__) );

require_once(EP_TOOLS_SHARED_DIR . '/wordpress_pre2.6.inc');

class ep_tools__admin_gui {
    function ep_tools__admin_gui() {
        add_action('admin_menu', array(&$this, 'setupPluginsConfigPage') );
    }
    
    function setupPluginsConfigPage() {
        if ( function_exists('add_submenu_page') ) {
            add_submenu_page('edit.php', __('EP Tools Configuration'), __('EP Tools Configuration'), 'manage_options', 'ep_tools_config_page', array(&$this, 'showPluginsConfigPage') );
        } 
    }
    
    function showPluginsConfigPage() {
        $this->loadPluginsGUI();
        
        if ( isset($_POST['submit']) ) {
            if ( function_exists('current_user_can') && !current_user_can('manage_options') ){
                die(__('Cheatin&#8217; uh?'));
            }
            
            // save plugin config changes
            foreach ($this->PluginsGUI as $G) {
                $G->updateConfig();
            }
    	}
    	
        if ( !empty($_POST) ) {
            echo '<div id="message" class="updated fade"><p><strong>';
                _e('Options saved.');
            echo "</strong></p></div>\n";
        }
        
        // show plugins GUI
        echo "<div class=\"wrap\">\n";
        echo "\t<h2>";
            _e('EP Tools Configuration');
        echo "</h2>\n";
        echo "\t<form action=\"\" method=\"post\">\n";
        
        if ( 0 == count($this->PluginsGUI) ) {
            echo "\t\t<p>No Plugin avvaiables</p>\n";
        } else {
        
            foreach ($this->PluginsGUI as $G) {
                echo "\t\t<h3>";
                    $G->printTitle();
                echo "</h3>\n";
                
                if ( method_exists($G, 'checkAvailability') && !$G->checkAvailability() ) {
                    $G->printAvailabilityError();
                } else {
                    $G->printGUI();
                }
            }
        }
        
        echo "\t\t<p class=\"submit\"><input type=\"submit\" name=\"submit\" value=\"";
            _e('Update options &raquo;');
        echo "\" /></p>";
        
        echo "\t</form>\n";        
        echo "</div>\n";
    }
    
    
    // private
    function loadPluginsGUI() {
        $this->PluginsGUI = array();
        
        $Dir = dir(EP_TOOLS_SHARED_DIR . '/');
        while ( false != ( $Entry = $Dir->read() ) ) {
            $LongEntry = EP_TOOLS_SHARED_DIR . '/' . $Entry;
            
            if ( is_file($LongEntry) ) {
                $EntryParts = pathinfo($LongEntry);
                
                if ( 'gui' == $EntryParts['extension'] ) {
                    require_once($LongEntry);
                    
                    eval( '$this->PluginsGUI[] = new ' . basename($LongEntry, '.gui') . '_gui();' );
                }
            }
        }
    }
    
    
    var $PluginsGUI = null;
}


$ep_tools__AdminGuiInstance = new ep_tools__admin_gui();

?>
