<?php
/**
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl.txt
 * Copyright 2014-2018 Jean-Sebastien Morisset (https://wpsso.com/)
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( 'These aren\'t the droids you\'re looking for...' );
}

if ( ! class_exists( 'WpssoOrgOrganization' ) ) {

	class WpssoOrgOrganization {

		private $p;

		public function __construct( &$plugin ) {
			$this->p =& $plugin;

			if ( $this->p->debug->enabled ) {
				$this->p->debug->mark();
			}
		}

		public static function get_org_names( $org_type = '', $add_none = false, $add_new = false, $add_site = false ) {

			$wpsso =& Wpsso::get_instance();

			if ( $wpsso->debug->enabled ) {
				$wpsso->debug->mark();
			}

			$first_names = array();
			$org_names = array();

			if ( $add_none ) {
				$first_names['none'] = $wpsso->cf['form']['org_select']['none'];
			}

			if ( $add_site ) {
				$first_names['site'] = $wpsso->cf['form']['org_select']['site'];
			}

			if ( $wpsso->check->aop( 'wpssoorg', true, $wpsso->avail['*']['p_dir'] ) ) {
				if ( $wpsso->debug->enabled ) {
					$wpsso->debug->log( 'getting multi keys for org_name' );
				}
				$org_names = SucomUtil::get_multi_key_locale( 'org_name', $wpsso->options, false );	// $add_none = false

				if ( ! empty( $org_type ) && is_string( $org_type) ) {
					if ( $wpsso->debug->enabled ) {
						$wpsso->debug->log( 'removing organizations not in org type: '.$org_type );
					}
					$children = $wpsso->schema->get_schema_type_children( $org_type );
					if ( ! empty( $children ) ) {	// just in case
						foreach ( $org_names as $num => $name ) {
							if ( ! empty( $wpsso->options['org_type_'.$num] ) &&
								in_array( $wpsso->options['org_type_'.$num], $children ) ) {
								continue;
							} else {
								unset( $org_names[$num] );
							}
						}
					}
				} elseif ( $wpsso->debug->enabled ) {
					$wpsso->debug->log( 'org type not provided - keeping all organizations' );
				}
			}

			if ( $add_new ) {
				$next_num = SucomUtil::get_next_num( $org_names );
				$org_names[$next_num] = $wpsso->cf['form']['org_select']['new'];
			}

			if ( ! empty( $first_names ) ) {
				$org_names = $first_names + $org_names;	// combine arrays, preserving numeric key associations
			}

			return $org_names;
		}

		/**
		 * Get a specific organization id.
		 * Returns an array of localized values
		 * $mixed = 'default' | 'current' | post ID | $mod array.
		 */
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
			} elseif ( is_numeric( $id ) && $wpsso->check->aop( 'wpssoorg', true, $wpsso->avail['*']['p_dir'] ) ) {
				// get the list of non-localized option names
				foreach ( SucomUtil::preg_grep_keys( '/^(org_.*_)'.$id.'(#.*)?$/', $wpsso->options, false, '$1' ) as $opt_prefix => $value ) {
					$opt_idx = rtrim( $opt_prefix, '_' );
					$org_opts[$opt_idx] = SucomUtil::get_key_value( $opt_prefix.$id, $wpsso->options, $mixed );	// localized value
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

