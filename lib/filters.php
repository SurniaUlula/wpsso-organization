<?php
/**
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl.txt
 * Copyright 2014-2018 Jean-Sebastien Morisset (https://wpsso.com/)
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
				'json_array_schema_type_ids' => 2,
				'get_organization_options' => 3,
			) );

			if ( is_admin() ) {
				$this->p->util->add_plugin_filters( $this, array( 
					'option_type' => 2,
					'save_options' => 4,
					'messages_tooltip' => 2,
					'form_cache_org_site_names' => 1,
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

		public function filter_json_array_schema_type_ids( $type_ids, $mod ) {
			if ( $mod['is_home'] ) {
				if ( ! empty( $this->p->options['site_org_type'] ) && $this->p->options['site_org_type'] !== 'organization' ) {
					$type_ids[$this->p->options['site_org_type']] = $this->p->options['schema_add_home_organization'];
					unset( $type_ids['organization'] );
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

		public function filter_option_type( $type, $base_key ) {

			if ( ! empty( $type ) ) {
				return $type;
			} elseif ( strpos( $base_key, 'org_' ) !== 0 ) {
				return $type;
			}

			switch ( $base_key ) {
				case 'org_id':
					return 'numeric';
					break;
				case 'org_name':
				case 'org_name_alt':
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
				case ( strpos( $base_key, '_url' ) && isset( $this->p->cf['form']['social_accounts'][substr( $base_key, 4 )] ) ? true : false ):
					return 'url';
					break;
			}

			return $type;
		}

		public function filter_save_options( $opts, $options_name, $network, $doing_upgrade ) {

			if ( $network ) {
				return $opts;	// Nothing to do.
			}

			$org_names = SucomUtil::get_multi_key_locale( 'org_name', $opts, false );	// $add_none is false.
			$last_num  = SucomUtil::get_last_num( $org_names );

			if ( ! $doing_upgrade ) {
				$this->check_banner_image_size( $opts, 'schema_banner' );
			}

			foreach ( $org_names as $num => $name ) {

				$name = trim( $name );

				if ( ! empty( $opts['org_delete_'.$num] ) || ( $name === '' && $num === $last_num ) ) {	// Remove the empty "New Address".

					if ( isset( $opts['org_id'] ) && $opts['org_id'] === $num ) {
						unset( $opts['org_id'] );
					}

					/**
					 * Remove the organization, including all localized keys.
					 */
					$opts = SucomUtil::preg_grep_keys( '/^org_.*_'.$num.'(#.*)?$/', $opts, true );	// $invert is true.

					continue;	// Check the next organization.
				}

				if ( $name === '' ) {	// Just in case.
					$opts['org_name_'.$num] = sprintf( _x( 'Organization #%d', 'option value', 'wpsso-organization' ), $num );
				}
				
				$opts['org_name_'.$num] = $name;

				/**
				 * Get the banner image and issue an error if the image is not 600x60px. Only check
				 * on a manual save, not an options upgrade action (ie. when a new add-on is activated).
				 */
				if ( ! $doing_upgrade ) {
					$this->check_banner_image_size( $opts, 'org_banner', $num );
				}
			}

			return $opts;
		}

		private function check_banner_image_size( $opts, $opt_pre, $opt_num = null ) {

			$size_name = null;	// Only check banner urls - skip any banner image id options.

			if ( $opt_pre === 'schema_banner' ) {	// Use the website organization tab as the reference name.
				$name_transl = _x( 'WebSite (Front Page)', 'metabox tab', 'wpsso-organization' );
			} else {
				$name_transl = SucomUtil::get_key_value( $opt_pre . '_name_' . $opt_num, $opts, 'current' );
			}

			$context_transl = sprintf( __( 'saving organization "%1$s"', 'wpsso-organization' ), $name_transl );
			$settings_page_link = $this->p->util->get_admin_url( 'org-general' );

			$this->p->notice->set_ref( $settings_page_link, null, $context_transl );

			$og_single_image = $this->p->media->get_opts_single_image( $opts, null, $opt_pre, $opt_num );

			$this->p->notice->unset_ref( $settings_page_link );
		}

		public function filter_messages_tooltip( $text, $idx ) {

			if ( strpos( $idx, 'tooltip-org_' ) !== 0 ) {
				return $text;
			}

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
				case 'tooltip-org_name_alt':
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
					$text = sprintf( __( 'Select an optional Place / Location address for this Organization (requires the %s add-on).',
						'wpsso-organization' ), '<a href="'.$plm_info['url']['home'].'">'.$plm_info['name'].'</a>' );
					break;
			}

			return $text;
		}
	}
}
