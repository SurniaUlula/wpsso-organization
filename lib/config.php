<?php
/*
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl.txt
 * Copyright 2014-2017 Jean-Sebastien Morisset (https://surniaulula.com/)
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( 'These aren\'t the droids you\'re looking for...' );
}

if ( ! class_exists( 'WpssoOrgConfig' ) ) {

	class WpssoOrgConfig {

		public static $cf = array(
			'plugin' => array(
				'wpssoorg' => array(
					'version' => '1.1.0-b.1',		// plugin version
					'opt_version' => '2',		// increment when changing default options
					'short' => 'WPSSO ORG',		// short plugin name
					'name' => 'WPSSO Organization Markup',
					'desc' => 'WPSSO extension to manage Organizations and additional Schema Article / Event properties (Publisher, Organizer, Performer, etc.).',
					'slug' => 'wpsso-organization',
					'base' => 'wpsso-organization/wpsso-organization.php',
					'update_auth' => 'tid',
					'text_domain' => 'wpsso-organization',
					'domain_path' => '/languages',
					'req' => array(
						'short' => 'WPSSO',
						'name' => 'WPSSO',
						'min_version' => '3.42.0',
					),
					'img' => array(
						'icons' => array(
							'low' => 'images/icon-128x128.png',
							'high' => 'images/icon-256x256.png',
						),
					),
					'lib' => array(
						// submenu items must have unique keys
						'submenu' => array (
							'org-general' => 'Organization',	// general settings
						),
						'gpl' => array(
							'admin' => array(
								'org-general' => 'Organization Settings',
							),
						),
						'pro' => array(
							'admin' => array(
								'org-general' => 'Organization Settings',
							),
						),
					),
				),
			),
			'form' => array(
				'org_select' => array(
					'none' => '[None]',
					'new' => '[New Organization]',
				),
			),
		);

		public static function get_version() { 
			return self::$cf['plugin']['wpssoorg']['version'];
		}

		public static function set_constants( $plugin_filepath ) { 
			define( 'WPSSOORG_FILEPATH', $plugin_filepath );						
			define( 'WPSSOORG_PLUGINDIR', trailingslashit( realpath( dirname( $plugin_filepath ) ) ) );
			define( 'WPSSOORG_PLUGINSLUG', self::$cf['plugin']['wpssoorg']['slug'] );	// wpsso-organization
			define( 'WPSSOORG_PLUGINBASE', self::$cf['plugin']['wpssoorg']['base'] );	// wpsso-organization/wpsso-organization.php
			define( 'WPSSOORG_URLPATH', trailingslashit( plugins_url( '', $plugin_filepath ) ) );
		}

		public static function require_libs( $plugin_filepath ) {

			require_once WPSSOORG_PLUGINDIR.'lib/register.php';
			require_once WPSSOORG_PLUGINDIR.'lib/filters.php';
			require_once WPSSOORG_PLUGINDIR.'lib/organization.php';

			add_filter( 'wpssoorg_load_lib', array( 'WpssoOrgConfig', 'load_lib' ), 10, 3 );
		}

		public static function load_lib( $ret = false, $filespec = '', $classname = '' ) {
			if ( $ret === false && ! empty( $filespec ) ) {
				$filepath = WPSSOORG_PLUGINDIR.'lib/'.$filespec.'.php';
				if ( file_exists( $filepath ) ) {
					require_once $filepath;
					if ( empty( $classname ) )
						return SucomUtil::sanitize_classname( 'wpssoorg'.$filespec, false );	// $underscore = false
					else return $classname;
				}
			}
			return $ret;
		}
	}
}

?>
