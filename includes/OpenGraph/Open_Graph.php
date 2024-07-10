<?php
namespace ZHNGRUPA\OpenGraph\OpenGraph;

class Open_Graph implements Open_Graph_Interface {
    public function init() {
        add_action('wp_head', array($this, 'add_open_graph_tags'), 5);
    }

    public function add_open_graph_tags() {
        $options = get_option('zhngrupa_open_graph_options');

        $site_name = get_bloginfo('name');

        global $post;

        // handle front page
        if( is_front_page() ) {
            $og_title = isset($options['og_title']) && !empty($options['og_title']) ? $options['og_title'] . ' - ' . $site_name : get_the_title() . ' - ' . $site_name;
        } else {
            $og_title = !empty($og_title) ? $og_title . ' - ' . $site_name : get_the_title() . ' - ' . $site_name;
        }

        $og_title = isset($options['og_title']) ? $options['og_title'] : '';
        $og_description = isset($options['og_description']) ? $options['og_description'] : '';
        $og_image = isset($options['og_image']) ? $options['og_image'] : '';

        $og_description = !empty($og_description) ? $og_description : get_the_excerpt();
        $og_image = !empty($og_image) ? $og_image : '';

        echo '<meta property="og:title" content="' . esc_attr($og_title) . '" />';
        echo '<meta property="og:description" content="' . esc_attr($og_description) . '" />';
        if ($og_image) {
            echo '<meta property="og:image" content="' . esc_url($og_image) . '" />';
        }
        echo '<meta property="og:url" content="' . esc_url(get_permalink()) . '" />';
        echo '<meta property="og:type" content="article" />';

        $locale = get_locale();
        echo '<meta property="og:locale" content="'. esc_attr($locale) .'" />';
        
    }

}
