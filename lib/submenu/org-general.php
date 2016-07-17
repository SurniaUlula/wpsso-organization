<?php
/*
 * License: GPLv3
 * License URI: http://www.gnu.org/licenses/gpl.txt
 * Copyright 2014-2016 Jean-Sebastien Morisset (http://surniaulula.com/)
 */

if ( ! defined( 'ABSPATH' ) ) 
	die( 'These aren\'t the droids you\'re looking for...' );

if ( ! class_exists( 'WpssoOrgSubmenuOrgGeneral' ) && class_exists( 'WpssoAdmin' ) ) {

	class WpssoOrgSubmenuOrgGeneral extends WpssoAdmin {

		public function __construct( &$plugin, $id, $name, $lib, $ext ) {
			$this->p =& $plugin;
			$this->menu_id = $id;
			$this->menu_name = $name;
			$this->menu_lib = $lib;
			$this->menu_ext = $ext;

			if ( $this->p->debug->enabled )
				$this->p->debug->mark();
		}

		protected function add_meta_boxes() {
			add_meta_box( $this->pagehook.'_general',
				_x( 'Organizations and Knowledge Graph', 'metabox title', 'wpsso-organization' ), 
					array( &$this, 'show_metabox_general' ), $this->pagehook, 'normal' );
		}

		public function show_metabox_general() {
			$lca = $this->p->cf['lca'];
			$metabox = 'organization';

			$tabs = apply_filters( $lca.'_'.$metabox.'_tabs', array( 
				'site' => 'Website (Home Page)',
				'other' => 'Other Organizations',
			) );

			$table_rows = array();
			foreach ( $tabs as $key => $title )
				$table_rows[$key] = apply_filters( $lca.'_'.$metabox.'_'.$key.'_rows', 
					$this->get_table_rows( $metabox, $key ), $this->form );
			$this->p->util->do_metabox_tabs( $metabox, $tabs, $table_rows );
		}

		protected function get_table_rows( $metabox, $key ) {
			$table_rows = array();
			switch ( $metabox.'-'.$key ) {
				case 'organization-site':

					$this->form->__address_names = SucomUtil::get_multi_key_locale( 'plm_addr_name', $this->p->options, true );
					$this->form->__all_types = $this->p->schema->get_schema_types( false );
					$this->form->__org_types = $this->p->schema->get_schema_types_select( $this->form->__all_types['organization'], false );

					if ( ! empty( $this->p->cf['plugin']['wpssoplm'] ) &&
						empty( $this->p->cf['plugin']['wpssoplm']['version'] ) ) {
		
						$plm_req_msg = ' <em><a href="'.$this->p->cf['plugin']['wpssoplm']['url']['download'].'" target="_blank">'.
							sprintf( _x( '%s extension required', 'option comment', 'wpsso-plm' ),
								$this->p->cf['plugin']['wpssoplm']['short'] ).'</a></em>';
					} else $plm_req_msg = false;

					$table_rows['schema_social_json'] = $this->form->get_th_html( _x( 'Google Knowledge Graph',
						'option label', 'wpsso' ), null, 'org_json' ).
					'<td>'.
					'<p>'.$this->form->get_checkbox( 'schema_organization_json' ).
						sprintf( __( ' Include <a href="%s">Organization Social Profile</a>',
							'wpsso' ), 'https://developers.google.com/structured-data/customize/social-profiles' ).'</p>'.
					'</td>';

					$table_rows['org_name'] = $this->form->get_th_html( _x( 'Website Name',
						'option label', 'nextgen-facebook' ), '', 'org_name', array( 'is_locale' => true ) ).
					'<td>'.$this->form->get_input( SucomUtil::get_key_locale( 'org_name', $this->p->options ),
						'long_name', null, null, SucomUtil::get_site_name( $this->p->options ) ).'</td>';

					$table_rows['org_alt_name'] = $this->form->get_th_html( _x( 'Website Alternate Name',
						'option label', 'nextgen-facebook' ), '', 'schema_alt_name', array( 'is_locale' => true ) ).
					'<td>'.$this->form->get_input( SucomUtil::get_key_locale( 'org_alt_name', $this->p->options ),
						'long_name', null, null, SucomUtil::get_locale_opt( 'schema_alt_name', $this->p->options ) ).'</td>';

					$table_rows['org_desc'] = $this->form->get_th_html( _x( 'Website Description',
						'option label', 'nextgen-facebook' ), '', 'org_desc', array( 'is_locale' => true ) ).
					'<td>'.$this->form->get_textarea( SucomUtil::get_key_locale( 'org_desc', $this->p->options ),
						null, null, null, SucomUtil::get_site_description( $this->p->options ) ).'</td>';

					$table_rows['org_url'] = $this->form->get_th_html( _x( 'Website URL',
						'option label', 'wpsso' ), '', 'org_url', array( 'is_locale' => true ) ).
					'<td>'.$this->form->get_input( SucomUtil::get_key_locale( 'org_url', $this->p->options ),
						'wide', null, null, get_bloginfo( 'url' ) ).'</td>';

					$table_rows['schema_logo_url'] = $this->form->get_th_html( 
						'<a href="https://developers.google.com/structured-data/customize/logos">'.
						_x( 'Organization Logo Image URL', 'option label', 'wpsso' ).'</a>', '', 'schema_logo_url' ).
					'<td>'.$this->form->get_input( 'schema_logo_url', 'wide' ).'</td>';

					$table_rows['schema_banner_url'] = $this->form->get_th_html( 
						_x( 'Organization Banner (600x60px) URL', 'option label', 'wpsso' ), '', 'schema_banner_url' ).
					'<td>'.$this->form->get_input( 'schema_banner_url', 'wide' ).'</td>';

					$table_rows['org_type'] = $this->form->get_th_html( _x( 'Organization Schema Type',
						'option label', 'nextgen-facebook' ), '', 'org_type' ).
					'<td>'.$this->form->get_select( 'org_type', $this->form->__org_types, 'long_name' ).'</td>';

					$table_rows['org_place_id'] = $this->form->get_th_html( _x( 'Organization Place / Location',
						'option label', 'wpsso-organization' ), '', 'org_place_id' ).
					'<td>'.$this->form->get_select( 'org_place_id', $this->form->__address_names, 'long_name', '', true,
						( $plm_req_msg ? true : false ) ).$plm_req_msg.'</td>';

					$table_rows['subsection_google_knowledgegraph'] = '<td></td><td class="subsection"><h4>'.
						_x( 'Google Knowledge Graph', 'metabox title', 'wpsso' ).'</h4></td>';

					$social_accounts = apply_filters( $this->p->cf['lca'].'_social_accounts', 
						$this->p->cf['form']['social_accounts'] );
					asort( $social_accounts );	// sort by label and maintain key association

					foreach ( $social_accounts as $key => $label ) {
						$table_rows[$key] = $this->form->get_th_html( _x( $label, 'option value', 'wpsso' ),
							null, $key, array( 'is_locale' => true ) ).
						'<td>'.$this->form->get_input( SucomUtil::get_key_locale( $key, $this->p->options ),
							( strpos( $key, '_url' ) ? 'wide' : '' ) ).'</td>';
					}

					break;
			}
			return $table_rows;
		}
	}
}

?>