<?php
namespace ZHNGRUPA\OpenGraph\Settings;

class Settings_Page {
    private $capability = 'manage_options';
    private $option_name = 'zhngrupa_open_graph_options'
    private static $instance = null;

    private $fields = [
        [
            'id' => 'og_title',
            'label' => 'Open Graph Title',
            'description' => 'Enter the title for Open Graph tags.',
            'type' => 'text',
        ],
        [
            'id' => 'og_description',
            'label' => 'Open Graph Description',
            'description' => 'Enter the description for Open Graph tags.',
            'type' => 'textarea',
        ],
        [
            'id' => 'og_image',
            'label' => 'Open Graph Image URL',
            'description' => 'Enter the URL of the image for Open Graph tags.',
            'type' => 'url',
        ],
        [
            'id' => 'twitter_title',
            'label' => 'Twitter Image URL',
            'description' => 'Enter the title for twitter tags.',
            'type' => 'text',
        ],
        [
            'id' => 'twitter_domain',
            'label' => 'Twitter domain name',
            'description' => 'Enter the domain name for twitter tags.',
            'type' => 'text',
        ],
        [
            'id' => 'twitter_description',
            'label' => 'Twitter domain name',
            'description' => 'Enter the description for twitter tags.',
            'type' => 'textarea',
        ],
        [
            'id' => 'twitter_url',
            'label' => 'Twitter domain name',
            'description' => 'Enter the url for twitter tags.',
            'type' => 'url',
        ],
    ];

    public static function get_instance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct() {
        $this->init();
    }

    private function init() {
        //error_log('init called');
        add_action('admin_init', [$this, 'register_settings']);
        add_action('admin_menu', [$this, 'add_settings_page']);
    }

    public function register_settings() {
        //error_log('register_settings called');
        register_setting($this->option_name, $this->option_name);

        add_settings_section(
            'zhngrupa_open_graph_section',
            'Open Graph Settings',
            [$this, 'section_callback'],
            'zhngrupa-open-graph-settings'
        );

        foreach ($this->fields as $field) {
            add_settings_field(
                $field['id'],
                $field['label'],
                [$this, 'render_field'],
                'zhngrupa-open-graph-settings',
                'zhngrupa_open_graph_section',
                ['field' => $field]
            );
        }
    }

    public function add_settings_page() {
        //error_log('add_settings_page called');
        add_options_page(
            'Open Graph Settings',
            'Open Graph',
            $this->capability,
            'zhngrupa-open-graph-settings',
            [$this, 'settings_page_html']
        );
    }

    public function settings_page_html() {
        error_log('settings_page_html called');
        ?>
        <div class="wrap">
            <h1>Open Graph Settings</h1>
            <form method="post" action="options.php">
                <?php
                //error_log('settings_fields called');
                settings_fields($this->option_name);

                //error_log('do_settings_sections called');
                do_settings_sections('zhngrupa-open-graph-settings');
                submit_button();
                ?>
            </form>
        </div>
        <?php
    }

    public function section_callback() {
        echo '<p>Configure Open Graph settings.</p>';
    }

    public function render_field($args) {
        $field = $args['field'];
        $options = get_option($this->option_name); // Pobranie opcji

        switch ($field['type']) {
            case "text":
                ?>
                <input
                    type="text"
                    id="<?php echo esc_attr($field['id']); ?>"
                    name="<?php echo esc_attr($this->option_name . '[' . $field['id'] . ']'); ?>"
                    value="<?php echo isset($options[$field['id']]) ? esc_attr($options[$field['id']]) : ''; ?>"
                >
                <p class="description">
                    <?php echo esc_html($field['description']); ?>
                </p>
                <?php
                break;

            case "textarea":
                ?>
                <textarea
                    id="<?php echo esc_attr($field['id']); ?>"
                    name="<?php echo esc_attr($this->option_name . '[' . $field['id'] . ']'); ?>"
                ><?php echo isset($options[$field['id']]) ? esc_attr($options[$field['id']]) : ''; ?></textarea>
                <p class="description">
                    <?php echo esc_html($field['description']); ?>
                </p>
                <?php
                break;

            case "url":
                ?>
                <input
                    type="url"
                    id="<?php echo esc_attr($field['id']); ?>"
                    name="<?php echo esc_attr($this->option_name . '[' . $field['id'] . ']'); ?>"
                    value="<?php echo isset($options[$field['id']]) ? esc_attr($options[$field['id']]) : ''; ?>"
                >
                <p class="description">
                    <?php echo esc_html($field['description']); ?>
                </p>
                <?php
                break;
        }
    }
}

// Inicjalizacja strony ustawień
add_action('plugins_loaded', function() {
    $settings_page = Settings_Page::get_instance();
});
