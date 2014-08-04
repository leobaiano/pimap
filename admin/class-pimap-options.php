<?php
	if ( ! defined( 'ABSPATH' ) )
		exit; // Exit if accessed directly.

	/**
	 * Pimap Options.
	 *
	 * @package  Pimap/Admin
	 * @category Admin
	 * @author   Leo Baiano <leobaiano@lbideias.com.br>
	 */
	class Pimap_Options {
		
		/**
		 * Instance of this class.
		 *
		 * @var object
		 */
		protected static $instance = null;

		/**
		 * Plugin settings.
		 *
		 * @var array
		 */
		public $plugin_settings = array();

		/**
		 * Initialize the plugin
		 */
		public function __construct() {
			// Adds admin menu.
			add_action( 'admin_menu', array( $this, 'settings_menu' ) );
			add_action( 'admin_init', array( $this, 'settings_section_options' ) );
		}

		/**
		 * Settings menu
		 *
		 * @return void
		 */
		public function settings_menu() {
			add_menu_page(
				__( 'Pimap Options', 'pimap' ),
				__( 'Pimap Options', 'pimap' ),
				'manage_options',
				'pimap_options',
				array( $this, 'settings_page' ),
				'',
				28
			);
		}

		/**
		 * Creating the options section and fields of plugin options
		 *
		 */
		public function settings_section_options() {
		 	add_settings_section(
				'pimap_settings_section',
				__( 'Set the options of the plugin Pimap', 'pimap' ),
				'__return_false',
				'pimap_options'
			);

		 	add_settings_field(
				'pimap_latitude',
				__( 'Latitude', 'pimap' ),
				array( $this, 'text_element_callback' ),
				'pimap_options',
				'pimap_settings_section',
				array(
					'name' => 'pimap_latitude',
					'id' => 'pimap_latitude',
					'class' => 'input_text',
					'settings' => 'pimap_setings_main'
				)
			);
			add_settings_field(
				'pimap_longitude',
				__( 'Longitude', 'pimap' ),
				array( $this, 'text_element_callback' ),
				'pimap_options',
				'pimap_settings_section',
				array(
					'name' => 'pimap_longitude',
					'id' => 'pimap_longitude',
					'class' => 'input_text',
					'settings' => 'pimap_setings_main'
				)
			);
			add_settings_field(
				'pimap_zoom',
				__( 'Zoom', 'pimap' ),
				array( $this, 'text_element_callback' ),
				'pimap_options',
				'pimap_settings_section',
				array(
					'name' => 'pimap_zoom',
					'id' => 'pimap_zoom',
					'class' => 'input_text',
					'settings' => 'pimap_setings_main'
				)
			);

		 	register_setting( 'pimap_settings', 'pimap_setings_main' );
		}

		/**
		 * Callback to create fields of type text
		 *
		 * @param array $args Data required for the creation of the field
		 * @return string HTML field
		 */
		public function text_element_callback( $args ){
			$name = $args['name'];
			$id = $args['id'];
			$class = $args['class'];
			$settings = $args['settings'];
			$valueArr = get_option( $settings, array() );
			if( isset( $valueArr[$name] ) )
				$value = $valueArr[$name];
			else
				$value = '';

			echo sprintf( '<input type="text" id="%2$s" name="%4$s[%1$s]" value="%5$s" class="%3$s" />', $name, $id, $class, $settings, $value );
		}

		/**
		 * Settings page
		 *
		 * @return string
		 */
		public function settings_page() {
			include 'view_options.php';
		}
	}
	new Pimap_Options;