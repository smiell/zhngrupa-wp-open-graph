<?php
/*
Plugin Name: zhngrupa-wp-open-graph
Description: Provide support for Open Graph Protocol in Wordpress site
Version: 1.0
Author: ZHNGRUPA SPÓŁKA Z OGRANICZONĄ ODPOWIEDZIALNOŚCIĄ | Jacek Śmiel
*/

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Include necessary files.
require_once plugin_dir_path(__FILE__) . 'includes/Admin/Admin_Page_Interface.php';
require_once plugin_dir_path(__FILE__) . 'includes/Admin/Admin_Page.php';
require_once plugin_dir_path(__FILE__) . 'includes/OpenGraph/Open_Graph_Interface.php';
require_once plugin_dir_path(__FILE__) . 'includes/OpenGraph/Open_Graph.php';
require_once plugin_dir_path(__FILE__) . 'includes/Settings/Settings_Page.php';
require_once plugin_dir_path(__FILE__) . 'includes/Settings/Settings_Handler.php';
require_once plugin_dir_path(__FILE__) . 'includes/Settings/Settings_Form.php';

// Initialize the plugin.
add_action('plugins_loaded', array('zhngrupa_WP_Open_Graph', 'get_instance'));

class zhngrupa_WP_Open_Graph
{
    private static $instance;

    public static function get_instance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
            self::$instance->setup_hooks();
        }
        return self::$instance;
    }

    private function setup_hooks()
    {
        // Initialize admin page.
        $admin_page = new ZHNGRUPA\OpenGraph\Admin\Admin_Page();
        $admin_page->init();

        // Initialize Open Graph functionality.
        $open_graph = new ZHNGRUPA\OpenGraph\OpenGraph\Open_Graph();
        $open_graph->init();

    }

}
