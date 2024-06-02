<?php
/*
Plugin Name: Script Adder wordpress plugin
Plugin URI: https://github.com/sharmaasahill/script-adder-wp-plugin
Description: This plugin integrates your scripts to your theme.
*/

if(!class_exists('AddScripts')) {
	class AddScripts 
	{
		private static $instance;

		private function __construct()
		{
			$this->constants();	// Defines any constants used in the plugin
			$this->init();	// Sets up all the actions and filters
		}

		public static function getInstance()
		{
			if ( !self::$instance ) {
				self::$instance = new AddScripts();
			}

			return self::$instance;
		}

		private function constants()
		{
			define( 'ADD_SCRIPTS_TEXT_DOMAIN', 'Add Scripts' );
			define( 'ADD_SCRIPTS_SETTING_GET_PARAM', 'add-scripts-settings');
			define( 'ADD_SCRIPTS_INPUTS_PREFIX', 'add_scripts_' );
			define( 'ADD_SCRIPTS_SCRIPTS_PREFIX', 'add_scripts_');
			define( 'ADD_SCRIPTS_INPUTS_GROUP', 'add-scripts-update-options');
		}

		private function init()
		{
			// Register the options with the settings API
			add_action( 'admin_init', array( $this, 'admin_init' ) );

			// Public init
			add_action( 'init', array( $this, 'public_init' ) );

			// Add the menu page
			add_action( 'admin_menu', array( $this, 'setup_admin' ) );

			// admin scripts
			add_action('admin_enqueue_scripts', array($this, 'load_admin_assets'));
		}

		public function public_init()
		{
			add_action( 'wp_head', array($this, 'add_scripts'), 10 );
		}

		public function load_admin_assets($hook)
		{
			$current_screen = get_current_screen();
			if (strpos($current_screen->base, ADD_SCRIPTS_SETTING_GET_PARAM) === false) {
				return;
			}
			wp_enqueue_style(ADD_SCRIPTS_SCRIPTS_PREFIX.'boot_core_css', plugins_url('Includes/Admin/core.css', __FILE__ ));
			wp_enqueue_style(ADD_SCRIPTS_SCRIPTS_PREFIX.'boot_admin_css', plugins_url('Includes/Admin/admin.css', __FILE__ ));
			wp_enqueue_script(ADD_SCRIPTS_SCRIPTS_PREFIX.'boot_admin_js', plugins_url('Includes/Admin/admin.js', __FILE__ ), array(), false, true);
		}

		/**
		 * Add scripts code if has in settings
		 */
		public function add_scripts()
		{
			if(get_option( ADD_SCRIPTS_INPUTS_PREFIX.'scripts' ) 
				&& trim(get_option( ADD_SCRIPTS_INPUTS_PREFIX.'scripts' )) != '') {
				
				// echo to theme
				echo get_option( ADD_SCRIPTS_INPUTS_PREFIX.'scripts' );
			}
		}

		public function admin_init()
		{
			if (!is_admin()) {
				wp_die( __( 'This code is for admin area only' ) );
			}
			
			register_setting( ADD_SCRIPTS_INPUTS_GROUP, ADD_SCRIPTS_INPUTS_PREFIX.'scripts' );
		}

		public function setup_admin()
		{
			// add settings page
			add_options_page( __( 'Add Scripts Plugin', ADD_SCRIPTS_TEXT_DOMAIN ), __( 'Add Scripts', ADD_SCRIPTS_TEXT_DOMAIN ), 'administrator', ADD_SCRIPTS_SETTING_GET_PARAM, array( $this, 'admin_page' ) );
		}

		/**
		 * Admin settings page
		 */
		public function admin_page() 
		{
			require 'Includes/Admin/SettingsForm.php';
		}
	}

	$s = AddScripts::getInstance();
}
