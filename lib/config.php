<?php
/**
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl.txt
 * Copyright 2014-2018 Jean-Sebastien Morisset (https://wpsso.com/)
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( 'These aren\'t the droids you\'re looking for...' );
}

if ( ! class_exists( 'WpssoOrgConfig' ) ) {

	class WpssoOrgConfig {

		public static $cf = array(
			'plugin' => array(
				'wpssoorg' => array(			// Plugin acronym.
					'version' => '1.1.8-rc.1',		// Plugin version.
					'opt_version' => '3',		// Increment when changing default option values.
					'short' => 'WPSSO ORG',		// Short plugin name.
					'name' => 'WPSSO Organization Markup',
					'desc' => 'WPSSO Core extension to manage Organizations and additional Schema Article / Event properties (Publisher, Organizer, Performer, etc.).',
					'slug' => 'wpsso-organization',
					'base' => 'wpsso-organization/wpsso-organization.php',
					'update_auth' => 'tid',
					'text_domain' => 'wpsso-organization',
					'domain_path' => '/languages',
					'req' => array(
						'short' => 'WPSSO',
						'name' => 'WPSSO Core',
						'min_version' => '3.53.0-rc.1',
					),
					'img' => array(
						'icons' => array(
							'low' => 'images/icon-128x128.png',
							'high' => 'images/icon-256x256.png',
						),
					),
					'lib' => array(
						'submenu' => array(	// Note that submenu elements must have unique keys.
							'org-general' => 'Organization',
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
		);

		public static function get_version( $add_slug = false ) {
			$ext = 'wpssoorg';
			$info =& self::$cf['plugin'][$ext];
			return $add_slug ? $info['slug'].'-'.$info['version'] : $info['version'];
		}

		public static function set_constants( $plugin_filepath ) { 
			if ( defined( 'WPSSOORG_VERSION' ) ) {			// execute and define constants only once
				return;
			}
			define( 'WPSSOORG_VERSION', self::$cf['plugin']['wpssoorg']['version'] );						
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
			if ( false === $ret && ! empty( $filespec ) ) {
				$filepath = WPSSOORG_PLUGINDIR.'lib/'.$filespec.'.php';
				if ( file_exists( $filepath ) ) {
					require_once $filepath;
					if ( empty( $classname ) ) {
						return SucomUtil::sanitize_classname( 'wpssoorg'.$filespec, false );	// $underscore = false
					} else {
						return $classname;
					}
				}
			}
			return $ret;
		}
	}
}

