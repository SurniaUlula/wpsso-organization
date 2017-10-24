<?php
/*
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl.txt
 * Copyright 2014-2017 Jean-Sebastien Morisset (https://wpsso.com/)
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( 'These aren\'t the droids you\'re looking for...' );
}

if ( ! class_exists( 'WpssoOrgFilters' ) ) {

	class WpssoOrgFilters {

		protected $p;

		public function __construct( &$plugin ) {
			$this->p =& $plugin;

			if ( $this->p->debug->enabled ) {
				$this->p->debug->mark();
			}

			$this->p->util->add_plugin_filters( $this, array( 
				'json_array_schema_type_ids' => 2,	// $type_ids, $mod
				'get_organization_options' => 3,	// $opts, $mod, $org_id
			) );

			if ( is_admin() ) {
				$this->p->util->add_plugin_filters( $this, array( 
					'option_type' => 2,
					'save_options' => 3,
					'messages_tooltip' => 2,
					'form_cache_org_site_names' => 1,
					'form_cache_org_perf_names' => 1,
				) );
			}
		}

		public function filter_form_cache_org_site_names( $mixed ) {
			$ret = WpssoOrgOrganization::get_org_names();
			if ( is_array( $mixed ) ) {
				$ret = $mixed + $ret;
			}
			return $ret;
		}

		public function filter_form_cache_org_perf_names( $mixed ) {
			$ret = WpssoOrgOrganization::get_org_names( 'performing.group' );
			if ( is_array( $mixed ) ) {
				$ret = $mixed + $ret;
			}
			return $ret;
		}

		public function filter_json_array_schema_type_ids( $type_ids, $mod ) {
			if ( $mod['is_home'] ) {
				if ( ! empty( $this->p->options['site_org_type'] ) &&
					$this->p->options['site_org_type'] !== 'organization' ) {

					unset( $type_ids['organization'] );
					$type_ids[$this->p->options['site_org_type']] = $this->p->options['schema_organization_json'];
				}
			}
			return $type_ids;
		}

		public function filter_get_organization_options( $opts, $mod, $org_id ) {
			if ( $opts !== false ) {	// first come, first served
				return $opts;
			} elseif ( $org_id === 'site' || is_numeric( $org_id ) ) {
				return WpssoOrgOrganization::get_org_id( $org_id, $mod );	// returns localized values
			} else {
				return $opts;
			}
		}

		public function filter_option_type( $type, $key ) {
			if ( ! empty( $type ) ) {
				return $type;
			} elseif ( strpos( $key, 'org_' ) !== 0 ) {
				return $type;
			}
			switch ( $key ) {
				case 'org_id':
					return 'numeric';
					break;
				case 'org_name':
				case 'org_alt_name':
				case 'org_desc':
					return 'ok_blank';
					break;
				case 'org_type':
				case 'org_place_id':
					return 'not_blank';
					break;
				case 'org_url':
				case 'org_logo_url':
				case 'org_banner_url':
					return 'url';
					break;
				case ( strpos( $key, '_url' ) && isset( $this->p->cf['form']['social_accounts'][substr( $key, 4 )] ) ? true : false ):
					return 'url';
					break;
			}
		}

		public function filter_save_options( $opts, $options_name, $network ) {

			$org_names = SucomUtil::get_multi_key_locale( 'org_name', $opts, false );	// $add_none = false
			$last_num = SucomUtil::get_last_num( $org_names );

			foreach ( $org_names as $num => $name ) {

				$name = trim( $name );

				if ( ! empty( $opts['org_delete_'.$num] ) || ( $name === '' && $num === $last_num ) ) {	// remove the empty "New Address"

					if ( isset( $opts['org_id'] ) && $opts['org_id'] === $num ) {
						unset( $opts['org_id'] );
					}

					// remove organization id, including all localized keys
					$opts = SucomUtil::preg_grep_keys( '/^org_.*_'.$num.'(#.*)?$/', $opts, true );	// $invert = true

				} elseif ( $name === '' ) {	// just in case
					$opts['org_name_'.$num] = sprintf( _x( 'Organization #%d',
						'option value', 'wpsso-organization' ), $num );
				} else {
					$opts['org_name_'.$num] = $name;
				}
			}

			return $opts;
		}

		public function filter_messages_tooltip( $text, $idx ) {
			if ( strpos( $idx, 'tooltip-org_' ) !== 0 )
				return $text;
			switch ( $idx ) {
				case 'tooltip-org_json':
					$text = __( 'Include Organization schema markup in the front page for Google\'s Knowledge Graph.', 'wpsso-organization' );
					break;
				case 'tooltip-org_id':
					$text = __( 'Select an organization to edit, or add a new organization.', 'wpsso-organization' );
					break;
				case 'tooltip-org_name':
					$text = __( 'The complete name for the organization.', 'wpsso-organization' );
					break;
				case 'tooltip-org_alt_name':
					$text = __( 'An alternate name for the organization that you would like Google to consider.', 'wpsso-organization' );
					break;
				case 'tooltip-org_desc':
					$text = __( 'A description for the organization.', 'wpsso-organization' );
					break;
				case 'tooltip-org_url':
					$text = __( 'The website URL for the organization.', 'wpsso-organization' );
					break;
				case 'tooltip-org_type':
					$text = __( 'You may select a more descriptive Schema type from the Organization sub-types (default is Organization).',
						'wpsso-organization' );
					break;
				case 'tooltip-org_place_id':
					$plm_info = $this->p->cf['plugin']['wpssoplm'];
					$text = sprintf( __( 'Select an optional Place / Location address for this Organization (requires the %s extension).',
						'wpsso-organization' ), '<a href="'.$plm_info['url']['home'].'">'.$plm_info['name'].'</a>' );
					break;
			}
			return $text;
		}
	}
}

?>
