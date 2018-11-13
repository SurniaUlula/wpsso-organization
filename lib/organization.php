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

		/**
		 * Return an associative array of organization IDs and names.
		 * Optionally add 'none', 'new', and 'site' at the top of the array.
		 */
		public static function get_names( $schema_type = '', $add_none = false, $add_new = false, $add_site = false ) {

			$wpsso =& Wpsso::get_instance();

			if ( $wpsso->debug->enabled ) {
				$wpsso->debug->mark();
			}

			$first_names = array();
			$org_names   = array();

			if ( $add_none ) {
				$first_names[ 'none' ] = $wpsso->cf['form']['org_select']['none'];
			}

			if ( $add_site ) {
				$first_names[ 'site' ] = $wpsso->cf['form']['org_select']['site'];
			}

			if ( $wpsso->check->pp( 'wpssoorg', true, $wpsso->avail[ '*' ][ 'p_dir' ] ) ) {

				if ( $wpsso->debug->enabled ) {
					$wpsso->debug->log( 'getting multi keys for org_name' );
				}

				$org_names = SucomUtil::get_multi_key_locale( 'org_name', $wpsso->options, false );	// $add_none is false.

				if ( ! empty( $schema_type ) && is_string( $schema_type) ) {

					if ( $wpsso->debug->enabled ) {
						$wpsso->debug->log( 'removing organizations not in org type: ' . $schema_type );
					}

					$children = $wpsso->schema->get_schema_type_children( $schema_type );

					if ( ! empty( $children ) ) {	// Just in case.

						foreach ( $org_names as $org_id => $name ) {

							if ( ! empty( $wpsso->options[ 'org_schema_type_' . $org_id ] ) &&
								in_array( $wpsso->options[ 'org_schema_type_' . $org_id ], $children ) ) {

								continue;

							} else {
								unset( $org_names[ $org_id ] );
							}
						}
					}

				} elseif ( $wpsso->debug->enabled ) {
					$wpsso->debug->log( 'org type not provided - keeping all organizations' );
				}
			}

			/**
			 * Add 'new' as the last org ID.
			 */
			if ( $add_new ) {

				$next_num = SucomUtil::get_next_num( $org_names );

				$org_names[$next_num] = $wpsso->cf['form']['org_select']['new'];
			}

			if ( ! empty( $first_names ) ) {
				$org_names = $first_names + $org_names;	// Combine arrays, preserving numeric key associations.
			}

			return $org_names;
		}

		/**
		 * Get a specific organization id. Returns an array of localized values
		 *
		 * $org_id = 'site' | place ID.
		 * $mixed  = 'default' | 'current' | post ID | $mod array.
		 */
		public static function get_id( $org_id, $mixed = 'current' ) {

			$wpsso =& Wpsso::get_instance();

			if ( $wpsso->debug->enabled ) {
				$wpsso->debug->log_args( array( 
					'org_id' => $org_id,
					'mixed'  => $mixed,
				) );
			}

			$org_opts = array();

			if ( $org_id === '' || $org_id === 'none' ) {	// Just in case.

				return false;

			} elseif ( $org_id === 'site' ) {

				return WpssoSchema::get_site_organization( $mixed );

			} elseif ( is_numeric( $org_id ) && $wpsso->check->pp( 'wpssoorg', true, $wpsso->avail[ '*' ][ 'p_dir' ] ) ) {

				static $local_cache = array();	// Cache for single page load.

				if ( isset( $local_cache[ $org_id ] ) ) {

					if ( $wpsso->debug->enabled ) {
						$wpsso->debug->log( 'returning options from static cache array for org ID ' . $org_id );
					}

					return $local_cache[ $org_id ];
				}

				/**
				 * Get the list of non-localized option names.
				 */
				foreach ( SucomUtil::preg_grep_keys( '/^(org_.*_)' . $org_id . '(#.*)?$/', $wpsso->options, false, '$1' ) as $opt_prefix => $value ) {

					$opt_key = rtrim( $opt_prefix, '_' );

					$org_opts[ $opt_key ] = SucomUtil::get_key_value( $opt_prefix . $org_id, $wpsso->options, $mixed );	// Localized value.
				}

				if ( $wpsso->debug->enabled ) {
					$wpsso->debug->log( 'saving options to static cache array for org ID ' . $org_id );
				}

				$local_cache[ $org_id ] = $org_opts;
			}

			if ( empty( $org_opts ) ) {
				return false; 
			} else {
				return $org_opts;
			}
		}
	}
}
