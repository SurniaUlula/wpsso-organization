<?php
/**
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl.txt
 * Copyright 2014-2018 Jean-Sebastien Morisset (https://wpsso.com/)
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( 'These aren\'t the droids you\'re looking for...' );
}

if ( ! class_exists( 'WpssoOrgGplAdminOrgGeneral' ) ) {

	class WpssoOrgGplAdminOrgGeneral {

		public function __construct( &$plugin ) {
			$this->p =& $plugin;

			if ( $this->p->debug->enabled ) {
				$this->p->debug->mark();
			}

			$this->p->util->add_plugin_filters( $this, array( 
				'organization_other_rows' => 2,
			) );
		}

		public function filter_organization_other_rows( $table_rows, $form ) {

			if ( $this->p->debug->enabled ) {
				$this->p->debug->mark();
			}

			$plm_req_msg = $this->p->util->get_ext_req_msg( 'plm' );

			$plm_disable = empty( $plm_req_msg ) ? false : true;

			$org_names_new = array( 0 => $this->p->cf['form']['org_select']['new'] );

			$place_addr_names = $form->get_cache( 'place_addr_names', true );	// $add_none = true

			$id = 0;

			unset( $form->options['org_id'] );

			$table_rows[] = '<td colspan="2" align="center">'.
				$this->p->msgs->get( 'pro-feature-msg', 
					array( 'lca' => 'wpssoorg' ) ).'</td>';

			$table_rows['org_id'] = $form->get_th_html( _x( 'Edit an Organization',
				'option label', 'wpsso-organization' ), '', 'org_id' ).
			'<td class="blank">'.$form->get_no_select( 'org_id', $org_names_new, 'long_name', '', true ).'</td>';

			$form->defaults['org_type_'.$id] = $form->defaults['site_org_type'];		// set default value
			$form->defaults['org_place_id_'.$id] = $form->defaults['site_place_id'];	// set default value

			$table_rows['org_delete_'.$id] = $form->get_th_html().
			'<td class="blank">'.$form->get_no_checkbox( 'org_delete_'.$id ).' <em>'.
			_x( 'delete this organization', 'option comment', 'wpsso-organization' ).'</em></td>';

			$table_rows['org_name_'.$id] = $form->get_th_html( _x( 'Organization Name',
				'option label', 'wpsso-organization' ), '', 'org_name', array( 'is_locale' => true ) ). 
			'<td class="blank">'.$form->get_no_input_value( '', 'long_name required' ).'</td>';

			$table_rows['org_name_alt_'.$id] = $form->get_th_html( _x( 'Organization Alternate Name',
				'option label', 'wpsso-organization' ), '', 'org_name_alt', array( 'is_locale' => true ) ). 
			'<td class="blank">'.$form->get_no_input_value( '', 'long_name' ).'</td>';

			$table_rows['org_desc_'.$id] = $form->get_th_html( _x( 'Organization Description',
				'option label', 'wpsso-organization' ), '', 'org_desc', array( 'is_locale' => true ) ). 
			'<td class="blank">'.$form->get_no_textarea_value().'</td>';

			$table_rows['org_url_'.$id] = $form->get_th_html( _x( 'Organization WebSite URL',
				'option label', 'wpsso-organization' ), '', 'org_url', array( 'is_locale' => true ) ).
			'<td class="blank">'.$form->get_no_input_value( '', 'wide' ).'</td>';

			$table_rows['org_logo_url_'.$id] = $form->get_th_html( 
				'<a href="https://developers.google.com/structured-data/customize/logos">'.
				_x( 'Organization Logo URL', 'option label', 'wpsso-organization' ).'</a>',
					'', 'schema_logo_url', array( 'is_locale' => true ) ).
			'<td class="blank">'.$form->get_no_input_value( '', 'wide' ).'</td>';

			$table_rows['org_banner_url_'.$id] = $form->get_th_html( _x( 'Organization Banner URL',
				'option label', 'wpsso-organization' ), '', 'schema_banner_url', array( 'is_locale' => true ) ).
			'<td class="blank">'.$form->get_no_input_value( '', 'wide' ).'</td>';

			$table_rows['org_type_'.$id] = $form->get_th_html( _x( 'Organization Schema Type',
				'option label', 'wpsso-organization' ), '', 'org_type' ).
			'<td class="blank">'.$form->get_no_select( 'org_type_'.$id,
				$form->get_cache( 'org_types_select' ), 'schema_type' ).'</td>';

			$table_rows['org_place_id_'.$id] = $form->get_th_html( _x( 'Organization Place / Location',
				'option label', 'wpsso-organization' ), '', 'org_place_id' ).
			'<td class="blank">'.$form->get_no_select( 'org_place_id_'.$id,
				$place_addr_names, 'long_name' ).$plm_req_msg.'</td>';

			$table_rows['subsection_google_knowledgegraph'] = '<td></td><td class="subsection"><h4>'.
				_x( 'Google Knowledge Graph', 'metabox title', 'wpsso-organization' ).'</h4></td>';

			$social_accounts = apply_filters( $this->p->lca.'_social_accounts', $this->p->cf['form']['social_accounts'] );

			asort( $social_accounts );	// sort by label and maintain key association

			foreach ( $social_accounts as $key => $label ) {
				$org_key_id = 'org_sameas_'.$key.'_'.$id;
				$table_rows[$org_key_id] = $form->get_th_html( _x( $label, 'option value', 'wpsso-organization' ),
					'nowrap', $org_key_id, array( 'is_locale' => true ) ).
				'<td class="blank">'.$form->get_no_input_value( '',
					( strpos( $org_key_id, '_url' ) ? 'wide' : '' ) ).'</td>';
			}

			return $table_rows;
		}
	}
}
