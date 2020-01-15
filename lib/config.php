<?php
/**
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl.txt
 * Copyright 2014-2020 Jean-Sebastien Morisset (https://wpsso.com/)
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( 'These aren\'t the droids you\'re looking for.' );
}

if ( ! class_exists( 'WpssoOrgConfig' ) ) {

	class WpssoOrgConfig {

		public static $cf = array(
			'plugin' => array(
				'wpssoorg' => array(			// Plugin acronym.
					'version'     => '2.2.0-b.1',	// Plugin version.
					'opt_version' => '3',		// Increment when changing default option values.
					'short'       => 'WPSSO ORG',	// Short plugin name.
					'name'        => 'WPSSO Organization Markup',
					'desc'        => 'Customize home page Schema Organization markup and manage additional Organizations (publisher, organizer, etc.).',
					'slug'        => 'wpsso-organization',
					'base'        => 'wpsso-organization/wpsso-organization.php',
					'update_auth' => 'tid',
					'text_domain' => 'wpsso-organization',
					'domain_path' => '/languages',
					'req'         => array(
						'short'       => 'WPSSO Core',
						'name'        => 'WPSSO Core',
						'min_version' => '6.17.0',
					),
					'assets' => array(
						'icons' => array(
							'low'  => 'images/icon-128x128.png',
							'high' => 'images/icon-256x256.png',
						),
					),
					'lib' => array(
						'pro' => array(
							'admin' => array(
								'org-general' => 'Extend Organization Settings',
							),
						),
						'std' => array(
							'admin' => array(
								'org-general' => 'Extend Organization Settings',
							),
						),
						'submenu' => array(
							'org-general' => 'Organizations',
						),
					),
				),
			),
			'opt' => array(
				'defaults' => array(
					'org_id' => 0,
				),
			),
		);

		public static function get_version( $add_slug = false ) {

			$info =& self::$cf[ 'plugin' ][ 'wpssoorg' ];

			return $add_slug ? $info[ 'slug' ] . '-' . $info[ 'version' ] : $info[ 'version' ];
		}

		public static function set_constants( $plugin_file_path ) { 

			if ( defined( 'WPSSOORG_VERSION' ) ) {	// Define constants only once.
				return;
			}

			$info =& self::$cf[ 'plugin' ][ 'wpssoorg' ];

			/**
			 * Define fixed constants.
			 */
			define( 'WPSSOORG_FILEPATH', $plugin_file_path );						
			define( 'WPSSOORG_PLUGINBASE', $info[ 'base' ] );	// Example: wpsso-organization/wpsso-organization.php
			define( 'WPSSOORG_PLUGINDIR', trailingslashit( realpath( dirname( $plugin_file_path ) ) ) );
			define( 'WPSSOORG_PLUGINSLUG', $info[ 'slug' ] );	// Example: wpsso-organization
			define( 'WPSSOORG_URLPATH', trailingslashit( plugins_url( '', $plugin_file_path ) ) );
			define( 'WPSSOORG_VERSION', $info[ 'version' ] );						

			define( 'WPSSOORG_CATEGORY_TAXONOMY', 'org_category' );
			define( 'WPSSOORG_ORGANIZATION_POST_TYPE', 'organization' );

			/**
			 * Define variable constants.
			 */
			self::set_variable_constants();
		}

		public static function set_variable_constants( $var_const = null ) {

			if ( null === $var_const ) {
				$var_const = self::get_variable_constants();
			}

			/**
			 * Define the variable constants, if not already defined.
			 */
			foreach ( $var_const as $name => $value ) {

				if ( ! defined( $name ) ) {
					define( $name, $value );
				}
			}
		}

		public static function get_variable_constants() { 

			$var_const = array();

			/**
			 * Maybe override the default constant value with a pre-defined constant value.
			 */
			foreach ( $var_const as $name => $value ) {

				if ( defined( $name ) ) {
					$var_const[$name] = constant( $name );
				}
			}

			return $var_const;
		}

		public static function require_libs( $plugin_file_path ) {

			require_once WPSSOORG_PLUGINDIR . 'lib/filters.php';
			require_once WPSSOORG_PLUGINDIR . 'lib/organization.php';
			require_once WPSSOORG_PLUGINDIR . 'lib/register.php';

			add_filter( 'wpssoorg_load_lib', array( 'WpssoOrgConfig', 'load_lib' ), 10, 3 );
		}

		public static function load_lib( $ret = false, $filespec = '', $classname = '' ) {

			if ( false === $ret && ! empty( $filespec ) ) {

				$file_path = WPSSOORG_PLUGINDIR . 'lib/' . $filespec . '.php';

				if ( file_exists( $file_path ) ) {

					require_once $file_path;

					if ( empty( $classname ) ) {
						return SucomUtil::sanitize_classname( 'wpssoorg' . $filespec, $allow_underscore = false );
					} else {
						return $classname;
					}
				}
			}

			return $ret;
		}
	}
}

