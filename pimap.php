<?php
	/**
	 * Plugin Name: Pimap
	 * Plugin URI: 
	 * Description: Create and register pins google maps with comments, pictures and videos
	 * Author: leobaiano
	 * Author URI: http://lbideias.com.br
	 * Version: 1.0.0
	 * License: GPLv2 or later
	 * Text Domain: pimap
 	 * Domain Path: /languages/
	 */

	if ( ! defined( 'ABSPATH' ) )
		exit; // Exit if accessed directly.

	/**
	 * Pimap
	 *
	 * @package  Social_Count_Plus/Admin
	 * @category Admin
	 * @author   Leo Baiano <leobaiano@lbideias.com.br>
	 */
	class Pimap {

		/**
		 * Instance of this class.
		 *
		 * @var object
		 */
		protected static $instance = null;

		/**
		 * Initialize the plugin
		 */
		private function __construct() {
			// Require class Odin
			if( is_admin() ){
				$this->require_odin();
				$this->require_admin();
			}

			// Load plugin text domain
			add_action( 'init', array( $this, 'load_plugin_textdomain' ) );

			// Create and load Pin post type
			add_action( 'init', array( $this, 'create_pin_post_type' ), 1 );

			// Create and load taxonomy Pin Type
			add_action( 'init', array( $this, 'create_pin_type_taxonomy' ), 1 );

			// Create and load metabox Position Pin
			add_action( 'init', array( $this, 'create_metabox_position' ), 1 );

			// Include map in metabox position
			add_action( 'odin_metabox_header_pin_position', array( $this, 'create_map_metabox' ) );

			// Load styles and script
			add_action( 'admin_enqueue_scripts', array( $this, 'load_admin_styles_and_scripts' ) );
		}

		/**
		 * Return an instance of this class.
		 *
		 * @return object A single instance of this class.
		 */
		public static function get_instance() {
			// If the single instance hasn't been set, set it now.
			if ( null == self::$instance ) {
				self::$instance = new self;
			}

			return self::$instance;
		}

		/**
		 * Load the plugin text domain for translation.
		 *
		 * @return void
		 */
		public function load_plugin_textdomain() {
			$locale = apply_filters( 'plugin_locale', get_locale(), 'pimap' );

			load_textdomain( 'pimap', trailingslashit( WP_LANG_DIR ) . 'pimap/pimap-' . $locale . '.mo' );
			load_plugin_textdomain( 'pimap', FALSE, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
		}

		/**
		 * Require classes Odin framework
		 */
		protected function require_odin() {
			require_once 'Odin/core/classes/class-post-type.php';
			require_once 'Odin/core/classes/class-taxonomy.php';
			require_once 'Odin/core/classes/class-metabox.php';
		}

		/**
		 * Require classes admin
		 */
		protected function require_admin() {
			require_once 'admin/class-pimap-options.php';
		}

		/**
		 * Creates the post pin type that is used to add posts
		 *
		 */
		public function create_pin_post_type(){
			$obj_pin = new Odin_Post_Type(
			    'Pin',
			    'pin'
			);
			$obj_pin->set_arguments(
			    array(
			        'supports' => array( 'title', 'excerpt', 'thumbnail' )
			    )
			);
			$obj_pin->set_labels(
			    array(
			        'name' => __( 'Pimap', 'pimap' ),
		            'singular_name' => __( 'Pimap', 'pimap' ),
		            'add_new' => __( 'Add New', 'pimap' ),
		            'add_new_item' => __( 'Add New', 'pimap' ),
		            'edit_item' => __( 'Edit', 'pimap' ),
		            'new_item' => __( 'New', 'pimap' ),
		            'view_item' => __( 'View', 'pimap' ),
		            'search_items' => __( 'Search', 'pimap' ),
		            'not_found' => __( 'Not found', 'pimap' ),
		            'not_found_in_trash' => __( 'Not found in trash', 'pimap' ),
		            'parent_item_colon' => __( 'Parent:', 'pimap' ),
		            'menu_name' => __( 'Pimap', 'pimap' ),
			    )
			);
		}

		/**
		 * Create taxonomy Pin type
		 *
		 */
		public function create_pin_type_taxonomy(){
		    $obj_pin_type = new Odin_Taxonomy(
		        'Pin Type',
		        'pin-type', // Slug do Taxonomia.
		        'pin'
		    );

		    $obj_pin_type->set_labels(
		        array(
		            'menu_name' => __( 'Pin Type', 'pimap' )
		        )
		    );

		    $obj_pin_type->set_arguments(
		        array(
		            'hierarchical' => false
		        )
		    );
		}

		/**
		 * Create metabox position pin in google maps
		 *
		 */
		public function create_metabox_position(){
			$obj_position = new Odin_Metabox(
		        'pin_position',
		        __( 'Pin Position', 'pimap' ),
		        'pin',
		        'normal',
		        'default'
		    );

			$obj_position->set_fields(
	    		array(
				    array(
					    'id'          => 'pin_latitude',
					    'label'       => __( 'Latitude', 'pimap' ),
					    'type'        => 'text',
					    'attributes'  => array(
					        'placeholder' => __( 'Latitude', 'pimap' )
					    ),
					    'default'     => '',
					    'description' => '',
					),
					array(
					    'id'          => 'pin_longitude',
					    'label'       => __( 'Longitude', 'pimap' ),
					    'type'        => 'text',
					    'attributes'  => array(
					        'placeholder' => __( 'Longitude', 'pimap' )
					    ),
					    'default'     => '',
					    'description' => '',
					)
				)
			);
		}

		/**
		 * Include google maps in metabox position
		 *
		 * @param int $post_id
		 * @return object map
		 */
		public function create_map_metabox() {
		    echo '<div id="pimap_gMaps" class="pimap_maps" style="height:500px; width: 100%"></div>';
		}

		/**
		 * Load styles and scripts
		 *
		 */
		public function load_admin_styles_and_scripts(){
			global $post_type;

			if( 'pin' == $post_type ){
				wp_enqueue_script( 'pimap_gmaps_api', 'https://maps.google.com/maps/api/js?sensor=false', array(), null, true );
				wp_enqueue_script( 'pimap_gmaps_script', plugins_url( '/assets/js/gmaps.js', __FILE__ ), array(), null, true );

				$latitude = '';
				$longitude = '';
				$zoom = '';
				$valueArr = get_option( 'pimap_setings_main', array() );
				if( isset( $valueArr['pimap_latitude'] ) )
					$latitude = $valueArr['pimap_latitude'];
				if( isset( $valueArr['pimap_longitude'] ) )
					$longitude = $valueArr['pimap_longitude'];
				if( isset( $valueArr['pimap_zoom'] ) )
					$zoom = $valueArr['pimap_zoom'];

				$params = array(
								'latitude' => $latitude,
								'longitude' => $longitude,
								'zoom' => $zoom
							);


				wp_localize_script( 'pimap_gmaps_script', 'data_pimap', $params );
			}
		}
	}

	add_action( 'plugins_loaded', array( 'Pimap', 'get_instance' ), 0 );