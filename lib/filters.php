<?php
/**
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl.txt
 * Copyright 2014-2020 Jean-Sebastien Morisset (https://wpsso.com/)
 */

if ( ! defined( 'ABSPATH' ) ) {

	die( 'These aren\'t the droids you\'re looking for.' );
}

if ( ! class_exists( 'WpssoOrgFilters' ) ) {

	class WpssoOrgFilters {

		private $p;
		private $msgs;		// WpssoOrgFiltersMessages class object.
		private $upg;		// WpssoOrgFiltersUpgrade class object.

		public function __construct( &$plugin ) {

			static $do_once = null;

			if ( true === $do_once ) {

				return;	// Stop here.
			}

			$do_once = true;

			$this->p =& $plugin;

			if ( $this->p->debug->enabled ) {

				$this->p->debug->mark();
			}

			/**
			 * Instantiate the WpssoOrgFiltersUpgrade class object.
			 */
			if ( ! class_exists( 'WpssoOrgFiltersUpgrade' ) ) {

				require_once WPSSOORG_PLUGINDIR . 'lib/filters-upgrade.php';
			}

			$this->upg = new WpssoOrgFiltersUpgrade( $plugin );

			$this->p->util->add_plugin_filters( $this, array( 
				'option_type'              => 2,
				'save_setting_options'     => 3,
				'get_organization_options' => 3,
				'rename_options_keys'      => 1,
			) );

			if ( is_admin() ) {

				/**
				 * Instantiate the WpssoOrgFiltersMessages class object.
				 */
				if ( ! class_exists( 'WpssoOrgFiltersMessages' ) ) {

					require_once WPSSOORG_PLUGINDIR . 'lib/filters-messages.php';
				}

				$this->msgs = new WpssoOrgFiltersMessages( $plugin );

				$this->p->util->add_plugin_filters( $this, array( 
					'form_cache_org_site_names' => 1,
				) );
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

				case 'org_desc':
				case 'org_name':
				case 'org_name_alt':

					return 'ok_blank';

				case 'org_banner_url':
				case 'org_logo_url':

					return 'img_url';

				case 'org_place_id':
				case 'org_schema_type':

					return 'not_blank';

				case 'org_url':

					return 'url';

				case ( strpos( $base_key, '_url' ) && isset( $this->p->cf[ 'form' ][ 'social_accounts' ][ substr( $base_key, 4 ) ] ) ? true : false ):

					return 'url';
			}

			return $type;
		}

		/**
		 * $network is true if saving multisite network settings.
		 */
		public function filter_save_setting_options( array $opts, $network, $upgrading ) {

			if ( $this->p->debug->enabled ) {

				$this->p->debug->mark();
			}

			if ( $network ) {

				return $opts;	// Nothing to do.
			}

			$org_names = SucomUtil::get_multi_key_locale( 'org_name', $opts, $add_none = false );

			$org_last_num = SucomUtil::get_last_num( $org_names );

			foreach ( $org_names as $org_id => $org_name ) {

				$org_name = trim( $org_name );

				/**
				 * Remove empty "New Organization".
				 */
				if ( ! empty( $opts[ 'org_delete_' . $org_id ] ) || ( $org_name === '' && $org_id === $org_last_num ) ) {

					/**
					 * Maybe reset the currently selected organization ID.
					 */
					if ( isset( $opts[ 'org_id' ] ) && $opts[ 'org_id' ] === $org_id ) {

						unset( $opts[ 'org_id' ] );
					}

					/**
					 * Remove the organization, including all localized keys.
					 */
					$opts = SucomUtil::preg_grep_keys( '/^org_.*_' . $org_id . '(#.*)?$/', $opts, true );	// $invert is true.

					continue;	// Check the next organization.
				}

				/**
				 * Make sure each organization has a name.
				 */
				if ( $org_name === '' ) {	// Just in case.

					$org_name = sprintf( _x( 'Organization #%d', 'option value', 'wpsso-organization' ), $org_id );
				}
				
				$opts[ 'org_name_' . $org_id ] = $org_name;

				$this->check_banner_image_size( $opts, $img_pre = 'org_banner', $org_id, $org_name );
			}

			return $opts;
		}

		public function filter_get_organization_options( $opts, $mod, $org_id ) {

			if ( false !== $opts ) {	// First come, first served.

				return $opts;

			} elseif ( $org_id === 'site' || is_numeric( $org_id ) ) {

				return WpssoOrgOrganization::get_id( $org_id, $mod );	// Returns localized values.

			} else {

				return $opts;
			}
		}

		public function filter_rename_options_keys( $options_keys ) {

			if ( $this->p->debug->enabled ) {

				$this->p->debug->mark();
			}

			$options_keys[ 'wpssoorg' ] = array(
				2 => array(
					'org_alt_name' => 'org_name_alt',
				),
			);

			return $options_keys;
		}

		public function filter_form_cache_org_site_names( $mixed ) {

			$ret = WpssoOrgOrganization::get_names();

			if ( is_array( $mixed ) ) {

				$ret = $mixed + $ret;
			}

			return $ret;
		}

		private function check_banner_image_size( $opts, $img_pre = 'org_banner', $org_id, $org_name ) {

			/**
			 * Skip if notices have already been shown.
			 */
			if ( ! $this->p->notice->is_admin_pre_notices() ) {

				return;
			}

			$context_transl = sprintf( __( 'organization "%s"', 'wpsso-organization' ), $org_name );

			$settings_page_link = $this->p->util->get_admin_url( 'org-general#sucom-tabset_org-tab_other' );

			$this->p->util->maybe_set_ref( $settings_page_link, $mod = false, $context_transl );

			/**
			 * Returns an image array:
			 *
			 * array(
			 *	'og:image:url'       => null,
			 *	'og:image:width'     => null,
			 *	'og:image:height'    => null,
			 *	'og:image:cropped'   => null,
			 *	'og:image:id'        => null,
			 *	'og:image:alt'       => null,
			 *	'og:image:size_name' => null,
			 * );
			 */
			$mt_single_image = $this->p->media->get_mt_img_pre_url( $opts, $img_pre, $org_id );

			$image_url = SucomUtil::get_first_mt_media_url( $mt_single_image );

			if ( ! empty( $image_url ) ) {

				$image_href    = '<a href="' . $image_url . '">' . $image_url . '</a>';
				$image_dims    = $mt_single_image[ 'og:image:width' ] . 'x' . $mt_single_image[ 'og:image:height' ] . 'px';
				$required_dims = '600x60px';

				if ( $image_dims !== $required_dims ) {

					if ( '-1x-1px' === $image_dims ) {

						$error_msg = sprintf( __( 'The "%s" organization banner URL image dimensions cannot be determined.',
							'wpsso-organization' ), $org_name ) . ' ';

						$error_msg .= sprintf( __( 'Please make sure this site can access %s using the PHP getimagesize() function.',
							'wpsso-organization' ), $image_href );

					} else {

						$error_msg = sprintf( __( 'The "%1$s" organization banner URL image dimensions are %2$s and must be exactly %3$s.',
							'wpsso-organization' ), $org_name, $image_dims, $required_dims ) . ' ';

						$error_msg .= sprintf( __( 'Please correct the %s banner image.',
							'wpsso-organization' ), $image_href );
					}

					$this->p->notice->err( $error_msg );
				}
			}

			$this->p->util->maybe_unset_ref( $settings_page_link );
		}
	}
}
