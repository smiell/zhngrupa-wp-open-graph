<?php
namespace ZHNGRUPA\OpenGraph\Admin;

class Admin_Page implements Admin_Page_Interface {
    public function init() {
        add_action('admin_menu', array($this, 'add_admin_menu'));
        add_action( 'admin_enqueue_scripts', array($this, 'zhngrupa_open_graph_admin_side_css') );
    }

    public function add_admin_menu() {
        add_menu_page(
            'ZHNGRUPA Open Graph Support', // Page title
            'ZHNGRUPA Open Graph Support', // Menu title
            'manage_options', // Capability
            'zhngrupa-open-graph-settings', // Menu slug
            array($this, 'display_settings_page'), // Callback function to display page
            'dashicons-admin-generic', // Icon
            30 // Position
        );
    }

    public function display_settings_page() {
        echo '<div class="wrap">';
        
        // Left column - settings form
        echo '<div class="left-column">';
        echo '<form method="post" action="options.php">';
        settings_fields('zhngrupa_open_graph_options');
        do_settings_sections('zhngrupa-open-graph-settings');
        submit_button();
        echo '</form>';
        echo '</div>';
        
        // Right column - live preview
        echo '<div class="right-column">';
        echo '<h2>Live Preview</h2>';
        echo '<p>Below you can see how your website will be presented in social media that using Open Graph Protocool for presenting webisites.';
        
        // Open Graph Protocol view for OG data
        echo '<div class="LiveProtocolView">';
        echo '<h3>Open Graph Protocol</h3>';
        $og_title = get_option('zhngrupa_open_graph_options')['og_title'];
        $og_description = get_option('zhngrupa_open_graph_options')['og_description'];
        $og_image = get_option('zhngrupa_open_graph_options')['og_image'];
        
        if ($og_title || $og_description || $og_image) {
            echo '<p><strong>Title:</strong> ' . esc_html($og_title) . '</p>';
            echo '<p><strong>Description:</strong> ' . esc_html($og_description) . '</p>';
            echo '<p><strong>Image URL:</strong> <img src="' . esc_url($og_image) . '" alt="Open Graph Image" style="max-width: 200px;"></p>';
        } else {
            echo '<p><strong>No Open Graph data set.</strong></p>';
        }
        echo '</div>';
        
        // Twitter Protocol view for Twitter data
        echo '<div class="LiveProtocolView">';
        echo '<h3>Twitter Protocol</h3>';
        $twitter_title = get_option('zhngrupa_open_graph_options')['twitter_title'];
        $twitter_description = get_option('zhngrupa_open_graph_options')['twitter_description'];
        $twitter_image = get_option('zhngrupa_open_graph_options')['twitter_image'];
        
        if ($twitter_title || $twitter_description || $twitter_image) {
            echo '<p><strong>Title:</strong> ' . esc_html($twitter_title) . '</p>';
            echo '<p><strong>Description:</strong> ' . esc_html($twitter_description) . '</p>';
            echo '<p><strong>Image URL:</strong> <img src="' . esc_url($twitter_image) . '" alt="Twitter Image" style="max-width: 200px;"></p>';
        } else {
            echo '<p><strong>No Twitter data set.</strong></p>';
        }
        echo '</div>';
        
        echo '</div>'; // End of right-column
        
        echo '</div>'; // End of wrap

        echo '<div class="footer">';
            echo '<p>Made with <span style="color: red;">&hearts;</span> by ZHNGRUPA powered by Jacek Śmiel</p>';
            echo '<p><a href="https://zhngrupa.net/" target="_blank">Order your solutions now. We can provide everything!</a>';
        echo '</div>';

    }
    
    

    function zhngrupa_open_graph_admin_side_css() {
        wp_register_style( 'zhn-open-graph-admin-css', plugin_dir_url( __FILE__ ) . '../../assets/css/admin.css', [] );
        wp_enqueue_style( 'zhn-open-graph-admin-css' );
    }
    
}
