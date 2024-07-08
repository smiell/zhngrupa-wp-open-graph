<?php
namespace ZHNGRUPA\OpenGraph\Settings;

class Settings_Handler {
    public function register_settings() {
        register_setting('zhngrupa_open_graph_options', 'zhngrupa_open_graph_options', array($this, 'sanitize_callback'));
    }

    public function sanitize_callback($input) {
        return $input;
    }
}

