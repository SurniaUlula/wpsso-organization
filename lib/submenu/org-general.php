<?php
/**
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl.txt
 * Copyright 2014-2020 Jean-Sebastien Morisset (https://wpsso.com/)
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( 'These aren\'t the droids you\'re looking for.' );
}

if ( ! class_exists( 'WpssoOrgSubmenuOrgGeneral' ) && class_exists( 'WpssoAdmin' ) ) {

	class WpssoOrgSubmenuOrgGeneral extends WpssoAdmin {

		public function __construct( &$plugin, $id, $name, $lib, $ext ) {

			$this->p =& $plugin;

			if ( $this->p->debug->enabled ) {
				$this->p->debug->mark();
			}

			$this->menu_id   = $id;
			$this->menu_name = $name;
			$this->menu_lib  = $lib;
			$this->menu_ext  = $ext;
		}

		/**
		 * Called by the extended WpssoAdmin class.
		 */
		protected function add_meta_boxes() {

			$this->maybe_show_language_notice();

			$metabox_id      = 'org';
			$metabox_title   = _x( 'Organizations and Knowledge Graph', 'metabox title', 'wpsso-organization' );
			$metabox_screen  = $this->pagehook;
			$metabox_context = 'normal';
			$metabox_prio    = 'default';
			$callback_args   = array(	// Second argument passed to the callback function / method.
			);

			add_meta_box( $this->pagehook . '_' . $metabox_id, $metabox_title,
				array( $this, 'show_metabox_' . $metabox_id ), $metabox_screen,
					$metabox_context, $metabox_prio, $callback_args );
		}

		public function show_metabox_org() {

			$metabox_id = 'org';

			$tabs = apply_filters( $this->p->lca . '_' . $metabox_id . '_tabs', array( 
				'site'                => _x( 'WebSite Organization', 'metabox tab', 'wpsso-organization' ),
				'other_organizations' => _x( 'Other Organizations', 'metabox tab', 'wpsso-organization' ),
			) );

			$table_rows = array();

			foreach ( $tabs as $tab_key => $title ) {

				if ( empty( $this->p->avail[ 'p' ][ 'schema' ] ) ) {	// Since WPSSO Core v6.23.3.

					$table_rows[ $tab_key ] = array();

					$table_rows[ $tab_key ] = $this->p->msgs->get_schema_disabled_rows( $table_rows[ $tab_key ], $col_span = 1 );

				} else {

					$filter_name = $this->p->lca . '_' . $metabox_id . '_' . $tab_key . '_rows';

					$table_rows[ $tab_key ] = apply_filters( $filter_name, $this->get_table_rows( $metabox_id, $tab_key ), $this->form );
				}
			}

			$this->p->util->do_metabox_tabbed( $metabox_id, $tabs, $table_rows );
		}

		protected function get_table_rows( $metabox_id, $tab_key ) {

			$table_rows = array();

			switch ( $metabox_id . '-' . $tab_key ) {

				case 'org-site':

					$def_site_name = get_bloginfo( 'name' );
					$def_site_desc = get_bloginfo( 'description' );
					$def_site_url  = get_bloginfo( 'url' );

					$plm_req_msg     = $this->p->msgs->maybe_ext_required( 'wpssoplm' );
					$plm_disable     = empty( $plm_req_msg ) ? false : true;
					$plm_place_names = $this->p->util->get_form_cache( 'place_names', true );

					$org_types_select = $this->p->util->get_form_cache( 'org_types_select' );

					$table_rows[ 'site_name' ] = '' .
					$this->form->get_th_html_locale( _x( 'WebSite Name', 'option label', 'wpsso-organization' ),
						$css_class = '', $css_id = 'site_name' ) . 
					'<td>' . $this->form->get_input_locale( 'site_name', $css_class = 'long_name', $css_id = '',
						$len = 0, $def_site_name ) . '</td>';

					$table_rows[ 'site_name_alt' ] = '' .
					$this->form->get_th_html_locale( _x( 'WebSite Alternate Name', 'option label', 'wpsso-organization' ),
						$css_class = '', $css_id = 'site_name_alt' ) . 
					'<td>' . $this->form->get_input_locale( 'site_name_alt', $css_class = 'long_name' ) . '</td>';

					$table_rows[ 'site_desc' ] = '' . 
					$this->form->get_th_html_locale( _x( 'WebSite Description', 'option label', 'wpsso-organization' ),
						$css_class = '', $css_id = 'site_desc' ) . 
					'<td>' . $this->form->get_textarea_locale( 'site_desc', $css_class = '', $css_id = '',
						$len = 0, $def_site_desc ) . '</td>';

					$table_rows[ 'site_url' ] = $this->form->get_tr_hide( 'basic', 'site_url' ) . 
					$this->form->get_th_html_locale( _x( 'WebSite URL', 'option label', 'wpsso-organization' ),
						$css_class = '', $css_id = 'site_url' ) . 
					'<td>' . $this->form->get_input_locale( 'site_url', $css_class = 'wide', $css_id = '',
						$len = 0, $def_site_url ) . '</td>';

					$table_rows[ 'site_org_logo_url' ] = '' .
					$this->form->get_th_html_locale( '<a href="https://developers.google.com/structured-data/customize/logos">' .
					_x( 'Organization Logo URL', 'option label', 'wpsso-organization' ) . '</a>',
						$css_class = '', $css_id = 'site_org_logo_url' ) . 
					'<td>' . $this->form->get_input_locale( 'site_org_logo_url', $css_class = 'wide is_required' ) . '</td>';

					$table_rows[ 'site_org_banner_url' ] = '' .
					$this->form->get_th_html_locale( '<a href="https://developers.google.com/search/docs/data-types/article#logo-guidelines">' .
					_x( 'Organization Banner URL', 'option label', 'wpsso-organization' ) . '</a>',
						$css_class = '', $css_id = 'site_org_banner_url' ) . 
					'<td>' . $this->form->get_input_locale( 'site_org_banner_url', $css_class = 'wide is_required' ) . '</td>';

					$table_rows[ 'site_org_schema_type' ] = $this->form->get_tr_hide( 'basic', 'site_org_schema_type' ) .
					$this->form->get_th_html( _x( 'Organization Schema Type', 'option label', 'wpsso-organization' ),
						$css_class = '', $css_id = 'site_org_schema_type' ) . 
					'<td>' .
					$this->form->get_select( 'site_org_schema_type', $org_types_select, $css_class = 'schema_type', $css_id = '',
						$is_assoc = true, $is_disabled = false, $selected = false, $event_names = array( 'on_focus_load_json' ),
							$event_args = 'schema_org_types' ) .
					'</td>';

					$table_rows[ 'site_org_place_id' ] = '' .
					$this->form->get_th_html( _x( 'Organization Location', 'option label', 'wpsso-organization' ),
						$css_class = '', $css_id = 'site_org_place_id' ) . 
					'<td>' . $this->form->get_select( 'site_org_place_id', $plm_place_names,
						$css_class = 'long_name', $css_id = '', $is_assoc = true, $plm_disable ) . $plm_req_msg . '</td>';

					$table_rows[ 'subsection_google_knowledgegraph' ] = '<td colspan="2" class="subsection"><h4>' . 
						_x( 'Google\'s Knowledge Graph', 'metabox title', 'wpsso-organization' ) . '</h4></td>';

					$social_accounts = apply_filters( $this->p->lca . '_social_accounts', $this->p->cf[ 'form' ][ 'social_accounts' ] );

					asort( $social_accounts );	// Sort by label and maintain key association.

					foreach ( $social_accounts as $opt_key => $opt_label ) {

						$table_rows[ $opt_key ] = '' .
						$this->form->get_th_html_locale( _x( $opt_label, 'option value', 'wpsso-organization' ),
							$css_class = 'nowrap', $opt_key ) . 
						'<td>' . $this->form->get_input_locale( $opt_key, strpos( $opt_key, '_url' ) ? 'wide' : '' ) . '</td>';
					}

					break;
			}

			return $table_rows;
		}
	}
}
