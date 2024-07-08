<?php
namespace ZHNGRUPA\OpenGraph\Settings;

class Settings_Page {
    private $capability = 'manage_options';
	
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

    public function init() {
        $settings_handler = new Settings_Handler();
        add_action('admin_init', [$settings_handler, 'register_settings']);
        add_action('admin_init', [$this, 'register_settings_page']);
    }

    public function register_settings_page() {
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

    public function section_callback() {
        echo '<p>Configure Open Graph settings.</p>';
    }

    public function render_field($args) {
        $field = $args['field'];
        $options = get_option('zhngrupa_open_graph_options');

		switch ( $field['type'] ) {

			case "text": {
				?>
				<input
					type="text"
					id="<?php echo esc_attr( $field['id'] ); ?>"
					name="wporg_options[<?php echo esc_attr( $field['id'] ); ?>]"
					value="<?php echo isset( $options[ $field['id'] ] ) ? esc_attr( $options[ $field['id'] ] ) : ''; ?>"
				>
				<p class="description">
					<?php esc_html_e( $field['description'], 'my-plugin-settings' ); ?>
				</p>
				<?php
				break;
			}

			case "checkbox": {
				?>
				<input
					type="checkbox"
					id="<?php echo esc_attr( $field['id'] ); ?>"
					name="wporg_options[<?php echo esc_attr( $field['id'] ); ?>]"
					value="1"
					<?php echo isset( $options[ $field['id'] ] ) ? ( checked( $options[ $field['id'] ], 1, false ) ) : ( '' ); ?>
				>
				<p class="description">
					<?php esc_html_e( $field['description'], 'my-plugin-settings' ); ?>
				</p>
				<?php
				break;
			}

			case "textarea": {
				?>
				<textarea
					id="<?php echo esc_attr( $field['id'] ); ?>"
					name="wporg_options[<?php echo esc_attr( $field['id'] ); ?>]"
				><?php echo isset( $options[ $field['id'] ] ) ? esc_attr( $options[ $field['id'] ] ) : ''; ?></textarea>
				<p class="description">
					<?php esc_html_e( $field['description'], 'my-plugin-settings' ); ?>
				</p>
				<?php
				break;
			}

			case "select": {
				?>
				<select
					id="<?php echo esc_attr( $field['id'] ); ?>"
					name="wporg_options[<?php echo esc_attr( $field['id'] ); ?>]"
				>
					<?php foreach( $field['options'] as $key => $option ) { ?>
						<option value="<?php echo $key; ?>" 
							<?php echo isset( $options[ $field['id'] ] ) ? ( selected( $options[ $field['id'] ], $key, false ) ) : ( '' ); ?>
						>
							<?php echo $option; ?>
						</option>
					<?php } ?>
				</select>
				<p class="description">
					<?php esc_html_e( $field['description'], 'my-plugin-settings' ); ?>
				</p>
				<?php
				break;
			}

			case "password": {
				?>
				<input
					type="password"
					id="<?php echo esc_attr( $field['id'] ); ?>"
					name="wporg_options[<?php echo esc_attr( $field['id'] ); ?>]"
					value="<?php echo isset( $options[ $field['id'] ] ) ? esc_attr( $options[ $field['id'] ] ) : ''; ?>"
				>
				<p class="description">
					<?php esc_html_e( $field['description'], 'my-plugin-settings' ); ?>
				</p>
				<?php
				break;
			}

			case "wysiwyg": {
				wp_editor(
					isset( $options[ $field['id'] ] ) ? $options[ $field['id'] ] : '',
					$field['id'],
					array(
						'textarea_name' => 'wporg_options[' . $field['id'] . ']',
						'textarea_rows' => 5,
					)
				);
				break;
			}

			case "email": {
				?>
				<input
					type="email"
					id="<?php echo esc_attr( $field['id'] ); ?>"
					name="wporg_options[<?php echo esc_attr( $field['id'] ); ?>]"
					value="<?php echo isset( $options[ $field['id'] ] ) ? esc_attr( $options[ $field['id'] ] ) : ''; ?>"
				>
				<p class="description">
					<?php esc_html_e( $field['description'], 'my-plugin-settings' ); ?>
				</p>
				<?php
				break;
			}

			case "url": {
				?>
				<input
					type="url"
					id="<?php echo esc_attr( $field['id'] ); ?>"
					name="wporg_options[<?php echo esc_attr( $field['id'] ); ?>]"
					value="<?php echo isset( $options[ $field['id'] ] ) ? esc_attr( $options[ $field['id'] ] ) : ''; ?>"
				>
				<p class="description">
					<?php esc_html_e( $field['description'], 'my-plugin-settings' ); ?>
				</p>
				<?php
				break;
			}

			case "color": {
				?>
				<input
					type="color"
					id="<?php echo esc_attr( $field['id'] ); ?>"
					name="wporg_options[<?php echo esc_attr( $field['id'] ); ?>]"
					value="<?php echo isset( $options[ $field['id'] ] ) ? esc_attr( $options[ $field['id'] ] ) : ''; ?>"
				>
				<p class="description">
					<?php esc_html_e( $field['description'], 'my-plugin-settings' ); ?>
				</p>
				<?php
				break;
			}

			case "date": {
				?>
				<input
					type="date"
					id="<?php echo esc_attr( $field['id'] ); ?>"
					name="wporg_options[<?php echo esc_attr( $field['id'] ); ?>]"
					value="<?php echo isset( $options[ $field['id'] ] ) ? esc_attr( $options[ $field['id'] ] ) : ''; ?>"
				>
				<p class="description">
					<?php esc_html_e( $field['description'], 'my-plugin-settings' ); ?>
				</p>
				<?php
				break;
			}

		}

    }
}
