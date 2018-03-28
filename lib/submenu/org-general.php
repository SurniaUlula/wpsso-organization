<?php
/**
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl.txt
 * Copyright 2014-2018 Jean-Sebastien Morisset (https://wpsso.com/)
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
			$this->menu_ext = $ext;
		}

		// called by the extended WpssoAdmin class
		protected function add_meta_boxes() {

			$this->maybe_show_language_notice();

			add_meta_box( $this->pagehook.'_general',
				_x( 'Organizations and Knowledge Graph', 'metabox title', 'wpsso-organization' ), 
					array( &$this, 'show_metabox_general' ), $this->pagehook, 'normal' );
		}

		public function show_metabox_general() {

			$metabox_id = 'organization';

			$tabs = apply_filters( $this->p->lca.'_'.$metabox_id.'_tabs', array( 
				'site' => _x( 'WebSite (Front Page)', 'metabox tab', 'wpsso-organization' ),
				'other' => _x( 'Other Organizations', 'metabox tab', 'wpsso-organization' ),
			) );

			$table_rows = array();

			foreach ( $tabs as $tab_key => $title ) {
				$table_rows[$tab_key] = apply_filters( $this->p->lca.'_'.$metabox_id.'_'.$tab_key.'_rows', 
					$this->get_table_rows( $metabox_id, $tab_key ), $this->form );
			}

			$this->p->util->do_metabox_tabs( $metabox_id, $tabs, $table_rows );
		}

		protected function get_table_rows( $metabox_id, $tab_key ) {

			$table_rows = array();

			switch ( $metabox_id.'-'.$tab_key ) {

				case 'organization-site':

					$atts_locale = array( 'is_locale' => true );

					$def_site_name = get_bloginfo( 'name' );
					$def_site_desc = get_bloginfo( 'description' );
					$def_site_url  = get_bloginfo( 'url' );

					$site_name_key     = SucomUtil::get_key_locale( 'site_name', $this->form->options );
					$site_name_alt_key = SucomUtil::get_key_locale( 'site_name_alt', $this->form->options );
					$site_desc_key     = SucomUtil::get_key_locale( 'site_desc', $this->form->options );
					$site_url_key      = SucomUtil::get_key_locale( 'site_url', $this->form->options );

					$plm_req_msg      = $this->p->util->get_ext_req_msg( 'plm' );
					$plm_disable      = empty( $plm_req_msg ) ? false : true;
					$place_addr_names = $this->form->get_cache( 'place_addr_names', true );

					$table_rows['schema_knowledge_graph'] = $this->form->get_th_html( _x( 'Google Knowledge Graph',
						'option label', 'wpsso-organization' ), '', 'org_json' ).
					'<td><p>'.$this->form->get_checkbox( 'schema_add_home_organization' ).
						sprintf( __( ' Include <a href="%s">Organization Social Profile</a>', 'wpsso-organization' ),
							'https://developers.google.com/structured-data/customize/social-profiles' ).'</p></td>';

					$table_rows['site_name'] = $this->form->get_tr_hide( 'basic', $site_name_key ).
					$this->form->get_th_html( _x( 'WebSite Name', 'option label', 'wpsso-organization' ), '', 'site_name', $atts_locale ).
					'<td>'.$this->form->get_input( $site_name_key, 'long_name', '', 0, $def_site_name ).'</td>';

					$table_rows['site_name_alt'] = $this->form->get_tr_hide( 'basic', $site_name_alt_key ).
					$this->form->get_th_html( _x( 'WebSite Alternate Name', 'option label', 'wpsso-organization' ), '', 'site_name_alt', $atts_locale ).
					'<td>'.$this->form->get_input( $site_name_alt_key, 'long_name' ).'</td>';

					$table_rows['site_desc'] = $this->form->get_th_html( _x( 'WebSite Description',
						'option label', 'wpsso-organization' ), '', 'site_desc', $atts_locale ).
					'<td>'.$this->form->get_textarea( $site_desc_key, '', '', 0, $def_site_desc ).'</td>';

					$table_rows['site_url'] = $this->form->get_tr_hide( 'basic', $site_url_key ).
					$this->form->get_th_html( _x( 'WebSite URL', 'option label', 'wpsso-organization' ), '', 'site_url', $atts_locale ).
					'<td>'.$this->form->get_input( $site_url_key, 'wide', '', 0, $def_site_url ).'</td>';

					$table_rows['schema_logo_url'] = $this->form->get_th_html( 
						'<a href="https://developers.google.com/structured-data/customize/logos">'._x( 'Organization Logo URL',
							'option label', 'wpsso-organization' ).'</a>', '', 'schema_logo_url', $atts_locale ).
					'<td>'.$this->form->get_input( SucomUtil::get_key_locale( 'schema_logo_url', $this->p->options ), 'wide' ).'</td>';

					$table_rows['schema_banner_url'] = $this->form->get_th_html( _x( 'Organization Banner URL',
						'option label', 'wpsso-organization' ), '', 'schema_banner_url', $atts_locale ).
					'<td>'.$this->form->get_input( SucomUtil::get_key_locale( 'schema_banner_url', $this->p->options ), 'wide' ).'</td>';

					$table_rows['site_org_type'] = $this->form->get_th_html( _x( 'Organization Schema Type',
						'option label', 'wpsso-organization' ), '', 'site_org_type' ).
					'<td>'.$this->form->get_select( 'site_org_type', $this->form->get_cache( 'org_types_select' ), 'schema_type' ).'</td>';

					$table_rows['site_place_id'] = $this->form->get_th_html( _x( 'Organization Place / Location',
						'option label', 'wpsso-organization' ), '', 'site_place_id' ).
					'<td>'.$this->form->get_select( 'site_place_id', $place_addr_names, 'long_name', '', true, $plm_disable ).$plm_req_msg.'</td>';

					$table_rows['subsection_google_knowledgegraph'] = '<td></td><td class="subsection"><h4>'.
						_x( 'Google Knowledge Graph', 'metabox title', 'wpsso-organization' ).'</h4></td>';

					$social_accounts = apply_filters( $this->p->lca.'_social_accounts', $this->p->cf['form']['social_accounts'] );

					asort( $social_accounts );	// sort by label and maintain key association

					foreach ( $social_accounts as $opt_key => $opt_label ) {
						$table_rows[$opt_key] = $this->form->get_th_html( _x( $opt_label,
							'option value', 'wpsso-organization' ), 'nowrap', $opt_key, $atts_locale ).
						'<td>'.$this->form->get_input( SucomUtil::get_key_locale( $opt_key, $this->p->options ),
							( strpos( $opt_key, '_url' ) ? 'wide' : '' ) ).'</td>';
					}

					break;
			}

			return $table_rows;
		}
	}
}
