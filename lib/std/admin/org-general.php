<?php
/**
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl.txt
 * Copyright 2014-2021 Jean-Sebastien Morisset (https://wpsso.com/)
 */

if ( ! defined( 'ABSPATH' ) ) {

	die( 'These aren\'t the droids you\'re looking for.' );
}

if ( ! class_exists( 'WpssoOrgStdAdminOrgGeneral' ) ) {

	class WpssoOrgStdAdminOrgGeneral {

		private $p;	// Wpsso class object.

		public function __construct( &$plugin ) {

			$this->p =& $plugin;

			if ( $this->p->debug->enabled ) {

				$this->p->debug->mark();
			}

			$this->p->util->add_plugin_filters( $this, array( 
				'org_other_organizations_rows' => 2,
			) );
		}

		public function filter_org_other_organizations_rows( $table_rows, $form ) {

			$plm_req_msg     = $this->p->msgs->maybe_ext_required( 'wpssoplm' );
			$plm_disable     = empty( $plm_req_msg ) ? false : true;
			$plm_place_names = $this->p->util->get_form_cache( 'place_names', $add_none = true );

			$org_names_new    = array( 0 => $this->p->cf[ 'form' ][ 'org_select' ][ 'new' ] );
			$org_types_select = $this->p->util->get_form_cache( 'org_types_select' );

			unset( $form->options[ 'org_id' ] );

			$id = 0;

			$table_rows[] = '<td colspan="2">' . $this->p->msgs->pro_feature( 'wpssoorg' ) . '</td>';

			$table_rows[ 'org_id' ] = $form->get_th_html( _x( 'Edit an Organization', 'option label', 'wpsso-organization' ), '', 'org_id' ) . 
			'<td class="blank">' . $form->get_no_select( 'org_id', $org_names_new, 'long_name', '', true ) . '</td>';

			$form->defaults[ 'org_schema_type_' . $id ] = $form->defaults[ 'site_org_schema_type' ];	// Set default value.
			$form->defaults[ 'org_place_id_' . $id ]    = $form->defaults[ 'site_org_place_id' ];		// Set default value.

			$table_rows[ 'org_delete_' . $id ] = '' .
				$form->get_th_html() . 
				'<td class="blank">' . $form->get_no_checkbox( 'org_delete_' . $id ) . ' ' . 
				_x( 'delete this organization', 'option comment', 'wpsso-organization' ) . '</td>';

			$table_rows[ 'org_name_' . $id ] = '' .
				$form->get_th_html_locale( _x( 'Organization Name', 'option label', 'wpsso-organization' ),
					$css_class = '', $css_id = 'org_name' ) .  
				'<td class="blank">' . $form->get_no_input_value( '',
					$css_class = 'long_name is_required' ) . '</td>';

			$table_rows[ 'org_name_alt_' . $id ] = '' .
				$form->get_th_html_locale( _x( 'Organization Alternate Name', 'option label', 'wpsso-organization' ),
					$css_class = '', $css_id = 'org_name_alt' ) .  
				'<td class="blank">' . $form->get_no_input_value( '',
					$css_class = 'long_name' ) . '</td>';

			$table_rows[ 'org_desc_' . $id ] = '' .
				$form->get_th_html_locale( _x( 'Organization Description', 'option label', 'wpsso-organization' ),
					$css_class = '', $css_id = 'org_desc' ) .  
				'<td class="blank">' . $form->get_no_textarea_value() . '</td>';

			$table_rows[ 'org_url_' . $id ] = '' .
				$form->get_th_html_locale( _x( 'Organization WebSite URL', 'option label', 'wpsso-organization' ),
					$css_class = '', $css_id = 'org_url' ) . 
				'<td class="blank">' . $form->get_no_input_value( '',
					$css_class = 'wide' ) . '</td>';

			$table_rows[ 'org_logo_url_' . $id ] = '' .
				$form->get_th_html_locale( '<a href="https://developers.google.com/structured-data/customize/logos">' . 
				_x( 'Organization Logo URL', 'option label', 'wpsso-organization' ) . '</a>',
					$css_class = '', $css_id = 'org_logo_url' ) . 
				'<td class="blank">' . $form->get_no_input_value( '',
					$css_class = 'wide is_required' ) . '</td>';

			$table_rows[ 'org_banner_url_' . $id ] = '' .
				$form->get_th_html_locale( '<a href="https://developers.google.com/search/docs/data-types/article#logo-guidelines">' .
				_x( 'Organization Banner URL', 'option label', 'wpsso-organization' ) . '</a>',
					$css_class = '', $css_id = 'org_banner_url' ) . 
				'<td class="blank">' . $form->get_no_input_value( '',
					$css_class = 'wide is_required' ) . '</td>';

			$table_rows[ 'org_schema_type_' . $id ] = '' .
				$form->get_th_html( _x( 'Organization Schema Type', 'option label', 'wpsso-organization' ),
					$css_class = '', $css_id = 'org_schema_type' ) . 
				'<td class="blank">' . $form->get_no_select( 'org_schema_type_' . $id, $org_types_select,
					$css_class = 'schema_type' ) . '</td>';

			$table_rows[ 'org_place_id_' . $id ] = '' .
				$form->get_th_html( _x( 'Organization Location', 'option label', 'wpsso-organization' ),
					$css_class = '', $css_id = 'org_place_id' ) . 
				'<td class="blank">' . $form->get_no_select( 'org_place_id_' . $id, $plm_place_names,
					$css_class = 'long_name' ) . $plm_req_msg . '</td>';

			$table_rows[ 'subsection_google_knowledgegraph' ] = '<td colspan="2" class="subsection"><h4>' . 
				_x( 'Google\'s Knowledge Graph', 'metabox title', 'wpsso-organization' ) . '</h4></td>';

			$social_accounts = apply_filters( 'wpsso_social_accounts', $this->p->cf[ 'form' ][ 'social_accounts' ] );

			asort( $social_accounts );	// Sort by label and maintain key association.

			foreach ( $social_accounts as $key => $label ) {

				$org_key_id = 'org_sameas_' . $key . '_' . $id;

				$table_rows[ $org_key_id ] = '' .
					$form->get_th_html_locale( _x( $label, 'option value', 'wpsso-organization' ),
						$css_class = 'nowrap', $org_key_id ) . 
					'<td class="blank">' . $form->get_no_input_value( '', strpos( $org_key_id, '_url' ) ? 'wide' : '' ) . '</td>';
			}

			return $table_rows;
		}
	}
}
