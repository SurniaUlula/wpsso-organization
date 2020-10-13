<?php
/**
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl.txt
 * Copyright 2014-2020 Jean-Sebastien Morisset (https://wpsso.com/)
 */

if ( ! defined( 'ABSPATH' ) ) {

	die( 'These aren\'t the droids you\'re looking for.' );
}

if ( ! class_exists( 'WpssoOrgFiltersMessages' ) ) {

	class WpssoOrgFiltersMessages {

		private $p;

		/**
		 * Instantiated by WpssoOrgFilters->__construct().
		 */
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

			if ( is_admin() ) {

				$this->p->util->add_plugin_filters( $this, array( 
					'messages_tooltip' => 2,
				) );
			}
		}

		public function filter_messages_tooltip( $text, $msg_key ) {

			if ( strpos( $msg_key, 'tooltip-org_' ) !== 0 ) {

				return $text;
			}

			switch ( $msg_key ) {

				case 'tooltip-org_json':

					$text = __( 'Include Organization schema markup in the front page for Google\'s Knowledge Graph.', 'wpsso-organization' );

					break;

				case 'tooltip-org_id':

					$text = __( 'Select an organization to edit.', 'wpsso-organization' );

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

				case 'tooltip-org_schema_type':

					$text = __( 'You may optionally choose a more accurate Schema type for this organization (default is Organization).',
						'wpsso-organization' );

					break;

				case 'tooltip-org_place_id':

					$plm_info = $this->p->cf[ 'plugin' ][ 'wpssoplm' ];

					$plm_addon_link = $this->p->util->get_admin_url( 'addons#wpssoplm', $plm_info[ 'short' ] );

					$text = sprintf( __( 'Select an optional location for this organization (requires the %s add-on).',
						'wpsso-organization' ), $plm_addon_link );

					break;
			}

			return $text;
		}
	}
}
