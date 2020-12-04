<?php
/**
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl.txt
 * Copyright 2014-2020 Jean-Sebastien Morisset (https://wpsso.com/)
 */

if ( ! defined( 'ABSPATH' ) ) {

	die( 'These aren\'t the droids you\'re looking for.' );
}

if ( ! class_exists( 'WpssoOrgFiltersUpgrade' ) ) {

	class WpssoOrgFiltersUpgrade {

		private $p;	// Wpsso class object.
		private $a;	// WpssoOrg class object.

		/**
		 * Instantiated by WpssoOrgFilters->__construct().
		 */
		public function __construct( &$plugin, &$addon ) {

			$this->p =& $plugin;
			$this->a =& $addon;

			$this->p->util->add_plugin_filters( $this, array( 
				'rename_options_keys'        => 1,
			) );
		}

		public function filter_rename_options_keys( $options_keys ) {

			$options_keys[ 'wpssoorg' ] = array(
				2 => array(
					'org_alt_name' => 'org_name_alt',
				),
			);

			return $options_keys;
		}
	}
}
