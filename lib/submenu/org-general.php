<?php
/*
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl.txt
 * Copyright 2014-2017 Jean-Sebastien Morisset (https://surniaulula.com/)
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( 'These aren\'t the droids you\'re looking for...' );
}

if ( ! class_exists( 'WpssoOrgSubmenuOrgGeneral' ) && class_exists( 'WpssoAdmin' ) ) {

	class WpssoOrgSubmenuOrgGeneral extends WpssoAdmin {

		public function __construct( &$plugin, $id, $name, $lib, $ext ) {
			$this->p =& $plugin;

			if ( $this->p->debug->enabled ) {
				$this->p->debug->mark();
			}

			$this->menu_id = $id;
			$this->menu_name = $name;
			$this->menu_lib = $lib;
			$this->menu_ext = $ext;	// lowercase acronyn for plugin or extension
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
				'site' => _x( 'Website (Front Page)', 'metabox tabs', 'wpsso-organization' ),
				'other' => _x( 'Other Organizations', 'metabox tabs', 'wpsso-organization' ),
			) );
			$table_rows = array();
			foreach ( $tabs as $key => $title ) {
				$table_rows[$key] = apply_filters( $lca.'_'.$metabox.'_'.$key.'_rows', 
					$this->get_table_rows( $metabox, $key ), $this->form );
			}
			$this->p->util->do_metabox_tabs( $metabox, $tabs, $table_rows );
		}

		protected function get_table_rows( $metabox, $key ) {
			$table_rows = array();
			switch ( $metabox.'-'.$key ) {
				case 'organization-site':

					$this->form->__address_names = SucomUtil::get_multi_key_locale( 'plm_addr_name', $this->p->options, true );
					$this->form->__all_types = $this->p->schema->get_schema_types_array( false );	// $flatten = false
					$this->form->__org_types = $this->p->schema->get_schema_types_select(
						$this->form->__all_types['thing']['organization'], false );	// $add_none = false

					if ( empty( $this->p->avail['p_ext']['plm'] ) ) {
						$plm_req_msg = ' <p style="dislay:inline;"><em>'.
							'<a href="'.$this->p->cf['plugin']['wpssoplm']['url']['home'].'">'.
								sprintf( _x( '%s extension required', 'option comment', 'wpsso-plm' ),
									$this->p->cf['plugin']['wpssoplm']['short'] ).'</a></em></p>';
					} else {
						$plm_req_msg = '';
					}

					$table_rows['schema_social_json'] = $this->form->get_th_html( _x( 'Google Knowledge Graph',
						'option label', 'wpsso-organization' ), null, 'org_json' ).
					'<td>'.
					'<p>'.$this->form->get_checkbox( 'schema_organization_json' ).
						sprintf( __( ' Include <a href="%s">Organization Social Profile</a>', 'wpsso-organization' ),
							'https://developers.google.com/structured-data/customize/social-profiles' ).'</p>'.
					'</td>';

					$table_rows['site_name'] = '<tr class="hide_in_basic">'.
					$this->form->get_th_html( _x( 'Website Name',
						'option label', 'wpsso-organization' ), null, 'site_name', array( 'is_locale' => true ) ).
					'<td>'.$this->form->get_input( SucomUtil::get_key_locale( 'site_name', $this->p->options ),
						'long_name', null, null, get_bloginfo( 'name', 'display' ) ).'</td>';

					$table_rows['site_alt_name'] = '<tr class="hide_in_basic">'.
					$this->form->get_th_html( _x( 'Website Alternate Name',
						'option label', 'wpsso-organization' ), null, 'site_alt_name', array( 'is_locale' => true ) ).
					'<td>'.$this->form->get_input( SucomUtil::get_key_locale( 'site_alt_name', $this->p->options ),
						'long_name' ).'</td>';

					$table_rows['site_desc'] = '<tr class="hide_in_basic">'.
					$this->form->get_th_html( _x( 'Website Description',
						'option label', 'wpsso-organization' ), null, 'site_desc', array( 'is_locale' => true ) ).
					'<td>'.$this->form->get_textarea( SucomUtil::get_key_locale( 'site_desc', $this->p->options ),
						null, null, null, get_bloginfo( 'description', 'display' ) ).'</td>';

					$table_rows['site_url'] = '<tr class="hide_in_basic">'.
					$this->form->get_th_html( _x( 'Website URL',
						'option label', 'wpsso-organization' ), '', 'site_url', array( 'is_locale' => true ) ).
					'<td>'.$this->form->get_input( SucomUtil::get_key_locale( 'site_url', $this->p->options ),
						'wide', null, null, get_bloginfo( 'url' ) ).'</td>';

					$table_rows['schema_logo_url'] = $this->form->get_th_html( 
						'<a href="https://developers.google.com/structured-data/customize/logos">'.
						_x( 'Organization Logo URL', 'option label', 'wpsso-organization' ).'</a>',
							'', 'schema_logo_url', array( 'is_locale' => true ) ).
					'<td>'.$this->form->get_input( SucomUtil::get_key_locale( 'schema_logo_url', $this->p->options ), 'wide' ).'</td>';

					$table_rows['schema_banner_url'] = $this->form->get_th_html( _x( 'Organization Banner URL',
						'option label', 'wpsso-organization' ), '', 'schema_banner_url', array( 'is_locale' => true ) ).
					'<td>'.$this->form->get_input( SucomUtil::get_key_locale( 'schema_banner_url', $this->p->options ), 'wide' ).'</td>';

					$table_rows['site_org_type'] = $this->form->get_th_html( _x( 'Organization Schema Type',
						'option label', 'wpsso-organization' ), '', 'site_org_type' ).
					'<td>'.$this->form->get_select( 'site_org_type', $this->form->__org_types, 'schema_type' ).'</td>';

					$table_rows['site_place_id'] = $this->form->get_th_html( _x( 'Organization Place / Location',
						'option label', 'wpsso-organization' ), '', 'site_place_id' ).
					'<td>'.$this->form->get_select( 'site_place_id', $this->form->__address_names, 'long_name', '', true,
						( empty( $plm_req_msg ) ? false : true ) ).$plm_req_msg.'</td>';	// disable if plm not available

					$table_rows['subsection_google_knowledgegraph'] = '<td></td><td class="subsection"><h4>'.
						_x( 'Google Knowledge Graph', 'metabox title', 'wpsso-organization' ).'</h4></td>';

					$social_accounts = apply_filters( $this->p->cf['lca'].'_social_accounts', 
						$this->p->cf['form']['social_accounts'] );

					asort( $social_accounts );	// sort by label and maintain key association

					foreach ( $social_accounts as $key => $label ) {
						$table_rows[$key] = $this->form->get_th_html( _x( $label, 'option value', 'wpsso-organization' ),
							'nowrap', $key, array( 'is_locale' => true ) ).
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
