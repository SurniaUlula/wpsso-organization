<?php
/*
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl.txt
 * Copyright 2014-2017 Jean-Sebastien Morisset (https://surniaulula.com/)
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( 'These aren\'t the droids you\'re looking for...' );
}

if ( ! class_exists( 'WpssoOrgOrganization' ) ) {

	class WpssoOrgOrganization {

		private $p;

		public function __construct( &$plugin ) {
			$this->p =& $plugin;
			if ( $this->p->debug->enabled )
				$this->p->debug->mark();
		}

		public static function get_org_names( $parent_type = false ) {

			$wpsso =& Wpsso::get_instance();
			if ( $wpsso->debug->enabled )
				$wpsso->debug->mark();

			if ( $wpsso->check->aop( 'wpssoorg', true, $wpsso->is_avail['aop'] ) )
				$org_names = SucomUtil::get_multi_key_locale( 'org_name', $wpsso->options, false );
			else $org_names = array();

			if ( ! empty( $parent_type ) ) {
				$children = $wpsso->schema->get_schema_type_children( $parent_type );
				if ( ! empty( $children ) ) {	// just in case
					foreach ( $org_names as $num => $name ) {
						if ( ! empty( $wpsso->options['org_type_'.$num] ) &&
							in_array( $wpsso->options['org_type_'.$num], $children ) )
								continue;
						else unset( $org_names[$num] );
					}
				}
			}

			return $org_names;
		}

		// get a specific organization id
		// $mixed = 'default' | 'current' | post ID | $mod array
		public static function get_org_id( $id, $mixed = 'current' ) {

			$wpsso =& Wpsso::get_instance();

			if ( $wpsso->debug->enabled ) {
				$wpsso->debug->log_args( array( 
					'id' => $id,
					'mixed' => $mixed,
				) );
			}

			$org_opts = array();

			if ( $id === 'site' ) {
				return WpssoSchema::get_site_organization( $mixed );
			} elseif ( is_numeric( $id ) && $wpsso->check->aop( 'wpssoorg', true, $wpsso->is_avail['aop'] ) ) {
				foreach ( SucomUtil::preg_grep_keys( '/^(org_.*)_'.$id.'(#.*)?$/', $wpsso->options, false, '$1' ) as $key => $value ) {
					$org_opts[$key] = SucomUtil::get_locale_opt( $key.'_'.$id, $wpsso->options, $mixed );
				}
			}

			if ( $wpsso->debug->enabled ) {
				$wpsso->debug->log( $org_opts );
			}

			if ( empty( $org_opts ) ) {
				return false; 
			} else {
				return $org_opts;
			}
		}
	}
}

?>
