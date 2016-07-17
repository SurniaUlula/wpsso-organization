<?php
/*
 * License: GPLv3
 * License URI: http://www.gnu.org/licenses/gpl.txt
 * Copyright 2014-2016 Jean-Sebastien Morisset (http://surniaulula.com/)
 */

if ( ! defined( 'ABSPATH' ) ) 
	die( 'These aren\'t the droids you\'re looking for...' );

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
				$wpsso->debug->args( array( 
					'id' => $id,
					'mixed' => $mixed,
				) );
			}

			$opts = array();

			if ( $id === 'site' ) {
				foreach ( array(
					'org_name' => 'org_name',			// Organization Name
					'org_alt_name' => 'org_alt_name',		// Organization Alternate Name
					'org_desc' => 'org_desc',			// Organization Description
					'org_url' => 'org_url',				// Organization Website URL
					'org_logo_url' => 'schema_logo_url',		// Organization Logo Image URL
					'org_banner_url' => 'schema_banner_url',	// Organization Banner (600x60px) URL
					'org_type' => 'org_type',			// Organization Schema Type
					'org_place_id' => 'org_place_id',		// Organization Place / Location
				) as $org_key => $site_key ) {
					$opts[$org_key] = SucomUtil::get_locale_opt( $site_key, $wpsso->options, $mixed );

					if ( $org_key === 'org_alt_name' && empty( $opts[$org_key] ) )	// fallback to the schema options value
						$opts[$org_key] = SucomUtil::get_locale_opt( 'schema_alt_name', $wpsso->options, $mixed );
				}
				
				foreach ( apply_filters( $wpsso->cf['lca'].'_social_accounts', 
					$wpsso->cf['form']['social_accounts'] ) as $key => $label )
						$opts['org_sameas_'.$key] = SucomUtil::get_locale_opt( $key, $wpsso->options, $mixed );

			} elseif ( is_numeric( $id ) && $wpsso->check->aop( 'wpssoorg', true, $wpsso->is_avail['aop'] ) ) {
				foreach ( SucomUtil::preg_grep_keys( '/^(org_.*)_'.$id.'(#.*)?$/',
					$wpsso->options, false, '$1' ) as $key => $value )
						$opts[$key] = SucomUtil::get_locale_opt( $key.'_'.$id, $wpsso->options, $mixed );
			}

			if ( $wpsso->debug->enabled )
				$wpsso->debug->log( $opts );

			if ( empty( $opts ) )
				return false; 
			else return $opts;
		}
	}
}

?>