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
 * Description: Customize the Home Page Schema Organization Markup and Manage Additional Organizations (Publisher, Organizer, etc.).
 * Requires PHP: 5.6
 * Requires At Least: 4.2
 * Tested Up To: 5.4.1
 * Version: 3.1.0
 * 
 * Version Numbering: {major}.{minor}.{bugfix}[-{stage}.{level}]
 *
 *      {major}         Major structural code changes / re-writes or incompatible API changes.
 *      {minor}         New functionality was added or improved in a backwards-compatible manner.
 *      {bugfix}        Backwards-compatible bug fixes or small improvements.
 *      {stage}.{level} Pre-production release: dev < a (alpha) < b (beta) < rc (release candidate).
 * 
 * Copyright 2014-2020 Jean-Sebastien Morisset (https://wpsso.com/)
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
		private $have_wpsso_min_version = true;	// Have WPSSO Core minimum version.

		private static $ext      = 'wpssoorg';
		private static $p_ext    = 'org';
		private static $info     = array();
		private static $instance = null;

		public function __construct() {

			require_once dirname( __FILE__ ) . '/lib/config.php';

			WpssoOrgConfig::set_constants( __FILE__ );

			WpssoOrgConfig::require_libs( __FILE__ );	// Includes the register.php class library.

			$this->reg = new WpssoOrgRegister();		// Activate, deactivate, uninstall hooks.

			/**
			 * Check for required plugins and show notices.
			 */
			add_action( 'all_admin_notices', array( __CLASS__, 'show_required_notices' ) );

			/**
			 * Add WPSSO filter hooks.
			 */
			add_filter( 'wpsso_get_config', array( $this, 'wpsso_get_config' ), 20, 2 );	// Checks core version and merges config array.
			add_filter( 'wpsso_get_avail', array( $this, 'wpsso_get_avail' ), 10, 1 );

			/**
			 * Add WPSSO action hooks.
			 */
			add_action( 'wpsso_init_textdomain', array( __CLASS__, 'wpsso_init_textdomain' ) );
			add_action( 'wpsso_init_objects', array( $this, 'wpsso_init_objects' ), 20 );
			add_action( 'wpsso_init_plugin', array( $this, 'wpsso_init_plugin' ), 20 );
		}

		public static function &get_instance() {

			if ( null === self::$instance ) {
				self::$instance = new self;
			}

			return self::$instance;
		}

		/**
		 * Check for required plugins and show notices.
		 */
		public static function show_required_notices() {

			$missing_requirements = self::get_missing_requirements();	// Returns false or an array of missing requirements.

			if ( ! $missing_requirements ) {
				return;	// Stop here.
			}

			self::wpsso_init_textdomain();	// If not already loaded, load the textdomain now.

			$info = WpssoOrgConfig::$cf[ 'plugin' ][ self::$ext ];

			$notice_msg = __( 'The %1$s add-on requires the %2$s plugin &mdash; please install and activate the missing plugin.',
				'wpsso-organization' );

			foreach ( $missing_requirements as $key => $req_info ) {

				echo '<div class="notice notice-error error"><p>';

				echo sprintf( $notice_msg, $info[ 'name' ], $req_info[ 'name' ] );

				echo '</p></div>';
			}
		}

		/**
		 * Returns false or an array of the missing requirements (ie. 'wpsso', 'woocommerce', etc.).
		 */
		public static function get_missing_requirements() {

			static $local_cache = null;

			if ( null !== $local_cache ) {
				return $local_cache;
			}

			$local_cache = array();

			$info = WpssoOrgConfig::$cf[ 'plugin' ][ self::$ext ];

			foreach ( $info[ 'req' ] as $key => $req_info ) {

				if ( isset( $req_info[ 'class' ] ) ) {

					if ( class_exists( $req_info[ 'class' ] ) ) {
						continue;	// Requirement satisfied.
					}

				} else {
					continue;	// Nothing to check.
				}

				$local_cache[ $key ] = $req_info;
			}

			if ( empty( $local_cache ) ) {
				$local_cache = false;
			}

			return $local_cache;
		}

		/**
		 * The 'wpsso_init_textdomain' action is run after the $check, $avail, and $debug properties are defined.
		 */
		public static function wpsso_init_textdomain( $debug_enabled = false ) {

			static $loaded = null;

			if ( null !== $loaded ) {
				return;
			}

			$loaded = true;

			load_plugin_textdomain( 'wpsso-organization', false, 'wpsso-organization/languages/' );
		}

		/**
		 * Checks the core plugin version and merges the extension / add-on config array.
		 */
		public function wpsso_get_config( $cf, $plugin_version = 0 ) {

			$info = WpssoOrgConfig::$cf[ 'plugin' ][ self::$ext ];

			$req_info = $info[ 'req' ][ 'wpsso' ];

			if ( version_compare( $plugin_version, $req_info[ 'min_version' ], '<' ) ) {

				$this->have_wpsso_min_version = false;

				return $cf;
			}

			return SucomUtil::array_merge_recursive_distinct( $cf, WpssoOrgConfig::$cf );
		}

		/**
		 * The 'wpsso_get_avail' filter is run after the $check property is defined.
		 */
		public function wpsso_get_avail( $avail ) {

			if ( ! $this->have_wpsso_min_version ) {

				$avail[ 'p_ext' ][ self::$p_ext ] = false;	// Signal that this extension / add-on is not available.

				return $avail;
			}

			$avail[ 'p_ext' ][ self::$p_ext ] = true;		// Signal that this extension / add-on is available.

			return $avail;
		}

		public function wpsso_init_objects() {

			$this->p =& Wpsso::get_instance();

			if ( $this->p->debug->enabled ) {
				$this->p->debug->mark();
			}

			if ( ! $this->have_wpsso_min_version ) {

				if ( $this->p->debug->enabled ) {
					$this->p->debug->log( 'exiting early: have_wpsso_min_version is false' );
				}

				return;	// Stop here.
			}

			$this->filters = new WpssoOrgFilters( $this->p );
		}

		/**
		 * All WPSSO objects are instantiated and configured.
		 */
		public function wpsso_init_plugin() {

			if ( $this->p->debug->enabled ) {
				$this->p->debug->mark();
			}

			if ( ! $this->have_wpsso_min_version ) {

				$this->min_version_notice();	// Show minimum version notice.

				return;	// Stop here.
			}
		}

		private function min_version_notice() {

			$info = WpssoOrgConfig::$cf[ 'plugin' ][ self::$ext ];

			$req_info = $info[ 'req' ][ 'wpsso' ];

			if ( is_admin() ) {

				$notice_msg = sprintf( __( 'The %1$s version %2$s add-on requires %3$s version %4$s or newer (version %5$s is currently installed).',
					'wpsso-organization' ), $info[ 'name' ], $info[ 'version' ], $req_info[ 'name' ], $req_info[ 'min_version' ],
						$this->p->cf[ 'plugin' ][ 'wpsso' ][ 'version' ] );

				$this->p->notice->err( $notice_msg );

				if ( method_exists( $this->p->admin, 'get_check_for_updates_link' ) ) {
	
					$update_msg = $this->p->admin->get_check_for_updates_link();

					if ( ! empty( $update_msg ) ) {
						$this->p->notice->inf( $update_msg );
					}
				}

			} else {

				if ( $this->p->debug->enabled ) {
					$this->p->debug->log( sprintf( '%1$s version %2$s requires %3$s version %4$s or newer',
						$info[ 'name' ], $info[ 'version' ], $req_info[ 'name' ], $req_info[ 'min_version' ] ) );
				}
			}
		}
	}

        global $wpssoorg;

	$wpssoorg =& WpssoOrg::get_instance();
}
