<?php
namespace ZHNGRUPA\OpenGraph\Admin;

class Admin_Page implements Admin_Page_Interface {
    public function init() {
        add_action('admin_menu', array($this, 'add_admin_menu'));
    }

    public function add_admin_menu() {
        add_menu_page(
            'ZHNGRUPA', // Page title
            'ZHNGRUPA', // Menu title
            'manage_options', // Capability
            'zhngrupa-open-graph-settings', // Menu slug
            array($this, 'display_settings_page'), // Callback function to display page
            'dashicons-admin-generic', // Icon
            30 // Position
        );
    }

    public function display_settings_page() {
        echo '<div class="wrap">';
        echo '<h1>ZHNGRUPA Open Graph Settings</h1>';
        echo '<form method="post" action="options.php">';
        settings_fields('zhngrupa_open_graph_options');
        do_settings_sections('zhngrupa-open-graph-settings');
        submit_button();
        echo '</form>';
        echo '</div>';
    }
}
