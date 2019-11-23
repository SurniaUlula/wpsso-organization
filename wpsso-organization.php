<?php
/**
 * Plugin Name: WPSSO Organization Markup
 * Plugin Slug: wpsso-organization
 * Text Domain: wpsso-organization
 * Domain Path: /languages
 * Plugin URI: https://wpsso.com/extend/plugins/wpsso-organization/
 * Assets URI: https://surniaulula.github.io/wpsso-organization/assets/
 * Author: JS Morisset
 * Author URI: https://wpsso.com/
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl.txt
 * Description: Customize home page Schema Organization markup and manage additional Organizations (publisher, organizer, etc.).
 * Requires At Least: 3.9
 * Tested Up To: 5.3
 * Version: 2.1.7-rc.1
 * 
 * Version Numbering: {major}.{minor}.{bugfix}[-{stage}.{level}]
 *
 *      {major}         Major structural code changes / re-writes or incompatible API changes.
 *      {minor}         New functionality was added or improved in a backwards-compatible manner.
 *      {bugfix}        Backwards-compatible bug fixes or small improvements.
 *      {stage}.{level} Pre-production release: dev < a (alpha) < b (beta) < rc (release candidate).
 * 
 * Copyright 2014-2019 Jean-Sebastien Morisset (https://wpsso.com/)
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( 'These aren\'t the droids you\'re looking for.' );
}

if ( ! class_exists( 'WpssoOrg' ) ) {

	class WpssoOrg {

		/**
		 * Wpsso plugin class object variable.
		 */
		public $p;		// Wpsso

		/**
		 * Library class object variables.
		 */
		public $filters;	// WpssoOrgFilters
		public $reg;		// WpssoOrgRegister

		/**
		 * Reference Variables (config, options, modules, etc.).
		 */
		private $have_req_min = true;	// Have minimum wpsso version.

		private static $instance;

		public function __construct() {

			require_once dirname( __FILE__ ) . '/lib/config.php';

			WpssoOrgConfig::set_constants( __FILE__ );

			WpssoOrgConfig::require_libs( __FILE__ );	// Includes the register.php class library.

			$this->reg = new WpssoOrgRegister();		// activate, deactivate, uninstall hooks

			if ( is_admin() ) {
				add_action( 'admin_init', array( __CLASS__, 'required_check' ) );
			}

			/**
			 * Add WPSSO filter hooks.
			 */
			add_filter( 'wpsso_get_config', array( $this, 'wpsso_get_config' ), 20, 2 );	// Checks core version and merges config array.

			/**
			 * Add WPSSO action hooks.
			 */
			add_action( 'wpsso_init_textdomain', array( __CLASS__, 'wpsso_init_textdomain' ) );
			add_action( 'wpsso_init_options', array( $this, 'wpsso_init_options' ), 20 );	// Sets the $this->p reference variable.
			add_action( 'wpsso_init_objects', array( $this, 'wpsso_init_objects' ), 20 );
			add_action( 'wpsso_init_plugin', array( $this, 'wpsso_init_plugin' ), 20 );
		}

		public static function &get_instance() {

			if ( ! isset( self::$instance ) ) {
				self::$instance = new self;
			}

			return self::$instance;
		}

		public static function required_check() {

			if ( ! class_exists( 'Wpsso' ) ) {
				add_action( 'all_admin_notices', array( __CLASS__, 'required_notice' ) );
			}
		}

		public static function required_notice() {

			self::wpsso_init_textdomain();

			$info = WpssoOrgConfig::$cf[ 'plugin' ][ 'wpssoorg' ];

			$error_msg = __( 'The %1$s add-on requires the %2$s plugin &mdash; install and activate the %3$s plugin or <a href="%4$s">deactivate the %5$s add-on</a>.', 'wpsso-organization' );

			$deactivate_url = html_entity_decode( wp_nonce_url( add_query_arg( array(
				'action'        => 'deactivate',
				'plugin'        => $info[ 'base' ],
				'plugin_status' => 'all',
				'paged'         => 1,
				's'             => '',
			), admin_url( 'plugins.php' ) ), 'deactivate-plugin_' . $info[ 'base' ] ) );

			echo '<div class="notice notice-error error"><p>';
			echo sprintf( $error_msg, $info[ 'name' ], $info[ 'req' ][ 'name' ], $info[ 'req' ][ 'short' ], $deactivate_url, $info[ 'short' ] );
			echo '</p></div>';
		}

		public static function wpsso_init_textdomain() {

			load_plugin_textdomain( 'wpsso-organization', false, 'wpsso-organization/languages/' );
		}

		/**
		 * Checks the core plugin version and merges the extension / add-on config array.
		 */
		public function wpsso_get_config( $cf, $plugin_version = 0 ) {

			$info = WpssoOrgConfig::$cf[ 'plugin' ][ 'wpssoorg' ];

			if ( version_compare( $plugin_version, $info[ 'req' ][ 'min_version' ], '<' ) ) {

				$this->have_req_min = false;

				return $cf;
			}

			return SucomUtil::array_merge_recursive_distinct( $cf, WpssoOrgConfig::$cf );
		}

		/**
		 * Sets the $this->p reference variable for the core plugin instance.
		 */
		public function wpsso_init_options() {

			$this->p =& Wpsso::get_instance();

			if ( $this->p->debug->enabled ) {
				$this->p->debug->mark();
			}

			if ( ! $this->have_req_min ) {

				$this->p->avail[ 'p_ext' ][ 'org' ] = false;	// Signal that this extension / add-on is not available.

				return;
			}

			$this->p->avail[ 'p_ext' ][ 'org' ] = true;		// Signal that this extension / add-on is available.
		}

		public function wpsso_init_objects() {

			if ( $this->p->debug->enabled ) {
				$this->p->debug->mark();
			}

			if ( ! $this->have_req_min ) {
				return;	// Stop here.
			}

			$this->filters = new WpssoOrgFilters( $this->p );
		}

		public function wpsso_init_plugin() {

			if ( $this->p->debug->enabled ) {
				$this->p->debug->mark();
			}

			if ( ! $this->have_req_min ) {

				$this->min_version_notice();

				return;	// Stop here.
			}
		}

		private function min_version_notice() {

			if ( ! is_admin() ) {
				return;
			}

			$info = WpssoOrgConfig::$cf[ 'plugin' ][ 'wpssoorg' ];

			$error_msg = sprintf( __( 'The %1$s version %2$s add-on requires %3$s version %4$s or newer (version %5$s is currently installed).',
				'wpsso-organization' ), $info[ 'name' ], $info[ 'version' ], $info[ 'req' ][ 'short' ], $info[ 'req' ][ 'min_version' ],
					$this->p->cf[ 'plugin' ][ 'wpsso' ][ 'version' ] );

			$this->p->notice->err( $error_msg );

			if ( method_exists( $this->p->admin, 'get_check_for_updates_link' ) ) {

				$update_msg = $this->p->admin->get_check_for_updates_link();

				if ( ! empty( $update_msg ) ) {
					$this->p->notice->inf( $update_msg );
				}
			}
		}
	}

        global $wpssoorg;

	$wpssoorg =& WpssoOrg::get_instance();
}
