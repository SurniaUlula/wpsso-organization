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
 * Version: 3.2.0-dev.3
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
		private static $ext           = 'wpssoorg';
		private static $p_ext         = 'org';
		private static $notices_shown = false;
		private static $instance      = null;

		public function __construct() {

			require_once dirname( __FILE__ ) . '/lib/config.php';

			WpssoOrgConfig::set_constants( __FILE__ );

			WpssoOrgConfig::require_libs( __FILE__ );	// Includes the register.php class library.

			$this->reg = new WpssoOrgRegister();		// Activate, deactivate, uninstall hooks.

			/**
			 * Add WPSSO filter hooks.
			 */
			add_filter( 'wpsso_get_config', array( __CLASS__, 'wpsso_get_config' ), 10, 2 );
			add_filter( 'wpsso_get_avail', array( __CLASS__, 'wpsso_get_avail' ), 10, 1 );

			/**
			 * Add WPSSO action hooks.
			 */
			add_action( 'wpsso_init_textdomain', array( __CLASS__, 'wpsso_init_textdomain' ) );
			add_action( 'wpsso_init_objects', array( $this, 'wpsso_init_objects' ), 20 );
			add_action( 'wpsso_init_plugin', array( $this, 'wpsso_init_plugin' ), 20 );

			/**
			 * WordPress action hooks.
			 */
			add_action( 'all_admin_notices', array( __CLASS__, 'maybe_show_notices' ) );
		}

		public static function &get_instance() {

			if ( null === self::$instance ) {
				self::$instance = new self;
			}

			return self::$instance;
		}

		/**
		 * Checks the core plugin version and merges the extension / add-on config array.
		 */
		public static function wpsso_get_config( $cf, $plugin_version = 0 ) {

			if ( self::get_missing_requirements() ) {	// Returns false or an array of missing requirements.

				return $cf;	// Stop here.
			}

			return SucomUtil::array_merge_recursive_distinct( $cf, WpssoOrgConfig::$cf );
		}

		/**
		 * The 'wpsso_get_avail' filter is run after the $check property is defined.
		 */
		public static function wpsso_get_avail( $avail ) {

			if ( self::get_missing_requirements() ) {		// Returns false or an array of missing requirements.

				$avail[ 'p_ext' ][ self::$p_ext ] = false;	// Signal that this extension / add-on is not available.

				return $avail;
			}

			$avail[ 'p_ext' ][ self::$p_ext ] = true;		// Signal that this extension / add-on is available.

			return $avail;
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

		public function wpsso_init_objects() {

			$this->p =& Wpsso::get_instance();

			if ( $this->p->debug->enabled ) {
				$this->p->debug->mark();
			}

			if ( self::get_missing_requirements() ) {	// Returns false or an array of missing requirements.

				if ( $this->p->debug->enabled ) {
					$this->p->debug->log( 'exiting early: have missing requirements' );
				}

				return;	// Stop here.
			}

			$this->filters = new WpssoOrgFilters( $this->p );
		}

		/**
		 * All WPSSO objects are instantiated and configured.
		 */
		public function wpsso_init_plugin() {

			$missing_reqs = self::get_missing_requirements();	// Returns false or an array of missing requirements.

			if ( ! $missing_reqs ) {

				return;	// Stop here.
			}

			foreach ( $missing_reqs as $key => $req_info ) {

				if ( ! empty( $req_info[ 'notice' ] ) ) {

					$this->p->notice->err( $req_info[ 'notice' ] );
				}
			}

			self::$notices_shown = true;
		}

		public static function maybe_show_notices() {

			if ( self::$notices_shown ) {	// Nothing to do.
				return;
			}

			$missing_reqs = self::get_missing_requirements();	// Returns false or an array of missing requirements.

			if ( ! $missing_reqs ) {

				return;	// Stop here.
			}

			foreach ( $missing_reqs as $key => $req_info ) {

				if ( ! empty( $req_info[ 'notice' ] ) ) {

					echo '<div class="notice notice-error error"><p>';
					echo $req_info[ 'notice' ];
					echo '</p></div>';
				}
			}
		}

		/**
		 * Returns false or an array of the missing requirements (ie. 'wpsso', 'woocommerce', etc.).
		 */
		private static function get_missing_requirements() {

			static $local_cache = null;

			if ( null !== $local_cache ) {
				return $local_cache;
			}

			$local_cache = array();

			self::wpsso_init_textdomain();	// If not already loaded, load the textdomain now.

			$info = WpssoOrgConfig::$cf[ 'plugin' ][ self::$ext ];

			$notice_missing_transl = __( 'The %1$s version %2$s add-on requires the %3$s plugin &mdash; please activate the missing plugin.',
				'wpsso-organization' );

			$notice_version_transl = __( 'The %1$s version %2$s add-on requires the %3$s version %4$s plugin or newer (version %5$s is currently installed).',
				'wpsso-organization' );

			foreach ( $info[ 'req' ] as $key => $req_info ) {

				if ( ! empty( $req_info[ 'home' ] ) ) {
					$req_name = '<a href="' . $req_info[ 'home' ] . '">' . $req_info[ 'name' ] . '</a>';
				} else {
					$req_name = $req_info[ 'name' ];
				}

				if ( ! empty( $req_info[ 'class' ] ) ) {

					if ( ! class_exists( $req_info[ 'class' ] ) ) {

						$req_info[ 'notice' ] = sprintf( $notice_missing_transl, $info[ 'name' ], $info[ 'version' ], $req_name );
					}
				}


				if ( ! empty( $req_info[ 'version_const' ] ) ) {

					if ( defined( $req_info[ 'version_const' ] ) ) {

						$req_info[ 'version' ] = constant( $req_info[ 'version_const' ] );

						if ( ! empty( $req_info[ 'min_version' ] ) ) {

							if ( version_compare( $req_info[ 'version' ], $req_info[ 'min_version' ], '<' ) ) {

								$req_info[ 'notice' ] = sprintf( $notice_version_transl, $info[ 'name' ], $info[ 'version' ],
									$req_name, $req_info[ 'min_version' ], $req_info[ 'version' ] );
							}
						}
					}
				}

				if ( ! empty( $req_info[ 'notice' ] ) ) {

					$local_cache[ $key ] = $req_info;
				}
			}

			if ( empty( $local_cache ) ) {

				$local_cache = false;
			}

			return $local_cache;
		}
	}

        global $wpssoorg;

	$wpssoorg =& WpssoOrg::get_instance();
}
