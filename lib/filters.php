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
				'get_organization_options'   => 3,
			) );

			if ( is_admin() ) {
				$this->p->util->add_plugin_filters( $this, array( 
					'option_type'               => 2,
					'check_options'             => 4,
					'save_options'              => 4,
					'messages_tooltip'          => 2,
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
			}

			return $opts;
		}

		public function filter_check_options( $opts, $options_name, $network, $doing_upgrade ) {

			/**
			 * Get the banner image and issue an error if the image is not 600x60px. Only check
			 * on a manual save, not an options upgrade action (ie. when a new add-on is activated).
			 */
			if ( ! $network && ! $doing_upgrade ) {

				$org_names = WpssoOrgOrganization::get_org_names();

				foreach ( $org_names as $num => $name ) {
					$this->check_banner_image_size( $opts, 'org', $num, $name );
				}
			}
		}

		private function check_banner_image_size( $opts, $opt_pre, $org_num, $org_name ) {

			if ( ! $this->p->notice->is_admin_pre_notices() ) {
				return;
			}

			$size_name          = false;	// Only check banner urls - skip any banner image id options.
			$opt_img_pre        = $opt_pre . '_banner';
			$context_transl     = sprintf( __( 'organization "%s"', 'wpsso-organization' ), $org_name );
			$settings_page_link = $this->p->util->get_admin_url( 'org-general#sucom-tabset_organization-tab_other' );

			$this->p->notice->set_ref( $settings_page_link, null, $context_transl );

			/**
			 * Returns an image array:
			 *
			 * array(
			 *	'og:image:url'     => null,
			 *	'og:image:width'   => null,
			 *	'og:image:height'  => null,
			 *	'og:image:cropped' => null,
			 *	'og:image:id'      => null,
			 *	'og:image:alt'     => null,
			 * );
			 */
			$og_single_image     = $this->p->media->get_opts_single_image( $opts, $size_name, $opt_img_pre, $org_num );

			if ( $this->p->debug->enabled ) {
				$this->p->debug->log_arr( '$og_single_image', $og_single_image );
			}

			$og_single_image_url = SucomUtil::get_mt_media_url( $og_single_image );

			if ( ! empty( $og_single_image_url ) ) {

				$image_href    = '<a href="' . $og_single_image_url . '">' . $og_single_image_url . '</a>';
				$image_dims    = $og_single_image['og:image:width'] . 'x' . $og_single_image['og:image:height'] . 'px';
				$required_dims = '600x60px';

				if ( $image_dims !== $required_dims ) {

					if ( $image_dims === '-1x-1px' ) {

						$error_msg = sprintf( __( 'The "%1$s" organization banner URL image dimensions cannot be determined.',
							'wpsso-organization' ), $org_name ) . ' ';

						$error_msg .= sprintf( __( 'Please make sure this site can access the banner image at %1$s.',
							'wpsso-organization' ), $image_href );

					} else {

						$error_msg = sprintf( __( 'The "%1$s" organization banner URL image dimensions are %2$s and must be exactly %3$s.',
							'wpsso-organization' ), $org_name, $image_dims, $required_dims ) . ' ';

						$error_msg .= sprintf( __( 'Please correct the banner image at %s.',
							'wpsso' ), $image_href );
					}

					$this->p->notice->err( $error_msg );
				}
			}

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
